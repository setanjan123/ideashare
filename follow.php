<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$myname=$_SESSION['username'];
$username=$_POST['user'];
$request=$_POST['request'];
$loc="profile.php?user=".$username;
if($request==1)
$sql="INSERT INTO `followers` (`username`,`follower`) VALUES('".$username."','".$myname."')";
else if($request==0)
$sql="DELETE FROM `followers` WHERE username='".$username."' AND follower='".$myname."'";
if ($conn->query($sql) === FALSE) 
echo $conn->error;
else
header("location: ".$loc."");
?>
