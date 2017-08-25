<?php require_once "init.php"; ?>
<?php
	$user = new User();
	$photo = new Photo();
	if(isset($_POST['img_name'])) {
		$user->ajax_save_user_image($_POST['img_name'], $_POST['user_id']);
	}
	if(isset($_POST['photo_id'])) {
		Photo::display_sidebar_data($_POST['photo_id']);
	}
?>