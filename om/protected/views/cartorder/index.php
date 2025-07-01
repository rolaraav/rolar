<?php $this->pageTitle='Оформление заказа' ?>

<div class="wrap">

<h3>Оформление заказа</h3>

<h1>Оформление заказа</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'bill-form',
    'enableAjaxValidation'=>false,
)); ?>

    <div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Ваши данные</legend>

<ol>

<?php if ($kind != 'disk'): ?>

    <li>
        <?= $form->labelEx($model,'uname'); ?>
        <?= $form->textField($model,'uname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'uname'); ?>
    </li>

<?php endif; ?>

    <li>
        <?= $form->labelEx($model,'email'); ?>
        <?= $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'email'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'amail',array ('label' => 'Другой e-mail (если есть)')); ?>
        <?= $form->textField($model,'amail',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'amail'); ?>
    </li>

<?php if ($kind != 'disk'): ?>
    <?php if (Settings::item('phoneEbook')==1): ?>

    <li>
        <?= $form->labelEx($model,'phone'); ?>
        <?= $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'phone'); ?>
    </li>
    
    <?php else: ?>
    
    <?= $form->hiddenField($model,'phone'); ?>

    <?php endif; ?>

<?php endif; ?>


    <li>
        <?= $form->labelEx($model,'cupon', array ('label' => 'Купон скидки (если есть)')); ?>
        <?= $form->textField($model,'cupon',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'cupon'); ?>
    </li>




</ol>
</fieldset>

<?php if ($kind == 'disk'): ?>

<fieldset>

<legend>Адрес для доставки</legend>

<ol>

    <li>
        <?= $form->labelEx($model,'surname'); ?>
        <?= $form->textField($model,'surname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'surname'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'uname'); ?>
        <?= $form->textField($model,'uname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'uname'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'otchestvo'); ?>
        <?= $form->textField($model,'otchestvo',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'otchestvo'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'strana'); ?>
        <?= $form->dropDownList($model,'strana',Country::get(), array('class' => 'select')); ?>
        <?= $form->error($model,'strana'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'region'); ?>
        <?= $form->textField($model,'region',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'region'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'gorod'); ?>
        <?= $form->textField($model,'gorod',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'gorod'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'postindex'); ?>
        <?= $form->textField($model,'postindex',array('size'=>30,'maxlength'=>30, 'class' => 'text')); ?>
        <?= $form->error($model,'postindex'); ?>
    </li>

    <li>
        <?= $form->labelEx($model,'address'); ?>
        <?= $form->textField($model,'address',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'address'); ?>
    </li>

<?php if (Settings::item('phoneDisk')==1): ?>

    <li>
        <?= $form->labelEx($model,'phone'); ?>
        <?= $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <span style="font-size:9px; color:gray"><i>Пример: +7 (495) 123-4567</i></span>
        <?= $form->error($model,'phone'); ?>
    </li>
    
    <?php else: ?>
    <?php $model->phone = 'нет' ?>
    <?= $form->hiddenField($model,'phone'); ?>

    <?php endif; ?>

    <li>
        <?= $form->labelEx($model,'comment'); ?>
        <?= $form->textField($model,'comment',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'comment'); ?>
    </li>    

</ol>
</fieldset>

<?php endif; ?>

<fieldset class="submit">
        <?= CHtml::submitButton('Продолжить', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>