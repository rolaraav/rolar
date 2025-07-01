<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">

<link href="<?= Y::baseUrl() ?>css/styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?= Y::baseUrl() ?>favicon.ico">
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="<?= Y::baseUrl() ?>css/ie.css">
<link rel="stylesheet" type="text/css" media="all" href="<?= Y::baseUrl() ?>css/ieuser.css">
<![endif]-->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<title><?= CHtml::encode($this->pageTitle); ?></title>

<!-- Новый тег Google Analytics-4 -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7W7HX2KSL"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-T7W7HX2KSL');
</script>
</head>

<body>
<!-- Yandex.Metrika counter -->
<!-- Новый тег Yandex.Metrika -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(16253794, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/16253794" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div align="center" style="padding-top:15px;">

<table id="mainOblast" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    <div id="mainContent">
    
<?php if (!Y::user()->isGuest): ?>
    
<div id="mainMenu">
<ul id="navlist">
<li><a href="<?= Y::bu() ?>aff/">Главная</a></li>
<li><a href="<?= Y::bu() ?>aff/stat">Статистика</a></li>
<li><a href="<?= Y::bu() ?>aff/sells">Заказы</a></li>
<li><a href="<?= Y::bu() ?>aff/links">Реф-ссылки</a></li>
<li><a href="<?= Y::bu() ?>aff/short">Короткие ссылки</a></li>
<li><a href="<?= Y::bu() ?>aff/profile">Профиль</a></li>
<li><a href="<?=Settings::item('siteUrl'); ?>" target="_blank">Сайт автора</a></li>
<li><a href="<?= Y::bu() ?>aff/default/logout">Выход</a></li>

</ul>

</div>    

<?php endif; ?>
    
    		<?= $content ?>

				<?php $flashmsg = Y::user()->getFlash ('aff') ?>
				<?php if (!empty($flashmsg)): ?>

					<div class="wrap">
						<h3>Результат последнего действия</h3>
						<p align="center" id="resultMessage"><?= $flashmsg ?></p>
					</div>

				<?php endif; ?>


            </div>            
           
        </td>

    </tr>
</table>
</div>

<div id="copyright">
Программное обеспечение: Система &quot;<a href="https://ordermaster.ru" target="_blank">Order Master 2</a>&quot; &copy; <?= date('Y'); ?>
</div>
<br />

</body>
</html>