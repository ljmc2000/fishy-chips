<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$myconnection->real_escape_string($_GET["menunumber"]);
	$name=$myconnection->real_escape_string($_POST["name"]);
	$description=$myconnection->real_escape_string($_POST["description"]);
	$price=$myconnection->real_escape_string($_POST["price"]);

	$sqlcode="update food set name='$name', description='$description', price=$price where menunumber=$menunumber;";
	mysqli_query($myconnection,$sqlcode);

	goback("updated sucessfully","moditem.php?menunumber=$menunumber");
?>
