<?php defined('A') or die('Access denied');?>
<div id="popuper">
<div id="popuperContent" class="rounded"><a href="" class="close" target="_self"></a>
<div class="centerContent"><h1>Хотите получить доступ к Секретным материалам?</h1>
<form action="http://smartresponder.ru/subscribe.html" id="SR_form" method="post" name="SR_form" onsubmit="return SR_submit(this)" target="_blank">
  <input type="hidden" name="version" value="1">
  <input type="hidden" name="tid" value="548628">
  <input type="hidden" name="uid" value="141306">
  <input type="hidden" name="lang" value="ru">
  <input type="hidden" name="did[]" value="365124">
  <label><input class="placeholder" id="user_name_first" maxlength="40" name="field_name_first" placeholder="Введите Ваше имя" size="20" title="Например: Алексей" type="text" value="Введите Ваше имя">
  <img class="inputIcon" src="<?=I.S;?>popuper/name.png"></label>
  <label><input class="placeholder" id="user_email" maxlength="40" name="field_email" placeholder="Введите Ваш e-mail" size="20" title="Например: aleksey@mail.ru" type="text" value="Введите Ваш e-mail">
  <img class="inputIcon" src="<?=I.S;?>popuper/mail.png"></label>
  <button class="button rounded" id="SR_submitButton" name="SR_submitButton" type="submit">Получить доступ</button>
</form>
</div>
</div>
</div>
<div id="popuperOverlayer"></div>