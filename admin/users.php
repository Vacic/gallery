<?php include "includes/header.php"; ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<body>
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Top Menu Items -->
			<?php include "includes/top_nav.php"; ?>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<?php include "includes/side_nav.php" ?>
			<!-- /.navbar-collapse -->
		</nav>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Users
							<a href="add_user.php" class="btn btn-primary btn-lg">Add User</a>
						</h1>
						<p class="bg-success"><strong><?php echo $message; ?></strong></p>
						<div class="col-md-12">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Id</th>
										<th>Photo</th>
										<th>Username</th>
										<th>First Name</th>
										<th>Last Name</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$users = User::find_all();
									foreach ($users as $user) {
									?>
									<tr>
										<td><?php echo $user->id; ?></td>
										<td><img src="<?php echo $user->image_path_and_placeholder(); ?>"></td>
										<td><?php echo $user->username; ?>
											<div class="action_link">
												<a class="delete_link" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
												<a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
											</div>
										</td>
										<td><?php echo $user->first_name; ?></td>
										<td><?php echo $user->last_name; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include "includes/footer.php"; ?>