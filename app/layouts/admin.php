<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php //core\Controller::getMeta(); ?>
<link rel="stylesheet" href="<?=D.S;?>bootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="container">
<?php if (!empty($menu)): ?>
  <ul class="nav nav-pills">
  <?php foreach($menu as $item): ?>
    <li><a href="category/<?=$item['id'];?>"><?=$item['title'];?></a></li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
</div>
<h1>Админка</h1>

<?php echo $content; ?>

<?php //debug(vendor\core\Db::$countSql);?>
<?php //debug(vendor\core\Db::$queries);?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<?php
foreach ($scripts as $script) {
  echo $script;
}
?>
</body>
</html>