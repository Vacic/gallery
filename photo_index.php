<?php include "includes/header.php"; ?>
<body>
<?php include "includes/navigation.php"; ?>
<?php
	if(empty($_GET['id'])) {
		redirect("photo_index.php");
	}
	$photo = Photo::find_by_id($_GET['id']);
	if($session->is_signed_in()) {
		$user = User::find_by_id($session->user_id);
		if (isset($_POST['submit'])) {
			$author = trim($_POST['author']);
			$body = trim($_POST['body']);
			$new_comment = Comment::create_comment($photo->id, $user->id, $author, $body);
			$session->message("Your comment has been submited.");
			if($new_comment && $new_comment->save()) {
				redirect("photo_index.php?id={$photo->id}");
			} else {
				$message = "<h1>There were some problems saving</h1>";
			} 
		}
	}
	$comments = Comment::find_the_comments($photo->id);
?>
	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<!-- Blog Post Content Column -->
			<div class="col-lg-8">
				<!-- Blog Post -->
				<!-- Title -->
				<h1><?php echo $photo->title; ?></h1>
				<!-- Author -->
				<p class="lead">
					by <a href="#">Start Bootstrap</a>
				</p>
				<hr>
				<!-- Date/Time -->
				<p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
				<hr>
				<!-- Preview Image -->
				<img class="img-responsive photo-index-photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
				<hr>
				<!-- Post Content -->
				<p class="lead"><?php echo $photo->caption; ?></p>
				<p><?php echo $photo->description; ?></p>
				<hr>
				<!-- Blog Comments -->
				<!-- Comments Form -->
				<?php if($session->is_signed_in()) { ?>
				<p class="bg-success"><?php echo $message; ?></p>
				<div class="well">
					<h4>Leave a Comment:</h4>
					<form action="photo_index.php" role="form" method="post">
						<div class="form-group">
							<label for="author">Author</label>
							<input type="text" name="author" class="form-control" value="<?php echo $user->username; ?>">
						</div>
						<div class="form-group">
							<textarea name="body" class="form-control" rows="3"></textarea>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<?php } else { ?>
				<div class="well">
					<h4>Sign in to leave a comment!</h4>
						<div class="form-group">
							<label for="author">Author</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows="3"></textarea>
						</div>
						<button class="btn btn-primary">Submit</button>
				</div>
				<?php } ?>
				<hr>
				<!-- Posted Comments -->
				<!-- Comment -->
				<?php foreach ($comments as $comment): ?>				
				<div class="media">
					<a class="pull-left" href="#">
						<img class="media-object" src="<?php $user = User::find_by_id($comment->user_id); echo 'admin'.DS.$user->image_path_and_placeholder(); ?>" alt="">
					</a>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $comment->author; ?>
							<small><?php $date = date_create($comment->time); echo date_format($date, "d M, Y"). " at " .date_format($date, "H:i:s");?></small>
						</h4>
						<?php echo $comment->body; ?>
					</div>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>		
<?php include "includes/footer.php"; ?>