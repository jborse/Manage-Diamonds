<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
			<h1>Import CSV</h1>
                <?php
				 if(isset($_POST["Import"])){
					$filename=$_FILES["file"]["tmp_name"];		
						if($_FILES["file"]["size"] > 0)
						{
							$file = fopen($filename, "r");
							global $wpdb;
							$tablename = $wpdb->prefix.'diamond_stock';
							$wpdb->query('TRUNCATE TABLE '.$tablename);

							while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
							{
								$result = $wpdb->insert( $tablename, array(
										'reportNo' => $getData[0], 
										'reference' => $getData[1],
										'shape' => $getData[2], 
										'lab' => $getData[3],
										'weight' => $getData[4], 
										'color' => $getData[5], 
										'clarity' => $getData[6],
										'cut' => $getData[7], 
										'polish' => $getData[8], 
										'symmetry' => $getData[9],
										'fluorescence' => $getData[10], 
										'measurement' => $getData[11], 
										'depth' => $getData[12], 
										'tables' => $getData[13],
										'girdle' => $getData[14], 
										'priceCarat' => $getData[15], 
										'price' => $getData[16], 
										'available' => $getData[17], 
										'certificateLink' => $getData[18], 
										'videoLink' => $getData[19]
								));
							}
							fclose($file);	
							if(!isset($result)){
								echo '<div class="alert alert-danger">
										<strong>Error in Diamond Upload!</strong>
									</div>';    
							}else {
								echo '<div class="alert alert-success">
										<strong>Dimonds are Uploaded Successfully!</strong>
									</div>';
							}
						}
					}	 
				?>	
				
				<!--<img src="<?php echo esc_url( plugins_url( 'images/animat-diamond.gif', __FILE__ ) ) ?>" id="gif" style="display: block; margin: 0 auto; width: 100px; visibility: hidden;">-->

				<form class="form-horizontal" id="import_form" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
						<div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
					</fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
<script>  
      
 </script>  
</html>
