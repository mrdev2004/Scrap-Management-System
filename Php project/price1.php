<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) 
{
    die("Database Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) 
{
    $username = $_POST['username'];
    $organization = $_POST['organization'];
    $scrap_type = $_POST['scrap_type'];
    $phone_no = $_POST['phone_no'];
    $weight = $_POST['weight'];

    // Insert into payment table
    $sql = "INSERT INTO payment VALUES (null, '$username', '$phone_no', '$organization',  '$weight','$scrap_type')";
    $result = mysqli_query($con, $sql);

    if ($result) 
    {
        ob_start();
        header("Location: payment.php?pay_id=$pay_id&username=$username");
        exit();
        ob_end_flush();
    } 
    else 
    {
        die("Error inserting data: " . mysqli_error($con));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Scrap Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div>
        <?php include('header.php')?>
</div>
<div style="padding-top:10%">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h4 class="text-center text-muted">Fill the Form</h4>
                    <form method="post">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Your Name*" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone_no" class="form-control" placeholder="Phone*" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="organization" class="form-control" placeholder="Your Business/Organization Name*" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="weight" class="form-control" placeholder="Weight of Scrap (kg)*" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="scrap_type" rows="3" placeholder="What is your Scrap Type?" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100">Submit & Proceed to Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
        <?php include('footer.php')?>
</div>
</body>
</html>
