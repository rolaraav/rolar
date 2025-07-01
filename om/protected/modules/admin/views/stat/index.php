<?php $this->pageTitle='Статистика' ?>

<div class="wrap">

    <h3>Статистика</h3>

    <h1>Просмотр статистики</h1>

<p><b>Выберите период: </b></p>

<br>

<?= CHtml::beginForm(array ()); ?>

<p>С <?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('startDate',$startDate)); ?>

по

<?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('stopDate',$stopDate)); ?>

<br><br>Для товара: </br>
<?= CHtml::dropDownList ('thegood',$thegood,array_merge(array(''=>'Все'),$gl)); ?>

<br><br><input type='checkbox' class='checkbox' name='subacc' value='1'> Показать статистику по каналам

<br><br>



<?= CHtml::submitButton('Показать статистику', array ('class' => 'submit')); ?>
<?= CHtml::endForm(); ?>

<p>&nbsp;</p>
<p>&nbsp;</p>

<h2>Статистика за период с <?=$startDate?> по <?=$stopDate?> для <?=(empty($thegood)?'ВСЕХ товаров':'товара: '.$gl[$thegood])?></h2>

<p>&nbsp;</p>

<?=H::moredivAll ('графики','aa') ?>

<p>&nbsp;</p>

<?

$flashChart = Yii::createComponent('application.extensions.openflashchart2.EOFC2');

$flashChart->begin();

if ($statKind == 'day') {

    $flashChart->setTitle('Доход в рублях от продаж по дням за период с '.$startDate.' по '.$stopDate,'{color:#880a88;font-size:15px;padding-bottom:20px;}');

    $nn=0; $data = array (); $max=1;

    if (count($stat)>20) {
        $ss = ceil (count($stat)/20);
    } else {
        $ss = 2;
    }

    $totalsum = 0;

    foreach ($stat as $key=>$one) {

        if (($nn % $ss) == 0) {
            $data[$nn]['Day']['date'] = date ('j.m',$key);
        }
        $data[$nn]['Day']['count'] = $one['sum'];
        $totalsum += $one ['sum'];
        if ($one['sum']>$max && $one['sum']>1) {
            $max = $one['sum'];
        }

        $nn++;
    }

 } else {

     $flashChart->setTitle('Доход в рублях от продаж по месяцам за период с '.$startDate.' по '.$stopDate,'{color:#880a88;font-size:15px;padding-bottom:20px;}');

    $nn=0; $data = array (); $max=1;

    if (count($stat)>20) {
        $ss = ceil (count($stat)/20);
    } else {
        $ss = 2;
    }

    
    $totalsum = 0;

    foreach ($stat as $key=>$one) {

        if (($nn % $ss) == 0) {
            $data[$nn]['Day']['date'] = date ('m/y',$key);
        }
        $data[$nn]['Day']['count'] = $one['sum'];
        $totalsum += $one ['sum'];
        if ($one['sum']>$max && $one['sum']>1) {
            $max = $one['sum'];
        }

        $nn++;
    }


 }

$flashChart->setData($data);
$flashChart->setNumbersPath('{n}.Day.count');
$flashChart->setLabelsPath('default.{n}.Day.date');

$flashChart->setLegend('x','Дата');
$flashChart->setLegend('y','Сумма (р.)', '{color:#AA0aFF;font-size:12px;}');

$flashChart->axis('x',array('tick_height' => 10,'3d' => -10));
$thestep = ceil ($max/18);
$thestep = $thestep - ($thestep % 100);
if ($thestep<1) $thestep=1;
if ($max/$thestep>20) $thestep = floor ($max/18);

$flashChart->axis('y',array('range' => array(0,$max+10,$thestep)));

$flashChart->renderData('bar_glass');
$flashChart->render(650,450);


?>

<p>&nbsp;</p>
<p>&nbsp;</p>


<?

$flashChart = Yii::createComponent('application.extensions.openflashchart2.EOFC2');

$flashChart->begin();

