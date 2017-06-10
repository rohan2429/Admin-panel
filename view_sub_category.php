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
SubCategories
<small>SubCategories Detailes tables</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i>SubCategories</a></li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"> 
<a onclick="back();"><i class="fa fa-arrow-left"></i><b>Back</b></a>
</h3></br></br>
<?php
$category_id=$_REQUEST['category_id'];
?>
<a href="add_sub_categories.php?category_id=<?=$category_id?>" style="float:right"><button class="btn btn-primary">Add Sub Categories</button></a>
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
<th>Sub Category Name</th>
 <th>Sub Category File</th>
<th>Operation</th>
</tr>
</thead>
<tbody>
 
<?php
$i=0;
include 'dbconnections.php';
$category_id=$_REQUEST['category_id'];
$query ="select * from gu_sub_categories where category_id=$category_id" ;
$rowCount=mysql_query($query);
 if($rowCount > 0){
while($cat= mysql_fetch_assoc($rowCount)){	 
?>	 
<tr>
<input type="hidden" name="category_id" value="<?=$cat['sub_category_id']?>">
<input type="hidden" name="sub_cat_image" value="<?=$cat['sub_cat_image']?>">
<td>
<?=$cat['sub_category_name']?></span>
</td>

<?php
if(strpos($cat['sub_cat_image'],'mp4')||strpos($cat['sub_cat_image'],'MOV')||strpos($cat['sub_cat_image'],'wmv')){
?>
<td class="center"><video style="width:300px;height:150px;" controls>
<source src="./<?php echo $cat['sub_cat_image']?>" type="video/mp4">
</video></td>
<?php
}else if(strpos($cat['sub_cat_image'],'jpeg')||strpos($cat['sub_cat_image'],'jpg')||strpos($cat['sub_cat_image'],'png')||strpos($cat['sub_cat_image'],'gif') ){
?>
<td>
<img src="<?=$cat['sub_cat_image']?>" style="width:100px;height:100px">
</td>
<?php	
}else if(strpos($cat['sub_cat_image'],'xls')||strpos($cat['sub_cat_image'],'pdf')||strpos($cat['sub_cat_image'],'doc')||strpos($cat['sub_cat_image'],'dot')||strpos($cat['sub_cat_image'],'docx')||strpos($cat['sub_cat_image'],'pptx')||strpos($cat['sub_cat_image'],'docm')){
?>
<td>
<a href="<?=$cat['sub_cat_image']?>">Document<img src="Downloads-icon.png"style="height:50px;width:50px"></a>
</td>

<?php
}else{
?>
<td>
<h3>Empty</h3>
</td>
<?php
}
?>

<td>
<a href="edit_sub_category.php?sub_category_id=<?=$cat['sub_category_id']?>" class="btn btn-primary">Edit</a>
<a href="delete_controller.php?action=deletesubCat&category_id=<?=$category_id?>&sub_category_id=<?=$cat['sub_category_id']?>&sub_cat_image=<?=$cat['sub_cat_image']?>"  class="btn btn-primary">Delete</a>
<a href="view_dates.php?sub_category_id=<?=$cat['sub_category_id']?>" class="btn btn-primary">Add Date</a>
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






