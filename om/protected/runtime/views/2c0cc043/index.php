<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views/catalog/index.php */ ?>
<?php $this->pageTitle='Каталог товаров' ?>

<div id="usualCart">

 <?php $this->renderPartial('/catalog/_ajaxcart', array(), false, true); ?>

</div>

<div class="wrap">

<style type="text/css">
	hr {border: 1px dotted #AAA}
</style>

<h3>Каталог товаров</h3>

<h1>Каталог товаров</h1>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<?php foreach ($categories as $category): ?>

<p style="font-size:14px">
<a href="<?= Y::bu() ?>catalog/category/id/<?= $category->id ?>">
<strong><?= $category->title ?> (<?= $category->catGoodCount ?>)</strong>
</a></p>

<p>&nbsp;</p>

<p><?= nl2br($category->description) ?></p>

<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>

<?php endforeach; ?>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>aff/" target="_blank">Партнёрская программа</a></p>
</div>