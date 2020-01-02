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

<?php 
    function check_data($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;

    }


        if (isset($_POST['send'])) {
            $subject = $_POST['subject'];
            $title = check_data($_POST['title']);
            $complain = check_data($_POST['complain']);
            $user = $_SESSION['user']['username'];

            // fetch user_id
            $query = $conn->query("select * from users where username = '$user'") or die("Failed! ".$conn->error);
            $user_details = $query->fetch_array();
            $complainant_id = $user_details['user_id'];
            $file = $_FILES['file']['name'];
            $tmp_file = $_FILES['file']['tmp_name'];

            if (!empty($file)) {
                move_uploaded_file($tmp_file, "images/$file");
            } else {
                $file = 'no file';
            }

            $new_title = $conn->real_escape_string($title);
            $new_complain = $conn->real_escape_string($complain);

            $insert_sql = "insert into complain(complainant_id,subject_id,title,content,file,status,date) 
                        values($complainant_id, $subject, '$new_title', '$new_complain', '$file', 'Pending', now())";
            $insert_query = $conn->query($insert_sql) or die("Error occured... try Again!");
            header('location:user_complains.php');
            exit();
            
        }

?>



    <div class="container-fluid mb-5">
        <h2 class="text-center border-bottom pb-2">You're on the complain page</h2>

        <div class="col-md-6 mx-auto p-4 shadow my-3">
        <h3 class="text-center mb-2 pb-2 border-bottom">Make A Complain</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="subject" class="form-control form-control-sm" id="" required>
                        <option value=""selected>Choose Subject</option>
                    <?php 
                        $subjects = $conn->query("select * from subject");
                        while ($list = $subjects->fetch_array()) {
                    ?>
                        <option value="<?php echo $list['subject_id'] ?>" ><?php echo $list['subject_name'] ?></option>

                    <?php    }
                    ?>
                        <option value="0">Others</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control form-control-sm" name="title" 
                        placeholder="E.g Security Issues" required>
                </div>

                <div class="form-group">
                    <label for="file">Evidence (Optional)</label>
                    <input type="file" name="file" class="d-flex flex-column">
                </div>

                <div class="form-group">
                    <label for="complain">Complain:</label>
                    <textarea name="complain" id="" 
                        cols="30" rows="10" 
                        class="form-control form-control-sm" placeholder="Type complain here..." required></textarea>
                </div>

                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Cancel">
                    <input type="submit" class="btn btn-success pull-right" name="send" value="Submit">
                </div>
            </form>
        </div>


    </div>
    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
