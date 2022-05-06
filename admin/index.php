<?php
    $urladmin ="http://localhost/as1excp1/admin/";
    $urluser = "http://localhost/as1excp1/";
    $home = "home.php";
    $category = "category.php";
    $categoryEdit = "category_edit.php"; 
    $product = "product.php";
    $productAdd = "product_add.php";
    $productEdit = "product_edit.php";
    $productDelete = "product_delete.php";
    $categoryDelete = "category_delete.php";
    $customer = "customer.php";
    $order = "order.php";
    $orderdetail = "orderdetail.php";
    //Connection
    $host = "localhost";
    $username="root";
    $password="";
    $db= "example";
    $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());

    include('./theme.php');
?>
