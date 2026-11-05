<?php
$con = mysqli_connect("localhost", "root", "", "project");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch Recycled Data
$sql = "SELECT * FROM recycled_scrap ORDER BY recycle_date DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycled Scrap Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div>
        <?php include('adminheader.php')?>
</div>
<div class="container mt-5">
    <div class="row" style="padding-bottom:50px;">
        <div class="col-md-12"><br><br>
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Scrap Type</th>
                        <th>Recycled Weight (kg)</th>
                        <th>Recycled Output</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['scrap_type'] ?></td>
                            <td><?= $row['weight'] ?> kg</td>
                            <td><?= $row['recycled_output'] ?></td>
                            <td><?= $row['recycle_date'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$con->close();
?>
