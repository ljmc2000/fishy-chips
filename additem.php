<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["picture"]["name"]);

	//attibutes of new menu item
	$name=$myconnection->real_escape_string($_POST["name"]);
	$description=$myconnection->real_escape_string($_POST["description"]);
	$price=$myconnection->real_escape_string($_POST["price"]);
	$picture=$myconnection->real_escape_string(basename($_FILES["picture"]["name"]));

	//add new food item to database
	$sqlcode="insert into food (name, description, price, picture) values ('$name', '$description', $price, '$picture');";
	mysqli_query($myconnection,$sqlcode);
	move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file);

	$myconnection->close();

	goback("new item added sucessfully","admin.php");
?>
