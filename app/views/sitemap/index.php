<?php defined('A') or die('Access denied');?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<?php echo '<h1>'.$title.'</h1>';
echo $text;

if (isset($sitemap)): ?>
<ol class="sitemap">
  <?php foreach($sitemap as $item): ?>
    <li><a href="<?=D.S.$item['alias']; ?>" target="_self"><?=$item['title']; ?></a>
    <?php if (isset($item['posts'])): ?>

      <?php if (isset($item['partners'])): ?>
      <ol>
        <?php foreach($item['partners'] as $value): ?>
          <li class="bold"><a href="<?=D.S.'partner_products?partner='.$value['id']; ?>" target="_self"><?=$value['title']; ?></a></li>
        <?php endforeach; ?>
      </ol>
      <?php endif; ?>

      <ol>
      <?php foreach($item['posts'] as $value): ?>
        <li><a href="<?=D.S.'post'.$value['id']; ?>" target="_self"><?=$value['title']; ?></a></li>
      <?php endforeach; ?>
      </ol>
    <?php endif; ?>

    <?php if (isset($item['courses'])): ?>
      <ol>
      <?php foreach($item['courses'] as $value): ?>
        <li><a href="<?=D.S.'course'.$value['id']; ?>" target="_self"><?=$value['title']; ?></a></li>
      <?php endforeach; ?>
      </ol>
    <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ol>
<?php endif; ?>
</div>

<div class="clear"></div>
</div>
</div>