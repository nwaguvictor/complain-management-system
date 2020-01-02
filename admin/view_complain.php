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

    <div class="container-fluid mb-5">
        <h2 class="text-center border-bottom pb-2">Your Complain Details</h2>

        <div class="col-md-8 mx-auto p-4 shadow my-5">
        
        <?php
            function subject($id) {
                global $conn;
                $query = $conn->query("select * from subject where subject_id = $id");
                $row = $query->fetch_assoc();

                return $row['subject_name'];
            }

            if (isset($_GET['com_id'])) {
                $com_id = $_GET['com_id'];
                $query = $conn->query("select * from complain where id = $com_id") or die("Not Found...!");
                $rows = $query->fetch_assoc();
            ?>

            <h4 class="pb-2 border-bottom">Subject: 
            <strong><?php echo subject($rows['subject_id']) ? subject($rows['subject_id']) : 'Others' ?></strong>
            <p class="pull-right">Status: <?php echo $rows['status'] == 'Seen' ? '<span class="btn btn-success btn-sm">'.$rows['status'].'</span>' : '<span class="btn btn-warning btn-sm">'.$rows['status'].'</span>'; ?></p>
            </h4>
            <h2 class="pb-2 border-bottom">Title: <strong><?php echo $rows['title'] ?></strong></h2>
            <p class="pb-2 border-bottom">Content:</p>
            <p><?php echo $rows['content'] ?></p>
            <div>
                <img class="img-fluid" src="images/<?php echo $rows['file'] ?>" alt="Attatchment">
            </div>

            <?php 
                if ($_SESSION['user']['role'] == 'admin') {
            ?>

            <div class="my-5">
                <a onClick="javascript: return confirm('Are you sure?')" 
                    href="view_complain.php?del_id=<?php echo $rows['id'] ?>" class="btn btn-danger">
                    <i class="fa fa-times fa-fw"></i>Delete</a>

                <a onClick="javascript: return confirm('Are you sure?')" 
                    href="view_complain.php?seen_id=<?php echo $rows['id'] ?>" class="btn btn-success pull-right">
                    <i class="fa fa-check fa-fw"></i>Make Seen</a>
            </div>

            <?php    }
            ?>


            
        <?php   }

            
        
        ?>
        </div>


    </div>

<?php 
 
    if (isset($_GET['seen_id'])) {
        $seen_id = $_GET['seen_id'];
        $query = $conn->query("update complain set status = 'Seen' where id = $seen_id") or die("Error occured...");
        header("location:view_complain.php?com_id=$seen_id");
        exit();
    }

    if (isset($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
        $query = $conn->query("delete from complain where id = $del_id") or die('Error Occurred...');
        header("location:all_complains.php");
        exit();
    }

?>

    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
