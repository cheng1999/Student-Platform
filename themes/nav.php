<header>
<link rel="stylesheet" href="<?php echo $Template ?>ext/css/sidebar.css">
    <span class="menu-toggle" onclick="togglemenu()">
        <img src="<?php echo $Template ?>ext/image/menu.png">
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
		<div class="navbottom">
		    <div class="navuser" onclick="window.location.href='?p=profile'">
                <img class="profilepic" src="">
                <span class="username"></span>
            </div>
            <a onclick="$('.operacontent').show();" onblur="$('.operacontent').hide();" class="navblock showopera" href="#">^</a>
            <a onclick="$('.notificationcontent').show();" onblur="$('.notificationcontent').hide()" class="navblock shownotif" href="#"><span class="notifications_count"></span></a>
        </div>
        
        <div class="notificationcontent">
        </div>
        <div class="operacontent">
            <span class="opera-selection" onmousedown="window.location.href='?p=login&logout=1'">logout</span>
        </div>
        
	</div>
</div>
<div class="notif_html" style="display:none">
    <div class="notif_block" onmousedown="">
        <a class="notif_message"></a>
        <a class="notif_time"></a>
    </div>
</div>
	<script>
        function togglemenu(){
            if($("header").css("margin-left")=="0px"){
                $("header").css("margin-left","-300px");
            }else{
                $("header").css("margin-left","0px");
            }
        }
        function gonotif(notif_id,notif_link,bind){
            $.ajax({
                url:"?p=notif&read="+notif_id   ,
                success: function(response){
                    if(response){
                        window.location.href=notif_link;
                    }
                }
            });
        }
        
        //insert profile information
        $(".navbottom .profilepic").attr("src","uploads/profile_pic_"+studentno);
        $(".navbottom .username").html(username);
        $(".navbottom .notifications_count").html(notifications.length);
        
        //notifications
        for(i=0;i<notifications.length;i++){
            $(".notificationcontent").append($(".notif_html").html());
        }
        for(i=notifications.length-1;i>=0;i--){
            $(".notificationcontent .notif_block")[i].setAttribute("onmousedown","gonotif("    +notifications[i].id+   ",'"     +notifications[i].link+     "',0)");
            $(".notificationcontent .notif_message").html(notifications[i].message);
            $(".notificationcontent .notif_time").html(notifications[i].time);
        }
    </script>
</header>