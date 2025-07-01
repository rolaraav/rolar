<div class="view">

<fieldset>

<legend>Сведения об операторе &quot;<?= CHtml::encode($data->username); ?>&quot;</legend>

<ol>

	<li><b><?= CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?= CHtml::encode($data->user_id); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?= CHtml::encode($data->firstName); ?>
	</li>

	<li><b><?= CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?= CHtml::encode($data->email); ?>
	</li>

</ol>

</fieldset>

</div>