<?php defined('A') or die('Access denied');?>
<div class="center"><form action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
 <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="1753.00">
 <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="MTEg0L/RgNC+0YHRgtGL0YUg0YjQsNCz0L7QsiDQv9C+INGB0LXRgtC10LLRi9C8INGC0LXRhdC90L7Qu9C+0LPQuNGP0LwgQ0lTQ08g0L3QsCDRgNGD0YHRgdC60L7QvCDRj9C30YvQutC1">
 <input type="hidden" name="LMI_PAYEE_PURSE" value="<?php echo LMI_PAYEE_PURSE; ?>">
<input type="submit" class="cisco_webmoney_button" value="Оплатить 1753.00 WMP">
</form></div>