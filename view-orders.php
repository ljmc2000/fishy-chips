<html><body>
<link rel="stylesheet" href="style.css" />
<?php
	include 'functions.php';
	checkadmin();
	show_header();

	$myconnection=database_connect();
	$sqlcode="select username,items_ordered,placed,line1,line2,town,eircode from valid_orders where fulfilled=0;";
	$result=mysqli_query($myconnection,$sqlcode);

	echo "<table align=\"center\">";
	while($row=$result->fetch_assoc())
	{
		echo "<tr id=\"box\">";
			echo "<td id=\"box\">",htmlspecialchars($row["username"]),"<br>";
			echo $row["placed"],"</td>";

			$orderd_items=explode(':',$row["items_ordered"]);
			$order_string="";

			echo "<td id=\"box\">";
			for($i=0; $i<count($orderd_items)-1; $i++)
			{
				$order_line=explode('x',$orderd_items[$i]);
				$menunumber=$order_line[0];
				$sqlcode="select name from food where menunumber=$menunumber;";
				$result2=mysqli_query($myconnection,$sqlcode);
				$row2=$result2->fetch_assoc();
				echo $row2["name"]," x ",$order_line[1],"<br>";
			}

		echo "</td>";

		$address=htmlspecialchars($row["line1"]) . "<br>" . htmlspecialchars($row["line2"]) . "<br>" . htmlspecialchars($row["town"]) . "<br>" . htmlspecialchars($row["eircode"]);
		echo "<td id=\"box\">",$address,"</td>";

		$orderno=$row["orderno"];
		echo "<td id=\"box\"><a href=\"mark-fulfilled.php?ordernumber=$orderno\">Mark fulfilled</a></td>";

		echo "</tr>";
	}

	$myconnection->close();
?>

</body></html>
