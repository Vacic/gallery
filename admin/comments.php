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
							Comments
						</h1>
						<p class="bg-success"><?php echo $message; ?></p>
						<div class="col-md-12">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Id</th>
										<th>Author</th>
										<th>Body</th>
										<th>Created on</th>
										<th>At</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$comments = Comment::find_all();
									foreach ($comments as $comment):
									?>
									<tr>
										<td><?php echo $comment->id; ?></td>
										<td><?php echo $comment->author; ?></td>
										<td><?php echo $comment->body; ?>
											<div class="action_link">
												<a class="delete_link" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
												<a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
											</div>
										</td>
										<td><?php $date = date_create($comment->time); echo date_format($date, "d M, Y")?></td>
										<td><?php echo date_format($date, "H:i:s");?></td>
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