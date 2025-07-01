<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'partner-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Сведения о партнёре</legend>    

<ol>

	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'firstName'); ?>
        <?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'firstName'); ?>
    </div>
    </li>

<?php if (Settings::item('affCountry')): ?>
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->dropDownList($model,'country',Country::get(), array ('class' => 'select')); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>
    </li>    
<?php endif; ?>

<?php if (Settings::item('affCity')): ?>
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'city'); ?>
        <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255,'class' => 'text')); ?>
        <?php echo $form->error($model,'city'); ?>
    </div>
    </li>
<?php endif; ?>

	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    </li>

<?php if (Settings::item('affUrl')): ?>
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'url', array('label' => 'URL сайта')); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affAbout')): ?>
	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'aboutProject', array('label' => 'Деятельность')); ?>
        <?php echo $form->textField($model,'aboutProject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'aboutProject'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affMaillist')): ?>
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'maillist', array('label' => 'Подписчики')); ?>
        <?php echo $form->textField($model,'maillist',array('size'=>30,'maxlength'=>30, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'maillist'); ?>
    </div>
    </li>
<?php endif; ?>
    
</ol>

</fieldset>

<fieldset>

<legend>Реквизиты для выплаты комиссионных:</legend>

<ol>
    
<?php if (Settings::item('affWmz')): ?>
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'wmz'); ?>
        <?php echo $form->textField($model,'wmz',array('size'=>13,'maxlength'=>13, 'class' => 'text')); ?>
        <?php echo $form->error($model,'wmz'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affWmr')): ?>
	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'wmr'); ?>
        <?php echo $form->textField($model,'wmr',array('size'=>13,'maxlength'=>13, 'class' => 'text')); ?>
        <?php echo $form->error($model,'wmr'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affRbk')): ?>
	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'rbkmoney'); ?>
        <?php echo $form->textField($model,'rbkmoney',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
        <?php echo $form->error($model,'rbkmoney'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affYandex')): ?>
	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'yandex'); ?>
        <?php echo $form->textField($model,'yandex',array('size'=>20,'maxlength'=>20, 'class' => 'text')); ?>
        <?php echo $form->error($model,'yandex'); ?>
    </div>
    </li>
<?php endif; ?>

<?php if (Settings::item('affZpayment')): ?>
	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'zpayment'); ?>
        <?php echo $form->textField($model,'zpayment',array('size'=>14,'maxlength'=>14, 'class' => 'text')); ?>
        <?php echo $form->error($model,'zpayment'); ?>
    </div>
    </li>
<?php endif; ?>
   
</ol>
</fieldset>

<fieldset>

<legend>Данные для входа</legend>

<ol>   

	<li>
		<?= $form->labelEx($model,'trusted'); ?>
		<?= $form->dropDownList($model,'trusted',Lookup::items('Visible'), array('class'=>'text')); ?>
		<?= $form->error($model,'trusted'); ?>
	</li>
   
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'password', array('label' => 'Пароль')); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>    
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'passwordRepeat'); ?>
        <?php echo $form->passwordField($model,'passwordRepeat',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
        <?php echo $form->error($model,'passwordRepeat'); ?>
    </div>    
    </li>    
  
    
</ol>
</fieldset>    

	<fieldset class="submit">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->