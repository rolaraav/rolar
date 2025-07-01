<?php $this->pageTitle='Главная' ?>

<div class="wrap">

    <h3>Закрытая Зона</h3>

    <h1><?= Y::user()->areaTitle ?></h1>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<style type="text/css">
	hr {border: 1px dotted #AAA}
</style>

<?php foreach ($sections as $category): ?>

<p style="font-size:14px">
<a href="<?= Y::bu() ?>area/areaitem/index/id/<?= $category->id ?>">
<strong><?= $category->title ?> (<?= $category->itemCount ?>)</strong>
</a></p>

<p>&nbsp;</p>

<p><?= nl2br($category->description) ?></p>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<?php endforeach; ?>

</div>