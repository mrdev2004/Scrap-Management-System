<?php

session_start();
// Redirect if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "project");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM register WHERE email='$email'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

// Handle Profile Update
$updateSuccess = false;
$updateError = "";
$oldPasswordError = "";
$newPasswordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $new_email = $_POST['email'];
    $password = $_POST['password']; // New password

    // Check if the old password field exists and if it's not empty
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : ''; // Old password for verification

    // Check if email is already taken by another user
    $check_sql = "SELECT * FROM register WHERE email='$new_email' AND email != '$email'";
    $check_result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $updateError = "Email is already in use!";
    } else {
        // Check if old password is being submitted
        if (!empty($old_password)) {
            // Check if the old password is correct
            $check_old_password = "SELECT password FROM register WHERE email='$email'";
            $password_result = mysqli_query($con, $check_old_password);
            $password_row = mysqli_fetch_assoc($password_result);

            if ($password_row['password'] !== $old_password) {
                $oldPasswordError = "Old password is incorrect!";
            } elseif ($password === $old_password) {
                // Check if the new password is the same as the old one
                $newPasswordError = "New password cannot be the same as the old password!";
            } else {
                // If the old password is correct, update the new password and other details
                if (!empty($password)) {
                    $update_sql = "UPDATE register SET username='$username', email='$new_email', password='$password' WHERE email='$email'";
                } else {
                    // If no new password is provided, just update username and email
                    $update_sql = "UPDATE register SET username='$username', email='$new_email' WHERE email='$email'";
                }

                if (mysqli_query($con, $update_sql)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $new_email;
                    $updateSuccess = true;
                } else {
                    $updateError = "Error updating profile: " . mysqli_error($con);
                }
            }
        } else {
            // If no old password is provided, just update the username and email
            $update_sql = "UPDATE register SET username='$username', email='$new_email' WHERE email='$email'";
            if (mysqli_query($con, $update_sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $new_email;
                $updateSuccess = true;
            } else {
                $updateError = "Error updating profile: " . mysqli_error($con);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #e8f5e9; /* Light green background */
            color: #388e3c; /* Dark green text */
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            height: 300px !important;
        }

        .btn-primary {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        .btn-primary:hover {
            background-color: #2c6b2f;
            border-color: #2c6b2f;
        }

        .toast {
            background-color: #4caf50; /* Green for success */
        }

        .toast-error {
            background-color: #d32f2f; /* Red for error */
        }

        .toast-warning {
            background-color: #ff9800; /* Orange for warning */
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #388e3c;
        }

        .form-label {
            color: #388e3c;
        }

        .form-text {
            color: #388e3c;
        }
    </style>
</head>
<body>
<?php include('header_buyer.php');
?>
<div class="container mt-5" >
    <h2 class="text-center" style="margin-top: 100px;">Manage Profile</h2>

    <!-- Bootstrap Toast Container -->
    <div class="position-fixed top-0 end-0 p-3"  >
        <?php if ($updateSuccess): ?>
            <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ✅ Profile updated successfully!
                    </div>
                </div>
            </div>
        <?php elseif (!empty($updateError)): ?>
            <div id="errorToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ❌ <?php echo $updateError; ?>
                    </div>
                </div>
            </div>
        <?php elseif (!empty($oldPasswordError)): ?>
            <div id="errorToast" class="toast align-items-center text-white bg-warning border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ⚠️ <?php echo $oldPasswordError; ?>
                    </div>
                </div>
            </div>
        <?php elseif (!empty($newPasswordError)): ?>
            <div id="errorToast" class="toast align-items-center text-white bg-warning border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ⚠️ <?php echo $newPasswordError; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
        </div>

        <!-- Old Password Field -->
        <div class="mb-3">
            <label class="form-label">Old Password (required to change password)</label>
            <input type="password" name="old_password" class="form-control">
            <small class="form-text text-muted">Enter your current password to update it.</small>
        </div>

        <!-- New Password Field -->
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control">
            <small class="form-text text-muted">Leave blank to keep existing password.</small>
        </div>

        <div class="mb-3">
            <label class="form-label">User Type</label>
            <input type="text" class="form-control" value="<?php echo $user['user_type']; ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <script>
        // Hide the toast after 3 seconds
        setTimeout(() => {
            let successToast = document.getElementById("successToast");
            let errorToast = document.getElementById("errorToast");
            if (successToast) successToast.classList.remove("show");
            if (errorToast) errorToast.classList.remove("show");
        }, 3000);
    </script>
</div>

</body>
</html>
