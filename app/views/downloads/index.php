<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>

<div class="blocktext">


<div class="articleblockimage">
  <a class="fancybox" href="<?=I.S;?>data/welcome/welcome.png" target="_blank" title="Добро пожаловать!">
    <img alt="Добро пожаловать!" class="articleimage" src="<?=I.S;?>data/welcome/welcome_th.png" title="Добро пожаловать!"></a>
</div>

<?php echo $page['text']; ?>
<hr>
<?php /*require_once '_social_buttons.php';*/ ?>

</div>

</div>
</div>