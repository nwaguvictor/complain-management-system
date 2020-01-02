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
  <h2 class="text-center pb-2 border-bottom mb-5">You're on the Complain list page!</h2>
  <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Subject</th>
                        <th>Attatchment</th>
                        <th>Title</th>
                        <th>Complain</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>View</th>
                    </tr>
                </thead>

                <tbody>
    <?php 

function subject($id) {
    global $conn;
    $query = $conn->query("select * from subject where subject_id = $id");
    $row = $query->fetch_assoc();

    return $row['subject_name'];
}

    $user_id = $_SESSION['user']['user_id'];
    $query = $conn->query("select * from complain where complainant_id = $user_id order by id desc");
    
    if ($query->num_rows > 0) {
        $cnt = 1;
        while ($rows = $query->fetch_array()) {
            $subject = $rows['subject_id'];
    ?>

        
<tr>
    <td><?php echo $cnt ?></td>
    <td><?php echo subject($subject) ? subject($subject) : 'Others' ?></td>
    <td>
        <img class="img-fluid" 
        style="width:60px; height:30px" src="images/<?php echo $rows['file'] ?>" alt="File">
    </td>
    <td><?php echo $rows['title'] ?></td>
    <td><?php echo substr($rows['content'], 0, 50) ?></td>
    <td>
        <?php echo $rows['status'] == 'Seen' ? '<span class="btn btn-success btn-sm">'.$rows['status'].'</span>' : '<span class="btn btn-warning btn-sm">'.$rows['status'].'</span>'; ?>
    </td>
    <td><?php echo ($rows['date']) ?></td>
    <td><a href="view_complain.php?com_id=<?php echo $rows['id'] ?>" class="btn btn-info btn-sm">View</a></td>
</tr>


    <?php   $cnt++; }

    } else {
        echo '<h3 class="text-center text-danger">No Record found</h3>';
    }
        
    
    ?>

                        </tbody>
                    </table>
                </div>
            </div>



<?php 
    

?>


    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
