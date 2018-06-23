<html><body>
<link rel="stylesheet" href="style.css" />
<?php
	include 'functions.php';
	checkadmin();
	show_header();

	echo "<main>";

	//connect to database
	$myconnection=database_connect();
	$menunumber=$_GET["menunumber"];
	$sqlcode=$myconnection->prepare("select name,description,price from food where menunumber=?");
	$sqlcode->bind_param('i',$menunumber);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
	$row=$result->fetch_assoc();

	//set the defaults of the form to the original
	$name=$row["name"];
	$description=$row["description"];
	$price=$row["price"];

	echo "<form method=\"post\" action=\"changeitem.php?menunumber=$menunumber\">
	<h2>Modify attributes</h2>
	name <input type=\"text\" name=\"name\" value=\"$name\" required><br>
	description <input type=\"text\" name=\"description\" value=\"$description\" required><br>
	price <input type=\"text\" name=\"price\" value=\"$price\" required><br>
	<input type=\"submit\" value=\"update\">
	</form>";

	echo "<form method=\"post\" action=\"changepicture.php?menunumber=$menunumber\" enctype=\"multipart/form-data\">
	<h2>Upload new picture</h2>
	select file: <input type=\"file\" name=\"picture\" id=\"picture\">
	<input type=\"submit\" value=\"update\">
	</form>";

	echo "<a href=\"admin.php\">return to previous page</a>";

	$myconnection->close();
?>
</main></body></html>
