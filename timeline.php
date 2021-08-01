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
    <h1 class="my-5"><b></b> Employee Health Record Portal</h1>
    <p>
    
        <a href="add.html" class="btn btn-warning ml-3">Add New Emp Record</a>
		    <a href="welcome.php" class="btn btn-warning ml-3">View Emp Record</a>
        <a href="logout.php" class="btn btn-warning ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>

<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
#$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");
$result = mysqli_query($mysqli, "SELECT * FROM timeline where id =$id"); // using mysqli_query instead
$temp = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");
?>

<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($tem = mysqli_fetch_array($temp)) { 		
		echo "<tr>";
    #echo "<td>".$tem['name']."</td>";
    $flag = $tem['name'];
  }
?>

<h4 class="my-5">Health Event Timeline for, <b><?php echo htmlspecialchars($flag)?></b></h4>

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
<body>

<html>  
    <head>  
        <title>Dynamic Timeline</title>
        <script src="js/jquery.js"></script>
        <script src="js/timeline.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/timeline.min.css" />
  
    </head>  
    <body>  
        <div class="container">
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
                </div>
                <div class="panel-body">
                 <div class="timeline">
                  <div class="timeline__wrap">
                   <div class="timeline__items">
                   <?php 
                   while($res = mysqli_fetch_array($result))
                   {
                   ?>
                    <div class="timeline__item">
                     <div class="timeline__content">
                      <h2><?php echo $res['timestamp']; ?></h2>
                      <p><?php echo "Updated By->",$res['updated_by'];?></p>
                      <p2><?php echo $res['status'];?></p2>
                      <p><?php echo $res['comments'];?></p>
                     </div>
                    </div>
                   <?php
                   }
                   ?>
                   </div>
                  </div>
                 </div>
                </div>
   </div>
  </div>
    </body>  
</html>

<script>
$(document).ready(function(){
 jQuery('.timeline').timeline({
  //mode: 'horizontal',
  //visibleItems: 4
  //Remove this comment for see Timeline in Horizontal Format otherwise it will display in Vertical Direction Timeline
 });
});
</script>


