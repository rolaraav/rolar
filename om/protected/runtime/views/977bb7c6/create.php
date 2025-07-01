<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\way\create.php */ ?>
<?php $this->pageTitle='Добавление способа оплаты' ?><?

$this->menu=array(
	array('label'=>'Список способов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Способы оплаты</h3>

<h1>Добавление способа</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>