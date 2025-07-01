<div class="view">

<fieldset style="padding:15px;">

<legend><?= date('j.m.Y',$data->createTime) ?></legend>

<p><b><?=CHtml::encode($data->title);?></b><br>&nbsp;<br></p>

<p><?= nl2br (CHtml::encode($data->content)); ?></p>

</fieldset>

</div>