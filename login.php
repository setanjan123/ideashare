<?php
include 'connect.php';

if(empty($_POST['user'])|| empty($_POST['password']))
echo "The Information you entered is incomplete";
	
else
{
$user = $_POST['user'];
$pass = $_POST['password'];
$sql = "SELECT * FROM `users` WHERE username='".$user."' AND password='".$pass."'";
$result = $conn->query($sql);
if ($result->num_rows==0)
echo "Invalid username or password";

else
{
 $sql="SELECT * FROM auth WHERE username='".$user."'";
 $result=$conn->query($sql);
 if($result->num_rows==0)
 {session_start();
 $_SESSION['username'] = $user;      
 echo "1";
 }
 else
echo "Please verify your e-mail";
}
}

$conn->close();
 
?>