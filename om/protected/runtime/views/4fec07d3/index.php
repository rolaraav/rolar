<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views\bill\index.php */ ?>
<script type="text/javascript">
	var auto_submit = 0; //Поменяйте на 1 если хотите чтобы отправлялись способы автоматом при нажатии кнопки "Подробнее"
</script>

<?php $this->pageTitle='Оплата счёта #'.$model->id ?>

<?php if ($model->orders[0]->good_id == 'test2')  $this->redirect ('https://yandex.ru'); ?>

<?php if ($_GET['st']) echo StepBar::showBar(4) ?>

<div class="wrap">

<h3>Оплата счёта</h3>

<h1>Оплата счёта №<?=$model->id ?> от <?=date ('j.m.Y H:i',$model->createDate) ?></h1>

<h2>Сумма: <?=$model->sum ?><?=H::valuta($model->valuta) ?> 
    
<?php if ($model->valuta!='usd'): ?>
    (<?php $x = Valuta::conv ($model->sum,$model->valuta); echo $x['usd']; ?>$)

<?php endif; ?>

</h2>

<p align="center"><b>Ваша постоянная ссылка для отслеживания состояния данного заказа:</b><br><br>
    <a href="<?=$stlink?>" target="_blank"><?=$stlink?></a>
</p><br><br>


<p align="center"><span style="font-size:14px">Выберите желаемый способ оплаты.
        
        <?php if (!$fw): ?>
        
        <br><br>В колонке <b>&quot;Оплата через&quot;</b> оставьте <br />значение по умолчанию, если затрудняетесь выбрать.</span></p><br />
        
        <?php endif; ?>

<?php if ($good->nalozhOn || $good->kurier): ?>

<div align="center" class="wrap2">
<h3>Наложенный платеж</h3>

<div class="payimg">
<img src="<?=Y::bu()?>images/front/bill/<?=($model->strana=='Украина')?'ukrpost.jpg':'post.gif'?>">
</div>

<h4>Оплата наложенным платежом (при получении на почте)</h4>

Чтобы окончательно подтвердить заказ наложенным платежом, нажмите:
<form action="<?=$nalozhLink ?>" method="post">
    
    <?php if ($good->kurier): ?>
    <p style="padding: 20px; font-weight: bold;"><input type="checkbox" name="kurier" value="ok" class="checkbox" checked> Получить заказ курьером (вместо почты) в г.<?=CHtml::encode($model->gorod); ?></p>
    
    <?php endif; ?>

<div class="paybtn">
<input id="subm" class="submit" type="submit" value="Подтверждаю заказ наложенным платежом"/>
</div>

</form>

</div>

<?php endif; ?>

<?php $firstway = TRUE; ?>

<?php foreach ($wlist as $key=>$pl): ?>

<div class="wrap2">

<h3><?=$key?></h3>

<table width="600" align="center" border="0">

<tr>

<td width="30">&nbsp;</td>
<td width="40">&nbsp;</td>
<?php if ($firstway): ?>
<td><b>Способ</b></td>
<?php if (!$fw): ?>
<td width="120"><b>Оплата через</b></td>
<?php else: ?>
<td width="120">&nbsp;</td>
<?php endif; ?>
<?php else: ?>
<td>&nbsp;</td>
<td width="120">&nbsp;</td>
<?php endif; ?>

<td>&nbsp;</td>

<?php if ($firstway) $firstway = FALSE; //Только первая колонка с надписями ?>

</tr>

<?php foreach ($pl as $one): ?>

<tr>
<td><label style="padding:10px; margin:0px; width: 10px;"><input type="radio" class="radio" name="pway" value="<?=$one->plist_id?>" onclick="javascript:setway(<?=$one->plist_id?>);" /><label></td>
<td align="center">
<?php if (!empty ($one['url'])): ?>
<a href="<?=$one['url']?>" target="_blank"><img style="padding:4px;" src="<?=Y::bu()?>images/ways/<?=$one->pic?>.gif" /></a>
<?php else: ?>
<img style="padding:4px;" src="<?=Y::bu()?>images/ways/<?=$one->pic?>.gif" />
<?php endif; ?>
</td>
<td><?=$one->title?></td>
<td><div class="thr" id="th<?=$one->plist_id?>">
        
        <?php if ($fw): ?>
        &nbsp;<div class="hidden">
        <?php endif; ?>
        
        
