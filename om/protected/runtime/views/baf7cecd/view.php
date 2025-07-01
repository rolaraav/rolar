<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\bill\view.php */ ?>
<?php $this->pageTitle='Просмотр счёта' ?><?

$this->menu=array(
	array('label'=>'Список счетов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Удалить счёт', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Счета</h3>

<h1>Просмотр счёта №<?php echo $model->id; ?></h1>

<?php if (($model->status_id != 'nalozh_ok') AND ($model->status_id != 'approved') AND ($model->status_id != 'nalozh_back')  AND ($model->status_id != 'sent')): ?>

<script language="javascript">
    
        function mysubm(){                          
            window.document.getElementById('fok').style = 'display:none';
        }        
</script>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'fok',
    'enableAjaxValidation'=>false,
    'htmlOptions' =>
        array (
            'onSubmit' => 'mysubm();'
         ),

)); ?>

<?=H::moredivAll ('изменение данных счёта','bb') ?>

<fieldset>

    <legend>Данные счёта</legend>

    <br>

<ol>

<?php if ($model->kind != 'disk'): ?>

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

<?php if ($model->kind != 'disk'): ?>

    <li>
        <?= $form->labelEx($model,'phone'); ?>
        <?= $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'phone'); ?>
    </li>
    

<?php endif; ?>


