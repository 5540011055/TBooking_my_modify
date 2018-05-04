<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
<link href="themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/plugins/sortable.js" type="text/javascript"></script>
<script src="js/fileinput.js" type="text/javascript"></script>
<script src="js/locales/fr.js" type="text/javascript"></script>
<script src="js/locales/es.js" type="text/javascript"></script>
<script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="themes/fa/theme.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css" />
<style>
   .file-drop-zone{
   height: auto !important;
   }
</style>
<? 
	include('../../../../includes/class.mysql.php'); 
	include('../../../../includes/config.in.php'); 
	$db = new DB();
?>
<div style="padding: 10px;">
	<table>
		<tr>
   <?php 
//   echo $_GET[id];
   $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
   $count = $db->num_rows("doc_files_car","id","status = 1 and car_number = '".$_GET[id]."' and date_insurance = '".$_GET[date]."' ");
   if($count>0){
   $res[img] = $db->select_query("SELECT id,name_file,car_number,date_insurance FROM doc_files_car where status = 1 and car_number = '".$_GET[id]."' and date_insurance = '".$_GET[date]."' order by id asc ");
   $num = 1;
    while($arr[img] = $db->fetch($res[img])){  
    if($num>3){ 
    	$tr = "<tr>";
    	$tr_c = "</tr>";
    	$num = 0;
    }else{
		$tr = "";
    	$tr_c = "";
	}
   ?>
   <?=$tr;?>
   <td>
   <div id="box_img_<?=$arr[img][id];?>" class="file-preview-frame krajee-default  kv-preview-thumb" style="float:unset!important;width: 225px;" >
      <div class="kv-file-content">
         <img src="../../../../file_upload_car/doc/<?=$arr[img][name_file];?>" class="file-preview-image kv-preview-data" title="repair_logo.png" alt="repair_logo.png" style="width:auto;height:auto;max-width:100%;max-height:100%;">
      </div>
      <div class="file-thumbnail-footer">
         <div class="file-footer-caption" title="repair_logo.png">
            <div class="file-caption-info"><?=$arr[img][name_file];?></div>
            <div class="file-size-info"> <samp><?=$arr[img][date_insurance];?></samp></div>
         </div>
         <div class="file-actions">
            <div class="file-footer-buttons">
               <button type="button" class="kv-file-remove btn btn-sm btn-kv btn-default btn-outline-secondary" title="Remove file" onclick="deletedImg('<?=$arr[img][id];?>','<?=$arr[img][name_file];?>');">
               <i class="glyphicon glyphicon-trash"></i></button>
               <button type="button" class="kv-file-zoom btn btn-sm btn-kv btn-default btn-outline-secondary" title="View Details" onclick="viewImg('<?=$arr[img][id];?>');" >
               <i class="glyphicon glyphicon-zoom-in"></i></button>  
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
   </td>
   <?=$tr_c;?>
   <? 
   $num ++;
   		} 
   }?>
   
		</tr>
	</table>
</div>
<div class="kv-main">
   <form enctype="multipart/form-data" action="upload.php?type=add&id=<?=$_GET[id];?>&date=<?=$_GET[date];?>"  method="post" name="insert_pic" id="insert_pic">
      <div class="form-group">
         <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" name="files[]">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
   </form>
</div>
<script>
   $("#file-1").fileinput({
   	uploadUrl: '#',
   	showUpload: false,
       allowedFileExtensions: ['jpg', 'png', 'gif'],
       overwriteInitial: false,
       maxFileSize: 1000,
       maxFilesNum: 10,
       //allowedFileTypes: ['image', 'video', 'flash'],
       slugCallback: function (filename) {
           return filename.replace('(', '_').replace(']', '_');
       }
   });
   
   $("#file-3").fileinput({
       theme: 'fa',
       showUpload: false,
       showCaption: false,
       browseClass: "btn btn-primary btn-lg",
       fileType: "any",
       previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
       overwriteInitial: false,
       initialPreviewAsData: true,
       initialPreview: [
           "http://lorempixel.com/1920/1080/transport/1",
           "http://lorempixel.com/1920/1080/transport/2",
           "http://lorempixel.com/1920/1080/transport/3"
       ],
       initialPreviewConfig: [
           {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
           {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
           {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
       ]
   });
   $("#file-4").fileinput({
       theme: 'fa',
       uploadExtraData: {kvId: '10'}
   });
   $(".btn-warning").on('click', function () {
       var $el = $("#file-4");
       if ($el.attr('disabled')) {
           $el.fileinput('enable');
       } else {
           $el.fileinput('disable');
       }
   });
   $(".btn-info").on('click', function () {
       $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
   });
   
   $(document).ready(function () {
       $("#test-upload").fileinput({
           'theme': 'fa',
           'showPreview': false,
           'allowedFileExtensions': ['jpg', 'png', 'gif'],
           'elErrorContainer': '#errorBlock'
       });
       $("#kv-explorer").fileinput({
           'theme': 'explorer-fa',
           'uploadUrl': 'upload.php?type=add',
           overwriteInitial: false,
           initialPreviewAsData: true,
           initialPreview: [
               "http://lorempixel.com/1920/1080/nature/1",
               "http://lorempixel.com/1920/1080/nature/2",
               "http://lorempixel.com/1920/1080/nature/3"
           ],
           initialPreviewConfig: [
               {caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
               {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
               {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
           ]
       });
      
   });
</script>

<script>
	function deletedImg(id,fname){
		swal({
		  title: "ยืนยันลบภาพ",
		  text: "",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "ยืนยัน",
		  cancelButtonText: "ยกเลิก",
		  closeOnConfirm: false
		},
		function(isConfirm){
			if(isConfirm){
				var car_num = '<?=$_GET[id];?>';
				var pic_id = id;
				$.post('upload.php?type=deleted',{pic_id:pic_id , car_num:car_num ,fname,fname},function(data){
					console.log(data);
					if(data.del_f==true){
						swal("Deleted!", "Your imaginary file has been deleted.", "success");
						$('#box_img_'+id).remove();
					}
					
				});
			}
			
		  
		});
	}
</script>