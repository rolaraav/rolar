<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<h1><?php echo $title; ?></h1>
<?php echo $text; ?>
<?php if (isset($all_links)): ?>
<h3>Внешние ссылки на прочие сайты в новостях,<br>описаниях партнёров и их продуктов<br>и материалах для скачивания</h3><ol>
  <?php foreach($all_links as $item): ?>
  <li><a<?=$item['ref'];?> href="<?=D.S.'l'.$item['id'];?>" target="_blank" title="<?=$item['title'];?>"><?=$item['link'];?></a> - <?=$item['title'];?> (<?=$item['transitions'];?>)</li>
  <?php endforeach; ?>
</ol><br>
<?php endif; ?>
<?php if(isset($all_partner_links)): ?>
<h3>Внешние партнёрские ссылки на информационные продукты партнёров</h3><ol>
  <?php foreach($all_partner_links as $item): ?>
  <li><a class="green_link" href="<?=D.S.'pl'.$item['id'];?>" target="_blank" title="<?=$item['title'];?>"><?=$item['partner_link'];?></a> - <?=$item['title'];?> (<?=$item['transitions'];?>)</li>
  <?php endforeach; ?>
  </ol><br>
<?php endif; ?>
<?php if($this->user['login'] == 'rolar'): ?>
  <?php if(isset($all_internet_links)): ?>
  <h3>Внешние ссылки на скачивание файлов с сервиса Облако Mail.Ru</h3><ol>
    <?php foreach($all_internet_links as $item): ?>
    <li><!--noindex--><a href="<?=D.S.'il'.$item['id'].'?hash='.$item['hash'];?>" rel="nofollow" target="_blank" title="<?=$item['title'];?>"><?=$item['internet_link'];?></a> - <?=$item['title'];?> (<?=$item['internet_downloaded'];?>)<!--/noindex--></li>
    <?php endforeach; ?>
  </ol><br>
  <?php endif; ?>
  <?php if (isset($all_download_links)): ?>
  <h3>Внешние ссылки на скачивание файлов с ftp-сервера</h3><ol>
    <?php foreach($all_download_links as $item): ?>
    <li><!--noindex--><a href="<?=D.S.'dl'.$item['id'].'?hash='.$item['hash'];?>" rel="nofollow" target="_blank" title="<?=$item['title'];?>"><?=$item['download_link'];?></a> - <?=$item['title'];?> (<?=$item['downloaded'];?>)<!--/noindex--></li>
    <?php endforeach; ?>
  </ol><br>
  <?php endif; ?>
<?php endif; ?>
<?php if(isset($all_buy_links)): ?>
<h3>Внешние ссылки на оформление заказа</h3><ol>
  <?php foreach($all_buy_links as $item): ?>
  <li><a href="<?=D.S.'bl'.$item['id'];?>" target="_blank" title="<?=$item['title'];?>"><?=$item['buy_link'];?></a> - <?=$item['title'];?> (<?=$item['orders'];?>)</li>
  <?php endforeach; ?>
</ol><br>
<?php endif; ?>
<?php if(isset($all_banner_links)): ?>
<h3>Внешние ссылки на баннерах</h3><ol>
  <?php foreach($all_banner_links as $item): ?>
  <li><a href="<?=D.S.'ba'.$item['id'];?>" target="_blank" title="<?=$item['title'];?>"><?=$item['link'];?></a> - <?=$item['title'];?> (<?=$item['view'];?>/<?=$item['click'];?>)</li>
  <?php endforeach; ?>
</ol>
<?php endif; ?>
</div>

<div class="clear"></div>
</div>
</div>