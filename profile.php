<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$username=$_GET['user'];
$sql="SELECT fullname,email,gen,bdate,imgpath FROM users WHERE username='".$username."'";
$result=$conn->query($sql);
if($result->num_rows==0)
{echo "<h1>No such user found</h1>";
 exit;
}
else
$result=mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $_SESSION['username']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<style>
body
{
padding-top: 70px;
background-image: url("bg.jpg");
}

#myform,#myform2
{
display : none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).on('input','#sbar', {} ,function()
{
var search=$(this).val();
var request=
	   {
	     url : "search.php",
		 type : 'POST',
		 data: {search: search},
		 dataType: "html",
		 async: true,
		 success: function(result){
		 $('#sbox').text("");
		 $('#sbox').append(result);
	     }
        };
       	$.ajax(request);
});
$(document).ready(function()
{
$("#chngpass").click(function()
{
var toggle=$('#myform').is(":visible");
if(toggle)
$("#myform").hide();
else
$("#myform").show();
});

$("#update-dp").click(function()
{
var toggle=$('#myform2').is(":visible");
if(toggle)
$("#myform2").hide();
else
$("#myform2").show();
});

});
</script>
  
<head>
<link rel="stylesheet" href="home.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span> 
</button>
<a class="navbar-brand" href="home.php">ideaShare</a>
</div>
</ul>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a><input type="search" size="20" placeholder="Search for a user" id="sbar" style="color:black"></a>
<div class="search" id="sbox">
</div></li>
<li><a href=<?php echo "profile.php?user=".$_SESSION['username']; ?> ><?php echo $_SESSION['username']; ?></a></li>
<li><img src=<?php echo $_SESSION['dp'];?> width='45px' height='45px' style=" border : 1px solid black"></li>
</ul>
  <ul class="nav navbar-nav navbar-right">
  <li class=".navbar-btn"><a href="logout.php" >Logout</a></li></ul>
</div>
</div></nav>
</head>
<body>
<div class="row">
<div class="col-md-6">
<br><img src=<?php echo $result[4];?> width='200px' height='200px' style=" border : 1px solid black"><br>
<?php 
 if($_SESSION['username']===$username)
 {
 echo "<br><button id='update-dp' class='btn btn-primary'>Update Profile Picture</button><br><br>";
 echo "<form action='update-dp.php' method='post' id='myform2' enctype='multipart/form-data'>
       <input type='file' name='image' accept='.bmp,.jpg,.jpeg,.png'><br><br>
	   <input type='submit' value='Update' class='btn btn-success'></form><br><br>";
 
echo "<button id='chngpass' class='btn btn-info'>Change Password</button><br><br>";
echo "<form action='change-password.php' method='post' id='myform'>
      <input type='password' placeholder='Enter current password' name='oldpass'/><br><br>
	  <input type='password' placeholder='Enter new password' name='newpass'/><br><br>
	  <button class='btn btn-danger'>Submit</button></form><br><br>";
 }
 ?>
 </div>
 <div class="col-md-6">
 <?php
 echo "<b>Username:</b> ".$username."<br>";
 echo "<b>Full Name:</b> ".$result[0]."<br>";
 echo "<b>E-mail:</b> ".$result[1]."<br>";
 echo "<b>Gender:</b>".$result[2]."<br>";
 echo "<b>Date of Birth:</b>".$result[3]."<br><br>";
 if($_SESSION['username']!=$username)
{
 $sql="SELECT * FROM `followers` WHERE username='".$username."' AND follower='".$_SESSION['username']."'";
 $result = $conn->query($sql);
 if ($result->num_rows==0)
 { echo "<form action='follow.php' method='post'>
        <input type='hidden' name='request' value=1>
		<input type='hidden' name='user' value=".$username.">
		<button class='follow , btn btn-success'>Follow</button>
		</form><br>";
}  
else
{
echo "<form action='follow.php' method='post'>
        <input type='hidden' name='request' value=0>
		<input type='hidden' name='user' value=".$username.">
		<button class='unfollow , btn btn-danger'>Unfollow</button>
		</form><br>";
}
}
$follow1="SELECT username FROM `followers` WHERE follower='".$username."'";
$follow2="SELECT follower FROM `followers` WHERE username='".$username."'";
$following=$conn->query($follow1);
$followers=$conn->query($follow2);
echo "<b>Following:</b><br>";
while($row = mysqli_fetch_row($following))
echo "<a href='profile.php?user=".$row[0]."'>".$row[0]."</a><br>";
echo "<b>Followers:</b><br>";
while($row = mysqli_fetch_row($followers))
echo "<a href='profile.php?user=".$row[0]."'>".$row[0]."</a><br>";
?>
</div>
</body>
</html>