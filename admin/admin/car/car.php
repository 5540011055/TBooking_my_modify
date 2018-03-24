<?
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
include("FCKeditor/fckeditor.php") ;
?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
<!--
.style_nember {font-size: 14px ;color: #333333; font-weight:bold5;}
-->
    </style>
    <script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
    </script>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TBODY>
    <TR>
      <TD width="100%"  vAlign=top><!-- Admin -->
        <TABLE width="100%" align=center cellSpacing=0 cellPadding=0 border=0>
			<TR>		    </TR>
			<TR>
				<TD valign="top"><table width="100%" border="0" cellpadding="0" bgcolor="#FFFFFF" >
                      <tr>
                        <td  class="topic_h"><img src="imagesmenu/KoolAjax.png" width="16" height="16" align="absmiddle" />&nbsp;
                         Car Management</td>
                  </tr>
                  </table>
				  <br>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="topic_menu">
                    <tr>
                      <td><A HREF="?name=admin/car&file=car"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> All Car</span></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin/car&file=car&op=other_add"><IMG SRC="images/admin/book.png"  BORDER="0" align="absmiddle"> Add New Car</span></A> &nbsp;&nbsp;&nbsp;</td>
                    </tr>
                  </table>
				  <BR>
				  <?
//////////////////////////////////////////// ??Car 
if($_GET[op] == ""){
	
	if($menu_admin_company == 1){
		if($_GET[company_tran] == ''){
			$_GET[company_tran] = 283;
		}
	}else{
		$db->connectdb(DB_NAME, DB_USERNAME, DB_PASSWORD);
		$res[sup_car] = $db->select_query("select id from web_admin where level=4 and control_transfer=1 and admin_company = '".$menu_admin_company."' ");
		$i=0;
		while($arr[sup_car] = $db->fetch($res[sup_car])){
			$data_supcar[] = $arr[sup_car];
			$i++;
			//echo $i;
		}
		$ii=0;
		if($data_supcar){
			
		$supcar .= " and ( ";
		foreach($data_supcar as $rows){
			$supcar .= " company = '".$rows[id]."' ";
			$ii++;
			if($ii < $i){
				$supcar .= " or ";	
			}
		}
		$supcar .= " )";
		}
	}
	
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 100 ;
	$SUMPAGE = $db->num_rows(TB_carall,"id"," $supcar ");
	$page=$_GET[page];
	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
                  <table width="100%" border="0" cellspacing="2" cellpadding="2" class="topic_find">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="2" style="display:<? if($_GET[op]){echo "none1";} ?>">
                          <tr>
                            <td width="60"  style="border-right:solid 0px #CCCCCC"><strong>
                              <?=ordersub_company;?>
                            </strong></td>
                            <td width="17"  style="border-right:solid 0px #CCCCCC"><strong> :</strong>
                                <? if($adminlevel ==2){
		$ag="and id=$adminid" ;} ?>
                                <? if($adminlevel ==1){
		$ag="and id=$agentcompany" ;} ?>
                                <? if($adminlevel >4){
		$ag="" ;} ?></td>
                            <td width="484"  style="border-right:solid 0px #CCCCCC"><span class="topic_menu">
                              <select name="company_tran" id="company_tran"  style="width: 300px; " onChange="MM_jumpMenu('parent',this,0)">
                                <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$res[category] = $db->select_query("SELECT * FROM ".TB_transfercompany." ORDER BY id ");
$res[category] = $db->select_query("SELECT * FROM ".TB_admin." where level=4 and control_transfer=1 $and_admin_company_inc ORDER by company  ASC   ");
while ($arr[category] = $db->fetch($res[category])){
	   echo "<option value=\"?name=admin/car&file=car&company_tran=".$arr[category][id]."&day=".$_GET[day]."\"";
	   if($arr[category][id] == $_GET[company_tran]){echo " Selected";}
	   echo ">".$arr[category][company]."</option>";
}
?>
                              </select>
                            </span></td>
                            <td width="202"  style="border-right:solid 0px #CCCCCC"><strong>สถานะ</strong></td>
                            <td width="13" align="center"  style="border-right:solid 0px #CCCCCC"><strong> :</strong></td>
                            <td width="373"  style="border-right:solid 0px #CCCCCC"><strong>
                              <select name="status" id="status"  style="width: 123px;FONT-SIZE:13px; "   onchange="MM_jumpMenu('parent',this,0)">
                                <option value="?name=admin/car&file=car&status=&company_tran=<?=$_GET[company_tran];?>"  <? if($_GET[status]==""){echo " Selected";}?>>ทั้งหมด</option>
								<option value="?name=admin/car&file=car&status=1&company_tran=<?=$_GET[company_tran];?>"  <? if($_GET[status]=="1"){echo " Selected";}?>>ทำงาน</option>
                                <option value="?name=admin/car&file=car&status=0&company_tran=<?=$_GET[company_tran];?>" <? if($_GET[status]=="0"){echo " Selected";}?>>หยุด</option>
                              </select>
                            </strong></td>
                            <td width="95"  style="border-right:solid 0px #CCCCCC">&nbsp;</td>
                            <td width="362"  style="border-right:solid 0px #CCCCCC">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                  </table>
                  <br>
                  <form action="?name=admin/car&file=car&op=other_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#990000" height=25>
   <td width="60" bgcolor="#999999"><CENTER>
     <font color="#FFFFFF">จัดการ</font>
   </CENTER></td>
   <td align="center" bgcolor="#999999"><font color="#FFFFFF">บริษัท</font></td>
   <td width="80" align="center" bgcolor="#999999"><font color="#FFFFFF">ประเภทรถ </font></td>
   <td width="39" align="center" bgcolor="#999999"><font color="#FFFFFF">No.</font></td>
   <td width="120" align="center" bgcolor="#999999"><font color="#FFFFFF">ทะเบียน </font></td>
   <td width="100" align="center" bgcolor="#999999"><font color="#FFFFFF">ยี่ห้อ</font></td>
   <td width="100" align="center" bgcolor="#999999"><font color="#FFFFFF">รุ่น</font></td>
   <td width="80" align="center" bgcolor="#999999"><font color="#FFFFFF">สีรถ</font></td>
   <td width="120" align="center" bgcolor="#999999"><font color="#FFFFFF"> เปลี่ยนน้ำมันเครื่อง </font></td>
   <td width="80" align="center" bgcolor="#999999"><font color="#FFFFFF">ระยะทาง</font></td>
   <td width="40" align="center" bgcolor="#999999"><CENTER>
     <font color="#FFFFFF">GPS</font>
   </CENTER></td>
   <td width="80" align="center" bgcolor="#999999"><font color="#FFFFFF">สถานะ</font></td>
  </tr>  
<?

if($_GET[company_tran] != ''){
	$company_tran = " and company = '".$_GET[company_tran]."' ";
}
if($_GET[status] != ''){
	$status = " and status = '".$_GET[status]."' ";
}
$res[other] = $db->select_query("SELECT * FROM ".TB_carall." where id > 0  $company_tran $status $supcar ORDER BY car_num*1 asc   ");
while($arr[other] = $db->fetch($res[other])){
	$res[category] = $db->select_query("SELECT * FROM ".TB_admin." WHERE id='".$arr[other][company]."' ");
	$arr[category] = $db->fetch($res[category]);
	$res[car_type] = $db->select_query("SELECT * FROM ".TB_carall_type." WHERE id='".$arr[other][car_type]."' ");
	$arr[car_type] = $db->fetch($res[car_type]);
			$db->update_db(TB_carall,array(
			"service"=>$arr[category][service]
		)," id=".$arr[other][id]." ");
	//Comment Icon
	if($arr[other][enable_comment]){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
			$bgcolor = ($i++ & 1) ? $bg1 : $bg2; 
 echo "<tr bgcolor='$bgcolor'>\n";
?>
<td align="center">
<script>
	function chk_dellll(){
		if(confirm("Are you sure to delete now !!")){
			return true;
		}else{
			return false;
		}
	}
	//?name=admin/car&file=car&op=other_del&id=<? echo $arr[other][id];?>&prefix=<? echo $arr[other][post_date];?>
</script>
      <a href="?name=admin/car&file=car&op=other_edit&id=<? echo $arr[other][id];?>"><img src="images/admin/edit.png" border="0" alt="Edit" ></a>  &nbsp;&nbsp;&nbsp;     <a href="?name=admin/car&file=car&op=other_del&id=<? echo $arr[other][id];?>&prefix=<? echo $arr[other][post_date];?>" onClick="return chk_dellll();"  ><img src="images/admin/trash.png"  border="0" alt="Delete"  ></a> </td> 
 <? if($arr[other][plate_color]=="Green"){
	 $plate_color="009999"; } ?>
	 	 <? if($arr[other][plate_color]=="Yellow"){
	 $plate_color="FFCC00"; } ?>
	 	 	 <? if($arr[other][plate_color]=="Black"){
	 $plate_color="FFFFFF"; } ?>
	 	 	 	 <? if($arr[other][plate_color]=="Red"){
	 $plate_color="FF0000"; } ?>
     <td height="30" align="center"><? echo  $arr[category][company];?></a></td>
     <td align="center"><?echo $arr[car_type][topic_en];?></td>
     <td align="center"><b><font color="#009999" size="+1"><?echo $arr[other][car_num];?></td>
     <td width="80" align="center" bgcolor="#<?=$plate_color?>" style="border: solid 1px; color:#CCCCCC; padding:2px;"><font color="#<? if($arr[other][plate_color]=="Green"){
	 echo "FFFFFF"; } ?>" size="+1"><b><? echo $arr[other][plate_num];?><br>
       <font size="2"><? echo $arr[other][province];?></td>
     <td width="80" align="center"><?echo $arr[other][car_brand];?></td>
     <td width="80" align="center"><?echo $arr[other][car_sub_brand];?></td>
     <td align="center"><?echo $arr[other][car_color];?></td>
     <td align="center"><?echo $arr[other][oil_last];?></td>
     <td align="center"><span class="style_nember">
       <?=number_format( $arr[other][mile_num] , 2 );?>
     </span></td>
     <td align="center"><?echo $arr[other][gps];?> </td>
     <td align="center"><span style="display:none <? if($adminlevel ==2 or $adminlevel ==1 ){ echo "" ; } ?><? if($adminlevel > 4 ){echo "1" ;} ?>">
       <? if($arr[other][status]==1){
	   echo "<a href=?name=admin/car&file=car&op=status&id=".$arr[other][id]."&status=0><b><font size=3><font color=#FF3300>ทำงาน</a> ";
	   }
;?>
       <? if($arr[other][status]==0 or $arr[other][status]==""){
	   echo "<a href=?name=admin/car&file=car&op=status&id=".$arr[other][id]."&status=1><b><font size=3><font color=#000000>หยุด</a> ";
	   }
;?>
     </span></td>
</tr>
	<TR>
		<TD colspan="18" height="1" class="dotline"></TD>
	</TR>
<?
 } 
?>
 </table>
 <div align="right"></div>
 </form> 
 <!--<span class="page"><?=button_page;?>: </span>-->
<?
	/*SplitPage($page,$totalpage,"?name=admin/car&file=car");
	echo $ShowSumPages ;
	echo $ShowPages ;
*/
}
else if($_GET[op] == "other_add" AND $_GET[action] == "add"){
	//////////////////////////////////////////// ? Database
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		//include("includes/class.resizepic.php");
		include("includes/class.cropcanvas.php");
		include('includes/class.cropinterface.php');
		$ci =& new CropInterface(true);
////////////////////// Parameter 2 server
$params['company'] = $_POST[company];
$params['car_type'] = $_POST[car_type];
$params['car_brand'] = $_POST[car_brand];
$params['car_sub_brand'] = $_POST[car_sub_brand];
$params['car_color'] = $_POST[car_color];
$params['car_num'] = $_POST[car_num];
$params['plate_num'] = $_POST[plate_num];
$params['province'] = $_POST[province];
$params['plate_color'] = $_POST[plate_color];
$params['insure_company'] = $_POST[insure_company];
$params['insure_num'] = $_POST[insure_num];
$params['insure_phone'] = $_POST[insure_phone];
$params['mile_num'] = $_POST[mile_num];
$params['mile_last'] = $_POST[mile_last];
$params['oil_last'] = $_POST[oil_last];
$params['exp_insur'] = $_POST[exp_insur];
$params['exp_act'] = $_POST[exp_act];
$params['car_serial'] = $_POST[car_serial];
$params['model_serial'] = $_POST[model_serial];
$params['tax_date'] = $_POST[tax_date];
$params['exp_date'] = $_POST[exp_date];
$params['gps'] = $_POST[gps];
$params['remark'] = $_POST[remark];
$params['posted'] = $_SESSION[admin_user];
$params['post_date'] = TIMESTAMP;
$params['update_date'] = TIMESTAMP;
$params['enable_comment'] = $_POST[ENABLE_COMMENT];

$params['exp_gps'] = $_POST[exp_gps];
/**
* 
* @var ********* START insert
* 
*/
////////////// insert Thailand Server
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_carall,$params);
		$last_id = mysql_insert_id();
		$db->closedb ();
////////////// insert China Server	
$params['id'] = $last_id;		
		//*
		$db->connectdb_cn(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_carall,$params);
		$db->closedb ();
		//*/
/**
* 
* @var ********* END insert
* 
*/		
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/admin.png\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>Add Car  complete</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin/car&file=car\"><B>Back to Car </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//??
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET[op] == "other_add"){
	//////////////////////////////////////////// ? Form
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
?>
<FORM NAME="frmMain" METHOD=POST ACTION="?name=admin/car&file=car&op=other_add&action=add" id="inviter">
  <table width="100%" border="0" cellspacing="5" cellpadding="3">
    <tr>
      <td width="25%" align="right">Company  : </td>
      <td><select  name="company" id="company" style="width:380px;" onChange="return find_tour_product();find_tour_time();" >
          <option value="">--
            <?=book_select;?>
            --</option>
          <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[programtour] = $db->select_query("SELECT id,company,company_cn FROM ".TB_admin." where level=4 and control_transfer='1' and status ='1' $and_admin_company_inc ORDER BY company  ");
while ($arr[programtour] = $db->fetch($res[programtour])){
	   echo "<option value=\"".$arr[programtour][id]."\"";
	   if($arr[programtour][id] == $arr[newsvc][company]){echo " Selected";}
	  // echo ">".$arr[programtour][company]."</option>";
	  	if($_SESSION['lang'] == "en"){echo ">".$arr[programtour][company]." </option>";}
	   if($_SESSION['lang'] == "cn"){echo ">".$arr[programtour][company]." - ".$arr[programtour][company_cn]."</option>";}
	   if($_SESSION['lang'] == "th"){echo ">".$arr[programtour][company]."</option>";}
	   if($_SESSION['lang'] == "jp"){echo ">".$arr[programtour][company]."</option>";}
}
$db->closedb ();
?>
      </select></td>
    </tr>
    <tr>
      <td align="right">ประเภทรถ : </td>
      <td><select  name="car_type" id="car_type" style="width:380px;" onChange="return find_tour_product();find_tour_time();" >
          <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[programtour] = $db->select_query("SELECT * from  ".TB_carall_type."  ");
while ($arr[programtour] = $db->fetch($res[programtour])){
	   echo "<option value=\"".$arr[programtour][id]."\"";
	   if($arr[programtour][id] == $arr[newsvc][company]){echo " Selected";}
	  // echo ">".$arr[programtour][company]."</option>";
	  	if($_SESSION['lang'] == "en"){echo ">".$arr[programtour][topic_en]." </option>";}
	   if($_SESSION['lang'] == "cn"){echo ">".$arr[programtour][topic_en]." - ".$arr[programtour][company_cn]."</option>";}
	   if($_SESSION['lang'] == "th"){echo ">".$arr[programtour][topic_en]."</option>";}
	   if($_SESSION['lang'] == "jp"){echo ">".$arr[programtour][topic_en]."</option>";}
}
$db->closedb ();
?>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">ยี่ห้อรถ : </td>
      <td><select name="car_brand" id="ctl00_Menu_Control1_DDl_Brand" class="DDl_Brand" onChange="return GenModel(this.value)">
          <option value="BMW">BMW</option>
          <option value="CHEVROLET">CHEVROLET</option>
          <option value="FORD">FORD</option>
          <option value="HYUNDAI">HYUNDAI</option>
          <option value="ISUZU">ISUZU</option>
          <option value="LEXUS">LEXUS</option>
          <option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
          <option value="MITSUBISHI">MITSUBISHI</option>
          <option value="NISSAN">NISSAN</option>
          <option value="OPEL">OPEL</option>
          <option value="SUBARU">SUBARU</option>
          <option value="SUZUKI">SUZUKI</option>
          <option value="TOYOTA" selected >TOYOTA</option>
          <option value="VOLVO">VOLVO</option>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">รุ่น : </td>
      <td><input name="car_sub_brand" type="text" id="car_sub_brand" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">สีรถ : </td>
      <td><label>
        <select name="car_color" id="car_color">
          <option value="White" selected>White</option>
          <option value="Black">Black</option>
          <option value="Golden Bronze">Golden Bronze</option>
          <option value="Silver Bronze">Silver Bronze</option>
        </select>
        </label>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเลขรถ : </td>
      <td><select name="car_num" id="car_num">
          <?PHP for($i=1; $i<=999; $i++) {?>
          <option value="<?PHP echo $i?>" <? if($arr[product][carno]== $i){echo "selected=selected";}?> ><?PHP echo $i+0?></option>
          <?PHP } ?>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">ทะเบียนรถ : </td>
      <td><input name="plate_num" type="text" id="plate_num" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">จังหวัด : </td>
      <td><input name="province" type="text" id="province" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">สีทะเบียนรถ : </td>
      <td><table width="180"   border="0" cellpadding="0" cellspacing="2" style="height:10px;">
          <tr>
            <td width="20"><input name="plate_color" type="radio" value="Green" checked <? if($arr[other][plate_color]=="Green"){echo " Checked";};?>>            </td>
            <td bgcolor="#009999">&nbsp;</td>
            <td width="20"><input name="plate_color" type="radio" value="Yellow" <? if($arr[other][plate_color]=="Yellow"){echo " Checked";};?>></td>
            <td bgcolor="#FFCC00">&nbsp;</td>
            <td width="20"><input name="plate_color" type="radio" value="Black" <? if($arr[other][plate_color]=="Black"){echo " Checked";};?>></td>
            <td bgcolor="#000000">&nbsp;</td>
            <td width="20"><input name="plate_color" type="radio" value="Black" <? if($arr[other][plate_color]=="Black"){echo " Checked";};?>></td>
            <td bgcolor="#FF0000">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="right">บริษัทประกันภัย : </td>
      <td><input name="insure_company" type="text" id="insure_company" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเลขประกันภัย : </td>
      <td><input name="insure_num" type="text" id="insure_num" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">เบอร์โทรศัพท์ประกันภัย : </td>
      <td><input name="insure_phone" type="text" id="insure_phone" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">เปลี่ยนน้ำมันเครื่องล่าสุด : </td>
      <td><input name="oil_last" id="oil_last" style="width:120px; FONT-SIZE:13px; " value="<? if(!$arr[product][ondate]){ echo $arr[product][outdate] ;} else {echo $arr[product][ondate];} ?>" readonly="readonly" />
          <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('oil_last', false, 'ymd', '-');" /><strong> </strong>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">ระยะเข็มไมล์ : </td>
      <td><input name="mile_num" type="text" id="mile_num" value="" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">วันหมด ประกันภัย: </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="exp_insur" id="exp_insur" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[newsvc][ondate];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_insur', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
    <tr>
      <td align="right">วันหมดพรบ : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="exp_act" id="exp_act" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[newsvc][ondate];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_act', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
    <tr>
      <td align="right">เลขเครื่อง : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="car_serial" id="car_serial"   value="<?=$arr[newsvc][car_serial];?>" size="50" />
      </font></td>
    </tr>
	<tr>
      <td align="right">เลขตัวถัง : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="model_serial" id="model_serial"   value="<?=$arr[newsvc][model_serial];?>" size="50" />
      </font></td>
    </tr>
	<tr>
      <td align="right">วันเสียภาษี : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="tax_date" id="tax_date" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[newsvc][tax_date];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('tax_date', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
	<tr>
      <td align="right">หมดอายุ : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="exp_date" id="exp_date" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[newsvc][exp_date];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_date', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
    <tr>
      <td align="right">ระบบ GPS  : </td>
      <td><label>
        <select name="gps" id="gps">
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
        </label>
        &nbsp;</td>
    </tr>
    <script>
    	$('#gps').change(function(){
    		if($(this).val()=="Yes"){
				$('#exp_gps_row').show();
			}else{
				$('#exp_gps_row').hide();
			}
    	});
    </script>
    <tr id="exp_gps_row">
      <td align="right">วันหมดอายุ GPS : </td>
      <td>
      <input name="exp_gps" id="exp_gps" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][exp_gps];?>" readonly="readonly" />
      <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_gps', false, 'ymd', '-');" /><strong> </strong>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเหตุ  : </td>
      <td>
      <textarea name="remark" id="remark" style="width: 389px;" ><?=$arr[other][remark];?></textarea>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" class="myButton" value="Add New Car" name="submit2" /></td>
    </tr>
  </table>
  <script>
$("#inviter").submit(function(){
    $("#sendingmail").html("<center> ...");
    return true;
});
</script>
      </FORM>
<?
	}else{
		//??
		echo  $PermissionFalse ;
	}
}
else if($_GET[op] == "other_edit" AND $_GET[action] == "edit"){
	//////////////////////////////////////////// ? Database Edit
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		//?
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res[other] = $db->select_query("SELECT * FROM ".TB_carall." WHERE id='".$_GET[id]."' ");
		$arr[other] = $db->fetch($res[other]);
		$db->closedb ();
		//include("includes/class.resizepic.php");
////////////////////// Parameter 2 server
$params['company'] = $_POST[company];
$params['car_type'] = $_POST[car_type];
$params['car_brand'] = $_POST[car_brand];
$params['car_sub_brand'] = $_POST[car_sub_brand];
$params['car_color'] = $_POST[car_color];
$params['car_num'] = $_POST[car_num];
$params['plate_num'] = $_POST[plate_num];
$params['province'] = $_POST[province];
$params['plate_color'] = $_POST[plate_color];
$params['insure_company'] = $_POST[insure_company];
$params['insure_num'] = $_POST[insure_num];
$params['insure_phone'] = $_POST[insure_phone];
$params['mile_num'] = $_POST[mile_num];
$params['mile_last'] = $_POST[mile_last];
$params['oil_last'] = $_POST[oil_last];
$params['exp_insur'] = $_POST[exp_insur];
$params['exp_act'] = $_POST[exp_act];
$params['car_serial'] = $_POST[car_serial];
$params['model_serial'] = $_POST[model_serial];
$params['tax_date'] = $_POST[tax_date];
$params['exp_date'] = $_POST[exp_date];
$params['gps'] = $_POST[gps];
$params['remark'] = $_POST[remark];
$params['posted'] = $_SESSION[admin_user];
$params['update_date'] = TIMESTAMP;
$params['enable_comment'] = $_POST[ENABLE_COMMENT];

$params['exp_gps'] = $_POST[exp_gps];
/**
* 
* @var ********* START Update 
* 
*/
////////////// insert Thailand Server
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_carall,$params," id=$_GET[id] ");
		$db->closedb ();
