<?php include('Test_server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Fatless</title>
  <link rel="stylesheet" type="text/css" href="Test_style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="Test_login.php">
  	<?php include('Test_errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="Test_register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>