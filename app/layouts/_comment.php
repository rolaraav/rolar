<?php defined('A') or die('Access denied');?>
<div class="comment">
<div class="commentauthoravatar"><img alt="<?=$comment_author;?>" class="avatarimage" src="<?=$comment_author_avatar;?>" title="<?=$comment_author;?>"></div>
<div class="commentinfo">
  <span class="commentauthor"><?=$comment_author_name;?></span>
  <span class="commentdate"><?=$date_comment;?></span>
</div>
<div class="commenttext"><?=$comment_text;?></div>
<div class="comment_reply"><a href="">Ответить</a></div>
<div class="clear"></div>
</div>