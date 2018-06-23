<?php
	include "functions.php";
	$myconnection=database_connect();
	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$username=$myconnection->real_escape_string($_COOKIE['login_cookie']);
	$cardnum=$myconnection->real_escape_string($_POST['cardnum']);
	$expiremonth=$myconnection->real_escape_string($_POST['expiremonth']);
	$expireyear=$myconnection->real_escape_string($_POST['expireyear']);
	$ccv=$myconnection->real_escape_string($_POST['ccv']);

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

	$sqlcode="delete from payinfo where username='$username';";
	mysqli_query($myconnection,$sqlcode);
	$sqlcode="insert into payinfo values('$username','$cardnum','$expiremonth',$expireyear,$ccv);";
	mysqli_query($myconnection,$sqlcode);
	$myconnection->close();
	goback("success",$_SERVER['HTTP_REFERER']);
?>
