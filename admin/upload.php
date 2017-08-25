<?php include "includes/header.php"; ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>
<?php
	$message = "";
	if(isset($_FILES['file'])) {
		$photo = new Photo();
		$photo->title = $_POST['title'];
		$photo->set_file($_FILES['file']);
		if($photo->save()) {
			$message = "Photo uploaded succesfully";
		} else {
			$message = join("<br>", $photo->errors);
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
							Upload
						</h1>
						<div class="row">
							<div class="col-md-6"> 
								<?php echo $message; ?>
								<form action="upload.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label for="title">Title</label>
										<input type="text" name="title" class="form-control">
									</div>
									<div class="form-group">
										<label for="file_upload">Photo</label>
										<input type="file" name="file">
									</div>
									<input type="submit" name="submit">
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<form action="upload.php" class="dropzone"></form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include "includes/footer.php"; ?>