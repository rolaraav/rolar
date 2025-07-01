<?php defined('A') or die('Access denied');?>
<div class="block">
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
<hr><!--noindex-->
<?php
if (isset($social_buttons)) {
  echo $social_buttons;
} ?>
<hr>
<?php
if (isset($subscription)) {
  echo $subscription;
} ?>
<hr>
<?php
if (isset($social_comments)) {
  echo $social_comments;
} ?>
<hr><!--/noindex-->
<?php if (isset($comments_block)) {
  echo $comments_block;
} ?>
</div>
</div>
<?php if(isset($half_blocks)) {
  echo $half_blocks;
} ?>
