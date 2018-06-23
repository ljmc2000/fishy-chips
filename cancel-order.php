<?php
	include 'functions.php';
	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$myconnection=database_connect();
	$username=$_COOKIE["login_cookie"];
	$orderno=$_GET["ordernumber"];
	$sqlcode=$myconnection->prepare("delete from orders where (orderno=? and username=? and fulfilled=0)");
	$sqlcode->bind_param('is', $orderno,$username);
	$sqlcode->execute();
	goback("order has been canceled",$_SERVER['HTTP_REFERER']);
?>
