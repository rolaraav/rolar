<?php $this->pageTitle='Короткие ссылки - Панель партнёра' ?>

<div class="wrap">

<h3>Аккаунт партнёра <?= $model->id ?></h3>

<h1>Короткие ссылки</h1>
<h2>RefID: <?= $model->id ?></h2>

<?php if (!empty ($slist)): ?>
<div class="items">

<table align="center" cellspacing="0">
<tr>
	<th width="45">ID</th>
	<th>Короткая ссылка</th>
    <th width="250">Описание</th>
    <th width="50">Удалить</th>
</tr>

<?php foreach ($slist as $key=>$one): ?>

<tr>
	<td><a href="<?=$one['url']?>" title="<?=$one['url']?>" target="_blank"><?=$key?></a></td>
	<td><?= Y::request()->getBaseUrl(true).'/'.$key ?></td>
    <td><?=CHtml::encode($one['title'])?></td>
    <td><a href="<?= Y::bu()?>aff/short/del/id/<?=$key?>"><img src="<?= Y::bu()?>images/theme/btn/x.gif" title="Удалить эту ссылку"></a></td>
</tr>

<?php endforeach; ?>
</table>
</div>

<?php else: ?>

<p>Нет коротких ссылок</p>

<?php endif; ?>

</div>

<div class="wrap">

<h3>Новая короткая ссылка</h3>

<h1>Создать короткую ссылку</h1>

<p>Вы можете выбрать в разделе &quot;Реф-ссылки&quot; длинную реф-ссылку и получить короткую</p>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'short-form',
    'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror">
	    <?php echo $form->errorSummary($short); ?>
    </div>

<fieldset>
<legend>Данные для ссылки</legend>
<ol>

	<li>
    <div class="row">
        <?php echo $form->labelEx($short,'url'); ?>
        <?php echo $form->textField($short,'url',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($short,'url'); ?>
    </div>
    </li>

	<li>
    <div class="row">
        <?php echo $form->labelEx($short,'description'); ?>
        <?php echo $form->textField($short,'description',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        <?php echo $form->error($short,'description'); ?>
    </div>
    </li>
    
</ol>

</fieldset>

<fieldset class="submit">
<input class="submit" type="submit"
value="Получить короткую ссылку" />
</fieldset>

<?php $this->endWidget(); ?>

</div>