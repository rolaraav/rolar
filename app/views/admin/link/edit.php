<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($link);
if (empty($link)): ?>
  <div>Такой ссылки не существует.</div>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<?php else: ?>
<form action="" method="post" name="edit_link">

    <div class="cpinput form-group" id="edit_link_secret">
        <div class="edit_link">Сделать ссылку секретной?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $secret1; ?>class="form-check-input" id="edit_link_secret_yes" name="secret" title="Сделать ссылку секретной?" type="radio" value="1"><label class="form-check-label" for="edit_link_secret_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $secret0; ?>class="form-check-input" id="edit_link_secret_no" name="secret" title="Сделать ссылку секретной?" type="radio" value="0"><label class="form-check-label" for="edit_link_secret_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_link_ref">
        <div class="edit_link">Сделать ссылку реферальной (партнёрской)?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $ref1; ?>class="form-check-input" id="edit_link_ref_yes" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="1"><label class="form-check-label" for="edit_link_ref_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $ref0; ?>class="form-check-input" id="edit_link_ref_no" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="0"><label class="form-check-label" for="edit_link_ref_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_link_published">
        <div class="edit_link">Опубликовать ссылку?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $published1; ?>class="form-check-input" id="edit_link_published_yes" name="published" title="Опубликовать ссылку?" type="radio" value="1"><label class="form-check-label" for="edit_link_published_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $published0; ?>class="form-check-input" id="edit_link_published_no" name="published" title="Опубликовать ссылку?" type="radio" value="0"><label class="form-check-label" for="edit_link_published_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_link_title">
        <label class="form-label" for="edit_link_title_field">Введите название ссылки<span class="red1">*</span>:</label>
        <input class="edit_link form-control" id="edit_link_title_field" maxlength="255" name="title" placeholder="Название ссылки" size="100" title="Введите название ссылки" type="text" value="<?php echo $link['title'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_link_link">
        <label class="form-label" for="edit_link_link_field">Введите адрес ссылки<span class="red1">*</span>:</label>
        <input class="edit_link form-control" id="edit_link_link_field" maxlength="255" name="link" placeholder="Адрес ссылки" size="100" title="Введите адрес ссылки" type="text" value="<?php echo $link['link'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_link_short_link">
        <label class="form-label" for="edit_link_short_link_field">Короткий адрес ссылки (если есть):</label>
        <div class="edit_link input-group">
        <input class="edit_link form-control" id="edit_link_short_link_field" maxlength="255" name="short_link" readonly="readonly" placeholder="Короткий адрес ссылки" size="100" title="Короткий адрес ссылки" type="text" value="<?php echo $link['short_link'];?>">
        <div class="input-group-append">
            <input class="button btn btn-outline-secondary" id="edit_link_short_link_generate" name="short_link_generate" type="button" value="Обновить">
        </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_link_transitions">
        <label class="form-label" for="edit_link_transitions_field">Количество переходов по ссылке:</label>
        <div class="edit_link input-group">
        <input class="edit_link form-control" id="edit_link_transitions_field" maxlength="7" name="transitions" readonly="readonly" placeholder="Количество переходов по ссылке" size="7" title="Количество переходов по ссылке" type="text" value="<?php if (empty($link['transitions'])) {echo '0';} else {echo $link['transitions'];}?>">
        <div class="input-group-append">
            <input class="button btn btn-outline-secondary" id="edit_link_transitions_reset" name="transitions_reset" type="button" value="Обнулить">
        </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
    <div class="cpinput_button"><input class="button" id="submit_link" name="submit_link" type="submit" value="Сохранить ссылку"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
