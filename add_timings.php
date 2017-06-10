<?php
session_start();
if (empty($_SESSION['adminuser']))
	header("Location:index.php");
?> 
<!DOCTYPE html>
<html>
<head>
<title>Admin |Gannon</title>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="./dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="./dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<?php
include ('menu.php');
?>
      <!-- Content Wrapper. Contains page contentww -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Timings
          </h1>
          <ol class="breadcrumb">
            <!--<li><a href="#"><i class="fa fa-dashboard"></i>Categories</a></li>
            <li><a href="add_comapny.php">Add Categories Posts</a></li>-->
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
              <!-- left column -->
           
              <!-- general form elements -->
             <div class="box box-primary">
             <div class="box-header with-border">
             <div class="box-header with-border">
<h3 class="box-title"> 
<a onclick="back()"><i class="fa fa-arrow-left"></i><b>Timings</b></a>
</h3>
                </div><!-- /.box-header -->
                </div><!-- /.box-header -->
                <!-- form start -->
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
<span style="color:green; font-size:18px"> Deleted Successfully </span>
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
 <form action="insert_controller.php" method="POST" enctype="multipart/form-data">
<div class="box-body">	
<div class="col-md-6">
<?php
include 'dbconnections.php';
$hours_oper_id=$_REQUEST['hours_oper_id'];
$query ="select * from hours_of_operation where hours_oper_id=$hours_oper_id";
$rowCount=mysql_query($query);
 if($rowCount > 0){
while($cat= mysql_fetch_assoc($rowCount)){	 
?>
<input type="hidden" name="hours_oper_id" value="<?=$hours_oper_id?>">

 <div class="form-group">
<label>TITLE</label>
 <input type="text" class="form-control" name="hours_oper_name" value="<?=$cat['hours_oper_name']?>" readonly>
 </div>
 <div class="form-group">
  <label>From Day Time</label>
	  <div class="col-md-12" >
	 
		<div class="col-md-3" >
		 <div class="form-group">
		<label>Select Day</label>
		<select name="day">
		<option>Select Day</option>
		<option value="Monday">Monday</option>
		<option value="Thuesday">Thuesday</option>
		<option value="Wednesday">Wednesday</option>
		<option value="thursday">thursday</option>
		<option value="Friday">Friday</option>
		<option value="Saturday">Saturday</option>
		<option value="Sunday">Sunday</option>
		</select>
		 </div> 
	 </div>
	  <div class="col-md-3" >
		  <div class="form-group">
		<label>Select Hour</label>
		<select name="hour" >
		<option>Select Hour</option>
		<?php
		$hour=1;
		while($hour <= 12){
			if($hour <=9){
				echo '<option value='.$hour.'>0'.$hour.'</option>';
			}else{
				echo '<option value='.$hour.'>'.$hour.'</option>';
			}
			$hour++;
		}
		?>
		</select>
		 </div>
	 </div>
	 
	<div class="col-md-3" >
		  <div class="form-group">
		<label>Minute</label>
		<select name="minute" >
		<option>Select Minute</option>
		<?php
		$minute=0;
		while($minute <= 60){
			if($minute <=9){
				echo '<option value='.$minute.'>0'.$minute.'</option>';
			}else{
				echo '<option value='.$minute.'>'.$minute.'</option>';
			}
			$minute++;
		}
		?>
		</select>
		 </div>
	 </div>
	 <div class="col-md-3" >
		  <div class="form-group">
		<label>Select</label>
		<select name="session">
		<option>am</option>
		<option>pm</option>
		</select>
		 </div>
	 </div>
 </div>
 </div>
 <div class="form-group">
  <label>To Day Time</label>
	  <div class="col-md-12" >
	 
		<div class="col-md-3" >
		 <div class="form-group">
		<label>Select Day</label>
		<select name="today">
		<option>Select Day</option>
		<option value="Monday">Monday</option>
		<option value="Thuesday">Thuesday</option>
		<option value="Wednesday">Wednesday</option>
		<option value="thursday">thursday</option>
		<option value="Friday">Friday</option>
		<option value="Saturday">Saturday</option>
		<option value="Sunday">Sunday</option>
		</select>
		 </div> 
	 </div>
	  <div class="col-md-3" >
		  <div class="form-group">
		<label>Select Hour</label>
		<select name="tohour" >
		<option>Select Hour</option>
		<?php
		$hour=1;
		while($hour <= 12){
			if($hour <=9){
				echo '<option value='.$hour.'>0'.$hour.'</option>';
			}else{
				echo '<option value='.$hour.'>'.$hour.'</option>';
			}
			$hour++;
		}
		?>
		</select>
		 </div>
	 </div>
	 
	<div class="col-md-3" >
		  <div class="form-group">
		<label>Minute</label>
		<select name="tominute" >
		<option>Select Minute</option>
		<?php
		$minute=0;
		while($minute <= 60){
			if($minute <=9){
				echo '<option value='.$minute.'>0'.$minute.'</option>';
			}else{
				echo '<option value='.$minute.'>'.$minute.'</option>';
			}
			$minute++;
		}
		?>
		</select>
		 </div>
	 </div>
	 <div class="col-md-3" >
		  <div class="form-group">
		<label>Select</label>
		<select name="tosession">
		<option>am</option>
		<option>pm</option>
		</select>
		 </div>
	 </div>
 </div>
 </div>

 </div>
 

  <?php
}
 }?>
</div>
<div class="box-footer">
<button type="submit" name="action" value="add_timings" class="btn btn-primary">Submit</button>
  </div> 
</div>
</form>

  </div><!-- /.box body-->
   </div><!--/.col (right) -->
</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">

</div>
</footer>
    <!-- jQuery 2.1.4 -->
    <script src="./plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="./bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="./plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js" type="text/javascript"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
   <!-- CK Editor -->
   <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
   <script src="js/custom.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  </body>
</html>
 