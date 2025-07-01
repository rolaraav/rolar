<?php $this->pageTitle='Новое письмо' ?><?

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('maillist/index'), 'itemOptions' => array ('class' => 'rmenu_list')),        
);
?>

<div class="wrap">

<h3>Серии рассылок</h3>

<h1>Добавление нового письма в рассылку</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>