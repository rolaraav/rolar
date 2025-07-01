<?php $this->pageTitle='Добавление оператора' ?><?

$this->menu=array(
	array('label'=>'Список операторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Операторы</h3>

<h1>Добавление оператора</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>