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
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
			<h4>Search Patient unique Number</h4>
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
				$sql = $con->query("SELECT * FROM `users` WHERE `regno` = '$get_data'");
				if($sql->num_rows == 0){
					echo "<div class = 'alert alert-danger mt-4'><b><i>$get_data</i></b> is not registered on this server</div>";
				}
				else{
					while($row = $sql->fetch_assoc()):
		?>
		<table class="mt-4 table table-striped table-dark">
			<tr>
				<th>Full name</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Dept</th>
				<th>Make prescriptions</th>
			</tr>
			<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
			<td><?php  echo $row['gender'];?></td>
			<td><?php  echo $row['age'];?></td>
			<td><?php  echo $row['dept'];?></td>
			<td><a href="make_preb.php?data_id=<?php echo $row['id'] ?>">Make prescription</td>
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