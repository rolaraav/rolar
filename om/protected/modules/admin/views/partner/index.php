<?php $this->pageTitle='Список партнёров' ?><?

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('partner-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Партнёры</h3>

<h1>Список партнёров</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partner-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'id',
				'value'=>'$data->id',
                'header' => 'RefID',                
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'firstName',
				'value'=>'$data->firstName',
                'header' => 'Имя',
				'headerHtmlOptions'=>array('width'=>'60'),
			),		
			
			 array(
				'name'=>'createTime',
				'value'=> 'date(\'j.m.Y\', $data->createTime)',
				'headerHtmlOptions'=>array('width'=>'50'),
                'header' => 'Дата',
                'htmlOptions' => array('class' => 'thedate'),
			),
					
			 array(
				'name'=>'url',
				'value'=>'$data->url',
                'header' => 'URL сайта',
                'headerHtmlOptions'=>array('width'=>'220'),
			),
			
			
			 array(
				'name'=>'total',
				'value'=>'H::mysum($data->total).\' р.\'',
                'header' => 'Прибыль',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
                        /*
			 array(
				'name'=>'clickCount',
				'value'=>'$data->clickCount',
                                'header' => 'Кликов',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'filter' => '',
			), */
                        
			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array('width'=>'62')
		),
	),
)); ?>

<br><br>

<p><b>Ссылка на партнёрскую программу:</b> <a href="<?=Yii::app()->getBaseUrl (TRUE)?>/aff/" target="_blank"><?=Yii::app()->getBaseUrl (TRUE)?>/aff/</a></p>

</div>

