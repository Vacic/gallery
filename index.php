<?php include "includes/header.php"; ?>
<?php
	$page = !empty($_GET['page'])?(int)$_GET['page']:1;
	$items_per_page = 12;
	$items_total_count = Photo::count_all();
	$paginate = new Paginate($page, $items_per_page, $items_total_count);
	$sql = "SELECT * FROM photos ";
	$sql.= "LIMIT {$items_per_page} ";
	$sql.= "OFFSET {$paginate->offset()}";
	$photos = Photo::find_by_query($sql);
?>
<?php include "includes/navigation.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="thumbnails row">
					<?php foreach ($photos as $photo): ?>
						<div class="col-xs-6 col-md-4">
							<a href="photo_index.php?id=<?php echo $photo->id; ?>" class="thumbnail">
								<img src="admin/<?php echo $photo->picture_path(); ?>" alt="" class="front-page-photos img-responsive">
							</a>
						</div>
					<?php endforeach ?>
				</div>
				<div class="row">
					<ul class="pager">
						<?php if($paginate->page_total() > 1) { if($paginate->has_next()) { ?>
						<li class='next'><a href="<?php echo 'index.php?page='.$paginate->next(); ?>">Next</a></li>
						<?php } ?>
						<?php 
							for ($i=1; $i <= $paginate->page_total(); $i++) { 
								if($i == $paginate->current_page) { ?>
									<li class="active"><a href="#"><?php echo $i ?></a></li>
								<?php } else { ?>
									<li class=""><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
								<?php }} ?>
						<?php if($paginate->has_previous()) { ?>
						<li class='previous'><a href="<?php echo 'index.php?page='.$paginate->previous(); ?>">Previous</a></li>
						<?php }} ?>
					</ul>
				</div>
			</div>
		</div>
<?php include "includes/footer.php"; ?>