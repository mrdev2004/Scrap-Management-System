<?php
    $con=mysqli_connect("localhost","root","","project");
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $cpass=$_POST['cpass'];
        if($pass != $cpass)
        {
            echo '<script>alert("Password and Confirm Password Should be Same!!")</script>';
        }
        else
        {
            $sql="update register set username='$name',email='$email',password='$pass',cpassword='$cpass' where id='$id'";
            $result=mysqli_query($con,$sql);
            if($result)
            {
                echo '<script>alert("Register Data is Updated Successfully")</script>';
            }
            else
            {
                echo '<script>alert("No ID found, Enter ID which is available !")</script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
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
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Confirm-Password</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $con=mysqli_connect("localhost","root","","project");
                $sql="select * from register";
                $ans=mysqli_query($con,$sql);
                if($ans)
                {
                    if(isset($_POST['submit']))
                    {
                        while($row=mysqli_fetch_assoc($ans))
                        {
                            $id=$row['id'];
                            $un=$row['username'];
                            $em=$row['email'];
                            $pass=$row['password'];
                            $cpass=$row['cpassword'];
                            echo '
                                <tr>
                                    <th scope="row">'.$id.'</th>
                                    <td>'.$un.'</td>
                                    <td>'.$em.'</td>
                                    <td>'.$pass.'</td>
                                    <td>'.$cpass.'</td>
                                </tr>';
                        }
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
                        <h2 class="text-center text-white" style="font-size:50px;font-family: Arial, Helvetica, sans-serif;">UPDATE DETAILS<h2><br>
                        <div class=row>
                        <div class=col-md-6>
                        <input type=text name=id placeholder="Enter Id to Update Data" class="form-control input-lg" required><br>
                            <input type=email name=email placeholder="Updated Email" class="form-control input-lg" required><br>
                            <input type=password name=cpass placeholder="Confirm Password" class="form-control input-lg" required>
                        </div>
                        <div class=col-md-6>
                            <input type=text name=name placeholder="Updated Username*" class="form-control input-lg" required><br>
                            <input type=text name=pass placeholder="Updated Password" class="form-control input-lg" required><br>
                            <center><input type="submit" name="submit" style="max-width:300px" class="form-control btn-secondary btn-lg text-white" style="font-weight: bold;height:50px;" value="UPDATE DETAILS"></center><br> 
                        </div>
                    </div>
                </div>
        </form>
    </div>
</body>
</html>