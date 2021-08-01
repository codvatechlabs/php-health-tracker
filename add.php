<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Employee Health Record Portal.</h1>
    <p>
    
        <a href="add.html" class="btn btn-warning ml-3">Add New Emp Record</a>
        <a href="logout.php" class="btn btn-warning ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>
<html>
<head>
	<title>Add New Employee</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$status = mysqli_real_escape_string($mysqli, $_POST['status']);
	$remark = mysqli_real_escape_string($mysqli, $_POST['remark']);	
	$emp_id = mysqli_real_escape_string($mysqli, $_POST['emp_id']);	
	$home_address = mysqli_real_escape_string($mysqli, $_POST['home_address']);	
	$mobile_no = mysqli_real_escape_string($mysqli, $_POST['mobile_no']);	
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,age,email,status,remark,emp_id,home_address,last_update,mobile_no) VALUES('$name','$age','$email','$status','$remark','$emp_id','$home_address','NA','$mobile_no')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='welcome.php'>View Result</a>";
	}
}
?>
</body>
</html>