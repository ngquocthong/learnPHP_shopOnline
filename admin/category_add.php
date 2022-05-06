<?php
  $err ="";
  if(isset($_POST["btnSubmit"])){
    $id = isset($_POST["inputID"])?$_POST['inputID']:"";
    $name = isset($_POST["inputName"])?$_POST['inputName']:"";
    if($id ==""){
      $err .="<li>Enter Category ID </li>";
    }
    if($name ==""){
      $err .="<li>Enter Category Name </li>";
    }
    if(empty($err)){
      $sql = "select * from category where cat_id = '$id' or cat_name ='$name'";
      $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)== 0){
          $sql = "insert into category values ('$id','$name')";
          mysqli_query($conn,$sql);
          header("Location: $urladim?page=$category");  
        }
    }else{
      $err .= "<li>Duplicate</li>";
    }

  }
?>
<h3>Add new category</h3>
<hr>
<form method ="post">
    <div class = "form-row">
        <div class="form-group col-md-7">
          <label for="inputID">ID</label>
          <input type="text" name="inputID" class="form-control" placeholder="ID" value ="<?php echo "".isset($id)?$id:"";?>">
        </div>
    </div>

    <div class = "form-row">
        <div class="form-group col-md-7">
          <label for="inputName">Name</label>
          <input type="text" name="inputName" class="form-control" placeholder="Name" value ="<?php echo "".isset($name)?$name:"";?>">
        </div>
    </div>
    <div class ="form-row">
      <div class ="form-group col-md-12">
        <input type ="submit" class ="btn btn-success" name ="btnSubmit" value ="Submit">
        <input type ="button" class ="btn btn-primary" name ="btnIgnore" value ="Ignore" onclick ="window.location ='<?php echo '?page'.$category;?>'">
    </div>
</form>