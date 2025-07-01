<?php defined('A') or die('Access denied');?>
<div id="get_email_form">
<a href="" class="close" target="_self"></a>
<h1>Введите Ваш email:</h1>
<form method="post" name="email_form" target="_self">
  <label><input autofocus="autofocus" id="email" maxlength="40" name="semail" placeholder="Введите Ваш email" size="20" title="Например: aleksey@mail.ru" type="text">
  <img class="inputIcon" src="<?=I.S;?>popuper/mail.png"><div id="email_valid">&nbsp;</div></label>
  <button class="button rounded" disabled="disabled" id="email_submitButton" name="email_submitButton" type="submit">Далее</button>
</form>
</div>
<div id="get_email_formOverlayer"></div>
<script language="javascript" type="text/javascript">
var email_form = $("#get_email_form");
var email_formOverlayer = $("#get_email_formOverlayer");
//alert (email_form);
//alert (email_formOverlayer);
email_form.css({'display':'block'});
email_formOverlayer.css({'display':'block'});
var pattern = /([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i;
var mail = $('input[name=semail]');
mail.blur(function(){
    if(mail.val() != ''){
        if(mail.val().search(pattern) == 0){
			$('#email_valid').text('Подходит').css({'color':'green'});
			$('#email_submitButton').attr('disabled', false);
            mail.removeClass('er').addClass('ok');
		}else{
			$('#email_valid').text('Не подходит').css({'color':'red'});
			$('#email_submitButton').attr('disabled', true);
            mail.addClass('ok');
		}
	}else{
		$('#email_valid').text('Поле email не должно быть пустым!').css({'color':'red'});
		mail.addClass('er');
        $('#email_submitButton').attr('disabled', true);
	}
});
</script>