<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>

<div>Выберите текстовый редактор, который будет использоваться по умолчанию:</div>
<form action="" target="_self" method="post">
    <label><input <?=$editor1; ?> type="radio" name="editor" value="tinymce">TinyMCE</label>
    <label><input <?=$editor2; ?> type="radio" name="editor" value="ckeditor">CK Editor</label>
    <label><input <?=$editor0; ?> type="radio" name="editor" value="none">Без редактора</label>
    <input class="button" name="change_editor" type="submit" value="Выбрать редактор">
</form>
<div class="cpinput">
  <label>Введите текст заметки:<br>
  <textarea id="text_field" name="text" cols="102" rows="25">Тут пишем текст.</textarea>
  </label>
</div>
<div class="center"><a class="button" href="<?=ADMIN;?>" target="_self" title="Вернуться на главную страницу">Вернуться на главную страницу</a></div>