<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="wrapper">
        <h2 class="text-center p-2 border-bottom">Welcome, Thank you for Joining Us</h2>

        <div class="col-md-6 mt-5 mx-auto shadow p-4">
            <h2 class="text-center border-bottom pb-1 mb-4">Registration Area</h2>
            <!-- <div class="alert alert-info alert-dismissible fade show">
                <button type="button" data-dismiss="alert" class="close">&times</button>
                <strong id="info"></strong>
            </div> -->

            <span id="info" class="text-danger text-center d-block"></span>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="exampleuser123">
                    <span id="user_error"></span>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="exampleuser@email.com">
                    <span id="email_error"></span>
                </div>

                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="************">
                    <span id="pass_error"></span>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remeber" class=""> <a href="">Terms and Conditions</a>
                    <p class="pull-right">Already registered? <a href="index.php">Sign in</a></p>
                </div>

                <div class="form-group">
                    <input type="submit" name="register" value="Sign Up" class="form-control btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

    
<!-- Registration form validation -->
    <?php 
        if (isset($_POST['register'])) {
            if (!empty($_POST['username']) && !empty($_POST['email'])) {

                $username   = $_POST['username'];
                $email      = $_POST['email'];
                $password   = $_POST['password'];

                if ((strlen($password)) < 5) {
                    echo '
                        <script>
                            document.getElementById("pass_error").innerHTML = "Password must be greater than 4 charaters";
                        </script>
                    ';
                }

                $check_user_exist = "select * from users where username = '$username' or email = '$email'";
                $query = $conn->query($check_user_exist) or die("Error..." .$conn->error);
                if ($query->num_rows > 0) {
                    echo '<script>
                        document.getElementById("info").innerHTML = "User already exist... try Again";
                    </script>';
                } else {
                    $sql = "insert into users(username,email,password,role) 
                        values('$username', '$email','$password','user')";
                    $insert_query = $conn->query($sql) or die("Error Occurred... ".$conn->error);
                    header("location:index.php");
                    exit();
                }
            }else {
                echo '
                    <script>
                        document.getElementById("info").innerHTML = "Fields Can\'t be empty";
                    </script>
                ';
            }


        }

    ?>