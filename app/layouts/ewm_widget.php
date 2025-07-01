<?php defined('A') or die('Access denied');?>
<!-- EWM Widget (начало) -->
<!-- Разместите этот код в том месте, где должен отображаться виджет -->
<div class="ewm-widget-donate" data-guid="c4b93715-80a5-4833-b5fc-71256bf0a703" data-type="widget" data-height="170" data-width="210"></div>
<script type="text/javascript">//<!--
(function(w, d, id) {
  w.ewmAsyncWidgets = function() { EWM.Widgets.init(); };
  if (!d.getElementById(id)) {
    var s = d.createElement('script'); s.id = id; s.async = true; s.src = '//events.webmoney.ru/js/ewm-api.js?11';
    (d.getElementsByTagName('head')[0] || d.documentElement).appendChild(s);
  }
})(window, document, 'ewm-js-api');
//--></script>
<!-- EWM Widget (конец) -->