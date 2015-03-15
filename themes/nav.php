<header>
<link rel="stylesheet" href="<?php echo $Template ?>ext/css/sidebar.css">
<script>
    function togglemenu(){
        if($("header").css("margin-left")=="0px"){
            $("header").css("margin-left","-300px");
        }else{
            $("header").css("margin-left","0px");
        }
    }
</script>
    <span class="menu-toggle" onclick="togglemenu()">
        <img src="http://programmer17.koding.io/Student-Platform/themes/ext/image/menu.png">
    </span>
	<div id="nav">
	    <div id="lgo">
		    <a href="?p=home">CHS</a>
		    <a id="lgoCmt">属于公教生的网站</a>
		</div>
		<ul id="navul">
			<li>
				<a href="?p=home">首页</a>
			</li>
			<li>
				<a href="?p=profile">个人主页</a>
			</li>
			<li>
				<a href="?p=storytelling">说故事</a>
			</li>
			<li>
				<a href="?p=ask">ask & answer</a>
			</li>
			<li>
				<a href="#">班级事件簿</a>
			</li>
			<li>
				<a href="?p=aboutus">关于我们</a>
			</li>
		</ul>
	</div>
</header>