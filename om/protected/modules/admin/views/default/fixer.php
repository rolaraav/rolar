<div class="wrap">

<h1>Исправление начислений комиссионных</h1>

<h3>Исправление партнёрской программы</h3>

<h2>Выбраны заказы с <u><?=$start?></u> по <u><?=$stop?></u>

    <br><br>
    
<form method="POST">
    
<table border="0" cellspacing="10">
    
    <tr>
        <th width="120">№ счёта/заказа</th>
        <th width="40">Статус</th>
        <th width="120">IP заказа</th>
        <th width="120">IP клика</th>
        <th width="100">RefID</th>
        <th width="70">Вписать</th>
        <th width="90">Начислить</th>
        
    </tr>
    
    <?php foreach ($orders as $o): ?>
    
    <tr>
        
        <td><?=CHtml::link ($o['bill_id'].' / '.$o['id'],array ('bill/view/id/'.$o['bill_id']),array ('target' => '_blank'))?></td>
        <td><img src="<?=Y::bu()?>images/status/<?=$o['status'];?>.gif" class="middle">
            
        <td><?=$o['ip']?></td>
        
        <td><?=(empty($o['click']))?'нет':$o['click']; ?></td>
        
        <td><?=(empty($o['refid']))?'нет':CHtml::link($o['refid'],array('partner/view/id/'.$o['refid']),array ('target'=>'_blank')); ?></td>
        
        <input type="hidden" name="o[<?=$o['id']?>]" value="0">
        
        <?php if (empty ($o['refid'])): ?>
        
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        
        <?php else: ?>
        
        <?php if ($o['paid']): ?>
        
            <td>&nbsp;</td>
            <td align="center"><input type="checkbox" name="o[<?=$o['id']?>]" value="1" checked></td>
        
        <?php else: ?>
            
            <td align="center"><input type="checkbox" name="o[<?=$o['id']?>]" value="1" checked></td>
            <td>&nbsp;</td>
            
            
        <?php endif; ?>
            
        <?php endif; ?>
        
    </tr>
    
    
    <?php endforeach; ?>
    
    
</table>
    
    <div align="center"><input style="padding:10px;" type="submit" value="Применить действия"></div>
    
</form>    

</div>

<?= $this->renderPartial('//main/_statuses'); ?>