<?php
if(@$_SESSION['studentno']){
	header('Location: ?p=home');
}
?>

<html>
<head>
<link href="<?php echo $Template ?>ext/css/login.css" type="text/css" rel="stylesheet">
<script src="<?php echo $Template ?>ext/js/md5.js"></script>
</head>
<body>
    <div id="box">
    <div id="logo"></div>
    <form method="post" action="?p=validlogin" onsubmit="enc(this)">
        <input type="text" autofocus placeholder="student no" name="studentno" class="input">
        <input type="password" placeholder="password" id="password" class="input">
        <input type="hidden" name="hash" value="" />
        <input type="submit" value="Log In" id="button">
    </form>
    </div>
</body>