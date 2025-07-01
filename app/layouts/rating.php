<?php defined('A') or die('Access denied');
if (isset($_COOKIE['news_quantity_vote']) and $_COOKIE['news_quantity_vote'] == $post['id']): ?>
  <p class="quantity_vote">Благодарим за Вашу оценку! Ваш голос учтён!</p>
<?php else: ?>
  <form action="" method="post" name="update_rating" target="_self">
  <p class="quantity_vote">Оцените заметку:
  0 <input class="quantity_vote_input" name="score" type="radio" value="0">
  1 <input class="quantity_vote_input" name="score" type="radio" value="1">
  2 <input class="quantity_vote_input" name="score" type="radio" value="2">
  3 <input class="quantity_vote_input" name="score" type="radio" value="3">
  4 <input class="quantity_vote_input" name="score" type="radio" value="4">
  5 <input class="quantity_vote_input" name="score" type="radio" value="5" checked="checked">
  <input name="id" type="hidden" value="<?=$post['id'];?>">
  <input class="button" id="quantity_vote_submit" name="quantity_vote_submit" type="submit" value="Оценить">
  </p>
  </form>
<?php
endif; ?>