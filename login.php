<?php
session_start();
require_once 'classes/Membership.php';
$membership = new Membership();

//If user clicks log out on index.php
if(isset($_GET['status']) && $_GET['status'] == 'loggedout'){
	$membership->log_User_Out();
	echo "<div class=\"alert alert-success alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Success!</strong>Successfully Logged Out!</div>";
};

//Did the user enter username and password and click submit
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])){
	$response = $membership->validate_user($_POST['username'], $_POST['pwd']);

}

 ?>


<head>
	<link rel="stylesheet" type="text/css" href="login.css" />
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<html>
<title>Login to access grading site </title>

<body>

<div id="login" >
	<div class="loginbackground">
</div>
	<form method="post" action="" class="login">
		<h2>Login</h2>
		<p>
			<label for"username">Username: </label>
			<input type="text" name="username" />
		</p>

		<p>
			<label for="pwd">Password: </label>
			<input type="password" name="pwd" />
		</p>

		<p>
			<input type="submit" id="submit" value="Login" name="submit" />
		</p>
	</form>
	<?php if(isset($response)) echo "<h4>" . $response . "</h4>"; ?>

</div>
</body>
</html>
