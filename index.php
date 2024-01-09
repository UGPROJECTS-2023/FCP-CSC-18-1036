<?php
global $message;
include_once 'connect_db.php';
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];
$position=$_POST['position'];
switch($position){
case 'Admin':
$result=mysqli_query($con,"SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['admin_id']=$row[0];
$_SESSION['username']=$row[1];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
 $message="<div class = 'alert alert-danger text-center'><b>Invalid Login Details</b></div>";
}
break;
case 'Pharmacist':
$result=mysqli_query($con,"SELECT pharmacist_id, first_name,last_name,staff_id,username FROM pharmacist WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['pharmacist_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
}else{
$message="<div class = 'alert alert-danger text-center'><b>Invalid Login Details</b></div>";
}
break;
case 'Doctor':
$result=mysqli_query($con,"SELECT cashier_id, first_name,last_name,staff_id,username FROM doctor WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['cashier_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/doctor.php");
}else{
$message="<div class = 'alert alert-danger text-center'><b>Invalid Login Details</b></div>";
}
break;

}}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "incs/header.php" ?>
	
	<style type="text/css">
		body{
			background: #efefef;
		}
		.card{
			margin-top: 10px;
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}
		img{width: 15%}
		.form-control{border-radius: 0}
		.card-header, .card-footer{text-align: center; background: #292F33; color: #fff}
		.card-footer button, .card-footer button:hover{
			background: rgba(0, 0, 0, 0.5);
			border-radius: 0;
			border: 0;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
			<div class="card">
		<div class="card-header">
			<img src="images/fud.png">
			<h3>FUD Clinic Portal - Staff Login</h3>
		</div>
		<div class="card-body">
			<?php echo $message; ?>
			
				<div class="form-group">
					<label>
						<span class="fa fa-user"></span>
						Enter Username
					</label>
					<input type="text" name="username" value="" placeholder="Username" class="form-control" required>
				</div>
				<div class="form-group">
					<label>
						<span class="fa fa-lock"></span>
						Enter password
					</label>
					<input type="password" name="password" value="" placeholder="xxxxxx" class="form-control" required>
				</div>
				<div class="form-group">
					<label>
						<span class="fab fa-superpowers"></span>
						Enter Position
					</label>
					<select name="position" class="form-control" required>
						<option value="Admin">Admin</option>
						<option value="Doctor">Doctor</option>
						<option value="Pharmacist">Pharmacist</option>
					</select>
				</div>
				
			<!-- </form> -->
		</div>
		<div class="card-footer">
			<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Login</button>
				</div>
		</div>
	</div>
</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
</body>
</html>