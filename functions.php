<?php
	function goback($message,$goto)		//dont stay on the php page once code execution is complete
	{
		echo "<script>
			alert(\"$message\");
			window.location.replace(\"$goto\");
		</script>";
		return;
	}

	function checkadmin()			//ensure customers stay off admin only pages
	{
		if($_COOKIE['login_cookie']!='admin')
			goback("access to this page is forbidden to all but the admin","index.php");
	}

	function database_connect()		//this code was used a lot so to make changeing database details easier...
	{
		$hostname="localhost";
		$username="webdev";
		$password="phprocks";
		$database="webdev";
		$myconnection=mysqli_connect($hostname,$username,$password,$database);
		return $myconnection;
	}

	function show_header()
	{
		//logo
		echo "<a href=\"/\"><img style=\"margin-left:10%\" align=\"left\" src=\"logo.svg\" height=\"100\"></a>";

		//a login or logout box depending
		if(!isset($_COOKIE["login_cookie"]))
		{
		echo	"<form style=\"margin-right:10%\" action=\"sign-in.php\" method=\"post\" align=\"right\">
			username <input type=\"text\" name=\"username\" required><br>
			password <input type=\"password\" name=\"password1\" required><br>
			<a href=\"create-account.php\"><button type=\"button\">register</button></a>
			<input type=\"submit\" value=\"sign in\">
			</form>";
		}

		else
		{
		echo	"<form style=\"margin-right:10%\" action=\"sign-out.php\" method=\"post\" align=\"right\">";

			if($_COOKIE["login_cookie"]=="admin")
			{
				echo 	"<a href=\"admin.php\">administration<br></a>"; 	//admin page
				echo	"<a href=\"view-orders.php\">view orders<br></a>";	//view outstanding orders
				echo	"<a href=\"view-books.php\">view books<br></a>";
			}
			else
			{
				echo	"<a href=\"checkout.php\"><img src=\"checkout.svg\" height=\"30\"><br></a>";	//checkout button
				echo	"<a href=\"manage-account.php\">manage account<br></a>";
			}

			echo	"<input type=\"submit\" value=\"sign out\">
					</form>";	//sign out button
		}


		$spaces=5;
		for($i=0; $i<$spaces; $i++)
			echo "<br>";
	}
?>
