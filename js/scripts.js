// Функции для работы галереи
// функция запуска просмотра изображений галереи при клике по изображению
function showImages(idImg,idGallery) {
    var gallery_view_img = $('.gallery_view_img');
    var gallery_view_bg = $('.gallery_view_bg');
    // получение значения прокрутки для IE8+ и других браузеров, работающих в режиме соответствия стандартам
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    // alert("scrollTop: " + scrollTop);
    // $(".gallery_wrap").offset().top - возвратит координаты первого элемента с классом gallery_wrap, относительно начала страницы
    $.ajax({
        url:domen + '?ajax=1',
        data:'image_id=' + idImg + '&gallery_id=' + idGallery,
        type:'POST',
        dataType:'json',
        success:function(html) {
            if (scrollTop>0) {
                var gallery_y = scrollTop*(-1); // координата Y по высоте расположения гелереи
                // $(".gallery_wrap").offset().top - возвратит координаты первого элемента с классом gallery_wrap, относительно начала страницы
                // alert("Условие 1");
            }
            else {
                var gallery_y = $("#wrapper").css('marginTop');
                // alert("Условие 2");
            }
            $("body").css({'overflow':'visible','position':'fixed'});
            $("#wrapper").css({'marginTop':gallery_y});
            // alert("gallery_y: " + gallery_y);

            var w_b = $(window).width(); // ширина в пикселах окна браузера пользователя
            var h_b = $(window).height(); // высота в пикселах окна браузера пользователя
            // показ скрытых блоков для изображения и фона и установка их ширины и высоты
            gallery_view_bg.css({'display':'block','width':w_b,'height':h_b});
            gallery_view_img.css({'display':'block','width':w_b,'height':h_b});
            gallery_view_img.empty();
            gallery_view_img.append(html);
        }
    });
}
// функция для отображения/скрытия всех комментариев в Галерее
function get_allgcomments(idGallery,idImg,obj,act,limit) {
	var offs = obj.attr('offs').split('/'); // получение значений атрибута offs
    // alert(offs[0]+'|'+offs[1]);
	if(parseInt(offs[1]) > parseInt(offs[0])) { // если общее количество комментариев больше лимита комментариев, то
		if(act == 'img') { // для изображений idGalery = 0
			idGallery = 0;
		}
		if(act == 'gal') { // для галереи idImg = 0
			idImg = 0;
		}
		$.ajax({
			url:domen + '?ajax=1',
			data:'image_id=' + idImg + '&gallery_id=' + idGallery + "&allcom=1&number=" + offs[1],
			type:'POST',
			success:function(html) {
				obj.next().append(html);
				obj.text("Скрыть лишние комментарии");
				obj.attr("offs",offs[1] + "/" + offs[1])
			}
		});
	}
	else {
		if(limit) { // если задан лимит и число комментариев превышает лимит
			var com = obj.next().children().slice(0,limit); // выбираем все дочерние элементы и выбираем только лимитированное количество комментариев
			obj.next().empty().html(com);
			obj.text("Показать все " + offs[1] + " комментариев(я)");
			obj.attr("offs",limit + "/" + offs[1]);
		}
	}
}

