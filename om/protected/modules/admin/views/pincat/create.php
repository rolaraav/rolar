<?php $this->pageTitle='Добавление категории пин-кодов' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории пин-кодов</h3>

<h1>Добавление новой категории пин-кодов</h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>