<?php $this->pageTitle='Добавление персональной комиссии партнёру' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Особые комисии партнёра</h3>

<h1>Добавление особой комиссии партнёру</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>