$(document).ready(function(){ /* функция ожидания загрузки страницы (начало) */
//jQuery('document').ready(function($) {
// акордеон категорий
$('.accordion').accordion({
  active: 0, /* активный по умолчанию заголовок (нумерация заголовков начинается с 0) */
  animated:'slide', /* позволяет изменить анимацию открытия вкладки или выключить ее (значение false) */
  autoHeight: true, /* указывает нужно ли подгонять высоту содержимого всех заголовков под высоту самого высокого заголовка (значение true) или нет (false) */
  collapsible: true, /* true - позволяет сворачивать содержимое активной вкладки, false - сворачивание запрещено */
  event: 'click', /* определяет событие, после вызова которого будут открываться вкладки */
  fillSpace: true, /* если имеет значение true виджет будет заполнять всю высоту родительского элемента */
	header: 'a.head',
  heightStyle: 'content',
  icons: {'header':'ui-icon-triangle-1-e','headerSelected':'ui-icon-triangle-1-s'} /* позволяет задать иконку, которая будет отображаться в заголовках виджета. Вид иконки задается с помощью объекта icons, свойство header которого задает иконку для заголовка с нераскрытой вкладкой, а headerSelected для заголовка с раскрытой вкладкой */
});
// акордеон категорий

// удаление
$('.button.delete').click(function(){
    var result = confirm("Вы действительно хотите удалить?");
    if(!result) return false;
});
// удаление

// постраничная навигация - определение количества постов на странице
$("#changeShow").change(function(){
    var quantity_posts = this.value;
    //console.log(quantity_posts);
    var adminpatch = location.href.match(/admin/); // определяем путь - админка или сайт
    if (adminpatch == 'admin') {
        $.cookie('admin_quantity_posts', quantity_posts, {expires:7, domen: '/admin'}); // {expires:7, domen: '/'}
    }
    else {
        $.cookie('quantity_posts', quantity_posts, {expires:7, domen: '/'}); // {expires:7, domen: '/'}
    }
    window.location = location.href;
});

// чекбокс "Запомнить меня" - сохранение отметки в куках
/*
var remember_checkbox = $("#authorization_remember_checkbox");
remember_checkbox.change(function(){
if (this.checked) {
    //alert('Выбран');
    $.cookie('remember', 'on', {expires:7, domen: '/user'}); // {expires:7, domen: '/'}
}
else {
    //alert('Не ыбран');
    $.cookie('remember', '', {expires:-1, domen: '/user'}); // {expires:7, domen: '/'}
}
});
*/

/* Скрипт для установки одинаковой высоты для колонок 2 (начало) */
function setEqualHeight2(columns) {
    var tallestcolumn = 0;
    columns.each(function() {
        currentHeight = $(this).height();
        if (currentHeight > tallestcolumn) {
            tallestcolumn = currentHeight;
        }
    });
    columns.height(tallestcolumn);
}
setEqualHeight2($(".left_half > div, .right_half > div"));
/* Скрипт для установки одинаковой высоты для колонок 2 (конец) */

/* Скрипт для установки одинаковой высоты для колонок 1 (начало) */
function setEqualHeight(columns) {
    var tallestcolumn = 0;
    columns.each(function() {
        currentHeight = $(this).height();
        if (currentHeight > tallestcolumn) {
            tallestcolumn = currentHeight;
        }
    });
    columns.height(tallestcolumn);
}
//setEqualHeight($("#centerblock, #leftblock, #rightblock"));
/* Скрипт для установки одинаковой высоты для колонок 1 (конец) */

  /* Поисковая форма Search */
  var search_posts;
  search_posts = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      wildcard: '%QUERY',
      url: domen + '/search/typeahead?query=%QUERY'
    }
  });
  search_posts.initialize();

  $('#typeahead').typeahead({
    // hint: false,
    minLength: 3,
    highlight: true // подсветка введёных букв и слов в результате поиска
  },{
    name: 'search_posts',
    display: 'title',
    limit: 10,
    source: search_posts
  });

  $('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    window.location = domen + '/search/?search=' + suggestion.id + '-' + encodeURIComponent(suggestion.title);
  });
  /* Поисковая форма Search */

/* Скрипт автозамены полей в форме поиска (начало) */
var search = $('.search_input_text');
search.focus(function() {
    if ($(this).attr('placeholder') == 'Поиск по сайту') {
        $(this).attr('placeholder','');
    }
});
search.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Поиск по сайту');
    }
});
/* Скрипт автозамены полей в форме поиска (конец) */

/* Скрипт автозамены полей в форме входа (начало) */
var login = $('#authorization_login_field');
var password = $('#authorization_password_field');
login.focus(function() {
    if ($(this).attr('placeholder') == 'Логин') {
        $(this).attr('placeholder','');
    }
});
password.focus(function() {
    if ($(this).attr('placeholder') == 'Пароль') {
        $(this).attr('placeholder','');
    }
});
login.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Логин');
    }
});
password.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Пароль');
    }
});
/* Скрипт автозамены полей в форме входа (конец) */

