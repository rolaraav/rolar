<?php defined('A') or die('Access denied');?>
<!-- Форма запроса платежа WebMoney (начало) -->
<!-- Параметр at=authtype_1 означает выбрать предпочтительный способ оплаты через Keeper WinPro -->
<form accept-charset="utf-8" action="https://merchant.webmoney.ru/lmi/payment_utf.asp?at=authtype_1" content-type="application/x-www-form-urlencoded" method="POST">
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="<?php echo $amount; // ! сумма платежа (число, дробная часть два знака должна отделяться точкой .) ?>">
    <input type="hidden" name="LMI_PAYMENT_DESC" value="<?php echo $lmi_payment_desc; // ! описание товара или услуги, максимальная длина 255 символов - кодировка CP1251 ?>">
    <!-- <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="<?php echo base64_encode($lmi_payment_desc); // ! то же, что LMI_PAYMENT_DESC, только кодировка UTF8 ?>"> -->
    <input type="hidden" name="LMI_PAYMENT_NO" value="<?php echo $payment_no; // ! номер покупки, целое число, должно быть уникальным ?>">
    <input type="hidden" name="LMI_PAYEE_PURSE" value="<?php echo LMI_PAYEE_PURSE; // ! кошелёк продавца ?>">
    <!-- <input type="hidden" name="LMI_SIM_MODE" value="0">только для режима тестирования: 0 - платеж успешный, 1 - с ошибкой, 2 - 80%/20% успех/ошибка -->
    <input type="hidden" name="LMI_RESULT_URL" value="<?php echo D.S.'bill/webmoney'; // Замена Result URL - предварительный запрос об оплате ?>">
    <input type="hidden" name="LMI_SUCCESS_URL" value="<?php echo D.S.'bill/ok'; // Замена Success URL ?>">
    <input type="hidden" name="LMI_SUCCESS_METHOD" value="2">
    <input type="hidden" name="LMI_FAIL_URL" value="<?php echo D.S.'bill/fail'; // Замена Fail URL ?>">
    <input type="hidden" name="LMI_FAIL_METHOD" value="2">
    <!-- <input type="hidden" name="LMI_SHOP_ID" value="<?php echo LMI_SHOP_ID; // номер магазина ?>"> -->
    <!-- <input type="hidden" name="pay_token" value="<?php echo $token; // токен ?>"> -->
    <input type="hidden" name="course_id" value="<?php echo $course_id; // ID курса ?>">
    <!-- <input type="hidden" name="course_alias" value="<?php echo $course_alias; // алиас курса ?>"> -->
    <!-- <input type="hidden" name="course_title" value="<?php echo $course_title; // название курса ?>"> -->
    <input class="button" type="submit" name="pay_submit" value="Оплатить через WebMoney">
</form>
<!-- Форма запроса платежа WebMoney (конец) -->
<div class="clearfix"><hr></div>
<!-- Форма запроса платежа YooMoney (конец) -->
<form action="https://yoomoney.ru/quickpay/confirm.xml" method="POST" target="_blank">
    <input type="hidden" name="receiver" value="<?php echo YA_PURSE; // ! кошелёк продавца ?>">
    <input type="hidden" name="formcomment" value="Оплата счёта <?php echo $payment_no; // ! номер покупки, целое число, должно быть уникальным ?>">
    <input type="hidden" name="short-dest" value="Оплата счёта <?php echo $payment_no; // краткое описание ?>">
    <input type="hidden" name="label" value="Oplata_scheta_<?php echo $payment_no; // описание платежа ?>">
    <input type="hidden" name="quickpay-form" value="shop">
    <input type="hidden" name="targets" value="Oplata_scheta_<?php echo $payment_no; // ! номер покупки, целое число, должно быть уникальным ?>">
    <input type="hidden" name="sum" value="<?php echo $amount; // ! сумма платежа (число, дробная часть два знака должна отделяться точкой .) ?>" data-type="number">
    <!--<input type="hidden" name="comment" value="Хотелось бы получить дистанционное управление.">
    <input type="hidden" name="need-fio" value="true">
    <input type="hidden" name="need-email" value="true">
    <input type="hidden" name="need-phone" value="false">
    <input type="hidden" name="need-address" value="false"> -->
    <div class="left form-group"><input id="yoomoney_payment_type" type="radio" name="paymentType" value="PC" checked> <label for="yoomoney_payment_type">ЮMoney (Яндекс.Деньгами)</label></div>
    <div class="left form-group"><input id="card_payment_type" type="radio" name="paymentType" value="AC"> <label for="card_payment_type">Банковской картой VISA/MasterCard</label></div>
    <input class="button" type="submit" name="submit-button" value="Оплатить через ЮMoney">
</form>
<!-- Форма запроса платежа YooMoney (конец) -->
<div class="clearfix"><hr></div>
<!-- Форма запроса платежа Payeer (начало) -->
<form action="https://payeer.com/merchant/" method="POST" target="_blank">
    <input type="hidden" name="m_shop" value="<?php echo PAYEER_SHOP_ID; // ! идентификатор магазина ?>">
    <input type="hidden" name="m_orderid" value="<?php echo $payment_no; // ! номер покупки, целое число, должно быть уникальным ?>">
    <input type="hidden" name="m_amount" value="<?php echo $amount; // ! сумма платежа (число, дробная часть два знака должна отделяться точкой .) ?>">
    <input type="hidden" name="m_curr" value="RUB">
    <input type="hidden" name="m_desc" value="<?php echo $payeer_desc; // описание платежа ?>">
    <input type="hidden" name="m_sign" value="<?php echo $payeer_crc; // контрольная сумма платежа ?>">
    <div class="paybtn"><input class="button" type="submit" name="m_process" value="Оплатить через Payeer" class="submit"></div>
</form>
<!-- Форма запроса платежа Payeer (конец) -->

<!--
<form action="https://auth.robokassa.ru/Merchant/Index.aspx" method="POST" target="_blank">
    <input type="hidden" name="MrchLogin" value="{robox_login}">
    <input type="hidden" name="OutSum" value="{robox_sum}">
    <input type="hidden" name="InvId" value="{robox_id}">
    <input type="hidden" name="Desc" value="Oplata">
    <input type="hidden" name="SignatureValue" value="{robox_crc}">
    <input type="hidden" name="Culture" value="ru">
    <input type="hidden" name="Email" value="{email}">
    <div class="paybtn"><input id="subm" class="submit" type="submit" value="Перейти к оплате"></div>
</form> -->