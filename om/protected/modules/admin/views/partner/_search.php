<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<fieldset>

<legend>Поиск</legend>

<ol>

	<li>
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'firstName', array('label' => 'Имя')); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'email', array('label' => 'E-mail')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
    
    <li>
    	&nbsp;
    </li>

	<?php if (Settings::item('affWmz')): ?>
	<li>
		<?php echo $form->label($model,'wmz'); ?>
		<?php echo $form->textField($model,'wmz',array('size'=>13,'maxlength'=>13, 'class' => 'text')); ?>
	</li>
    <?php endif; ?>

<?php if (Settings::item('affWmr')): ?>
	<li>
		<?php echo $form->label($model,'wmr'); ?>
		<?php echo $form->textField($model,'wmr',array('size'=>13,'maxlength'=>13, 'class' => 'text')); ?>
	</li>
<?php endif; ?>


<?php if (Settings::item('affRbk')): ?>
	<li>
		<?php echo $form->label($model,'rbkmoney'); ?>
		<?php echo $form->textField($model,'rbkmoney',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affYandex')): ?>
	<li>
		<?php echo $form->label($model,'yandex', array('label' => 'Яндекс.Деньги')); ?>
		<?php echo $form->textField($model,'yandex',array('size'=>20,'maxlength'=>20, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affZpayment')): ?>
	<li>
		<?php echo $form->label($model,'zpayment', array('label' => 'Z-payment')); ?>
		<?php echo $form->textField($model,'zpayment',array('size'=>14,'maxlength'=>14, 'class' => 'text')); ?>
	</li>
<?php endif; ?>
    
	<li>
    	&nbsp;
    </li>    

<?php if (Settings::item('affCountry')): ?>
	<li>
		<?php echo $form->label($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affMaillist')): ?>
	<li>
		<?php echo $form->label($model,'maillist',array('label'=>'Подписчиков')); ?>
		<?php echo $form->textField($model,'maillist',array('size'=>30,'maxlength'=>30, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affFrom')): ?>
	<li>
		<?php echo $form->label($model,'from',array('label'=>'Откуда узнал')); ?>
		<?php echo $form->textField($model,'from',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affCity')): ?>
	<li>
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
<?php endif; ?>

<?php if (Settings::item('affUrl')): ?>
	<li>
		<?php echo $form->label($model,'url',array('label'=>'URL сайта')); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
<?php endif; ?>
    
<?php if (Settings::item('affAbout')): ?>
	<li>
		<?php echo $form->label($model,'aboutProject',array('label'=>'О сайте')); ?>
		<?php echo $form->textField($model,'aboutProject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
<?php endif; ?>
    
	<li>
    	&nbsp;
    </li>        
    
	<li>
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'trusted'); ?>
		<?php echo $form->dropDownList($model,'trusted',Lookup::items('Visible'),array('class'=>'select', 'empty' => '')); ?>
	</li>
    

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->