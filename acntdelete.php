<?php
	include 'functions.php';

	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$myconnection=database_connect();
	$username=$myconnection->real_escape_string($_COOKIE['login_cookie']);

	//check for outstanding orders
	$sqlcode="select orderno from valid_orders where (fulfilled=0 and username='$username')";
	$result=$myconnection->query($sqlcode);
	if($results->num_rows !== 0)
	{
		goback("You may not delete account details with outstanding orders",$_SERVER['HTTP_REFERER']);
		exit();
	}

	if($_GET[field]=='address')
	{
		$sqlcode="delete from address where username='$username'";
		$myconnection->query($sqlcode);
		goback("address has been deleted",$_SERVER['HTTP_REFERER']);
	}

	if($_GET[field]=='payinfo')
	{
		$sqlcode="delete from payinfo where username='$username'";
		$myconnection->query($sqlcode);
		goback("payment information has been deleted",$_SERVER['HTTP_REFERER']);
	}
?>
