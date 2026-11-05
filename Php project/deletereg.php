<?php
$con = mysqli_connect("localhost", "root", "", "project");

$toastMessage = ""; // To hold toast message
$toastClass = ""; // To hold the toast class (success/error)

if (isset($_POST['delete'])) {   
    $id = $_POST['id'];
    $sql = "DELETE FROM register WHERE id=$id";
    $ans = mysqli_query($con, $sql);
    
    if ($ans) {
        $toastMessage = "Deleted Successfully";
        $toastClass = "bg-success"; // Green for success
    } else {
        $toastMessage = "No ID found, Enter ID which is available!";
        $toastClass = "bg-danger"; // Red for error
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div>
    <?php include('adminheader.php')?>
</div>
<div style="padding-top:50px;">
    <h1 class="text-dark text-center">Registrations</h1><br>
    <center>
    <table class="table table-striped table-dark" style="max-width:96%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">User Type</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="SELECT * FROM register";
            $ans=mysqli_query($con,$sql);
            if($ans)
            {
                while($row=mysqli_fetch_assoc($ans))
                {
                    $id = $row['id'];
                    $un = $row['username'];
                    $em = $row['email'];
                    $user_type = $row['user_type']; // Fetching the user type
                    $pass = $row['password'];
                    echo '
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$un.'</td>
                            <td>'.$em.'</td>
                            <td>'.$user_type.'</td>
                            <td>'.$pass.'</td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>';
                }
            }
        ?>
        </tbody>
    </table>
    </center>
</div>

<!-- Bootstrap Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    <?php if ($toastMessage): ?>
        <div class="toast align-items-center text-white <?php echo $toastClass; ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $toastMessage; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Hide the toast after 3 seconds
    setTimeout(() => {
        let toast = document.querySelector(".toast");
        if (toast) toast.classList.remove("show");
    }, 3000);
</script>
</body>
</html>
