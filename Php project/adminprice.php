<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all records from the payment table
$sql = "SELECT * FROM payment ORDER BY pay_id DESC";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Scrap Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

         body
        {
                background-color:grey;
        }
    </style>

</head>
<body>
<div>
        <?php include('adminheader.php')?>
    </div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Dashboard - Scrap Submissions</h2>

    <div>
        <table class="table table-striped table-dark  text-center">
            <thead class="table-dark">
                <tr>
                    
                    <th>Pay ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Organization</th>
                    <th>Weight (kg)</th>
                    <th>Scrap Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) 
                {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>
                                <td>{$row['pay_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['phone_no']}</td>
                                <td>{$row['organization']}</td>
                                <td>{$row['weight']}</td>
                                <td>{$row['scrap_type']}</td>
                                <td>
                                    <a href='deletepriceinfo.php?pay_id={$row['pay_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                              </tr>";
                        $count++;
                    }
                } 
                else 
                {
                    echo "<tr><td colspan='8' class='text-center text-muted'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
