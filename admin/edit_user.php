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


  <?php 
    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        $query = $conn->query("select * from users where user_id = $edit_id");
        $rows = $query->fetch_assoc();
    }
  
  ?>

    <!-- Main content -->
<div class="content">
<h2 class="text-center p-2 border-bottom">Edit A New User</h2>

    <div class="col-md-6 mt-5 mx-auto shadow p-4">
        <!-- <div class="alert alert-info alert-dismissible fade show">
            <button type="button" data-dismiss="alert" class="close">&times</button>
            <strong id="info"></strong>
        </div> -->

        <span id="info" class="text-danger text-center d-block"></span>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" name="username" 
                    class="form-control form-control-sm"
                    value="<?php echo isset($_POST['username']) ? $_POST['username'] : $rows['username'] ?>" 
                    placeholder="exampleuser123">
                <span id="user_error"></span>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control form-control-sm"
                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : $rows['email'] ?>" 
                    placeholder="exampleuser@email.com">
                <span id="email_error"></span>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="" class="form-control form-control-sm">
                <option value="<?php echo $rows['role'] ?>"><?php echo $rows['role'] ?></option>
                    <?php 
                        if ($rows['role'] == 'admin') {
                            echo '<option value="user">user</option>';
                        } else {
                            echo '<option value="admin">admin</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Password:</label>
                <input type="password" name="password" 
                    class="form-control form-control-sm"
                    value="<?php echo isset($_POST['password']) ? $_POST['password'] : $rows['password'] ?>" 
                    placeholder="************">
                <span id="pass_error"></span>
            </div>

            <div class="form-group">
                <input type="submit" name="update_user" value="Update User" class="form-control btn btn-success">
            </div>
        </form>
    </div>
    

    
<!-- Registration form validation -->
    <?php 
        if (isset($_POST['update_user'])) {
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
                }else{

                    $sql = "update users set username = '$username', email = '$email', role = '$password', role = '$role' where user_id = $edit_id";
                    $update_query = $conn->query($sql) or die("Error Occurred... ".$conn->error);
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
