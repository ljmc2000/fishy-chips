<?php
	session_start();
	include 'functions.php';

	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$myconnection=database_connect();
	$username=$_COOKIE["login_cookie"];

	//get list of valid item ids
	$sqlcode="select menunumber,price from food;";
	$result=$myconnection->query($sqlcode);

	//create string of items ordered, simultianiously calculating the total to be paid
	$items_ordered="";
	$total=0;

	while($row=$result->fetch_assoc())
	{
		//add to string
		$food="food" . $row["menunumber"];
		if($_SESSION[$food]!='')
			$items_ordered=$items_ordered . $row["menunumber"]."x".$_SESSION[$food].":";

		//add to total
		$total=$total+($row["price"] * $_SESSION[$food]);
	}

	if($items_ordered=='')
	{
		goback("please order something","/");
		die();
	}

	$sqlcode=$myconnection->prepare("insert into orders (username,items_ordered,total,fulfilled) values (?,?,?,0);");
	$sqlcode->bind_param('ssd', $username,$items_ordered,$total);
	$sqlcode->execute();
	$myconnection->close();

	session_destroy();
	goback("order placed sucessfully: Please allow 10-20 minutes for delivery. Remember to provide credit card information and delivery address or your order will fail to show up on our system","/");
?>
