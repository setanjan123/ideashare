<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}

include 'connect.php';
$username=$_SESSION['username'];
$postid=$_POST['pid'];
$sql="DELETE FROM `likes` WHERE username='".$username."' AND pid='".$postid."'";
$conn->query($sql);
if(mysqli_affected_rows($conn)==0)
echo "Cannot unlike same post twice";
?>