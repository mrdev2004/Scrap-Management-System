<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) 
{
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all payment records
$sql = "SELECT * FROM pay";
$result = mysqli_query($con, $sql);
if (!$result) 
{
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body{
                background-color:grey;
            }
    </style>
</head>
<body>
<div>
        <?php include('adminheader.php')?>
    </div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Dashboard - Payments</h2>

    <div>
        <table class="table table-striped table-dark table-hover text-center">
            <thead class="table-dark">
                <tr>
                    
                    <th>Pay ID</th>
                    <th>Username</th>
                    <th>Amount (₹)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                
                                <td>{$row['pay_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['amount']}</td>
                                <td>
                                    <a href='admindltpay.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                              </tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-light'>No payment records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
