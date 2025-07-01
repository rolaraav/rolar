<?php defined('A') or die('Access denied');
if (isset($post['price'])): ?>
  <div class="price">Цена: <span class="red1"><s><?php echo $post['price']*1.5.' руб.';?></s></span><span class="green1"><?php echo $post['price'].' руб.';?></span>
  <?php if (isset($post['buy_link'])):?>
    <div id="oformit_zakaz"><!--noindex--><a class="buy_link" href="<?=D.S.'bl'.$post['id'];?>" rel="nofollow" target="_blank" title="Нажмите на кнопку &quot;ОФОРМИТЬ ЗАКАЗ!&quot;, чтобы заказать данный продукт"></a><!--/noindex--></div>
  <?php endif; ?>
  <div class="image-center"><img src="<?=I.S;?>templates/all/platezhi.png" width="173px" height="21px">&nbsp;<img src="<?=I.S;?>templates/all/platezhi.jpg" width="170px" height="20px"></div>
  </div>
<?php endif; ?>