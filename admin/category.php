<h3>Categories</h3>
<hr>
<h4><a href="?page=category_add.php">Create new</a></h4>

<table class="table table-hover table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT a.*, @num := @num +1 as Number FROM `category` as a, (SELECT @num:=0) as b";
                $results =mysqli_query($conn,$sql);
                $pagenum = isset($_GET['pnum'])?($_GET['pnum']):1;
                $last = $pagenum *5;
                $first = $last -5+1;
                while($row = mysqli_fetch_array($results)){
                    if($row['Number'] >= $first && $row['Number'] <= $last)
                    {
            ?>
                        <tr>
                            <td scope="row"><?php echo $row['cat_id']?></td>
                            <td><?php echo $row['cat_name'] ?></td>
                            <td>
                                <a href ="<?php echo $urladmin.'?page='.$categoryEdit.'&id='.$row['cat_id'];?>">
                                    <span class="material-icons" style ="color:red">
                                    edit
                                    </span>
                                </a>
                                <a href ="<?php echo $urladmin.'?page='.$categoryDelete.'&id='.$row['cat_id'];?>"
                                onclick ="return confirm('Are you sure to delete?')">
                                <span class="material-icons">
                                delete
                                </span> 
                                </a>
                            </td>
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
            $sql ="Select * from category";
            $results = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($results);
            $pagecount = ceil($count/5);
            for($i = 1; $i <= $pagecount;$i++)
            {
        ?>
            <li class ="page-item"><a class ="page-link" href ='<?php echo "$urladmin?page=$category&pnum=$i";?>'><?php echo $i;?></a></li> 
        <?php
            }
        ?>
    </ul>
</nav>