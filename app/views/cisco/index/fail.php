<?php defined('A') or die('Access denied'); ?>
<div class="cisco_zagolovok"><br><span class="cisco_payment_fail">Не получилось оплатить заказ?<br><br></span><br><span class="cisco_siski">&quot;Сиськи по-русски&quot;</span><br><span class="cisco_or">или</span><br><span class="cisco_steps">11 простых шагов</span><br><span class="cisco_technology">по сетевым технологиям</span><br><span class="cisco_logo">CISCO</span><br><span class="cisco_russian">на русском языке</span></div>
<div class="cisco_image-center"><img alt="Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке" height="387px" width="300px" src="<?=I.S;?>cisco/ccna-book300.png" title="Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке"></div>
<h1 class="cisco_webmoney">Здесь ты можешь приобрести курс напрямую<br>через платёжную систему WebMoney:</h1>
<div class="cisco_image-center"><img src="<?=I.S;?>cisco/webmoney_logo.png" width="300px" height="91px" border="0px" alt="WebMoney" title="WebMoney"></div>
<?php echo $webmoney; //require '_webmoney.php'; ?>
<div class="probel">&nbsp;</div>

<h1 class="cisco_yandex">Здесь ты можешь приобрести курс напрямую<br>через платёжную систему Яндекс.Деньги:</h1>
<div class="cisco_image-center"><img src="<?=I.S;?>cisco/yandex_dengi.png" width="300px" height="100px" border="0px" alt="Яндекс.Деньги" title="Яндекс.Деньги"></div>
<?php echo $yandex; //require '_yandex.php'; ?>
<p class="probel">&nbsp;</p>

<h1 class="cisco_qiwi">Здесь ты можешь приобрести курс напрямую<br>через платёжную систему QIWI:</h1>
<div class="cisco_image-center"><img src="<?=I.S;?>cisco/qiwi_logo.png" width="171px" height="83px" border="0px" alt="Платежная система QIWI" title="Платежная система QIWI"></div>
<!--<div class="center"><iframe src="https://ishop.qiwi.com/public/order/embed.action?from=470237&ccy=RUB,USD,EUR" width="500px" height="390px"></iframe></div>-->
<style type="text/css">
  a.paybuttonlink {
    display: block;
    position: relative;
    min-height: 27px;
    max-width: 180px;
    margin: 0 auto;
    padding: 10px 0px 5px 0px;
    font-size: 16px;
    font-family: Verdana;
    font-weight: normal;
    color: #000000;
    background: #ededed;
    background: -webkit-gradient(linear,left top,left bottom,from(#ededed),to(#c4c4c4));
    background: -moz-linear-gradient(top,#ededed,#c4c4c4);
    background: -o-linear-gradient(top,#ededed,#c4c4c4);
    background: -ms-linear-gradient(top,#ededed,#c4c4c4);
    background: linear-gradient(top,#ededed,#c4c4c4);
    border: 1px solid #cdcdcd;
    border-radius: 2px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
    -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
    -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
    transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    cursor: pointer;
    text-decoration: none;
    text-transform: uppercase;
  }
</style>
<div class="center"><a class="paybuttonlink" href="https://w.qiwi.com/order/external/create.action?from=470237&summ=1753.00&currency=RUB&comm=Paybill+%231&txn_id=1&iframe=false&successUrl=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Fok%2Fw%2Fqiwi&failUrl=http%3A%2F%2Frolar.ru%2Fom%2Ff%2Ffail%2Fw%2Fqiwi&lifetime=1440" target="_blank" title="Оплатить">Оплатить</a></div>
<p class="probel">&nbsp;</p>

<h1 class="cisco_paypal">Здесь ты можешь приобрести курс напрямую<br>через платёжную систему PayPal:</h1>
<div class="cisco_image-center"><img src="<?=I.S;?>cisco/paypal.png" width="200px" height="48px" border="0px" alt="PayPal" title="PayPal"></div>
<div class="cisco_image-center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="ZK5KCV84PELGJ">
    <input type="image" src="https://www.paypalobjects.com/ru_RU/RU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal — более безопасный и легкий способ оплаты через Интернет!">
  </form></div>
<p class="probel">&nbsp;</p>

<!--<h1 class="cisco_liqpay">Здесь ты можешь приобрести курс напрямую<br>через платёжную систему LiqPay или любую кредитную карту VISA/MasterCard:</h1>
<div class="cisco_image-center"><img src="<?=I.S;?>cisco/liqpay.png" width="228px" height="75px" border="0px" alt="LiqPay" title="LiqLay"></div>
<div class="center"><form method="POST" accept-charset="utf-8" action="https://www.liqpay.com/api/3/checkout">
    <input name="data" type="hidden" value="eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJwdWJsaWNfa2V5IjoiaTQxMjM5NjYxNTUzIiwiYW1vdW50IjoiMTc1MyIsImN1cnJlbmN5IjoiUlVCIiwiZGVzY3JpcHRpb24iOiLQmtGD0YDRgSDQv9C+IENpc2NvIiwidHlwZSI6ImJ1eSIsInNlcnZlcl91cmwiOiJodHRwOi8vcm9sYXIucnUvY2lzY28vZG93bmxvYWQucGhwIiwibGFuZ3VhZ2UiOiJydSJ9">
    <input name="signature" type="hidden" value="7E0yy6a7G/XeZmfpxd7qpVkIPaU=">
    <input class="cisco_image-center" name="btn_text" type="image" src="<?=I.S;?>cisco/liqpay_submit.png">
  </form></div>
<p class="probel">&nbsp;</p> -->

<p class="cisco_support_link">Если оплатить не удалось, обратись в <a href="<?=D;?>om/support/" target="_blank" title="Написать тикет в службу поддержки"><strong>службу поддержки</strong></a>.</p>
