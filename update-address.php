<?php
	include "functions.php";
	$myconnection=database_connect();
	if(!isset($_COOKIE["login_cookie"]))
		goback("Please login","/");

	$username=$_COOKIE['login_cookie'];
	$line1=$_POST["line1"];
	$line2=$_POST["line2"];
	$town=$_POST["town"];
	$eircode=$_POST["eircode"];

	//delete old address
	$sqlcode=$myconnection->prepare("delete from address where username=?");
	$sqlcode->bind_param('s', $username);
	$sqlcode->execute();

	//insert new address
	$sqlcode=$myconnection->prepare("insert into address values(?,?,?,?,?)");
	$sqlcode->bind_param('sssss',$username,$line1,$line2,$town,$eircode);
	$sqlcode->execute();

	$myconnection->close();
	goback("success",$_SERVER['HTTP_REFERER']);
?>
