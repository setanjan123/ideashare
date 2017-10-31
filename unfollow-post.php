<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

include 'connect.php';
$pid=$_POST['pid'];
$username=$_SESSION['username'];
$sql="DELETE FROM `subscribed` WHERE username='".$username."' AND pid='".$pid."'";
if ($conn->query($sql)==FALSE)
echo "Error";
else
echo "Successful";
$conn->close();
?>