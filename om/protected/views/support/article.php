<?php $this->pageTitle='База знаний - ' . $model->title ?>

<div class="wrap">

<h3>Служба Поддержки - База Знаний</h3>

<h1><?= $model->title ?> - <?= $model->category->title ?></h1>

<p>&nbsp;</p>

<?= $model->content ?>

<p>&nbsp;</p>

<p style="font-size:9px"><i>Последнее обновление: <?= date ('j.m.Y',$model->updateTime) ?></i></p>

<p>


</div>

<div class="wrap">
<p align="center">
<a href="<?= Y::bu() ?>support/base/category/<?= $model->category->id ?>">Вернуться к категории</a>
&nbsp; &nbsp; &nbsp; <a href="<?= Y::bu() ?>support/base">Список категорий</a>
&nbsp; &nbsp; &nbsp; <a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>