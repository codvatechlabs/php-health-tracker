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
		<a href="welcome.php" class="btn btn-warning ml-3">View Emp Record</a>
    <a href="logout.php" class="btn btn-warning ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>

</html>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<style>
::placeholder {
  color: black;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: black;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: black;
}
</style>

<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$status = mysqli_real_escape_string($mysqli, $_POST['status']);	
	$remark = mysqli_real_escape_string($mysqli, $_POST['remark']);	
	$mobile_no = mysqli_real_escape_string($mysqli, $_POST['mobile_no']);	
	date_default_timezone_set('Asia/Kolkata');
  $custom_msg = date('m/d/Y h:i:s a', time());
  $current_user =$_SESSION["username"];
	
	// checking empty fields
	if(empty($remark) || empty($status)) {	
			
		if(empty($status)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($remark)) {
			echo "<font color='red'>Remark Field is empty.</font><br/>";
		}
	} else {	
		//updating the table
		
		#$result = mysqli_query($mysqli, "UPDATE users SET name='$name',age='$age',email='$email',status='$status',remark='$remark',last_update='$custom_msg',mobile_no='$mobile_no' WHERE id=$id");
    $result = mysqli_query($mysqli, "UPDATE users SET status='$status',remark='$remark',last_update='$custom_msg' WHERE id=$id");
		$result = mysqli_query($mysqli, "INSERT INTO timeline(id,timestamp,comments,status,updated_by) VALUES('$id','$custom_msg','$remark','$status','$current_user')");
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>


<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
	$status = $res['status'];
	$remark = $res['remark'];
	$mobile_no = $res['mobile_no'];
	$home_address = $res['home_address'];
	$emp_id = $res['emp_id'];
}
?>
<html>

<body>

<h2>Upadate Employee Health Information</h2>


<div class="container">
  <form action="edit.php" method="post" name="form1">
    <div class="row">
      <div class="col-25">
        <label for="fname">Employee Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" readonly placeholder="<?php echo $name;?>">
	</div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="Emp ID">EmpID</label>
      </div>
      <div class="col-75">
        <input type="text" id="emp_id" name="emp_id" readonly placeholder="<?php echo $emp_id;?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="Mobile Number">Mobile Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="mobile_no" name="mobile_no" readonly placeholder="<?php echo $mobile_no;?>">
      </div>
	</div>
    <div class="row">
      <div class="col-25">
        <label for="Emp Age">Age</label>
      </div>
      <div class="col-75">
        <input type="text" id="age" name="age" readonly placeholder="<?php echo $age;?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Email ID</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" readonly placeholder="<?php echo $email;?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="Home Address">Home Address</label>
      </div>
      <div class="col-75">
        <textarea id="home_address" name="home_address" readonly placeholder="<?php echo $home_address;?>" style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="COVID Status">COVID19 Status</label>
      </div>
      <div class="col-75">
        <select id="status" name="status">
		  <option value="COVID19-Positive"><?php echo $status;?></option>
		  <option value="COVID19-Positive">COVID19-Positive</option>
          <option value="COVID19-Home-Isolate">COVID19-Home-Isolate</option>
          <option value="Other">Other</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="Remark">Remark</label>
      </div>
      <div class="col-75">
        <textarea id="remark" name="remark" placeholder="" style="height:100px" style="background-color:#99FFFF"></textarea>
      </div>
    </div>
    <div class="row">
	  <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
      <input type="submit" name="update" value="Update">
    </div>
  </form>
</div>

</body>
</html>





