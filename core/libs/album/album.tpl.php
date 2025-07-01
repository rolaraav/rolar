<?php defined('A') or die('Access denied'); // основной шаблон галереи ?>
<div class="album_wrap">
<?php if (isset($files)): ?>
<?php foreach($files as $item):?>
<div class="song">
    <div class="song_title"><?=$item['id'].' - '.$item['title'];?> [Размер: <?=$item['size'];?> байт]</div>
    <?php if ($item['type'] == 'audio'): ?>
    <audio controls="controls">
        <source src="http://<?=DOWNLOAD_DOMEN.S.$item['path'].$item['name'];?>" type="audio/mpeg">
        Тег audio не поддерживается вашим браузером.
        <a href="http://<?=DOWNLOAD_DOMEN.S.$item['path'].$item['name'];?>" target="_blank">Скачать</a>.
    </audio>
    <?php else: ?>
    <video width="580" height="385" controls="controls" poster="<?=I.S;?>templates/all/video.jpg">
        <source src="http://<?=DOWNLOAD_DOMEN.$item['path'].$item['name'];?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
        Тег video не поддерживается вашим браузером.
        <a href="http://<?=DOWNLOAD_DOMEN.$item['path'].$item['name'];?>" target="_blank">Скачать</a>.
    </video>
    <?php endif; ?>
</div>
<div class="clear"></div>
  <?php endforeach;?>
<?php endif; ?>
</div>