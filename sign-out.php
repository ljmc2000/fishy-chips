<?php
	setcookie("login_cookie", "", time() - 3600);
	echo "<script>window.location.replace(\"/\")</script>";
?>
