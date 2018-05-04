<div style="margin: 10px;">
	
	<table>
		<tr>
			<td><button class="btn btn-info" style=" background-color: #138496;" id="add_em" >Add Employee</button></td>
		</tr>
	</table>
	
</div>

<div id="custom_dialog" style="width: 100%;height: 100%;position:  fixed;z-index: 999;background-color: #00000057;top: 0px;left: 0px;display: none;">
	<div class="modal-dialog w3-animate-bottom" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="dialoglLabel">Add Employee</h4>
				</div>

				<div class="modal-body" id="load_modal_body">
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-dialog" onclick="$('#custom_dialog').hide();">Cancel</button>
					<button type="button" class="btn btn-dialog">Ok</button>
				</div>
			</div><!-- modal-content -->
		</div>
</div>

<script>
	$('#add_em').click(function(){
		$('#custom_dialog').show();
		var url = "empty_style.php?name=admin/employee&file=form_employee&type=add";
		$('#load_modal_body').load(url);
	});
</script>