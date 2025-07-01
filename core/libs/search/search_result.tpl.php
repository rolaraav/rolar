<?php defined('A') or die('Access denied'); ?>
<div class="search_result" id="search_result_element<?php echo $value['id']; ?>">
<h5><a href="<?=D.S.'post'.$value['id']; ?>" target="_top"><?php echo $value['title']; ?></a></h5>
<div class="search_text"><span><?php echo $value['text']; ?></span></div>
<div class="search_relevation">Количество совпадений: <?php echo $value['relevation']; ?></div>
</div>
<hr>