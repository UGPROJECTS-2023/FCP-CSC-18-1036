<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['cashier_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require 'incs/header.php'; ?>
<script src="js/function.js" type="text/javascript"></script>
<style type="text/css">
	.main_body{
		background: #b1b1b1;
		padding: 20px;
	}
	.card-header{text-align: center; font-size: 20px; font-family: lucida console}
	.card-body{font-size: 30px; text-align: center;}
</style>
</head>
<body>
<?php require 'incs/doctor_data.php'; ?>
<div class="main_body">
	<div class="container">
		<div class="mt-4">
			<h4> <span class="fas fa-tachometer-alt"></span> Welcome, Dr <?php echo $_SESSION['first_name']; ?></h4>
		</div>
		<div class="row mt-4">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Dashboard
					</div>
					<div class="card-body">
						<span class="fas fa-tachometer-alt"></span>
					</div>
					<div class="card-footer">
						<a href="doctor.php" class="btn btn-info btn-block">Visit</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Patients
					</div>
					<div class="card-body">
						<span class="fa fa-users"></span>
					</div>
					<div class="card-footer">
						<a href="users.php" class="btn btn-info btn-block">Visit</a>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Prescription
					</div>
					<div class="card-body">
						<span class="fa fa-stethoscope"></span>
					</div>
					<div class="card-footer">
						<a href="preb.php" class="btn btn-info btn-block">Visit</a>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
