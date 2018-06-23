<?php
	include 'functions.php';
	$myconnection=database_connect();
	$username=$myconnection->real_escape_string($_COOKIE["login_cookie"]);
	$orderno=$myconnection->real_escape_string($_GET["ordernumber"]);
	$sqlcode="delete from orders where (orderno=$orderno and username='$username' and fulfilled=0)";
	echo $sqlcode;
	$myconnection->query($sqlcode);
	goback("order has been canceled",$_SERVER['HTTP_REFERER']);
?>
