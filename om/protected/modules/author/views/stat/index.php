<?php $this->pageTitle='Статистика'; ?>

<div class="wrap">

    <h3>Панель автора</h3>

    <h1>Статистика</h1>

<p><b>Выберите период: </b></p>

<br>

<?= CHtml::beginForm(array ()); ?>

<p>С <?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('startDate',$startDate)); ?>

по

<?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('stopDate',$stopDate)); ?>

<br><br>Для товара: </br>
<?= CHtml::dropDownList ('thegood',$thegood,array_merge(array(''=>'Все'),$gl)); ?>

<br><br>

<?= CHtml::submitButton('Показать статистику', array ('class' => 'submit')); ?>
<?= CHtml::endForm(); ?>

<p>&nbsp;</p>
<p>&nbsp;</p>

<h2>Статистика за период с <?=$startDate?> по <?=$stopDate?> для <?=(empty($thegood)?'ВСЕХ товаров':'товара: '.$gl[$thegood])?></h2>

<p>&nbsp;</p>


<p>&nbsp;</p>
<p>&nbsp;</p>

<?php

$flashChart = Yii::createComponent('application.extensions.openflashchart2.EOFC2');

$flashChart->begin();

if ($statKind == 'day') {

    $flashChart->setTitle('Статистика дохода продавца по дням за период с '.$startDate.' по '.$stopDate,'{color:#880a88;font-size:15px;padding-bottom:20px;}');

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

     $flashChart->setTitle('Статистика дохода продавца по месяцам за период с '.$startDate.' по '.$stopDate,'{color:#880a88;font-size:15px;padding-bottom:20px;}');

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

$flashChart->axis('y',array('range' => array(0,$max+10,$thestep)));

$flashChart->renderData('bar_glass');
$flashChart->render(650,450);


?>

<p>&nbsp;</p>
<p>&nbsp;</p>


<?php

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
$flashChart->axis('y',array('range' => array(0,$max+1,1)));

$flashChart->renderData('bar_filled',array ('colour' => '#E2D66A'));
$flashChart->render(650,450);


?>

<fieldset>

    <legend>Информация для выбранного периода</legend>

    <ol>

        <li>
            <label>Всего продано копий:</label><?=count($porders)?>
            
        </li>
        
        <li>
        <label>На общую сумму:</label><?=H::mysum($totalsum)?> рублей
        </li>


    </ol>


</fieldset>


</div>