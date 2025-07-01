<?php defined('A') or die('Access denied');?>
<!-- Modal Window -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="registerlabel">Запишись на обучение</h4>
        <!-- <h4 class="modal-title" id="check_document_label" aria-labelledby="modalLabel" aria-hidden="true">Проверить документ</h4> -->
      </div>
      <div class="modal-body">
        <!-- <p>Основной блок текста&hellip;</p> -->

        <form action="" class="bootstrap_validator" class="" id="register_form" role="form" method="post">
        <input id="formcheck" name="formcheck" type="hidden" value="">
        <input id="registration_utm" name="utm" type="hidden" value="register">

        <div class="form-group has-feedback">
        <label for="name">Фамилия Имя Отчество</label>
        <input class="name form-control" id="name" maxlength="255" name="name" placeholder="Иванов Иван Иванович" size="50" type="text">
        <span class="glyphicon form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
        <label for="phone">Номер телефона</label>
        <input class="phone form-control" id="phone" maxlength="11" name="phone" placeholder="7987654321" size="20" type="tel">
        <span class="glyphicon form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
        <label for="email">Электронная почта</label>
        <input class="email form-control" id="email" maxlength="255" name="email" placeholder="email@email.com" size="30" type="email">
        <span class="glyphicon form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
        <label for="location">Место проживания (город, посёлок, деревня и пр.)</label>
        <input class="location form-control" id="location" maxlength="255" name="location" placeholder="Мелеуз" size="30" type="text">
        <span class="glyphicon form-control-feedback"></span>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" checked="checked" type="checkbox" value="1">
            Нажимая кнопку «Запишись на обучение», я подтверждаю, что я ознакомлен с условиями <a href="policy" target="_blank">политики обработки персональных данных</a> и даю своё согласие на обработку моих персональных данных.
          </label>
        </div>

        <!-- <div class="form-group">
        <label for="captcha">Код с картинки</label><br>
        <img border="0" class="captcha_image" width="90" height="45" src="<?=D.I;?>">
        <span class="reload_captcha" onclick="">обновить</span>
        <input autocomplete="off" class="captcha form-control" id="captcha" name="captcha" placeholder="" size="5" type="text">
        </div> -->

        <div class="form-group">
        <input class="btn btn-primary pull-right" id="register_submit_button" name="register_submit" type="submit" value="Запишись на обучение"><br>
        <i style="font-size:12px;color:#585858">Все поля обязательны для заполнения</i>
        </div>

        </form>

      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить изменения</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->