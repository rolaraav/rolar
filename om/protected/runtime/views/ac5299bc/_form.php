<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\good\_form.php */ ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'good-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Основная информация о товаре</legend>

<ol>
        <?php if ($model->isNewRecord): ?>
        
	<li>
		<?= $form->labelEx($model,'id'); ?>
		<?= $form->textField($model,'id',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
		<?= $form->error($model,'id'); ?>
	</li>
        
        <?php endif; ?>

	<li>
		<?= $form->labelEx($model,'category_id'); ?>
		<?= $form->dropDownList($model,'category_id',Category::items (),array('class'=>'select')); ?>
		<?= $form->error($model,'category_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'price'); ?>
		<?= $form->textField($model,'price',array('class'=>'numeric')); ?>
		<?= $form->error($model,'price'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'currency'); ?>
		<?= $form->dropDownList($model,'currency',Lookup::items ('Valuta'), array('class' => 'select')); ?>
		<?= $form->error($model,'currency'); ?>
	</li>
        

	<li>
		<?= $form->labelEx($model,'description'); ?>
		<?= $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'description'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'image'); ?>
		<?= $form->textField($model,'image',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'image'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'catalog_on'); ?>
		<?= $form->dropDownList($model,'catalog_on',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'catalog_on'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'numeric')); ?>
		<?= $form->error($model,'position'); ?>
	</li>


	<li>
		<?= $form->labelEx($model,'kind'); ?>
		<?= $form->dropDownList($model,'kind',Lookup::items ('GoodKind'),array('class' => 'select')); ?>
		<?= $form->error($model,'kind'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'dlink'); ?>
		<?= $form->textField($model,'dlink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'dlink'); ?>
	</li>                
        
	<li>
		<?= $form->labelEx($model,'author_id'); ?>
		<?= $form->dropDownList($model,'author_id',array_merge (array('' => '(автор не задан)'), Author::items()),array('class'=>'select')); ?>
		<?= $form->error($model,'author_id'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'authorKomis'); ?>
		<?= $form->textField($model,'authorKomis',array('class'=>'numeric')); ?>
		<?= $form->error($model,'authorKomis'); ?>
	</li>                
        
	<li>
		<?= $form->labelEx($model,'aukind'); ?>
		<?= $form->dropDownList($model,'aukind',array ('price' => '% от стоимости товара', 'total' => '% от прибыли (цена товара минус комиссия партнёрам)'),array('class'=>'select')); ?>
		<?= $form->error($model,'aukind'); ?>
	</li>        
        
	<li>
		<?= $form->labelEx($model,'used'); ?>
		<?= $form->dropDownList($model,'used',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'used'); ?>
	</li>        

</ol>

</fieldset>

<br>

<?=H::moredivAll ('текст письма после оплаты','l') ?>

<fieldset>

    <legend>Письмо после оплаты</legend>

    <br>

<ol>
    
	<li>
		<?= $form->labelEx($model,'letterSubject'); ?>
		<?= $form->textField($model,'letterSubject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'letterSubject'); ?>
	</li>    

	<li>
		<?= $form->labelEx($model,'letterType'); ?>
		<?= $form->dropDownList($model,'letterType',Lookup::items('Letter'),array('class'=>'select')); ?>
		<?= $form->error($model,'letterType'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'letterText'); ?>
		<?= $form->textArea($model,'letterText',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'letterText'); ?>
	</li>        
        
</ol>
</fieldset>        

</div>

<?=H::moredivAll ('параметры партнёрской программы') ?>

<fieldset>

    <legend>Параметры партнёрской программы</legend>

    <br>

<ol>

	<li>
		<?= $form->labelEx($model,'affOn'); ?>
		<?= $form->dropDownList($model,'affOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'affOn'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'affOrder'); ?>
		<?= $form->dropDownList($model,'affOrder',Lookup::items('KomisOrder'),array('class'=>'select')); ?>
		<?= $form->error($model,'affOrder'); ?>
	</li>
        

	<li>
		<?= $form->labelEx($model,'affLink'); ?>
		<?= $form->textField($model,'affLink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'affLink'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'affKomis'); ?>
		<?= $form->textField($model,'affKomis',array('class'=>'numeric')); ?>
		<?= $form->error($model,'affKomis'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'affKomisType'); ?>
		<?= $form->dropDownList($model,'affKomisType',Lookup::items('KomisType'),array('class'=>'select')); ?>
		<?= $form->error($model,'affKomisType'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'affPkomis'); ?>
		<?= $form->textField($model,'affPkomis',array('class'=>'numeric')); ?>
		<?= $form->error($model,'affPkomis'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'affPkomisType'); ?>
		<?= $form->dropDownList($model,'affPkomisType',Lookup::items('KomisType'),array('class'=>'select')); ?>
		<?= $form->error($model,'affPkomisType'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'affShow'); ?>
		<?= $form->dropDownList($model,'affShow',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'affShow'); ?>
	</li>

</ol>
</fieldset>

</div>

<?=H::moredivAll ('дополнительные параметры','b') ?>

<fieldset>

    <legend>Дополнительные параметры</legend>

    <br>
<ol>
    
	<li>
		<?= $form->labelEx($model,'nalozhOn'); ?>
		<?= $form->dropDownList($model,'nalozhOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'nalozhOn'); ?>
	</li>    
        
	<li>
		<?= $form->labelEx($model,'kurier'); ?>
		<?= $form->dropDownList($model,'kurier',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'kurier'); ?>
	</li>            
        
	<li>
		<?= $form->labelEx($model,'kurstrany'); ?>
		<?= $form->textField($model,'kurstrany',array('class' => 'select')); ?>
		<?= $form->error($model,'kurstrany'); ?>
	</li>

        
	<li>
		<?= $form->labelEx($model,'kurgorod'); ?>
		<?= $form->textField($model,'kurgorod',array('class' => 'select')); ?>
		<?= $form->error($model,'kurgorod'); ?>
	</li>        
        
        <li>&nbsp;</li>
        
	<li>
		<?= $form->labelEx($model,'needid'); ?>
		<?= $form->dropDownList($model,'needid',Good::items(TRUE),array('class' => 'select')); ?>
		<?= $form->error($model,'needid'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'sendid'); ?>
		<?= $form->dropDownList($model,'sendid',Good::items(TRUE),array('class' => 'select')); ?>
		<?= $form->error($model,'sendid'); ?>
	</li>        
        
        <li>&nbsp;</li>
        
	<li>
		<?= $form->labelEx($model,'disabledWays'); ?>
		<?= $form->textField($model,'disabledWays',array('class' => 'select')); ?>
		<?= $form->error($model,'disabledWays'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'securebook'); ?>
		<?= $form->dropDownList($model,'securebook',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'securebook'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'getUrl'); ?>
		<?= $form->textField($model,'getUrl',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'getUrl'); ?>
	</li>
        
        <li>&nbsp;</li>
        
	<li>
		<?= $form->labelEx($model,'comtitle'); ?>
		<?= $form->textField($model,'comtitle',array('class' => 'select')); ?>
		<?= $form->error($model,'comtitle'); ?>
	</li>        
        
	<li>
		<?= $form->labelEx($model,'comvalues'); ?>
		<?= $form->textArea($model,'comvalues',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'comvalues'); ?>
	</li>        
        
	<li>
		<?= $form->labelEx($model,'ads'); ?>
		<?= $form->textArea($model,'ads',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'ads'); ?>
	</li>
        

        
</ol>
</fieldset>

</div>

<?=H::moredivAll ('параметры Корзины','c') ?>
<fieldset>

    <legend>Параметры Корзины</legend>

    <br>
<ol>


	<li>
		<?= $form->labelEx($model,'cartOn'); ?>
		<?= $form->dropDownList($model,'cartOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'cartOn'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'cartGoods'); ?>
		<?= $form->textField($model,'cartGoods',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'cartGoods'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'cartMinus'); ?>
		<?= $form->textField($model,'cartMinus',array('class'=>'numeric')); ?>
		<?= $form->error($model,'cartMinus'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'cartText'); ?>
		<?= $form->textArea($model,'cartText',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'cartText'); ?>
	</li>        
        
</ol>
</fieldset>

</div>

<?=H::moredivAll ('апселл и кросселл','d') ?>
<fieldset>

    <legend>Апселл и Кросселл</legend>

    <br>
<ol>
        

	<li>
		<?= $form->labelEx($model,'upsellOn'); ?>
		<?= $form->dropDownList($model,'upsellOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'upsellOn'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'upsellGood'); ?>
		<?= $form->dropDownList($model,'upsellGood',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'upsellGood'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'upsellText'); ?>
		<?= $form->textArea($model,'upsellText',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'upsellText'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'tupsellOn'); ?>
		<?= $form->dropDownList($model,'tupsellOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'tupsellOn'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'tupsellGood'); ?>
		<?= $form->dropDownList($model,'tupsellGood',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'tupsellGood'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'tupsellText'); ?>
		<?= $form->textArea($model,'tupsellText',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'tupsellText'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'csellOn'); ?>
		<?= $form->dropDownList($model,'csellOn',Lookup::items('Visible'),array('class'=>'select')); ?>
		<?= $form->error($model,'csellOn'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'csellGood'); ?>
		<?= $form->dropDownList($model,'csellGood',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'csellGood'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'csellText'); ?>
		<?= $form->textArea($model,'csellText',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'csellText'); ?>
	</li>
	
	<li> &nbsp; </li>
	
	<li>
		<?= $form->labelEx($model,'csell2g'); ?>
		<?= $form->dropDownList($model,'csell2g',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'csell2g'); ?>
	</li>
	
	<li>
		<?= $form->labelEx($model,'csell2'); ?>
		<?= $form->textField($model,'csell2',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'csell2'); ?>
	</li>	
	
	<li>
		<?= $form->labelEx($model,'csell3g'); ?>
		<?= $form->dropDownList($model,'csell3g',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'csell3g'); ?>
	</li>
	
	<li>
		<?= $form->labelEx($model,'csell3'); ?>
		<?= $form->textField($model,'csell3',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'csell3'); ?>
	</li>	
	
	<li>
		<?= $form->labelEx($model,'csellOk'); ?>
		<?= $form->textField($model,'csellOk',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'csellOk'); ?>
	</li>	
		



</ol>
</fieldset>

</div>


<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить товар' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->