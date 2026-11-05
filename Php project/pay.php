<?php
$con = mysqli_connect("localhost", "root", "", "project");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle Payment Update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['payment_id'])) {
    $payment_id = intval($_POST['payment_id']);
    $updateQuery = "UPDATE scrap_payments SET status='Paid' WHERE id=?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("i", $payment_id);

    if ($stmt->execute()) {
        echo "success";
        exit();
    } else {
        echo "error";
        exit();
    }
}

// Fetch Payment Data
$sql = "SELECT * FROM scrap_payments ORDER BY id DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Scrap Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { color: #fff; }
        .paid-btn { background-color: green !important; border-color: green !important; }
    </style>
</head>
<body>
<div>
    <?php include('adminheader.php')?>
</div>

<div class="container">
    <div class="row" style="padding-bottom:50px;">
        <div class="col-md-12"><br><br>
            <h1 class="text-dark text-center">Seller Payments</h1><br>
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Scrap Type</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Scrap Weight (kg)</th>
                        <th>Date</th>
                        <th>Amount (₹)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['scrap_type'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['contact'] ?></td>
                            <td><?= $row['weight'] ?></td>
                            <td><?= $row['payment_date'] ?></td>
                            <td>₹<?= $row['amount'] ?></td>
                            <td>
                                <button class="btn <?= ($row['status'] == 'Paid') ? 'btn-success paid-btn' : 'btn-warning pay-btn' ?>" 
                                    onclick="markPaid(this, <?= $row['id'] ?>)"
                                    <?= ($row['status'] == 'Paid') ? 'disabled' : '' ?>>
                                    <?= ($row['status'] == 'Paid') ? 'Paid' : 'Pay' ?>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function markPaid(button, id) {
        $.ajax({
            url: "", // Same page handles the update
            type: "POST",
            data: { payment_id: id },
            success: function(response) {
                if (response.trim() === "success") {
                    button.innerText = "Paid";
                    button.classList.remove("btn-warning");
                    button.classList.add("btn-success", "paid-btn");
                    button.disabled = true;
                } else {
                    alert("Error updating payment status!");
                }
            },
            error: function() {
                alert("AJAX request failed!");
            }
        });
    }
</script>

</body>
</html>

<?php
$con->close();
?>
