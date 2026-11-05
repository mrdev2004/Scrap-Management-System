<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "project");

// Check if connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch pending scrap inquiries
$query = "SELECT * FROM payment WHERE pay_id NOT IN (SELECT scrap_id FROM recycled_scrap)";
$result = mysqli_query($con, $query);

if (isset($_POST['recycle'])) {
    $scrap_id = $_POST['scrap_id'];
    $buyer_username = $_POST['buyer_username'];

    // File Upload Handling
    $recycled_image = $_FILES['recycled_image']['name'];
    $target = "uploads/" . basename($recycled_image);
    
    // Check if file is uploaded properly
    if ($_FILES['recycled_image']['error'] === 0) {
        if (move_uploaded_file($_FILES['recycled_image']['tmp_name'], $target)) {
            // Insert data into the database
            $sql = "INSERT INTO recycled_scrap (scrap_id, admin_id, buyer_username, recycled_image, status, recycled_date) 
                    VALUES ('$scrap_id', '1', '$buyer_username', '$recycled_image', 'Completed', NOW())";
            
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Scrap Recycled Successfully!'); window.location='admin_recyele.php';</script>";
            } else {
                echo "<script>alert('Database Insert Error: " . mysqli_error($con) . "');</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded file.');</script>";
        }
    } else {
        echo "<script>alert('Error in file upload: " . $_FILES['recycled_image']['error'] . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recycle Scrap</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Recycling Scrap</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Scrap ID</th>
                    <th>Username</th>
                    <th>Scrap Type</th>
                    <th>Weight</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['pay_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['scrap_type']; ?></td>
                    <td><?php echo $row['weight']; ?> kg</td>
                    <td>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="scrap_id" value="<?php echo $row['pay_id']; ?>">
                            <input type="hidden" name="buyer_username" value="<?php echo $row['username']; ?>">
                            <input type="file" name="recycled_image" required>
                            <button type="submit" name="recycle" class="btn btn-success">Recycle</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
