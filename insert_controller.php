<?php
include "dbconnections.php";
ob_start();
define ("MAX_SIZE","6144");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 $action=$_REQUEST['action'];
 //Below code for Add category
if($action=="category"){
		//File upload code start
		 $imageName= substr(str_shuffle("0123456789"), 0, 3). substr(str_shuffle("0123456789"), 0, 4);
		 if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$image =$_FILES["file"]["name"];
			$uploadedfile = $_FILES['file']['tmp_name'];
		if ($image) 
		{
			$filename = stripslashes($_FILES['file']['name']);
			$extension = getExtension($filename);
			$extension = strtolower($extension);
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
		{
		echo "Unknown Image extension ";
		}elseif($extension=="jpg" || $extension=="jpeg" )
		 {
		 $uploadedfile = $_FILES['file']['tmp_name'];
		 $src = imagecreatefromjpeg($uploadedfile);
		 }
		 else if($extension=="png")
		 {
		 $uploadedfile = $_FILES['file']['tmp_name'];
		 $src = imagecreatefrompng($uploadedfile);
		 }
		 else 
		 {
		 $src = imagecreatefromgif($uploadedfile);
		 }
		list($width,$height)=getimagesize($uploadedfile);
		$newwidth=600;
		$newheight=300;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecolorallocatealpha($tmp, 255, 255, 255, 127);
		$transparent = imagecolorallocate($tmp,255, 255, 255);
		imagecolortransparent($tmp,$transparent);
		imagefilledrectangle($tmp,0,0,1000,1000,$transparent);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$extension = explode("/", $_FILES["file"]["type"]);
		$file_tmp =$_FILES['file']['tmp_name'];
		$file_name1= $imageName.".".$extension[1];
		$path='Uploadimages/';
		$file_name=$path.$file_name1;
			$categoryName = $_REQUEST['categoryName'];
			$sql="insert into gu_categories (category_name,category_image) values ('$categoryName','$file_name')";
			$cateObj=mysql_query($sql);
		 
			 if($cateObj){
				 $desired_dir='Uploadimages';
				
				 if(is_dir($desired_dir)==false){
		mkdir("$desired_dir", 0700);
		imagejpeg($tmp,$desired_dir."/".$file_name1,100);
		}else{
		imagejpeg($tmp,$desired_dir."/".$file_name1,100);
		}
		//imagepng($tmp,$desired_dir, null,100);
		imagedestroy($src);
		imagedestroy($tmp);
				header('Location:view_categories.php');

			 } else
			 { 
				header('Location:view_categories.php');
			 }
}
}
}if($action=="subcatgory"){
//Below code for add subcotegory
	 $imageName= substr(str_shuffle("0123456789"), 0, 3). substr(str_shuffle("0123456789"), 0, 4);
	 if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$image =$_FILES["file"]["name"];
		$uploadedfile = $_FILES['file']['tmp_name'];
	if ($image) 
	{
		$filename = stripslashes($_FILES['file']['name']);
		$extension = getExtension($filename);
		$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
	{
	echo "Unknown Image extension ";
	}elseif($extension=="jpg" || $extension=="jpeg" )
	 {
	 $uploadedfile = $_FILES['file']['tmp_name'];
	 $src = imagecreatefromjpeg($uploadedfile);
	 }
	 else if($extension=="png")
	 {
	 $uploadedfile = $_FILES['file']['tmp_name'];
	 $src = imagecreatefrompng($uploadedfile);
	 }
	 else 
	 {
	 $src = imagecreatefromgif($uploadedfile);
	 }
	list($width,$height)=getimagesize($uploadedfile);
	$newwidth=600;
	$newheight=300;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecolorallocatealpha($tmp, 255, 255, 255, 127);
	$transparent = imagecolorallocate($tmp,255, 255, 255);
	imagecolortransparent($tmp,$transparent);
	imagefilledrectangle($tmp,0,0,1000,1000,$transparent);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	$extension = explode("/", $_FILES["file"]["type"]);
	$file_tmp =$_FILES['file']['tmp_name'];
	$file_name1= $imageName.".".$extension[1];
	$path='Uploadimages/subcatImages/';
	$file_name=$path.$file_name1;
		$category_id = $_REQUEST['category_id'];
		$subcatgoryName = $_REQUEST['subcatgoryName'];
		$description = $_REQUEST['description'];
		$sql="insert into gu_sub_categories (category_id,sub_category_name,sub_cat_image,description) values ('$category_id','$subcatgoryName','$file_name','$description')";
		$cateObj=mysql_query($sql);
	 
		 if($cateObj){
			 $desired_dir='Uploadimages/subcatImages';
			
			 if(is_dir($desired_dir)==false){
	mkdir("$desired_dir", 0700);
	imagejpeg($tmp,$desired_dir."/".$file_name1,100);
	}else{
	imagejpeg($tmp,$desired_dir."/".$file_name1,100);
	}
	//imagepng($tmp,$desired_dir, null,100);
	imagedestroy($src);
	imagedestroy($tmp);
			header('Location:view_sub_category.php?category_id='.$category_id);

		 } else
		 { 
			header('Location:view_sub_category.php?category_id='.$category_id);
		 }
		}else{
			$category_id = $_REQUEST['category_id'];
			$subcatgoryName = $_REQUEST['subcatgoryName'];
			$description = $_REQUEST['description'];
			$sql="insert into gu_sub_categories (category_id,sub_category_name,description) values ('$category_id','$subcatgoryName','$description')";
			$cateObj=mysql_query($sql);
			if($cateObj){
			header('Location:view_sub_category.php?category_id='.$category_id);

			 }else
			 { 
				header('Location:view_sub_category.php?category_id='.$category_id);
			 }	
			
		}
		}
}
if($action=="gallery"){
//define("MAX_SIZE"," 298329278");
 /* ini_set("post_max_size","30M");
ini_set("upload_max_filesize","30M"); */
ini_set('max_execution_time', 600); 
$allowedExts = array("jpg", "jpeg", "gif", "png","3gp","flv","m3u8","ts","mov","avi","wmv","mp3", "mp4", "wma","xls","pdf","doc","dot","pptx","docx","docm","txt");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$imageName= substr(str_shuffle("0123456789"), 0, 3). substr(str_shuffle("0123456789"), 0, 4);
$image =$_FILES["file"]["name"];
if ($image) 
{
if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/3gpp")
|| ($_FILES["file"]["type"] == "video/x-flv")
|| ($_FILES["file"]["type"] == "application/x-mpegURL")
|| ($_FILES["file"]["type"] == "video/MP2T")
|| ($_FILES["file"]["type"] == "video/quicktime")
|| ($_FILES["file"]["type"] == "video/x-msvideo")
|| ($_FILES["file"]["type"] == "video/x-ms-wmv")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "application/vnd.ms-excel")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "application/msword")
|| ($_FILES["file"]["type"] == " application/vnd.openxmlformats-officedocument.presentationml.presentation")

