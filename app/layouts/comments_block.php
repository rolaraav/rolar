<?php defined('A') or die('Access denied'); ?>
<div class="comments_wrap">
  <div class="comments">Комментарии:</div>
<?php
if(isset($comments)) {
  echo $comments; // если есть комментарии то выводим их
}
?>
  <div class="comments">Оставить комментарий</div>
  <form action="<?=D; // S.'post'.$post['id'] ?>" method="post" name="form_com" target="_self">
  <fieldset class="comment_add">
  <?php
  // если пользователь зашел на сайт, то поля ввода имени, электронной почты и сайта не выводим
  if (isset($user['login'])): ?>
    <input id="comment_author_name_field" name="comment_author" type="hidden" value="<?=$user['login'];?>">
    <input id="comment_author_email_field" name="author_email" type="hidden" value="<?=$user['email'];?>">
    <input id="comment_author_site_field" name="author_site" type="hidden" value="<?=$user['site'];?>">
  <?php
  else: //то выводим поля ввода имени, емайла и сайта ?>
    <div class="commentadd form-group" id="comment_author_name">
      <label class="comment_label" for="comment_author_name_field">Ваше имя<span class="red">*</span>:</label>
      <input class="comment_input form-control" id="comment_author_name_field" maxlength="30" name="comment_author" placeholder="Введите Ваше имя" size="40" title="Введите Ваше имя" type="text" value="<?=isset($_SESSION['comment_data']['comment_author']) ? $_SESSION['comment_data']['comment_author'] : '';?>">
      <?php if (!empty($_SESSION['comment_errors']['comment_author'])): ?>
      <div class="error">* <?php echo $_SESSION['comment_errors']['comment_author']; ?></div>
      <?php endif; ?>
    </div>
    <div class="commentadd form-group" id="comment_author_email">
      <label class="comment_label" for="comment_author_email_field">Ваш e-mail<span class="red">*</span>:</label>
      <input class="comment_input form-control" id="comment_author_email_field" maxlength="100" name="author_email" placeholder="Введите Ваш e-mail" size="40" title="Введите Ваш e-mail" type="email" value="<?=isset($_SESSION['comment_data']['author_email']) ? $_SESSION['comment_data']['author_email'] : '';?>">
      <?php if (!empty($_SESSION['comment_errors']['author_email'])): ?>
      <div class="error">* <?php echo $_SESSION['comment_errors']['author_email']; ?></div>
      <?php endif; ?>
      <div class="help-block">Ваш e-mail необходим только для связи с Вами и не публикуется на сайте</div>
    </div>
    <div class="commentadd form-group" id="comment_author_site">
      <label class="comment_label" for="comment_author_site_field">Ваш сайт (страница в соц. сетях):</label>
      <input class="comment_input form-control" id="comment_author_site_field" maxlength="100" name="author_site" placeholder="Введите адрес Вашего сайта (если есть)" size="40" title="Введите адрес Вашего сайта (если есть)" type="url" value="<?=isset($_SESSION['comment_data']['author_site']) ? $_SESSION['comment_data']['author_site'] : '';?>">
      <?php if (!empty($_SESSION['comment_errors']['author_site'])): ?>
      <div class="error">* <?php echo $_SESSION['comment_errors']['author_site']; ?></div>
      <?php endif; ?>
    </div>
  <?php
  endif;?>
  <div class="commentadd form-group">
      <label class="comment_label" for="comment_text_field">Ваш комментарий<span class="red">*</span>:</label>
      <textarea class="comment_text form-control" id="comment_text_field" maxlength="5000" name="comment_text" cols="75" rows="10" placeholder="Введите Ваш комментарий" title="Введите Ваш комментарий"><?=isset($_SESSION['comment_data']['comment_text']) ? $_SESSION['comment_data']['comment_text'] : '';?></textarea>
    <?php if (!empty($_SESSION['comment_errors']['comment_text'])): ?>
        <div class="error">* <?php echo $_SESSION['comment_errors']['comment_text']; ?></div>
    <?php endif; ?>
  </div>

  <div class="commentadd form-group">
      <label class="comment_label" for="checksum">Введите сумму чисел с картинки<span class="red">*</span>:</label><div class="clear"></div>
      <div class="input-group">
      <img alt="Введите сумму чисел с картинки" id="checksumimage" src="<?php echo I.S.'captcha/'.$random.'.gif'; ?>" width="40" height="20" title="Введите сумму чисел с картинки">&nbsp;=&nbsp;
      <input class="comment_input" id="checksum" maxlength="1" name="checksum" size="1" title="Введите сумму чисел с картинки" type="text">
      </div>
    <?php if (!empty($_SESSION['comment_errors']['checksum'])): ?>
    <div class="error">* <?php echo $_SESSION['comment_errors']['checksum']; ?></div>
    <?php endif; ?>
  </div>

  <input id="type" name="type" type="hidden" value="<?=isset($post['type']) ? (int)$post['type'] : 0;?>">
  <input id="post_id" name="post_id" type="hidden" value="<?=isset($post['id']) ? (int)$post['id'] : 0;?>">
  <input id="gallery_id" name="gallery_id" type="hidden" value="<?=isset($post['gallery_id']) ? (int)$post['gallery_id'] : 0;?>">
  <input id="image_id" name="image_id" type="hidden" value="<?=isset($post['image_id']) ? (int)$post['image_id'] : 0;?>">
  <input id="album_id" name="album_id" type="hidden" value="<?=isset($post['album_id']) ? (int)$post['album_id'] : 0;?>">
  <input id="parent_id" name="parent_id" type="hidden" value="<?=isset($post['parent_id']) ? (int)$post['parent_id'] : 0;?>">

  <input id="random" name="random" type="hidden" value="<?php echo $random; ?>">
  <input id="comment_token" name="comment_token" type="hidden" value="<?php if (isset($comment_token)) {echo $comment_token;}?>">

  <div class="commentadd form-group">
      <input class="button btn btn-outline-secondary" id="comment_submit_button" name="comment_submit" type="submit" value="Отправить">
  </div>

  <div class="help-block"><span class="red">*</span> Звёздочкой помечены обязательные поля для заполнения</div>
  </fieldset></form>
  <?php
  if (isset($_SESSION['comment_result'])) {
    echo $_SESSION['comment_result'];
  }
  unset($_SESSION['comment_result'],$_SESSION['comment_data'],$_SESSION['comment_errors']);
?>
</div>
