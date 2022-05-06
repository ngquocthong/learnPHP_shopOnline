<?php
    if(isset($_SESSION['mycart'])){
        if(isset($_POST['btnRemove'])){
            foreach($_SESSION['mycart'] as $key => $value){
                if($_POST["it_id"] == $key){
                    unset($_SESSION['mycart'][$key]);
                    $status ="<div class ='box' style ='color : red;77'> Product is remove from your cart </div>";
                }
                if(empty($_SESSION["mycart"])){
                    unset($_SESSION["mycart"]);
                    return;
                }
            } 
        }
        
    
    $total_price = 0;

?>
    <table class="table table-hover table-inverse table-responsive">    
        <thead class="thead-inverse">
            <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $counter =0;
                foreach($_SESSION["mycart"] as $item){
            ?>
                <tr>
                    <td><?php echo $item['it_name'] ?></td>
                    <td><img src="<?php echo $item['it_image']; ?>" class="img-responsive" style="width: 50px" height="50px" alt="Image"></td>
                    <td> <?php echo $item['it_price'] ?></td>
                    <td>
                        <form method='post'>
                            <input type ="hidden" name='it_id' readonly="true" value="<?php echo $item["it_id"] ; ?>" />
                            <button type='submit' name="btnRemove" class= 'remove'>Remove</button>
                        </form>
                    </td>
                </tr>
                <?php   $total_price += ($item['quatity']*$item['it_price']);
                    }
                ?>
        </tbody>
        <tfoot>
               <tr>
                <td colspan ="2"></td>
                </td>
                    <?php  $total_price;?>
                </td>
                </tr>
                </tfoot>
        
     </table>
     <a class="btm btn-primary" href="?page=order.php" role = "button">Orders</a>
    <?php 
        } else{
            echo "<h3> Your Cart is emty </h3>";
        }
    ?>