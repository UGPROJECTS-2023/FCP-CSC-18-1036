<?php
global $msg;
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}

if(isset($_POST['submit'])){
	$reg = $_POST['reg_no'];
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$gender = $_POST['gender'];
	$dept = $_POST['dept'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$guardian = $_POST['guardian'];

	if($ql = $con->query("INSERT INTO `users` (`fname`, `lname`, `regno`, `gender`, `age`, `phone`, `address`, `parent_phone`, `dept`) VALUES ('$fname', '$lname', '$reg', '$gender', '$age', '$phone', '$address', '$guardian', '$dept')")){
		$msg = "<div class = 'alert alert-success'>Account <b>created</b> successfully!</div>";
		// header("location: add_users.php");
	}
	else{
		$msg = "<div class = 'alert alert-danger'>Failed to <b>create</b> user account, try again later</div>";
	}

}

if(isset($_GET['delete_id'])){
	$user_id = $_GET['delete_id'];
	if($sql = $con->query("DELETE FROM `users` WHERE `id` = '$user_id'")){
		$msg = "<div class = 'alert alert-success'>Account <b>deleted</b> successfully!</div>";
	}
	else{
		$msg = "<div class = 'alert alert-dander'>Failed to <b>delete</b> Account, try again later!</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require 'incs/header.php'; ?>
</head>
<body>
<?php include 'incs/data.php'; ?>
<div class="main_body">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-6">
				<h4>Add Patient</h4>
				<?php echo $msg; ?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
					<div class="form-group">
						<label>Registration Number</label>
						<input type="text" name="reg_no" placeholder="Enter Reg No" class="form-control" required>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" placeholder="First name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="radio-inline"><input type="radio" name="gender" value="Male"> Male</label>
						<label class="radio-inline"><input type="radio" name="gender" value="Female"> Female</label>
					</div>
					<div class="form-group">
						<label>Department</label>
						<input type="text" name="dept" placeholder="Enter Department" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Age</label>
						<input type="number" name="age" placeholder="Enter age" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="number" name="phone" placeholder="Enter Phone number" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Home address</label>
						<input type="text" name="address" placeholder="Enter Home address" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Guardian's Phone Number</label>
						<input type="number" name="guardian" placeholder="Enter Guardian's Phone Number" class="form-control" required>
					</div>

					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block ">Register Patient</button>
					</div>

				</form>
			</div>
			<div class="col-md-6" style="border-left: 2px solid green;">
				<h4>Manage Patients</h4>
				<table class="table table-striped">
					<tr>
						<th>Reg Number</th>
						<th>First Name</th>
						<th>Gender</th>
						<th>Delete User</th>
					</tr>
					<?php
						$sql = $con->query("SELECT * FROM `users`");
						while($result = $sql->fetch_assoc()):
					?>
					<tr>
						<td><?php echo $result['regno'] ?></td>
						<td><?php echo $result['fname'] ?></td>
						<td><?php echo $result['gender'] ?></td>
						<td><a href="add_users.php?delete_id=<?php echo $result['id'] ?>"> Delete</a> </td>
					</tr>
				<?php endwhile; ?>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>