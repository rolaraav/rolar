<?php $this->pageTitle='Добавление специальной партнёрской ссылки' ?><?

$this->menu=array(
	array('label'=>'Список ссылок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Специальные партнёрские ссылки</h3>

<h1>Добавление специальной партнёрской ссылки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>