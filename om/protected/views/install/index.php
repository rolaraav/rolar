<?php $this->pageTitle='Установка Order Master 2'; ?>

<div class="wrap">

<h3>Установка Order Master 2</h3>

<h1>Установка Order Master 2 - Добро Пожаловать!</h1>

<p>&nbsp;</p>

<p>Сейчас будет импортирована стартовая База Данных</p>

<p>&nbsp;</p>

<p>Вам стоит указать некоторые данные перед установкой.</p><br>

<p>Укажите Ваше имя и e-mail (будет использоваться для восстановления пароля администратора, этот e-mail не виден пользователям)</p>

<p>&nbsp;</p>

<p>Также (в целях безопасности) - Вам нужно ввести <b>Секретный Ключ</b>, который Вы прописали ранее в <b>config/main.php</b>.</p><br>

<form method="post" enctype="multipart/form-data" action="?act=restore">

<fieldset style="padding:7px">

<legend>Данные администратора</legend>

<ol>

<li>
<label for="uname">Имя администратора:</label>
<input name="uname" type="text" class="text" value="admin">
</li>

<li>
<label for="email">E-mail администратора:</label>
<input name="email" type="text" class="text" value="admin@">
</li>

<li>
<label for="secret">Секретный ключ:</label>
<input name="secret" type="text" class="text" value="">
</li>

</ol>

</fieldset>

<fieldset class="submit">
<input class="submit" type="submit" value="Выполнить установку" />
</fieldset>

</form> 


</div>