if ($statKind == 'day') {

    $flashChart->setTitle('Количество продаж по дням за период с '.$startDate.' по '.$stopDate,'{color:#900000;font-size:15px;padding-bottom:20px;}');

    $nn=0; $data = array (); $max=2;

    if (count($stat)>20) {
        $ss = ceil (count($stat)/20);
    } else {
        $ss = 2;
    }

    //Y::dump ($stat);

    foreach ($stat as $key=>$one) {

        if (($nn % $ss) == 0) {
            $data[$nn]['Day']['date'] = date ('j.m',$key);
        }
        $data[$nn]['Day']['count'] = $one['count'];
        if ($one['count']>$max && $one['count']>1) {
            $max = $one['count'];
        }

        $nn++;
    }

 } else {

     $flashChart->setTitle('Количество продаж по месяцам за период с '.$startDate.' по '.$stopDate,'{color:#880a88;font-size:15px;padding-bottom:20px;}');

    $nn=0; $data = array (); $max=1;

    if (count($stat)>20) {
        $ss = ceil (count($stat)/20);
    } else {
        $ss = 2;
    }

    //Y::dump ($stat);

    foreach ($stat as $key=>$one) {

        if (($nn % $ss) == 0) {
            $data[$nn]['Day']['date'] = date ('m/y',$key);
        }
        $data[$nn]['Day']['count'] = $one['count'];
        if ($one['count']>$max && $one['count']>1) {
            $max = $one['count'];
        }

        $nn++;
    }


 }

$flashChart->setData($data);
$flashChart->setNumbersPath('{n}.Day.count');
$flashChart->setLabelsPath('default.{n}.Day.date');

$flashChart->setLegend('x','Дата');
$flashChart->setLegend('y','Количество (шт.)', '{color:#D54C78;font-size:12px;}');

$flashChart->axis('x',array('tick_height' => 10,'3d' => -10));
$thestep = ceil ($max/18); 
if ($thestep<1) $thestep=1;
if (($max/$thestep)>20) $thestep = floor ($max/18);
$flashChart->axis('y',array('range' => array(0,$max+1,$thestep)));

$flashChart->renderData('bar_filled',array ('colour' => '#E2D66A'));
$flashChart->render(650,450);


?>


<p>&nbsp;</p>

</div>

<?=H::moredivAll ('таблицу статистики заказов','bb') ?>

<div class="items">

<table align="center" cellspacing="0">

    <tr>
        <th>Товар</th>
        <th width="50">Кликов</th>
        <th width="24"><img src="<?=Y::bu()?>images/status/waiting.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/approved.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/processing.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/sent.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_confirmed.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_sent.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_ok.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_back.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/cancelled.gif"></th>
    </tr>
    
    <?php foreach ($goods as $one): ?>
    
    <?php $cl = $clicks[$one->id]; ?>
    
    <?php if (!empty ($thegood)) {
        if ($one->id!=$thegood) continue;
    } ?>
    
    <tr>
        <td style="font-size:8px"><?=$one->title?></td>
        <td class="thedate"><?=$cl['clicks']?></td>
        <td><?=$cl['waiting']?></td>
        <td class="gooddate"><?=$cl['approved']?></td>
        <td class="gooddate"><?=$cl['processing']?></td>
        <td class="gooddate"><?=$cl['sent']?></td>
        <td><?=$cl['nalozh']?></td>
        <td><?=$cl['nalozh_confirmed']?></td>
        <td><?=$cl['nalozh_sent']?></td>
        <td class="gooddate"><?=$cl['nalozh_ok']?></td>
        <td class="baddate"><?=$cl['nalozh_back']?></td>
        <td class="baddate"><?=$cl['cancelled']?></td>
        
    </tr>
    
    <?php endforeach; ?>
    
    <tr>
        <?php $cl = $totalstat ?>
        <td><b>Все товары</b></td>
        <td class="thedate"><?=$cl['clicks']?></td>
        <td><?=$cl['waiting']?></td>
        <td class="gooddate"><?=$cl['approved']?></td>
        <td class="gooddate"><?=$cl['processing']?></td>
        <td class="gooddate"><?=$cl['sent']?></td>
        <td><?=$cl['nalozh']?></td>
        <td><?=$cl['nalozh_confirmed']?></td>
        <td><?=$cl['nalozh_sent']?></td>
        <td class="gooddate"><?=$cl['nalozh_ok']?></td>
        <td class="baddate"><?=$cl['nalozh_back']?></td>
        <td class="baddate"><?=$cl['cancelled']?></td>
        
    </tr>
    
    
</table>
</div>

</div>

