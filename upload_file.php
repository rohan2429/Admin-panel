<?php
session_start();
ob_start();
include "dbconnections.php"; 
$action=$_REQUEST['action'];
if($action == 'add-about'){
define("MAX_SIZE"," 298329278");
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

    if (file_exists("Uploadimages/subcatImages/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "Uploadimages/subcatImages/".$imageName. $_FILES["file"]["name"]);
		$file_name ="Uploadimages/subcatImages/".$imageName.$_FILES["file"]["name"];
		//echo $file_name;
		$subcatgoryName = $_REQUEST['subcatgoryName'];
		$description = $_REQUEST['description'];
	$sql="insert into gu_about (sub_category_name,document_path,description) values ('$subcatgoryName','$file_name','$description')";
		$cateObj=mysql_query($sql);
	 
		 if($cateObj){
			header('Location:view_about.php');

			 }else
			 { 
			 header('Location:view_about.php');
			 } 
	  
	  
      }
    }
  }else{
	  
	  echo "Invalid Extension";
  }
}else
  {
		$subcatgoryName = $_REQUEST['subcatgoryName'];
		$description = $_REQUEST['description'];
	$sql="insert into gu_about (sub_category_name,description) values ('$subcatgoryName','$description')";
		$cateObj=mysql_query($sql);
	 
		 if($cateObj){
			header('Location:view_about.php');

			 }else
			 { 
				header('Location:view_about.php');
			 }  echo "Invalid file";
  }
}else if($action == 'special-events'){
	$eventTitle=$_REQUEST['eventTitle'];
	$sql="insert into gu_special_events (event_title) values('$eventTitle')";
	$res=mysql_query($sql);
	if($res){
		header('Location:view_special_events.php');
	}else{
		header('Location:view_special_events.php');
	}
	
}else if($action == 'add-groupfitness'){
	define ("MAX_SIZE","6144");
	function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
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
			$groupfitnessTitle = $_REQUEST['groupfitnessTitle'];
			//$description1 = $_REQUEST['description'];
			$description = mysql_real_escape_string($_REQUEST['description']);
			
		$sql="insert into groupfitness (groupfitness_title,image_path,description) values ('$groupfitnessTitle','$file_name','$description')";
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
			header('Location:view_groupfitness.php');

			 } else
			 { 
			header('Location:view_groupfitness.php');
			 }
}else{
			$groupfitnessTitle = $_REQUEST['groupfitnessTitle'];
			$description = mysql_real_escape_string($_REQUEST['description']);
			$sql="insert into groupfitness (groupfitness_title,description) values ('$groupfitnessTitle','$description')";
			$cateObj=mysql_query($sql);
			if($cateObj){
					header('Location:view_groupfitness.php');
			}else{
					header('Location:view_groupfitness.php');
			}
}
}
	
	
}else if($action == 'update-groupfitness'){
	define ("MAX_SIZE","6144");
	function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
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
		$path='Uploadimages/groupfitness/';
		$file_name=$path.$file_name1;
		$groupfitnes_id=$_REQUEST['groupfitnes_id'];
			$groupfitnessTitle = $_REQUEST['groupfitnessTitle'];
			//$description1 = $_REQUEST['description'];
			$description = mysql_real_escape_string($_REQUEST['description']);
			
		$sql="update groupfitness set groupfitness_title='$groupfitnessTitle',description='$description',image_path='$file_name' where groupfitnes_id=$groupfitnes_id";
			$cateObj=mysql_query($sql);
		 
			 if($cateObj){
				 $desired_dir='Uploadimages/groupfitness';
				
				 if(is_dir($desired_dir)==false){
		mkdir("$desired_dir", 0700);
		imagejpeg($tmp,$desired_dir."/".$file_name1,100);
		}else{
		imagejpeg($tmp,$desired_dir."/".$file_name1,100);
		}
		//imagepng($tmp,$desired_dir, null,100);
		imagedestroy($src);
		imagedestroy($tmp);
			header('Location:view_groupfitness.php');

			 } else
			 { 
			header('Location:view_groupfitness.php');
			 }
}else{
	$groupfitnes_id=$_REQUEST['groupfitnes_id'];
			$groupfitnessTitle = $_REQUEST['groupfitnessTitle'];
			$description = mysql_real_escape_string($_REQUEST['description']);
			$sql="update groupfitness set groupfitness_title='$groupfitnessTitle',description='$description' where groupfitnes_id=$groupfitnes_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
					header('Location:view_groupfitness.php');
			}else{
					header('Location:view_groupfitness.php');
			}
}
}
	
	
}else if($action == 'add-atheletic'){
	
define("MAX_SIZE"," 298329278");
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

    if (file_exists("Uploadimages/atheletic/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "Uploadimages/atheletic/".$imageName. $_FILES["file"]["name"]);
		$file_name ="Uploadimages/atheletic/".$imageName.$_FILES["file"]["name"];
		//echo $file_name;
		$atheletic_title = $_REQUEST['atheletic_title'];
	$sql="insert into gu_atheletics (atheletics_name,video_path) values ('$atheletic_title','$file_name')";
		$cateObj=mysql_query($sql);
	 
		 if($cateObj){
			header('Location:view_athelitics.php');

			 }else
			 { 
			 header('Location:view_athelitics.php');
			 } 
	  
	  
      }
    }
  }else{
	  echo "Invalid Extension";
  }
}
}
ob_end_flush();
?>