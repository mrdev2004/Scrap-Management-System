<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "project");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$showErrorToast = false;
$showSuccessToast = false;
$errorMessage = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $user_type = $_POST['user_type']; // Get selected user role

    // Check if user exists with given role
    $sql = "SELECT username, user_type FROM register WHERE email='$email' AND password='$pass' AND user_type='$user_type'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $row['user_type'];

        // Show success toast
        $showSuccessToast = true;
        $redirectPage = ($row['user_type'] == "Buyer") ? "buyer_homepage.php" : "seller_homepage.php";
    } else {
        $showErrorToast = true;
        $errorMessage = "Invalid Email, Password, or Role!";
    }
}
?>
<?php if ($showSuccessToast): ?>
<script>
    // Store user details in Local Storage
    localStorage.setItem("username", "<?php echo $_SESSION['username']; ?>");
    localStorage.setItem("email", "<?php echo $_SESSION['email']; ?>");
    localStorage.setItem("user_type", "<?php echo $_SESSION['user_type']; ?>");
</script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrap Management Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #9A616D;">

<!-- Bootstrap Toasts -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">

    <?php if ($showErrorToast): ?>
    <!-- Error Toast (5 seconds) -->
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                ❌ <?php echo $errorMessage; ?>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            let toast = document.getElementById("errorToast");
            if (toast) toast.classList.remove("show");
        }, 5000);
    </script>
    <?php endif; ?>

    <?php if ($showSuccessToast): ?>
    <!-- Success Toast (2 seconds) -->
    <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                ✅ Login Successful! Redirecting...
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = "<?php echo $redirectPage; ?>";
        }, 2000);
    </script>
    <?php endif; ?>

</div>

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
                    <form method="post">
                        <div class="d-flex align-items-center mb-3 pb-1">
                            <span class="h1 fw-bold mb-0">Scrap Management</span>
                        </div>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                        
                        <div class="form-outline mb-4">
                            <label class="form-label">Email Address</label>    
                            <input type="email" name="email" class="form-control form-control-lg" required/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Password</label>    
                            <input type="password" name="pass" class="form-control form-control-lg" required/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Role:</label><br>    
                            <input type="radio" name="user_type" value="Buyer" required> Buyer
                            <input type="radio" name="user_type" value="Seller" required> Seller
                        </div>

                        <div class="pt-1 mb-4">
                            <input type="submit" class="btn btn-dark btn-lg btn-block form-control" name="submit" value="Login">
                        </div>

                        <a class="small text-muted" href="forgot_password.php">Forgot password?</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php" style="color: #393f81;"> Register here</a></p>
                        <a href="#!" class="small text-muted">Terms of use.</a>
                        <a href="#!" class="small text-muted">Privacy policy</a>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
