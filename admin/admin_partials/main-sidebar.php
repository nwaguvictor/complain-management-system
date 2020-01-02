<aside class="main-sidebar sidebar-dark-secondary elevation-2 bg-danger">
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<?php echo $_SESSION['user']['role'] == 'admin' ? '<i class="fa fa-user-secret fa-2x"></i>' : '<i class="fa fa-user-circle-o fa-2x"></i>' ?>
				<!-- <div class="image">
					<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
				</div> -->
				<div class="info">
					<a href="index.php" class="d-block"><?php echo strtoupper($_SESSION['user']['role']) ?></a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
					<li class="nav-item">
						<a href="index.php" class="nav-link active">
							<i class="nav-icon fa fa-tachometer"></i>
							<p> Dashboard </p>
						</a>
					</li>
					
					
			<!-- Sidebar based on user role script -->
			<?php 
				if ($_SESSION['user']['role'] == 'admin') {
				?>
			<li class="nav-item">
				<a href="all_complains.php" class="nav-link">
					<i class="nav-icon fa fa-list-ul"></i>
					<p>All Complains </p>
				</a>
			</li>

			<li class="nav-item">
				<a href="all_subjects.php" class="nav-link">
					<i class="nav-icon fa fa-legal"></i>
					<p> Subjects Section </p>
				</a>
			</li>

			<li class="nav-item">
				<a href="users.php" class="nav-link">
					<i class="nav-icon fa fa-users"></i>
					<p> List Of Users </p>
				</a>
			</li>
				
			<?php  } else {
			?>
			<li class="nav-item">
				<a href="complain.php" class="nav-link">
					<i class="nav-icon fa fa-envelope"></i>
					<p>Make Complain </p>
				</a>
			</li>

			<li class="nav-item">
				<a href="user_complains.php" class="nav-link">
					<i class="nav-icon fa fa-reorder"></i>
					<p>My Complains </p>
				</a>
			</li>

			<?php }
			?>

					<li class="nav-item">
						<a href="profile.php" class="nav-link">
							<i class="nav-icon fa fa-user-o"></i>
							<p> Profile </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="logout.php" class="nav-link">
							<i class="nav-icon fa fa-power-off"></i>
							<p> Logout </p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>