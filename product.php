<form  action="" method="post"> 
        <input id = "search" type="text" id="query" name="search" placeholder="Search...">
        <button type  = "submit" name = "btnSummitSearch">Search</button>
        <button type="submit" name="allProduct">All Products</button>
</form>     
<div class="container">
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php
            //Connection
        $host = "localhost";
        $username="root";
        $password="";
        $db= "example";
        $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());

        $counter = 0;
        if(isset($_POST["btnSummitSearch"])) {
            $nameSearch = $_POST['search'];
            $sql = "select * from item where it_name like '%$nameSearch%'";
        } else $sql = "select * from item";

        if(isset($_POST["allProducts"])) {
            $sql = "select * from item";
        }
        $results = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_array($results)) {
   
            if($counter == 0 || $counter % 3 == 0)
            {
                echo "<div class='row'>";
            }
        ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="./asset/images/<?php echo $row['it_image']; ?>" height ="224px" width = "224" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $row['it_name'] ?></h5>
                                <!-- Product price-->
                                <?php echo $row['it_price'] ?> $
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">  
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="<?php echo "?page=$productdetail&id=$row[it_id]";?>" role ="button"> View details </a></div>
                               
                            </div>
                        </div>
                    </div>

        <?php
            $counter++;
            if($counter % 3 == 0) 
            {
                echo "</div>";
                //echo "<hr/>";
            }
        }
        ?>
      </div>
    </div>
</div>
