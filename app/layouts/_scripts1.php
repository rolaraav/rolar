<?php defined('A') or die('Access denied');?>
<!-- Подключение API-модулей Вконтакте (начало) -->
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
<script type="text/javascript" src="https://vk.com/js/api/share.js?86" charset="windows-1251"></script>
<script type="text/javascript">
  VK.init({apiId: 3417892, onlyWidgets: true});
</script>
<!-- Подключение API-модулей Вконтакте (конец) -->
<!-- Комментарии Вконтакте (начало) -->
<script type="text/javascript">
  VK.Widgets.Comments("vk_comments", {limit: 10, width: "580", attach: "*"});
</script>
<!-- Комментарии Вконтакте (конец) -->
<!-- Подключение API-модулей Facebook (начало) -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Подключение API-модулей Facebook (конец) -->
<!-- Setup the Facebook SDK for JavaScript (begin) -->
<script>
window.fbAsyncInit = function() {
  FB.init({
    appId      : '620288824784224',
    xfbml      : true,
    version    : 'v2.2'
  });
};
(function(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<!-- Setup the Facebook SDK for JavaScript (end) -->
<script type="text/javascript">
  //var path = '<?php echo D; ?>';
  var domen='<?=D;?>';
</script>
<?php if (EDITOR == 'ckeditor'): ?>
<!-- Подключение текстового редактора CKEditor (начало) -->
<script src="<?=D.S;?>js/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- <link rel="stylesheet" href="<?=D.S;?>js/ckeditor/plugins/spoiler/spoiler.css"> -->
<!-- <script src="<?=D.S;?>js/ckeditor/plugins/spoiler/spoiler.js"></script> -->
<!-- Подключение текстового редактора CKEditor (конец) -->
<?php endif; ?>