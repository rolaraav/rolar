<?php $this->pageTitle='Просмотр категории пин-кодов' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить всё', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить категорию и все Пин-коды этой категории?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Категории пин-кодов</h3>

<h1>Просмотр категории пин-кодов #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
                array (
                    'label' => ' ',
                    'type' => 'raw',
                    'value' => '&nbsp;',
                ),
                //Всего пин-кодов
                array (
                    'label' => 'Всего пин-кодов',
                    'value' => $model->totalcount,
                ),                
                //Использовано
                array (
                    'label' => 'Из них использовано',
                    'value' => $model->usedcount,
                ),                
                //Осталось                
                array (
                    'label' => 'Осталось пин-кодов',
                    'value' => $model->totalcount,
                ),                
            
	),
)); ?>

<p><br><?=CHtml::link ('Просмотреть все пин-коды данной категории', array ('pin/index/cat/'.$model->id)); ?></p>
<p><br><?=CHtml::link ('Просмотреть только ИСПОЛЬЗОВАННЫЕ пин-коды данной категории', array ('pin/index/cat/'.$model->id.'/?Pin[used]=1')); ?></p>
<p><br><?=CHtml::link ('Просмотреть НЕИСПОЛЬЗОВАННЫЕ пин-коды данной категории', array ('pin/index/cat/'.$model->id.'/?Pin[used]=0')); ?></p>


<?=CHtml::form (array ('pincat/addcodes/id/'.$model->id),'post'); ?>    

<fieldset>

<legend>Добавить новый список пин-кодов</legend>

<ol>    

<p>&nbsp;</p>
<p align="center">Укажите пин-коды для занесения в базу - по одному на строчку:</p>
<p align="center"><br><?=CHtml::textarea ('tbody',$msg,array (
	'name' => 'tbody',
	'cols' => 70,
	'rows' => 20,
	'class'=> 'textarea',	
));?></p>
<p>&nbsp;</p>

</fieldset>

<fieldset class="submit">
<input class="submit" type="submit"
value="Внести пин-коды" />
</fieldset>


</form>

</div>

