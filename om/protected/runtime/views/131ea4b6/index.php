<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\support\index.php */ ?>
<?php $this->pageTitle='Поддержка' ?><?

$this->menu=array(
	array('label'=>'Настройка отделов', 'url'=>array('ticketsection/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
        array('label'=>'База знаний', 'url'=>array('article/index'), 'itemOptions' => array ('class' => 'rmenu_base')),
);

?>

<div class="wrap">
<h3>Поддержка</h3>

<h1>Отделы поддержки</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_section',
)); ?>

<p><b>Ссылка на центр поддержки:</b> <a href="<?=Yii::app()->getBaseUrl (TRUE)?>/support/" target="_blank"><?=Yii::app()->getBaseUrl (TRUE)?>/support/</a></p>

</div>