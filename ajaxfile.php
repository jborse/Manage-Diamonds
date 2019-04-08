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
$sel = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where 1 '.$searchQuery);
$totalRecordwithFilter = count($sel);


## Fetch records
$empRecords = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'diamond_stock where 1 '.$searchQuery.' order by ' . $columnName . ' ' . $columnSortOrder . ' limit ' . $row . ',' . $rowperpage);
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
?>
