<?php $this->pageTitle='Добавление ' ?><?

$this->menu=array(
	array('label'=>'Список Letter', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Letter</h3>

<h1>Добавление Letter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>