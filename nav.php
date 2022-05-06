<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?php echo "?page=".$about; ?>">IOT Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo "?page=".$product; ?>">Shop</a></li>
                
            </ul>
            <ul class = "navbar-nav me-auto mb-2 mb-lg-0 ms-lg-7">
                <li class = "nav-item dropdown">
                        <a class = "nav-link dropdown-toggle" id = "navbarDropdown" 
                        href="#" role = "button" data-bs-toggle="dropdown" aria-expanded="false"> Welcome 
                        <?php 
                        if(isset($_SESSION['cus_username']) != "") {
                            echo $_SESSION['cus_name'];
                        } else {
                            echo "Guest!";
                        }   
                        ?>
                        </a>
                <ul class = "dropdown-menu" aria-babelledby="navbarDropdown">
                    <?php 
                        if(isset($_SESSION['cus_username'])=="")
                        {   
                    ?>
                    <li><a class = "dropdown-item" href = "<?php echo "?page=".$login;?>">Login</a></li>
                    <li>
                        <hr class = "dropdown-divider"/>
                    </li>
                     <li> <a class="dropdown-item" href="<?php echo "?page=".$signup;?>">Sign up</a></li>
                     <?php
                        }
                    ?>
                    <?php 
                        if(isset($_SESSION['cus_username']) != "")
                        {
                    ?>
                     <li> <a class="dropdown-item" href="<?php echo "?page=".$logout;?>">Log Out</a></li>
                     <?php
                        }   
                     ?>
                </ul>       
                </li>
            <ul>

            <form class="d-flex">
                <a class="btn btn-outline-dark" type="summit" href = "?page=<?php echo $cart ?>" >
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php echo ((isset($_SESSION['mycart']) && count($_SESSION['mycart'])>0) ? count($_SESSION['mycart']) :0); ?> </span>
                    </span>
                 </a>
            </form>
        </div>
    </div>
</nav>