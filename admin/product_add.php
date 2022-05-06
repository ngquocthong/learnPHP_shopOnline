<h3>Add product</h3>
<hr>

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
              <input type="text" name="It_ID" id="" class="form-control" placeholder="" aria-describedby="helpId" value ="<?php echo "".isset($it_id)?$it_id:"";?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Name</label>
              <input type="text" name="It_Name" id="It_Name" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
              <label for="">Image</label>
              <input type="file" class="form-control-file" name="It_Images" id="It_Images" placeholder="" aria-describedby="fileHelpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Description</label>
              <input type="text" name="It_Description" id="It_Name" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-7">
              <label for="">Price</label>
              <input type="text" name="It_Price" id="It_Price" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
              <input name ="submit" id ="" class ="btn btn-success" type ="submit" value ="Submit">
              <input type="button" class = "btn btn-primary" name="btnIgnore" value ="Ignore" onclick ="window.loction ='<?php echo '?page=' .$product;?>'"/>
            </div>
        </div>    
</form>
<?php

  if(isset($_POST['submit'])){
    $it_id = isset($_POST["It_ID"])?$_POST['It_ID']:"";
    $it_name = isset($_POST["It_Name"])?$_POST['It_Name']:"";
    $it_image = isset($_FILES["It_Images"])?$_FILES['It_Images']:"";
    $it_description = isset($_POST["It_Description"])?$_POST['It_Description']:"";
    $it_price = isset($_POST["It_Price"])?$_POST['It_Price']:"";
    $cat_id = isset($_POST["categorylist"])?$_POST['categorylist']:"";
    $err ="";

    $targetDir = "../asset/images/";
    $fileName = basename($it_image["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


    if(trim($it_id)==""){
      $err.="<li>Enter Product ID, Please</li>";
    }
    if(trim($it_name)==""){
      $err.="<li>Enter Product Name, Please</li>";
    }
    if(trim($it_description)==""){
      $err.="<li>Enter Product description, Please</li>";
    }
    if(!is_numeric($it_price)){
      $err.="<li>Enter Product Price must be number, Please</li>";
    }
    if(trim($cat_id)==""){
      $err.="<li>Enter Product Cat ID, Please</li>";
    }
    if($err !=""){
      echo "<ul>$err </ul>";
    }
    if(empty($err)){
      // Allow certain file formats
      $allowTypes = array('jpg','png','jpeg','gif');
      if(in_array($fileType, $allowTypes)){
        $sql ="select * from item where It_ID ='$it_id'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) ==0){
            copy($it_image['tmp_name'],"../asset/images/".$it_image['name']);
            $filepic = $fileName;
            $sql ="insert into item (it_id,it_name,it_description,it_price, it_image,cat_id) values ('$it_id','$it_name','$it_description','$it_price', '$filepic','$cat_id')";
            echo "<script> alert ('Add successfully'); </script>";
            mysqli_query($conn,$sql);
        }
        else{
            echo "<li>Duplicate product ID or Name </li>";
        }
      } else {
        echo "image format is not correct"; 
      } 
    }
  }
?>
 
    
