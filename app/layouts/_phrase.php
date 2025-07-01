<?php defined('A') or die('Access denied');
/* Вывод мудрых фраз (начало) */
if (isset($phrase)): ?>
<!--   <div class="block">-->
<!--    <div class="blocktitle">Мудрые фразы</div>-->
    <div class="phrase"<?php if (isset($phrase['image'])): ?> style="background-image: url(<?=I.S.'phrases'.S.$phrase['image'];?>);"<?php endif; ?>>
    <div class="phraseblock"<?php if (isset($phrase['color'])): ?> style="color: <?=$phrase['color'];?>;"<?php endif; ?>>
      <div class="phrasetext"><?=$phrase['text'];?></div>
      <div class="phraseauthor"><?=$phrase['author'];?></div>
    </div>
    </div>
    <div class="clear"></div>
<!--   </div>-->
<?php endif;
/* Вывод мудрых фраз (конец) */
?>