<?php $this->pageTitle='Изменение письма' ?><?php

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('maillist/index'), 'itemOptions' => array ('class' => 'rmenu_list')),	
    array('label'=>'Список писем', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Письма рассылки</h3>

<h1>Изменение письма рассылки #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
