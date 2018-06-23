<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["picture"]["name"]);

	//attibutes of new menu item
	$name=$_POST["name"];
	$description=$_POST["description"];
	$price=$_POST["price"];
	$picture=basename($_FILES["picture"]["name"]);

	//add new food item to database
	$sqlcode=$myconnection->prepare("insert into food (name, description, price, picture) values (?,?,?,?)");
	$sqlcode->bind_param('ssds', $name,$description,$price,$picture);
	$sqlcode->execute();
	move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file);

	$myconnection->close();

	goback("new item added sucessfully","admin.php");
?>
