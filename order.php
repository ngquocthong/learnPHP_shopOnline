<?php
 //Connection
 $host = "localhost";
 $username="root";
 $password="";
 $db= "example";
 $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());

    if (isset($_POST["btnSubmit"])) {
        $cus_id = "";
        $sql = "select * from customer where cus_username = '".$_SESSION["cus_username"]."'";
        
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $cus_id = $row["cus_id"];
        }
        //add orders
        $or_id = rand(100000,999999);
        $or_date = date("Y-m-d H:i:s");
        $delivery = new DateTime($or_date);
        $delivery -> add(new DateInterval('P20D'));
        $or_delivery = $delivery -> format ('Y-m-d H:i:s');
        $or_address = $_POST["Address"];
        $or_total = $_POST["total"];


        $sql = "insert into orders (or_id, or_date, or_delivery, or_address, or_total, cus_id)
        values ('$or_id', '$or_date', '$or_delivery', '$or_address', '$or_total', '$cus_id')";
        mysqli_query($conn, $sql);
        
        //add orders detail
        foreach ($_SESSION["mycart"] as $item) {
            $ord_id = rand(1,999999);
            $it_id = $item['it_id'];
            $ord_price = $item['it_price'];
            $ord_quantity = 1;
            $ord_total = $ord_price * $ord_quantity;
            $sql = "INSERT INTO `order_detail`(`ord_id`, `or_id`, `it_id`, `ord_price`, `ord_quantity`, `ord_total`) VALUES ('$ord_id', '$or_id', '$it_id', '$ord_price', '$ord_quantity', '$ord_total')";
            //echo $sql;
            mysqli_query($conn, $sql);
        }
        unset($_SESSION["mycart"]);
        header("Location: $urluser?page=$product");
    }
    
    if (isset($_SESSION["mycart"])){
        $cus_id = "";
        $sql = "select * from customer where cus_username = '". $_SESSION["cus_username"]."'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
            $cus_id = $row["cus_name"];
        }
        $total_price = 0;
        foreach ($_SESSION["mycart"] as $item) {
            $total_price += ($item['quatity']*$item['it_price']);
        }
?>
    <form action = "" method = "post">
        <div class="form-group">
          <label for="">Customer</label>
          <input type="text" name="Customer" value ="<?php echo $cus_id; ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Address</label>
          <input type="text" name="Address" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Total</label>
          <input type="text" name="total" id="" value ="<?php echo $total_price; ?>" readonly = "true" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <hr/>
            <input name = "btnSubmit" id = "" class = "btn btn-primary" href = "?page=<?php echo $product ?> " type = "submit" value = "Order">
        </div>
    </form>
<?php 
    }
?>