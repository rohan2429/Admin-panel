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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
function editFunction(ebtn,etxt,utxt,ubtn,cbtn){
	$("#"+ebtn.id).hide();
	$("#"+etxt.id).hide();
	$("#"+utxt.id).show();
	$("#"+ubtn.id).show();
	$("#"+cbtn.id).show();
}
function canceleditFunction(ebtn,etxt,utxt,ubtn,cbtn){
	$("#"+ebtn.id).show();
	$("#"+etxt.id).show();
	$("#"+utxt.id).hide();
	$("#"+ubtn.id).hide();
	$("#"+cbtn.id).hide();
}

</script>
<script>
function updateId(id,id1)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
           // alert(xmlhttp.responseText);
           // console.log(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "test.php?id=" +id.value +"&id1=" +id1.value, true);
    xmlhttp.send();
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
Special Events
<small>Special Events Detailes tables</small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i>Special Events</a></li>
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
<a href="add_special_events.php" style="float:right"><button class="btn btn-primary">Add special events</button></a>
</div>	
<div class="box-body">
<?php 
if(isset($_SESSION['res3'])){
if($_SESSION['res3']=="success"){
?>
<center>
<span style="color:green; font-size:18px">Updated Successfully </span>
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
<span style="color:green; font-size:18px">Deleted Successfully </span>
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
<th>Special Event Titles</th>

<th>Operation</th>
</tr>
</thead>
<tbody>
 
<?php
$i=0;
include 'dbconnections.php';
$query ="select * from gu_special_events" ;
$rowCount=mysql_query($query);
 if($rowCount > 0){
while($cat= mysql_fetch_assoc($rowCount)){	 
?>	 
<tr>

<input type="hidden" name="special_event_id" id="evntId<?=$i?>" value="<?=$cat['special_event_id']?>">
<td>
<span id="edit<?=$i?>"><?=$cat['event_title']?></span>
<input type="text" name="event_title" id="title<?=$i?>" value="<?=$cat['event_title']?>" style="display:none">
</td>
<td>
<button class="btn btn-primary" id="editbtn<?=$i?>" onclick="editFunction(editbtn<?=$i?>,edit<?=$i?>,title<?=$i?>,updatebtn<?=$i?>,cancelbtn<?=$i?>)">Edit</button>

<button class="btn btn-primary" onclick="updateId(title<?=$i?>,evntId<?=$i?>);" id="updatebtn<?=$i?>" style="display:none">Update</button>

<button class="btn btn-primary" onclick="canceleditFunction(editbtn<?=$i?>,edit<?=$i?>,title<?=$i?>,updatebtn<?=$i?>,cancelbtn<?=$i?>)" id="cancelbtn<?=$i?>" style="display:none">Cancel</button>

<a href="delete_controller.php?action=deleteSpecial&special_event_id=<?=$cat['special_event_id']?>"  class="btn btn-primary">Delete</a>
<a href="view_special_event_dates.php?special_event_id=<?=$cat['special_event_id']?>" class="btn btn-primary">View Date</a>
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
</div>
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






