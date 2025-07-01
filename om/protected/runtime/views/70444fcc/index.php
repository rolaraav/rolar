<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\default\index.php */ ?>
<?php $this->pageTitle='Главная' ?>

<div class="wrap">

<h3>Главная</h3>

<h1>Панель администратора</h1>

<p>Здравствуйте, <?=Y::user()->firstName ?>!</p>

<?php $xx = StaffAccess::allowed('main'); ?>
<?php if (empty($xx) OR (in_array('index',$xx))): ?>

<fieldset>

    <legend>Статистика магазина</legend>

<ol>

<li>
<label>Всего товаров:</label>
<div class="oneitem"><?=$data['goodsCount']?></div>
</li>

<li>
<label>Всего клиентов:</label>
<div class="oneitem"><?=$data['clientsCount']?></div>
</li>

<li>
<label>Всего партнёров:</label>
<div class="oneitem"><?=$data['partnersCount']?></div>
</li>

<li>
<label>Всего кликов:</label>
<div class="oneitem"><?=$data['clicksCount']?></div>
</li>

<li>&nbsp;</li>

<li>
<label>Писем в очереди:</label>
<div class="oneitem"><span style="color:#C00"><?=Queue::model ()->count (); ?></span> &nbsp; <?=CHtml::link ('просмотреть очередь &gt;&gt;',array ('queue/index')); ?></div>
</li>

<li>
<label>Последняя рассылка:</label>
<span class="oneitem"><span style="color:#036"><?=(Settings::item ('cronRass')>1)?date('d.m.Y H:i:s',Settings::item ('cronRass')):'никогда'?></span></span>
</li>


<li>&nbsp;</li>

<li>
<label>Всего счетов:</label>
<div class="oneitem"><?=$data['totalBill']?></div>
</li>

<li>
<label>Оплаченных счетов:</label>
<div class="oneitem"><?=$data['paidBill']?></div>
</li>

<li>
<label>Всего заказов:</label>
<div class="oneitem"><?=$data['totalOrder']?></div>
</li>

<li>
<label>Оплаченных заказов:</label>
<div class="oneitem"><?=$data['paidOrder']?></div>
</li>

</ol>
</fieldset>


<fieldset>
<legend>Прибыль и доходы</legend>
<ol>

<li>
<label>Общий доход:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['totalSum'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['totalSumUsd'])?>$)</div>
</li>

<li>&nbsp;</li>

<li>
<label>Комиссионные:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['totalPSum'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['totalPSumUsd'])?>$)</div>
</li>

<li>
<label>К выплате партнёрам:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['totalPSum2'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['totalPSum2Usd'])?>$)</div>
</li>
<li>
<label>Авторские:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['totalASum'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['totalASumUsd'])?>$)</div>
</li>

<li>
<label>К выплате авторам:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['totalASum2'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['totalASum2Usd'])?>$)</div>
</li>

<li>&nbsp;</li>
<li>
<label>Чистая прибыль:</label>
<div class="oneitem"><?=H::mysum(H::indv($data['cleanSum'],'rur'))?> <?=H::dv(1)?> (<?=H::mysum($data['cleanSumUsd'])?>$)</div>
</li>

</ol>
</fieldset>

<?php else: ?>

<div align="center" style="padding:50px"><img src="<?= Y::bu() ?>images/theme/logo.gif"></div>

<fieldset>

<legend>О системе</legend>

<ol>

<li>
<label>Разработчик:</label>
<div class="oneitem">Александр Долгу (ASELF.RU)</div>
</li>

<li>
<label>Сайт системы:</label>
<div class="oneitem"><a href="http://ordermaster.ru/" target="_blank">www.OrderMaster.ru</a></div>
</li>

<li>
<label>Описание:</label>
<div class="oneitem">Магазин с автоматической доставкой и партнёрской программой</div>
</li>

</ol>

</fieldset>

<?php endif; ?>

<fieldset style="padding-left:20px;">
    
    <legend>Переход к просмотру статистики</legend>

<br>
<table border="0" align="center" width="100%"><tr>
<td align="center">
<form target="_blank" action="<?=Y::bu()?>admin/stat" method="post">
    <input type="hidden" name="startDate" value="<?=date('j.m.Y')?>">
    <input type="hidden" name="stopDate" value="<?=date('j.m.Y')?>">
    <input type="submit" value="Статистика за сегодня" class="submit">
</form>
</td>

<td align="center">
<form target="_blank" action="<?=Y::bu()?>admin/stat" method="post">
    <input type="hidden" name="startDate" value="<?=date('j.m.Y',time()-604800)?>">
    <input type="hidden" name="stopDate" value="<?=date('j.m.Y')?>">
    <input type="submit" value="Статистика за неделю" class="submit">
</form>
</td>

<td align="center">
<form target="_blank" action="<?=Y::bu()?>admin/stat" method="post">
    <input type="hidden" name="startDate" value="01.01.<?=date('Y')?>">
    <input type="hidden" name="stopDate" value="<?=date('j.m.Y')?>">
    <input type="submit" value="Статистика за текущий год" class="submit">
</form>
</td>
</tr>
</table>
<br>

</fieldset>

</div>