<select class="selectway" id="sl_<?=$one->plist_id?>" onchange="javascript:showcode();">
<?php foreach ($one->ways as $way): ?>

<option value="<?=$way?>"><?=$ways[$way]->title?></option>

<?php endforeach; ?>
</select>
        
        <?php if ($fw): ?>
        </div>
        <?php endif; ?>
        
        
</div>
</td><td>
<div class="thr" id="thim<?=$one->plist_id?>">
<a title="Щёлкните, чтобы перейти к форме оплаты" href="#" class="myfocus">
<button>Подробнее</button>
</a>
</div>
</td>

</tr>

<?php endforeach; ?>

</table>

</div>

<?php endforeach; ?>


<?php foreach ($ways as $way): ?>

<?php    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	        'id'=>'dg_'.$way->way_id,            
	        'options'=>array(
	            'title'=>'Оплата через '.$way->title,
	            'autoOpen'=>false,
                'position' => array ('my' => 'center top','at' => 'center top+150'),
	            'modal'=>true,                    
                    'minWidth' => 550,                                        
                    'resizable' => false,
                    'draggable' => false,
	        ),
	    ));

?>

<div class="dialog_input" align="center">
    
     <a class="dclose" href="#"><span class="ui-icon ui-icon-closethick">Закрыть</span></a>
     
<p align="center">
<?=Way::repl($way->code,$values);?>
    
    </p>
    
</div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php endforeach; ?>


<input type="button" id="wayfocus" style="width:0; height:0; background-color:#FFFFFF; border:0;" value="" />

<div style="position:  absolute; left: -9999px; top: -9999px;" id="wayloader"></div>
<script type="text/javascript">
<!--

	var myway = '';
	var showbt = '';

	$(document).ready (function () {
	
	
	$(".myfocus").click (function () {
                dgg = '#dg_' + cd;
                
        form2x = $(dgg + " form");
        is_form = !(form2x.attr ("action")==undefined);                
                                        
        if (auto_submit == 1)
        {            
            if (is_form == false)
            {
                $(dgg).dialog("open");    
            }
        } else {
                $(dgg).dialog("open");    
        }
		
        
        //Запись способа
        <?php $glink = Y::bu().'waysave?bill_id='.$model->id.'&hash='.Bill::hashBill ($model->id).'&way=';?>
        
        glink = '<?=$glink;?>';
        loadlink = glink + cd;
        
        $("#wayloader").load (loadlink);
        
        if (is_form == true && auto_submit == 1)
        {
            form2x.submit ();    
        }   
        
		return false;
	});
        
        $(".dclose").click (function () {
            $(dgg).dialog("close");
            return false;
        });



	});

	
	function setway (way) {
		myway = way;
		show_thr ();
	}		

	function show_thr () {
		//Скрываем всё
		$(".thr").hide ();
		dv = '#th' + myway;
		dvt = '#thim' + myway;
		$(dv).show ();
		$(dvt).show ();
		showcode ();
	}
	
	function showcode () {
		nm = '#sl_' + myway;
		cd = $(nm).attr ('value');
		
		toshow = '#w_' + cd;
		showbt = '#bt_' + cd;
                //$(".oneway").hide ();				
		//$(toshow).show ();
						
	}	

//-->
</script>


<div style="text-align:center">Не нашли подходящий способ оплаты? Напишите нам <a href="mailto:support@domain.ru?subject=Как оплатить продукт" target="_blank" title="Написать письмо на email">на email</a> или <a href="<?php echo Y::bu();?>support/newticket" target="_blank" title="Написать тикет в службу поддержки">в службу поддержки</a>.</div>
</div>