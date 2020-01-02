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
                $role = $_SESSION['user']['role'];
                
                switch ($role) {
                    case 'admin' :
                        include("admin_dashboard.php");
                        break;

                    case 'user' :
                        include("user_dashboard.php");
                        break;
                     default :
                        inlcude("user_dashboard.php");
                }
            ?>
				
		</div>
	</div> <!-- /Main content -->
	


	


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

