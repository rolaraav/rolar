<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views/catalog/_ajaxcart.php */ ?>
<?php $goods = UsualCart::listGoods(); ?>

<?php if (($goods!==FALSE) AND (Settings::item('usualCartOn')==1)): ?>

<div class="wrap" id="mainCart">

<h3>Корзина</h3>

<h1>Содержимое Вашей Корзины</h1>

<input type="button" id="cartfocus" style="width:0; height:0; background-color:#FFFFFF; border:0;" value="" />

<table width="700px" align="center" border="0">

<tr>

<td align="left" width="120" valign="top">	
	<img style="margin:15px;" src="<?= Y::bu() ?>images/front/catalog/cart.jpg" />
</td>

<td align="center" valign="top">

	<div class="cart_table">
    	
		<table border="0" width="100%" align="center">
		<tr>
			<td width="30"><b>№</b></td>
			<td><b>Название</b></td>
			<td width="80"  align="center"><b>Цена</b></td>
            <td width="18">&nbsp;</td>
		</tr>

		<?php         $n = 0;
         $total = 0;
        ?>
		<?php foreach ($goods as $good): ?>
        <?php
        	$n++;
            $total += $good['rurcena'];
        ?>
		<tr>
        	<td><?= $n ?></td>
            <td><?= $good['title'] ?></td>
            <td align="center"><?= H::mysum($good['price']).H::valuta ($good['currency']) ?></td>
            <td width="18">
            		    <?= CHtml::link('<img src="'. Y::bu().'images/front/catalog/delete_icon.gif">',
    				 array('/catalog/cartdel?id='.$good['id'].'&token='.$good['token'])); ?> 
            </td>
        </tr>
        <?php endforeach ?>

        

</table>

	<p>&nbsp;</p>
    <?php $totalusd = Valuta::conv ($total,'rur'); $totalusd = $totalusd['usd']; ?>
	<p align="left"><b>Общая сумма: </b> <?= H::mysum ($total).H::valuta('rur') ?> = <?= H::mysum ($totalusd).H::valuta('usd') ?> </p>
    
    </div>
</td>

</tr>

<tr>
	<td>&nbsp;</td>
    <td align="center">   
    
    	<br />
    	<div class="cart_buttons">
	    <table border="0" align="center" style="border:0">
		<tr >
        
		<td align="center" style="border:0">
        
        <?php if (Y::isIE()): ?>

			<form method="get" action="<?=Y::bu()?>/catalog/ajaxempty">
    
		    <input type="submit" value="Очистить корзину" type="submit">    
		    &nbsp; &nbsp; &nbsp;
		    </form>    
           
        <?php else: ?>
        
			<form method="get" action="#" onSubmit="return false">
    
		    <?= NHtml::ajaxSButton(' Очистить корзину',
    				 array('/catalog/ajaxempty'), array('update'=>'#usualCart'), array ('encode' => FALSE, 'type' => 'submit')); ?>
    
		    &nbsp; &nbsp; &nbsp;
		    </form>            
        
        <?php endif; ?>
        
       </td>        
        
	    <td align="center" style="border:0">
			<form method="get" action="<?= Y::bu()?>cartorder" target="_blank">
			<button type="submit" style="width:145px">Оформить заказ</button>  &nbsp; &nbsp; &nbsp;
		    </form>
	    </td>
    
       </tr>
       </table>
       </div> 
    
    </td>

</tr>


</table>

</div>

<?php if (isset ($added)): ?>

<script language="javascript">
	//alert ('Товар успешно добавлен в Корзину');
	$('#cartfocus').focus ();
</script>

<?php endif; ?>

<br />

<?php endif; ?>