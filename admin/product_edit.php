<h3>Edit product</h3>
<hr>
<?php
  if(isset($_POST['submit'])){
    $it_id = isset($_POST["It_ID"])?$_POST['It_ID']:"";
    $it_name = isset($_POST["It_Name"])?$_POST['It_Name']:"";
    $it_image = isset($_FILES["It_Images"])?$_FILES['It_Images']:"";
    $it_description = isset($_POST["It_Description"])?$_POST['It_Description']:"";
    $it_price = isset($_POST["It_Price"])?$_POST['It_Price']:"";
    $cat_id = isset($_POST["categorylist"])?$_POST['categorylist']:"";
    
    if($it_image['name']!=""){
      copy($it_image['tmp_name'],"../asset/images/".$it_image['name']);
      $filepic = $it_image['name'];
      
      $sql ="update item set it_name ='$it_name', it_description='$it_description',it_price ='$it_price', it_image='$filepic', cat_id ='$cat_id' where it_id = '$it_id'";
      $result =mysqli_query($conn,$sql);        
      mysqli_query($conn,$sql);
      echo "<script>alert('Updated!'); window.location.href ='$urladmin?page=$product';</script>";   
    }else{
      $sql ="update item set it_name ='$it_name', it_description='$it_description',it_price ='$it_price', cat_id ='$cat_id' where it_id = '$it_id'";
      mysqli_query($conn,$sql);
      echo "<script>alert('Update Successs!!!!'); window.location.href= '$urladmin?page=$product'; </script>";
    }
  }else{
    if(isset($_GET["it_id"])){
        $sql = "select * from item where it_id =".$_GET["it_id"];

    $results =mysqli_query($conn,$sql);
    while($row =mysqli_fetch_array($results)){
      $it_id = $row['it_id'];
      $it_name = $row['it_name'];
      $it_image = $row['it_image'];
      $it_description = $row['it_description'];
      $it_price = $row['it_price'];
      $cat_id =$row['cat_id'];
    }
  }
}
?>
<form action ="" method ="post" enctype="multipart/form-data">
  <div class ="row">
    <div class = "form-group col-md-7">
      <label for ="">Category</label>

      <select class ="form-control" name="categorylist" id ="">
        <?php
          $sql ="select * from category";
          $result = mysqli_query($conn,$sql);
          while ($row = mysqli_fetch_array($result)){
        ?>
               <option value ="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name']?></option>
        <?php    
            }
        ?>
      </select>
    </div>
  </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">ID</label>
              <input value ='<?php echo $it_id;?>' type="text" name="It_ID" id="" class="form-control" placeholder="" aria-describedby="helpId" value ="<?php echo "".isset($it_id)?$it_id:"";?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Name</label>
              <input value ='<?php echo $it_name;?>' type="text" name="It_Name" id="It_Name" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <img src ='../asset/images/<?php echo $it_image?>' border = '0' width ="50" height ="50"/>
              <input value = '<?php echo $it_image;?>' type="text" class="form-control-file" name="It_Images" id="" placeholder="" aria-describedby="fileHelpId">
              <input value = '<?php echo $it_image;?>' type="file" class="form-control-file" name="It_Images" id="" placeholder="" aria-describedby="fileHelpId">
              
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Description</label>
              <input value ='<?php echo $it_description;?>' type="text" name="It_Description" id="It_Name" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Price</label>
              <input value ='<?php echo $it_price;?>' type="text" name="It_Price" id="It_Price" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
              <input name ="submit" id ="" class ="btn btn-success" type ="submit" value ="Submit">
              <input type="button" class = "btn btn-primary" name="btnIgnore" value ="Ignore" onclick ="window.loction ='<?php echo '?page=' .$product;?>'"/>
            </div>
        </div>    
</form>
