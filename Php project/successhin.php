<?php
$con=mysqli_connect("localhost","root","","project");

if (!isset($_GET['pay_id']) || !isset($_GET['username']) || !isset($_GET['amount'])) 
{
    die("Invalid Request!");
}
$id= $_GET['id'];
$pay_id = $_GET['pay_id'];
$username = $_GET['username'];
$amount = $_GET['amount'];

// Insert payment into "pay" table
$sql = "INSERT INTO pay (id,pay_id, username, amount) VALUES ('$id','$pay_id', '$username', '$amount')";
mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow text-center">
                <h2 class="text-success">भुगतान सफल!</h2>
                <p>धन्यवाद, <b><?php echo $username; ?></b>.</p>
                <p>आपका भुगतान <b>₹<?php echo $amount; ?></b> सफल था।</p>
                <a href="homehin.php" class="btn btn-primary">होम पर जाएँ</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
