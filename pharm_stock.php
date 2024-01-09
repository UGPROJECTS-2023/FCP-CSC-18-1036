<?php
global $message1,$message;

session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."index.php");
exit();
}
if(isset($_POST['submit'])){
$sname=$_POST['drug_name'];
$cat=$_POST['category'];
$des=$_POST['description'];
$com=$_POST['company'];
$sup=$_POST['supplier'];
$qua=$_POST['quantity'];
$cost=$_POST['cost'];
$sta="Available";

$sql=mysqli_query($con,"INSERT INTO stock(drug_name,category,description,company,supplier,quantity,cost,status,date_supplied)
VALUES('$sname','$cat','$des','$com','$sup','$qua','$cost','$sta',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharm_stock.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require 'incs/header.php' ?>
</head>
<body>
<?php include 'incs/pharm_data.php'; ?>
<div class="main_body">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-6">
				<div class="card card-primary">
					<div class="card-header">
						<h4>Add Drugs</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method = 'POST'>
					<div class="form-group">
						<input name="drug_name" type="text" class="form-control" placeholder="Drug Name" required="required" id="drug_name" />
					</div>
					<div class="form-group">
						<input name="category" type="text" class="form-control" placeholder="Category" required="required" id="category"/>
					</div>
					<div class="form-group">
						<input name="description" type="text" class="form-control" placeholder="Description" required="required" id="description" />
					</div>
					<div class="form-group">
						<input name="company" type="text" class="form-control" placeholder="Manufacturing Company"  required="required" id="company" />
					</div>
					<div class="form-group">
						<input name="supplier" type="text" class="form-control" placeholder="Supplier" required="required" id="supplier" />
					</div>
					<div class="form-group">
						<input name="quantity" type="text" class="form-control" placeholder="Quantity" required="required" id="quantity" />
					</div>
					<div class="form-group">
						<input name="cost" type="text" class="form-control" placeholder="Unit Cost" required="required" id="cost" />
					</div>
					<div class="form-group">
						<input name="submit" type="submit" value="Add Drug" id="submit" class="btn btn-primary" />
					</div>
				</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				 <?php echo $message;
			  echo $message1;
			  ?>
      
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($con,"SELECT * FROM stock") 
                or die(mysqli_error($con));
		// display data in table
        echo "<table class = 'table table-striped table-dark table-hover table-responsive'>";
         echo "<tr><th>ID</th><th>Name</th><th>Category</th><th>Description</th><th>Status </th><th>Date </th> <th>Quantity</th> <th>Delete</th></tr>";

        // loop through results of database query, displaying them in the table
         $x = 0;
        while($row = mysqli_fetch_array( $result )) {
        	$x++;
                
                // echo out the contents of each row into a table
                echo "<tr>";
                 echo '<td>' . $x . '</td>';               
                echo '<td>' . $row['drug_name'] . '</td>';
				echo '<td>' . $row['category'] . '</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
				echo '<td>' . $row['date_supplied'] . '</td>';
				echo '<td>' . $row['quantity'] . '</td>';
				?>
				<td><a href="delete_stock.php?stock_id=<?php echo $row['stock_id']?>"><img src="images/delete-icon.jpg" width="24" height="24" border="0" /></a></td>
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
			</div>
		</div>
	</div>
</div>
</body>
</html>