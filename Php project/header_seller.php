<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$con = mysqli_connect("localhost", "root", "", "project");

if (isset($_POST['submit1'])) {
    $name = $_SESSION['username'];
    $rating = $_POST['feedback'];
    $msg = $_POST['msg'];

    $sql = "INSERT INTO feedback VALUES (NULL, '$name', '$rating', '$msg')";
    $ans = mysqli_query($con, $sql);

    if ($ans) {
        echo '<script>alert("Thank you for your submission! We appreciate your input and will review it shortly.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .logo{
            border-radius:100%;
        }
        
        .nav-item::after {
            content: '';
            display: block;
            width: 0px;
            height: 2px;
            background: #ffffff;
            transition: 0.4s
        }
        .nav-item:hover::after {
            width: 100%;
        }
        .navbar-success .navbar-nav .active>.nav-link,
        .navbar-success .navbar-nav .nav-link.active,
        .navbar-success .navbar-nav .nav-link.show,
        .navbar-success .navbar-nav .show>.nav-link,
        .navbar-success .navbar-nav .nav-link:focus,
        .navbar-success .navbar-nav .nav-link:hover {
            color: #ffffff;
        }
        .nav-link {
            padding:30px;
            transition: 0.2s;
        }
        .navbar-nav{
            font-size:20px;
            padding-right:100px;
        }
        .nav-item{
            padding:10px;
        }
    </style>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-success bg-success " style="padding-top:7px;padding-bottom:7px">
            <img src="loginimg.png" class="logo" width="100" height="100" alt="" style="margin-left:10px">
            <a class="navbar-brand text-white" style="padding-left:20px;font-size:30px" href="#">Scrap Management</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto navbar-right">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="seller_homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="services.php">Services</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#myModal">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="manage_profile_seller.php">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="seller_contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="seller_aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <form method=post>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h3 class=text-white><i class="fa fa-comments-o" style="font-size:36px"></i><b> Feedback</b></h3>
                        <button type="button" class="btn-close btn-close-white" data-dismiss="modal" style="color:white;"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
                        <h3>Your opinion matters</h3>
                        <h4>Help us improve our product? <strong>Give us your feedback.</strong></h4>
                        <hr>
                        <h5>Your Rating</h5>
                        </div>
                        <div class="form-check mb-4">
                            <input name="feedback" value="Very Good" type="radio">
                            <label class="ml-3">Very Good</label>
                        </div>
                        <div class="form-check mb-4">
                            <input name="feedback" value="Good" type="radio">
                            <label class="ml-3">Good</label>
                        </div>
                        <div class="form-check mb-4">
                            <input name="feedback" value="Mediocre" type="radio">
                            <label class="ml-3">Mediocre</label>
                        </div>
                        <div class="form-check mb-4">
                            <input name="feedback" value="Bad" type="radio">
                            <label class="ml-3">Bad</label>
                        </div>
                        <div class="form-check mb-4">
                            <input name="feedback" value="Very Bad" type="radio">
                            <label class="ml-3">Very Bad</label>
                        </div>
                        <div class="text-center">
                            <h4><b>What could we improve?</b></h4>
                        </div>
                        <textarea type="textarea" placeholder="Your Message" name=msg rows="3" required></textarea>
                        <div class="modal-footer">
                            <input type="submit" name=submit1 class="btn btn-success" value=Send >
                            <a href="" class="btn btn-outline-success" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</body>
</html>