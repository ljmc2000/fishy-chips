<?php
	include'functions.php';
	$myconnection=database_connect();
	$username=$_COOKIE["login_cookie"];

	//check user is logged in
	if(!isset($_COOKIE["login_cookie"]))
		goback("access denied","/");

	if($_POST['newpwd1']!=$_POST['newpwd2'])
	{
		goback("passwords don't match",$_SERVER['HTTP_REFERER']);
	}

	//check old password
	$sqlcode=$myconnection->prepare("select password from users where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
	$row=$result->fetch_assoc();
	$oldpwd=hash('sha256',$_POST['oldpwd']);
	if($oldpwd!=$row["password"])
	{
		goback("wrong original password",$_SERVER['HTTP_REFERER']);
	}

	//update password
	$password=hash('sha256',$_POST['newpwd1']);	//encrypt password
	$sqlcode=$myconnection->prepare("update users set password=? where username=?");
	$sqlcode->bind_param('ss', $password, $username);
	$sqlcode->execute();
	$myconnection->close();

	goback("password updated",$_SERVER['HTTP_REFERER']);
?>
