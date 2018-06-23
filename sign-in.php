<?php
	function goback($message)
	{
		echo "<script>
			alert(\"$message\");
			window.history.go(-1);
		</script>";
		return;
	}

	$myconnection=mysqli_connect("localhost","webdev","phprocks","webdev");

	$username=$_POST['username'];
	$password1=hash('sha256',$_POST['password1']);

	$sqlcode="select password from users where(username='$username')";

	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$password2=$row["password"];

	$myconnection->close();

	if($password1 == $password2)
	{
		$cookie_name = "login_cookie";
		$cookie_value = $username;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

		goback("login sucess");
	}
	else if($password2=="")
	{
		goback("user not found: please register");
	}

	else
	{
		goback("incorrect password");
	}
?>
