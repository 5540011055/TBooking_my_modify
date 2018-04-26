<?php 
	$sum_com = $db->select_query("SELECT sum(commission) as sum FROM web_employee_department where status = 1 and admin_company = '".$_POST[id_admin_com]."' ");
	$sum_com = $db->fetch($sum_com);
	$total_com = 100 - intval($sum_com[sum]);
?>
<button onclick="$('#custom_dialog').show();" class="btn" style="padding: 10px; border-radius: 40px; background-color: #009688; color: #fff; font-size: 24px; height: 42px; position:  absolute;  left: 150px; top: -47px;">
<i class="fa fa-plus" aria-hidden="true"></i></button>
<div style=" width: 70px;   right: 20px; position:  absolute; top: -50px;">
	<h3><span id="percent_com"><?=$total_com;?></span>%</h3>
</div>
<table id="table_dm" class="table " style="margin-top: 10px;padding: 10px 15px;;" >
	<thead>
		<th width="50">#</th>
		<th>Name EN</th>
		<th>Name TH</th>
		<th>Name CN</th>
		<th width="50">Commission</th>
		<th width="50">Employee</th>
		<th>Manage</th>
	</thead>
	<tbody>	
	<?php 
	$num = 1;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res[dp] = $db->select_query("SELECT * FROM web_employee_department where status = 1 and admin_company = '".$_POST[id_admin_com]."' ORDER BY id ASC ");
	while($arr[dp] = $db->fetch($res[dp])){ 
	$num_em = $db->num_rows("web_employee","id","company = '".$_POST[id_admin_com]."' and department = '".$arr[dp][id]."' ");
	?>
	<tr id="row_<?=$arr[dp][id];?>">
	
		<td align="center"><font><?=$num++;?></font></td>
		<td><span id="txt_topic_en" class="txt_row_<?=$arr[dp][id];?>"><?=$arr[dp][topic_en];?></span>
		<input type="text" value="<?=$arr[dp][topic_en];?>" style="display: none;" name="topic_en" /></td>
		<td><span id="txt_topic_th" class="txt_row_<?=$arr[dp][id];?>"><?=$arr[dp][topic_th];?></span>
		<input type="text" value="<?=$arr[dp][topic_th];?>" style="display: none;" name="topic_th" /></td>
		<td><span id="txt_topic_cn" class="txt_row_<?=$arr[dp][id];?>"><?=$arr[dp][topic_cn];?></span>
		<input type="text" value="<?=$arr[dp][topic_cn];?>" style="display: none;" name="topic_cn" /></td>
		<td align="center"><span id="txt_commission" class="txt_row_<?=$arr[dp][id];?>"><?=$arr[dp][commission];?></span>
		<input type="number" value="<?=$arr[dp][commission];?>" style="display: none;width: 70px;" name="commission" max="<?=$total_com;?>" /><span>%</span></td>
		<td align="center"><font><?=$num_em;?></font></td>
		<td align="center">
			<button class="btn btn-primary" style="padding: 2px 15px;" onclick="editDp('<?=$arr[dp][id];?>');" id="btn_edit_<?=$arr[dp][id];?>">Edit</button>
			<button class="btn btn-success" style="padding: 2px 15px;display: none;" onclick="saveDp('<?=$arr[dp][id];?>');" id="btn_save_<?=$arr[dp][id];?>">Save</button>
			<button class="btn btn-default btn-def" style="padding: 2px 15px;display: none;" onclick="cancelDp('<?=$arr[dp][id];?>');" id="btn_cancel_<?=$arr[dp][id];?>">Cancel</button>
			<button class="btn btn-danger" style="padding: 2px 15px;" onclick="delDp('<?=$arr[dp][id];?>')" id="btn_del_<?=$arr[dp][id];?>">Delete</button>
			<button class="btn btn-warning" style="padding: 2px 15px;display: none;" onclick="recoverDp('<?=$arr[dp][id];?>')" id="btn_re_<?=$arr[dp][id];?>">Recover</button>
		</td>
		
	</tr>
	<? } ?>
	</tbody>
</table>

<div id="custom_dialog" style="width: 100%;height: 100%;position:  fixed;z-index: 999;background-color: #00000057;top: 0px;left: 0px;display: none;">
	<div class="modal-dialog w3-animate-bottom" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="dialoglLabel">Add Department</h4>
				</div>

				<div class="modal-body" id="load_modal_body">
					<div style="margin: 10px;" align="center">
						<form method="post" id="add_dp">
						<table cellpadding="5" cellspacing="5" style=" border:  1px solid #ddd; padding:  20px; box-shadow: 2px 2px 5px #ddd;">
							<tr>
								<td><strong>Name EN</strong></td>
								<td>&nbsp;:&nbsp;</td>
								<td><input type="text" class="form-control" name="topic_en" value="" /></td>
							</tr>
							<tr>
								<td><strong>Name TH</strong></td>
								<td>&nbsp;:&nbsp;</td>
								<td><input type="text" class="form-control" name="topic_th" value="" /></td>
							</tr>
							<tr>
								<td><strong>Name CN</strong></td>
								<td>&nbsp;:&nbsp;</td>
								<td><input type="text" class="form-control" name="topic_cn" value="" /></td>
							</tr>
							<tr style="display: nones;">
								<td><strong>Commission</strong></td>
								<td>&nbsp;:&nbsp;</td>
								<td><input type="number"  class="form-controls" name="commission" value="0" style="width: 60px;" />&nbsp;&nbsp;<strong>%</strong></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><button class="btn btn-success" type="submit">Save data</button></td>
							</tr>
						</table>
						<input type="hidden" name="id_admin_com" id="id_admin_com" value="<?=$_POST[id_admin_com];?>" />
						<input type="hidden" name="posted" id="posted" value="<?=$_SESSION['admin_user'];?>" />
						</form>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-dialog" onclick="$('#custom_dialog').hide();">Cancel</button>
					<button type="button" class="btn btn-dialog">Ok</button>
				</div>
			</div><!-- modal-content -->
		</div>
