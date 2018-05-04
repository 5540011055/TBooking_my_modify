<?php 
require_once("includes/class.mysql.php");
require_once("includes/config.in.php");
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
mysql_query("SET NAMES UTF8"); 
mysql_query("SET character_set_results=utf-8");

if($_GET[save]=="transferplace_new"){
	
	$table = 'web_transferplace_new';
	$table_gal = 'web_gallery_place';
	$data[place_id] = $_POST[place_id];
	$data[lat] = $_POST[lat];
	$data[lng] = $_POST[lng];
	$data[map] = $_POST[url];
//	$data[photo_ref_map] = $_POST[photo_ref_map];
	$data[i_place_map] = 1;	
	$data[i_place_image] = 1;
//	$data[check_place_id] = 1;
	$data[result] = $db->update_db($table,$data,'id = "'.$_POST[id].'" ');
	
	$data_gallery[place_id] = $_POST[id];
	$data_gallery[type] = 1;
	$data_gallery[i_type_from] = 1;
	$data_gallery[s_photo_ref] = $_POST[photo_ref_map];
	$data_gallery[post_date] = time();
	$data_gallery[update_date] = time();
	$data_gallery[result] = $db->add_db($table_gal,$data_gallery);
	
	$data[web_gal] = $data_gallery;
	header('Content-Type: application/json');
	echo json_encode($data);
}

?>