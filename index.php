<html><body>
<img src="logo.svg" align="left" height="60">
<form action="sign-in.php" method="post" align="right">
username <input type="text" name="username" required>
password <input type="password" name="password1" required>
<br><a href="sign-in.html">register</a>
<input type="submit" value="sign in">
</form>

<img src="checkout.svg" height="30" align="right"><br>

<?php
	$myconnection=mysqli_connect("localhost","webdev","phprocks","webdev");

	$sqlcode="select * from food;";
	$result=$myconnection->query($sqlcode);

	echo "<table>";

	while($row=$result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td><img src=\"images/",$row["picture"],"\"></td>";

		echo "<td>";
		echo "<a href=\"itempage.php?menunumber=",$row["menunumber"],"\"><h3>",$row["name"],"</h3></a>";
		echo $row["description"],"<br>";

		$price=sprintf('%0.2f', $row["price"]);
		echo "price: €",$price;
		echo "</td>";

		echo "</tr>";
	}

	echo "</table>";

	$myconnection->close();
?>
</body></html>
