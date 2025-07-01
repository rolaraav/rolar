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
if(isset($_SESSION['user']['success'])){
    echo '<div class="alert alert-success">'.$_SESSION['user']['success'].'</div>';
    unset($_SESSION['user']['success']);
  }
/*
if (isset($_SESSION['user'])) {
    //echo 'массив $_SESSION[\'user\']<br>';
    debug($_SESSION['user']);
    //unset($_SESSION['user']['success']);
    //unset($_SESSION['user']['error']);
}

if (isset($user)) {
  //echo 'массив пользователя user:<br>';
  debug($user);
}

if(isset($authorization)) {
    echo $authorization; // форма авторизации
}
*/
?>
<div id="authorization_info">Вы вошли на сайт, как <strong><?=$this->user['login'] ? $this->user['login'] : 'Гость';?></strong></div>
</div>

<div class="clear"></div>
</div>
</div>