/* Скрипт автозамены полей в форме регистрации пользователя (начало) */
var first_name = $('#registration_first_name_field');
var login = $('#registration_login_field');
var password = $('#registration_password_field');
var email = $('#registration_email_field');
var code = $('#registration_code_field');
first_name.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваше имя') {
        $(this).attr('placeholder','');
        }
});
login.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш логин') {
        $(this).attr('placeholder','');
        }
});
password.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш пароль') {
        $(this).attr('placeholder','');
        }
});
email.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш e-mail') {
        $(this).attr('placeholder','');
        }
});
code.focus(function() {
    if ($(this).attr('placeholder') == 'Введите код с картинки') {
        $(this).attr('placeholder','');
        }
});
first_name.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваше имя');
        }
});
login.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш логин');
        }
});
password.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш пароль');
        }
});
email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш e-mail');
        }
});
code.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите код с картинки');
        }
});
/* Скрипт автозамены полей в форме регистрации пользователя (конец) */

/* Скрипт автозамены полей в форме восстановления пароля (начало) */
var login = $('#send_password_login_field');
var email = $('#send_password_email_field');
login.focus(function() {
    if ($(this).attr('placeholder') == 'Логин') {
        $(this).attr('placeholder','');
    }
});
email.focus(function() {
    if ($(this).attr('placeholder') == 'E-mail') {
        $(this).attr('placeholder','');
    }
});
login.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Логин');
    }
});
email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','E-mail');
    }
});
/* Скрипт автозамены полей в форме восстановления пароля (конец) */

/* Скрипт автозамены полей в форме восстановления логина (начало) */
var email = $('#send_login_email_field');
email.focus(function() {
    if ($(this).attr('placeholder') == 'E-mail') {
        $(this).attr('placeholder','');
    }
});
email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','E-mail');
    }
});
/* Скрипт автозамены полей в форме восстановления логина (конец) */

/* Скрипт автозамены полей в форме рассылки (начало) */
var name = $('#field_name_first,#user_name_first');
var email = $('#field_email,#user_email');
name.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваше имя') {
        $(this).attr('placeholder','');
        }
});
email.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш e-mail') {
        $(this).attr('placeholder','');
        }
});
name.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваше имя');
        }
});
email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш e-mail');
        }
});
/* Скрипт автозамены полей в форме рассылки (конец) */



/* Скрипт автозамены полей в форме комментариев (начало) */
var comment_author = $('#comment_author_name_field');
var author_email = $('#comment_author_email_field');
var author_site = $('#comment_author_site_field');
var comment_text = $('#comment_text_field');
comment_author.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваше имя') {
        $(this).attr('placeholder','');
    }
});
author_email.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш e-mail') {
        $(this).attr('placeholder','');
    }
});
author_site.focus(function() {
    if ($(this).attr('placeholder') == 'Введите адрес Вашего сайта (если есть)') {
        $(this).attr('placeholder','');
    }
});
comment_text.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваш комментарий') {
        $(this).attr('placeholder','');
    }
});
comment_author.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваше имя');
    }
});
author_email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш e-mail');
    }
});
author_site.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите адрес Вашего сайта (если есть)');
    }
});
comment_text.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваш комментарий');
    }
});
/* Скрипт автозамены полей в форме комментариев (конец) */

/* Скрипт автозамены полей в форме сообщений (начало) */
var message_text = $('#message_text_field');
message_text.focus(function() {
    if ($(this).attr('placeholder') == 'Введите Ваше сообщение') {
        $(this).attr('placeholder','');
    }
});
message_text.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Введите Ваше сообщение');
    }
});
/* Скрипт автозамены полей в форме сообщений (конец) */

/* Скрипт спойлера (начало) */
var spoilerhead = $('.spoilerhead');
var spoilerbody = $('.spoilerbody');
var spoilerfold = $('.spoilerfold');
spoilerhead.click(function () {
    if ($(this).siblings(spoilerbody).css('display') == 'none') {
        $(this).children().removeClass('fa fa-plus-square-o').addClass('fa fa-minus-square-o');
        //$(this).css({'backgroundImage':'url(../images/templates/all/minus.gif)'});
        $(this).siblings(spoilerbody).show("blind",500).css({'display':'block','visibility':'visible'});
    }
    else {
        $(this).children().removeClass('fa fa-minus-square-o').addClass('fa fa-plus-square-o');
        //$(this).css({'backgroundImage':'url(../images/templates/all/plus.gif)'});
        $(this).siblings(spoilerbody).hide("blind",500).css({'display':'none','visibility':'hidden'});
    }
});
spoilerfold.click(function () {
    //$('.spoilerhead').css({'backgroundImage':'url(../images/templates/all/plus.gif)'});
    $('.spoilerhead > i').removeClass('fa fa-minus-square-o').addClass('fa fa-plus-square-o');
    $(this).parent(spoilerbody).hide("blind",500).css({'display':'none','visibility':'hidden'});
});
/* Скрипт спойлера (конец) */

