<?php
	include 'functions.php';
	$goto='/';

	$myconnection=database_connect();

	$username=$myconnection->real_escape_string($_POST['username']);
	$password1=hash('sha256',$_POST['password1']);

	//check they came from the sign-in.html or index page
	if($username=='')
		goback("access denied",$goto);

	$sqlcode="select password from users where(username= BINARY '$username')";

	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$password2=$row["password"];

	$myconnection->close();

	if($password1 == $password2)
	{
		$cookie_name = "login_cookie";
		$cookie_value = $username;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

		goback("login sucess",$goto);
	}
	else if($password2=="")
	{
		goback("user not found: please register",$goto);
	}

	else
	{
		goback("incorrect password",$goto);
	}
?>
