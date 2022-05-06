<?php 
     $host = "localhost";
     $username="root";
     $password="";
     $db= "example";
     $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());
     $urladmin ="http://localhost/as1excp1/admin/";
     $urluser = "http://localhost/as1excp1/";
        if(isset($_POST["btnSubmit"])) {
            if (!empty($_SESSION['cus_username'])) {
                $id = $_POST['it_id'];
                $newItems = array(
                    $id => array(
                        'it_id' => $id,
                        'it_name'=> $_POST['it_name'],
                        'it_price' => $_POST['it_price'],
                        'quatity' => 1,
                        'it_image' => $_POST['it_image'],
                        'ut_total' => $_POST['it_price']
                    )
                );

                if(empty($_SESSION['mycart'])){
                    $_SESSION['mycart'] = $newItems;
                    echo "<script>alert('Add Success!); window.location.href='$urluser?page=$product';
                    </script>";
                }
                else {
                    $array_keys = array_keys($_SESSION["mycart"]);
                    if (in_array($id, $array_keys)) {
                        echo "<script>alert ('Items exist !!!'); </script>";
                    } else {
                        $_SESSION["mycart"] = $_SESSION["mycart"] + $newItems;
                        echo "<script>alert('Add Success');
                        window.location.href='$urluser?page=$product';
                        </script>";
                    }
                }
            } else echo "<script>alert('Please! Log in before Add to cart');window.location.href='$urluser?page=$login';</script>";
        }   
         
         // Load product
         $id = $_GET["id"];

         $sql = "select a.*,b.* from item as a left join category as b on a.cat_id = b.cat_id where it_id = $id";
         $results = mysqli_query($conn, $sql);
         while ($row = mysqli_fetch_array($results)) {
?>             
         <form method = "post">
            <div class="row">
                    <div class="col-sm-4">
                        <img src="./asset/images/<?php echo $row['it_image'] ?>" width="400px" height="300px" class="img=responsive">
                    </div>
                <div class = "col-sm-8">
                    <h4>Product ID: <?php echo $row['it_id']?></h4><br/>
                    <span>Product Name: <?php echo $row['it_name']?> </span><br/>
                    <span>Category Name: <?php echo $row['cat_name']?></span><br/>
                    <span>Product Decription: <?php echo $row['it_description']?></span><br/>
                    <span>Product Price: <?php echo $row['it_price']." $"?></span><br/>

                    <input type="hidden" name="it_id" value ="<?php echo $row['it_id']?>">
                    <input type="hidden" name="it_name" value ="<?php echo $row['it_name']?>">
                    <input type="hidden" name="it_image" value ="./asset/images/<?php echo $row['it_image'];?>">
                    <input type="hidden" name="it_price" value ="<?php echo $row['it_price']?>">
                    <button type="summit" class ="btn btn-primary" name="btnSubmit"> Add to Cart</button>
                </div>
            </div>
         </form>
<?php
         }
?>

