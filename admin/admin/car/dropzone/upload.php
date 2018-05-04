<?php 
include('../../../../includes/class.mysql.php'); 
include('../../../../includes/config.in.php'); 
$db = New DB();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($_GET[type]=="add"){
	foreach ($_FILES['files']['name'] as $f => $name) {     
			  $target_dir = "../../../../file_upload_car/doc/";
			  $target_file = $target_dir . basename($_FILES["files"]["name"][$f]);
			    if (move_uploaded_file($_FILES["files"]["tmp_name"][$f], $target_file)) { 	
			          	$img_array[status] = 1;
			          	$img_array[date_insurance] = $_GET[date];
				        $img_array[name_file] = $_FILES["files"]["name"][$f];
				        $img_array[car_number] = $_GET[id];
				        $img_array[last_update] = time();
				        $save_img_array = $db->add_db("doc_files_car",$img_array);
			    } 	
//			    $data[$f] = $name;
			}
	
//	header('Content-Type: application/json');
//	echo json_encode($data);
	?>
	<script>
			window.location = "iframe_test.php?id=<?=$_GET[id];?>";
	</script>
	<?
	}
	
if($_GET[type]=="deleted"){	

	$res['del_f'] = $db->del("doc_files_car","id = '".$_POST[pic_id]."' "); 
	if($result>0){
		$target_dir = "../../../../file_upload_car/doc";
		$flgDelete = @unlink($target_dir.$_POST[fname]);
		
	}
	$res['del_db'] = $flgDelete;
//	$res['del_f'] = $result;
	header('Content-Type: application/json');
	echo json_encode($res);
}
	
?>