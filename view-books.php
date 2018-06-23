<html><body>
<link rel="stylesheet" href="style.css" />

<?php
	include 'functions.php';
	checkadmin();
	show_header();

	$myconnection=database_connect();

	//todays profits
	$sqlcode="select * from valid_orders where fulfilled=1 and placed > now()-INTERVAL 1 DAY order by (orderno)";
	$result=mysqli_query($myconnection,$sqlcode);
	$total=0;
	echo "<big><center>today</center></big>";
	echo "<table align=\"center\" id=\"box\"><td></td><td id=\"box\">ordered by</td><td id=\"box\">time and date placed</td><td id=\"box\">Spent</td>";
	while($row=$result->fetch_assoc())
	{
		echo "<tr>";
			echo "<td id=\"box\">" . $row["orderno"] . "</td>";	//order number
			echo "<td id=\"box\" align=\"right\">" . htmlspecialchars($row["username"]) . "</td>";	//username
			echo "<td id=\"box\" align=\"right\">" . $row["placed"] . "</td>";	//date placed
			$total=$total+$row["total"];
			$spent=sprintf("€%.2f",$row["total"]);
			echo "<td id=\"box\" align=\"right\">" . $spent . "</td>";	//amount spent
		echo "</tr>";
	}

	$total=sprintf("€%.2f",$total);
	echo "<td></td><td id=\"box\" align=\"right\"><b>total</b></td><td></td><td id=\"box\" align=\"right\"><b>$total</b></td>";
	echo "<table><br>";

	//this months profits
	$sqlcode="select * from valid_orders where fulfilled=1 and placed > now()-INTERVAL 30 DAY order by (orderno)";
	$result=mysqli_query($myconnection,$sqlcode);
	$total=0;
	echo "<big><center>this month</center></big>";
	echo "<table align=\"center\" id=\"box\"><td></td><td id=\"box\">ordered by</td><td id=\"box\">time and date placed</td><td id=\"box\">Spent</td>";
	while($row=$result->fetch_assoc())
	{
		echo "<tr>";
			echo "<td id=\"box\">" . $row["orderno"] . "</td>";	//order number
			echo "<td id=\"box\" align=\"right\">" . htmlspecialchars($row["username"]) . "</td>";	//username
			echo "<td id=\"box\" align=\"right\">" . $row["placed"] . "</td>";	//date placed
			$total=$total+$row["total"];
			$spent=sprintf("€%.2f",$row["total"]);
			echo "<td id=\"box\" align=\"right\">" . $spent . "</td>";	//amount spent
		echo "</tr>";
	}

	$total=sprintf("€%.2f",$total);
	echo "<td></td><td id=\"box\" align=\"right\"><b>total</b></td><td></td><td id=\"box\" align=\"right\"><b>$total</b></td>";
	echo "<table><br>";

	//profits for all time
	$sqlcode="select * from valid_orders where (fulfilled=1) order by (orderno)";
	$result=mysqli_query($myconnection,$sqlcode);
	$total=0;
	echo "<big><center>all time</center></big>";
	echo "<table align=\"center\" id=\"box\"><td></td><td id=\"box\">ordered by</td><td id=\"box\">time and date placed</td><td id=\"box\">Spent</td>";
	while($row=$result->fetch_assoc())
	{
		echo "<tr>";
			echo "<td id=\"box\">" . $row["orderno"] . "</td>";	//order number
			echo "<td id=\"box\" align=\"right\">" . htmlspecialchars($row["username"]) . "</td>";	//username
			echo "<td id=\"box\" align=\"right\">" . $row["placed"] . "</td>";	//date placed
			$total=$total+$row["total"];
			$spent=sprintf("€%.2f",$row["total"]);
			echo "<td id=\"box\" align=\"right\">" . $spent . "</td>";	//amount spent
		echo "</tr>";
	}

	$total=sprintf("€%.2f",$total);
	echo "<td></td><td id=\"box\" align=\"right\"><b>total</b></td><td></td><td id=\"box\" align=\"right\"><b>$total</b></td>";
	echo "<table><br>";
?>
</body></html>
