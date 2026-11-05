<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$con = mysqli_connect("localhost", "root", "", "project");

if (isset($_POST['quote1'])) {
    header('Location: quote.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<form method="post">
    <div>
        <?php include('header_seller.php') ?>
    </div>
    <div style="background-color:#75BC84">
        <center>
            <div style="padding-top:10%">

                <!-- 👇 Welcome message based on session -->
                <?php
                if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                    $user = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                    echo "<h3 class='text-white text-center'>Welcome, <strong>$user</strong>!</h3><br>";
                } else {
                    echo "<h3 class='text-white text-center'>Welcome, Guest!</h3><br>";
                }
                ?>

                <h1 class="text-white" style="font-size:70px;font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Plastic Recycling Company</h1>
                <img src="homelogo.png" class="pic" style="width:300px;height:300px">
                <h1 class="text-white" style="font-size:40px;font-family: Arial, Helvetica, sans-serif;">WE BUY SCRAP PLASTIC</h1>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" name="quote1" class="form-control btn-lg text-white" style="font-weight: bold;height:50px;background-color:#4CBB17;" value="CLICK HERE - GET A QUOTE FOR YOUR SCRAP!!!">
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <br><br>
                <img src="homeimg.png" class="pic" style="width:96%;height:600px;"/>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card text-white bg-white mx-auto" style="max-width:100%;height:320px;">
                        <div class="card-body">
                            <div class="card-text text-center text-dark" style="font-size:35px;font-style:italic;padding-top:40px">
                                “Scrap Management is a premier partner in finding recycling solutions for various plastics. Their expertise and responsiveness drives the relationship forward!”
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </center>
    </div>

    <div class="row">
        <div class="col-md-6" style="padding-left:10%;font-size:20px;color:gray">
            <br><br><br>
            Scrap Management is a top rated plastic recycling company. Our services benefit businesses generating large quantities of scrap plastic for recycling. Our experts can tailor a plastic recycling program for your specific operation.
            <br><br>
            Scrap Management partners with plastic recycling companies in order to meet and surpass their waste disposal needs. In addition, we create programs for businesses that historically have not recycled effectively. This improves recovery rates and increases the bottom line for our clients.
            <br><br>
            Working with Scrap Management, you can expect us to be down to earth, reliable, trustworthy, and resourceful. Our team uses the most cutting edge technology/techniques to guarantee the success of your plastic recycling program. We pride ourselves in our service which makes your job simple and profitable. Exceeding expectations and earning your loyal business is our #1 goal.
        </div>
        <div class="col-md-6" style="padding-right:10%">
            <br><br><br><br><br>
            <div class="container" style="max-width:550px">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="img1.jpg" style="width:550px;height:450px">
                        </div>
                        <div class="item">
                            <img src="img2.jpg" style="width:550px;height:450px">
                        </div>
                        <div class="item">
                            <img src="img3.jpg" style="width:550px;height:450px">
                        </div>
                    </div>

                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <center><img src="img.png" style="width:900px"></center>
    </div>
    <br><br>
    <div>
        <?php include('footer.php') ?>
    </div>
</form>
</body>
</html>
