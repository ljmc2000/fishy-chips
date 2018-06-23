<?php
	include 'functions.php';

	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$myconnection=database_connect();
	$username=$_COOKIE['login_cookie'];

	//check for outstanding orders
	$sqlcode=$myconnection->prepare("select count(orderno) from valid_orders where (fulfilled=0 and username=?)");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();
	$result=$sqlcode->get_result();
	$row=$result->fetch_assoc();

	if($row["count(orderno)"] > 0)
	{
		goback("You may not delete account details with outstanding orders",$_SERVER['HTTP_REFERER']);
		exit();
	}

	if($_GET[field]=='address')
	{
		$sqlcode=$myconnection->prepare("delete from address where username = ? ");
		$sqlcode->bind_param('s', $username);
		$sqlcode->execute();
		goback("address has been deleted",$_SERVER['HTTP_REFERER']);
	}

	if($_GET[field]=='payinfo')
	{
		$sqlcode=$myconnection->prepare("delete from payinfo where username = ? ");
		$sqlcode->bind_param('s', $username);
		$sqlcode->execute();
		goback("payment information has been deleted",$_SERVER['HTTP_REFERER']);
	}
?>
