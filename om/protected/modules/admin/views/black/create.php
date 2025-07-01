<?php $this->pageTitle='Добавление записи в чёрный список' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Чёрный список</h3>

<h1>Добавление записи в чёрный список</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>