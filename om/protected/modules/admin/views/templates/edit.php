<?php $this->pageTitle='Изменение HTML-шаблона'; ?><?

$this->menu=array(
	array('label'=>'Список шаблонов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">
    
    <h3>Шаблоны</h3>
    <h1>Изменение шаблона</h1>
    
<form method="POST">
    
<fieldset>
<legend>Шаблон &quot;<?=$tmname?>&quot;</legend>

<div class="shablon" align="center">

           <?=CHtml::textarea ('template_data',$template_data,array (
                'rows' => 20, 'cols'=>75, 'class' => 'textarea')); ?>
</div>

</fieldset>

<fieldset class="submit_center">
<input class="submit_center" type="submit"
value="Сохранить изменения" />
</fieldset>

</form>    
    
</div>