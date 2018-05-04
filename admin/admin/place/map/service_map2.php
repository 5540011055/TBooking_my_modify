<style>
   td{
   padding: 4px;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php 
<<<<<<< HEAD
require_once("includes/class.mysql.php");
require_once("includes/config.in.php");
$db = New DB();
set_time_limit(100000000000000000000000);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$table = "web_transferplace_new";

if($_GET[province]!=""){
	$province = $_GET[province];
	$where_pro = 'and pro = "'.$province.'"';
}
if($_GET[aum]!=""){
	$aum = $_GET[aum];
	$where_aum = 'and aum = "'.$aum.'"';
}
if($_GET[status]!=""){
	$status = $_GET[status];
	$where_status = 'and status = "'.$status.'"';
}
if($_GET[i_place_map]!=""){
	$i_place_map = $_GET[i_place_map];
	$where_map = 'and i_place_map = "'.$i_place_map.'"';
}
if($_GET[i_place_image]!=""){
	$i_place_img = $_GET[i_place_image];
	$where_img = 'and i_place_image = "'.$i_place_img.'"';
}
/*if($_GET[check_place_id]!=""){
	$check_place_id = $_GET[check_place_id];
	$where_place_id = 'and check_place_id = "'.$check_place_id.'"';
}*/
$where = $where_pro." ".$where_aum." ".$where_status." ".$where_map." ".$where_img." ".$where_place_id;
$res[place] = $db->select_query('SELECT id,topic,province FROM '.$table.' where id>0 '.$where.' order by id asc '); 
$count = $db->num_rows($table,'id',"id>0 ".$where);
//echo $where;
?>
<h2>All Row : <?=$count;?></h2>
=======
/*https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CmRaAAAA6KpsKzq1w9bgHvGQ_fGP7TlHO569D3ii1ZqtfUsgen6r-miaD_Ab-6ZxvkYSSPO-_VOfM1vNYV84JY0ez3yj2Ldc-luvp9Z2kHkvZWteq2LlhPcSZnIES5dkdU7k7tG3EhDfFn0rmMGarBjWts4fPeL-GhRMoeEoIu4dTRQ5GTIQvbbEgEffUg&key=AIzaSyCZqxDmw7dChWFXfh0_MdspEe1Y6swUdQ0*/
   require_once("includes/class.mysql.php");
   require_once("includes/config.in.php");
   $db = New DB();
   set_time_limit(100000000000000000000000);
   $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
   $table = Transferplace_3;
   if($_GET[province]!=""){
   	$province = $_GET[province];
   	$where_pro = 'and pro = "'.$province.'"';
   }
   if($_GET[aum]!=""){
   	$aum = $_GET[aum];
   	$where_aum = 'and aum = "'.$aum.'"';
   }
   if($_GET[status]!=""){
   	$status = $_GET[status];
   	$where_status = 'and status = "'.$status.'"';
   }
   if($_GET[i_place_map]!=""){
   	$i_place_map = $_GET[i_place_map];
   	$where_map = 'and i_place_map = "'.$i_place_map.'"';
   }
   if($_GET[i_place_image]!=""){
   	$i_place_img = $_GET[i_place_image];
   	$where_img = 'and i_place_image = "'.$i_place_img.'"';
   }
   /*if($_GET[check_place_id]!=""){
   	$check_place_id = $_GET[check_place_id];
   	$where_place_id = 'and check_place_id = "'.$check_place_id.'"';
   }*/
   $where = $where_pro." ".$where_aum." ".$where_status." ".$where_map." ".$where_img." ".$where_place_id;
   $res[place] = $db->select_query('SELECT id,topic,province FROM '.$table.' where id>0 '.$where.' order by id asc limit 1'); 
   $count = $db->num_rows($table,'id',"id>0 ".$where_pro." ".$where_aum." ".$where_status);
   $count_success = $db->num_rows($table,'id',"id>0 ".$where_pro." ".$where_aum." ".$where_status." and i_place_map = 1 and i_place_image = 1");
   $count_no_update = $db->num_rows($table,'id','id>0 '.$where);
   ?>
<table width="100%">
   <tr>
      <td width="33.3%">
         <h2><strong>Row all : <span id="count_all"><?=$count;?></<span></strong></h2>
      </td>
      <td width="33.3%">
         <h2 style="color: #5fc23d;"><strong>Row Success : <span id="count_success"><?=$count_success;?></span></strong></h2>
      </td>
      <td width="33.3%">
         <h2 style="color: #ff0000;"><strong>Row No Update : <span id="count_fail"><?=$count_no_update;?></span></strong></h2>
      </td>
   </tr>
</table>
>>>>>>> 3f4796b117dbed0897f863ae528c07b8dd4853f3
<table width="100%" border="1" id="body_tb" >
   <tr>
   <tr>
      <td>ID</td>
      <td>Topic</td>
      <td>Place_id</td>
      <td>Photo_ref</td>
      <td>Save web_place</td>
      <td>Save web_gal</td>
   </tr>
   </tr>
   <?
      while($arr[place] = $db->fetch($res[place])) {
      ?>
   <tr>
      <td ><?=$arr[place][id];?></td>
      <td id="topic_<?=$arr[place][id];?>" class="topic_c"  role="<?=$arr[place][id];?>" ><?=$arr[place][topic]." ".$arr[place][province];?></td>
      <td id="status_place_id_<?=$arr[place][id];?>"><span>0</span></td>
      <td id="status_photo_ref_<?=$arr[place][id];?>"><span>0</span></td>
      <td id="status_save_place_<?=$arr[place][id];?>"><span>0</span></td>
      <td id="status_save_gal_<?=$arr[place][id];?>"><span>0</span></td>
   </tr>
   <? } ?>
</table>
<script>
   $(document).ready(function(){
	   	$('.topic_c').each (function() {
	   	  	var topic = $(this).text();
	   		var id = $(this).attr('role');
	   		 var new_topic = topic.replace(" ", "+");
	   		 var url_google = "https://maps.googleapis.com/maps/api/geocode/json?address="+new_topic+"&sensor=false&key=AIzaSyCZqxDmw7dChWFXfh0_MdspEe1Y6swUdQ0";

	   		$.post(url_google, function(data){
	   			     console.log(data);
	   			     if(data.status == 'OK'){
	   			     		$('#status_place_id_'+id+' span').html('<span style="color: #009688" >success</span>');
	   			     		var lat = data.results[0].geometry.location.lat;
	   			     		var lng = data.results[0].geometry.location.lng;	     		     		
	   			     		var place_id = data.results[0].place_id;
	   				 		$.post("service_map_photo_ref.php?place_id="+place_id,+place_id, function(data){   							
	   								var url = data.url;
	   								console.log(url);
	   								if(data.status=="OK"){
	   									$('#status_photo_ref_'+id+' span').html('<span style="color: #009688" >success</span>');
	   									$.post("save_res.php?save=transferplace_new",{ id:id , url:url , lat:lat , lng:lng , place_id:place_id , photo_ref_map : data.photo_ref }, function(data){
	   										console.log(data);
	   										if(data.result==true){
	   											$('#status_save_place_'+id+' span').html('<span style="color: #009688" >success</span>');
	   											if(data.web_gal.result==true){
	   												var count_suc =  parseInt($('#count_success').text());
	   												calRow(1);
	   												$('#status_save_gal_'+id+' span').html('<span style="color: #009688" >success</span>');
	   											}else{
	   												calRow(2);
	   												$('#status_save_gal_'+id+' span').html('<span style="color: #F44336" >error</span>');
	   											}
	   											
	   										}else{
	   											calRow(2);
	   											$('#status_save_place_'+id+' span').html('<span style="color: #F44336" >error</span>');
	   										}
	   					    			});
	   								}else{
	   									calRow(2);
	   									$('#status_photo_ref_'+id+' span').html('<span style="color: #F44336" >error</span>');
	   								}
	   					    });
	   					}else{
	   						calRow(2);
	   				 		$('#status_place_id_'+id+' span').html('<span style="color: #F44336" >error</span>');
	   				 	}

	           });
	   	});    
   });
   
   function calRow(type){
   		if(type==1){
			var count_suc =  parseInt($('#count_success').text());
	   		$('#count_success').text(count_suc+1);
	   		
	   		var count_fail =  parseInt($('#count_fail').text());
			$('#count_fail').text(count_fail-1);
		}else{
			var count_fail =  parseInt($('#count_fail').text());
	   		$('#count_fail').text(count_fail+1);
		}
   }
</script>