<fieldset>

    <legend>Информация для выбранного периода</legend>

    <ol>
        
        <li>
            <label>Кликов всего:</label><?=$tclicks?>
            
        </li>        
        
        <li>
            <label>Кликов для партнёрки:</label><?=$aclicks?>
            
        </li>        
        

        <li>
            <label>Всего продаж:</label><?=count($porders)?>
            
        </li>
        
        <li>
        <label>На общую сумму:</label><?=H::mysum($totalsum)?> рублей
        </li>
        
        <li>&nbsp;</li>
        
        <li>
        <label>Комиссионных 1 ур.:</label><?=H::mysum($com1)?> рублей
        </li>
        
        <li>
        <label>Комиссионных 2 ур.:</label><?=H::mysum($com2)?> рублей
        </li>
        
        <li>
        <label>Комиссионных всего:</label><?=H::mysum($com1 + $com2)?> рублей
        </li>
        
        <li>&nbsp;</li>
        
        <li>
        <label>Чистая прибыль:</label><?=H::mysum($totalsum - $com1 - $com2)?> рублей
        </li>
        
        
        
        


    </ol>


</fieldset>

<br>

</div>

<?= $this->renderPartial('//main/_statuses'); ?>

<?php if ($sbcheck): ?>

<div class='wrap'>
    
    <h1>Статистика по своим каналам</h1>
    

<div class="items">

<table align="center" cellspacing="0" style="width:870px;">

    <tr>
        <th>Субаккаунт</th>
        <th width="50">Кликов</th>
        <th width="24"><img src="<?=Y::bu()?>images/status/waiting.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/approved.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/processing.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/sent.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_confirmed.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_sent.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_ok.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/nalozh_back.gif"></th>
        <th width="24"><img src="<?=Y::bu()?>images/status/cancelled.gif"></th>
        <th width="44">%</th>
        <th width="44">EPC</th>
        <th width="44">Доход</th>
    </tr>
    
    <?php foreach ($subs as $one): ?>
     
    <?php $cl = $sub[$one]; ?>
    
    <tr>
        <td style="font-size:9px" align='left'><?=$one?></td>
        <td class="thedate"><?=$cl['clicks']?></td>
        <td><?=$cl['waiting']?></td>
        <td class="gooddate"><?=$cl['approved']?></td>
        <td class="gooddate"><?=$cl['processing']?></td>
        <td class="gooddate"><?=$cl['sent']?></td>
        <td><?=$cl['nalozh']?></td>
        <td><?=$cl['nalozh_confirmed']?></td>
        <td><?=$cl['nalozh_sent']?></td>
        <td class="gooddate"><?=$cl['nalozh_ok']?></td>
        <td class="baddate"><?=$cl['nalozh_back']?></td>
        <td class="baddate"><?=$cl['cancelled']?></td>
        <td style='font-size:10px;'><?=H::econv ($cl['clicks'],$cl['conv']); ?>%</td>
        <td style='font-size:10px; color: #036;'><?=H::epc ($cl['clicks'],$cl['dohod']); ?>р.</td>
        <td class="gooddate"><?=H::mysum ($cl['dohod']); ?>р.</td>
        
    </tr>
    
    <?php endforeach; ?>
    
    <tr>
        <?php $cl = $totalstat2 ?>
        <td style="font-size:9px" align='left'><b>Все субаккаунты</b></td>
        <td class="thedate"><?=$cl['clicks']?></td>
        <td><?=$cl['waiting']?></td>
        <td class="gooddate"><?=$cl['approved']?></td>
        <td class="gooddate"><?=$cl['processing']?></td>
        <td class="gooddate"><?=$cl['sent']?></td>
        <td><?=$cl['nalozh']?></td>
        <td><?=$cl['nalozh_confirmed']?></td>
        <td><?=$cl['nalozh_sent']?></td>
        <td class="gooddate"><?=$cl['nalozh_ok']?></td>
        <td class="baddate"><?=$cl['nalozh_back']?></td>
        <td class="baddate"><?=$cl['cancelled']?></td>
        <td style='font-size:10px;'><?=H::econv ($cl['clicks'],$cl['conv']); ?>%</td>
        <td style='font-size:10px; color: #036;'><?=H::epc ($cl['clicks'],$cl['dohod']); ?>р.</td>
        <td class="gooddate"><?=H::mysum ($cl['dohod']); ?>р.</td>
        
    </tr>
    
    
</table>

    <p>&nbsp;</p>
    <p style="font-size:10px;">Для использования "своих" каналов (учёта кликов и конверсий) нужно использовать ссылку вида:<br><br>
        
        <b><?=Y::bu();?>ch/go/id/<span style="color:#C00">идтовара</span>/k/<span style="color:#080">нужный_канал</span>
    </p>
    
    
</div>

<?php endif; ?>