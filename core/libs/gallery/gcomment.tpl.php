<?php defined('A') or die('Access denied'); // шаблон вывода одиночного комментария
if(is_array($gcomments)): //debug($gcomments); ?>
    <?php foreach($gcomments as $com) :?>
    <div class="gallery_comment_single" id="<?php echo (int)$com['id'];?>">
	<p class="gallery_comment_name"><?php echo $com['author'];?></p>
	<p class="gallery_comment_text"><?php echo $com['text'];?></p>
	<p><span class="gallery_comment_date"><?php $date_comment = rusdate('j %MONTH% Y, G:i:s',strdatetosec($com['date'])); echo $date_comment;?></span> | <span class="gallery_reply">Ответить</span></p>
    </div>
    <?php endforeach;?>
<?php else:?>
<p class="gallery_not_comments">Комментариев нет</p>
<?php endif;?>