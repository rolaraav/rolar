<?php $this->pageTitle='История выплат - Панель партнёра' ?>

<div class="wrap">

    <h3>Аккаунт партнёра</h3>


    <h1>История выплат</h1>
    
    <?php $payouts = $model->history; ?>
    
    <?php if (empty ($payouts)): ?>
    
       <p>На текущий нет сохранённых записей в истории выплат.</p>
       
    <?php else: ?>
    
    
    
    
<div class="items">

<table align="center" cellspacing="0">
<tr>
	<th width="45">Дата выплаты</th>
	<th>Способ выплаты</th>
    <th width="250">Реквизиты</th>
    <th width="80">Сумма</th>
</tr>

<?php foreach ($payouts as $one): ?>

<tr>
	<td style="color:#036"><?= date ('j.m.Y H:i',$one->date); ?></td>
	<td><?= Lookup::item ('Purse',$one->way) ?></td>
    <td><?= $one->rekv; ?></td>
    <td style="color:#C00"><?= $one->sum.H::valuta ($one->valuta); ?></td>
</tr>

<?php endforeach; ?>
</table>
</div>    
    
    
    
    <?php endif; ?>

</div>