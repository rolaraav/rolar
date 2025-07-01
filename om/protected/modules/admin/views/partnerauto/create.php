<?php $this->pageTitle='Добавление автоустановки комиссии' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Автоустановки комиссий</h3>

<h1>Добавление автоустановки особой комиссии</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>