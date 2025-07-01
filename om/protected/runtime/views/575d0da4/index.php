<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\index.php */ ?>
<?php $this->pageTitle='Настройки платёжных систем' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Настройки платёжных систем</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>


<?
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
                'WebMoney' => $this->renderPartial('_webmoney',array('model' => $model, 'form' => $form),true),
                'RBKMoney' => $this->renderPartial('_rbkmoney',array('model' => $model, 'form' => $form),true),
                'Z-payment' => $this->renderPartial('_zpayment',array('model' => $model, 'form' => $form),true),
                'РобоКасса' => $this->renderPartial('_robox',array('model' => $model, 'form' => $form),true),
                '2CheckOut' => $this->renderPartial('_2checkout',array('model' => $model, 'form' => $form),true),
                'SMS Coin' => $this->renderPartial('_smscoin',array('model' => $model, 'form' => $form),true),
                'Интеркасса' => $this->renderPartial('_interkassa',array('model' => $model, 'form' => $form),true),
                'LiqPay' => $this->renderPartial('_liqpay',array('model' => $model, 'form' => $form),true),
                'SpryPay' => $this->renderPartial('_sprypay',array('model' => $model, 'form' => $form),true),
                'Яндекс.Деньги' => $this->renderPartial('_yandex',array('model' => $model, 'form' => $form),true),
                'Яндекс.Касса' => $this->renderPartial('_yandexkassa',array('model' => $model, 'form' => $form),true),
                'PayPal' => $this->renderPartial('_paypal',array('model' => $model, 'form' => $form),true),
                'Payeer' => $this->renderPartial('_payeer',array('model' => $model, 'form' => $form),true),
                'Qiwi' => $this->renderPartial('_qiwi',array('model' => $model, 'form' => $form),true),
                'Единая касса W1' => $this->renderPartial('_w1',array('model' => $model, 'form' => $form),true),
                //'OnPay' => $this->renderPartial('_onpay',array('model' => $model, 'form' => $form),true),
                //'PayOnlineSystem' => $this->renderPartial('_payonline',array('model' => $model, 'form' => $form),true),
        ),
        'options' => array(
                'collapsible' => false,
                'selected' => $selected,
        ),
        'htmlOptions' => array ('class' => 'tabs'),
));

?>

<br />

<fieldset class="submit">
        <?php echo CHtml::submitButton('Сохранить настройки', array ('class' => 'submit')); ?>

<?php $this->endWidget(); ?>

</fieldset>

</div>
