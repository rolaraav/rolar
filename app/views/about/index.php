<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>

<div class="blocktext">

<h1>Здравствуйте, уважаемый посетитель!</h1>
<div class="aboutblockimage"><a class="fancybox" href="<?=I.S;?>about/rolar.jpg" target="_blank" title="Артур Абзалов"><img alt="Артур Абзалов" class="aboutimage" src="<?=I.S;?>about/rolar_th.jpg" title="Артур Абзалов"></a></div>

<!-- <div class="articleblockimage">
  <a class="fancybox" href="<?=I.S;?>data/welcome/welcome.png" target="_blank" title="Добро пожаловать!">
    <img alt="Добро пожаловать!" class="articleimage" src="<?=I.S;?>data/welcome/welcome_th.png" title="Добро пожаловать!"></a>
</div> -->

<?php echo $page['text']; ?>
<hr>
<?php /*require_once '_social_buttons.php';*/ ?>

</div>

</div>
</div>

<div class="block"><div class="blockbody"><h1>Контакты</h1>
    <div class="phone">Позвонить: <a href="tel:+7-917-403-0284" target="_blank" title="Позвонить Артуру Абзалову">+7-917-403-0284</a></div>

    <div class="email">Написать на e-mail: <a href="mailto:admin@rolar.ru" target="_blank" title="Написать на e-mail">admin@rolar.ru</a></div><br>

    <div class="telegram">Telegram: <a href="<?=D.S;?>l599" target="_blank" title="Артур Абзалов в Telegram">@rolaraav</a> <em>https://t.me/rolaraav</em></div><br>

    <div class="vkontakte">Вконтакте: <a href="<?=D.S;?>l597" target="_blank" title="Артур Абзалов Вконтакте">https://vk.com/rolar</a></div><br>

    <div class="whatsapp">WhatsApp: <a href="<?=D.S;?>l600" target="_blank" title="Написать в WhatsApp Артуру Абзалову">+7-987-250-4631</a> <em>https://wa.me/7872504631?text=Привет, Артур</em></div><br>

    <div class="instagram">Instagram: <a href="<?=D.S;?>l601" target="_blank" title="Артур Абзалов в Instagram">@rolaraav</a> <em>https://www.instagram.com/rolaraav/</em></div><br>

    <div class="youtube">Канал на YouTube: <a href="<?=D.S;?>l602" target="_blank" title="Канал Артура Абзалова на YouTube">https://www.youtube.com/channel/UCiF_U2ocZUZ4xOrXCSFsyqQ</a> <a class="button btn btn-default red" href="<?=D.S;?>l603" target="_blank" title="Подписаться на youtube-канал Артура Абзалова">Подписаться</a></div><br>

    <div class="odnoklassniki">Одноклассники: <a href="<?=D.S;?>l604" target="_blank" title="Артур Абзалов в Одноклассниках">https://ok.ru/artur.abzalov</a></div><br>

    <div class="tiktok">TikTok: <a href="<?=D.S;?>l605" target="_blank" title="Артур Абзалов в TikTok">https://www.tiktok.com/@rolaraav</a></div><br>

    <div class="skype">Skype: <a href="skype:rolaraav?userinfo" target="_blank" title="Артур Абзалов в Skype">rolaraav</a></div><br>

    <div class="facebook">Facebook: <a href="<?=D.S;?>l606" target="_blank" title="Артур Абзалов в Facebook">https://www.facebook.com/artur.abzalov/</a></div><br>

    <div class="twitter">Twitter: <a href="<?=D.S;?>l607" target="_blank" title="Артур Абзалов в Twitter">https://twitter.com/rolaraav</a></div><br>

    <div class="boosty">Boosty: <a href="<?=D.S;?>l642" target="_blank" title="Артур Абзалов в Boosty"><img src="<?=I.S;?>about/boosty-donate.png" alt="Персональный сайт rolar.ru на Boosty.to"></a></div><br>

  <?php
  // функция определения мобильного устройства или компьютера https://qna.habr.com/q/139331
  function check_mobile_device() {
    $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    foreach ($mobile_agent_array as $value) {
      if (strpos($agent, $value) !== false) return true;
    };
    return false;
  };
  ?>
    <div class="viber">Viber:
      <?php if(check_mobile_device()) :?>
          <a href="viber://add?number=79872504631" target="_blank" title="Позвонить в Viber Артур Абзалов на телефоне">+7-987-250-4631</a> - на телефоне
      <?php else : ?>
          <a href="viber://chat?number=+79872504631" target="_blank" title="Позвонить в Viber Артур Абзалов на компьютере">+7-987-250-4631</a> - на компьютере
      <?php endif; ?>
    </div><br>

    <div class="icq">ICQ: <a href="<?=D.S;?>l608" target="_blank" title="Артур Абзалов в ICQ New">https://icq.im/rolar</a></div><br>

    <div class="linkedin">LinkedIn: <a href="<?=D.S;?>l609" target="_blank" title="Артур Абзалов в LinkedIn (первый аккаунт)">https://www.linkedin.com/in/артур-абзалов-0501a3a8/</a> - первый аккаунт<br>
        LinkedIn: <a href="<?=D.S;?>l610" target="_blank" title="Артур Абзалов в LinkedIn (второй аккаунт)">https://www.linkedin.com/in/артур-абзалов-068310192/</a> - второй аккаунт</div><br>

    <div class="probel">&nbsp;</div>

    <div class="vkontakte">Сообщество Вконтакте для сайта rolar.ru: <a href="<?=D.S;?>l598" target="_blank" title="Сайт rolar.ru (группа Вконтакте)">https://vk.com/club42954041</a></div><br>

    <div class="telegram">Telegram-канал сайта rolar.ru: <a href="<?=D.S;?>l611" target="_blank" title="Telegram-канал сайта rolar.ru">https://t.me/rolarru</a></div><br>

    <div class="facebook">Сообщество Facebook: <a href="<?=D.S;?>l612" target="_blank" title="Персональный сайт Артура Абзалова на Facebook">https://www.facebook.com/rolaraav</a></div><br>

    <div class="probel">&nbsp;</div>

    <div class="hashtags">Хештеги: <a href="https://vk.com/feed?section=search&q=%23rolar" target="_blank">#rolar</a>,
        <a href="https://vk.com/feed?section=search&q=%23#rolaraav" target="_blank">#rolaraav</a>,
        <a href="https://vk.com/feed?section=search&q=%23artur" target="_blank">#artur</a>,
        <a href="https://vk.com/feed?section=search&q=%23arturabzalov" target="_blank">#arturabzalov</a>,
        <a href="https://vk.com/feed?section=search&q=%23abzalov" target="_blank">#abzalov</a>,
        <a href="https://vk.com/feed?section=search&q=%23abzalovartur" target="_blank">#abzalovartur</a>,
        <a href="https://vk.com/feed?section=search&q=%23абзалов" target="_blank">#абзалов</a>,
        <a href="https://vk.com/feed?section=search&q=%23артурабзалов" target="_blank">#артурабзалов</a>,
        <a href="https://vk.com/feed?section=search&q=%23абзаловартур" target="_blank">#абзаловартур</a>,
        <a href="https://vk.com/feed?section=search&q=%23персональный" target="_blank">#персональный</a>,
        <a href="https://vk.com/feed?section=search&q=%23сайт" target="_blank">#сайт</a>,
        <a href="https://vk.com/feed?section=search&q=%23personal" target="_blank">#personal</a>,
        <a href="https://vk.com/feed?section=search&q=%23site" target="_blank">#site</a></div>


