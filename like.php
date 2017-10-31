<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$username=$_SESSION['username'];
$postid=$_POST['pid'];
$sql="SELECT * FROM `likes` WHERE username='".$username."' AND pid='".$postid."'";
$result = $conn->query($sql);
if($result->num_rows==0)
{ 
$sql="INSERT INTO `likes`(`username`,`pid`) VALUES('".$username."','".$postid."')";
if($conn->query($sql)==FALSE)
echo $conn->error();
}
else
echo "Cannot like same post twice";
?>