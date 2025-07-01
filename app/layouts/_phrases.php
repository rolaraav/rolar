<?php defined('A') or die('Access denied');
/* Вывод мудрых фраз (начало) */
if (!empty($phrases)):
    foreach($phrases as $phrase): ?>
    <div class="phrase"<?php if (isset($phrase['image'])): ?> style="background-image: url(<?='../images/phrases/'.$phrase['image'];?>);"<?php endif; ?>>
    <div class="phraseblock"<?php if (isset($phrase['color'])): ?> style="color: <?=$phrase['color'];?>;"<?php endif; ?>>
      <div class="phrasetext"><?=$phrase['text'];?></div>
      <div class="phraseauthor"><?=$phrase['author'];?></div>
    </div>
    </div><br>
    <div class="clear"></div>
<?php endforeach;
else: ?>
    <div class="block"><div class="blockhead"></div><div class="blockbody"><?=$if_empty;?></div></div>
<?php endif;
/* Вывод мудрых фраз (конец) */
?>