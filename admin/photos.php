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
							Photos
						</h1>
						<p class="bg-success"><?php echo $message; ?></p>
						<div class="col-md-12">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Photo</th>
										<th>Id</th>
										<th>File Name</th>
										<th>Title</th>
										<th>Size</th>
										<th>Comments</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$photos = Photo::find_all();
									foreach ($photos as $photo):
									?>
									<tr>
										<td><img src="<?php echo $photo->picture_path(); ?>">
											<div class="pictures_link">
												<a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
												<a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
												<a href="../photo_index.php?id=<?php echo $photo->id; ?>">View</a>
											</div>
										</td>
										<td><?php echo $photo->id; ?></td>
										<td><?php echo $photo->filename; ?></td>
										<td><?php echo $photo->title; ?></td>
										<td><?php echo $photo->size; ?></td>
										<td>
											<?php 
												$comments = Comment::find_the_comments($photo->id);
												echo "<a href='photo_comments.php?id={$photo->id}'>" .count($comments). "</a>";
											?>
										</td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include "includes/footer.php"; ?>