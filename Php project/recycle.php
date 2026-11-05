<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Recycle Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: grey;
        }
    </style>
</head>
<body>
<div>
    <?php include('adminheader.php')?>
</div>
<div class="container mt-5">
    <h2 class="text-center">Recycle Management</h2>
    <button class="btn btn-light mb-3" data-bs-toggle="modal" data-bs-target="#addRecycleModal">Add New</button>

    <table class="table table-striped table-dark">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Scrap Type</th>
                <th>Weight (kg)</th>
                <th>Before</th>
                <th>After</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $con = mysqli_connect("localhost", "root", "", "project");
            $str = "SELECT * FROM recycle";
            $result = mysqli_query($con, $str);
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['scrap_type']}</td>
                    <td>{$row['weight']} kg</td>
                    <td><img src='{$row['before_image']}' width='100'></td>
                    <td>" . ($row['after_image'] ? "<img src='{$row['after_image']}' width='100'>" : "Not Recycled Yet") . "</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='update_recycle.php?id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                        <a href='delete_recycle.php?pay_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>

                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addRecycleModal">
    <div class="modal-dialog">
        <form action="add_recycle.php" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Scrap for Recycling</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Scrap Type:</label>
                <input type="text" name="scrap_type" class="form-control" required>
                <label>Weight (kg):</label>
                <input type="number" name="weight" class="form-control" required>
                <label>Before Image:</label>
                <input type="file" name="before_image" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
