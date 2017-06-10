<?php
session_start();
if(empty($_SESSION['adminuser']))
header("Location:index.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin |Gannon</title>
<!-- Bootstrap 3.3.4 -->
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="./plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="./dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
<link href="./dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

<script>
function upDate(edit,submit){
	var j=submit.id.substring(2, submit.length);
for(var i=1;i<=2;i++){
	document.getElementById('s'+i+j).style.display='block';
	document.getElementById('sp'+i+j).style.display='none';
}	
submit.style.display='block';
}
function upDate1(id1){
id1.style.display='none';
}
</script>
<script type="text/javascript">
function company_id(id)
{
 if(confirm('Sure to delete this record ?'))
 {
  window.location='delete_data.php?r=jobcompanys&company_id='+id
 }
}
function edit_id(id)
{
 if(confirm('Sure to edit this record ?'))
 {
  window.location='edit_data.php?edit_id='+id
 }
}
</script>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">

<!-- Left side column. contains the logo and sidebar -->
<?php
include ('menu.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1><i class="fa  fa-folder-open"></i>
Categories
<small>Categories Detailes tables</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i>Categories</a></li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"> 
<a onclick="back();"><i class="fa fa-arrow-left"></i><b>Categories List</b></a>
</h3></br></br>
<?php
?>
<a href="add_event.php" style="float:right"><button class="btn btn-primary">Add Event</button></a>
</div>	
<div class="box-body">
<?php 
if(isset($_SESSION['res3'])){
if($_SESSION['res3']=="success"){
?>
<center>
<span style="color:green; font-size:18px">Categories Updated Successfully </span>
</center>
<?php
unset($_SESSION['res3']);	
}
else{
	?>
	<center>
	<span style="color:green; font-size:18px">Not Updated Details</span>
	</center>
<?php	
unset($_SESSION['res3']);
}
}
?>

<?php 
if(isset($_SESSION['res4'])){
if($_SESSION['res4']=="success")	{
?>
<center>
<span style="color:green; font-size:18px">Categories Deleted Successfully </span>
</center>
<?php
unset($_SESSION['res4']);	
}
else{
	?>
	<center>
	<span style="color:green; font-size:18px">Not Deleted Details</span>
	</center>
<?php	
unset($_SESSION['res4']);
}
}
?>
<table id="example1"  class="table table-bordered table-striped">
<thead>
<tr>
<!--<th>Category ID</th>-->
<th>Category list</th>
<th>subcategory list</th>
<th>Event Title</th>
<th>Event Date</th>
<th>current Date</th>
<th>Image</th>
<th>operation</th>

</tr>
</thead>
<tbody>
 
<?php
$i=0;
include 'dbconnections.php';
//$sub_category_id=$_REQUEST['sub_category_id'];
$query ="SELECT c.category_name,s.sub_category_name,e.event_id,e.category_id,e.sub_category_id,e.event_title,e.image_path,e.event_date,e.currentdate,e.status
FROM gu_categories c, gu_sub_categories s,gu_events e where c.category_id=e.category_id and s.sub_category_id=e.sub_category_id" ;
$rowCount=mysql_query($query);
 if($rowCount > 0){
while($cat= mysql_fetch_assoc($rowCount)){	 
?>	 
<tr>
<!--<input type="hidden" name="sub_category_id" value="<?=$cat['sub_category_id']?>">-->
<input type="hidden" name="image_path" value="<?=$cat['image_path']?>">
<input type="hidden" name="category_id" value="<?=$cat['category_id']?>">
<input type="hidden" name="sub_category_id" value="<?=$cat['sub_category_id']?>">


<td>
<?=$cat['category_name']?></span>
</td>
<td>
<?=$cat['sub_category_name']?></span>
</td>
<td>
<?=$cat['event_title']?></span>
</td>
<td>
<?=$cat['event_date']?></span>
</td>
<td>
<?=$cat['currentdate']?></span>
</td>
<td>
<img src="<?=$cat['image_path']?>" width="150px" height="100px">
</td>

<td>
<a href="edit_event.php?event_id=<?=$cat['event_id']?>" class="btn btn-primary">Edit</a>
<a href="delete_controller.php?action=view_event&sub_category_id=<?=$cat['sub_category_id']?>&event_id=<?=$cat['event_id']?>" class="btn btn-primary">Delete</a>

</td>
</tr>
<?php 
$i++;
}
}
?>
</tbody>
</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Control Sidebar -->

<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
<b>Designed by</b> <a href="http://smartmindsteam.com">Smart Minds Team Solutions</a>
</div>
<strong>All &copy; rights reserved by <a href="http://vsmtsolutions.com/">Smart Minds Team Solutions</a> 2015.</strong>
</footer>
<script src="./plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="./plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="./plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="./plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="./dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script type="text/javascript">
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
"paging": true,
"lengthChange": false,
"searching": false,
"ordering": true,
"info": true,
"autoWidth": false
});
});
</script>

</body>
</html>






