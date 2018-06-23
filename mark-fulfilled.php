<?php
	include 'functions.php';
	checkadmin();

	$myconnection=database_connect();
	$orderno=$_GET["ordernumber"];
	$sqlcode=$myconnection->prepare("update orders set fulfilled=1 where orderno=?");
	$sqlcode->bind_param('i', $orderno);
	$sqlcode->execute();
	goback("order fulfilled","view-orders.php");
?>
