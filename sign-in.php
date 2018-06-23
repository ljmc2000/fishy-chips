<?php
	include 'functions.php';
	$goto='/';

	$myconnection=database_connect();

	$username=$_POST['username'];
	$password1=hash('sha256',$_POST['password1']);

	//check they came from the sign-in.html or index page
	if($username=='')
		goback("access denied",$goto);

	//fetch password from database
	$sqlcode=$myconnection->prepare("select password from users where(username= BINARY ?)");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
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
