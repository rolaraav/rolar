<?php $this->pageTitle='Выслать товар' ?><?

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Товары</h3>

<h1>Выслать товар &quot;<?=$model->title?>&quot;</h1>

<form method="post">

<fieldset style="padding:7px">

<legend>Отправка товара <?=$model->id?> пользователю</legend>

<ol>

<li>
<label for="uname">Имя пользователя:</label>
<input name="uname" type="text" class="text" value="Пользователь">
</li>

<li>
<label for="email">E-mail пользователя:</label>
<input name="email" type="text" class="text" value="@">
</li>

</ol>

</fieldset>

<fieldset class="submit">
<input class="submit" type="submit" value="Выслать товар" />
</fieldset>

</form> 


</div>