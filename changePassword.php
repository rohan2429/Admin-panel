<?php
session_start();
if(empty($_SESSION['adminuser']))
header("Location:index.php");
?> 
<!DOCTYPE html>
<html>
<head>
<?php
	include('menu.php');
	?>
<meta charset="UTF-8">
<title>Admin |Gannon</title>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="./dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="./dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /></head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">

<!-- Left side column. contains the logo and sidebar -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Change Password
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Change Password</a></li>
            <li><a href="#">Change Password</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                     <div class="box-header with-border">
<h3 class="box-title"> <a><i class="fa fa-arrow-right"></i><b>Change Password</b></a></h3>
                </div><!-- /.box-header -->
                <?php
			
         if(isset($_SESSION['res3'])){

		if($_SESSION['res3']=='oldpassword'){ ?>
		<div style="color:red">You Entered Old Password Wrong</div>
		<?php 
		}
		if($_SESSION['res3']=='confirmpassword'){ ?>
		<div style="color:red">New Password and Confirm Password Should be match!</div>
		<?php 
		}
		if($_SESSION['res3']=='success'){ ?>
		<div style="color:green">Your Password Updated successfully</div>
		<?php 
		}
		unset($_SESSION['res3']);	
          	}
          	?>    
                </div><!-- /.box-header -->
                <!-- form start -->
<form id="form" action="update_controller.php" method="post" >
<div class="box-body">
<div class="form-group">
<label>Old Password </label>
<input type="password" class="form-control" name="oldpassword"  placeholder="Old Password" required/>
</div>
<div class="form-group">
<label>New Password</label>
<input type="password" class="form-control" name="newpassword" placeholder="New Password" required/>
</div>    
<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" name="confirmpassword"  placeholder="Confirm Password" required/>
</div>
</div><!-- /.box-body -->
<div class="box-footer">
<button type="submit" name="action" value="Change_Password"  class="btn btn-primary">Submit</button>
</div>
</form>
  </div><!-- /.box -->
</div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">

</div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
	     <script src="js/sha256.js"></script>
    <script src="login.js"></script>
  </body>
</html>
