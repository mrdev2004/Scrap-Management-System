<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM admin_payments ORDER BY id DESC";
$result = mysqli_query($con, $query) or die("Query Failed: " . mysqli_error($con));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div>
    <?php include('adminheader.php') ?>
</div>
<div class="container mt-5">
    <div class="row" style="padding-bottom:10px;">
        <div class="col-md-12">
            <h1 class="text-dark text-center">Buyer Payment</h1><br>

            <?php if (mysqli_num_rows($result) == 0): ?>
                <p class="text-danger text-center">No payment records found.</p>
            <?php else: ?>
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Scrap Type</th>
                            <th>Recycled Output</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Payment ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['scrap_type']) ?></td>
                                <td><?= htmlspecialchars($row['recycled_output']) ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td>₹<?= $row['total_price'] ?></td>
                                <td><?= htmlspecialchars($row['payment_id']) ?></td>
                                <td><?= $row['created_at'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($con); ?>
