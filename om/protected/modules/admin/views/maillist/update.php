<?php $this->pageTitle='Изменение рассылки' ?><?php

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая рассылка', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);
?>

<div class="wrap">

<h3>Серии писем (рассылки)</h3>

<h1>Изменение рассылки #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
