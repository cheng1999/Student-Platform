<html>
<head>
<?php include(__DIR__."/head.php") ?>

<script src="<?php echo $Template ?>ext/js/md5.js"></script>

</head>

<body>
    <form method="post" action="#" onsubmit="adminhash(this)">
        <input type="password" placeholder="password" id="password" class="input">
        <input type="hidden" name="hash" value="" />
        <input type="submit" value="Log In" id="button">
    </form>
</body>
</html>