<h3>Customer</h3>
<hr>
<table class="table table-hover table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT a.*, @num := @num +1 as Number FROM `customer` as a, (SELECT @num:=0) as b ";
                $results =mysqli_query($conn,$sql);
                $pagenum = isset($_GET['pnum'])?($_GET['pnum']):1;
                $last = $pagenum *10;
                $first = $last -10+1;
                while($row = mysqli_fetch_array($results)){
                    if($row['Number'] >= $first && $row['Number'] <= $last)
                    {
            ?>
                        <tr>
                            <td scope="row"><?php echo $row['cus_id']?></td>
                            <td><?php echo $row['cus_name'] ?></td>
                            <td><?php echo $row['cus_username'] ?></td>
                            <td><?php echo $row['cus_phone'] ?></td>
                            <td><?php echo $row['cus_address'] ?></td>
                            <td><?php echo $row['cus_role'] ?></td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
</table>
<nav aria-label ="page navigation example">
    <ul class ="pagination">
        <?php
            $sql ="Select * from customer";
            $results = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($results);
            $pagecount = ceil($count/10);
            for($i = 1; $i <= $pagecount;$i++)
            {
        ?>
            <li class ="page-item"><a class ="page-link" href ='<?php echo "$urladmin?page=$customer&pnum=$i";?>'><?php echo $i;?></a></li> 
        <?php
            }
        ?>
    </ul>
</nav>