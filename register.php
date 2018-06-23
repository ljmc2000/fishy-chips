<html><body>
<?php
	include'functions.php';

	if($_POST['password1']!=$_POST['password2'])
	{
		goback("passwords don't match","create-account.php");
	}

	$myconnection=database_connect();

	$username=$_POST['username'];
	$password=hash('sha256',$_POST['password1']);	//encrypt password


	//check they came from the sign-in.html page
	if($username=='')
		goback("access denied","/");

	//check for pre existing user
	$sqlcode=$myconnection->prepare("select username from users where (username like ?)");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();

	if($result->fetch_assoc()["username"])
		goback("pre-existing user found","create-account.php");

	//add user to database
	$sqlcode=$myconnection->prepare("insert into users values(?,?)");
	$sqlcode->bind_param('ss',$username,$password);
	$sqlcode->execute();
	$myconnection->close();

	goback("new user created","/");
?>
</body></html>
