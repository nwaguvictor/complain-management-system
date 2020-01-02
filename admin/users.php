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

  <div class="container-fluid">
  <h2 class="text-center pb-2 border-bottom mb-5">You're on the List Of Users page!</h2>
  <a class="btn btn-primary btn-sm mb-2 mr-2 pull-right" href="add_user.php"><i class="fa fa-plus fa-fw"></i> Add</a>
 


<!-- Showing the users in a table -->
  <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
    <?php 
        $query = $conn->query("select * from users order by user_id desc") or die("Failed to load...try Again!.");
        
        if ($query->num_rows > 0) {
            $cnt = 1;
            while ($rows = $query->fetch_array()) {
                $user_id = $rows['user_id'];
        ?>

        <tr>
            <td><?php echo $cnt ?></td>
            <td><?php echo $rows['username'] ?></td>
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['role'] ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="edit_user.php?edit_id=<?php echo $user_id ?>">
                    <i class="fa fa-edit fa-fw"></i>Edit
                </a>

                <a onClick="javascript: return confirm('Deleting user will delete all complains')" 
                    class="btn btn-danger btn-sm" href="users.php?del_user_id=<?php echo $user_id ?>">
                    <i class="fa fa-times fa-fw"></i>Delete
                </a>
            </td>
        </tr>

    


        <?php   $cnt++; }

        } else {
            echo '<h2 class="text-danger text-center">No Record found</h2>';
        }
        
    
    ?>

                </tbody>
            </table>
        </div>
    </div>


    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->
<?php

/* 
    This is a script that Adds a Subject
*/
    function check_data($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['add'])) {
        $subject = check_data($_POST['subject']);
        if (empty($subject) || (strlen($subject) < 5)) {
            echo '
                <script>
                    document.getElementById("message").innerHTML = "Enter atleast 5 characters";
                </script>
            ';
        } else {
            $new_subject = $conn->real_escape_string($subject);

            $sql = "insert into subject(subject_name) values('$new_subject')";
            $insert_query = $conn->query($sql) or die('Error occurred...try Again!.');
            header("location:all_subjects.php");
            exit();
        }
        
    }

/* 
    This is a script that delete a Subject
*/

    if (isset($_GET['del_user_id'])) {
        $del_user_id = $_GET['del_user_id'];
/* 
    Delete all complains from this subject and delete the subject too
*/
        $com_query = $conn->query("delete from complain where complainant_id = $del_user_id");

        $query = $conn->query("delete from users where user_id = $del_user_id");
        header("location:users.php");
        exit();
    }

?>


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
