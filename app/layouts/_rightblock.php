<?php defined('A') or die('Access denied');?>
<!-- Правый блок (начало) -->
<div class="rightblock order-lg-3">
<?php
/*if(isset($wmr_bonus)) {
  echo $wmr_bonus;
}
if(isset($ewm_widget)) {
  echo $ewm_widget;
} */

if(isset($random_news)) {
  echo $random_news;
}
if(isset($last_news)) {
  echo $last_news;
}
if(isset($popular_news)) {
  echo $popular_news;
}

if(isset($archive)) {
  echo $archive;
}

if(isset($ref_links)) {
  echo $ref_links;
}
if(isset($partner_links)) {
  echo $partner_links;
}
//if(isset($download_links)) {
//  echo $download_links;
//}
if(isset($internet_links)) {
  echo $internet_links;
}
?>
</div><!-- Правый блок (конец) -->