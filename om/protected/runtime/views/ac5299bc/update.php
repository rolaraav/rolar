<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\good\update.php */ ?>
<?php $this->pageTitle='Изменение товара' ?><?php

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить товар', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр товара', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Товары</h3>

<h1>Изменение товара <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>