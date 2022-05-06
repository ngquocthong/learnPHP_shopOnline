<h3>Order Detail</h3>
<hr>
<?php
    $id = $_GET['id'];
?>

<?php
    $sql = "SELECT a.*,b.cus_name FROM orders as a LEFT join customer as b on a.cus_id = b.cus_id where a.or_id ='$id'";
    $results = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_array($results)) {
         $id_or =  $row['or_id'];
?> 
        Customer: <?php echo $row['cus_name'] ?> <br/>
        Order ID: <?php echo $row['or_id'] ?> <br/>
        Date: <?php echo $row['or_date'] ?> <br/>
        <form method = "post">
            <div class="form-group">
            <label> Delivery: </label>
              <input value = "<?php echo $row['or_delivery']?>" type="text" name="OrDelivery" id="OrDelivery" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
            <label> Address: </label>
              <input value = "<?php echo $row['or_address']?>" type="text" name="OrAddress" id="OrAddress" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <input name="btnUpdate" id="" class="btn btn-primary" type="submit" value="Update">
                
        </form>
<?php
    }
?>
<?php
    $err ="";
    if(isset($_POST["btnUpdate"])) {
        $or_delivery = isset($_POST["OrDelivery"])?$_POST['OrDelivery']:"";
        $or_address = isset($_POST["OrAddress"])?$_POST['OrAddress']:"";
        if($or_delivery ==""){
          $err .="<li>Enter Delivery Date </li>";
        }
        if($or_address ==""){
          $err .="<li>Enter Address </li>";
        }
        if(empty($err)){
          $sql = "update orders set or_delivery = '$or_delivery', or_address = '$or_address' where or_id = '$id_or'";
          mysqli_query($conn,$sql);
          header("Location: $urladim?page=$order");
        }else{
          $err .= "<li>Duplicate</li>";
        }
        echo $err;
    }
?>
