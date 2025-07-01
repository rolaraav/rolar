<?php $this->pageTitle='Изменение скидки' ?><?php

$this->menu=array(
	array('label'=>'Список скидок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить скидку', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр скидки', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),							
	
);
?>

<div class="wrap">

<h3>Специальные скидки</h3>

<h1>Изменение специальной скидки №<?=$model->id;?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>