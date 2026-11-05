<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "project");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer

    // Check if the record exists before deleting
    $check = mysqli_query($con, "SELECT * FROM recycle WHERE id='$id'");
    if (mysqli_num_rows($check) == 0) {
        echo "<script>alert('Record not found'); window.location.href='recycle.php';</script>";
        exit;
    }

    // Delete the record
    $query = "DELETE FROM recycle WHERE id='$id'";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Deleted successfully'); window.location.href='recycle.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . mysqli_error($con) . "'); window.location.href='recycle.php';</script>";
    }
}
?>