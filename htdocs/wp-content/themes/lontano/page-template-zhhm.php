<?php
/*
Template Name: zhhm 页面模板
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=0" />
    <title>纵横华媒纵横码</title>
    <link href="<?php echo get_template_directory_uri(); ?>/style_zhhm.css" rel="stylesheet" type="text/css"/>
    <script>
        window.onload = function(){
            var oMsg = document.getElementById("msg");
            var oBtn = document.getElementById("btn");
            var oMsg_c = document.getElementById("msg_c");
            var oUl = document.createElement("ul");
            var oName=document.getElementById("name")
            oMsg_c.appendChild(oUl);
            oBtn.onclick = function(){
                var sVal = oMsg.value;
                var nVal = oName.value;
                var oli = document.createElement("li");
                oli.innerHTML = "<p class='user_name'>"+nVal+":</p><p class='content'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+sVal+"</p><p class='reply'>回复</p>";
                var oli1 = oUl.getElementsByTagName("li")
                if(oli1.length>0){
                    oUl.insertBefore(oli,oli1[0])
                }else{
                    oUl.appendChild(oli);
                }
                oMsg.value='';

                var oSpan = document.getElementsByTagName("span");
                for(var i=0; i<oSpan.length; i++){
                    oSpan[i].onclick = function(){
                        oUl.removeChild(this.parentNode);
                    }
                }

            }
        }
    </script>
</head>
<body>
    <div class="header">
        纵横华媒国际
    </div>
    <div class="main">
        <video class="promotional_video" src="<?php echo get_template_directory_uri(); ?>/video/video.mp4" controls></video>
        <div class="nav">
            <div class="left">公司简介</div>
            <div class="right">公司资讯</div>
        </div>
        <div class="hot">精品推荐</div>
        <div class="wrb">
            <ul>
                <li>
                    <a href="http://m.le.com/movie/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">电影</p>
                    </a>
                </li>
                <li>
                    <a href="http://m.le.com/tv/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">电视剧</p>
                    </a>
                </li>
                <li>
                    <a href="http://m.le.com/zongyi/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">综艺</p>
                    </a>
                </li>
                <li>
                    <a href="http://m.le.com/ent/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">娱乐</p>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="http://m.le.com/news/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">资讯</p>
                    </a>
                </li>
                <li>
                    <a href="http://m.le.com/travel/">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">旅游</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">国际频道</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/film.png"></div>
                        <p class="text">选秀</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="hot">联系方式</div>
        <div class="contact">
            <div class="map">
                <img src="<?php echo get_template_directory_uri(); ?>/images/map.jpg">
            </div>
            <p>地址：北京市西城区广安门内大街311号祥龙商务大厦2#601</p>
            <p>电话：010-53325208</p>
        </div>
        <div class="hot">留言</div>
        <div class="message">
            <div id="msg_c"></div>
            <span class="ac">请输入留言：</span>
            <textarea id="msg"></textarea><br>
            <span>用户名称：</span><input id="name" type="text" size="40" value="">
            <input id="btn" type="button" value="留言">
        </div>
    </div>
</body>
</html>