<?php $this->pageTitle='Добавление рекламного материала' ?><?php
$this->menu=array(
	array('label'=>'Список баннеров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Рекламные материалы</h3>

<h1>Добавление рекламного материала</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>