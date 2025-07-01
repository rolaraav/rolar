<div class="wrap">

<p><h1>Импорт данных из Excel-файла в БД</h1></p>

<p><b>Записи:</b> (ID товаров можно указать через запятую без пробела несколько)<br><br></p>

<form action="" method="POST">
    
<table border="0" width="100%">
    
<?php $i = 1; ?>
    
    <tr>
    <td width="30">№</td>
    <td width="100">Имя</td>
    <td width="150">ФИО (ориг)</td>
    <td width="90">E-mail</td>
    <td width="50">Дата</td>
    <td width="150">ID товара</td>
    <td width="200">Примечание</td>
    </tr>
    
<?php foreach ($a as $t): ?>
    
    <tr height="30">
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><?=$i?></td>
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><input type="text" name="d[<?=$i?>][uname]" style="width:90px; font-size:10px;" value="<?=$t['uname']?>"></td>
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><span style="font-size:10px; font-family:Verdana;"><?=$t['orig_fio']?></span></td>
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><span style="font-size:11px; color:#C00"><?=$t['email']?><input type="hidden" name="d[<?=$i?>][email]" value="<?=$t['email']?>"></span></td>        
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><span style="font-size:10px; color:#036"><?=date ('j.m.Y',$t['date'])?><input type="hidden" name="d[<?=$i?>][date]" value="<?=$t['date']?>"></span></td>        
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><input type="text" name="d[<?=$i?>][gid]" style="width:90px; font-size:10px;" value="<?=$gid?>"></td>
        <td style="border-bottom:1px dashed #AAAAAA; padding:4px;"><span style="font-size:9px; font-family:Verdana;"><?=$t['adv']?></span></td>
        
    </tr>
    
   
<?php $i++; ?>
<?php endforeach; ?>
    
</table>


    <br><br>
<p align="center"><input type="submit" value="Добавить клиентов в базу"></p>
    
</form>

<p>&nbsp;</p>

</div>