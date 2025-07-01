<?php $this->pageTitle='Добавление автора' ?><?

$this->menu=array(
	array('label'=>'Список авторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Авторы</h3>

<h1>Добавление автора</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>