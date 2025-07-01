<?php $this->pageTitle='Главная' ?>

<div class="wrap">

    <h3>Закрытая Зона</h3>

    <h1>&quot;<?=$model->title ?>&quot; - <?= Y::user()->areaTitle ?></h1>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,	
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>

</div>

<div class="wrap">
    <p align="center"><a href="<?=Y::bu()?>area/">Вернуться на главную</a> </p>

</div>