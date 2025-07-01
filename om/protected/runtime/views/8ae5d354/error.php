<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views\main\error.php */ ?>
<div class="wrap">

<h3>Ошибка <?php echo $code; ?></h3>

<h1>Ошибка <?php echo $code; ?></h1>

<div class="error">

<p align="center"><img style="margin:25px;" src="<?= Y::bu() ?>images/theme/error_button.png" /></p>

<p align="center"><span style="font-size:18px; font-weight:bold"><?php echo CHtml::encode($message); ?></span></p>

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

<p align="center"><INPUT TYPE="BUTTON" VALUE="Вернуться назад" 
ONCLICK="history.go(-1)"></p>

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

</div>