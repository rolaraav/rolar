<?php $this->pageTitle='Просмотр статьи №'.$model->id ?><?

$this->menu=array(
	array('label'=>'Список статей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить статью', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить статью', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить статью', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>База знаний</h3>

<h1>Просмотр статьи №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_id' => array (
                    'label' => 'Категория',
                    'value' => ArticleCategory::item ($model->category_id),
                ),
		'title',		
		'position',
		'createTime' => array (
                    'label' => 'Время создания',
                    'value' => date ('j.m.Y H:i:s', $model->createTime),
                    'cssClass' => 'date',
                ),
		'updateTime' => array (
                    'label' => 'Последнее изменение',
                    'value' => date ('j.m.Y H:i:s', $model->updateTime),
                    'cssClass' => 'date2',
                ),
		'visible' => array (
                    'label' => 'Отображать?',
                    'value' => Lookup::item ('Visible',$model->visible),
                ),
                array (
                    'label' => 'Ссылка на статью',
                    'type' => 'raw',
                    'value' => CHtml::link (Yii::app()->getBaseUrl(TRUE).'/support/article/'.$model->id,array ('/support/article/'.$model->id), array ('target' => '_blank')),
                )

	),
)); ?>

<br>
<p align="center"><b>Текст статьи:</b></p>
<br>

<p><?=$model->content?></p>

</div>
