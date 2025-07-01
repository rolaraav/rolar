<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>

<div class="blocktext">

<?php if (isset($date_li)) {
  echo $date_li;
};

if (isset($text)) {
  echo $text;
};

?>
</div>

<div class="clear"></div>
</div>
</div>

<?php
if(isset($posts)) {
  echo $posts;
}

if(isset($half_blocks)) {
  echo $half_blocks;
}
?>