////////////// insert China Server		
		//*
		$db->connectdb_cn(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_carall,$params," id=$_GET[id] ");
		$db->closedb ();
		//*/
/**
* 
* @var ********* END Update 
* 
*/		
		//?? text ?
		$Filename = $arr[other][post_date].".txt";
		$txt_name = "data/otherdata/".$Filename."";
		$txt_open = @fopen("$txt_name", "w");
		@fwrite($txt_open, "".$_POST[DETAIL]."");
		@fclose($txt_open);
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/admin.png\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>Edit Car complete</B></FONT><BR><BR>";
echo "<meta http-equiv=refresh content=0;URL=?name=admin/car&file=car>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//??
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET[op] == "other_edit"){
	//////////////////////////////////////////// ? Form
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		//?
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res[other] = $db->select_query("SELECT * FROM ".TB_carall." WHERE id='".$_GET[id]."' ");
		$arr[other] = $db->fetch($res[other]);
		$db->closedb ();
		//??? Text 
		$FileNewsTopic = "data/otherdata/".$arr[other][post_date].".txt";
		$file_open = @fopen($FileNewsTopic, "r");
		$TextContent = @fread ($file_open, @filesize($FileNewsTopic));
		@fclose ($file_open);
		$TextContent = stripslashes($TextContent);
?>
<FORM NAME="frmMain"  METHOD="POST" ACTION="?name=admin/car&file=car&op=other_edit&action=edit&id=<?=$_GET[id];?>" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="5" cellpadding="3">
    <tr>
      <td width="25%" align="right">Company  : </td>
      <td><select  name="company" id="company" style="width:380px;" onChange="return find_tour_product();find_tour_time();" >
          <option value="">--
            <?=book_select;?>
            --</option>
          <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[programtour] = $db->select_query("SELECT id,company,company_cn FROM ".TB_admin." where level=4 and control_transfer='1' and status ='1' $and_admin_company_inc ORDER BY company  ");
while ($arr[programtour] = $db->fetch($res[programtour])){
	   echo "<option value=\"".$arr[programtour][id]."\"";
	   if($arr[programtour][id] == $arr[other][company]){echo " Selected";}
	  // echo ">".$arr[programtour][company]."</option>";
	  	if($_SESSION['lang'] == "en"){echo ">".$arr[programtour][company]." </option>";}
	   if($_SESSION['lang'] == "cn"){echo ">".$arr[programtour][company]." - ".$arr[programtour][company_cn]."</option>";}
	   if($_SESSION['lang'] == "th"){echo ">".$arr[programtour][company]."</option>";}
	   if($_SESSION['lang'] == "jp"){echo ">".$arr[programtour][company]."</option>";}
}
$db->closedb ();
?>
      </select></td>
    </tr>
    <tr>
      <td align="right">ประเภทรถ : </td>
      <td><select  name="car_type" id="car_type" style="width:380px;" onChange="return find_tour_product();find_tour_time();" >
          <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[programtour] = $db->select_query("SELECT * from  ".TB_carall_type."  ");
while ($arr[programtour] = $db->fetch($res[programtour])){
	   echo "<option value=\"".$arr[programtour][id]."\"";
	   if($arr[programtour][id] == $arr[other][car_type]){echo " Selected";}
	  // echo ">".$arr[programtour][company]."</option>";
	  	if($_SESSION['lang'] == "en"){echo ">".$arr[programtour][topic_en]." </option>";}
	   if($_SESSION['lang'] == "cn"){echo ">".$arr[programtour][topic_en]." - ".$arr[programtour][company_cn]."</option>";}
	   if($_SESSION['lang'] == "th"){echo ">".$arr[programtour][topic_en]."</option>";}
	   if($_SESSION['lang'] == "jp"){echo ">".$arr[programtour][topic_en]."</option>";}
}
$db->closedb ();
?>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">ยี่ห้อรถ : </td>
      <td><select name="car_brand" id="car_brand" class="DDl_Brand" onChange="return GenModel(this.value)">
	  <option value="<?=$arr[other][car_brand];?>" selected><?=$arr[other][car_brand];?></option>
          <option value="BMW">BMW</option>
          <option value="CHEVROLET">CHEVROLET</option>
          <option value="FORD">FORD</option>
          <option value="HYUNDAI">HYUNDAI</option>
          <option value="ISUZU">ISUZU</option>
          <option value="LEXUS">LEXUS</option>
          <option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
          <option value="MITSUBISHI">MITSUBISHI</option>
          <option value="NISSAN">NISSAN</option>
          <option value="OPEL">OPEL</option>
          <option value="SUBARU">SUBARU</option>
          <option value="SUZUKI">SUZUKI</option>
          <option value="TOYOTA" >TOYOTA</option>
          <option value="VOLVO">VOLVO</option>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">รุ่น : </td>
      <td><input name="car_sub_brand" type="text" id="car_sub_brand" value="<?=$arr[other][car_sub_brand];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">สีรถ : </td>
      <td><label>
        <select name="car_color" id="car_color">
		<option value="<?=$arr[other][car_color];?>" selected><?=$arr[other][car_color];?></option>
				<option value="White"  >White</option>
		       <option value="Black">Black</option>
			   	<option value="Golden Bronze">Golden Bronze</option>
		       <option value="Silver Bronze">Silver Bronze</option>
        </select>
        </label>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเลขรถ : </td>
      <td><select name="car_num" id="car_num">
          <?PHP for($i=1; $i<=999; $i++) {?>
          <option value="<?PHP echo $i?>" <? if($arr[other][car_num]== $i){echo "selected=selected";}?> ><?PHP echo $i+0?></option>
          <?PHP } ?>
        </select>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">ทะเบียนรถ : </td>
      <td><input name="plate_num" type="text" id="plate_num" value="<?=$arr[other][plate_num];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">จังหวัด : </td>
      <td><input name="province" type="text" id="province" value="<?=$arr[other][province];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">สีทะเบียนรถ : </td>
      <td><table width="180"   border="0" cellpadding="0" cellspacing="2" style="height:10px;">
        <tr>
          <td width="20"> 
            <input name="plate_color" type="radio" value="Green" <? if($arr[other][plate_color]=="Green"){echo " Checked";};?>>         </td>
          <td bgcolor="#009999">&nbsp;</td>
          <td width="20"><input name="plate_color" type="radio" value="Yellow" <? if($arr[other][plate_color]=="Yellow"){echo " Checked";};?>></td>
          <td bgcolor="#FFCC00">&nbsp;</td>
          <td width="20"><input name="plate_color" type="radio" value="Black" <? if($arr[other][plate_color]=="Black"){echo " Checked";};?>></td>
          <td bgcolor="#000000">&nbsp;</td>
          <td width="20"><input name="plate_color" type="radio" value="Red" <? if($arr[other][plate_color]=="Red"){echo " Checked";};?>></td>
          <td bgcolor="#FF0000">&nbsp;</td>
        </tr>
      </table> </td>
    </tr>
    <tr>
      <td align="right">บริษัทประกันภัย : </td>
      <td><input name="insure_company" type="text" id="insure_company" value="<?=$arr[other][insure_company];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเลขประกันภัย : </td>
      <td><input name="insure_num" type="text" id="insure_num" value="<?=$arr[other][insure_num];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">เบอร์โทรศัพท์ประกันภัย : </td>
      <td><input name="insure_phone" type="text" id="insure_phone" value="<?=$arr[other][insure_phone];?>" size="50">
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">เปลี่ยนน้ำมันเครื่องล่าสุด : </td>
      <td><input name="oil_last" id="oil_last" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][oil_last];?>" readonly="readonly" />
          <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('oil_last', false, 'ymd', '-');" /><strong> </strong>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">ระยะเข็มไมล์ : </td>
      <td><input name="mile_num" type="text" id="mile_num" value="<?=$arr[other][mile_num];?>" size="50">
        &nbsp;</td>
    </tr>
	 <tr>
          <td align="right">วันหมด ประกันภัย: </td>
          <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input name="exp_insur" id="exp_insur" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][exp_insur];?>" />
            <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_insur', false, 'ymd', '-');" />&nbsp;<span class="date-input">
            <label></label>
            </font></td>
        </tr>
		  <tr>
          <td align="right">วันหมดพรบ : </td>
          <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
            <input name="exp_act" id="exp_act" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][exp_act];?>" />
            <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_act', false, 'ymd', '-');" />&nbsp;<span class="date-input">
            <label></label>
            </font></td>
        </tr>
	<tr>
      <td align="right">เลขเครื่อง : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="car_serial" id="car_serial"   value="<?=$arr[other][car_serial];?>"  size="50" />
      </font></td>
    </tr>
	<tr>
      <td align="right">เลขตัวถัง : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="model_serial" id="model_serial"   value="<?=$arr[other][model_serial];?>"  size="50" />
      </font></td>
    </tr>
	<tr>
      <td align="right">วันเสียภาษี : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="tax_date" id="tax_date" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][tax_date];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('tax_date', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
	<tr>
      <td align="right">หมดอายุ : </td>
      <td><font size="2" face="MS Sans Serif, Tahoma, sans-serif">
        <input name="exp_date" id="exp_date" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][exp_date];?>" />
        <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_date', false, 'ymd', '-');" />&nbsp;<span class="date-input">
        <label></label>
      </font></td>
    </tr>
    <tr>
      <td align="right">ระบบ GPS  : </td>
      <td><label>
      <?php 
      $array_gps = array('Yes','No');
      ?>
        <select name="gps" id="gps">
		<!--<option value="<?=$arr[other][gps];?>"><?=$arr[other][gps];?></option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>-->
          <? foreach($array_gps as $key=>$val){
          	if($val==$arr[other][gps]){
				$selected = "selected";
			}else{
				$selected = "";
			} ?>
			<option value="<?=$val;?>" <?=$selected;?>><?=$val;?></option>
         <? } ?>
        </select>
        </label>
        &nbsp;</td>
    </tr>
    <script>
    	$('#gps').change(function(){
    		if($(this).val()=="Yes"){
				$('#exp_gps_row').show();
			}else{
				$('#exp_gps_row').hide();
			}
    	});
    </script>
    <?php 
    	  if($arr[other][gps]=="Yes"){
		  		$none_gps = '';
		  }else{
		  		$none_gps = 'display:none;';
		  }
    	?>
    <tr style="<?=$none_gps;?>" id="exp_gps_row">
      <td align="right">วันหมดอายุ GPS : </td>
      <td>
      <input name="exp_gps" id="exp_gps" style="width:120px; FONT-SIZE:13px; " value="<?=$arr[other][exp_gps];?>" readonly="readonly" />
      <img src="images/admin/dateselect.gif" alt="ondate" border="0" align="absmiddle" onClick="displayDatePicker('exp_gps', false, 'ymd', '-');" /><strong> </strong>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">หมายเหตุ  : </td>
      <td>
      <textarea name="remark" id="remark" style="width: 389px;" ><?=$arr[other][remark];?></textarea>
        &nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" class="myButton" value="Edit Car" name="submit" /></td>
    </tr>
  </table>
