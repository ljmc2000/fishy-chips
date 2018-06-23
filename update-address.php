<?php
	include "functions.php";
	$myconnection=database_connect();
	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$username=$myconnection->real_escape_string($_COOKIE['login_cookie']);
	$line1=$myconnection->real_escape_string($_POST["line1"]);
	$line2=$myconnection->real_escape_string($_POST["line2"]);
	$town=$myconnection->real_escape_string($_POST["town"]);
	$eircode=$myconnection->real_escape_string($_POST["eircode"]);

	$sqlcode="delete from address where username='$username'";
	mysqli_query($myconnection,$sqlcode);
	echo $sqlcode,"<br>";
	$sqlcode="insert into address values('$username','$line1','$line2','$town','$eircode')";
	mysqli_query($myconnection,$sqlcode);
	echo $sqlcode;

	goback("success",$_SERVER['HTTP_REFERER']);
	$myconnection->close()
?>
