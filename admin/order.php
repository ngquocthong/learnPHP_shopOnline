<h3>Orders</h3>
<hr>

<table class="table table-hover table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>Order ID</th>
            <th>Cus Id</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT a.*,b.cus_name FROM orders as a LEFT join customer as b on a.cus_id = b.cus_id";
                $results = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_array($results)) {
            ?>
            <tr>
                <td scope="row"><?php echo $row['or_id'] ?></td>
                <td><?php echo $row['cus_name'] ?></td>
                <td>
                    <a href="<?php echo $urladmin.'?page='.$orderdetail.'&id='.$row['or_id'];?>">
                        <span class="material-icons" style="color:red">edit</span>
                    </a>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
</table>