<?php
    $con=mysqli_connect("localhost","root","","project");
    if(isset($_POST['submit']))
    {
        $uname=$_POST['uname'];
        $pass=$_POST['pass'];
        $sql="select * from admin where username='$uname' and password='$pass'";
        $ans=mysqli_query($con,$sql);
        $row=mysqli_num_rows($ans);
        if($row==1)
        {
            header('location:adminhome.php');
        }
        else
        {
            echo '<script>alert("Username or Password is incorrect !!");</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .bgimg {
           background-image:url("adminbackground.png");
           height:100vh;
           background-repeat:no-repeat;
           width:100%;
           background-size:cover;
        }
    </style>
</head>
<body class="bgimg">
    <form method=post>
    <section>
        <div class="container-fluid" style="padding-top:10%">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 bg-light" style="padding:30px;border-radius:20px">
                <h1 class="text-center text-primary"><b>Admin Login</b></h1><br><br> 
                <div class="form-outline mb-4">
                    <input type="text" name="uname" class="form-control input-lg" placeholder="Enter Username" required/>
                </div><br>
                <div class="form-outline mb-4">
                    <input type="password" name="pass" class="form-control input-lg" placeholder="Enter Password" required/><br><br>
                </div>                         
                <div class="pt-1 mb-4">
                <input type=submit class="btn btn-primary btn-lg form-control" name=submit value=Login style="padding-bottom:30px;">
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        </div>
    </section>
    </form>
</body>
</html>