</div></div>

<div class="block"><div class="blockbody">
    <h1>Достижения</h1>
    <div class="screenshotsblock"><?=$balls;?></div>
</div></div>


<div class="block"><div class="blockbody"><h1>Платёжные реквизиты</h1>

<div class="left">Здесь приведены реквизиты для приёма платежей через различные платёжные системы.</div>

<div class="left">Система <a href="<?=D.S;?>l4" target="_blank" title="WebMoney - система расчётов on-line">WebMoney</a>:</div>
<div class="left">Кошелёк WMP: <strong>P266611322081</strong> (1 рубль)</div>
<div class="left">Кошелёк WMR: <strong>R121012546658</strong> (1 рубль)</div>
<div class="left">Кошелёк WMZ: <strong>Z402751813120</strong> (1 доллар)</div>
<div class="left">Кошелёк WMG: <strong>G293332807549</strong> (1 грамм чистого золота)</div>
<div class="left">Кошелёк WMU: <strong>U313293774166</strong> (1 украинская гривна)</div>
<div class="left">Кошелёк WME: <strong>E262191568884</strong> (1 евро)</div>
<div class="left">Кошелёк WMB: <strong>B305198337941</strong> (1 белорусский рубль)</div>
<div class="left">
  <!-- begin WebMoney Transfer : accept label --><a href="https://www.megastock.ru/" target="_blank"><img src="<?=I.S;?>informers/webmoney1.png" height="31" width="88" alt="www.megastock.ru" border="0" title="Мы принимаем WebMoney"></a><!-- end WebMoney Transfer : accept label -->
  <!-- begin WebMoney Transfer : attestation label --><a href="https://passport.webmoney.ru/asp/certview.asp?wmid=300328263201" target="_blank"><img src="<?=I.S;?>informers/webmoney2.png" height="31" width="88" alt="Нажмите здесь, чтобы проверить аттестат WM идентификатора 300328263201" border="0" title="Нажмите здесь, чтобы проверить аттестат WM идентификатора 300328263201"></a><!-- end WebMoney Transfer : attestation label -->
