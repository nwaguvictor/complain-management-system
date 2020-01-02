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
    $user_id = $_SESSION['user']['user_id'];

    $query = $conn->query("select * from users where user_id = $user_id") or die("Failed to load... try Again!");
    $the_user = $query->fetch_assoc();

?>

    <!-- Main content -->
<div class="content">

  <div class="container-fluid">
  <h2 class="pb-2 border-bottom text-center mb-5">Your Profile Page!</h2>

    <div class="display-3 text-center mb-3 pb-2 border-bottom">Hello! <?php echo strtoupper($the_user['username']) ?></div>
    <div class="display-4 text-center">Username: <?php echo $the_user['username'] ?></div>
    <div class="display-4 text-center">E-mail: <?php echo $the_user['email'] ?></div>
    
    <div class="text-center">Role: <?php echo strtoupper($the_user['role']) ?></div>
  </div>


    </div> <!-- /Main content -->
</div>
  <!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

<!-- Complain Script -->
