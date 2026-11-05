<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background: #000000;
            padding: 15px 20px; /* Increased padding for better spacing */
        }

        .nav-item {
            margin: 0 15px; /* Add spacing between nav items */
        }

        .nav-item::after {
            content: '';
            display: block;
            width: 0px;
            height: 2px;
            background: #ffffff;
            transition: 0.4s;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .navbar-dark .navbar-nav .active>.nav-link,
        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link.show,
        .navbar-dark .navbar-nav .show>.nav-link,
        .navbar-dark .navbar-nav .nav-link:focus,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        .nav-link {
            padding: 15px 20px; /* Increased padding for better spacing */
            transition: 0.2s;
        }

        body {
            background-color: grey;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active px-3" aria-current="page" href="adminhome.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link px-3" href="pay.php">Seller Payment</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link px-3" href="deletereg.php">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="adminfeedback.php">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="add_re.php">Recycle Scrap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="show_recycled_data.php">Show Recycled Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="login.php">Logout</a>
                    </li>
                </ul>   
            </div>
        </div>
    </nav>
</body>
</html>
