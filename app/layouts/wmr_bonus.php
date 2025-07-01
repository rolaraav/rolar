<?php defined('A') or die('Access denied');?>
<!-- WMR-бонус (начало) -->
<p class="wmr-bonus"><img alt="Получи WMR-бонус!" height="86px" width="140px" src="<?=I.S;?>informers/wmr-bonus.gif" title="Получи WMR-бонус!"><br>Для получения WMR-бонуса введите Ваш WMR-кошелёк и код с картинки и нажмите на кнопку &quot;Получить бонус&quot;</p>
<form action="http://baksgrad.ru/bonus.php" method="post">
<fieldset id="wmr-bonus_fieldset">WMR-кошелёк:<br>
<input maxlength="13" name="wmr" size="13" placeholder="R121012546658" title="Введите номер Вашего WMR-кошелька" type="text" value="R"><br>
<img alt="Код" src="http://baksgrad.ru/capchabon.php" title="Код"><br>
Код: <input maxlength="4" name="capchabon" size="4" title="Введите код с картинки" type="text"><br>
<input class="button" type="submit" value="Получить бонус">
</fieldset>
</form>
<!-- WMR-бонус (конец) -->