</div>
<div class="probel2">&nbsp;</div>

<div class="left">Кошелёк <a href="<?=D.S;?>l359" target="_blank" title="Z-Payment - приём платежей на сайте, эквайринг пластиковых карт для интернет магазина, интернет-платежи">Z-Payment</a>: <strong>ZP39017723</strong></div>
<div class="left"><a href="<?=D.S;?>l359" target="_blank"><img src="<?=I.S;?>informers/zpay88x31.gif" height="31" width="88" alt="Принимаем Z-Payment" border="0" title="Принимаем Z-Payment"></a></div>
<div class="probel2">&nbsp;</div>

<!--<div class="left">Система <a href="https://www.interkassa.com/" target="_blank" title="INTERKASSA">InterKassa</a>:</div>
<div class="left">EUR кошелёк: <strong>105705117726</strong></div>
<div class="left">USD кошелёк: <strong>200992960305</strong></div>
<div class="left">UAH кошелёк: <strong>305947353411</strong></div>
<div class="left">RUB кошелёк: <strong>406184981828</strong></div>
<div class="left"><a href="https://www.interkassa.com/" title="INTERKASSA" target="_blank"><img src="<?=I.S;?>informers/ik88x31.gif" height="31" width="88" alt="INTERKASSA"></a></div>
<div class="probel2">&nbsp;</div> -->

<div class="left">Кошелёк ЮMoney (Яндекс.Деньги): <a href="l640" target="_blank" title="YooMoney"><strong>410011123840928</strong></a></div>
<div class="center"><iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=10U8UC70ERK.240217&" width="330" height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe></div>
<div class="probel2">&nbsp;</div>

<div class="left">Кошелёк RBK Money: <strong>RU988524178</strong></div>
<div class="probel2">&nbsp;</div>

<div class="left">Кошелёк PayPal: <strong>rolar*list.ru</strong> (вместо * @)</div>
<div class="probel2">&nbsp;</div>

<div class="left">Кошелёк Qiwi: <strong>+79872504631</strong></div>
<div class="left"><a href="https://qiwi.com" title="QIWI" target="_blank"><img src="<?=I.S;?>informers/qiwi88x31.gif" height="31" width="88" alt="QIWI"></a></div>
<div class="probel2">&nbsp;</div>

<div class="left">Кошелёк Payeer: <strong>P37769433</strong></div>
<div class="left"><a href="https://payeer.com/" title="PAYEER" target="_blank"><img src="<?=I.S;?>informers/payeer.png" height="31" width="88" alt="PAYEER"></a></div>
<div class="probel2">&nbsp;</div>

 <div class="tinkoff center"><a class="button btn btn-default center" href="<?=D.S;?>l613" target="_blank" title="Дебетовая карта Tinkoff Black"><div class="btn-link-title">Дебетовая карта Tinkoff Black</div><div class="btn-link-subtitle">Кэшбэк с каждой покупки, повышенный кэшбэк на выбранные категории покупок</div></a></div>

</div></div>