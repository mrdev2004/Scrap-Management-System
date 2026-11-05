<?php
// Database Connection
$con = mysqli_connect("localhost", "root", "", "project");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch total weight for each scrap type
$scrap_weights = [];
$query = "SELECT scrap_type, SUM(weight) AS total_weight FROM scrap_payments GROUP BY scrap_type";
$result = $con->query($query);

while ($row = $result->fetch_assoc()) {
    $scrap_weights[$row['scrap_type']] = $row['total_weight'];
}

// Handle Recycling Request
$recycleMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['scrap_type']) && isset($_POST['weight'])) {
    $scrap_type = $_POST['scrap_type'];
    $weight = intval($_POST['weight']);

    if ($weight > 0) {
        // Conversion Logic
        $conversion = [
            "Plastic" => $weight * 5 . " Bottles",
            "Metal" => $weight * 3 . " Metal Rods",
            "Cable" => $weight * 2 . " Meters of Wire",
            "E-scrap" => $weight * 1 . " Recycled Circuits",
            "Construction" => $weight * 4 . " Bricks",
            "Office" => $weight * 20 . " Sheets of Recycled Paper"
        ];
        $recycled_output = $conversion[$scrap_type] ?? "Unknown Output";

        // Reduce weight in scrap_payments table
        $updateScrap = $con->prepare("UPDATE scrap_payments SET weight = weight - ? WHERE scrap_type = ? AND weight >= ? LIMIT 1");
        $updateScrap->bind_param("isi", $weight, $scrap_type, $weight);
        $updateScrap->execute();

        // Check if weight was updated
        if ($updateScrap->affected_rows > 0) {
            // Check if the scrap type already exists in the recycled_scrap table
            $checkQuery = "SELECT weight FROM recycled_scrap WHERE scrap_type = ?";
            $stmt = $con->prepare($checkQuery);
            $stmt->bind_param("s", $scrap_type);
            $stmt->execute();
            $result = $stmt->get_result();
            $existingRecord = $result->fetch_assoc();
            $stmt->close();

            if ($existingRecord) {
                // Update existing record
                $newWeight = $existingRecord['weight'] + $weight;
                $updateQuery = "UPDATE recycled_scrap SET weight = ?, recycled_output = ? WHERE scrap_type = ?";
                $stmt = $con->prepare($updateQuery);
                $stmt->bind_param("iss", $newWeight, $recycled_output, $scrap_type);
                $stmt->execute();
                $stmt->close();
            } else {
                // Insert new record if scrap type does not exist
                $insertQuery = "INSERT INTO recycled_scrap (scrap_type, weight, recycled_output) VALUES (?, ?, ?)";
                $stmt = $con->prepare($insertQuery);
                $stmt->bind_param("sis", $scrap_type, $weight, $recycled_output);
                $stmt->execute();
                $stmt->close();
            }

            $recycleMessage = "Scrap Type: $scrap_type\nWeight: $weight kg\nRecycled into: $recycled_output\nSuccessfully sent for recycling!";
        } else {
            $recycleMessage = "Insufficient available scrap weight for $scrap_type to recycle $weight kg.";
        }
        $updateScrap->close();
    }
}

// Refresh weights after recycling
$scrap_weights = [];
$query = "SELECT scrap_type, SUM(weight) AS total_weight FROM scrap_payments GROUP BY scrap_type";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
    $scrap_weights[$row['scrap_type']] = $row['total_weight'];
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recycle Scrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .card { text-align: center; margin: 15px; }
        .weight-counter { font-size: 20px; font-weight: bold; width: 60px; text-align: center; }
    </style>
</head>
<body>
<div>
    <?php include('adminheader.php'); ?>
</div>

<div class="container mt-5">
    <h2 class="text-center">Recycle Scrap</h2>
    <div class="row">
        <?php 
        $scrap_types = ["E-scrap", "Construction", "Office", "Cable", "Plastic", "Metal"];
        foreach ($scrap_types as $type): 
            $max_weight = isset($scrap_weights[$type]) ? $scrap_weights[$type] : 0;
        ?>
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4><?= $type ?></h4>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-danger btn-sm" onclick="updateWeight('<?= $type ?>', -1, <?= $max_weight ?>)">-</button>
                    <input type="text" class="weight-counter mx-2" id="<?= $type ?>_weight" value="0" oninput="validateWeight('<?= $type ?>', <?= $max_weight ?>)">
                    <button class="btn btn-success btn-sm" onclick="updateWeight('<?= $type ?>', 1, <?= $max_weight ?>)">+</button>
                </div>
                <p class="mt-2 text-muted">Total Scrap Added: <span id="<?= $type ?>_total"><?= $max_weight ?></span> kg</p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="scrap_type" value="<?= $type ?>">
                    <input type="hidden" id="<?= $type ?>_hidden_weight" name="weight" value="0">
                    <button type="submit" class="btn btn-dark mt-2">Recycle</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="recycleModal" tabindex="-1" role="dialog" aria-labelledby="recycleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recycling Status</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="recycleMessage"><?= nl2br($recycleMessage) ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let message = $("#recycleMessage").text().trim();
        if (message !== "") {
            $("#recycleModal").modal("show");
        }

        // Ensure modal closes when the close button is clicked
        $(".modal .close, .btn-secondary").on("click", function() {
            $("#recycleModal").modal("hide");
        });
    });
</script>
<script>
    function updateWeight(type, change, maxWeight) {
        let weightInput = document.getElementById(type + "_weight");
        let hiddenInput = document.getElementById(type + "_hidden_weight");
        let totalDisplay = document.getElementById(type + "_total");
        let current = parseInt(weightInput.value) || 0;
        let newWeight = current + change;

        if (newWeight < 0) newWeight = 0;
        if (newWeight > maxWeight) {
            alert("Cannot exceed available weight (" + maxWeight + " kg)");
            return;
        }

        weightInput.value = newWeight;
        hiddenInput.value = newWeight;
        totalDisplay.innerText = maxWeight - newWeight;
    }

    function validateWeight(type, maxWeight) {
        let weightInput = document.getElementById(type + "_weight");
        let hiddenInput = document.getElementById(type + "_hidden_weight");
        let totalDisplay = document.getElementById(type + "_total");
        let entered = parseInt(weightInput.value) || 0;

        if (entered < 0 || isNaN(entered)) {
            weightInput.value = 0;
            hiddenInput.value = 0;
            totalDisplay.innerText = maxWeight;
        } else if (entered > maxWeight) {
            alert("Cannot exceed available weight (" + maxWeight + " kg)");
            weightInput.value = maxWeight;
            hiddenInput.value = maxWeight;
            totalDisplay.innerText = 0;
        } else {
            hiddenInput.value = entered;
            totalDisplay.innerText = maxWeight - entered;
        }
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
