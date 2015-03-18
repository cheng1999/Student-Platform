
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<title>
	<?php echo $Title?>
	</title>
	<link rel="stylesheet" href="<?php echo $Template ?>ext/css/css.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	
	<!--
	<link rel="stylesheet" href="<?php echo $Template ?>dist/css/bootstrap.min.css">
	<script src="<?php echo $Template ?>dist/js/bootstrap.min.js"></script>
	-->
	<script class="initial">
	    var username = "<?php echo mysql_fetch_row(mysql_query("SELECT username FROM profile WHERE studentno=" . $_SESSION['studentno']))[0]; ?>";
        var studentno = <?php echo $_SESSION['studentno'] ?>;
        var notifications = [];
        <?php loadnotify($_SESSION['studentno']) ?>
	</script>
	
	
	
