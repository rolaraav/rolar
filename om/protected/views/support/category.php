<?php $this->pageTitle='База знаний - ' . $model->title ?>

<div class="wrap">

<h3>Служба Поддержки - База Знаний</h3>

<h1><?=$model->title ?></h1>

<p align="center"><img style="margin:15px;" src="<?= Y::bu() ?>images/front/support/base.jpg" /></p>

<p>&nbsp;</p>

<?php foreach ($model->articles as $article): ?>

<p style="font-size:13px"><a href="<?= Y::bu() ?>support/article/<?= $article->id ?>"><?= $article->title ?></a></p>
<br />

<?php endforeach; ?>


</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/base">Вернуться к списку категорий</a>
&nbsp; &nbsp; &nbsp; <a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>
