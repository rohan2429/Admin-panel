<?php 
ob_start();
include('dbconnections.php');
if(isset($_GET['id']) && isset($_GET['id1'])){
	$id = $_REQUEST['id'];
	$id1 = $_REQUEST['id1'];
	  $update = "update gu_special_events set event_title = '$id' WHERE special_event_id =$id1";
		$res=mysql_query($update);
		if($res){
			echo "Record update successfully";
		}else{
			echo "Record update fail";
		}
}else if(isset($_GET['type']) && isset($_GET['galId'])){
	   $type = $_REQUEST['type'];
		$galId = $_REQUEST['galId'];
		  $update = "update gu_gallery set type = '$type' WHERE gallery_id =$galId";
			$res=mysql_query($update);
			if($res){
				echo "success";
			}else{
				echo "fail";
			}
	   
}else if(isset($_GET['hour']) && isset($_GET['hour_id'])) 
   {
	   $hour = $_REQUEST['hour'];
		$hour_id = $_REQUEST['hour_id'];
		  $update = "update hours_of_operation set hours_oper_name = '$hour' WHERE hours_oper_id =$hour_id";
			$res=mysql_query($update);
			if($res){
				echo "success";
			}else{
				echo "fail";
			}
   }
   ob_end_flush();
?>
