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

</div>

<div class="clear"></div>
</div>
</div>