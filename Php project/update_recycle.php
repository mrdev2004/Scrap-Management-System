<?php
$con = mysqli_connect("localhost", "root", "", "project");
$id = $_GET['id'];
$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM recycle WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status = $_POST['status'];
    if (!empty($_FILES["after_image"]["name"])) {
        $after_image = "uploads/" . basename($_FILES["after_image"]["name"]);
        move_uploaded_file($_FILES["after_image"]["tmp_name"], $after_image);
        $query = "UPDATE recycle SET status='$status', after_image='$after_image' WHERE id=$id";
    } else {
        $query = "UPDATE recycle SET status='$status' WHERE id=$id";
    }
    mysqli_query($con, $query);
    header("Location: recycle.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recycle Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h4 class="text-center text-muted">Update Recycle Status</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending" <?= $result['status'] == "Pending" ? "selected" : "" ?>>Pending</option>
                            <option value="In Process" <?= $result['status'] == "In Process" ? "selected" : "" ?>>In Process</option>
                            <option value="Recycled" <?= $result['status'] == "Recycled" ? "selected" : "" ?>>Recycled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">After Image (if recycled):</label>
                        <input type="file" name="after_image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
