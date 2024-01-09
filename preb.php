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

if(isset($_GET['del_id'])){
	$id = $_GET['del_id'];

	if($con->query("DELETE FROM `pres` WHERE `id` = '$id'")){
		$msg = "<div class = 'alert alert-success'>Prescription deleted successfully</div>";

	}
	else{
		$msg = "<div class = 'alert alert-success'>Failed to delete Prescription</div>";
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
	<?php echo $msg; ?>
	<table class="table table-striped table-dark">
		<tr>
			<th>Reg No</th>
			<th>Full name</th>
			<th>Gender</th>
			<th>Prescription</th>
			<th>Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
			$query = $con->query("SELECT * FROM `pres`");
			if($query->num_rows == 0){
				echo "<div class = 'alert alert-danger'>No Prescription yet</div>";
			}
			while($row = $query->fetch_assoc()):
		?>
		<tr>
			<td><?php echo $row['reg_no'] ?></td>
			<td><?php echo $row['full_name'] ?></td>
			<td><?php echo $row['gender'] ?></td>
			<td><?php echo $row['pres'] ?></td>
			<td><?php echo $row['date'] ?></td>
			<td><?php 
				if($row['status'] == 0)
						echo "Not Prescribed";
					else
						echo "Prescribed";
			 ?></td>
			 <td><a href="preb.php?del_id=<?php echo $row['id']; ?>">Delete</a> </td>
		</tr>
	<?php endwhile; ?>
	</table>
</div>
</body>
</html>