<?php 
	include('../../../includes/class.mysql.php');
	$db = new DB();
	define("DB_HOST","localhost");
	define("DB_USERNAME","admin_MANbooking");
	define("DB_PASSWORD","252631MANbooking");
	define("DB_NAME","admin_web");
	
	if($_GET[action]=="add_department"){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$data[topic_th] = $_POST[topic_th];
		$data[topic_en] = $_POST[topic_en];
		$data[topic_cn] = $_POST[topic_cn];
		$data[admin_company] = $_POST[id_admin_com];
		$data[commission] = $_POST[commission];
		$data[post_date] = time();
		$data[update_date] = time();
		$data[result] = $db->add_db('web_employee_department',$data);
		header('Content-Type: application/json');
    	echo json_encode($data);
	}
	
	if($_GET[action]=="edit_department"){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$data[topic_th] = $_POST[topic_th];
		$data[topic_en] = $_POST[topic_en];
		$data[topic_cn] = $_POST[topic_cn];
//		$data[admin_company] = $_POST[id_admin_com];
		$data[commission] = $_POST[commission];
		$data[post_date] = time();
		$data[update_date] = time();
		$data[result] = $db->update_db('web_employee_department',$data,'id = "'.$_GET[id].'" ');
		header('Content-Type: application/json');
    	echo json_encode($data);
	}
	
	if($_GET[action]=="change_status_department"){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$data[status] = $_POST[status];
		$data[update_date] = time();
		$data[result] = $db->update_db('web_employee_department',$data,'id = "'.$_GET[id].'" ');
		header('Content-Type: application/json');
    	echo json_encode($data);
	}
?>