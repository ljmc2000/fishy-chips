<html><body>
<link rel="stylesheet" href="style.css"/>
<?php
	include "functions.php";
	checkadmin();
	show_header();
?>
<main>
<h2>Change admin password</h2>
<form method="post" action="change-password.php">
Old password <input type="password" name="oldpwd" required/><br>
new password <input type="password" name="newpwd1" required><br>
repeat password <input type="password" name="newpwd2" required><br>
<input type="submit" value="change password" name="submit">
</form>

<h2>add a new menu item</h2>
<form method="post" action="additem.php" enctype="multipart/form-data">
Name <input type="textarea" name="name" maxlength="30" size="30" required><br>
Description <input type="text" name="description" maxlength="400" cols="25" required><br>
Price <input type="text" name="price" size="6" required><br>
Picture of food <input type="file" name="picture" id="picture"><br>
<input type="submit" value="add new item" name="submit">
</form>

<h2>modify or delete a menuitem</h2>
<?php
	$myconnection=database_connect();
	$sqlcode="select name,menunumber from food;";
	$result=$myconnection->query($sqlcode);

	while($row=$result->fetch_assoc())
	{
		$name=$row["name"];
		$menunumber=$row["menunumber"];
		echo "$name <a href=\"moditem.php?menunumber=$menunumber\">modify</a> <a href=\"delitem.php?menunumber=$menunumber\">delete</a><br>";
	}
?>
</main>
</body></html>
