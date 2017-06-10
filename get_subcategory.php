<?php
include 'dbconnections.php';
	if(isset($_POST['get_option']))
  {
    $category_id = $_POST['get_option']; 
 $sql="select * from gu_sub_categories where category_id='$category_id'";	
     $find=mysql_query($sql);
    while($result=mysql_fetch_assoc($find))
    {
      echo "<option value=".$result['sub_category_id'].">".$result['sub_category_name']."</option>";
	}
    exit;
  }
?>