<?php if ($model->kind == 'disk'): ?>



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

    <li>
        <?= $form->labelEx($model,'phone'); ?>
        <?= $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <span style="font-size:9px; color:gray"><i>Пример: +7 (495) 123-4567</i></span>
        <?= $form->error($model,'phone'); ?>
    </li>    

    <li>
        <?= $form->labelEx($model,'comment'); ?>
        <?= $form->textField($model,'comment',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?= $form->error($model,'comment'); ?>
    </li>    
    
    <li>
        <?= $form->labelEx($model,'curier'); ?>
        <?= $form->dropDownList($model,'curier',Lookup::items ("Visible"),array ('class' => 'select')); ?>
        <?= $form->error($model,'curier'); ?>
    </li>        
    

</ol>
</fieldset>

<?php endif; ?>
    
</div>

    
<fieldset>
    <legend>Управление статусом счёта</legend>
    
    <ol>
        
        <li><label>Действие:</label>            
            
<select name="operation" class="select" style="width:400px;">
    
<option value="nothing">Не менять статус (только редактировать данные)</option>
    
<?php if ($model->status_id == 'waiting'): ?>
<option value="processing">Поступила оплата (вручную) за физический товар</option><?php endif; ?>

<?php if ($model->status_id == 'waiting'): ?>
<option value="approved">Поступила оплата (вручную) за цифровой товар</option><?php endif; ?>

<?php if ($model->status_id == 'nalozh_sent'): ?>
<option value="nalozh_ok">Поступила оплата наложенным платежом</option><?php endif; ?>
    
<?php if ($model->status_id == 'nalozh_confirmed'): ?>
<option value="nalozh_sent">Товар отправлен пользователю наложенным платежом</option><?php endif; ?>

<?php if ($model->status_id == 'processing'): ?>
<option value="sent">Предоплаченный физический товар отправлен пользователю</option><?php endif; ?>

<?php if ($model->status_id == 'nalozh'): ?>
<option value="nalozh_confirmed">Одобрить неподтверждённый заказ наложенным платёжом</option><?php endif; ?>

<?php if ($model->status_id == 'nalozh_sent'): ?>
<option value="nalozh_back">Невыкуп наложенного платежа (возврат)</option><?php endif; ?>

<?php if ($model->status_id == 'waiting' || $model->status_id == 'nalozh' || $model->status_id == 'nalozh_confirmed'): ?>
<option value="cancelled">Отменить счёт</option><?php endif; ?>
</select>
            
            
        </li>
        
<?php if (($model->status_id == 'processing') OR ($model->status_id == 'nalozh_confirmed')): ?>
        <li>
        <label>Номер отправления: </label>
        <input type="text" class="text" name="number">
        </li>
<?php endif; ?>
        
    </ol>
    
</fieldset>
    
    

        
<fieldset class="submit">
		<?= CHtml::submitButton('Изменить статус/данные', array ('class' => 'submit','id'=>'subm')); ?>
</fieldset>

<?php $this->endWidget(); ?>

<br>


<?php endif; ?>

<?php $vvv = Valuta::conv ($model->sum,$model->valuta,$model->usdkurs,$model->eurkurs,$model->uahkurs); ?>

    <?php 
    
        function myrpo ($model)
        {
            if ($model->kind!='disk') return '';
            
            return '<form method="POST" action="'.Yii::app()->createUrl ('admin/bill/rpo').'/id/'.$model->id.'">
            <input type="text" class="text" name="rpo" value="'.$model->postNumber.'">
            <input type="submit" value="Ввести номер посылки" class="submit"><br>&nbsp;
            </form>';
            
        }
    
    ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		
		'sum' => array (
                    'label' => 'Сумма',
                    'value' => H::mysum ($model->sum).H::valuta ($model->valuta),
                ),		
            
		'sum2' => array (
                    'label' => 'Сумма в рублях',
                    'value' => H::mysum ($vvv['rur']).' р.',
                ),		

		'sum3' => array (
                    'label' => 'Сумма долларах',
                    'value' => H::mysum ($vvv['usd']).'$',
                ),		            
            
		'orderCount' => array (
                    'label' => 'Количество заказов',
                    'type' => 'raw',
                    'value' => $model->orderCount .' ('.CHtml::link('просмотреть заказы',array ('order/index?Order[bill_id]='.$model->id),array('target' => '_blank')).')',
                    
                ),            
            	'status_id' => array (
                    'label' => 'Статус',
                    'type' => 'raw',
                    'value' => '<img src="'.Y::bu().'images/status/'.$model->status_id.'.gif" style="vertical-align:middle"> '.Lookup::item('Status',$model->status_id),
                ),
                'space1' => array ('label' => '&nbsp;', 'value' => ' '),            
            
                array(
                    'label'=>'Дата создания',
                    'value'=>date ('j.m.Y H:i',$model->createDate),
                ),

                array(
                    'label'=>'Дата оплаты',
                    'value'=> ($model->payDate>0)?date ('j.m.Y H:i',$model->payDate):' ',
                ),
            
            
		'space2' => array ('label' => '&nbsp;', 'value' => ' '),            
            
		'cupon',
            
	
		'email',
		'amail',
            
		'space3' => array ('label' => '&nbsp;', 'value' => ' '),                        
		
		'surname',
                'uname',
		'otchestvo',
		'strana',
		'region',
		'gorod',
		'postindex',
		'address',
		'phone',
                'comment',                
            
                'space4' => array ('label' => '&nbsp;', 'value' => ' '),                                                
                
            
                'com1'  => array (
                    'label' => 'Комиссионные',
                    'type' => 'raw',
                    'value' => $com1 . ' руб. ' . $refs1,
                ),
                'com2'  => array (
                    'label' => 'Комиссионные 2 ур. ' .$refs2,
                    'type' => 'raw',
                    'value' => $com2 . ' руб.',
                ),
            
                'space5' => array ('label' => '&nbsp;', 'value' => ' '),                                                
            
                'ip' =>  array(                
                    'label' =>'IP', 
                    'type'  => 'raw',
                    'value' => (empty($model->ip))?"":"<a target='_blank' href='http://www.geoiptool.com/en/?IP=".$model->ip."'>".$model->ip."</a>"
                ), 
            
		'way',
                'purse',
                'space6' => array ('label' => '&nbsp;', 'value' => ' '),                                    
		'postNumber',
            
                'space7' => array ('label' => '&nbsp;', 'value' => ' '),                                    
            
		'kind' => array (
                    'label' => 'Тип заказа',
                    'value' => ($model->kind!='arealong')?Lookup::item('GoodKind',$model->kind):'Продление закрытой зоны',
                ),                       
            
		'curier' => array (
                    'label' => 'Доставка курьером?',
                    'value' => Lookup::item('Visible',$model->curier+0),
                ),                       
            
            
                'space6' => array ('label' => '&nbsp;', 'value' => ' '.myrpo($model),'type' => 'raw'),                                    
            
		'notifySent' => array (
                    'label' => 'Получил напоминаний',
                    'value' => ($model->notifySent>2)?'не получал вообще или отказался от напоминаний':$model->notifySent,
                    
                ),
            
                'space7' => array ('label' => '&nbsp;', 'value' => ' '),                                                
                
                'l1' =>  array(                
                    'label' =>'Ссылка на оплату', 
                    'type'  => 'raw',
                    'value' => "<a target='_blank' href='".Y::bu()."bill/index?bill_id=".$model->id."&hash=".Bill::hashBill($model->id)."'>перейти</a>"
                ), 
            
                'l2' =>  array(                
                    'label' =>'Ссылка для статуса', 
                    'type'  => 'raw',
                    'value' => "<a target='_blank' href='".Y::bu()."status/index/b/".$model->id."/c/".Bill::statusCrc($model->id)."'>перейти</a>"
                ), 
            
            
            
	),
)); ?>

