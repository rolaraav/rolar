<?php $this->pageTitle='Изменение странички' ?><?php

$this->menu=array(
	array('label'=>'Список страниц', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая страница', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр страницы', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Странички</h3>

<h1>Изменение страницы <?php echo $model->psevdo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>