<?php
global $msg;
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

if(isset($_GET['data_id'])){
	$data = $_GET['data_id'];
	$sql = "SELECT * FROM `users` WHERE `id` = '$data'";
	$run = $con->query($sql);
	$row = $run->fetch_assoc();
}
// else{
// 	header("location: users.php");
// }
function validate_post($data){

	include_once('connect_db.php');
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	$data = stripcslashes($data);
	//$data = mysqli_real_escape_string($conn, $data);
	return $data;
}

if(isset($_POST['submit'])){
	$data = validate_post($_POST['prebs']);
	$user_id = $_POST['main'];
	$sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
	$run = $con->query($sql);
	$row = $run->fetch_assoc();
	$reg = $row['regno'];
	$full_name = $row['fname'] . ' ' . $row['lname'];
	$gender = $row['gender'];
	$age = $row['age'];

	$date  = date("D, d M Y");

	if($sql = $con->query("INSERT INTO `pres` (`reg_no`, `gender`, `age`, `full_name`, `pres`, `date`) VALUES ('$reg', '$gender', '$age', '$full_name', '$data', '$date')")){
		$msg = "<div class = 'alert alert-success'>Prescriptions successfully sent</div>";
	}
	else{
		$msg = "<div class = 'alert alert-danger'>Failed to make Prescriptions, please try again later</div>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require 'incs/header.php'; ?>
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
		<div class="row">
			<div class="col-md-8">
				<?php echo $msg; ?>
				<h4>Patient Data</h4>
				<table class="table table-striped table-dark">
					<tr>
						<th>First Name</th>
						<td><?php echo $row['fname'] ?></td>
						<th>Last Name</th>
						<td><?php echo $row['lname'] ?></td>
					</tr>
					<tr>
						<th>Gender</th>
						<td><?php echo $row['gender'] ?></td>
						<th>Age</th>
						<td><?php echo $row['age'] ?></td>
					</tr>
					<tr>
						<th>Reg</th>
						<td><?php echo $row['regno'] ?></td>
						<th>Dept</th>
						<td><?php echo $row['dept'] ?></td>
					</tr>
					<tr>
						<th>Phone</th>
						<td><?php echo $row['phone'] ?></td>
						<td>Address</td>
						<td><?php echo $row['address'] ?></td>
					</tr>
					<tr>
						<th>Guardian's phone</th>
						<td><?php echo $row['parent_phone'] ?></td>
						<th>Status</th>
						<td>Active</td>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<h4>Make prescriptions</h4>
				<form action="make_preb.php" method = "POST">
					<div class="form-group">
						<textarea class="form-control" rows="7" name="prebs"></textarea>
						<input type="hidden" name="main" value="<?php echo $_GET['data_id']; ?>">
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block ">Prescribe</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>