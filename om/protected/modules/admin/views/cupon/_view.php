<div class="view">

<fieldset>

<legend>Элемент</legend>

<ol>

	<li><b><?= CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?= CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?= CHtml::encode($data->code); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('sum')); ?>:</b>
	<?= CHtml::encode($data->sum); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('kind_id')); ?>:</b>
	<?= CHtml::encode($data->kind_id); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?= CHtml::encode($data->startDate); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('stopDate')); ?>:</b>
	<?= CHtml::encode($data->stopDate); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('komis')); ?>:</b>
	<?= CHtml::encode($data->komis); ?>
	</li>

	<?php /*
	<li><b><?= CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?= CHtml::encode($data->title); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('good_id')); ?>:</b>
	<?= CHtml::encode($data->good_id); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('selfDelete')); ?>:</b>
	<?= CHtml::encode($data->selfDelete); ?>
	</li>

	*/ ?>

</ol>

</fieldset>

</div>