/* Скрипт показа комментариев (начало) */
var show_comments = $('.show_comments');
show_comments.toggle(function() {
    $(this).text('[Скрыть комментарии]');
    $(this).siblings('.comments_wrapper').show("blind",500).css({'display':'block','visibility':'visible'});
},function() {
    $(this).text('[Показать комментарии]');
    $(this).siblings('.comments_wrapper').hide("blind",500).css({'display':'none','visibility':'hidden'});
});
/* Скрипт показа комментариев (конец) */

/* Скрипт окна сообщений (начало) */
var message_block = $('#main2');
//var message_button = $('p.message_button > input.button');
function HideMessageBlock(){
    message_block.hide("blind",500);
}
message_block.show("blind",500).css({'display':'block','visibility':'visible'});
setTimeout(HideMessageBlock,10000);

var zakryt = $('input[value=Закрыть]');
zakryt.click(function(){
    message_block.hide("blind",500);
});

//if (message_button.click() == true) {
//    HideMessageBlock();
//}

//message_block.slideDown(1000).slideUp(1000);
/* Скрипт окна сообщений (конец) */


// Функции для работы галереи
/* Скрипт автозамены полей в форме отправки комментария галереи */
var gcomment_author = $('.gcomment_author');
var gcomment_email = $('.gcomment_email');
var gcomment_text = $('.gcomment_text');
gcomment_author.focus(function() {
    if ($(this).attr('placeholder') == 'Ваше имя') {
        $(this).attr('placeholder','');
        }
});
gcomment_email.focus(function() {
    if ($(this).attr('placeholder') == 'Ваш e-mail') {
        $(this).attr('placeholder','');
        }
});
gcomment_text.focus(function() {
    if ($(this).attr('placeholder') == 'Комментировать...') {
        $(this).attr('placeholder','');
        }
});
gcomment_author.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Ваше имя');
        }
});
gcomment_email.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Ваш e-mail');
        }
});
gcomment_text.blur(function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Комментировать...');
        }
});
$(".gallery_view_img").on('focus','.gcomment_author',function() {
    if ($(this).attr('placeholder') == 'Ваше имя') {
        $(this).attr('placeholder','');
        }
});
$(".gallery_view_img").on('focus','.gcomment_email',function() {
    if ($(this).attr('placeholder') == 'Ваш e-mail') {
        $(this).attr('placeholder','');
        }
});
$(".gallery_view_img").on('focus','.gcomment_text',function() {
    if ($(this).attr('placeholder') == 'Комментировать...') {
        $(this).attr('placeholder','');
        }
});
$(".gallery_view_img").on('blur','.gcomment_author',function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Ваше имя');
        }
});
$(".gallery_view_img").on('blur','.gcomment_email',function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Ваш e-mail');
        }
});
$(".gallery_view_img").on('blur','.gcomment_text',function() {
    if ($(this).attr('placeholder') == '') {
        $(this).attr('placeholder','Комментировать...');
        }
});
/* Скрипт автозамены полей в форме отправки комментария галереи (конец)) */

    // var gallery_view_img = $(".gallery_view_img");
    // var gallery_view_bg = $(".gallery_view_bg");
    // var gallery_wrap = $(".gallery_wrap");

    // используется делегирование событий
    // функция закрывания окна просмотра изображения
	$(".gallery_view_img").on('click','.gallery_close_img',function() {
        var marginTop2 = $("#wrapper").css('marginTop'); // определение величины отступа сверху
        marginTop2 = parseInt(marginTop2)*(-1);        
        // alert('marginTop2 = ' + marginTop2);
        $(".gallery_view_img").empty(); // чистка блока с изображением
		$(".gallery_view_bg, .gallery_view_img").css({'display':'none'}); // скрытие блока с изображением
		$("body").css({'overflow':'auto','position':'static'});
        $("#wrapper").css({'marginTop':0});
        var scrollTop = window.scrollTo(0,marginTop2); // установка скролбара
        // alert('scrollTop = ' + marginTop2);
	});

    // функция убирания тёмного фона изображения
	$(".gallery_view_img").on('click','.gallery_switch_img',function() {
       $(".gallery_view_bg").toggleClass("gallery_view_bg2"); // изменение прозрачности
	});

    // функция для ответа на комментарий
	$(".gallery_wrap").on('click','.gallery_reply', function() {
		var h = $(this).parents('.gallery_comment_single'); // выбор комментария
		var form = h.parent().parent().find('form'); // выбор формы
		var name = h.children('.gallery_comment_name').text() + ", "; // получаем имя отправителя родительского комментария
		var id = h.attr('id'); // получаем ID родительского комментария
		form.children().children().children('textarea').val(name).focus(); // вставляем имя отправителя родительского комменария
		form.children('input[name=parent_id]').val(id); // передаём ID родительского комментария
	});

    // функция для отправки комментариев
	$(".gallery_wrap").on('click','#send_gcomment',function() {
		var r = $(this).parent('form');
		var mydata = r.serializeArray(); // метод serializeArray() преобразует все выбранные элементы в массив
		$.ajax({
			url:domen + '?ajax=1',
			data:mydata,
			type:'POST',
			success:function(html) {
				if(html) {
					r.parent('div').prepend(html);
					r.parent('div').find('.gallery_not_comments').html('');
                    r.children().children().children('input[name=author]').val(''); // чистим поле ввода имени
                    r.children().children().children('input[name=email]').val(''); // чистим поле ввода емайл
                    r.children().children().children('textarea').val(''); // чистим поле ввода комментария
                    r.children('input[name=parent_id]').val(''); // чистим id родительского комментария (если оно есть) 
				}
			}
		});
	});

	var width_wrap = $(".gallery_wrap").width(); // определение ширины основного блока для галереи
	$(".gallery_line").each(function() { //выборка рядов изображений галереи
		var v = $(this);
		var count = 0; // результирующая суммарная ширина всех изображений
		v.children('img').each(function() {
			count += $(this).width();
		});
        // alert(width_wrap);
		var count_i = v.children('img').length - 1; // количество изображений, которым нужно добавить правый отступ
		var mr = Math.floor((width_wrap - count)/count_i); // величина отступа
		v.children('img').css({'marginRight':mr+'px'}); // добавление правого отступа всем изображениям в ряду
		v.children('img:last').css({'marginRight':'0px','marginLeft':width_wrap-(count+mr*count_i)+'px'}); // убирание правого отступа у последнего изображениям в ряду и добавление левого отступа к последнему изображению
	});

    // функция для ответа на комментарий
    $(".comments_wrap").on('click','.comments_reply', function() {
        //var h = $(this).chield('.comment'); // выбор комментария
        //var form = h.parent().parent().find('form'); // выбор формы
        //var name = h.children('.gallery_comment_name').text() + ", "; // получаем имя отправителя родительского комментария
        //var id = h.attr('id'); // получаем ID родительского комментария
        //form.children().children().children('textarea').val(name).focus(); // вставляем имя отправителя родительского комменария
        //form.children('input[name=parent_id]').val(id); // передаём ID родительского комментария
    });

    // функция для отправки emaila
	$("#get_email_form").on('click','#email_submitButton',function() {
		var r = $(this).parent('form');
		var email = r.serializeArray(); // метод serializeArray() преобразует все выбранные элементы в массив
	    var email_form = $(this).parent('form').parent('#get_email_form');
        var email_formOverlayer = email_form.next("#get_email_formOverlayer");
		$.ajax({
			url: './', // текущая страница window.location.href
			data:semail,
			type:'POST',
			success:function() {
                //alert (email_form);
                //alert (email_formOverlayer);
                email_form.children().children().children('input[name=semail]').val(''); // чистим поле ввода емайл
                email_form.css({'display':'none'});
                email_formOverlayer.css({'display':'none'});
			}
		});
	});

