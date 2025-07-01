<?php defined('A') or die('Access denied'); ?>
<div class="block">
  <div class="blockhead"></div>
  <div class="blockbody">

    <?php if(isset($breadcrumbs)){
      echo $breadcrumbs;
    }
    ?>

    <div class="center">
      <img src="<?=I.S;?>templates/all/fail.gif">
    </div>

    <div class="blocktext">

    <h1>Оплата не была произведена!</h1>

    <div class="pgtext">
      <p><b>Оплата не была произведена и товар Вам не будет выслан.</b></p>
      <p>Если возникнут трудности - свяжитесь с <a href="mailto:<?=ADMINEMAIL;?>" target="_blank">администратором</a>.</p>
      <p>Вернуться на сайт <a href="<?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>"><?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?></a>.</p>
    </div>

    </div>

    <div class="clear"></div>
  </div>
</div>
