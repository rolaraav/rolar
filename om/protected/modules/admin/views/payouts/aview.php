<?php $this->pageTitle='Выплата комиссионных автору' ?>

<div class="wrap">
<h3>Выплаты</h3>

<h1>Выплата комиссионных автору</h1>


<fieldset>
<legend>Общие сведения</legend>

<ol>

<li>
<label>ID-автора</label>
<div class="urlitem"><?=CHtml::link ($p->id,array("author/view","id" => $p->id),array ("target" => "_blank"))?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$sum?> руб.</div>
</li>

<?php

$nazn = 'Авторское вознаграждение от '.str_replace ('/','',str_replace ('http://','',Settings::item('siteUrl'))).'';

?>

<li>
<label>Назначение платежа</label>
<div class="oneitem"><?=$nazn?></div>
</li>

</ol>

</fieldset>

<?php if ($p->kind=='wmz'): ?>

<fieldset>
<legend>Выплата с помощью WebMoney Z</legend>

<ol>
    
<li><label>&nbsp;</label>
<img src="<?=Y::bu()?>images/admin/pay/webmoney.gif" style="padding:20px 25px;">
</li>

<li>
<label>WMZ-кошелёк</label>
<div class="oneitem"><?=$p->purse?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$usd?> WMZ</div>
</li>

<li>
<label>&nbsp;</label>
<div style="padding-left:440px;">
<form action="wmk:payto" method="get">
<input type="hidden" name="Purse" value="<?=$p->purse?>" />
<input type="hidden" name="Amount" value="<?=$usd?>" />
<input type="hidden" name="Desc" value="<?=$nazn?>" />
<input type="hidden" name="BringToFront" value="Y" />
<input type="submit" value="Передать в Keeper" style="height:16px;" />
</form>
</div>
</li>

</ol>

</fieldset>

<?=CHtml::form (array('payouts/aok/id/'.$p->id.'/way/wmz')); ?>

<fieldset class="submit">
<input class="submit" type="submit"
value="Подтвердить выплату WebMoney Z" />
</fieldset>

</form>
<?php endif;?>





<?php if ($p->kind=='wmr'): ?>

<fieldset>
<legend>Выплата с помощью WebMoney R</legend>

<ol>
    
<li><label>&nbsp;</label>
<img src="<?=Y::bu()?>images/admin/pay/webmoney.gif" style="padding:20px 25px;">
</li>

<li>
<label>WMR-кошелёк</label>
<div class="oneitem"><?=$p->purse?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$sum?> WMR</div>
</li>

<li>
<label>&nbsp;</label>
<div style="padding-left:440px;">
<form action="wmk:payto" method="get">
<input type="hidden" name="Purse" value="<?=$p->purse?>" />
<input type="hidden" name="Amount" value="<?=$sum?>" />
<input type="hidden" name="Desc" value="<?=$nazn?>" />
<input type="hidden" name="BringToFront" value="Y" />
<input type="submit" value="Передать в Keeper" style="height:16px;" />
</form>
</div>
</li>

</ol>

</fieldset>

<?=CHtml::form (array('payouts/aok/id/'.$p->id.'/way/wmr')); ?>

<fieldset class="submit">
<input class="submit" type="submit"
value="Подтвердить выплату WebMoney R" />
</fieldset>

</form>
<?php endif;?>


<?php if ($p->kind=='rbkmoney'): ?>

<fieldset>
<legend>Выплата с помощью RBKMoney</legend>

<ol>
    
<li><label>&nbsp;</label>
<img src="<?=Y::bu()?>images/admin/pay/rbkmoney.gif" style="padding:20px 25px;">
</li>    

<li>
<label>Счёт в RBKMoney</label>
<div class="oneitem"><?=$p->purse?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$sum?> руб.</div>
</li>

<li>
<label>Назначение платежа</label>
<div class="oneitem"><?=$nazn?></div>
</li>

<li>
<label>&nbsp;</label>
<div style="padding-left:440px;">
<a href="https://rbkmoney.ru/client/innerpayment.aspx" target="_blank">Перейти на сайт RBK Money</a>
</div>
</li>


</ol>

</fieldset>

<?=CHtml::form (array('payouts/aok/id/'.$p->id.'/way/rbkmoney')); ?>

<fieldset class="submit">
<input class="submit" type="submit"
value="Подтвердить выплату RBKMoney" />
</fieldset>

</form>
<?php endif;?>



<?php if ($p->kind=='yandex'): ?>

<fieldset>
<legend>Выплата с помощью Яндекс.Деньги</legend>

<ol>

<li><label>&nbsp;</label>
<img src="<?=Y::bu()?>images/admin/pay/yandex.png" style="padding:20px 25px;">
</li>    

<li>
<label>Яндекс-кошелёк</label>
<div class="oneitem"><?=$p->purse?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$sum?> руб.</div>
</li>

<li>
<label>&nbsp;</label>
<div style="padding-left:440px;">
<form action="https://money.yandex.ru/shop.xml" method="get" target="_blank">
<input type="hidden" name="scid" value="767" />
<input type="hidden" name="to-account" value="<?=$p->purse?>" />
<input type="hidden" name="sum_k" value="<?=$sum?>" />
<input type="hidden" name="short-dest" value="<?=$nazn?>" />
<input type="hidden" name="type" value="numb" />
<input type="hidden" name="FormComment" value="Выплата комиссионных" />
<input type="submit" value="Передать на сайт Яндекс.Деньги" style="height:16px;" />
</form>
</div>
</li>

</ol>

</fieldset>

<?=CHtml::form (array('payouts/aok/id/'.$p->id.'/way/yandex')); ?>

<fieldset class="submit">
<input class="submit" type="submit"
value="Подтвердить выплату Яндекс.Деньги" />
</fieldset>

</form>
<?php endif;?>



<?php if ($p->kind=='zpayment'): ?>

<fieldset>
<legend>Выплата с помощью Z-Payment</legend>

<ol>
    
<li><label>&nbsp;</label>
<img src="<?=Y::bu()?>images/admin/pay/zpayment.gif" style="padding:20px 25px;">
</li>

<li>
<label>ZP-кошелёк</label>
<div class="oneitem"><?=$p->purse?></div>
</li>

<li>
<label>Сумма</label>
<div class="oneitem"><?=$sum?> руб.</div>
</li>

<li>
<label>Назначение платежа</label>
<div class="oneitem"><?=$nazn?></div>
</li>

<li>
<label>&nbsp;</label>
<div style="padding-left:440px;">
<a href="https://z-payment.ru/pretransfer.php" target="_blank">Перейти на сайт Z-Payment</a>
</div>
</li>

</ol>

</fieldset>

<?=CHtml::form (array('payouts/aok/id/'.$p->id.'/way/zpayment')); ?>

<fieldset class="submit">
<input class="submit" type="submit"
value="Подтвердить выплату Z-Payment" />
</fieldset>

</form>
<?php endif;?>

</div>
