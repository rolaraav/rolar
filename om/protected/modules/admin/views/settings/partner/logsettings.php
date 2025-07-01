<?php $this->pageTitle='Параметры журнала операций' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Параметры журнала операций (лога)</h1>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Общие настройки</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'logon'); ?>
        <?php echo $form->checkBox($model,'logon',array('class' => 'checkbox','uncheckValue' => 0)); ?> 
    </li>
    
</ol>

</fieldset>

<fieldset>

<legend>Какие данные записывать в лог?</legend>

<br>
<ol>

    <?php $allset = Lookup::items ('log'); ?>
    
    
    <?php foreach ($allset as $key=>$value): ?>
    <?php $key = 'log'.$key; ?>
    <li>        
        <?php echo $form->labelEx($model,$key); ?>
        <?php echo $form->checkBox($model,$key,array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li>
    
    <?php endforeach; ?>
    
</ol>

</fieldset>
    


<br />


<fieldset class="submit">
        <?php echo CHtml::submitButton('Сохранить настройки', array ('class' => 'submit')); ?>

<?php $this->endWidget(); ?>

</fieldset>

</div>
