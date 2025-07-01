<div id="usualCart">

 <?php $this->renderPartial('/catalog/_ajaxcart', array(), false, true); ?>

</div>

<?php $this->pageTitle = $model->title . ' - Каталог товаров' ?>

<div class="wrap">

<h3>Каталог товаров</h3>

<h1><?= $model->title ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=> FALSE,
	'itemView'=>'/catalog/_view',
	'template'=>"{items}\n{pager}",
)); ?>

</div>

<div class="wrap">
<p align="center">
	<a href="<?= Y::bu() ?>">Каталог товаров</a> &nbsp; &nbsp; &nbsp;
	<a href="<?= Y::bu() ?>aff/" target="_blank">Партнёрская программа</a></p>
</div>