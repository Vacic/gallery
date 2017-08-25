$(document).ready(function(){
	var user_href;
	var user_href_splitted;
	var user_id;
	var src;
	var src_splitted;
	var img_name;
	var photo_id;
	$(".modal_thumbnails").click(function(){
		$("#set_user_image").prop("disabled", false);
		user_href = $("#user-id").prop("href");
		user_href_splitted = user_href.split("=");
		user_id = user_href_splitted[user_href_splitted.length - 1];

		src = $(this).prop("src");
		src_splitted = src.split("/");
		img_name = src_splitted[src_splitted.length - 1];

		photo_id = $(this).attr("data");

		$.ajax({
			url: "includes/ajax_code.php",
			data: {photo_id:photo_id},
			type: "POST",
			success: function(data) {
				if(!data.error) {
					$("#modal_sidebar").html(data);
				}
			}
		});

		});
	$("#set_user_image").click(function(){
		$.ajax({
			url: "includes/ajax_code.php",
			data: {img_name:img_name, user_id:user_id},
			type: "POST",
			success: function(data) {
				if(!data.error) {
					$(".user_image_box a img").prop("src", data);
				}
			}
		});
	});
	/***********Edit Photo Side Bar*****************/
	$(".info-box-header").click(function(){
		$(".inside").slideToggle("fast");
		$("#toggle").toggleClass("glyphicon-menu-down glyphicon-menu-up");
	});
	/***********Delete Function*******************/
	$(".delete_link").click(function(){
		return confirm("Are you sure you want to delete this item?");
	});
	tinymce.init({selector:'textarea'});
});