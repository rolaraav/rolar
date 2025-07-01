<?php $this->pageTitle='База знаний - Служба Поддержки' ?>

<div class="wrap">

<style type="text/css">
	hr {border: 1px dotted #AAA}
</style>

<h3>Служба Поддержки - База Знаний</h3>

<h1>База знаний</h1>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<?php foreach ($categories as $category): ?>

<p style="font-size:14px">
<a href="<?= Y::bu() ?>support/base/category/<?= $category->id ?>">
<strong><?= $category->title ?> (<?= $category->articleCount ?>)</strong>
</a></p>

<p>&nbsp;</p>

<p><?= nl2br($category->description) ?></p>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<?php endforeach; ?>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>