<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "project");

// Check if the connection is successful
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    echo '<script>alert("Please register first!"); window.location.href="register.php";</script>';
    exit();
}

// Retrieve session values
$username = $_SESSION['username'];
$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['scrap_type'])) {
    $scrap_type = $_POST['scrap_type'];
    $weight = $_POST['weight'];
    $amount = $_POST['amount'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    if (empty($scrap_type) || empty($weight) || empty($amount) || empty($address) || empty($contact)) {
        echo "Error: Missing required fields.";
        exit();
    }

    // ✅ Modified INSERT Query
    $query = "INSERT INTO scrap_payments (scrap_type, weight, amount, username, email, contact, address) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($query);
    if (!$stmt) {
        echo "Error in preparing statement: " . $con->error;
        exit();
    }

    $stmt->bind_param("sidssss", $scrap_type, $weight, $amount, $username, $email, $contact, $address);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database Insert Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scrap Inquiry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .card { border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); padding: 20px; }
        .scrap-images img { width: 50%; border-radius: 10px; margin-bottom: 10px; }
        .scrap-desc { text-align: center; font-size: 16px; color: black; margin-top: 15px; }
    </style>
</head>
<body>
<div style="margin-bottom: 100px;">
    <?php include('header_seller.php')?>
</div>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="scrap-images d-flex gap-2">
                <img src="plastic1.jpg" alt="Scrap Image 1">
                <img src="plastic2.jpg" alt="Scrap Image 2">
            </div>
            <p class="scrap-desc">
                <strong>Recycle your scrap and contribute to a greener environment!</strong><br>
                We buy and recycle all types of plastic scrap.<br><br>

                💰 <strong>Scrap Pricing:</strong><br> 
                🔹 100 - 199 kg ➝ ₹1000<br> 
                🔹 200 - 299 kg ➝ ₹2000<br>  
                🔹 300 - 450 kg ➝ ₹4500<br><br>
                📢 <strong>Note:</strong> Enter weight between 100kg to 450kg.
            </p>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h2 class="text-center mb-4">Scrap Sell Form</h2>

                <form id="scrapForm">
                    <div class="mb-3">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Scrap Type:</label>
                        <input type="text" class="form-control" id="scrapType" value="Cable" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Address:</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter your address" required>
                    </div>

                    <div class="mb-3">
                        <label>Contact:</label>
                        <input type="text" class="form-control" id="contact" placeholder="Enter your contact" required>
                    </div>

                    <div class="mb-3">
                        <label>Scrap Weight (kg):</label>
                        <input type="number" class="form-control" id="scrapWeight" placeholder="Enter weight" required>
                    </div>

                    <button type="button" class="btn btn-success w-100" onclick="submitScrap()">Sell</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div>
    <?php include('footer.php')?>
</div>

<script>
    function submitScrap() {
        const weight = parseInt(document.getElementById("scrapWeight").value);
        const address = document.getElementById("address").value;
        const contact = document.getElementById("contact").value;
        const scrapType = document.getElementById("scrapType").value;
        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        let amount = 0;

        if (weight >= 100 && weight < 200) {
            amount = 1000;
        } else if (weight >= 200 && weight < 300) {
            amount = 2000;
        } else if (weight >= 300 && weight <= 450) {
            amount = 4500;
        } else {
            alert("Please enter weight between 100kg to 450kg");
            return;
        }

        $.ajax({
            url: "cable.php",
            type: "POST",
            data: {
                scrap_type: scrapType,
                address: address,
                weight: weight,
                amount: amount,
                username: username,
                email: email,
                contact: contact
            },
            success: function (result) {
                if (result.trim() === "success") {
                    alert("Scrap sold successfully!");
                    location.reload();
                } else {
                    alert("Error: " + result);
                }
            },
            error: function () {
                alert("AJAX request failed.");
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
