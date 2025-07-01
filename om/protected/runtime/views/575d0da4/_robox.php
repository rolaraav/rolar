<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_robox.php */ ?>
<fieldset>

<legend>Параметры приёма платежей через РобоКассу</legend>

<img src="<?=Y::bu()?>images/admin/pay/robokassa.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payRoboxOn'); ?>
        <?php echo $form->checkBox($model,'payRoboxOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payRoboxLogin'); ?>
        <?php echo $form->textField($model,'payRoboxLogin',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payRoboxLogin'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payRoboxPass1'); ?>
        <?php echo $form->textField($model,'payRoboxPass1',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payRoboxPass1'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payRoboxPass2'); ?>
        <?php echo $form->textField($model,'payRoboxPass2',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payRoboxPass2'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payRoboxValuta'); ?>
        <?php echo $form->dropDownList($model,'payRoboxValuta',Lookup::items('Robox'),array('class' => 'select')); ?>
        <?php echo $form->error($model,'payRoboxValuta'); ?>
    </li>

    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','robox') ?>
<br>

<fieldset>
<legend>Для ввода в разделе &quot;Администрирование&quot; на сайте Робокассы</legend>
<ol>

<li>
<label>Result URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/robox</div>
</li>

<li>
<label>Метод Result URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Success URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/robox/ok</div>
</li>

<li>
<label>Метод Success URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/robox/fail</div>
</li>

<li>
<label>Метод Fail URL:</label>
<div class="systemparam">POST</div>
</li>


</ol>
</fieldset>
</div>

<br />
