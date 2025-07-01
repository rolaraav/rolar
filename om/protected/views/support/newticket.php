<?php $this->pageTitle='Отправка запроса в Службу Поддержки' ?>

<div class="wrap">

<h3>Служба поддержки</h3>

<h1>Отправка запроса в Службу Поддержки</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="validerror">
	    <?php echo $form->errorSummary($model); ?>
    </div>
    
    <fieldset>
    <legend>Даннные запроса</legend>        
    
	<ol>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'firstName'); ?>
        <?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'firstName'); ?>
    </div>    
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>    
    </li>

	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'section_id'); ?>
        <?php echo $form->dropDownList($model,'section_id',TicketSection::items(), array ('class' => 'select')); ?>
        <?php echo $form->error($model,'section_id'); ?>
    </div>
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'priority_id'); ?>
        <?php echo $form->dropDownList($model,'priority_id',Lookup::items('TicketPriority'), array ('class' => 'select')); ?>
        <?php echo $form->error($model,'priority_id'); ?>
    </div>
    </li>
    
    </ol>
    </fieldset>
    
    <fieldset>
    <legend>Текст запроса</legend>            
    
    <ol>

	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'subject'); ?>
        <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'subject'); ?>
    </div>
    </li>

	<li>
    <div class="row">
        <?php echo $form->labelEx($model,'message'); ?>
        <?php echo $form->textArea($model,'message',array('rows'=>12, 'cols'=>50, 'class' => 'textarea')); ?>
        <?php echo $form->error($model,'message'); ?>
    </div>
    </li>
    <li>

    </ol>

    </fieldset>

<?php if (Settings::item('staffUploadOn')): ?>

<?=H::moredivAll ('поля для вложения файлов') ?>

    <fieldset>
    <legend>Вложения</legend>

    <ol>


    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'file1'); ?>
        <?php echo $form->fileField($model,'file1',array('class' => 'longtext')); ?>
        <?php echo $form->error($model,'file1'); ?>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'file2'); ?>
        <?php echo $form->fileField($model,'file2',array('class' => 'longtext')); ?>
        <?php echo $form->error($model,'file2'); ?>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'file3'); ?>
        <?php echo $form->fileField($model,'file3',array('class' => 'longtext')); ?>
        <?php echo $form->error($model,'file3'); ?>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'file4'); ?>
        <?php echo $form->fileField($model,'file4',array('class' => 'longtext')); ?>
        <?php echo $form->error($model,'file4'); ?>
        <br><span class="fcomment">Разрешённые типы: <?=Settings::item('staffUploadExt')?></span>
    </div>
    </li>

    </ol>

    </fieldset>

</div>

<?php endif; ?>

    <fieldset>
    <legend>Код проверки</legend>

    <ol>

    
<?php if (extension_loaded('gd')) {?>
	<div class="row">
		<?php echo $form->labelEx($model, 'verifyCode', array ('style' => 'padding-top:15px'));?>
			<?php echo $form->textField($model, 'verifyCode', array ('class' => 'text'));?>        
			<?php $this->widget('CCaptcha', array(			
					'clickableImage' => TRUE,					
					'buttonLabel' => '',
					'imageOptions' => array ('style' => 'vertical-align:middle'),
					));?>    

		<?php echo $form->error($model, 'verifyCode');?>
		</div>
<?php }?>    
    
    
    </li>
    
    </ol>
    
    </fieldset>

	<fieldset class="submit">
        <?php echo CHtml::submitButton('Отправить запрос', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div>


<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>