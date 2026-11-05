<?php
    $con = mysqli_connect("localhost", "root", "", "project");

    // Fetch Total Profit
    $profitQuery = "SELECT SUM(total_price) AS total_profit FROM buyer_payments";
    $profitResult = mysqli_query($con, $profitQuery);
    $profitRow = mysqli_fetch_assoc($profitResult);
    $totalProfit = $profitRow['total_profit'] ?? 0;

    // Fetch Total Recycled Waste
    $wasteQuery = "SELECT SUM(weight) AS total_waste FROM recycled_scrap";
    $wasteResult = mysqli_query($con, $wasteQuery);
    $wasteRow = mysqli_fetch_assoc($wasteResult);
    $totalWaste = $wasteRow['total_waste'] ?? 0;
    
    // Fetch Total Users
    $userQuery = "SELECT COUNT(*) AS total_users FROM register";
    $userResult = mysqli_query($con, $userQuery);
    $userRow = mysqli_fetch_assoc($userResult);
    $totalUsers = $userRow['total_users'] ?? 0;

    // Fetch Total Scrap Payment Amount
    $scrapPaymentQuery = "SELECT SUM(amount) AS total_scrap_payment FROM scrap_payments";
    $scrapPaymentResult = mysqli_query($con, $scrapPaymentQuery);
    $scrapPaymentRow = mysqli_fetch_assoc($scrapPaymentResult);
    $totalScrapPayment = $scrapPaymentRow['total_scrap_payment'] ?? 0;

    // Fetch buyer payments data
    $buyerPaymentsQuery = "SELECT id, scrap_type, recycled_output, quantity, total_price FROM buyer_payments ORDER BY id DESC";
    $buyerPaymentsResult = mysqli_query($con, $buyerPaymentsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
        }
        .icon {
            font-size: 30px;
            margin-right: 10px;
        }
        .chart-container {
            width: 80%;
            margin: auto;
            padding-top: 30px;
        }
    </style>
</head>
<body>
    <div>
        <?php include('adminheader.php'); ?>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <div class="row g-4">
            <!-- Total Profit Card -->
            <div class="col-md-4">
                <div class="dashboard-card bg-success text-white text-center">
                    <i class="fa-solid fa-dollar-sign icon"></i>
                    <h4>Total Profit</h4>
                    <p class="fs-4">₹<?php echo number_format($totalProfit, 2); ?></p>
                </div>
            </div>
            
            <!-- Total Recycled Waste Card -->
            <div class="col-md-4">
                <div class="dashboard-card bg-primary text-white text-center">
                    <i class="fa-solid fa-recycle icon"></i>
                    <h4>Total Recycled Waste</h4>
                    <p class="fs-4"><?php echo number_format($totalWaste, 2); ?> kg</p>
                </div>
            </div>
            
            <!-- Total Users Card -->
            <div class="col-md-4">
                <div class="dashboard-card bg-warning text-white text-center">
                    <i class="fa-solid fa-users icon"></i>
                    <h4>Total Users</h4>
                    <p class="fs-4"><?php echo $totalUsers; ?></p>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <h3 class="text-center mt-4">Payment Comparison</h3>
            <canvas id="paymentChart"></canvas>
        </div>

        <!-- Buyer Payments Table -->
        <div class="mt-5">
            <h3 class="text-center">Buyer Payments</h3>
            <div class="table-responsive">
                <table class="table table-striped table-dark text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Scrap Type</th>
                            <th>Quantity</th>
                            <th>Total Price (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($buyerPaymentsResult)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['scrap_type']); ?></td>
                                <td><?php echo number_format($row['quantity'], 2); ?></td>
                                <td>₹<?php echo number_format($row['total_price'], 2); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('paymentChart').getContext('2d');

        // Create gradient colors
        var gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, '#ff7eb3');
        gradient1.addColorStop(1, '#ff758c');

        var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, '#6a11cb');
        gradient2.addColorStop(1, '#2575fc');

        var paymentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Buyer Payments', 'Scrap Payments'],
                datasets: [{
                    label: 'Total Amount (₹)',
                    data: [<?php echo $totalProfit; ?>, <?php echo $totalScrapPayment; ?>],
                    backgroundColor: [gradient1, gradient2],
                    borderColor: ['#ff4f7b', '#1b6ef3'],
                    borderWidth: 2,
                    hoverBackgroundColor: ['#ff3e68', '#205ce5'],
                    hoverBorderColor: ['#cc3359', '#1749b3']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: "#333",
                            font: { weight: "bold" }
                        }
                    },
                    x: {
                        ticks: {
                            color: "#333",
                            font: { weight: "bold" }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "#333",
                            font: { weight: "bold" }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
