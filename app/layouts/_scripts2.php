<?php defined('A') or die('Access denied');?>
<script type="text/javascript">
  if((self.parent&&!(self.parent===self))&&(self.parent.frames.length!=0)){self.parent.location=document.location}
</script>
<script src="<?=D.S;?>js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/jquery-migrate-1.4.1.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/jquery.cookie.min.js" type="text/javascript"></script>
<!-- Изменяем имена плагинов jQuery UI для того чтобы они не совпадали с Bootstrap -->
<script type="text/javascript">
  $.widget.bridge('uitooltip', $.ui.tooltip);
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?=D.S;?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/bloodhound.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/scripts.js" type="text/javascript"></script>
<?php if ($prefix == 'admin'):?>
<script src="<?=D.S;?>js/formstone-core.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/formstone-upload.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/ajaxupload.js" type="text/javascript"></script>
<script src="<?=D.S;?>js/admin.js" type="text/javascript"></script>
<?php endif; ?>
<script src="<?=D.S;?>js/responsiveslides.min.js"></script>
<script>
$(function() {
  $('.rslides').responsiveSlides({
    auto: true,             // Boolean: Animate automatically, true or false
    speed: 500,            // Integer: Speed of the transition, in milliseconds
    timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
    pager: false,           // Boolean: Show pager, true or false
    nav: false,             // Boolean: Show navigation, true or false
    random: false,          // Boolean: Randomize the order of the slides, true or false
    pause: false,           // Boolean: Pause on hover, true or false
    pauseControls: true,    // Boolean: Pause when hovering controls, true or false
    prevText: 'Предыдущий',   // String: Text for the "previous" button
    nextText: 'Следующий',       // String: Text for the "next" button
    maxwidth: 580,           // Integer: Max-width of the slideshow, in pixels
    navContainer: 'div',       // Selector: Where controls should be appended to, default is after the 'ul'
    manualControls: '',     // Selector: Declare custom pager navigation
    namespace: 'rslides',   // String: Change the default namespace used
  });
  $('.ciscorslides').responsiveSlides({
    auto: true,             // Булевый тип: автоматическая анимация, true или false
    speed: 500,             // Целочисленный тип: Скорость смены слайда в миллисекундах
    timeout: 4000,          // Целочисленный тип: Время между сменой слайдов, в миллисекундах
    pager: true,            // Булевый тип: Показать пейджер, true или false
    nav: true,              // Булевый тип: Показать навигацию, true или false
    random: false,          // Булевый тип: Случайный порядок слайдов, true или false
    pause: false,           // Булевый тип: Пауза при наведении, true или false
    pauseControls: false,    // Булевый тип: Пауза при наведении на кнопки управления, true или false
    prevText: 'Предыдущий', // Строка: Текст для кнопки 'Предыдущий'
    nextText: 'Следующий',  // Строка: Текст для кнопки 'Следующий'
    maxwidth: 800,          // Целочисленный тип: Максимальная ширина слайд-шоу, в пикселях
    navContainer: 'div.rslides', // Селектор: Где должны помещаться кнопки управления, по умолчанию после 'ul'
    manualControls: '',     // Селектор: Объявите пользовательский пейджера навигации
    namespace: 'rslides',   // Строка: Изменить пространство имен, используемых по умолчанию
    //before: function(){}, // Функция: перед вызовом
    //after: function(){}   // Функция: после вызова
  });
});
</script>
<!-- <script src="../../js/scripts.js" type="text/javascript"></script> -->
<script>
/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
jQuery(function($){
  $.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
      'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
      'Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    weekHeader: 'Нед',
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['ru']);
});
$(function() {
  $("#update_birthday_field,#change_birthday_text").datepicker({
    defaultDate: new Date(1987, 0, 1),
    minDate: "-150Y", maxDate: "+1D",
    showOtherMonths: true,
    selectOtherMonths: true,
    showButtonPanel: true,
    changeMonth: true,
    changeYear: true,
    showAnim:'slideDown'
  });
});
</script>
<?php if (EDITOR == 'tinymce'): ?>
<!-- Подключение текстового редактора TinyMCE (начало) -->
<script src="<?=D.S;?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  tinyMCE.init({
    selector: '#text,#introduction_field,#text_field', // 'textarea'
    skin: 'lightgray',
    theme: 'modern',
    language: 'ru',
    max_height: 800,
    max_width: 800,
    min_height: 100,
    min_width: 400,
    resize: true,
    images_upload_base_path: domen+'/uploads',
    convert_urls : false,
    relative_urls: false,
    remove_script_host : false,
    plugins: [
      'advlist autolink autosave lists link image charmap print preview hr anchor pagebreak',
      'spellchecker searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality noneditable',
      'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar1: 'code visualchars visualblocks | undo redo | print preview fullscreen | cut copy paste | insert table | hr nonbreaking charmap | link image media | codesample emoticons',
    toolbar2: 'styleselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat',
    image_advtab: true,
    statusbar: true, // отображать строку состояния
    content_css : '<?=D.S;?>css/content.css',  // собственные таблицы стилей '/mycontent.css' - resolved to http://domain.mine/mycontent.css
    /* незадействованные плагины: autoresize bbcode example example_dependency importcss legacyoutput tabfocus */
    /* незадействованные кнопки: 'newdocument fullpage | styleselect formatselect blockquote insertdatetime searchreplace unlink anchor | subscript superscript | ltr rtl | spellchecker | template pagebreak restoredraft' */
  });
  </script>
