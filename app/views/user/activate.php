<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
} ?>
<h1><?php if(isset($title)){echo $title;} ?></h1>
<div class="blocktext">
<?php // здесь отображаются сообщения об активации
if (isset($_SESSION['activation_result'])){
  echo $_SESSION['activation_result'];
  unset($_SESSION['activation_result']);
}
else {
    echo '<div class="alert alert-danger">Вы зашли на страницу активации без логина, адреса электронной почты и кода подтверждения</div>';
}
unset($_SESSION['activation_errors']);
?>
<br>Перейти на <a href="<?=D;?>" target="_top">главную страницу</a>.</div>
<script language="javascript" type="text/javascript">setTimeout("document.location.href='<?=D;?>'", 60000);</script>

<div class="clear"></div>
</div>
</div>