||($_FILES["file"]["type"] ==" application/vnd.openxmlformats-officedocument.wordprocessingml.document")
||($_FILES["file"]["type"] == "application/vnd.ms-word.document.macroEnabled.12"))
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
		"Upload: " . $_FILES["file"]["name"] . "<br />";
		 "Type: " . $_FILES["file"]["type"] . "<br />";
		 "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		"Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("Uploadimages/gallery/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "Uploadimages/gallery/".$imageName. $_FILES["file"]["name"]);
		$file_name ="Uploadimages/gallery/".$imageName.$_FILES["file"]["name"];
		//echo $file_name;
		$gallery_id = $_REQUEST['gallery_id'];
		$title = $_REQUEST['title'];
	 $sql="insert into gallery_details (gallery_id,title,image_path) values ('$gallery_id','$title','$file_name')";
		$cateObj=mysql_query($sql);
	 
		 if($cateObj){
			header('Location:view_gallery_details.php?gallery_id='.$gallery_id);

			 }else
			 { 
			header('Location:view_gallery_details.php?gallery_id='.$gallery_id);
			 } 
	  
	  
      }
    }
}
}
}else if($action == "add_date"){
//Below code for add date	
	$groupfitnes_id=$_REQUEST['groupfitnes_id'];
	$date=$_REQUEST['date'];
	$day=$_REQUEST['day'];
	$hour=$_REQUEST['hour'];
	 $minute=$_REQUEST['minute'];
	 $session=$_REQUEST['session'];
	$time =$day.' - '.$hour.':'.$minute.$session;
	$sql="insert into events_dates (groupfitnes_id,date,time) values('$groupfitnes_id','$date','$time')";
	$res=mysql_query($sql);
	if($res){
		header('Location:view_dates.php?groupfitnes_id='.$groupfitnes_id);
	}else{
		header('Location:view_dates.php?groupfitnes_id='.$groupfitnes_id);
	}
	
	
}else if($action=="feedback"){
//Below code for add feedback	
        $feedback = $_REQUEST['feedback'];
			$sql="insert into gu_feedback (feedback_title) values ('$feedback')";
			$cateObj=mysql_query($sql);
	 if($cateObj){
			 header('Location:view_feedback.php');
	 }
	 else{
			header('Location:view_feedback.php');
			
	 }
}else if($action=="Submit"){
//Below code for admin reply on User feedback	
	$user_febak_id=$_REQUEST['user_febak_id'];
	$admin_reply=$_REQUEST['admin_reply'];
	$sql="update  gu_user_feedbacks set admin_reply='$admin_reply' where user_febak_id=$user_febak_id";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_user_comments.php');
	}else{
		header('Location:view_user_comments.php');
	}
	
}
else if($action=="gallery_type"){
//Below code for add gallery type	
	$type=$_REQUEST['type'];
	$sql="insert into  gu_gallery(type)values('$type')";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_gallery.php');
	}else{
		header('Location:view_gallery.php');
	}
	
}else if($action=="add-employement"){
//Below code for add employement
	$employement=$_REQUEST['employement'];
	$sql="insert into  gu_employement(employment_type)values('$employement')";
	$flag=mysql_query($sql);
	if($flag){
		echo "ss";
		//header('Location:view_gallery.php');
	}else{
		echo "ff";
		//header('Location:view_gallery.php');
	}
	
}else if($action=="add-jobs"){
//Below code for add employement
	$employment_id=$_REQUEST['employment_id'];
	$company_name=$_REQUEST['company_name'];
	$job_title=$_REQUEST['job_title'];
	$date=$_REQUEST['date'];
	$address=$_REQUEST['address'];
	$sql="insert into  gu_jobs(employment_id,company_name,job_title,date,address)values('$employment_id','$company_name','$job_title','$date','$address')";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_jobs.php?employment_id='.$employment_id);
	}else{
		header('Location:view_jobs.php?employment_id='.$employment_id);
	}
	
}else if($action=="hours-operation"){
//Below code for add hours-operation
	$operation=$_REQUEST['operation'];
	$description=$_REQUEST['description'];

	$sql="insert into  hours_of_operation(hours_oper_name,description)values('$operation','$description')";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_hours_operation.php');
	}else{
		header('Location:view_hours_operation.php');
	}
	
}else if($action=="add_timings"){
//Below code for add hours-operation
	$hours_oper_id=$_REQUEST['hours_oper_id'];
	$day=$_REQUEST['day'];
	$hour=$_REQUEST['hour'];
	 $minute=$_REQUEST['minute'];
	 $session=$_REQUEST['session'];
	$fromtime =$day.' - '.$hour.':'.$minute.$session;
	
	$today=$_REQUEST['today'];
	$tohour=$_REQUEST['tohour'];
	$tominute=$_REQUEST['tominute'];
	$tosession=$_REQUEST['tosession'];
	$totime =$today.' - '.$tohour.':'.$tominute.$tosession;
	
	$sql="insert into  hour_oper_timings(hours_oper_id,from_time,to_time)values('$hours_oper_id','$fromtime','$totime')";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_timings.php?hours_oper_id='.$hours_oper_id);
	}else{
		header('Location:view_timings.php?hours_oper_id='.$hours_oper_id);
	}
	
}else if($action == 'add-special-date'){
	$special_event_id=$_REQUEST['special_event_id'];
	$date=$_REQUEST['date'];
	$day=$_REQUEST['day'];
	$hour=$_REQUEST['hour'];
	 $minute=$_REQUEST['minute'];
	 $session=$_REQUEST['session'];
	$time =$day.' - '.$hour.':'.$minute.$session;
	 $sql="insert into  events_dates(special_event_id,date,time)values('$special_event_id','$date','$time')";
	$flag=mysql_query($sql);
	if($flag){
		header('Location:view_special_event_dates.php?special_event_id='.$special_event_id);
	}else{
		header('Location:view_special_event_dates.php?special_event_id='.$special_event_id);
	}
}
ob_end_flush();
?>