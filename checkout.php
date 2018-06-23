<?php session_start(); ?>

<html><body>
<link rel="stylesheet" href="style.css" />

<?php
	include 'functions.php';
	show_header();
	echo "<main>";

	$myconnection=database_connect();
	$sqlcode="select * from food;";
	$result=$myconnection->query($sqlcode);

	echo "<table id=\"checkout_table\" align=\"left\">";
	echo "<head><td><b>Item name</b></td><td></td><td align=\"right\"><b>amount</b></td><td></td><td></td><td align=\"right\"><b>cost</b></head>";
	$total=0;	//hold the total cost of items
	while($row=$result->fetch_assoc())
	{
		$itemnum="food" . $row["menunumber"];
		if($_SESSION[$itemnum]!='')
		{
			echo "<tr>";
				echo "<td>";
					echo $row["name"];
				echo "</td><td>";
					echo "<a href=\"add2basket.php?menunumber=",$row["menunumber"],"&oppr=-\"><img src=\"minus.svg\"></a>";
				echo "</td><td align=\"right\" id=\"box\">";
					echo $_SESSION[$itemnum];
				 echo "</td><td>";
					echo "<a href=\"add2basket.php?menunumber=",$row["menunumber"],"&oppr=a\"><img src=\"plus.svg\"></a>";
				echo "</td><td>";
					echo "<a href=\"add2basket.php?menunumber=",$row["menunumber"],"&oppr=cancel\">cancel</a>";
				echo "</td><td align=\"right\">";
					$price=$row["price"];
					$price=$price * $_SESSION[$itemnum];
					$total=$total+$price;
					$price=sprintf("€%.2f",$price);
					echo $price;
				echo "</td>";
			echo "</tr>";
		}
	}
	$total=sprintf("€%.2f",$total);	//format total to look better
	echo	"<tr><td>
			<b>total</b>
		</td><td></td><td></td><td></td><td></td>
			<td align=\"right\"><b>$total</b></td>
		</tr>";

	echo	 "<tr><td></td><td></td><td></td><td></td><td></td><td>
			<a href=\"confirm.php\">confirm</a>
		</td></tr>";

	echo 	"</table>";

	$username=$myconnection->real_escape_string($_COOKIE['login_cookie']);

	//get default values for payment info form
	$sqlcode="select * from payinfo where username='$username'";
	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$cardnumber=$row["cardnumber"];
	$expiremonth=$row["expiremonth"];
	$expireyear=$row["expireyear"];
	$ccv=$row["ccv"];

	//payment info form
	echo "<form align=\"right\" method=\"post\" action=\"update-pay-info.php\">";

		echo "<h2>Payment info</h2>";

		echo "Card number: <input type=\"text\" name=\"cardnum\" size=\"16\" maxlength=\"16\" value=\"$cardnumber\"><br>";

		echo "Expiry month: (currently $expiremonth)<select name=\"expiremonth\">";
			echo "<option value=\"cur\">(current)</option>";
			echo "<option value=\"Jan\">January</option>";
			echo "<option value=\"Feb\">February</option>";
			echo "<option value=\"Mar\">March</option>";
			echo "<option value=\"Apr\">April</option>";
			echo "<option value=\"May\">May</option>";
			echo "<option value=\"Jun\">June</option>";
			echo "<option value=\"Jul\">July</option>";
			echo "<option value=\"Aug\">August</option>";
			echo "<option value=\"Sep\">September</option>";
			echo "<option value=\"Oct\">October</option>";
			echo "<option value=\"Nov\">November</option>";
			echo "<option value=\"Dec\">December</option>";
		echo "</select><br>";

		echo "Expiry year: (2015 would be 15) <input type=\"text\" name=\"expireyear\" value=\"$expireyear\" size=\"2\" maxlength=\"2\"><br>";

		echo "CCV: (the number on the back) <input type=\"text\" name=\"ccv\" value=\"$ccv\" size=\"3\" maxlength=\"3\"><br>";

		echo "<input type=\"submit\" value=\"save\">";

	echo "</form>";

	//get default values for delivery address
	$sqlcode="select * from address where username='$username'";
	$result=$myconnection->query($sqlcode);
	$row=$result->fetch_assoc();
	$line1=$row["line1"];
	$line2=$row["line2"];
	$town=$row["town"];
	$eircode=$row["eircode"];

	//delivery address
	echo "<form align=\"right\" method=\"post\" action=\"update-address.php\">";
		echo "<h2>Delivery address</h2>";

		echo "Line 1 <input type=\"text\" name=\"line1\" maxlength=\"100\" value=\"$line1\" required><br>";
		echo "Line 2 <input type=\"text\" name=\"line2\" maxlength=\"100\" value=\"$line2\"><br>";
		echo "Town <input type=\"text\" name=\"town\" maxlength=\"30\" value=\"$town\" required><br>";
		echo "Eircode <input type=\"text\" name=\"eircode\" maxlength=\"7\" value=\"$eircode\" required><br>";
		echo "<input type=\"submit\" value=\"save\">";
	echo "</form>";

	$myconnection->close();
?>
</main>
</body></html>
