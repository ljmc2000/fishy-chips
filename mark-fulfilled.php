<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$orderno=$myconnection->real_escape_string($_GET["ordernumber"]);
	$sqlcode="update orders set fulfilled=1 where orderno=$orderno;";
	mysqli_query($myconnection,$sqlcode);
	goback("order fulfilled","view-orders.php");
?>
