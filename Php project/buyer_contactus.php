<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Scrap Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .contact-section {
            padding: 100px 0;
        }
        .contact-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        .contact-info p {
            font-size: 18px;
        }
        .contact-info i {
            color: #28a745; /* Green color */
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div>
        <?php include('header_seller.php')?>
    </div>

    <div class="container contact-section">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Contact Us</h2>
                <p class="mt-3">For any inquiries or support, feel free to contact us using the details below.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <div class="contact-info text-center">
                    <h4>Our Office</h4>
                    <p><i class="fa-solid fa-location-dot"></i><strong> Address:</strong>12, Shreeji Avenue, Citylight, Surat, Gujarat</p>
                    <p><i class="fa-solid fa-phone"></i><strong> Phone:</strong> +91 9876543210</p>
                    <p><i class="fa-solid fa-envelope"></i><strong> Email:</strong> support@scrapmanagement.com</p>
                    <h4 class="mt-3">Location</h4>
                    <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.593134583011!2d72.79973427595887!3d21.170192980488023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04fc6f91b8709%3A0x5f517c58c7a68f6e!2sCity%20Light%20Rd%2C%20Meghdoot%20Society%2C%20City%20Light%2C%20Athwa%2C%20Surat%2C%20Gujarat%20395007!5e0!3m2!1sen!2sin!4v1711812345678"
    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
</iframe>

                </div>
            </div>
        </div>
    </div>
    <div>
        <?php include('footer.php')?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
