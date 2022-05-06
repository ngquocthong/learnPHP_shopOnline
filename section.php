<!-- Section-->
<section class="py-8">
<div class="container px-4 px-lg-5 mt-8">
    <?php 
        $page = isset($_GET['page']) ? $_GET["page"] : $home;
        include ($page);
    ?>
</div>
</section>