</div>

<script>
	$( "#add_dp" ).submit(function( event ) {
	  var url = "admin/admin/employee/php_action.php?action=add_department";
	  $.post(url,$(this).serialize(),function(data){
	  		console.log(data);
	  		if(data.result==true){
				var url = "empty_style.php?name=admin/employee&file=load_department";
				var id_admin_com = $('#id_admin_com').val();
				$.post(url,{ id_admin_com:id_admin_com },function(res){
					$('#body_view_dp').html(res);
				});
			}
	  });
	  event.preventDefault();
	});
	
	function cancelDp(id){
		$('#row_'+id+' span').show();
		//		$('.input_row_'+id).hide();
		$('#row_'+id+' input').hide();
				
		$('#btn_edit_'+id).show();
		$('#btn_del_'+id).show();
		$('#btn_save_'+id).hide();
		$('#btn_cancel_'+id).hide();
	}
	
	function editDp(id){
		var max_val = parseInt($('#percent_com').text()) + parseInt($('#row_'+id+' input[name="commission"]').val());
		$('#row_'+id+' input[name="commission"]').attr('max',max_val);
		
		$('#row_'+id+' span').hide();
//		$('.input_row_'+id).show();
		$('#row_'+id+' input').show();
		
		$('#btn_edit_'+id).hide();
		$('#btn_del_'+id).hide();
		$('#btn_cancel_'+id).show();
		$('#btn_save_'+id).show();
		
	}
	function saveDp(id){
		var re = calPercent();
		if(re<0){
			swal("Value must be less than or equal to "+$('#percent_com').text());
			return;
		}
		var topic_en = $('#row_'+id+' input[name="topic_en"]').val();
		var topic_th = $('#row_'+id+' input[name="topic_th"]').val();
		var topic_cn = $('#row_'+id+' input[name="topic_cn"]').val();
		var commission = $('#row_'+id+' input[name="commission"]').val();
		var url_php = "admin/admin/employee/php_action.php?action=edit_department&id="+id;
		$.post(url_php,{ topic_en:topic_en, topic_th:topic_th, topic_cn:topic_cn, commission:commission  } ,function(data){
			console.log(data);
			if(data.result==true){
				$('#row_'+id).addClass('tr-success');
				setTimeout(function(){ $('#row_'+id).removeClass('tr-success'); }, 3000);
				
				$('#row_'+id+' #txt_commission').text(commission);  
				$('#row_'+id+' #txt_topic_en').text(topic_en);  
				$('#row_'+id+' #txt_topic_th').text(topic_th);  
				$('#row_'+id+' #txt_topic_cn').text(topic_cn);  
			}
			else{
				$('#row_'+id).addClass('tr-error');
				setTimeout(function(){ $('#row_'+id).removeClass('tr-error'); }, 3000);
			}
				$('#row_'+id+' span').show();
		//		$('.input_row_'+id).hide();
				$('#row_'+id+' input').hide();
				
				$('#btn_edit_'+id).show();
				$('#btn_del_'+id).show();
				$('#btn_save_'+id).hide();
				$('#btn_cancel_'+id).hide();
		});
		
	}
	function delDp(id){
		$('#btn_del_'+id).hide();
		$('#btn_re_'+id).show();
		var url_php = "admin/admin/employee/php_action.php?action=change_status_department&id="+id;
		$.post(url_php,{ status:0 },function(data){
			console.log(data);
			if(data.result==true){
				$('#row_'+id).addClass('tr-wan');
				setTimeout(function(){ $('#row_'+id).removeClass('tr-wan'); }, 3000);
			}
		});
	}
	function recoverDp(id){
		$('#btn_re_'+id).hide();
		$('#btn_del_'+id).show();
		var url_php = "admin/admin/employee/php_action.php?action=change_status_department&id="+id;
		$.post(url_php,{ status:1 },function(data){
			console.log(data);
			if(data.result==true){
				$('#row_'+id).addClass('tr-success');
				setTimeout(function(){ $('#row_'+id).removeClass('tr-success'); }, 3000);
			}
		});
	}
	
	function calPercent(){
		var input_percent = 0;
		$('input[name="commission"]').each (function() {
		  	input_percent = input_percent + parseInt($(this).val());
		}); 
		console.log(input_percent);
		var res = 100 - parseInt(input_percent);
		if(res<0){
//			alert(res);
			
		}else{
			$('#percent_com').text(res);
		}
		return res;
	}
	
</script>