</FORM>
<?
	}else{
		//??
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET[op] == "other_del" AND $_GET[action] == "multidel"){
	//////////////////////////////////////////// ?? Multi
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res[other] = $db->select_query("SELECT * FROM ".TB_carall." WHERE id='".$value."' ");
			$arr[other] = $db->fetch($res[other]);
			$db->del(TB_carall," id='".$value."' "); 
			$db->closedb ();
			@unlink("data/otherdata/".$arr[other][post_date].".txt");
			@unlink("othericon/".$arr[other][post_date].".jpg");
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/admin.png\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>Delete Car complete</B></FONT><BR><BR>";
echo "<meta http-equiv=refresh content=0;URL=?name=admin/car&file=car>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//??
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET[op] == "other_del"){
	//////////////////////////////////////////// ?? Form
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_carall," id='".$_GET[id]."' "); 
		$db->closedb ();
		@unlink("data/otherdata/".$_GET[prefix].".txt");
		@unlink("othericon/".$_GET[prefix].".jpg");
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/admin.png\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>Delete Car complete</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin/car&file=car\"><B>Back to Car</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//??
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
if($_GET[op] == "status"){
	//////////////////////////////////////////// óź Multi
	if(1==1){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_carall,array(
			"status"=>"$_GET[status]"
		)," id=$_GET[id] ");
	$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
		echo "<meta http-equiv=refresh content=0;URL=?name=admin/car&file=car>";
	}else{
		//óҹ
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
} 
?>			  </TD>
			</TR>
	    </TABLE>
	  <!-- Admin -->		  </TD>
    </TR>
  </TBODY>
</TABLE>