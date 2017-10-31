<?php
include 'connect.php';

if(empty($_POST['user'])|| empty($_POST['password']))
	{ echo "The Information you entered is incomplete";
      header( "refresh:2; url=index.php" ); 
	}
	
else
{
$user = $_POST['user'];
$pass = $_POST['password'];
$sql = "SELECT * FROM `users` WHERE username='".$user."' AND password='".$pass."'";
$result = $conn->query($sql);
if ($result->num_rows==0)
{ echo "<h1>Invalid username or password</h1>";
   header( "refresh:2; url=index.php" ); 
}
else
{
 $sql="SELECT * FROM auth WHERE username='".$user."'";
 $result=$conn->query($sql);
 if($result->num_rows==0)
 {session_start();
 $_SESSION['username'] = $user;      
 header("location: home.php");
 }
 else
{ echo "<h1>Please verify your e-mail</h1>";
  header( "refresh:2; url=index.php" ); 
}
}
}

$conn->close();
 
?>