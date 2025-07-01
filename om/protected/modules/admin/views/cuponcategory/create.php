<?php $this->pageTitle='Добавление категории купонов скидок' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории купонов скидок</h3>

<h1>Добавление категории купонов скидок</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>