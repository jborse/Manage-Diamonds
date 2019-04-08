<?php
global $wpdb;

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (reportNo like '%".$searchValue."%' or reference like '%".$searchValue."%' or 
        shape like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock');
$totalRecords = count($sel);


## Total number of records with filtering
/* $sel = mysqli_query($con,"select count(*) as allcount from employee WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel); */

$sel = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where 1 '.$searchQuery);
$totalRecordwithFilter = count($sel);


## Fetch records
//$empQuery = "select * from employee WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where 1 '.$searchQuery.' order by ' . $columnName . ' ' . $columnSortOrder . ' limit ' . $row . ',' . $rowperpage);
/* $empRecords = mysqli_query($con, $empQuery); */
$data = array();

foreach ($empRecords as $row) {
    $data[] = array(
    		"ds_id"=>$row->ds_id,
    		"reportNo"=>$row->reportNo,
    		"reference"=>$row->reference,
    		"shape"=>$row->shape,
    		"lab"=>$row->lab,
    		"weight"=>$row->weight,
    		"color"=>$row->color,
    		"clarity"=>$row->clarity,
    		"cut"=>$row->cut,
    		"polish"=>$row->polish,
    		"symmetry"=>$row->symmetry,
    		"fluorescence"=>$row->fluorescence,
    		"measurement"=>$row->measurement,
    		"depth"=>$row->depth,
    		"tables"=>$row->tables,
    		"girdle"=>$row->girdle,
    		"priceCarat"=>$row->priceCarat,
    		"price"=>$row->price,
    		"available"=>$row->available,
    		"certificateLink"=>$row->certificateLink,
    		"videoLink"=>$row->videoLink
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);

exit();


/* global $wpdb;

$results['draw'] = $_POST['draw'];
$search=trim($_POST['search']['value']);
if($search!=""){
    $jde_refd=" reportNo like '%".$search."%' AND reportNo !=''";
}else{
    $jde_refd="1=1 AND reportNo !=''";
}

$resultCount = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where '.$jde_refd);

//  
$length = $_POST['length'];
$start = $_POST['start'];
$arrayField = array(
    'reportNo',
    'reference',
    'shape',
    'lab',
    'weight',
    'color',
    'clarity',
    'cut',
    'polish',
    'symmetry',
    'fluorescence',
    'measurement',
    'depth',
    'table',
    'girdle',
    'priceCarat',
    'price',
    'available',
    'certificateLink',
    'videoLink'
);

$results['recordsTotal'] = count($resultCount);
$results['recordsFiltered'] = count($resultCount);
$results['data']="";
if ($resultCount > 0) {
    $row = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where '.$jde_refd.' order by ' . $arrayField[$_POST['order'][0]['column']] . ' ' . $_POST['order'][0]['dir'] . ' limit ' . $start . ',' . $length);
    $i = 0;
    //$statusArray = array("No", "Yes");
    foreach ($row as $r) {
		
		$results['data'][$i] = $r;
        //echo number_format("1000000",2,",",".");
        $results['data'][$i]->price=number_format($results['data'][$i]->price,0);        
        $results['data'][$i]->priceCarat=number_format($results['data'][$i]->priceCarat,0);        
       // $results['data'][$i]->shape= ucfirst($results['data'][$i]->shape);
       // $results['data'][$i]->depth= number_format($results['data'][$i]->depth,1).'%';
        $results['data'][$i]->available = "<span class='status' data-id='" . $r->ds_id . "' data-status='" . $r->available . "'>" . $r->available . "</span>";
        //$results['data'][$i]->action = "<span title='Remove Diamond' data-id='" . $r->diamond_id . "' class='dashicons-before action-del wp-menu-image dashicons-trash'></span>";
        //$results['data'][$i]->action = "-";
        $i++;
    }
}
echo json_encode($results);
die(); */
?>