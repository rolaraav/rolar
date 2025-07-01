<?php $this->pageTitle='Подтверждение заказа'; ?>

<div class="wrap">

<h3>Оформление заказа</h3>

<h1>Подтверждение заказа</h1>


<fieldset style="padding: 15px;">

    <legend>Содержимое Вашего заказа</legend>

<div id="cartlist">

<table width="100%" align="center" border="0">

<tr>

<td align="center" valign="top">

	<div class="cart_table">

		<table border="0" width="100%" align="center">
		<tr>
			<td width="30"><b>№</b></td>
			<td><b>Название</b></td>
			<td width="80"  align="center"><b>Цена</b></td>                        
                        <?php if (!empty($model->cupon)): ?>
                            <td width="110"  align="center"><b>С учётом скидки</b></td>
                        <?php endif; ?>
		</tr>

		<?php         $n = 0;
         $total = 0;
        ?>
		<?php foreach ($goods as $good): ?>
        <?php        	$n++;
            $total += $good->rurcena;
        ?>
		<tr>
        	<td><?= $n ?></td>
            <td><?= $good->title ?></td>
            <td align="center"><?= H::mysum($good->price).H::valuta ($good->currency) ?></td>

            <?php if (!empty($model->cupon)): ?>
                <td align="center"><span style="color:<?php echo ($good->newprice == $good->price)?'#009900':'#CC0000'; ?>"><?= H::mysum($good->newprice).H::valuta ($good->currency) ?></span></td>
            <?php endif; ?>

            
        </tr>
        <?php endforeach ?>



    </table>

	<p>&nbsp;</p>
    <?php $totalusd = Valuta::conv ($total,'rur'); $totalusd = $totalusd['usd']; ?>
	<p align="left"><b>Общая сумма<?php if (!empty($model->cupon)) echo ' (с учётом скидки)'; ?>: </b> <?= H::mysum ($total).H::valuta('rur') ?> = <?= H::mysum ($totalusd).H::valuta('usd') ?> </p>

    </div>
</td>

</tr>

</table>

</div>

</fieldset>

<fieldset style="padding: 15px;">

    <legend>Ваши данные</legend>

<?php if ($kind=='disk'): ?>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'email',
        'amail',        
        array ('value' => '&nbsp;', 'type' => 'raw'),
        'surname',
        'uname',
        'otchestvo',
        'strana',
        'region',
        'gorod',
        'postindex',
        'address',
        (Settings::item('phoneDisk')==1)?'phone':array('visible'=>FALSE),
    ),
)); ?>

<?php else: ?>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'uname',
        'email',
        'amail',
        (Settings::item('phoneEbook')==1)?'phone':array('visible'=>FALSE),
    ),
)); ?>


<?php endif; ?>


    </fieldset>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'bill-form',
    'enableAjaxValidation'=>false,
    'action' => array ('complete'),
)); ?>

<fieldset class="submit">
        <?= CHtml::submitButton('Перейти к оплате', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>