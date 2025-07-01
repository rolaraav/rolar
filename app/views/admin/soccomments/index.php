<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<!-- Подключение API-модулей Вконтакте (начало) -->
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
<script type="text/javascript" src="http://vk.com/js/api/share.js?86" charset="windows-1251"></script>
<script type="text/javascript">
    VK.init({apiId: 3417892, onlyWidgets: true});
</script>
<!-- Подключение API-модулей Вконтакте (конец) -->

<!-- Подключение API-модулей Facebook (начало) -->
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- Подключение API-модулей Facebook (конец) -->
<div class="center"><?php if (isset($social_comments)) {
    echo $social_comments;
  } ?></div>