<?php
// Database Connection
$con = mysqli_connect("localhost", "root", "", "project");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle Razorpay payment response
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment_id'])) {
    $scrapType = $_POST['scrap_type'];
    $recycledOutput = $_POST['recycled_output'];
    $quantity = $_POST['quantity'];
    $totalPrice = $_POST['total_price'];
    $paymentId = $_POST['payment_id'];

    // Fetch corresponding recycled_scrap record
    $stmt = $con->prepare("SELECT id, weight FROM recycled_scrap WHERE scrap_type = ? AND recycled_output = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("ss", $scrapType, $recycledOutput);
    $stmt->execute();
    $result = $stmt->get_result();
    $scrap = $result->fetch_assoc();

    if ($scrap && $scrap['weight'] >= $quantity) {
        $newWeight = $scrap['weight'] - $quantity;

        // Update recycled_scrap weight
        $updateStmt = $con->prepare("UPDATE recycled_scrap SET weight = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $newWeight, $scrap['id']);
        $updateStmt->execute();

        // Insert payment record
        $insertStmt = $con->prepare("INSERT INTO buyer_payments (scrap_type, recycled_output, quantity, total_price, payment_id) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssids", $scrapType, $recycledOutput, $quantity, $totalPrice, $paymentId);

        if ($insertStmt->execute()) {
            echo "success";
        } else {
            echo "error: " . $insertStmt->error;
        }

        $insertStmt->close();
        $updateStmt->close();
    } else {
        echo "error: insufficient stock";
    }

    $stmt->close();
    $con->close();
    exit();
}

// Fetch recycled data
$query = "SELECT * FROM recycled_scrap ORDER BY id DESC";
$result = $con->query($query);

$recycled_images = [
    "Plastic" => "plastic_recycled.jpg",
    "Office" => "paper_recycled.jpg",
    "Metal" => "metal_recycled.jpg",
    "Construction" => "brick_recycled.jpg",
    "E-scrap" => "ewaste_recycled.jpg",
    "Cable" => "wire_recycled.jpg"
];

$recycled_prices = [
    "Plastic" => 50,
    "Office" => 30,
    "Metal" => 80,
    "Construction" => 40,
    "E-scrap" => 100,
    "Cable" => 60
];

$default_image = "default_recycled.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycled Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .card { margin: 15px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden; }
        .card img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
<div style="margin-bottom: 100px;">
    <?php include('header_buyer.php') ?>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4">Recycled Products</h2>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) {
            $scrapType = $row['scrap_type'];
            $imagePath = isset($recycled_images[$scrapType]) ? $recycled_images[$scrapType] : $default_image;
            $pricePerKg = isset($recycled_prices[$scrapType]) ? $recycled_prices[$scrapType] : 50;
            $available = (int)$row['weight'];
        ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $imagePath ?>" class="card-img-top" alt="Recycled Product">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($scrapType) ?></h5>
                        <p class="card-text">Available Weight: <strong><?= $available ?> kg</strong></p>

                        <p class="card-text">Price per kg: <strong>₹<?= $pricePerKg ?></strong></p>

                        <?php if ($available > 0): ?>
                            <label for="quantity_<?= $row['id'] ?>">Select Quantity:</label>
                            <select class="form-select mb-2" id="quantity_<?= $row['id'] ?>" onchange="updatePrice('<?= $row['id'] ?>', <?= $pricePerKg ?>)">
                                <?php for ($i = 1; $i <= $available; $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                            <p>Total Price: <strong id="total_price_<?= $row['id'] ?>">₹<?= $pricePerKg ?></strong></p>
                            <button class="btn btn-success w-100" onclick="payNow('<?= $row['id'] ?>', '<?= htmlspecialchars($scrapType) ?>', '<?= htmlspecialchars($row['recycled_output']) ?>', <?= $pricePerKg ?>)">Pay Now</button>
                        <?php else: ?>
                            <div class="alert alert-danger mt-3" role="alert">Out of Stock</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function updatePrice(id, pricePerKg) {
        let quantity = parseInt(document.getElementById("quantity_" + id).value);
        document.getElementById("total_price_" + id).innerText = "₹" + (pricePerKg * quantity);
    }

    function payNow(id, scrapType, recycledOutput, pricePerKg) {
        let quantity = parseInt(document.getElementById("quantity_" + id).value);
        let totalPrice = pricePerKg * quantity;

        let options = {
            "key": "rzp_test_sukKHXBZu03AxG",
            "amount": totalPrice * 100,
            "currency": "INR",
            "name": "Scrap Management",
            "description": `Buying ${quantity} units of ${recycledOutput} from ${scrapType}`,
            "handler": function (response) {
                $.post("", {
                    payment_id: response.razorpay_payment_id,
                    scrap_type: scrapType,
                    recycled_output: recycledOutput,
                    quantity: quantity,
                    total_price: totalPrice
                }, function(data) {
                    if (data.trim() === "success") {
                        generateInvoice(response.razorpay_payment_id, scrapType, recycledOutput, quantity, totalPrice);
                        alert("Payment successful. Invoice downloaded.");
                        setTimeout(() => location.reload(), 1000); // Refresh after update
                    } else {
                        alert("Error: " + data);
                    }
                });
            },
            "theme": { "color": "#3399cc" }
        };

        new Razorpay(options).open();
    }

function generateInvoice(paymentId, scrapType, recycledOutput, quantity, totalPrice) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Colors
    const primaryColor = "#007bff";  // Bootstrap primary
    const secondaryColor = "#6c757d";  // Bootstrap secondary

    // Title
    doc.setTextColor(primaryColor);
    doc.setFont("helvetica", "bold");
    doc.setFontSize(20);
    doc.text("Eco Recycle Center", 70, 20);

    doc.setDrawColor(0);
    doc.setLineWidth(0.5);
    doc.line(20, 25, 190, 25);

    doc.setFontSize(14);
    doc.setTextColor(0, 0, 0);
    doc.setFont("helvetica", "bold");
    doc.text("Payment Invoice", 80, 35);

    // Date and Invoice ID
    const date = new Date().toLocaleString();
    doc.setFont("helvetica", "normal");
    doc.setFontSize(10);
    doc.setTextColor(secondaryColor);
    doc.text(`Date: ${date}`, 20, 45);
    doc.text(`Invoice ID: ${paymentId}`, 150, 45);

    // Section Box
    doc.setDrawColor(200);
    doc.rect(20, 50, 170, 60);

    let y = 60;
    doc.setFontSize(12);
    doc.setTextColor(0);

    doc.setFont("helvetica", "normal");
    doc.text("Scrap Type:", 30, y);
    doc.setFont("helvetica", "bold");
    doc.text(scrapType, 80, y);

    y += 10;
    doc.setFont("helvetica", "normal");
    doc.text("Quantity:", 30, y);
    doc.setFont("helvetica", "bold");
    doc.text(`${quantity} kg`, 80, y);

    y += 10;
    doc.setFont("helvetica", "normal");
    doc.text("Total Price:", 30, y);
    doc.setFont("helvetica", "bold");
    doc.setTextColor("#28a745"); // Bootstrap green
    doc.text(`Rs.${totalPrice}`, 80, y);

    // Footer
    doc.setTextColor(secondaryColor);
    doc.setFontSize(10);
    doc.setFont("helvetica", "italic");
    doc.text("This is a system-generated invoice. For queries, contact support@eco-recycle.com", 20, 130);
    doc.setTextColor(primaryColor);
    doc.text("Thank you for supporting recycling products!", 70, 140);

    doc.save(`Invoice_${paymentId}.pdf`);
}
</script>

</body>
</html>
<?php $con->close(); ?>
