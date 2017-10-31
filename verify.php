<?php
$user=$_GET['u'];
$code=$_GET['c'];
if(empty($user)||empty($code))
echo "<h1>Error .Invalid code or username</h1>";
else
{
include 'connect.php';
$sql="DELETE FROM auth WHERE username='".$user."' AND code='".$code."'";
$conn->query($sql);
if(mysqli_affected_rows($conn)!=0)
echo "<h1>Successfully registered e-mail. Re-directing to login page</h1>";
else
echo "<h1>Error .Invalid code or username</h1>";
}
header( "refresh:2; url=index.php" ); 
?>