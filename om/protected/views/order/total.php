<?php $this->pageTitle='Оформление заказа - Ваша корзина' ?>

<?php echo StepBar::showBar(3) ?>

<div class="wrap">

<h3>Оформление заказа</h3>

<h1>Ваша Корзина</h1>

<!-- Сюда писать текст какой-нибудь предварительный -->
<form method="post">

<table border="0" width="100%" align="center" class="cart_table">
<tr>
<td width="30"><b>№</b></td>
<td><b>Название</b></td>
<td width="80"  align="center"><b>Цена</b></td>
</tr>

<?php $total=0; $i = 1; foreach ($goods as $good): ?>

<tr>
<td><?=$i?></td>
<td><?=$good->title?></td>
<td align="center"><?=H::mysum($good->newprice)?><?=H::valuta($good->currency); $total+=$good->rurcena; ?> </td>

</tr>

<?php $i++; endforeach; ?>

</table>

<br>

<p class="total_sum_cart">Итоговая сумма заказа: <?=H::mysum($total)?> рублей</p>

<br>

<div class="cart_btn">
<input class="submit" type="submit" name="submit" value="Всё верно, перейти к выбору способа оплаты" style="font-size:16px;"/>
</div>


</div>