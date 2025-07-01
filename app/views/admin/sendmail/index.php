<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<form id="contact" enctype="multipart/form-data" action="" method="post">
  <div class="cpsendmail">Кому отправить:<br><label><input id="changeto" name="changeto" type="radio" value="0">&nbsp;на один электронный адрес</label>&nbsp;&nbsp;&nbsp;<label><input id="changeto" name="changeto" type="radio" value="1">&nbsp;на несколько электронных адресов (из списка)</label><br><label><input id="changeto" name="changeto" type="radio" value="2">&nbsp;подписчикам</label>&nbsp;&nbsp;&nbsp;<label><input id="changeto" name="changeto" type="radio" value="3">&nbsp;пользователям</label>&nbsp;&nbsp;&nbsp;<label><input id="changeto" name="changeto" type="radio" value="4">&nbsp;всем пользователям и подписчикам</label><br><label><input id="changeto" name="changeto" type="radio" value="5">&nbsp;заблокированным пользователям</label>&nbsp;&nbsp;&nbsp;<label><input id="changeto" name="changeto" type="radio" value="6">&nbsp;всей базе</label><br><label><input id="changeto" name="changeto" type="radio" value="7">&nbsp;выбрать из файла</label></div>
  <div class="probel">&nbsp;</div>
  <div class="cpsendmail"><label for="first_name">Имя получателя:<br><input id="first_name" name="first_name" type="text"><span></span></label></div>
  <div class="cpsendmail"><label for="email">Email получателя:<br><input id="email" name="email" type="text"><span></span></label></div>
  <div class="cpsendmail">Тип письма:<br><label><input id="letter_type" name="letter_type" type="radio" value="0">&nbsp;текст</label>&nbsp;&nbsp;&nbsp;<label><input id="letter_type" name="letter_type" type="radio" value="1">&nbsp;HTML</label></div>
  <div class="probel">&nbsp;</div>
  <div class="cpsendmail"><label for="email">Список email получателей (данные каждого получателя в одной строке):<br>
  Порядок параметров (разделённых запятыми):<br><strong>email,first_name,last_name,letter_type,login,site,reg_date,login_date,birthday,gender</strong><br>
  <textarea id="emaillist" name="emaillist" cols="100" rows="10">rolar@list.ru,Артур,Абзалов,1</textarea><span></span></label></div>
  <div class="cpsendmail"><label for="emailfile">Выбрать текстовый файл:<br><input accept="text/plain" id="emailfile" name="emailfile" title="Выберите текстовый файл на вашем компьютере" type="file"><span></span></label></div>
  <div class="probel">&nbsp;</div>
  <div class="cpsendmail"><label for="subject">Тема письма:<br><input id="subject" name="subject" type="text"><span></span></label></div>
  <div class="probel">&nbsp;</div>
  <div class="cpsendmail"><label for="textmessage">Текст сообщения:<br><textarea id="textmessage" name="textmessage" cols="100" rows="5"></textarea><span></span></label></div>
  <div class="cpsendmail"><label for="htmlmessage">Текст сообщения в формате HTML:<br><textarea id="htmlmessage" name="htmlmessage" cols="100" rows="5"></textarea><span></span></label></div>
  <!--<script type="text/javascript">CKEDITOR.replace('htmlmessage');</script>-->
  <div class="probel">&nbsp;</div>
  <div class="cpsendmail"><input class="button" id="sendmail" name="sendmail" type="submit" value="Отправить письмо"><span></span></div>
</form>
<br>
<div class="logmessage"><?php
  if (isset($_SESSION['blackemail'])){
    echo $_SESSION['blackemail']; unset($_SESSION['blackemail']);
  }
  if (isset($_SESSION['logmessage'])){
    echo $_SESSION['logmessage']; unset($_SESSION['logmessage']);
  }?></div>
<br>
<div class="center"><a class="button" href="<?=ADMIN;?>" target="_self" title="Вернуться на главную страницу">Вернуться на главную страницу</a></div>
