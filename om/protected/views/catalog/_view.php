<div class="onegood">

<h2><?= CHtml::encode($data->title); ?></h2>


<?php if (!empty ($data->image)): ?>

<p align="center" class="catalog_pic">
	<img src="<?=$data->image ?>" />
</p>

<?php endif; ?>

<div class="catalog_descr">

<p><?=$data->description ?></p>

</div>

<br />

<p align="center" class="catalog_price"><?=H::mysum($data->price) ?><?=H::valuta($data->currency) ?></p>

<br />

<table border="0" align="center" style="border:0">
<tr >

<?php if (!empty ($data->affLink)): ?>
	<td align="center" style="border:0">
	<form method="get" action="<?=$data->affLink ?>" target="_blank">
	<button type="submit" class="button"><img src="<?= Y::bu()?>images/front/catalog/read_more.gif" style="vertical-align:middle" /> Узнать подробнее
    </button>  &nbsp; &nbsp; &nbsp;
    </form>
    </td>    
<?php endif; ?>

<td align="center" style="border:0">
	<form method="get" action="<?= Y::bu()?>ord/<?=$data->id ?>" target="_blank">
	<button type="submit" class="button"><img src="<?= Y::bu()?>images/front/catalog/order_now.gif" style="vertical-align:middle" /> Заказать сейчас
    </button>  &nbsp; &nbsp; &nbsp;
    </form>
</td>

<?php if (Settings::item('usualCartOn')==1): ?>
<td align="center" style="border:0">

        <?php if (Y::isIE()): ?>

	<form method="get" action="<?=Y::bu()?>/catalog/ajaxcart/id/<?=$data->id?>">
    
    <button type="submit" class="button"><img src="<?=Y::bu()?>images/front/catalog/add2cart.gif" style="vertical-align:middle" /> Добавить в корзину</button>
    
    &nbsp; &nbsp; &nbsp;
    </form>
    
        <?php else: ?>
        
	<form method="get" action="#" onSubmit="return false">
    
    <?= NHtml::ajaxSButton('<img src="' . Y::bu() . 'images/front/catalog/add2cart.gif" style="vertical-align:middle" /> Добавить в корзину',
    				 array('/catalog/ajaxcart/id/'.$data->id), array('update'=>'#usualCart'), array ('encode' => FALSE, 'id' => 'but_' . $data->id, 'type' => 'submit')); ?>
    
    &nbsp; &nbsp; &nbsp;
    </form>        
            
            
        <?php endif; ?>

</td>
<?php endif; ?>

</tr>
</table>

<br />

</div>

<br />