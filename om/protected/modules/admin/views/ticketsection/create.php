<?php $this->pageTitle='Добавление отдела поддержки' ?><?

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Отделы поддержки</h3>

<h1>Добавление отдела поддержки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>