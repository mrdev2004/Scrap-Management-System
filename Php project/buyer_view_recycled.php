<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "project");

if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

$username = $_SESSION['username'];

// Fetch recycled scrap details added by admin
$query = "SELECT rs.*, p.amount 
          FROM recycled_scrap rs 
          LEFT JOIN pay p ON rs.scrap_id = p.pay_id 
          WHERE rs.buyer_username='$username'";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recycled Scrap & Payment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Recycled Scrap Assigned by Admin</h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Scrap ID</th>
                    <th>Recycled Image</th>
                    <th>Recycled Date</th>
                    <th>Status</th>
                    <th>Payment Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { 
                    $image_path = "uploads/" . $row['recycled_image'];
                    if (!file_exists($image_path)) {
                        $image_path = "default.png"; // Fallback image
                    }
                ?>
                <tr>
                    <td><?php echo $row['scrap_id']; ?></td>
                    <td><img src="<?php echo $image_path; ?>" width="100"></td>
                    <td><?php echo $row['recycled_date']; ?></td>
                    <td><span class="badge badge-success"><?php echo $row['status']; ?></span></td>
                    <td>
                        <?php echo $row['amount'] ? "₹" . number_format($row['amount'], 2) : "Pending"; ?>
                    </td>
                    <td>
                        <?php if (!$row['amount']) { ?>
                            <button class="btn btn-primary pay-btn" data-id="<?php echo $row['scrap_id']; ?>" data-username="<?php echo $username; ?>" data-amount="399">
                                Pay ₹399
                            </button>
                        <?php } else { ?>
                            <span class="badge badge-success">Paid</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <p class="text-center">No recycled scrap assigned yet.</p>
        <?php } ?>
    </div>

    <script>
        document.querySelectorAll('.pay-btn').forEach(button => {
            button.addEventListener('click', function() {
                let scrapId = this.getAttribute('data-id');
                let username = this.getAttribute('data-username');
                let amount = this.getAttribute('data-amount');

                var options = {
                    "key": "RAZORPAY_KEY", 
                    "amount": amount * 100, 
                    "currency": "INR",
                    "name": "Scrap Management",
                    "description": "Scrap Recycling Payment",
                    "handler": function (response) {
                        let paymentId = response.razorpay_payment_id;

                        // Send payment details to the server
                        fetch('process_payment.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `scrap_id=${scrapId}&username=${username}&amount=${amount}&payment_id=${paymentId}`
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert("Payment Successful!");
                            location.reload();
                        });
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();
            });
        });
    </script>
</body>
</html>
