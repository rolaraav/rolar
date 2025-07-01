<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/general\index.php */ ?>
<?php $this->pageTitle='Общие настройки' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Общие настройки</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>


<?
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
                'Основные'      =>  $this->renderPartial('_project',array('model' => $model, 'form' => $form),true),
                'Курсы валют'    =>  $this->renderPartial('_kurs',array('model' => $model, 'form' => $form),true),
                'Настройки почты'    =>  $this->renderPartial('_mail',array('model' => $model, 'form' => $form),true),
                'Поддержка'          =>  $this->renderPartial('_support',array('model' => $model, 'form' => $form),true),
                'Крон и рассылки'            =>  $this->renderPartial('_other',array('model' => $model, 'form' => $form),true),
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
