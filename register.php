<html><body>
<?php
	include'functions.php';

	if($_POST['password1']!=$_POST['password2'])
	{
		goback("passwords don't match","sign-in.html");
	}

	$myconnection=database_connect();

	$username=$myconnection->real_escape_string($_POST['username']);
	$password=hash('sha256',$_POST['password1']);	//encrypt password


	//check they came from the sign-in.html page
	if($username=='')
		goback("access denied","/");

	//check for pre existing user
	$sqlcode="select username from users where username='$username';";
	$result=$myconnection->query($sqlcode);
	$username2=$result->fetch_assoc()["username"];

	if($username2==$username)
		goback("pre-existing user found","sign-in.html");

	//add user to database
	$sqlcode="insert into users values('$username','$password')";
	mysqli_query($myconnection,$sqlcode);
	$myconnection->close();

	goback("new user created","/");
?>
</body></html>
