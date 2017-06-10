<?php
session_start();
ob_start();
include 'dbconnections.php';
$action = $_REQUEST['action'];
if($action == 'deleteCat'){
//Below code for delete categories	
	$category_id=$_REQUEST['category_id'];
	$category_image=$_REQUEST['category_image'];
	$sql="delete from gu_categories where category_id=$category_id";
	$res=mysql_query($sql);
	if($res){
		
		unlink($category_image);
		$_SESSION['res4']=="success";
		header("location:view_categories.php");
	}else{
		$_SESSION['res4']=="fail";
		header("location:view_categories.php");
	}
	
}else if($action == 'deleteSpecial'){
//Below code for delete Sub categories		
	$special_event_id=$_REQUEST['special_event_id'];
	$sql="delete from gu_special_events where special_event_id=$special_event_id";
	$res=mysql_query($sql);
	if($res){
		
		
		$_SESSION['res4']=="success";
		header("location:view_special_events.php");

	}else{
		$_SESSION['res4']=="fail";
		header("location:view_special_events.php");
	}
}else if($action == 'view_gallery'){
	$gallery_id=$_REQUEST['gallery_id'];
	$sql="delete from gu_gallery where gallery_id=$gallery_id";
	$res=mysql_query($sql);
	if($res){
		
		$_SESSION['res4']=="success";
		header('location:view_gallery.php');
	}
	else{
		$_SESSION['res4']=="fail";
		header('location:view_gallery.php');
	}
	
}else if($action == 'view_event'){
	$event_id=$_REQUEST['event_id'];
	$sub_category_id=$_REQUEST['sub_category_id'];
	$sql="delete from gu_events where event_id='$event_id'";
	$res=mysql_query($sql);
	if($res){
		
		unlink($category_image);
		$_SESSION['res4']=="success";
		header('location:view_event.php?sub_category_id='.$sub_category_id);
	}
	else{
		$_SESSION['res4']=="fail";
		header('location:view_event.php?sub_category_id='.$sub_category_id);
	}
	
}else if($action == 'deletefeedback'){
        $feedback_id=$_REQUEST['feedback_id'];
        $sql="delete from gu_feedback where feedback_id=$feedback_id";
        $res=mysql_query($sql);
        if($res){
                        //$_SESSION['res4']=="success";
                header("location:view_feedback.php");
                $_SESSION['res4']=="success";
        }
        else{
                        $_SESSION['res4']=="fail";
                header("location:view_feedback.php");
        }
}else if($action == 'deleteDates'){
	$event_date_id=$_REQUEST['event_date_id'];
	$groupfitnes_id=$_REQUEST['groupfitnes_id'];
   $sql="delete from events_dates where event_date_id=$event_date_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res3']=="success";
				header("location:view_dates.php?groupfitnes_id=".$groupfitnes_id);
   }else{
				$_SESSION['res3']=="fail";
                header("location:view_dates.php?groupfitnes_id=".$groupfitnes_id);
   }
	
}else if($action == 'deleteAbout'){
	$about_id=$_REQUEST['about_id'];
	$document_path=$_REQUEST['document_path'];
   $sql="delete from gu_about where about_id=$about_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res3']=="success";
				header("location:view_about.php");
   }else{
				$_SESSION['res3']=="fail";
                header("location:view_about.php");
   }
	
}else if($action == 'deleteGroup'){
	$groupfitnes_id=$_REQUEST['groupfitnes_id'];
	$image_path=$_REQUEST['image_path'];
   $sql="delete from groupfitness where groupfitnes_id=$groupfitnes_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				unlink($image_path);
				header("location:view_groupfitness.php");
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_groupfitness.php");
   }
	
}
else if($action == 'deleteAtheletic'){
	$atheletic_id=$_REQUEST['atheletic_id'];
	$video_path=$_REQUEST['video_path'];
   $sql="delete from gu_atheletics where atheletic_id=$atheletic_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				unlink($video_path);
				header("location:view_athelitics.php");
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_athelitics.php");
   }
	
}else if($action == 'deleteJobs'){
	$job_id=$_REQUEST['job_id'];
	$employment_id=$_REQUEST['employment_id'];
   $sql="delete from gu_jobs where job_id=$job_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				header("location:view_jobs.php?employment_id=".$employment_id);
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_jobs.php?employment_id=".$employment_id);
   }
	
}else if($action == 'deleteHours'){
	$hours_oper_id=$_REQUEST['hours_oper_id'];
   $sql="delete from hours_of_operation where hours_oper_id=$hours_oper_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				header("location:view_hours_operation.php");
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_hours_operation.php");
   }
	
}else if($action == 'deleteTimings'){
	$timings_id=$_REQUEST['timings_id'];
	$hours_oper_id=$_REQUEST['hours_oper_id'];
   $sql="delete from hour_oper_timings where timings_id=$timings_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				header("location:view_timings.php?hours_oper_id=".$hours_oper_id);
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_timings.php?hours_oper_id=".$hours_oper_id);
   }
	
}else if($action == 'deleteSpecialDates'){
	$special_evnt_dat_id=$_REQUEST['special_evnt_dat_id'];
	$special_event_id=$_REQUEST['special_event_id'];
   $sql="delete from special_events_dates where special_evnt_dat_id=$special_evnt_dat_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				header("location:view_special_event_dates.php?special_event_id=".$special_event_id);
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_special_event_dates.php?special_event_id=".$special_event_id);
   }
	
}else if($action == 'deleteGallery'){
	$gallery_details_id=$_REQUEST['gallery_details_id'];
	$gallery_id=$_REQUEST['gallery_id'];
	$image_path=$_REQUEST['image_path'];
   echo $sql="delete from gallery_details where gallery_details_id=$gallery_details_id";
   $res=mysql_query($sql);
   if($res){
				$_SESSION['res4']=="success";
				unlink($image_path);
				header("location:view_gallery_details.php?gallery_id=".$gallery_id);
   }else{
				$_SESSION['res4']=="fail";
                header("location:view_gallery_details.php?gallery_id=".$gallery_id);
   }
	
}
ob_end_flush();
?>