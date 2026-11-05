<?php
    $con=mysqli_connect("localhost","root","","project");
    if(isset($_POST['submit']))
    {   
        echo '<script>alert("Are you sure you want to delete?");</script>';
        $id=$_POST['id'];
        $sql="delete from quote where id=$id";
        $ans=mysqli_query($con,$sql);
        if($ans)
        {
            echo '<script>alert("Deleted Successfully");</script>';
        }
        else
        {
            echo '<script>alert("No ID found, Enter ID which is available !");</script>';
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
</head>
<body>
    <div>
        <?php include('adminheader.php')?>
    </div>
    <div style="padding-top:50px;">
        <h1 class="text-dark text-center" >Registrations</h1><br>
        <center>
        <table class="table table-striped table-dark" style="max-width:96%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Business Type</th>
                    <th scope="col">Pickup Address</th>
                    <th scope="col">Scrap Detail</th>
                    <th scope="col">Scrap Material</th>
                    <th scope="col">Weight</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $con=mysqli_connect("localhost","root","","project");
                $sql="select * from quote";
                $ans=mysqli_query($con,$sql);
                if($ans)
                {
                    while($row=mysqli_fetch_assoc($ans))
                    {
                        $id=$row['id'];
                        $un=$row['name'];
                        $ph=$row['phone'];
                        $em=$row['email'];
                        $b=$row['business'];
                        $loc=$row['location'];
                        $detail=$row['scrapdetail'];
                        $mat=$row['scrapmaterial'];
                        $weight=$row['weight'];
                        echo '<tr>
                                <th scope="row">'.$id.'</th>
                                <td>'.$un.'</td>
                                <td>'.$ph.'</td>
                                <td>'.$em.'</td>
                                <td>'.$b.'</td>
                                <td>'.$loc.'</td>
                                <td>'.$detail.'</td>
                                <td>'.$mat.'</td>
                                <td>'.$weight.'</td>
                            </tr>';
                    }
                }
            ?>
            </tbody>
        </table>
        </center>
        <form method=post>
            <br>
            <div class=row style="padding-bottom:40px">
                <div class=col-md-2></div>
                <div class="col-md-8 bg-dark" style="border-radius:20px">
                    <br><br>
                    <h2 class="text-center text-white" style="font-size:50px;font-family: Arial, Helvetica, sans-serif;">DELETE DETAILS<h2><br>
                    <div class=row>
                        <div class=col-md-6>
                            <select class="form-select form-select-lg mb-3" name=id aria-label=".form-select-lg example">
                                <option selected>Select ID</option>
                                <?php
                                    $con=mysqli_connect("localhost","root","","project");
                                    $sql="select id from quote";
                                    $ans=mysqli_query($con,$sql);
                                    if($ans)
                                    {
                                        while($row=mysqli_fetch_assoc($ans))
                                        {
                                            $id=$row['id'];
                                            echo '<option value="'.$id.'">'.$id.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class=col-md-6>
                            <center><input type="submit" name="submit" style="max-width:300px" class="form-control btn-secondary btn-lg text-white" style="font-weight: bold;height:50px;" value="Delete"></center><br> 
                        </div>
                    </div>
                </div>
            </div>
       </form>
    </div>
</body>
</html>