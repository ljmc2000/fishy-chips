<html><body>
<link rel="stylesheet" href="style.css">
<?php
	include 'functions.php';
	show_header();
?>

<middle>
<h1>Please register</h1>

<form action="register.php" method="post">
<h2>register</h2>
username <input type="text" name="username" maxlength="10" required><br>
password <input type="password" name="password1" required><br>
confirm password <input type="password" name="password2" required><br>
<input type="submit">
</form>
</middle>
</body></html>
