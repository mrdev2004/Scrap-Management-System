<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Scrap Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .about-section {
            padding: 110px 0;
        }
        .about-content, .website-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
        }
        .about-content h4, .website-info h4 {
            color: #28a745;
            margin-bottom: 15px;
        }
        .about-content ul {
            padding-left: 20px;
        }
        .terms-conditions {
            background: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('header_seller.php'); ?>
    <div class="container about-section">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="display-3 text-dark font-weight-bold">About Us</h1>
                <p class="lead text-muted">Your trusted platform for responsible scrap management and recycling.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-10 offset-md-1 website-info text-center">
                <h4>About Our Website</h4>
                <p>Our Scrap Management System provides an easy-to-use platform for scrap collection and recycling. We ensure secure payments, fair pricing, and transparent transactions. The system helps users efficiently manage scrap sales, recycling, and purchases in an eco-friendly manner.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 about-content">
                <h4>Our Objectives</h4>
                <ul>
                    <li>Promote environmental sustainability through recycling.</li>
                    <li>Provide a digital platform for scrap buyers and sellers.</li>
                    <li>Ensure fair pricing and secure transactions.</li>
                    <li>Encourage responsible waste management.</li>
                    <li>Create awareness about the importance of recycling.</li>
                </ul>
            </div>
            <div class="col-md-6 about-content">
                <h4>Our Services</h4>
                <ul>
                    <li>Scrap collection from homes, businesses, and industries.</li>
                    <li>Real-time scrap pricing for transparency.</li>
                    <li>Secure online payment processing.</li>
                    <li>Admin-side scrap recycling with documentation.</li>
                    <li>Data tracking of recycled waste and financial transactions.</li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-10 offset-md-1 terms-conditions">
                <h4>Terms and Conditions</h4>
                <ul class="list-unstyled">
                    <li>Users must provide accurate details during transactions.</li>
                    <li>Payments should be made securely via our integrated system.</li>
                    <li>All recycled scrap records will be stored and shared with buyers.</li>
                    <li>Users are responsible for ensuring the quality of scrap materials.</li>
                    <li>The platform reserves the right to update policies as needed.</li>
                </ul>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col">
                <a href="seller_contactus.php" class="btn btn-lg btn-warning text-white font-weight-bold">Get in Touch</a>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>