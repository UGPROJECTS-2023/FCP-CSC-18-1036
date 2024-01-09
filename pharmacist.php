<?php
global $msg;
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_GET['preb_id'])){
	$id = $_GET['preb_id'];
	$qur = $con->query("SELECT * FROM `pres` WHERE `id` = '$id'");
	$row =$qur->fetch_assoc();
	if($row['status'] == 1){
		$msg = "<div class = 'alert alert-success'><b>Prescription status changed already!</b></div>";
	}
	else{
		$sql = $con->query("UPDATE `pres` SET `status` = '1' WHERE `id` = '$id'");
		$msg = "<div class = 'alert alert-success'><b>Prescription status changed to <i>Prescribed</i></b></div>";
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
	.master{border-bottom: 2px solid beige; font-family: lucida console; background: beige; padding: 20px; line-height: 2; margin-bottom: 20px}
</style>
</head>
<body>
<?php require 'incs/pharm_data.php'; ?>
<div class="main_body">
	<div class="container">
		<div class="master">
			<h4>Welcome, <?php echo $_SESSION['username']; ?></h4>
		</div>
		<?php echo $msg; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
			<h4>Search Patient Number</h4>
			<div class="input-group">
				<input type="text" name="reg_no" placeholder="Enter reg no" class="form-control">
				<div class="input-group-btn">
					<button type="submit" name="submit" class="btn btn-primary">
						<span class="fa fa-search"></span>
					</button>
				</div>
			</div>
		</form>

		<?php
			if(isset($_POST['submit'])){
				$get_data = $_POST['reg_no'];
				$sql = $con->query("SELECT * FROM `pres` WHERE `reg_no` = '$get_data'");
				if($sql->num_rows == 0){
					echo "<div class = 'alert alert-danger mt-4'>No prescription found for <b><i>$get_data</i></b></div>";
				}
				else{
					while($row = $sql->fetch_assoc()):
		?>
		<table class="mt-4 table table-striped table-dark">
			<tr>
				<th>Full name</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Prescriptions</th>
				<th>date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<td><?php echo $row['full_name']; ?></td>
			<td><?php  echo $row['gender'];?></td>
			<td><?php  echo $row['age'];?></td>
			<td><?php  echo $row['pres'];?></td>
			<td><?php echo $row['date'] ?></td>
			<td>
				<?php
					if($row['status'] == 0)
						echo "Not Prescribed";
					else
						echo "Prescribed";
				?>
			</td>
			<td><a href="pharmacist.php?preb_id=<?php echo $row['id']; ?>">Prescribe</a> </td>
		</table>
		<?php
	 endwhile; 
		}
			}
		?>
	</div>
</div>
</body>
</html>
