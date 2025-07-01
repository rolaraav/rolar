<?php $this->pageTitle='Добавление категории статей Базы Знаний' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории статей Базы Знаний</h3>

<h1>Добавление новой категории для статей Базы Знаний</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>