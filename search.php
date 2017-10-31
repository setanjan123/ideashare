<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$search = preg_replace('/\s+/', '',$_POST['search']);   
if(empty($search))
echo "";
else
{
$user=$_SESSION['username'];
$sql = "SELECT imgpath,username FROM `users` WHERE username LIKE '".$search."%'";
$result = $conn->query($sql);
if ($result->num_rows==0)
echo "<a>No users found</a>";
else
{
while($row=mysqli_fetch_row($result)) {
echo "<a><img src=".$row[0]." width='25px' height='25px'><br></a>";
echo "<a>".$row[1]."</a>";
echo "<a href='profile.php?user=".$row[1]."'><b>View Profile</b></a><br>";
}
}
}
?>