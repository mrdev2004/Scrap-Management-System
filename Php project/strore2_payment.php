<?php
session_start();
$con=mysqli_connect("localhost","root","","project"); // Ensure this includes your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['payment_id'];
    $scrap_type = $_POST['scrap_type'];
    $weight = $_POST['weight'];
    $amount = $_POST['amount'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $payment_date = date('Y-m-d H:i:s'); // Get current date & time

    // Insert into scrap_payments table
    $query = "INSERT INTO scrap_payments (payment_id, scrap_type, weight, amount, username, email, address, contact, payment_date) 
              VALUES ('$payment_id', '$scrap_type', '$weight', '$amount', '$username', '$email', '$address', '$contact', '$payment_date')";

    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
?>
