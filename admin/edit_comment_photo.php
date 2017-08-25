<?php include "includes/header.php"; ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
	$comment = Comment::find_by_id($_GET['id']);
	if (empty($_GET['id'])) {
	redirect("photo_comments.php?id={$comment->photo_id}");
	}
	if (isset($_POST['update'])) {
		if($comment) {
			$comment->author = $_POST['author'];
			$comment->body = $_POST['body'];
			if (!empty($comment->author) && !empty($comment->body)) {
				$session->message("The comment with id:{$comment->id} has been updated");
				$comment->save();
				redirect("photo_comments.php?id={$comment->photo_id}");
			}
		}
	}
?>
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
							Edit Comment
						</h1>
						<form action="" method="post">
							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">
									<label for="author">Author</label>
									<input type="text" name="author" class="form-control" value="<?php echo $comment->author; ?>">
								</div>
								<div class="form-group">
									<label for="body">Content</label>
									<textarea type="body" name="body" class="form-control"><?php echo $comment->body; ?></textarea>
								</div>
								<a class="btn btn-danger" href="delete_user.php?id=<?php echo $comment->id; ?>">Delete</a>
								<input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php include "includes/footer.php"; ?>