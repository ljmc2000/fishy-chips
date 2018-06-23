<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$_GET["menunumber"];
	$sqlcode=$myconnection->prepare("select picture from food where menunumber=?");
	$sqlcode->bind_param('i', $menunumber);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
	$row=$result->fetch_assoc();
	$oldfile=$row["picture"];

	$target_dir = "images/";
	$target_file = $target_dir . $oldfile;

	move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file);
	goback("success","moditem.php?menunumber=$menunumber");
?>
