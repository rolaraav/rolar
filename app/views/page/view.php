<?php
echo 'View';
?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)): ?>
  <?=$breadcrumbs;?>

  <br>
  <nav class="breadcrumb" aria-label="breadcrumb">
  <a class="breadcrumb-item" href="<?=D.S;?>" title="Главная">Главная</a>
  <a class="breadcrumb-item" href="<?=D.S;?>news/" title="Заголовок категории">Заголовок категории</a>
  <a class="breadcrumb-item active" href="news.php?rub=$rub" title="Заголовок новости">Заголовок новости</a>
  </nav>

<?php endif;?>

<div class="blocktext">

<h1>Добро пожаловать!</h1>
<div class="articleblockimage">
  <a class="fancybox" href="<?=I.S;?>data/welcome/welcome.png" target="_blank" title="Добро пожаловать!">
    <img alt="Добро пожаловать!" class="articleimage" src="<?=I.S;?>data/welcome/welcome_th.png" title="Добро пожаловать!"></a></div>

</div>

</div>
</div>
