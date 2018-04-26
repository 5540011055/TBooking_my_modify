<?php 
if($_GET[type]=="add"){ ?>
<form id="form_employee" action="" method="post">
<table cellpadding="5" cellspacing="5" style=" border:  1px solid #ddd; padding:  20px; box-shadow: 2px 2px 5px #ddd;" width="100%">
						<tr>
							<td><strong>First Name</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><input type="text" class="form-control" name="first_name" value="" /></td>
						</tr>
						<tr>
							<td><strong>Last Name</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><input type="text" class="form-control" name="last_name" value="" /></td>
						</tr>
						<tr>
							<td><strong>Gender</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td>
								<select class="form-control" name="sex">
									<option> - </option>
									<option value="1">Male</option>
									<option value="2">Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><strong>Birthday</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><input type="date" value="" class="form-control" name="birthday" /></td>
						</tr>
						<tr>
							<td><strong>Phone</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><input type="text" value="" class="form-control" name="phone" /></td>
						</tr>
						<tr>
							<td><strong>Department</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><select class="form-control" style="width: auto;" name="department">
							<option> - </option>
								<?php 
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res[dp] = $db->select_query("SELECT id,topic_th,commission FROM web_employee_department where status = 1 and admin_company = '".$_POST[id_admin_com]."' ORDER BY id ASC ");
	while($arr[dp] = $db->fetch($res[dp])){ ?>
		<option value="<?=$arr[dp][id];?>"><?=$arr[dp][topic_th];?></option>
							<? } ?>
							</select></td>
						</tr>
						<tr>
							<td><strong>Salary</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><input type="number" value="" class="form-control" /></td>
						</tr>
						<tr>
							<td><strong>Detail</strong></td>
							<td>&nbsp;:&nbsp;</td>
							<td><textarea rows="4" class="form-control" ></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><button class="btn btn-success" type="submit">Save data</button></td>
						</tr>
					</table>	
</form>
<? }

if($_GET[type]=="edit"){ ?>
	
<? }
?>