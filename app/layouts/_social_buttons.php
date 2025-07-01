<?php defined('A') or die('Access denied'); ?>
<div class="big bold center">Понравился материал?<br>Поделись со своими друзьями в социальных сетях!</div>
<div class="social_buttons center">
<!-- Блок социальных кнопок Поделиться от Яндекса (начало) -->
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script>
<div class="ya-share2" data-copy="first" data-limit="12" data-services="vkontakte,facebook,twitter,odnoklassniki,moimir,telegram,whatsapp,viber,skype,evernote,collections,blogger,lj,linkedin,pinterest,delicious,digg,reddit,pocket,qzone,renren,sinaWeibo,surfingbird,tencentWeibo,tumblr" data-image="<?=D.S;?>images/templates/light/logotip.png"></div>
<!-- Блок социальных кнопок Поделиться от Яндекса (конец) -->
</div>
<br>
<div class="social_buttons center">Расскажите о нас своим друзьям</div>
<div class="social_buttons" style="width: 85px;">
    <!-- Кнопка "Мне нравится" Вконтакте (начало) -->
    <!-- Put this div tag to the place, where the Like block will be -->
    <div id="vk_like"></div>
    <script type="text/javascript">
        VK.Widgets.Like("vk_like", {type: "mini", height: 18});
    </script>
    <!-- Кнопка "Мне нравится" Вконтакте (конец) -->
</div>

<div class="social_buttons" style="width: 105px;">
    <!-- Кнопка "Мне нравится" Facebook (начало) -->
    <div class="fb-like" data-href="http://rolar.ru" data-width="450" data-layout="button_count" data-share="true" data-show-faces="true" data-send="false"></div>
    <!-- Кнопка "Мне нравится" Facebook (конец) -->
</div>

<div class="social_buttons" style="width: 120px;">
    <!-- Кнопка Нравится от Майл.ру (начало) -->
    <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share" data-mrc-config="{'cm' : '1', 'sz' : '20', 'st' : '2', 'tp' : 'mm'}">Нравится</a>
    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
    <!-- Кнопка Нравится от Майл.ру (конец) -->
</div>

<div class="social_buttons">
    <!-- Кнопка Класс от Одноклассники.ру (начало) -->
    <div id="ok_shareWidget"></div>
    <script>
        !function (d, id, did, st) {
            var js = d.createElement("script");
            js.src = "http://connect.ok.ru/connect.js";
            js.onload = js.onreadystatechange = function () {
                if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                    if (!this.executed) {
                        this.executed = true;
                        setTimeout(function () {
                            OK.CONNECT.insertShareWidget(id,did,st);
                        }, 0);
                    }
                }};
            d.documentElement.appendChild(js);
        }(document,"ok_shareWidget","http://rolar.ru","{width:145,height:30,st:'rounded',sz:20,ck:1}");
    </script>
    <!-- Кнопка Класс от Одноклассники.ру (конец) -->
</div>
<hr>