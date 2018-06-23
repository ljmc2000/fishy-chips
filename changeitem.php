<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$menunumber=$_GET["menunumber"];
	$name=$_POST["name"];
	$description=$_POST["description"];
	$price=$_POST["price"];

	$sqlcode=$myconnection->prepare("update food set name=?, description=?, price=? where menunumber=?");
	$sqlcode->bind_param('ssdi', $name,$description,$price,$menunumber);
	$sqlcode->execute();

	goback("updated sucessfully","moditem.php?menunumber=$menunumber");
?>
