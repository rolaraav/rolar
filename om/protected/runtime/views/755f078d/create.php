<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\waylist\create.php */ ?>
<?php $this->pageTitle='Добавление варианта оплаты' ?><?

$this->menu=array(
	array('label'=>'Список вариантов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Варианты оплаты</h3>

<h1>Добавление варианта</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>