<?php defined('A') or die('Access denied');?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
// подключение нужного шаблона
if (isset($post)) {
  echo $post;
} ?>
<hr>
<?php if (isset($rating)) {
  echo $rating;
} ?>
<!--noindex-->
<?php
if (isset($social_buttons)) {
  echo $social_buttons;
} ?>
<!--/noindex-->
<?php if (isset($subscription)) {
  echo $subscription;
}
if (isset($comments_block)) {
  echo $comments_block;
} ?>
<!--noindex-->
<?php if (isset($social_comments)) {
  echo $social_comments;
} ?>
<!--/noindex-->
<div class="clear"></div>
</div>
</div>
<?php if(isset($half_blocks)) {
  echo $half_blocks;
} ?>
