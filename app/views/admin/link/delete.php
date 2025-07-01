<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($link);
if (empty($link)): ?>
    <div>Такой ссылки не существует.</div>
<?php else: ?>
<div class="center red"><strong>Внимание! Восстановить ссылку будет невозможно!</strong></div><br><br>
    <form action="" method="post" name="delete_link">

        <div class="cpinput form-group" id="delete_link_secret">
            <div class="delete_link">Сделать ссылку секретной?</div>
            <div class="row">
                <div class="form-check col-sm-1">
                    <input <?php echo $secret1; ?>class="form-check-input" disabled="disabled" id="delete_link_secret_yes" name="secret" title="Сделать ссылку секретной?" type="radio" value="1"><label class="form-check-label" for="delete_link_secret_yes"> Да</label>
                </div>
                <div class="form-check col-sm-1">
                    <input <?php echo $secret0; ?>class="form-check-input" disabled="disabled" id="delete_link_secret_no" name="secret" title="Сделать ссылку секретной?" type="radio" value="0"><label class="form-check-label" for="delete_link_secret_no"> Нет</label>
                </div>
            </div>
        </div>

        <div class="cpinput form-group" id="delete_link_ref">
            <div class="delete_link">Сделать ссылку реферальной (партнёрской)?</div>
            <div class="row">
                <div class="form-check col-sm-1">
                    <input <?php echo $ref1; ?>class="form-check-input" disabled="disabled" id="delete_link_ref_yes" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="1"><label class="form-check-label" for="delete_link_ref_yes"> Да</label>
                </div>
                <div class="form-check col-sm-1">
                    <input <?php echo $ref0; ?>class="form-check-input" disabled="disabled" id="delete_link_ref_no" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="0"><label class="form-check-label" for="delete_link_ref_no"> Нет</label>
                </div>
            </div>
        </div>

        <div class="cpinput form-group" id="delete_link_published">
            <div class="delete_link">Опубликовать ссылку?</div>
            <div class="row">
                <div class="form-check col-sm-1">
                    <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_link_published_yes" name="published" title="Опубликовать ссылку?" type="radio" value="1"><label class="form-check-label" for="delete_link_published_yes"> Да</label>
                </div>
                <div class="form-check col-sm-1">
                    <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_link_published_no" name="published" title="Опубликовать ссылку?" type="radio" value="0"><label class="form-check-label" for="delete_link_published_no"> Нет</label>
                </div>
            </div>
        </div>

        <div class="cpinput form-group" id="delete_link_title">
            <label class="form-label" for="delete_link_title_field">Название ссылки:</label>
            <input class="delete_link form-control" disabled="disabled" id="delete_link_title_field" maxlength="255" name="title" placeholder="Название ссылки" size="100" title="Название ссылки" type="text" value="<?php echo $link['title'];?>">
            <div class="form-text"></div>
        </div>

        <div class="cpinput form-group" id="delete_link_link">
            <label class="form-label" for="delete_link_link_field">Адрес ссылки:</label>
            <input class="delete_link form-control" disabled="disabled" id="delete_link_link_field" maxlength="255" name="link" placeholder="Адрес ссылки" size="100" title="Адрес ссылки" type="text" value="<?php echo $link['link'];?>">
            <div class="form-text"></div>
        </div>

        <div class="cpinput form-group" id="delete_link_short_link">
            <label class="form-label" for="delete_link_short_link_field">Короткий адрес ссылки (если есть):</label>
            <input class="delete_link form-control" disabled="disabled" id="delete_link_short_link_field" maxlength="255" name="short_link" placeholder="Короткий адрес ссылки" size="100" title="Короткий адрес ссылки" type="text" value="<?php echo $link['short_link'];?>">
            <div class="form-text"></div>
        </div>

        <div class="cpinput form-group" id="delete_link_transitions">
            <label class="form-label" for="delete_link_transitions_field">Количество переходов по ссылке:</label>
            <input class="delete_link form-control" disabled="disabled" id="delete_link_transitions_field" maxlength="7" name="transitions" placeholder="Количество переходов по ссылке" size="7" title="Количество переходов по ссылке" type="text" value="<?php if (empty($link['transitions'])) {echo '0';} else {echo $link['transitions'];}?>">
            <div class="form-text"></div>
        </div>

        <div class="center red"><strong>Внимание! Восстановить ссылку будет невозможно!</strong></div><br><br>
        <div class="cpinput_button"><input class="button delete" id="submit_link" name="submit_link" type="submit" value="Удалить ссылку"></div>
    </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
