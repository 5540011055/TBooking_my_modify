<link rel="stylesheet" href="admin/admin/employee/boostrap4.css?v=<?=time();?>" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
<div style="padding: 0px 10px;height: auto;">
<div>
	<table>
		<tr>
			<td><button class="btn btn-md" style="background-color:#4bb1c1;color: #fff;" id="department_load">Department</button></td>
			<td>&nbsp;</td>
			<td><button class="btn btn-md" style="background-color:#4bb1c1;color: #fff;" id="employee_load">Employee</button></td>
		</tr>
	</table>
</div>

<div id="load_main">
	
</div>

</div>


<script>
	$('#department_load').click();	
	var loader =	'<div class="container_load" id="loader">'+
						'<div class="row">'+
							'<div id="loader">'+
					    		'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="dot"></div>'+
								'<div class="lading"></div>'+
							'</div>'+
						'</div>'+
					'</div>'

	$('#department_load').click(function(){
		$('#load_main').html(loader);
		var url = "empty_style.php?name=admin/employee&file=manage_department";
		setTimeout(function(){ $('#load_main').load(url); }, 700);
	});
	
	$('#employee_load').click(function(){
		swal("ยังไม่เปิดให้ใช้งาน");
		return;
		$('#load_main').html(loader);
		var url = "empty_style.php?name=admin/employee&file=manage_employee";
		setTimeout(function(){ $('#load_main').load(url); }, 700);
	});
</script>