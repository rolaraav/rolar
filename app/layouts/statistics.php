<?php defined('A') or die('Access denied');?>
<div class="statistic">
<div class="statistic_head">Сейчас на сайте:</div>
<?php if (isset($total)): ?>
<?php if (isset($prefix) and ($prefix == 'admin')): ?>
  <div class="statistic-item"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Cтатей: <?=$total['news'];?></div>
  <div class="statistic-item"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Рубрик новостей: <?=$total['rubs'];?></div>
  <div class="statistic-item"><i class="fa fa-handshake-o" aria-hidden="true"></i> Партнёрских продуктов: <?=$total['partner_products'];?></div>
  <div class="statistic-item"><i class="fa fa-files-o" aria-hidden="true"></i> Файлов: <?=$total['downloads'];?></div>
  <div class="statistic-item"><i class="fa fa-question-circle" aria-hidden="true"></i> Секретных материалов: <?=$total['secret'];?></div>
  <div class="statistic-item"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Обучающих курсов: <?=$total['courses'];?></div>
  <div class="statistic-item"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Товаров: <?=$total['goods'];?></div>
  <div class="statistic-item"><i class="fa fa-picture-o" aria-hidden="true"></i> Галерей: <?=$total['galleries'];?></div>
  <div class="statistic-item"><i class="fa fa-music" aria-hidden="true"></i> Альбомов: <?=$total['albums'];?></div>
  <div class="statistic-item"><i class="fa fa-file-text-o" aria-hidden="true"></i> Категорий: <?=$total['categories'];?></div>
  <div class="statistic-item"><i class="fa fa-handshake-o" aria-hidden="true"></i> Партнёров: <?=$total['partners'];?></div>
  <div class="statistic-item"><i class="fa fa-list-alt" aria-hidden="true"></i> Заметок: <?=$total['posts'];?></div>
  <div class="statistic-item"><i class="fa fa-comments-o" aria-hidden="true"></i> Комментариев: <?php echo $total['comments'];?></div>
  <div class="statistic-item"><i class="fa fa-comments-o" aria-hidden="true"></i> Комментариев2: <?php echo $total['comments2'];?></div>
  <div class="statistic-item"><i class="fa fa-quote-right" aria-hidden="true"></i> Мудрых фраз: <?=$total['phrases'];?></div>
  <div class="statistic-item"><i class="fa fa-link" aria-hidden="true"></i> Ссылок: <?=$total['links'];?></div>
  <div class="statistic-item"><i class="fa fa-object-group" aria-hidden="true"></i> Баннеров: <?=$total['banners'];?></div>
  <div class="statistic-item"><i class="fa fa-file-o" aria-hidden="true"></i> Страниц: <?=$total['pages'];?></div>
  <div class="statistic-item"><i class="fa fa-users" aria-hidden="true"></i> Всех пользователей: <?=$total['users'];?></div>
  <div class="statistic-item"><i class="fa fa-users" aria-hidden="true"></i> Зарегистрированных пользователей: <?=$total['reg_users'];?></div>
  <div class="statistic-item"><i class="fa fa-address-card-o" aria-hidden="true"></i> Подписчиков: <?=$total['subscribers'];?></div>
  <div class="statistic-item"><i class="fa fa-commenting-o" aria-hidden="true"></i> Сообщений: <?=$total['messages'];?></div>
<?php else: ?>
  <div class="statistic-item"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Cтатей: <?=$total['news'];?></div>
  <div class="statistic-item"><i class="fa fa-handshake-o" aria-hidden="true"></i> Партнёрских продуктов: <?=$total['partner_products'];?></div>
  <div class="statistic-item"><i class="fa fa-files-o" aria-hidden="true"></i> Файлов: <?=$total['downloads'];?></div>
  <div class="statistic-item"><i class="fa fa-question-circle" aria-hidden="true"></i> Секретных материалов: <?=$total['secret'];?></div>
  <div class="statistic-item"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Обучающих курсов: <?=$total['courses'];?></div>
  <div class="statistic-item"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Товаров: <?=$total['goods'];?></div>
  <div class="statistic-item"><i class="fa fa-picture-o" aria-hidden="true"></i> Галерей: <?=$total['galleries'];?></div>
  <div class="statistic-item"><i class="fa fa-music" aria-hidden="true"></i> Альбомов: <?=$total['albums'];?></div>
  <div class="statistic-item"><i class="fa fa-file-text-o" aria-hidden="true"></i> Категорий: <?=$total['categories'];?></div>
  <div class="statistic-item"><i class="fa fa-handshake-o" aria-hidden="true"></i> Партнёров: <?=$total['partners'];?></div>
  <div class="statistic-item"><i class="fa fa-list-alt" aria-hidden="true"></i> Заметок: <?=$total['posts'];?></div>
  <div class="statistic-item"><i class="fa fa-comments-o" aria-hidden="true"></i> Комментариев: <?php echo $total['comments']+$total['comments2'];?></div>
  <div class="statistic-item"><i class="fa fa-quote-right" aria-hidden="true"></i> Мудрых фраз: <?=$total['phrases'];?></div>
  <div class="statistic-item"><i class="fa fa-file-o" aria-hidden="true"></i> Страниц: <?=$total['pages'];?></div>
  <div class="statistic-item"><i class="fa fa-users" aria-hidden="true"></i> Пользователей: <?=$total['users'];?></div>
  <div class="statistic-item"><i class="fa fa-address-card-o" aria-hidden="true"></i> Подписчиков: <?=$total['subscribers'];?></div>
<?php endif?>
<?php endif;?>
<div class="statistic-item"><i class="fa fa-id-card-o" aria-hidden="true"></i> Посетителей на сайте: <?=$online_users;?></div>
</div>