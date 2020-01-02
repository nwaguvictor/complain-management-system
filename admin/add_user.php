<?php include 'admin_partials/header.php' ?>
<?php 
  if (!isset($_SESSION['user'])) {
    header('location:../index.php');
    exit();
  }

?>

<div class="wrapper">

  <!-- Navbar -->
  <?php include 'admin_partials/top-navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include 'admin_partials/main-sidebar.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
<div class="content">
<h2 class="text-center p-2 border-bottom">Add A New User</h2>

    <div class="col-md-6 mt-5 mx-auto shadow p-4">
        <!-- <div class="alert alert-info alert-dismissible fade show">
            <button type="button" data-dismiss="alert" class="close">&times</button>
            <strong id="info"></strong>
        </div> -->

        <span id="info" class="text-danger text-center d-block"></span>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" name="username" class="form-control form-control-sm" placeholder="exampleuser123">
                <span id="user_error"></span>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control form-control-sm" placeholder="exampleuser@email.com">
                <span id="email_error"></span>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="" class="form-control form-control-sm">
                    <option value="admin">Admin</option>
                    <option value="user" selected>User</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Password:</label>
                <input type="password" name="password" class="form-control form-control-sm" placeholder="************">
                <span id="pass_error"></span>
            </div>

            <div class="form-group">
                <input type="submit" name="add_user" value="Add User" class="form-control btn btn-success">
            </div>
        </form>
    </div>
    

    
<!-- Registration form validation -->
    <?php 
        if (isset($_POST['add_user'])) {
            if (!empty($_POST['username']) && !empty($_POST['email'])) {

                $username   = $_POST['username'];
                $role   = $_POST['role'];
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
                        values('$username', '$email','$password','$role')";
                    $insert_query = $conn->query($sql) or die("Error Occurred... ".$conn->error);
                    header("location:users.php");
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
  


    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
