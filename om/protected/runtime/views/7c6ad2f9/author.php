<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\author\views/layouts/author.php */ ?>
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

<title><?= CHtml::encode($this->pageTitle); ?> - Панель Автора</title>

</head>

<body>


<div align="center" style="padding-top:15px;">

<table id="mainOblast" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    <div id="mainContent">

    
    		<?= $content ?>

				<?php $flashmsg = Y::user()->getFlash ('author') ?>
				<?php if (!empty($flashmsg)): ?>

					<div class="wrap">
						<h3>Результат последнего действия</h3>
						<p align="center" id="resultMessage"><?= $flashmsg ?></p>
					</div>

				<?php endif; ?>

        <?php if (!Y::user()->isGuest): ?>

        <div class="wrap">

            <p align="center" style="font-size:14px;">
                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                 <a href="<?=Y::bu()?>author">Главная</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                <a href="<?=Y::bu()?>author/bills">Заказы</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                <a href="<?=Y::bu()?>author/stat">Статистика</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                <a href="<?=Y::bu()?>author/good">Товары</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                <a href="<?=Y::bu()?>author/default/logout">Выход</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
            </p>

        </div>

        <?php endif; ?>



            </div>            
           
        </td>

    </tr>
</table>
</div>

<div id="copyright">
Программное обеспечение: Система Order Master 2 &copy; <?= date('Y'); ?>
</div>
<br />

</body>
</html>