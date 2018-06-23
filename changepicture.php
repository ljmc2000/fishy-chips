<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$myconnection->real_escape_string($_GET["menunumber"]);
	$sqlcode="select picture from food where menunumber=$menunumber;";
	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$oldfile=$row["picture"];

	$target_dir = "images/";
	$target_file = $target_dir . $oldfile;

	move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file);
	goback("success","moditem.php?menunumber=$menunumber");
?>
