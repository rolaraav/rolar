<?php $this->pageTitle='Изменение подписчика' ?><?php

$this->menu=array(
	array('label'=>'Список подписчиков', 'url'=>array('ruser/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
  array('label'=>'Список рассылок', 'url'=>array('maillist/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Изменение подписчика</h3>

<h1>Изменение подписчика #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
