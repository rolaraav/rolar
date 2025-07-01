<?php $this->pageTitle='Добавление товара в группу' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Группы товаров</h3>

<h1>Добавление товара в группу</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>