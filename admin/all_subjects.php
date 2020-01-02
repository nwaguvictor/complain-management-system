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
  <h2 class="text-center pb-2 border-bottom mb-5">You're on the Subject page!</h2>
  <div class="row">
    <form action="" method="post" class="col-md-5 mb-2">
        <div class="input-group">
            <input type="text" name="subject" class="form-control" placeholder="E.g School fees">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" name="add"><i class="fa fa-plus"> Add</i></button>
            </div>
        </div>
        <span class="text-danger" id="message"></span>
    </form>

    <?php 
    // Getting subject details
        if (isset($_GET['edit_id'])){
            $edit_id = $_GET['edit_id'];
            $query = $conn->query("select * from subject where subject_id = $edit_id");
            $edit_row = $query->fetch_array();
        ?>
            <form action="" method="post" class="col-md-5 mb-2 pull-right">
                <div class="input-group">
                    <input type="text" name="subject" 
                        value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : $edit_row['subject_name'] ?>"
                        class="form-control" 
                        placeholder="E.g School fees">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success" name="update"><i class="fa fa-check"> Update</i></button>
                    </div>
                </div>
                <span class="text-danger" id="edit_message"></span>
            </form>

    <?php }
    ?>
  </div>


<!-- Showing the subjects in a table -->
  <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Subject Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
    <?php 
        $query = $conn->query("select * from subject order by subject_id desc") or die("Failed to load...try Again!.");
        
        if ($query->num_rows > 0) {
            $cnt = 1;
            while ($rows = $query->fetch_array()) {
                $subject_id = $rows['subject_id'];
        ?>

        <tr>
            <td><?php echo $cnt ?></td>
            <td><?php echo $rows['subject_name'] ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="all_subjects.php?edit_id=<?php echo $subject_id ?>">
                    <i class="fa fa-edit fa-fw"></i>Edit
                </a>

                <a onClick="javascript: return confirm('All complains from this Subject will be delete too')" 
                    class="btn btn-danger btn-sm" href="all_subjects.php?del_id=<?php echo $subject_id ?>">
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
    This is a script that edits the Subject
*/

    if (isset($_POST['update'])) {
        $subject = check_data($_POST['subject']);
        if (empty($subject) || (strlen($subject) < 5)) {
            echo '
                <script>
                    document.getElementById("edit_message").innerHTML = "Enter atleast 5 characters";
                </script>
            ';
        } else {
            $new_subject = $conn->real_escape_string($subject);

            $sql = "update subject set subject_name = '$new_subject' where subject_id = $edit_id";
            $insert_query = $conn->query($sql) or die('Error occurred...try Again!.');
            header("location:all_subjects.php");
            exit();
        }
        
    }
/* 
    This is a script that delete a Subject
*/

    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
/* 
    Delete all complains from this subject and delete the subject too
*/
        $com_query = $conn->query("delete from complain where subject_id = $del_id");

        $query = $conn->query("delete from subject where subject_id = $del_id");
        header("location:all_subjects.php");
        exit();
    }

?>


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
