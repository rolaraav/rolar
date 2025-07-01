<div class="view">

<fieldset>

<legend>Элемент</legend>

<ol>

	<li><b><?= CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?= CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('good_id')); ?>:</b>
	<?= CHtml::encode($data->good_id); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?= CHtml::encode($data->title); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?= CHtml::encode($data->code); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('adcategory_id')); ?>:</b>
	<?= CHtml::encode($data->adcategory_id); ?>
	</li>


</ol>

</fieldset>

</div>