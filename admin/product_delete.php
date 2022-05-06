<?php
    $sql = "Delete from item where it_id =" .$_GET['it_id'];
    $result = mysqli_query($conn,$sql);
    echo "<script>alert'(Delete Success!!!');
            window.location.href='$urladmin?page=$product';
            </script>";
?>  