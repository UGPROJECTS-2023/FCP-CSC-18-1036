<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
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

</head>
<body>
<?php include 'incs/data.php'; ?>
	<div class="main_body">
		<div class="container mt-4">
			<div class="row">
				<div class="col-md-6">
					<div class="data_box">
						<h3><span class="fa fas fa-tachometer-alt"></span> Dashboard</h3>
						<img src="images/admin_icon.jpg" class="icons">
						<a href="admin.php" class="btn btn-info btn-block"><span class="fa fa-edit"></span> Manage</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="data_box">
						<h3><span class="fa fa-stethoscope"></span> Doctors</h3>
						<img src="images/manager_icon.png" class="icons">
						<a href="admin_cashier.php" class="btn btn-info btn-block"><span class="fa fa-edit"></span> Manage</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="data_box">
						<h3><span class="fa fa-ambulance"></span> Pharmacist</h3>
						<img src="images/pharmacist_icon.jpg" class="icons">
						<a href="admin_pharmacist.php" class="btn btn-info btn-block"><span class="fa fa-edit"></span> Manage</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="data_box">
						<h3><span class="fa fa-users"></span> Patients</h3>
						<img src="images/patients-icon.gif" class="icons">
						<a href="add_users.php" class="btn btn-info btn-block"><span class="fa fa-edit"></span> Manage</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>
