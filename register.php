<html><body>
<?php
	if($_POST['password1']!=$_POST['password2'])
	{
		echo "passwords dont match";
		return "passwords dont match";
	}

	$myconnection=mysqli_connect("localhost","webdev","phprocks","webdev");

	$username=$_POST['username'];
	$password=hash('sha256',$_POST['password1']);

	$sqlcode="insert into users values('$username','$password')";

	mysqli_query($myconnection,$sqlcode);
	echo "new user created";
	$myconnection->close();

	exit();
?>
</body></html>