<br>

<?=H::moredivAll ('ссылки для исправления статуса','stat') ?>


<br><fieldset><br>

<div style="margin-left:15px;">
<p>Эти ссылки позволяют просто исправить статус платежа (без отправки товара, каких-либо писем или других действий) в базе. Бывает нужно для ошибочно установленного статуса.</p>

<br>

<p>Выберите какой статус Вы хотите установить и нажмите "Установить"</p>

<br><br>

</div>

<div style="margin-left:30px;">
         <p><img src="<?=Y::bu()?>images/status/waiting.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'waiting'))?>] - пользователь начал оформлять заказ (всего лишь заполнил форму)</p><br>
         <p><img src="<?=Y::bu()?>images/status/approved.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'approved'))?>] - полностью оплаченный счёт за товар</p><br>         
         <p><img src="<?=Y::bu()?>images/status/processing.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'processing'))?>] - оплачен физический товар предварительно, но товар ещё не отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/sent.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'sent'))?>] - покупателю физический товар (по предоплате) - уже отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'nalozh'))?>] - выбран наложенный платёж, но заказ ещё не подтверждён по e-mail</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh_confirmed.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'nalozh_confirmed'))?>] - подтверждён заказ наложенным платежом, но товар ещё не отправлен</p><br>
         <p><img src="<?=Y::bu()?>images/status/nalozh_sent.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'nalozh_sent'))?>] - заказ наложенным платежом отправлен, оплата за него ожидается</p><br>        
         <p><img src="<?=Y::bu()?>images/status/nalozh_ok.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'nalozh_ok'))?>] - поступила оплата за заказ наложенным платежом</p><br>        
         <p><img src="<?=Y::bu()?>images/status/nalozh_back.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'nalozh_back'))?>] - покупатель не выкупил на почте товар, заказанный наложенным платежом</p><br>                 
         <p><img src="<?=Y::bu()?>images/status/cancelled.gif" class="middle"> - [<?=CHtml::link ('Установить',array('view','id' => $model->id,'status' => 'cancelled'))?>] - неправильно оформленный и неоплаченный заказ отменён</p><br>                         
         
         </div>         
<br><br>

</fieldset>

</div>

<?=H::moredivAll ('добавление товаров к заказу','adder') ?>


<br><fieldset><br>

<div style="margin-left:15px;">
    <p>Вы можете добавить товар к заказу или увеличить количество (с апселл-скидкой, если есть)<br><br>
        <b>Обратите внимание:</b> после добавления товар <b>НЕВОЗМОЖНО</b> удалить из заказа</p>

<br>

<form action="" method="post">
    
    <input type="hidden" name="cross" value="1">    
    
    <p>Выберите какой товар добавить к заказу:<br><br>
        <?=CHtml::dropDownList('good_id', '', Good::items(true),array ('class' => 'select')); ?>
    </p>
    
    <br>

    </fieldset>
<fieldset class="submit">
		<?= CHtml::submitButton('Добавить к заказу', array ('class' => 'submit','id'=>'subm')); ?>
</fieldset>    
    
</form>


</div>
