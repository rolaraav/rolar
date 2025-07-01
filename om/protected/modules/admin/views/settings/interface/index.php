<?php $this->pageTitle='Настройки интерфейса' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Настройки интерфейса</h1>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Число записей на страницу для основных объектов</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'adminPage'); ?>
        <?php echo $form->textField($model,'adminPage',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPage'); ?>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'catalogPerPage'); ?>
        <?php echo $form->textField($model,'catalogPerPage',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'catalogPerPage'); ?>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'anewPerPage'); ?>
        <?php echo $form->textField($model,'anewPerPage',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'anewPerPage'); ?>
    </li>
    
</ol>

</fieldset>

<br />

<fieldset>

<legend>Записей на страницу по некоторым разделам админки</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'adminPgBill'); ?>
        <?php echo $form->textField($model,'adminPgBill',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgBill'); ?>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'adminPgOrder'); ?>
        <?php echo $form->textField($model,'adminPgOrder',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgOrder'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgGood'); ?>
        <?php echo $form->textField($model,'adminPgGood',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgGood'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgAreaFile'); ?>
        <?php echo $form->textField($model,'adminPgAreaFile',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgAreaFile'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgAreaUser'); ?>
        <?php echo $form->textField($model,'adminPgAreaUser',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgAreaUser'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgPayout'); ?>
        <?php echo $form->textField($model,'adminPgPayout',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgPayout'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgAffnew'); ?>
        <?php echo $form->textField($model,'adminPgAffnew',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgAffnew'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgAd'); ?>
        <?php echo $form->textField($model,'adminPgAd',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgAd'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgClient'); ?>
        <?php echo $form->textField($model,'adminPgClient',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgClient'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgCupon'); ?>
        <?php echo $form->textField($model,'adminPgCupon',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgCupon'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'staffPagination'); ?>
        <?php echo $form->textField($model,'staffPagination',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'staffPagination'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'staffBasePagination'); ?>
        <?php echo $form->textField($model,'staffBasePagination',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'staffBasePagination'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminPgClick'); ?>
        <?php echo $form->textField($model,'adminPgClick',array('class' => 'numeric')); ?>
        <?php echo $form->error($model,'adminPgClick'); ?>    </li>

    

</ol>

</fieldset>

<br />

<fieldset class="submit">
        <?php echo CHtml::submitButton('Сохранить настройки', array ('class' => 'submit')); ?>

<?php $this->endWidget(); ?>

</fieldset>

</div>
