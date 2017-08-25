	</div>
	<!-- /#wrapper -->
	<script src="js/jquery-3.1.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
	<script src="js/dropzone.js"></script>
	<script src="js/my_scripts.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Task', 'Hours per Day'],
				['Views',     <?php echo $session->count; ?>],
				['Comments', <?php echo Comment::count_all(); ?>],
				['Users',  <?php echo User::count_all(); ?>],
				['Photos',      <?php echo Photo::count_all(); ?>]
				]);
			var options = {
				legend: 'none',
				pieSliceText: 'label',
				backgroundColor: 'transparent'
			};
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
		}
	</script>
</body>
</html>