<!--<link rel="stylesheet" href="admin/admin/employee/boostrap4.css?v=<?=time();?>" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />-->
<h2>Department</h2>
<div style="padding: 0px 10px;height: auto;" class="w3-animate-bottom">

<div style="padding: 10px;margin-top:10px;" id="body_view_admin_com">
	<table id="table_admin_com" class="table table-hover" >
	<thead>
		<th width="50">#</th>
		<th>Code</th>
		<th>Admin Company</th>
		<th width="50">Department</th>
		<th></th>
	</thead>	
	<?php 
		$num = 1;
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res[admin_com] = $db->select_query("SELECT id,code,company FROM web_admin_company ORDER BY id ASC ");
		while($arr[admin_com] = $db->fetch($res[admin_com])){ 
		$num_dp = $db->num_rows("web_employee_department","id","admin_company = '".$arr[admin_com][id]."' and status = 1 ");
		?>
			<tr>
				<td class="txt-cen"><span><?=$num++;?></span></td>
				<td><span><?=$arr[admin_com][code];?></span></td>
				<td><span><?=$arr[admin_com][company];?></span></td>
				<td class="txt-cen"><span><?=$num_dp;?></span></td>
				<td><button class="btn btn-info btn-sm" onclick="openDp('<?=$arr[admin_com][id];?>');" >Manage</button></td>
			</tr>				
	<?	}
	?>
	</table>
</div>

<div style="padding: 10px;margin-top:10px;display: none;" id="main_view_dp" >
	<button class="btn btn-default" onclick="backMain();" style="border: 1px solid #9E9E9E;box-shadow: 1px 1px 3px #a29e9e;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp; Back previos</button>
	<div id="body_view_dp" class="w3-animate-right">
		
	</div>
</div>

</div>

<script>
	function openDp(id_admin_com){
		
		var url = "empty_style.php?name=admin/employee&file=load_department";
		$.post(url,{ id_admin_com,id_admin_com },function(res){
			$('#body_view_dp').html(res);
			$('#body_view_admin_com').hide();
			$('#main_view_dp').show();
		});
	}
	
	function backMain(){
		$('#body_view_admin_com').addClass('w3-animate-left');
		$('#body_view_admin_com').show();
		$('#main_view_dp').hide();
		
	}
</script>