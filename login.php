
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
                      <span class="h1 fw-bold mb-0">Login</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in to shop!</h5>
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name = "cus_username" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" name = "cus_password" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button name = "btnSummitLogIn" class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="<?php echo "?page=".$signup;?>" style="color: #393f81;">Sign up here!</a></p>

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

  if(isset($_POST["btnSummitLogIn"])) {
    $username = $_POST['cus_username'];
    $password = $_POST['cus_password'];

    $md5Password = md5($password);
    echo $md5Password;
    $sql = "select * from customer where cus_username = '$username' and cus_password = '$md5Password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) != 0){
      while($row = mysqli_fetch_array($result)){
        $_SESSION["cus_name"] =  $row['cus_name'];
        $_SESSION["cus_username"] =  $row['cus_username'];
        $name = $row['cus_name'];
        if ($row['cus_role'] == 'admin') {
          echo "<script>alert('Login successfully!');
          window.location.href ='$urladmin?page=$product';
          </script>"; 
        } else {
          echo "<script>alert('Hi $name');
          window.location.href ='$urluser?page=$product';
          </script>";
        }


      }
    }
  }
?>