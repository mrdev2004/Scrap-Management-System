<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pay WHERE id='$id'";
    if (mysqli_query($con, $sql)) 
    {
        echo "<script>alert('Payment record deleted successfully!'); window.location='adminpmtsucc.php';</script>";
    } 
    else 
    {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
