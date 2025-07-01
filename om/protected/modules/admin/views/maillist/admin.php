<?php $this->pageTitle='Список рассылок' ?><?

$this->menu=array(
	array('label'=>'Добавить рассылку', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rass-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Рассылки</h3>

<h1>Список серий писем</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rass-grid',
        'selectableRows' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'good_id',
		'active' => array (
                    'name' => 'active',
                    'value' => 'Lookup::item ("Visible",$data->active)',
                ),
                array (
                    'header' => 'Ссылки',
                    'type' => 'raw',
                    'htmlOptions' => array ('style' => 'width: 250px;','align' => 'center'),
                    'value' => 'CHtml::link ("письма",array ("rletters/index","RassLetter[rass_id]" => $data->id))." &nbsp; &nbsp; ". 
                    CHtml::link ("подписчики",array ("ruser/index?RassUser[rass_id]=".$data->id))." &nbsp; &nbsp; ".
                    CHtml::link ("очередь",array ("rsub/index?RassSub[rass_id]=".$data->id))',
                ),
		array(
			'class'=>'CButtonColumn',
                        'viewButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

<br><br>

<form method="post" action="<?=Y::bua();?>maillist/add">
<fieldset>
    
    <legend>Добавить подписчика к рассылке</legend>
    
    <ol>
        <li>
            <label>Рассылка</label>
            <?=CHtml::dropDownList('rid', '', Rass::items (),array ('class' => 'select')); ?>
        </li>
        <li>
            <label>Имя</label>
            <input type="text" class="text" name="uname" value="">
        </li>
        
        <li>
            <label>E-mail</label>
            <input type="text" class="text" name="email" value="">
        </li>        
</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
    
</form>

</div>