<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$_GET["menunumber"];

	//delete picture from storage
	$sqlcode=$myconnection->prepare("select picture from food where (menunumber=?)");
	$sqlcode->bind_param('i', $menunumber);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
	$row=$result->fetch_assoc();
	$filename=$row["picture"];
	unlink("images/$filename");

	$sqlcode=$myconnection->prepare("delete from food where (menunumber=?)");
	$sqlcode->bind_param('i', $menunumber);
	$sqlcode->execute();

	$myconnection->close();
	goback("item deleted","admin.php");
?>
