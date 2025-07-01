<?php defined('A') or die('Access denied');?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<h1><?php if(isset($title)){echo $title;} ?></h1>
<?php
if(isset($subscription)) {
    echo $subscription; // форма подписки
}
?>
</div>

<div class="clear"></div>
</div>
</div>