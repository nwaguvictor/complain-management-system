<?php include("includes/header.php"); ?>
<?php 
    if (isset($_SESSION['user']['username'])) {
        header("location:admin");
        exit();
    }
?>
    

<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="wrapper">
        <h2 class="text-center p-2 border-bottom">Welcome!!! Please Login to continue...</h2>

        <div class="col-md-6 mt-5 mx-auto shadow p-4">
            <h2 class="text-center border-bottom pb-1 mb-4">Login Area</h2>
            <span class="text-danger text-center d-block" id="error"></span>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="exampleuser123">
                </div>

                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="************">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remeber" class=""> <a href="">Terms and Conditions</a>
                    <a class="pull-right" href="">Forgotten password?</a>
                </div>

                <div class="form-group">
                    <input type="reset" name="login" value="Clear" class="btn btn-danger">
                    <input type="submit" name="login" value="Login" class="btn btn-success pull-right">
                </div>

                <p class="border-bottom pb-1 text-center">New User? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</div>





<?php include("includes/footer.php"); ?>

<!-- Login User Script -->
<?php 
    if (isset($_POST['login'])) {
        $username   = $_POST['username'];
        $password   = $_POST['password'];

        $new_user = $conn->real_escape_string($username);
        $new_pass = $conn->real_escape_string($password);

        $sql = "select * from users where username = '$new_user' and password = '$new_pass'";
        $query = $conn->query($sql) or die("Login Error...try Again! ".$conn->error);
        if ($query->num_rows == 1) {
            $rows = $query->fetch_array();
            $_SESSION['user'] = $rows;
            header("location:admin");
            exit();
        } else {
            echo '
                <script>
                    document.getElementById("error").innerHTML = "Username or password wrong";
                </script>
            ';
        }
    }

?>