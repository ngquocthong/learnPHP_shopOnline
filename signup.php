
<form  action="" method="post">
  <section class="vh-100" style="background-color: #ffffff;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-top h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img
                  src="./asset/images/login.jpg"
                  alt="login form"
                  class="img-fluid" style="border-radius: 1rem 0 0 1rem;"
                />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-top">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form>
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Sign Up</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up new account!</h5>
                    
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name = "cus_name" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Full Name</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name = "cus_username" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" name = "cus_password" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name = "cus_phone" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Phone Number</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name = "cus_address" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Address</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button name = "btnSummitSignUp"  class="btn btn-dark btn-lg btn-block" type="submit">Sign Up</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>


<?php
  //Connection
  $host = "localhost";
  $username="root";
  $password="";
  $db= "example";
  $conn = mysqli_connect($host,$username,$password,$db) or die("Can not connect database ".mysqli_connect_error());
  $urladmin ="http://localhost/as1excp1/admin/";
  $urluser = "http://localhost/as1excp1/";
  $urluserlogin = "http://localhost/as1excp1/login.php";
 
  if(isset($_POST["btnSummitSignUp"])) {
    $err ="";
    $cus_username = isset($_POST['cus_username']) ? $_POST['cus_username'] : "";
    $cus_password = isset($_POST['cus_password']) ? $_POST['cus_password'] : "";
    $cus_name =  isset($_POST['cus_name']) ? $_POST['cus_name'] : "";
    $cus_phone = isset($_POST['cus_phone']) ? $_POST['cus_phone'] : "";
    $cus_address =  isset($_POST['cus_address']) ? $_POST['cus_address'] : "";
    $cus_role = "member";
    $md5Pass = md5($cus_password);

    if($cus_username =="")
    {
        $err.="<li> Please Input User Name </li>";
    }
    if($cus_password =="")
    {
        $err.="<li> Please Input Password";
    }
    if($cus_phone =="")
    {
        $err.="<li> Please Input Phone Number";
    }
    if($cus_address == "")
    {
        $err.="<li> Please Input Address </li>" ;
    }
    if($err ==""){
        $sql ="select * from customer where cus_username ='$cus_username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) == 0){
          $sql = "INSERT INTO customer(`cus_name`, `cus_username`, `cus_password`, `cus_phone`, `cus_address`, `cus_role`) 
          VALUES ('$cus_name', '$cus_username','$md5Pass','$cus_phone','$cus_address','$cus_role')";
          mysqli_query($conn,$sql);
          echo "<script> alert ('Sign up successfully'); </script>";
          
        } else {
          $err.="<li>Already have this username! Please choose another username</li>";
          echo  "<script> alert ('Already have this account. Try again!');
          </script>";;
          }
        
    }
    else{
        echo "<script> alert '$err' </script>";
    }
  }
?>