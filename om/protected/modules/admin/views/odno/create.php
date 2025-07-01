<?php $this->pageTitle='Новый одностраничник' ?><?

$this->menu=array(
	array('label'=>'Список страничек', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Одностраничники</h3>

<h1>Создание нового одностраничника</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>