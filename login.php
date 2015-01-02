<?php
session_start();
if($_SESSION['logged']){
	echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>

<html>
<head>
<link href="ext/css/login.css" type="text/css" rel="stylesheet">
<script src="ext/js/md5.js"></script>
</head>
<body>
    <div id="box">
    <div id="logo"></div>
    <form method="post" action="check.php" onsubmit="enc(this)">
        <input type="text" autofocus placeholder="student no" name="studentno" id="input">
        <input type="password" placeholder="password" name="password" id="input">
        <input type="hidden" name="hash" value="" />
        <input type="submit" value="Log In" id="button">
    </form>
    </div>
</body>