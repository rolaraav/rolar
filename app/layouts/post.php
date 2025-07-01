<?php defined('A') or die('Access denied'); ?>
<?php
if (isset($post)):
  //debug($post);

  switch((int)$post['type']){
    case(1): // новости
      require_once('post_news.php');
      break;
    case(2): // партнёрские продукты
      require_once('post_partner_product.php');
      break;
    case(3): // закачки
      require_once('post_download.php');
      break;
    case(4): // товары
      require_once('post_product.php');
      break;
    case(5): // галереи
      require_once('post_gallery.php');
      break;
    case(6): // альбомы музыкальные
      require_once('post_album.php');
      break;
    case(7): // альбомы видео
      require_once('post_album.php');
      break;
    default: // посты короткие
      //require_once('post.php');
  }

else:?>
  <div class="blocktext">Такой новости пока нет!</div>
<?php endif; ?>
