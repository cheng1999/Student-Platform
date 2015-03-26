<html>
<head>
<?php include(__DIR__."/head.php") ?>

<script src="<?php echo $Template ?>ext/js/md5.js"></script>

<script class="initial">
    
    $(document).ready(){
      $("form").attr("action",adminpath);
    }
</script>
</head>

<body>
    <form method="post" action="" onsubmit="loginhash(this)">
        <input type="password" placeholder="password" id="password" class="input">
        <input type="hidden" name="hash" value="" />
        <input type="submit" value="Log In" id="button">
    </form>
</body>
</html>