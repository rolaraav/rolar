<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<?php
echo '<h1>'.$page['title'].'</h1>';
echo $image.$page['text'];

if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
}
if (isset($_SESSION['secret_access']) and ($_SESSION['secret_access'] == true)): ?>
  <p>Доступ к секретным материалам для Вас открыт! Вы можете скачивать файлы из секретных материалов!</p>
  <?php if($user['login'] == 'rolar'):?>
    <form action="" name="clear_secret" method="post">
      <p class="secret"><input id="clear_secret_submit" class="button" name="clear_secret" type="submit" value="Закрыть доступ"></p>
    </form>
  <?php endif;?>
<?php else:?>
  <p>Для получения <span class="full_access" title="На скачивание метериалов">полного доступа</span> необходимо <a href="<?=D.S;?>secret#form" target="_self">подписаться</a> на рассылку новостей этого сайта, и Вам на почту придёт письмо с <strong>Кодом подписчика</strong>.</p>
  <form action="" name="secret" method="post"><fieldset id="secret">
  <p class="secret"><strong>Введите код подписчика</strong></p>
  <p class="secret"><input id="secret_code_input" class="sinput" maxlength="40" name="secret_code" title="Введите код подписчика" type="password" value="<?php if($user['login'] == 'rolar') {echo CODE;}?>"></p>
  <p class="secret"><input id="secret_code_submit" class="button" name="secret_code_submit" type="submit" value="Получить доступ"></p>
  <p class="secret"><img alt="Доступ закрыт" src="<?=I.S;?>secret/zamok.png" hight="182px" weight="254px"></p>
  </fieldset></form>
  <p><a name="form"></a>Чтобы получить код подписчика необходимо ввести свои имя и адрес электронной почты в форме ниже:</p>
    <!--noindex-->
  <?php if(isset($subscription)) {
    echo $subscription; // рассылка новостей
  }
  ?>
    <!--/noindex-->
<?php endif; ?>
<div class="clear"></div>
</div>

<div class="clear"></div>
</div>
</div>

<?php
if(isset($pagination)) {
  echo $pagination;
}
?>
  <div class="paginal_navigation">Пост <?php echo count($posts);?> из <?php echo $this->total_posts_pagination;?></div>
<?php
if(isset($posts)) {
  echo $posts;
}

if(isset($pagination)) {
  echo $pagination;
}

if(isset($half_blocks)) {
  echo $half_blocks;
}
else {
  echo $categories_list;
}
?>