// обновление капчи
$("#codegen_link").click(function(e) {
    e.preventDefault();
    var src = 'core/vendors/codegen.php'+Math.random();
    //$("#codegen_img").attr('src',src);
    $("#registration_code_field").attr('placeholder','');
});

// функция для генерациии пароля (строка из 8 случайных символов)
    function password_generator() {
        var text = '';
        var possible = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@#$%^&*()-_+=|?'; // допустимые символы ~!@#$%^&*()-_+=|?
        for (var i = 0; i < 8; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }
//console.log(makeid());

// отображение пароля в формах регистрации и обновления пароля на странице пользователя
var password_field = $("#registration_password_field,#update_password_field,#create_user_password_field");
var generate_password = $("#registration_generate_password,#update_generate_password,#create_user_generate_password");
var show_password = $("#registration_show_password,#update_show_password,#create_user_show_password");
show_password.toggle(function() {
    $(this).attr('title','Скрыть пароль');
    $(this).children('i').attr('class','fa fa-eye-slash');
    password_field.attr('type','text');
    generate_password.css({'display':'block','visibility':'visible'});
},function() {
    $(this).attr('title','Показать пароль');
    $(this).children('i').attr('class','fa fa-eye');
    password_field.attr('type','password');
    generate_password.css({'display':'none','visibility':'hidden'});
});

// генерация пароля для формы регистрации
$("#registration_generate_password,#update_generate_password,#create_user_generate_password").click(function(e) {
    //registration_password_field.attr('type','text');
    password_field.val(password_generator());
});

// отображение пароля в форме авторизации
var authorization_password_field = $("#authorization_password_field");
var authorization_show_password = $("#authorization_show_password");
authorization_show_password.toggle(function() {
    $(this).attr('title','Скрыть пароль');
    $(this).children('i').attr('class','fa fa-eye-slash');
    authorization_password_field.attr('type','text');
},function() {
    $(this).attr('title','Показать пароль');
    $(this).children('i').attr('class','fa fa-eye');
    authorization_password_field.attr('type','password');
});

// асинхронная авторизация
var authorization_form = $('.blockhead:contains(Вход)').next();
//alert(authorization_form);
authorization_form.on('click','#authorization_submit_button',function(e) {
    e.preventDefault();
    var authorization_token = $('#authorization_token').val();
    var authorization_login = $('#authorization_login_field').val();
    var authorization_password = $('#authorization_password_field').val();
    var authorization_remember_checkbox = $('#authorization_remember_checkbox').is(':checked');
    var authorization_submit_button = $('#authorization_submit_button').val();
    //console.log(authorization_token+' | '+authorization_login+' | '+authorization_password+' | '+authorization_remember_checkbox+' | '+authorization_submit_button);
    $.ajax({
       url: './user/login',
       type: 'POST',
       data: {token: authorization_token, login: authorization_login, password: authorization_password, remember: authorization_remember_checkbox, authorization_submit: authorization_submit_button},
       success: function(res){
           //alert(res);
           authorization_form.html(res); // выводим ответ от сервера, в качестве ответа от сервера получаем html-код блока авторизации
       },
       error: function(){
           alert('Authorization error');
       }
    });
});

// Функция для установки куков при нажатии на ссылку оформления заказа курса по Cisco
// $('a[href$=om/ord/cisco]'); //выбор по конечным символам атрибута элемента // $('.cisco_order_link')
$('a[href$=cisco]').click(function(){
    //console.log('cisco');
    var now = new Date(); // alert(now); // текущее время
    var year = now.getFullYear();
    var month = now.getMonth();
    var day = now.getDate();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var milliseconds = now.getMilliseconds();
    var futureTime = new Date(year+1,month,day,hours,minutes,seconds,milliseconds); // alert(futureTime); // увеличить на год
    // var expires = futureTime.toISOString(); //alert(expires); // преобразуем в формат ISO
    var cookie_string = 'download_access='+escape('true')+'; expires='+futureTime+'; path=/cisco/;'; //alert(cookie_string); // строка с установкой куки
    $.cookie('download_access', escape('true'), {expires:futureTime, domen: '/cisco/'}); // {expires:7, domen: '/'}
    //document.cookie = cookie_string;
});

}); /* функция ожидания загрузки страницы (конец) */