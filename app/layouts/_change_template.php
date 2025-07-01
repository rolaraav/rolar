<?php defined('A') or die('Access denied'); ?>
<form action="" method="post" name="change_template" target="_self">
<fieldset class="change_template" id="change_template_fieldset">
<p class="change_template">Какой вид сайта Вы предпочитаете?</p>
<label><input <?php if ($template == 'light') {echo CHECK;} ?> class="change_template_input" name="template" type="radio" value="light"> Светлый</label><br>
<label><input <?php if ($template == 'dark') {echo CHECK;} ?> class="change_template_input" name="template" type="radio" value="dark"> Тёмный</label><br>
<input class="button" id="change_template_submit" name="change_template_submit" type="submit" value="Выбрать">
</fieldset></form>