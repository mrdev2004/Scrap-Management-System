<?php
if (!isset($_GET['pay_id']) || !isset($_GET['username'])) 
{
    die("Invalid Request!");
}

$pay_id = $_GET['pay_id'];
$username = $_GET['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">पैकेज चुनें</h2>
                <form id="paymentForm" method="post">
                    <div class="mb-3">
                        <label for="package" class="form-label">योजना चुनें:</label>
                        <select id="package" class="form-select" required>
                            <option value="0" data-amount="0">निःशुल्क (₹0)</option>
                            <option value="299" data-amount="29900">मानक (₹299)</option>
                            <option value="399" data-amount="39900">प्रीमियम (₹399)</option>
                        </select>
                    </div>
                    <input type="hidden" id="pay_id" value="<?php echo $pay_id; ?>">
                    <input type="hidden" id="username" value="<?php echo $username; ?>">
                    <button type="button" class="btn btn-primary w-100" onclick="payNow()">अब भुगतान करें</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function payNow() 
{
    let package = document.getElementById("package");
    let username = document.getElementById("username").value;
    let pay_id = document.getElementById("pay_id").value;
    let amount = package.options[package.selectedIndex].getAttribute("data-amount");

    if (amount == "0") 
    {
        alert("Free package selected. No payment required.");
        window.location.href = "success.php?pay_id=" + pay_id + "&username=" + username + "&amount=0";
        return;
    }

    var options = 
    {
        "key": "rzp_test_sukKHXBZu03AxG",
        "amount": amount,
        "currency": "INR",
        "name": "Scrap Management",
        "description": "Payment for Scrap Management",
        "handler": function (response) 
        {
            window.location.href = "success.php?pay_id=" + pay_id + "&username=" + username + "&amount=" + (amount / 100);
        },
        "prefill": 
        {
            "name": username
        },
        "theme": 
        {
            "color": "#007bff"
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
}
</script>

</body>
</html>
