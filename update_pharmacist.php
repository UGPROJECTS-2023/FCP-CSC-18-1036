<?php
global $msg;
session_start();
include_once('connect_db.php');
if(isset($_GET['username'])){
	$users = $_GET['username'];
	$sql = $con->query("SELECT * FROM `pharmacist` WHERE `username` = '$users'");
	$rows = $sql->fetch_assoc();
}

if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$username=$_POST['username'];
$pas=$_POST['password'];
 
// get value of id that sent from address bar


// Retrieve data from database 
if($sql = $con->query("UPDATE `pharmacist` SET `first_name` = '$fname', `last_name` = '$lname', `staff_id` = '$sid',
`postal_address` = '$postal', `phone` = '$phone', `email` = '$email', `username` = '$username', `password` = '$pas' WHERE `username` ='$username'")){
	$msg = "<div class = 'alert alert-success'>Account updated successfully</div>";
	header("location: update_cashier.php?username=" . $username);
}
else{
	$msg = "<div class = 'alert alert-danger'>Failed to update account, try again later</div>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require 'incs/header.php'; ?>
</head>
<body>
<?php include 'incs/data.php'; ?>
<div class="main_body container mt-4">
	<?php echo $msg; ?>
	<div class="card">
		<div class="card-header">
			<h4><span class="fa fa-ambulance"></span> Update Pharmacist</h4>
		</div>
		<div class="card-body">
			<form name="myform" onsubmit="return validateForm(this);" action="update_pharmacist.php" method="post" >
				<div class="form-group">
					<input name="first_name" type="text" placeholder="First Name" value="<?php echo $rows['first_name']?>" id="first_name" class = 'form-control' />
				</div>
				<div class="form-group">
					<input name="last_name" type="text" class="form-control" placeholder="Last Name" id="last_name" value="<?php echo $rows['last_name']?>" />
				</div>
				<div class="form-group">
					<input name="staff_id" type="text" class="form-control" placeholder="Staff ID" id="staff_id" value="<?php echo $rows['staff_id']?>" />
				</div>
				<div class="form-group">
					<input name="postal_address" type="text" class="form-control" placeholder="Address" id="postal_address" value="<?php  echo $rows['postal_address']?>" />
				</div>
				<div class="form-group">
					<input name="phone" type="text" class="form-control" placeholder= "Phone" id="phone" value="<?php  echo $rows['phone']?>" />
				</div>
				<div class="form-group">
					<input name="email" type="email" class="form-control" placeholder="Email" id="email"value="<?php  echo $rows['email']?>" />
				</div>
				<div class="form-group">
					<input name="username" type="text" class="form-control" placeholder="Username" id="username"value="<?php  echo $rows['username']?>" />
				</div>
				<div class="form-group">
					<input name="password" placeholder="Password" id="password"value="<?php  echo $rows['password']?>"type="password" class = 'form-control'/>
				<!-- </div><div class="form-group"></div> -->
				<div class="card-footer">
			<input name="submit" type="submit" value="Update" class="btn btn-primary ">
		</div>
			</form>
		</div>
		
	</div>
</div>
</body>
</html>
