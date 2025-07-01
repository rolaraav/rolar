<?php defined('A') or die('Access denied'); // шаблон вывода всех комментариев и блока комментариев ?>
<div class="gallery_comments">
<p class="gallery_comments_title">Комментарии</p>
<?php if(isset($comments_str)):
    if(($count_gcomments - G_LIMIT_COMMENTS) > 0) :?>
    <div class="gallery_next_comment" offs="<?php echo G_LIMIT_COMMENTS;?>/<?php echo $count_gcomments;?>" onclick="get_allgcomments(<?php echo $gallery_id ? $gallery_id : 0;?>,<?php echo $image_id ? $image_id : 0;?>,$(this),'<?php echo $act;?>',<?php echo G_LIMIT_COMMENTS;?>)">Показать все <?php echo $count_gcomments;?> комментариев(я)</div>
	<?php endif;?>
    <div class="gallery_list_comments">
	<?php echo $comments_str; //вывод полученных комментариев ?>
	</div>
<?php endif;?>
<p class="gallery_comment_new">Добавить комментарий</p>
<form name="add_gcomment">
    <div class="gallery_input"><label>Имя:<br><input class="gcomment_author" maxlength="30" name="author" placeholder="Ваше имя" size="50" type="text"></label></div>
    <div class="gallery_input"><label>E-mail:<br><input class="gcomment_email" maxlength="30" name="email" placeholder="Ваш e-mail" size="50" type="text"></label></div>
    <input type="hidden" name="image_id" value="<?php if (isset($image_id)) {echo $image_id;} else {echo 0;} ?>">
    <input type="hidden" name="gallery_id" value="<?php echo $gallery_id;?>">
    <input type="hidden" name="parent_id" value="">
    <input type="hidden" name="act" value="<?php echo $act;?>">
    <div class="gallery_input"><label>Текст:<br><textarea class="gcomment_text" cols="60" name="text" placeholder="Комментировать..." rows="10"></textarea></label></div>
    <input class="button" id="send_gcomment" name="send_gcomment" type="button" value="Отправить">
</form>
</div>