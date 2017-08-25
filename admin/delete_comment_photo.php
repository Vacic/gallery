<?php include "includes/init.php"; ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
	$comment = Comment::find_by_id($_GET['id']);
	if (empty($_GET['id'])) {
		redirect("photo_comments.php?id={$comment->photo_id}");
	}
	if ($comment) {
		$session->message("The comment with id:{$comment->id} has been deleted");
		$comment->delete();
		redirect("photo_comments.php?id={$comment->photo_id}");
	} else {
		redirect("photo_comments?id={$comment->photo_id}.php");
	}
?>