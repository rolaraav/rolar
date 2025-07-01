<?php $this->pageTitle='Оформление заказа - Выгодное предложение' ?>

<?php echo StepBar::showBar(2) ?>

<div class="wrap">

<h3>Выгодное предложение</h3>


<!-- Здесь можно вставить предварительный текст -->

<form method="post">

<?php foreach ($gl as $good): ?>

<div class="one_cart_item">

<h1><?=$good->title?></h1>

<?php $mgd = $good->id ?>

<div class="cart_descr">
<table border="0">
<tr>
<td width="600"><p><img src="<?=Y::bu()?>images/cart/<?=$good->id; ?>.jpg"></p>
</td>
<td width="230">
<div class="cart_pos">

<p>

<?php  $np = Special::check($tgood->id, $good->id); ?>
            
<?php if (!empty ($np)): ?>

 Цена:<span class="cart_old_price"><?=H::mysum($good->price)?><?=H::valuta($good->currency);?></span><br />
Для Вас:<span class="cart_price">
    
        <?=(H::mysum($np['sum'])); ?><?=H::valuta($np['valuta']);?></span>

   
    <?php elseif ($tgood->cartMinus>0): ?>
    
 Цена:<span class="cart_old_price"><?=H::mysum($good->price)?><?=H::valuta($good->currency);?></span><br />
Для Вас:<span class="cart_price">
    
        <?=(H::mysum($good->price-(ceil($good->price*$tgood->cartMinus/100)))); ?><?=H::valuta($good->currency);?></span>

    <?php else: ?>
        
Цена:<span class="cart_price"><?=$good->price?><?=H::valuta($good->currency);?></span><br />    
    
    <?php endif; ?>
    
    
         
</p>

<p align="center" class="cart_nd"><span id="<?=$mgd?>_txt"></span></p>
<p align="center"><img src="<?=Y::bu()?>images/front/order/cart.jpg" id="<?=$mgd?>_img" />
<img src="<?=Y::bu()?>images/front/order/cart_full.jpg" id="<?=$mgd?>_img_full" style="display:none" />
</p>
<div class="cart_btn">
<input class="submit" type="button" value="Добавить в корзину" id="<?=$mgd?>btn" />
<input class="submit" type="button" value="Отложить товар" id="<?=$mgd?>btn_off" style="display:none"/>
</div>


<script type="text/javascript">
<!--
	$(document).ready(function(){
							   
		$("#<?=$mgd?>btn").click (function () {														
				
				$("#<?=$mgd?>btn").hide ();
				$("#<?=$mgd?>btn_off").show ();
				
				$("#<?=$mgd?>_img").hide ();
				$("#<?=$mgd?>_img_full").show ();				
				
				$("#<?=$mgd?>_txt").html ('Товар добавлен <input type="hidden" name="goods[]" value="<?=$mgd?>" />');
				
				
			});
		
		$("#<?=$mgd?>btn_off").click (function () {														
				
				$("#<?=$mgd?>btn_off").hide ();
				$("#<?=$mgd?>btn").show ();
				
				$("#<?=$mgd?>_img_full").hide ();
				$("#<?=$mgd?>_img").show ();
				
				$("#<?=$mgd?>_txt").html('');				
				
			});
		

			   });

//-->
</script>

<div class="cart_btn">
<input id="subm" name="subm" class="submit" type="submit" value="Перейти в корзину"/>
</div>



</div>
</td>
</tr>
</table>

<div align="left">
<?=$good->cartText?>
</div>

</div>

</div>

<p>&nbsp;</p>




<?php endforeach; ?>



<div class="cart_btn">
<input id="subm" name="subm" class="submit" type="submit" value="Перейти в корзину"/>
</div>

</form>


</div>