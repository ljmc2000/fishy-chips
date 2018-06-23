<?php
	include "functions.php";
	$itemnum="food" . htmlspecialchars($_GET["menunumber"]);
	$oppr=htmlspecialchars($_GET["oppr"]);
	session_start();

	if($oppr=='a')
	{
		if($_SESSION[$itemnum] == '')
			$_SESSION[$itemnum]=1;
		else
			$_SESSION[$itemnum]=$_SESSION[$itemnum]+1;
	}

	else if($oppr=='cancel')
		$_SESSION[$itemnum]='';

	else if($oppr=='-')
		if($_SESSION[$itemnum]>1)
			$_SESSION[$itemnum]--;
		else
			$_SESSION[$itemnum]='';

	$returnto=$_SERVER['HTTP_REFERER'];
	echo "<script>window.location.replace(\"$returnto\")</script>";
?>
