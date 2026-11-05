<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "project");

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

    $scrap_type = $_POST['scrap_type'] ?? '';
    $recycled_output = $_POST['recycled_output'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $total_price = $_POST['total_price'] ?? '';
    $payment_id = $_POST['payment_id'] ?? '';

    if (empty($scrap_type) || empty($recycled_output) || empty($quantity) || empty($total_price) || empty($payment_id)) 
    {
        die("Missing required fields");
    }

    $sql = "INSERT INTO admin_payments (scrap_type, recycled_output, quantity, total_price, payment_id, payment_date) 
            VALUES ('$scrap_type', '$recycled_output', '$quantity', '$total_price', '$payment_id', NOW())";

    if (mysqli_query($con, $sql)) 
    {
        echo "success";
    } 
    else 
    {
        echo "Database Error: " . mysqli_error($con);
    }


mysqli_close($con);
?>
