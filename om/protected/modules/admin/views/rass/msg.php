<?php $uu = array (); foreach($users as $one) { $uu[$one->email] = $one; } $users =$uu; ?>
<?php $this->pageTitle='Рассылка' ?>

<div class="wrap">
    
    <h3>Рассылка</h3>
    
    <h1>Рассылка - Сообщение</h1>
    
<?=CHtml::form (array ('rass/send'),'post', array (
    'onSubmit' => 'if(confirm("Вы подтверждаете отправку сообщения?")) return true; else return false;')); ?>    

<fieldset>

<legend>Параметры соообщения</legend>

<ol>

<li>
<label for="subject">Тема письма:</label>
<input class="longtext" type="text" name="subject" value="<?=$subj?>"/>
</li>

<li>
<label for="format">Формат письма:</label>
<select name="format" class="select" id="tformat">
<option value="plain">Текстовый</option>
<option value="html">HTML-формат</option>
</select>
</li>

<li>
<label for="priority">Приоритет в очереди:</label>
<input class="numeric" type="text" name="priority" value="0"/>
</li>

</ol>

</fieldset>


<div class="plaintext" id="plain">
<fieldset>
<legend>Сообщение (в текстовом формате)</legend>
<?=CHtml::textarea ('tbody',$msg,array (
	'name' => 'tbody',
	'cols' => 70,
	'rows' => 20,
	'class'=> 'textarea',	
));?>
</fieldset>
</div>

<div class="htmltext" id="html">
<fieldset style="padding:10px;">
<legend>Сообщение (в HTML формате)</legend>

    <?php $this->widget('application.extensions.my.ckeditor.CKEditor', array(
'name' => 'hbody',
        'value' => nl2br(str_replace ('%unsub%','<a href="%unsub%">%unsub%</a>',str_replace('%site_url%','<a href="%site_url%">%site_url%</a>',$msg))),
'attribute'=>'content',
'language'=>'ru',
'editorTemplate'=>'full',
)); ?>
</fieldset>
</div>

<script type="text/javascript">

	function mysel () {
		if ($('#tformat').attr('value') == 'html') {
			
			$('#html').show ();
			$('#plain').hide ();
			
		}	
		else {
		
			$('#html').hide ();
			$('#plain').show ();
			
		}
	}

	$(function () {	
		
		$('#tformat').change ( function () {
				mysel ();		
		});		
		mysel ();
	
	});
		
</script>

</fieldset>

<div class="plaintext">
<fieldset>
<legend>Список получателей (можно редактировать)</legend>
<textarea name="users" class="textarea" cols="70" rows="10"><? foreach($users as $one): ?><?=$one->id?>||<?=$one->email?>||<?=($type=='refs')?$one->firstName:$one->uname?>

<?php endforeach; ?></textarea>
</fieldset>
</div>

<input type="hidden" name="type" value="<?=$type?>">

<fieldset class="submit">
<input class="submit" type="submit"
value="Разослать сообщение" />
</fieldset>


</form>

</div>