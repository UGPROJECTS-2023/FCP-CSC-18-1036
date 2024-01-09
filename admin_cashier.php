<?php
global $message;
global $message1;
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
if (!preg_match("/^[a-zA-Z ]*$/",$fname))
  {
  $nameErr = "Only letters and white space allowed";
  }
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$sql1=mysqli_query($con,"SELECT * FROM doctor WHERE username='$user'")or die(mysqli_error($con));
 $result=mysqli_fetch_array($sql1);
 if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysqli_query($con,"INSERT INTO doctor(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$pas',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_cashier.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'incs/header.php' ?>
<script src="js/function.js" type="text/javascript"></script>
<script src="js/validation_script.js" type="text/javascript"></script>
<!--<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>-->

</head>
<body>
<?php
include 'incs/data.php';
?>
<div class="main_body">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-6">
				<h4>Add Doctors</h4>
				<form name="form1"  onsubmit="return validateForm(validation_script.js);" action="admin_cashier.php" method="post" >
					<div class="form-group">
						<label>First Name</label>
						<input name="first_name" type="text" class="form-control" placeholder="First Name" required="required"  id="first_name" />
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input name="last_name" type="text" class="form-control" placeholder="Last Name" required="required" id="last_name" />
					</div>
					<div class="form-group">
						<label>Staff ID</label>
						<input name="staff_id" type="text" class="form-control" placeholder="Staff ID" required="required" id="staff_id" />
					</div>
					<div class="form-group">
						<label>Postal Address</label>
						<input name="postal_address" type="text" class="form-control" placeholder="Address" required="required" id="postal_address" />
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input name="phone" type="text" class="form-control" placeholder="Phone"  required="required" id="phone" />
					</div>
					<div class="form-group">
						<label>Email address</label>
						<input name="email" type="email" class="form-control" placeholder="Email" required="required" id="email" />
					</div>
					<div class="form-group">
						<label>Username</label>
						<input name="username" type="text" class="form-control" placeholder="Username" required="required" id="username" />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="password" type="password" class="form-control" placeholder="Password" required="required" id="password"/>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-info btn-block btn-lg">Submit</button>
					</div>
				</form>
			</div>
			<div class="col-md-6" style="border-left: 2px solid green;">
				<?php echo $message;
			  echo $message1;
			  
		/* 
		View
        Displays all data from 'Cashier' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($con,"SELECT * FROM doctor") 
                or die(mysqli_error($con));
				
					    
        // display data in table
        
        echo "<table class = 'table table-striped'>";
        echo "<tr> <th>ID</th><th>Firstname </th> <th>Lastname </th> <th>Username </th><th>Update </th><th>Delete</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                
                echo '<td>' . $row['cashier_id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				?>
				<td><a href="update_cashier.php?username=<?php echo $row['username']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete_cashier.php?cashier_id=<?php echo $row['cashier_id']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
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
