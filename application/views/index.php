<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
<?php
	if($this->session->flashdata('error_message')) { ?>
		<p><?=$this->session->flashdata('error_message');?></p>				
<?	}
	if($this->session->flashdata('success_message')) { ?>
		<p><?=$this->session->flashdata('success_message');?></p>
<?	}
?>
	<h1>Registration</h1>
	<form action = 'register' method = 'post'>
		Name: <input type = "text" name = "name"><br>
		Alias: <input type = "text" name = "alias"><br>
		Email: <input type = "text" name = 'email'><br>
		Password: <input type = "password" name = "password"><br>
		Confirm Password: <input type = "password" name = 'confirm_password'><br>
		Date of Birth: <input type = "date" name = "dob">
		<input type = "submit" value = 'register'>
	</form>
<?php 
	if($this->session->flashdata('login_fail_message')) { ?>
		<p><?=$this->session->flashdata('login_fail_message')?></p>
<?php
}
?>
	<h1>Login</h1>
	<form action = 'login' method = 'post'>
		Email: <input type = "text" name = "email"><br>
		Password: <input type = "text" name = 'password'><br>
		<input type = "submit" value = 'login'>
	</form>
</body>
</html>