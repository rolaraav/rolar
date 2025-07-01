<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_2checkout.php */ ?>
<fieldset>

<legend>Параметры системы приёма платежей 2CheckOut</legend>

<img src="<?=Y::bu()?>images/admin/pay/checkout.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'pay2checkoutOn'); ?>
        <?php echo $form->checkBox($model,'pay2checkoutOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'pay2checkoutId'); ?>
        <?php echo $form->textField($model,'pay2checkoutId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'pay2checkoutId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'pay2checkoutKey'); ?>
        <?php echo $form->textField($model,'pay2checkoutKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'pay2checkoutKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','check') ?>
<br>

<fieldset>
<legend>Данные для настройки 2CheckOut - Look&amp;Feel - Settings</legend>
<ol>

<li>
<label>Account Demo:</label>
<div class="systemparam">Off</div>
</li>

<li>
<label>Direct return:</label>
<div class="systemparam">No</div>
</li>

<li>
<label>Approved URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/checkout</div>
</li>

<li>
<label>Pending URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/checkout/wait</div>
</li>

<li>
<label>Affiliate URL:</label>
<div class="systemparam">не заполнять</div>
</li>

</ol>
</fieldset>
</div>


<br />
