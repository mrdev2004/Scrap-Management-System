 <?php

session_start();
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$show_success = false; // Variable to track if registration is successful

if (isset($_POST['s'])) {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $user_type = $_POST['user_type']; // Get user type (Buyer or Seller)

    if ($pass != $cpass) {
        echo '<script>alert("Password and Confirm Password Should be Same!!");</script>';
    } else {
        // Store user type in database
        $sql = "INSERT INTO register (id, username, email, password, user_type) 
                VALUES (NULL, '$uname', '$email', '$pass', '$user_type')";
        $ans = mysqli_query($con, $sql);

        if ($ans) {
            $_SESSION['username'] = $uname;
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;
            $show_success = true; // Show success toast
        } else {
            echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrap Management Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #9A616D;">

<?php if ($show_success): ?>
    <!-- Bootstrap Toast for Success Message -->
    <div class="position-fixed top-0 end-0 m-3" style="z-index: 1050;">
        <div class="toast show align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    🎉 Registration Successful! Redirecting to Login...
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to redirect after 1.5 seconds -->
    <script>
        setTimeout(function() {
            window.location.href = "login.php";
        }, 1500);
    </script>
<?php endif; ?>

<form method="post">
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10" style="padding-bottom:40px;">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="loginimg.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height:70%;margin-top:30%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
                      <div class="form-outline mb-4">
                          <label class="form-label">Username</label>    
                          <input type="text" name="uname" class="form-control form-control-lg" required/>
                      </div>

                      <div class="form-outline mb-4">
                          <label class="form-label">Email address</label>    
                          <input type="email" name="email" class="form-control form-control-lg" required/>
                      </div>

                      <div class="form-outline mb-4">
                          <label class="form-label">Password</label>    
                          <input type="password" name="pass" class="form-control form-control-lg" required/>   
                      </div>

                      <div class="form-outline mb-4">
                          <label class="form-label">Confirm Password</label>  
                          <input type="password" name="cpass" class="form-control form-control-lg" required/>
                      </div>

                      <!-- User Type Selection -->
                      <div class="mb-4">
                          <label class="form-label">Register As:</label><br>
                          <input type="radio" name="user_type" value="Buyer" required> Buyer
                          <input type="radio" name="user_type" value="Seller" required> Seller
                      </div>

                      <div class="pt-1 mb-4">
                          <input type="submit" name="s" value="Register" class="btn btn-dark btn-lg btn-block form-control">
                      </div>

                      <center><p><a href="admin.php" style="color: #393f81;">Admin Login</a></p></center>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="login.php" style="color: #393f81;">Login here</a></p>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

</body>
</html>

