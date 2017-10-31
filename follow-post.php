<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

include 'connect.php';
$pid=$_POST['pid'];
$username=$_SESSION['username'];
$sql= $conn->prepare("INSERT INTO `subscribed` (`pid`, `username`) VALUES(?,?)");
$sql->bind_param("is", $pid, $username);
if ($sql->execute() === FALSE) 
echo "Error";
else
echo "Successful";
$sql->close();
$conn->close();
?>