<!-- Подключение текстового редактора TinyMCE (конец) -->
<?php elseif (EDITOR == 'ckeditor'): ?>
<!-- Подключение текстового редактора CKEditor (начало) -->
<!-- <script src="<?=D.S;?>js/ckeditor/ckeditor.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="<?=D.S;?>js/ckeditor/plugins/spoiler/spoiler.css">
<script src="<?=D.S;?>js/ckeditor/plugins/spoiler/spoiler.js"></script>
<script type="text/javascript">CKEDITOR.replace('text_field'); // поиск и замена по параметру id="text_field"
    CKEDITOR.replace('introduction_field');
    //var editor = CKEDITOR.replace('editor');
    //AjexFileManager.init({returnTo: 'ckeditor', editor: editor});
</script>
<!-- Подключение текстового редактора CKEditor (конец) -->
<?php endif;?>

<!--
<script type="text/javascript">
alert('Если эта надпись появилась, то javascript работает!');
</script>
-->

<!-- Smartresponder - скрипт для проверки введенных данных (начало) -->
<script language="javascript" type="text/javascript">
function SR_IsListSelected(el) {
  for (var i = 0; i < el.length; i ++)
    if (el[i].selected || el[i].checked) {
      return i;
    }
  return -1;
}
function SR_trim(f) {
  return f.toString().replace(/^[ ]+/, '').replace(/[ ]+$/, '');
}
function SR_submit(f) {
  f["email"].value = SR_trim(f["email"].value);
  f["first_name"].value = SR_trim(f["first_name"].value);
  if ((SR_focus = f["email"]) && f["email"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1 || (SR_focus = f["first_name"]) && f["first_name"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1) {
    alert("Укажите значения всех обязательных для заполнения полей (помечены звездочкой)");
    SR_focus.focus();
    return false;
  }
  if (!f["email"].value.match(/^[\+A-Za-z0-9][\+A-Za-z0-9\._-]*[\+A-Za-z0-9_]*@([A-Za-z0-9]+([A-Za-z0-9-]*[A-Za-z0-9]+)*\.)+[A-Za-z]+$/)) {
    alert("Некорректный синтаксис email-адреса!");
    f["email"].focus();
    return false;
  }
  /*  if (!f["first_name"].value.match(^[А-Яа-яA-Za-z]*$)) {
          alert("Значение поля \"Ваше имя\" не удовлетворяет описанию: Буквы русского и английского алфавитов");
          f["first_name"].focus();
          return false;
      } */
  return true;
}
</script>
<!-- Smartresponder - скрипт для проверки введенных данных (конец) -->

<!-- SyntaxHighlighter 3.0.83 - скрипт для подсветки синтаксиса (начало) -->
<!-- Подключаем таблицы стилей, ядро скрипта, необходимые кисти и добавляем функцию для подсветки синтаксиса -->
<link href="<?=D.S;?>syntaxhighlighter/styles/shCore.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>syntaxhighlighter/styles/shThemeDefault.css" rel="stylesheet" type="text/css">
<script src="<?=D.S;?>syntaxhighlighter/scripts/shCore.js" type="text/javascript"></script>
<script src="<?=D.S;?>syntaxhighlighter/scripts/shBrushXml.js" type="text/javascript"></script>
<script src="<?=D.S;?>syntaxhighlighter/scripts/shBrushCss.js" type="text/javascript"></script>
<script src="<?=D.S;?>syntaxhighlighter/scripts/shBrushPhp.js" type="text/javascript"></script>
<script src="<?=D.S;?>syntaxhighlighter/scripts/shBrushJScript.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushPerl.js"></script> -->
<script type="text/javascript">
/* SyntaxHighlighter.config.clipboardSwf = 'scripts/clipboard.swf'; Применялось во 2ой версии для копирования кода в буфер обмена */
SyntaxHighlighter.config.stripBrs = true; /* Включить игнорирование тегов переноса строки <br>, по умолчанию false */
SyntaxHighlighter.defaults['auto-links'] = false; /* Включить блокировку ссылок, по умолчанию true */
/* SyntaxHighlighter.defaults['html-script'] = true; Включить подсветку HTML-кода совместно с javascript, php, или css, по умолчанию false */
SyntaxHighlighter.defaults['toolbar'] = false; /* Выключить панель управления, по умолчанию true */
SyntaxHighlighter.all();
</script>
<!-- SyntaxHighlighter 3.0.83 - скрипт для подсветки синтаксиса (конец) -->

<!-- popuper begin -->
<!-- <script type="text/javascript" src="js/jquery_popuper.js"></script> -->
<!-- <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> -->
<?php if (POPUPER == 1) {
  echo '<script type="text/javascript" src="'.D.S.'js/popuper.js"></script>';
}?>
<!--[if lte IE 8]>
<link href="<?=D.S;?>css/popuper-ie.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=D.S;?>js/pie.js"></script>
<script>
$(function() {
  if (window.PIE) {
    $('.rounded').each(function() {
      PIE.attach(this);
    });
  }
});
</script>
<![endif]-->
<!--[if lte IE 9]>
<script type="text/javascript" src="<?=D.S;?>js/placeholder.js"></script>
<![endif]-->
<!-- popuper end -->

<!-- Ссылка наверх (начало) -->
<script src="<?=D.S;?>js/jquery.scrollup.js" type="text/javascript"></script>
<script type="text/javascript">
    // Parse URL Queries Method
    (function($){
        $.getQuery = function( query ) {
            query = query.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var expr = "[\\?&]"+query+"=([^&#]*)";
            var regex = new RegExp( expr );
            var results = regex.exec( window.location.href );
            if( results !== null ) {
                return results[1];
                return decodeURIComponent(results[1].replace(/\+/g, " "));
            } else {
                return false;
            }
        };
    })(jQuery);
    $(function () {
        $.scrollUp({
            activeOverlay: '#00FFFF',
        });
    });
</script>
<!-- Ссылка наверх (конец) -->

<!-- fancyBox 2.1.5 (начало) -->
<!-- Add jQuery library (подключение библиотеки jQuery происходит выше) -->

<!-- Add mousewheel plugin (this is optional) (добавление плагина для прокрутки ролика мыши) -->
<script type="text/javascript" src="<?=D.S;?>fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox (добавление fancyBox) -->
<link rel="stylesheet" href="<?=D.S;?>fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen">
<script type="text/javascript" src="<?=D.S;?>fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media (добавление дополнительных функций - кнопок, миниатюр, мультимедиа) -->
<link rel="stylesheet" href="<?=D.S;?>fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen">
<script type="text/javascript" src="<?=D.S;?>fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?=D.S;?>fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="<?=D.S;?>fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen">
<script type="text/javascript" src="<?=D.S;?>fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
$(document).ready(function() {
// Optionally: preload watermark image (Предварительная загрузка водяного знака)
  new Image().src = '<?=D.S;?>images/templates/all/created_by_rolar.png';

// Настройки fancyBox для прочих объектов (для картинок в новостях, партнерских продуктах, закачках и пр.)
  $(".fancybox").fancybox({
    padding: 10,
    margin: 0,

    openEffect: 'elastic', // fade - изменение прозрачности (плавное появление и затухание), elastic - выезд, none - без эффектов
    openSpeed: 150,
    closeEffect: 'elastic',
    closeSpeed: 150,
    nextEffect: 'fade',
    nextSpeed: 150,
    prevEffect: 'fade',
    prevSpeed: 150,

    maxWidth: 1280,
    maxHeight: 1024,
    width: '70%',
    height: '70%',
    autoSize: true,

    closeClick: false, // false - запретить закрытие окна, при нажатии на него, true - разрешить
    closeBtn: true, // false - скрыть кнопку закрытия, true - показать

    iframe: {
      preload: false, // false - не запускать предварительную загрузку сорержимого, пока загрзка не закончена
    },

    helpers: {
      overlay: { // null - без наложения
        closeClick: false,  // true - fancyBox будет закрыт, когда пользователь нажмет по наложению, false - не закроется
        speedOut: 150, // скорость исчезания фона
        showEarly: true, // true - показывать оверлей сразу (по умолчанию), false - показывать оверлей после полной загрузки контента
        css: {
          'background' : 'rgba(0,0,0,0.3)', // цвет фона наложения
        },
        locked: true, // true - блокирует скроллинг страницы, false - разрешает прокрутку
      },
      title: { // null - без заголовка
        type: 'inside', // inside - внутри блока, outside - снаружи блока, over - над блоком, float - рядом под блоком
        position: 'bottom', // расположение заголовка - сверху или снизу
      },
    },

    beforeShow: function () {
      /* Disable right click (Отключение правой клавиши на блоке) */
      $.fancybox.wrap.bind("contextmenu", function (e) {
        return false;
      });
    },
  });

// Настройки fancyBox для одиночного изображения в тексте/контенте
  $(".fancyboximage").fancybox({
    padding: 10,
    margin: 0,

    openEffect: 'elastic', // fade - изменение прозрачности (плавное появление и затухание), elastic - выезд, none - без эффектов
    openSpeed: 150,
    closeEffect: 'elastic',
    closeSpeed: 150,
    nextEffect: 'fade',
    nextSpeed: 150,
    prevEffect: 'fade',
    prevSpeed: 150,

    maxWidth: 1280,
    maxHeight: 1024,
    width: '70%',
    height: '70%',
    autoSize: true,

    closeClick: false, // false - запретить закрытие окна, при нажатии на него, true - разрешить
    closeBtn: true, // false - скрыть кнопку закрытия, true - показать

    helpers: {
      overlay: { // null - без наложения
        closeClick: false,  // true - fancyBox будет закрыт, когда пользователь нажмет по наложению, false - не закроется
        speedOut: 150, // скорость исчезания фона
        showEarly: true, // true - показывать оверлей сразу (по умолчанию), false - показывать оверлей после полной загрузки контента
        css: {
          'background' : 'rgba(0,0,0,0.3)', // цвет фона наложения
        },
        locked: true, // true - блокирует скроллинг страницы, false - разрешает прокрутку
      },
      title: { // null - без заголовка
        type: 'inside', // inside - внутри блока, outside - снаружи блока, over - над блоком, float - рядом под блоком
        position: 'bottom', // расположение заголовка - сверху или снизу
      },
    },

    beforeShow: function () {
      /* Disable right click (Отключение правой клавиши на блоке) */
      $.fancybox.wrap.bind("contextmenu", function (e) {
        return false;
      });
      /* Add watermark (Добавление водяного знака) */
      $('<div class="watermark"></div>')
        .bind("contextmenu", function (e) {
          return false; /* Disables right click (Отключение правой клавиши на водяном знаке) */
        })
        .prependTo($.fancybox.inner);
    },
  });

// Настройки fancyBox для скриншотов
  $(".fancyboxscreenshot")
    .attr('rel', 'gallery')
    .fancybox({
      padding: 10,
      margin: 0,

      openEffect: 'elastic', // fade - изменение прозрачности (плавное появление и затухание), elastic - выезд, none - без эффектов
      openSpeed: 150,
      closeEffect: 'elastic',
      closeSpeed: 150,
      nextEffect: 'fade',
      nextSpeed: 150,
      prevEffect: 'fade',
      prevSpeed: 150,

      maxWidth: 1280,
      maxHeight: 1024,
      width: '70%',
      height: '70%',
      autoSize: true,

      closeClick: false, // false - запретить закрытие окна, при нажатии на него, true - разрешить
      closeBtn: true, // false - скрыть кнопку закрытия, true - показать

      helpers: {
        overlay: { // null - без наложения
          closeClick: false,  // true - fancyBox будет закрыт, когда пользователь нажмет по наложению, false - не закроется
          speedOut: 150, // скорость исчезания фона
          showEarly: true, // true - показывать оверлей сразу (по умолчанию), false - показывать оверлей после полной загрузки контента
          css: {
            'background' : 'rgba(0,0,0,0.3)', // цвет фона наложения
          },
          locked: true, // true - блокирует скроллинг страницы, false - разрешает прокрутку
        },
        title: { // null - без заголовка
          type: 'inside', // inside - внутри блока, outside - снаружи блока, over - над блоком, float - рядом под блоком
          position: 'bottom', // расположение заголовка - сверху или снизу
        },
        thumbs: {
          width: 50,
          height: 50,
          position: 'bottom',
        },
        buttons: {}, // включает кнопки
      },

      beforeShow: function () {
        /* Disable right click (Отключение правой клавиши на блоке) */
        $.fancybox.wrap.bind("contextmenu", function (e) {
          return false;
        });
        /* Add watermark (Добавление водяного знака) */
        $('<div class="watermark"></div>')
          .bind("contextmenu", function (e) {
            return false; /* Disables right click (Отключение правой клавиши на водяном знаке) */
          })
          .prependTo($.fancybox.inner);
      }
    });

// Настройки fancyBox для группы изображений (галереи)
  $(".fancyboxgallery")
    .attr('rel', 'gallery')
    .fancybox({
      padding: 10,
      margin: 0,

      openEffect: 'elastic', // fade - изменение прозрачности (плавное появление и затухание), elastic - выезд, none - без эффектов
      openSpeed: 150,
      closeEffect: 'elastic',
      closeSpeed: 150,
      nextEffect: 'fade',
      nextSpeed: 150,
      prevEffect: 'fade',
      prevSpeed: 150,

      maxWidth: 1280,
      maxHeight: 1024,
      width: '70%',
      height: '70%',
      autoSize: true,

      closeClick: false, // false - запретить закрытие окна, при нажатии на него, true - разрешить
      closeBtn: true, // false - скрыть кнопку закрытия, true - показать

      helpers: {
        overlay: { // null - без наложения
          closeClick: false,  // true - fancyBox будет закрыт, когда пользователь нажмет по наложению, false - не закроется
          speedOut: 150, // скорость исчезания фона
          showEarly: true, // true - показывать оверлей сразу (по умолчанию), false - показывать оверлей после полной загрузки контента
          css: {
            'background' : 'rgba(0,0,0,0.3)', // цвет фона наложения
          },
          locked: true, // true - блокирует скроллинг страницы, false - разрешает прокрутку
        },
        title: { // null - без заголовка
          type: 'inside', // inside - внутри блока, outside - снаружи блока, over - над блоком, float - рядом под блоком
          position: 'bottom', // расположение заголовка - сверху или снизу
        },
        thumbs: {
          width: 50,
          height: 50,
          position: 'bottom',
        },
        buttons: {}, // включает кнопки
      },

      beforeShow: function () {
        /* Disable right click (Отключение правой клавиши на блоке) */
        $.fancybox.wrap.bind("contextmenu", function (e) {
          return false;
        });
      }
    });

// Настройки fancyBox для видео
  $(".fancyboxvideo").fancybox({
    padding: 10,
    margin: 0,

    openEffect: 'elastic', // fade - изменение прозрачности (плавное появление и затухание), elastic - выезд, none - без эффектов
    openSpeed: 150,
    closeEffect: 'elastic',
    closeSpeed: 150,
    nextEffect: 'fade',
    nextSpeed: 150,
    prevEffect: 'fade',
    prevSpeed: 150,

    maxWidth: 1920,
    maxHeight: 1080,
    width: '70%',
    height: '70%',
    autoSize: true,

    closeClick: false, // false - запретить закрытие окна, при нажатии на него, true - разрешить
    closeBtn: true, // false - скрыть кнопку закрытия, true - показать

    iframe: {
      preload: false, // false - не запускать предварительную загрузку сорержимого, пока загрзка не закончена
    },

    helpers: {
      overlay: { // null - без наложения
        closeClick: false,  // true - fancyBox будет закрыт, когда пользователь нажмет по наложению, false - не закроется
        speedOut: 150, // скорость исчезания фона
        showEarly: true, // true - показывать оверлей сразу (по умолчанию), false - показывать оверлей после полной загрузки контента
        css: {
          'background' : 'rgba(0,0,0,0.3)', // цвет фона наложения
        },
        locked: true, // true - блокирует скроллинг страницы, false - разрешает прокрутку
      },
      title: { // null - без заголовка
        type: 'inside', // inside - внутри блока, outside - снаружи блока, over - над блоком, float - рядом под блоком
        position: 'bottom', // расположение заголовка - сверху или снизу
      },
    },

    beforeShow: function () {
      /* Disable right click (Отключение правой клавиши на блоке) */
      $.fancybox.wrap.bind("contextmenu", function (e) {
        return false;
      });
    },
  });

});
</script>
<!-- fancyBox 2.1.5 (конец) -->