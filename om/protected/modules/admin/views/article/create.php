<?php $this->pageTitle='Добавление статьи в Базу Знаний' ?><?

$this->menu=array(
	array('label'=>'Список статей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>База знаний</h3>

<h1>Добавление статьи в Базу Знаний</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>