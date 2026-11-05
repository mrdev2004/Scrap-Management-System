<?php
$con=mysqli_connect("localhost","root","","project");


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $scrap_type = $_POST['scrap_type'];
    $weight = $_POST['weight'];

    // Debugging: Print uploaded file details
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Check for upload errors
    if ($_FILES["before_image"]["error"] !== UPLOAD_ERR_OK) 
    {
        die("File upload error! Code: " . $_FILES["before_image"]["error"]);
    }

    // Ensure 'uploads/' folder exists
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) 
    {
        mkdir($target_dir, 0777, true);
    }

    // Generate unique file name
    $before_image = $target_dir . time() . "_" . basename($_FILES["before_image"]["name"]);

    // Move the uploaded file
    if (move_uploaded_file($_FILES["before_image"]["tmp_name"], $before_image)) 
    {
        // Save to database
        $query = "INSERT INTO recycle (scrap_type, weight, before_image) VALUES ('$scrap_type', '$weight', '$before_image')";
        if (mysqli_query($con, $query)) 
        {
            header("Location: recycle.php?success=1");
            exit;
        } 
        else 
        {
            echo "Database Error: " . mysqli_error($con);
        }
    } 
    else 
    {
        echo "File move failed!";
    }
} 
else 
{
    echo "Invalid Request!";
}

?>
