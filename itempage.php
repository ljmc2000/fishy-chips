<html><body>
<link rel="stylesheet" href="style.css" />

<?php
	session_start();
	include 'functions.php';
	show_header();

	echo "<main>";

	//get contents of food table from database
	$myconnection=database_connect();
	$menunumber=$myconnection->real_escape_string($_GET["menunumber"]);
	$sqlcode="select * from food where menunumber=$menunumber;";
	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();

	echo "<img align=\"left\" margin=\"50\" width=\"500\" src=\"images/",$row["picture"],"\">";
	echo "<svg height=\"50\"><text x=\"0\" y=\"24\" stroke-width=\"3\" font-weight=\"1000\" font-size=\"30\" stroke=\"black\" fill=\"cyan\">",$row["name"],"</text></svg></a><br>";
	echo "<big>",$row["description"],"</big><br>";

	echo "<a href=\"add2basket.php?menunumber=$menunumber&oppr=a\">Add to basket</a>";
	$item="food" . $row["menunumber"];
	if($_SESSION[$item] != '')
		echo " (",$_SESSION[$item],")";

	echo "</main>";

	$myconnection->close();
?>
</body></html>
