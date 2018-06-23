<html><body>
<link rel="stylesheet" href="style.css" />

<?php
	include 'functions.php';
	show_header();

	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$myconnection=database_connect();
	$username=$_COOKIE['login_cookie'];

	echo "<main>";

	//past orders
	$sqlcode=$myconnection->prepare("select * from orders where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();

	echo "<table align=\"left\"><tr>";
	echo "<th>Past orders</th></tr>";

	while($row=$result->fetch_assoc())
	{
		echo "<tr id=\"box\">";
			echo "<td id=\"box\">", $row["placed"],"</td>";

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

		$price=sprintf("€%.2f",$row["total"]);
		echo "<td id=\"box\">$price</td>";

		if($row["fulfilled"] == 0)
		{
			$orderno=$row["orderno"];
			echo "<td><a href=\"cancel-order.php?ordernumber=$orderno\"><button>cancel</button></a></td></tr>";
		}
	}

	echo "</table>";

	//change password form
	echo "<form method=\"post\" action=\"change-password.php\" align=\"right\">";
		echo "<h2>Change password</h2>";
		echo "Old password <input type=\"password\" name=\"oldpwd\" required/><br>";
		echo "new password <input type=\"password\" name=\"newpwd1\" required><br>";
		echo "repeat password <input type=\"password\" name=\"newpwd2\" required><br>";
		echo "<input type=\"submit\" value=\"change password\" name=\"submit\">";
	echo "</form>";

	//get default values for payment info form
	$sqlcode=$myconnection->prepare("select * from payinfo where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
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
		echo "<a href=\"acntdelete.php?field=payinfo\"><button type=\"button\">delete</button></a>";

	echo "</form>";


	//get default values for delivery address
	$sqlcode=$myconnection->prepare("select * from address where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
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

		echo "<a href=\"acntdelete.php?field=address\"><button type=\"button\">delete</button></a>";

	echo "</form>";
	echo "</main>";
?>
</body></html>
