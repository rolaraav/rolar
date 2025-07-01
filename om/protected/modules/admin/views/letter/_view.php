<div class="view">

<fieldset>

<legend>Элемент</legend>

<ol>

	<li><b><?= CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?= CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?= CHtml::encode($data->description); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?= CHtml::encode($data->subject); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?= CHtml::encode($data->message); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?= CHtml::encode($data->type); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('lon')); ?>:</b>
	<?= CHtml::encode($data->on); ?>
	</li>


</ol>

</fieldset>

</div>