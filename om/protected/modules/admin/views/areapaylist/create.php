<?php $this->pageTitle='Добавление срока оплаты Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Список сроков', 'url'=>array('index', array ('a'=>$area_id)), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Сроки оплаты Закрытой Зоны</h3>

<h1>Добавление срока оплаты в Закрытую Зону</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>