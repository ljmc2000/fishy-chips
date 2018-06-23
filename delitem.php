<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$myconnection->real_escape_string($_GET["menunumber"]);

	//delete picture from storage
	$sqlcode="select picture from food where (menunumber=$menunumber);";
	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$filename=$row["picture"];
	unlink("images/$filename");

	$sqlcode="delete from food where (menunumber=$menunumber);";
	mysqli_query($myconnection,$sqlcode);

	$myconnection->close();
	goback("item deleted","admin.php");
?>
