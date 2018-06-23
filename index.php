<?php session_start(); ?>

<html><body>
<link rel="stylesheet" href="style.css" />

<?php
	include 'functions.php';
	show_header();

	echo "<main>";

	//get contents of food table from database
	$myconnection=database_connect();

	$sqlcode="select * from food;";
	$result=$myconnection->query($sqlcode);

	//print all foods in the food table to screen
	echo "<table align=\"center\"><tr>";

	$i=1;
	while($row=$result->fetch_assoc())
	{
		echo "<td width=\"200\"><img width=\"200\" src=\"images/",$row["picture"],"\"></td>";

		echo "<td width=\"200\">";
		echo "<a href=\"itempage.php?menunumber=",$row["menunumber"],"\"><svg height=\"50\"><text x=\"0\" y=\"24\" stroke-width=\"3\" font-weight=\"1000\" font-size=\"30\" stroke=\"black\" fill=\"cyan\">",$row["name"],"</text></svg></a>";

		//shorten description if it's too long
		if(strlen($row["description"])>100)
		{
			$short_description=substr($row["description"],0,100);
			echo $short_description,"...<br>";
		}
		else
			echo $row["description"],"<br>";

		$price=sprintf('%0.2f', $row["price"]);
		echo "price: €",$price,"<br>";
		echo "<br><a href=\"add2basket.php?menunumber=",$row["menunumber"],"&oppr=a\">add to basket</a>";

		//display contents of basket
		$item="food" . $row["menunumber"];
		if($_SESSION[$item] != '')
			echo " (",$_SESSION[$item],")";

		echo "</td>";

		if($i%2==0)
			echo "</tr>";
		$i++;
	}

	if($i%2!=0)
		echo "</tr>";

	echo "</table>";

	$myconnection->close();
?>
</body></html>
