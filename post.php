<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}


if(!empty($_POST['post']))
{
include 'connect.php';
$username=$_SESSION['username'];
$text= $_POST['post'];
$sql = $conn->prepare("INSERT INTO `posts` (`username`, `post`) VALUES (?, ?)");
$sql->bind_param("ss", $username, $text);
if ($sql->execute() === FALSE) 
echo "Error";
}
else
echo "Post cannot be empty";
$sql->close();
$conn->close();
?>