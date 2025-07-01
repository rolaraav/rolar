<?php defined('A') or die('Access denied'); ?>
<div class="block">
  <div class="blockhead"></div>
  <div class="blockbody">

    <?php if(isset($breadcrumbs)){
      echo $breadcrumbs;
    }
    ?>

    <div class="center">
      <img src="<?=I.S;?>templates/all/ok.gif">
    </div>

    <div class="blocktext">

    <h1>Благодарим! Оплата произведена успешно!</h1>

    <div class="pgtext">
      <p><b>Сразу после зачисления платежа Вы получите уведомление на E-mail.</b></p>
      <p>Если возникнут трудности - свяжитесь с <a href="mailto:<?=ADMINEMAIL;?>" target="_blank">администратором</a>.</p>
      <p>Вернуться на сайт <a href="<?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>"><?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?></a>.</p>
    </div>

    </div>

    <div class="clear"></div>
  </div>
</div>
