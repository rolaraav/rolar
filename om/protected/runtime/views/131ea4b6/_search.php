<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\support\_search.php */ ?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<p style="margin: 10px;"><br>Нажмите кнопку <b>"Отменить фильтры и сортировку"</b> - перед поиском,<br> чтобы поиск нормально работал.</p>

<fieldset>

<legend>Поиск</legend>

<ol>

	<li>
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>15,'maxlength'=>15, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'firstName', array ('label' => 'Имя')); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'priority_id'); ?>
		<?php echo $form->dropDownList($model,'priority_id',Lookup::items('TicketPriority'), array ('class' => 'select', 'empty' => '')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->dropDownList($model,'status_id',Lookup::items('TicketStatus'), array ('class' => 'select', 'empty' => '')); ?>
	</li>

        <?php if (Y::user()->id==1): ?>
	<li>
		<?php echo $form->label($model,'staff_id'); ?>
		<?php echo $form->dropDownList($model,'staff_id',Staff::items(), array ('class' => 'select', 'empty' => '')); ?>
	</li>
        <?php endif; ?>

	<li>
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>50,'maxlength'=>50, 'class' => 'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->