<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "project");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['payment_id'];
    $scrap_type = $_POST['scrap_type'];
    $address = $_POST['address'];
    $weight = $_POST['weight'];
    $amount = $_POST['amount'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO scrap_payments (payment_id, scrap_type, address, weight, amount, username, email, contact, payment_date) 
            VALUES ('$payment_id', '$scrap_type', '$address', '$weight', '$amount', '$username', '$email', '$contact', NOW())";

    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($con); // Log MySQL error
    }
}

mysqli_close($con);
?>
