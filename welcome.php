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

<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
$user_arr = array();
?>

<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
?>


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

<style>
p.rtl {
  direction: rtl;
}
</style>


</head>
<body>
<form method='post' action='export.php'>
<input type='submit' class="btn btn-secondary btn-lg btn-block" value='Export Records' name='Export Records'>

<table id="customers">
  <tr>
    <th>Emp Id</th>
    <th>Employee Name</th>
    <th> Age</th>
    <th>Email Id</th>
    <th>Mobile Number</th>
    <th>Address</th>
    <th>COVID19 Status</th>
    <th>Remark</th>
    <th>Last Updated</th>
    <th>Update Record</th>
  </tr>
  <?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
  $user_arr[] = array("Emp Id","Employee Name","Age","Email Id","Mobile Number","Address","COVID19 Status","Remark","Last Updated");
  while($res = mysqli_fetch_array($result)) { 		
    echo "<tr>";
    #$id = $res['emp_id'];
		echo "<td>".$res['emp_id']."</td>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['email']."</td>";	
		echo "<td>".$res['mobile_no']."</td>";	
		echo "<td>".$res['home_address']."</td>";
		echo "<td>".$res['status']."</td>";	
		echo "<td>".$res['remark']."</td>";	
		echo "<td>".$res['last_update']."</td>";
    echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"timeline.php?id=$res[id]\">Timeline</a>  | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
    $user_arr[] = array($res['emp_id'],$res['name'],$res['age'],$res['email'],$res['mobile_no'],$res['home_address'],$res['status'],$res['remark'],$res['last_update']);
  }
	?>
 
</table>
<?php 
    $serialize_user_arr = serialize($user_arr);
   ?>
  <textarea name='export_data' style='display: none;'><?php echo $serialize_user_arr; ?></textarea>
 </form>

</body>
</html>