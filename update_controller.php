<?php
session_start();
ob_start();
include 'dbconnections.php';
$action=$_REQUEST['action'];
 define ("MAX_SIZE","6144");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
if($action == 'update_Category'){
//Belew code for update category	
	$category_id=$_REQUEST['category_id'];
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
			$sql="update gu_categories set category_name='$categoryName',category_image='$file_name' where category_id=$category_id";
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
			$_SESSION['res3']="success";
				header('Location:edit_category.php?category_id='.$category_id);

		 } else
		 { 
			$_SESSION['res3']="fail";
				header('Location:edit_category.php?category_id='.$category_id);
		 }
}else{
//Update category without image	
			$categoryName = $_REQUEST['categoryName'];
			$sql="update gu_categories set category_name='$categoryName' where category_id=$category_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:edit_category.php?category_id='.$category_id);
			}else{
				$_SESSION['res3']="fail";
				header('Location:edit_category.php?category_id='.$category_id);
			}
			
}
}
}
else if($action == 'update_subCategory'){
	$sub_category_id=$_REQUEST['sub_category_id'];
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
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name',sub_cat_image='$file_name' where sub_category_id=$sub_category_id";
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
			$_SESSION['res3']="success";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);

		 } else
		 { 
			$_SESSION['res3']="fail";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
		 }
}else{
//Update category without image	
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name' where sub_category_id=$sub_category_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}else{
				$_SESSION['res3']="fail";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}
			
}
}
	
}
if($action == 'update_gallery'){
	$galley_id=$_REQUEST['galley_id'];
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
		$title = $_REQUEST['title'];
		$sub_category_id = $_REQUEST['sub_category_id'];
		$description = $_REQUEST['description'];
		
			 $sql="update gu_gallery set 
			title='$title',sub_category_id='$sub_category_id',
			image_path='$file_name',description='$description ' where galley_id=$galley_id";
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
			$_SESSION['res3']="success";
				header('Location:view_galery.php?sub_category_id='.$sub_category_id);

		 } else
		 { 
			$_SESSION['res3']="fail";
				header('Location:view_galery.php?sub_category_id='.$sub_category_id);
		 }
}else{
//Update category without image	
			$galley_id = $_REQUEST['galley_id'];
			$title = $_REQUEST['title'];
			$sub_category_id = $_REQUEST['sub_category_id'];
			$description= $_REQUEST['description'];	
			$sql="update gu_gallery set 
			title='$title',sub_category_id='$sub_category_id',
			description='$description' where galley_id=$galley_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:view_galery.php?sub_category_id='.$sub_category_id);
			}else{
				$_SESSION['res3']="fail";
				header('Location:view_galery.php?sub_category_id='.$sub_category_id);
			}
			
}
}
}
else if($action == 'update_subCategory'){
	$sub_category_id=$_REQUEST['sub_category_id'];
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
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name',sub_cat_image='$file_name' where sub_category_id=$sub_category_id";
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
			$_SESSION['res3']="success";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);

		 } else
		 { 
			$_SESSION['res3']="fail";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
		 }
}else{
//Update category without image	
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name' where sub_category_id=$sub_category_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}else{
				$_SESSION['res3']="fail";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}
			
}
}
	
} 
if($action == 'update_event'){
	$event_id=$_REQUEST['event_id'];
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
		$sub_category_list= $_REQUEST['sub_category_id'];
		$eventtitle = $_REQUEST['eventtitle'];
		$eventdate = $_REQUEST['eventdate'];
			 $sql="update gu_events set 
			category_id='$category_id',sub_category_id='$sub_category_list',
			event_title='$eventtitle',event_date='$eventdate ',image_path='$file_name' where event_id=$event_id";
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
			$_SESSION['res3']="success";
				header('Location:view_event.php');

		 } else
		 { 
			$_SESSION['res3']="fail";
				header('Location:view_event.php');
		 }
}else{
//Update category without image	
			$event_id = $_REQUEST['event_id'];
			$category_id = $_REQUEST['category_id'];
		$sub_category_list = $_REQUEST['sub_category_id'];
		$eventtitle = $_REQUEST['event_title'];
		$eventdate = $_REQUEST['event_date'];
			$sql="update gu_events set 
			category_id='$category_id',sub_category_id='$sub_category_list',
			event_title='$eventtitle',event_date='$eventdate ' where event_id=$event_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:view_event.php');
			}else{
				$_SESSION['res3']="fail";
				header('Location:view_event.php');
			}
			
}
}
}
else if($action == 'update_subCategory'){
	$sub_category_id=$_REQUEST['sub_category_id'];
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
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name',sub_cat_image='$file_name' where sub_category_id=$sub_category_id";
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
			$_SESSION['res3']="success";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);

		 } else
		 { 
			$_SESSION['res3']="fail";
			header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
		 }
}else{
//Update category without image	
			$sub_category_name = $_REQUEST['sub_category_name'];
			$sql="update gu_sub_categories set sub_category_name='$sub_category_name' where sub_category_id=$sub_category_id";
			$cateObj=mysql_query($sql);
			if($cateObj){
				$_SESSION['res3']="success";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}else{
				$_SESSION['res3']="fail";
				header('Location:edit_sub_category.php?sub_category_id='.$sub_category_id);
			}
			
}
}
}else if($action == 'update_feedback'){
        $feedback_id=$_REQUEST['feedback_id'];
         $feedback=$_REQUEST['feedback'];
	$sql="update gu_feedback set
                        feedback_title='$feedback' where feedback_id=$feedback_id";
                        $cateObj=mysql_query($sql);

                 if($cateObj){
                         $_SESSION['res3']="success";
                        header('Location:view_feedback.php');
                 }
                 else{
                         $_SESSION['res3']="fail";
                        header('Location:view_feedback.php');
                 }
}else if($action == 'Change_Password'){
	$user= $_SESSION['adminuser'];
	$oldpassword =$_REQUEST['oldpassword'];
	$newpassword =$_REQUEST['newpassword'];
	$confirmpassword =$_REQUEST['confirmpassword'];
	
	$ss="select password from gu_admin where username='$user'";
	$flag=mysql_query($ss);
	if($pass=mysql_fetch_assoc($flag)){
		$password= $pass['password'];
		if($password == $oldpassword ){
			
			if($newpassword == $confirmpassword ){
				$sql="update gu_admin set password='$newpassword' where password='$oldpassword' and username='$user'";
				$res=mysql_query($sql);
			
				$_SESSION['res3']="success";
				header('Location:changePassword.php');
			 
			}else{
				$_SESSION['res3']="confirmpassword";
				header('Location:changePassword.php');
			}
			
		}else{
			$_SESSION['res3']="oldpassword";
			header('Location:changePassword.php');
		}
}	
}
ob_end_flush();
?>