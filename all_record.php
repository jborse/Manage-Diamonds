<!DOCTYPE html>
<html>
	<title>Datatable Demo2 | CoderExample</title>
	<head>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
	<?php	
		add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
		<script type="text/javascript" language="javascript" >
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"scrollX": true,
					"processing": true,
					"serverSide": true,
					dataType: "json",
					contentType: "application/json",
					"ajax":{
						"url" : 'admin-ajax.php', // json datasource
						"type": "POST",
						"data": {action: 'ajaxfile'},
					},
					"columns": [
						
						{"data": "reportNo"},
						{"data": "reference"},
						{"data": "shape"},	
						{"data": "lab"},
						{"data": "weight"},
						{"data": "color"},
						{"data": "clarity"},
						{"data": "cut"},
						{"data": "polish"},
						{"data": "symmetry"},
						{"data": "fluorescence"},
						{"data": "measurement"},
						{"data": "depth"},
						{"data": "tables"},
						{"data": "girdle"},
						{"data": "priceCarat"},
						{"data": "price"},
						{"data": "available"},
						{"data": "certificateLink"},
						{"data": "videoLink"}
					]
				} );
				
			} );  
			
		</script>
		</script> <?php
} ?>
		<style>
			div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>Diamond Records </h1></div>
		<div class="container">
			<table id="employee-grid" border="0" class="display dataTable" >
				<thead>
					<tr>
						<th>reportNo</th>
						<th>reference</th>
						<th>shape</th>
						<th>lab</th>
						<th>weight</th>
						<th>color</th>
						<th>clarity</th>
						<th>cut</th>
						<th>polish</th>
						<th>symmetry</th>
						<th>fluorescence</th>
						<th>measurement</th>
						<th>depth</th>
						<th>tables</th>
						<th>girdle</th>
						<th>priceCarat</th>
						<th>price</th>
						<th>available</th>
						<th>certificateLink</th>
						<th>videoLink</th>
					</tr>
				</thead>
			</table>
			
		</div>
	</body>
		
</html>