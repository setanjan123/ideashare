<?php
session_start();

if(isset($_SESSION['username']) || !empty($_SESSION['username'])){
  header("location: home.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>        
		<title>ideaShare</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
		<link rel="stylesheet" type="text/css" href="styles.css">
<script src="validate.js"></script>
	</head>
	<body>
		<div class="vertical-center">
			<div class="container">
				<div class="row">
			    	<div class="col-md-6">
				    <h1 style="font-size:500%">ideaShare</h1>
			    	</div>
			    	<div class="col-md-6">
				    	<div class=" login">
					        <form id="loginform">
								<input type="text" placeholder="username" name="user" required/><br/>
								<input type="password" placeholder="password" name="password" required/><br/>
								<input type="submit" value="Login"/>
							</form>
							Don't Have an Account ? <a href="register.html" style="color : white">Register Now</a><br/>
						</div>	
			  		</div>
				</div>
			</div>
		</div>
	</body>
</html>