<?php
 
  $conne=mysql_connect("localhost","root","");
   if($conne)
   {
   	mysql_select_db('gonnon_university');
   }
   else
   {
   	echo "db not connected";
   }
  /*
   $conne=mysql_connect("localhost","optcareer","opt@123");
   if($conne)
   {
   	mysql_select_db('optcareer');
   }
   else
   {
   	echo "db not connected";
   } 
   */
?>