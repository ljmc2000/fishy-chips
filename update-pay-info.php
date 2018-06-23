<?php
	include "functions.php";
	$myconnection=database_connect();
	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$username=$_COOKIE['login_cookie'];
	$cardnum=$_POST['cardnum'];
	$expiremonth=$_POST['expiremonth'];
	$expireyear=$_POST['expireyear'];
	$ccv=$_POST['ccv'];

	if(!is_numeric($cardnum) || strlen($cardnum)<16)
		goback("invalid card number","checkout.php");

	if($expiremonth=='cur')	//get old value for expire month
	{
		$sqlcode="select expiremonth from payinfo where username='$username';";
		$result=$myconnection->query($sqlcode);
		$row=$result->fetch_assoc();
		$expiremonth=$row["expiremonth"];
	}

	if(!is_numeric($ccv) || $ccv<0)
		goback("invalid ccv","checkout.php");

	//delete old payment information
	$sqlcode=$myconnection->prepare("delete from payinfo where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();

	//insert new payment information
	$sqlcode=$myconnection->prepare("insert into payinfo values(?,?,?,?,?)");
	$sqlcode->bind_param('sssii',$username,$cardnum,$expiremonth,$expireyear,$ccv);
	$sqlcode->execute();

	$myconnection->close();
	goback("success",$_SERVER['HTTP_REFERER']);
?>
