<?php
$con = mysqli_connect("localhost", "root", "", "project");

if (isset($_GET['pay_id'])) 
{
    $pay_id = $_GET['pay_id'];

    $sql = "DELETE FROM payment WHERE pay_id='$pay_id'";
    if (mysqli_query($con, $sql)) 
    {
        echo "<script>alert('Record deleted successfully!'); window.location='adminprice.php';</script>";
    } 
    else 
    {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
