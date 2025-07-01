<?php $this->pageTitle='Оформление заказа - Выгодное предложение' ?>

<?php echo StepBar::showBar(2) ?>

<div class="wrap">

<h3>Выгодное предложение №1</h3>

<h1>Выгодное предложение №1</h1>

<p><?=$good->upsellText?></p>

<form method="post">

    <div class="cart_btn">
<input class="submit" type="submit" name="submit_ok" value="Добавить к заказу" style="font-size:16px;"/> &nbsp; &nbsp; &nbsp;

<input class="submit" type="submit" name="submit" value="Нет, спасибо" style="font-size:16px;"/>
</div>
    
</form>


</div>