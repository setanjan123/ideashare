<?php
include 'connect.php';

if(empty($_POST['user'])|| empty($_POST['password']))
echo "The Information you entered is incomplete";	
else
{
$user = $_POST['user'];
$pass = $_POST['password'];
$sql = "SELECT password FROM `users` WHERE username='".$user."'";
$result = $conn->query($sql);
if ($result->num_rows==0)
echo "Invalid username or password";
else
{
while($row = mysqli_fetch_row($result))
if(password_verify($pass,$row[0]))
{
 $sql="SELECT * FROM auth WHERE username='".$user."'";
 $result=$conn->query($sql);
 if($result->num_rows==0)
 {session_start();
 $_SESSION['username'] = $user;      
 echo "1";
 }
else
{echo "Please verify your e-mail";
 exit;
}
}
else
echo "Invalid username or password";
}
}
$conn->close();
 
?>