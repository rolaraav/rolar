<?php $this->pageTitle='Изменение специальной партнёрской ссылки' ?><?php

$this->menu=array(
	array('label'=>'Список ссылок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить ссылку', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр ссылки', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Специальные партнёрские ссылки</h3>

<h1>Изменение специальной партнёрской ссылки <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>