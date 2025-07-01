<?php $this->pageTitle='Изменение странички' ?><?php

$this->menu=array(
	array('label'=>'Список страниц', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая страница', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);
?>

<div class="wrap">

<h3>Одностраничники</h3>

<h1>Изменение одностраничника #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
