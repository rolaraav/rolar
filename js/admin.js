// Обработчик отправки писем
$(function(){
	$('#contact').submit(function(){
		var errors = false;
		$(this).find('span').empty();
        $(this).find('.logmessage').empty();

		$(this).find('input:not(#emailfile), textarea').each(function(){
			if( $.trim( $(this).val() ) == '' ) {
				errors = true;
				$(this).next().text( 'Не заполнено поле ' + $(this).prev().text() );
			}
		});

		//$(this).find('input#emailfile').each(function(){
		//	if( $(this).val() == '' ) {
		//		errors = true;
		//		$(this).next().text( 'Не выбран файл ' + $(this).prev().text() );
		//	}
		//});

		if( !errors ){
			var data = $('#contact').serialize();
			$.ajax({
				url: domen + '/index.php?p=sendmail',
				type: 'POST',
				data: data,
				beforeSend: function(){
					$('#sendmail').next().text('Отправляю...');
				},
				success: function(res){
					$('.logmessage').empty();
                    $('.logmessage').hide().fadeIn(500).html(res);
                    //alert('Письмо отправлено');
                    /*
                    if( res == 1 ){
						$('#contact').find('input:not(#sendmail), textarea').val('');
						$('#sendmail').next().empty();
						alert('Письмо отправлено');
					}else{
						$('#sendmail').next().empty();
						alert('Ошибка отправки');
					} */
				},
				error: function(){
					alert('Ошибка!');
				}
			});
		}
		return false;
	});
});
// Обработчик отправки писем (конец)

// загрузчик файлов (оформление)
$(function(){
    var wrapper = $(".file_upload"),
        lbl = wrapper.find(".file_upload_label"),
        btn = wrapper.find(".file_upload_button"),
        inp = wrapper.find("#file_upload_input");
    btn.focus(function(){
        inp.focus()
    });
    // Crutches for the :focus style:
    inp.focus(function(){
        wrapper.addClass("focus");
    }).blur(function(){
        wrapper.removeClass("focus");
    });
    var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;
    inp.change(function(){
        var file_name;
        if(file_api && inp[0].files[0]) {
            file_name = inp[0].files[0].name;
        }
        else {
            file_name = inp.val().replace("D:\\Downloads\\", '');
        }

        if(!file_name.length) return;

        if(lbl.is(":visible")){
            lbl.text(file_name);
            btn.text("Загрузить файл");
        }
        else {
            btn.text(file_name);
        }
    }).change();
});
$(window).resize(function(){
    $(".file_upload input").triggerHandler("change");
});
// загрузчик файлов (оформление)

function trim(str, charlist) {
    // http://javascript.ru/php/trim - источник
    charlist = !charlist ? ' \\s\xA0' : charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
    return str.replace(re, '');
}

/* formstone v1.3.3 upload.js (начало) */
var uploadgallery = '', screenshots = '';
function onBeforeSend(formData, file) {
    //alert(file.name);
	// получаем расширение файла
    var parts, extension = (parts = file.name.split('/').pop().split('.')).length > 1 ? parts.pop() : '';
    //alert(extension);
    if (! (extension && /^(jpg|jpeg|gif|png|bmp|wbmp)$/i.test(extension))){ // не допустимое расширение
        alert('Ошибка: допустимые типы файлов - .jpg, .gif, .png, .bmp, .wbmp');
        return false; // отмена загрузки
    }
	// Modify and return form data
	//formdata.append("input_name", "input_value");
	return formData;
}
function uploadsStart(e, files) {
	//console.log('Uploads start');
	var uploadhtml = $('#upload_result').html();
	for(var i=0; i < files.length; i++) {
		if(files[i].size > 104857600) {//<?=MAX_FILE_SIZE;?>) { //104857600
			alert('Ошибка: файлы размером более 100Мб не допустимы к загрузке!');
		}
        if (uploadhtml.search(files[i].name) < 0) { // если в строке с загрузкой совпадений не найдено, то добавляем ещё одну строку
            uploadhtml += '<div class="upload_file" data-index="' + files[i].index + '"><div class="upload_file_name">' + files[i].name + '</div><div class="upload_file_progress_bar"><progress value="0" max="100"></progress></div><div class="upload_file_progress"></div><div class="upload_file_status"></div><div class="clearfix"></div></div>';
        }
	}
	$("#upload_result").html(uploadhtml);
    if ($('textarea#screenshots_field').text() == '') { // $('textarea[name=screenshots]')
        screenshots = '';
    }
    else {
        screenshots = $('textarea#screenshots_field').text()+','; // $('textarea[name=screenshots]')
    }
}

function fileStart(e, file) {
	//console.log('Start upload file');
	$('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_progress').text('0%').next().addClass('upload_process').text('Загрузка');
}

function fileProgress(e, file, percent) {
	//console.log('Progress upload file');
    $('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_progress').text(percent + '%');
	$('#upload_result').find('div[data-index='+file.index+']').find('progress').attr('value',percent);
}

function fileComplete(e, file, response) {
	//console.log('Complete upload file');
    //console.log(response);
    //alert(response);
    //var regexp2 = /(?<=^|})[^}{]+?(?={|$)/g;
    var regexp1 = /{.+}/g;
    var res = response.match(regexp1);
    //alert(res);
    response = JSON.parse(res);
    //console.log(response.answer);
    if (response.answer.search('Ошибка')) {
        //result_text = response.answer+'<br><img src="'+response.uploaddir+'/'+response.file+'" width="150px">';
        if (response.type == 'image') {
            if (uploadgallery.search(response.file) < 0) { // если в строке с миниатюрами совпадений не найдено, то добавляем загруженную миниатюру
                uploadgallery += '<a class="uploadimage" data-index="'+file.index+'" href="'+domen+'/'+response.uploaddir+'/'+response.file+'" rel="gallery" target="_blank" title="'+response.file+'"><img alt="'+response.file+'" class="images" src="'+domen+'/'+response.uploaddir+'/'+response.file+'" title="'+response.file+'"><div class="delimg" title="Удалить картинку '+response.file+'"></div></a>';
            }
            if (screenshots.search(response.file) < 0) { // если в строке скриншотов совпадения не найдены
                screenshots += response.file+','; // то добавляем имя загруженного файла в строку
            }
        }
        //alert(response.file);
        $('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_name').text(response.file);
        $('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_status').removeClass('upload_process').addClass('upload_ok').text('Загружен');
    }
    else {
        //result_text = response.answer;
        $('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_name').text(response.file);
        $('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_status').removeClass('upload_process').addClass('upload_error').text('Не загружен');
    }
    //alert(response.answer.match('Ошибка'));
    //result.html(result_text);
}

function fileError(e, file) {
	//console.log('Error upload file');
	$('#upload_result').find('div[data-index='+file.index+']').find('.upload_file_progress').text('0%').next().removeClass('upload_process').addClass('upload_error').text('Не загружен');
}

function uploadsComplete(e) {
    //console.log('Uploads complete');
    $('#upload_image').fadeOut(0, function(){
        $(this).html(uploadgallery).fadeIn(500);
    });
    $('textarea#screenshots_field').text(trim(screenshots,',')); // $('textarea[name=screenshots]')
    delimg_click();
}
/* formstone v1.3.3 upload.js (конец) */

// удаление картинок (начало)
function delimg_click(){
    // при наведение мыши на загруженную картинку
    $('.uploadimage').on('mouseover', function(){
        $(this).find('.delimg').css({'opacity':'1'});
    }).on('mouseout', function(){
        $(this).find('.delimg').css({'opacity':'0'});
    });

    // удаление картинок
    $('.delimg').on('click', function(e){
        e.preventDefault();
        var res = confirm('Подтвердите удаление картинки');
        if(!res) return false;
        var img = $(this).parent().attr('title'); // имя картинки
        if (!$(this).parent().attr('href').search(domen+'/')) { // если в адресе картинки есть домен, то вырезаем его
            var path = $(this).parent().attr('href').slice(domen.length+1); // имя и полный путь картинки
        }
        else {
            var path = $(this).parent().attr('href'); // имя и полный путь картинки
        }
        //console.log(path);
        var rel = $(this).parent().attr('rel'); // image - базовая картинка, gallery - картинка галереи
        var index = $(this).parent().attr('data-index'); // индекс картинки
        var screenshots2 = $('textarea#screenshots_field').text(); // $('textarea[name=screenshots]') // запоминаем значение текстового поля со скриншотами до удаления
        // alert(screenshots2);
        //var post_id = $('#post_id').text(); // ID поста (статьи)
        // console.log(rel);
        $.ajax({
            url: domen + '/admin?ajax=1',
            type: 'POST',
            data: {ajax:true, delimg:true, img:img, path:path}, // rel:rel, post_id: post_id
            success: function(res){
                if(!res) return false;
                if(rel == 'image'){
                    // базовая картинка
                    $('.file_upload_result').fadeOut(500, function(){ // удаляем результат загрузки изображения
                        $(this).empty().fadeIn(500);
                    });
                    $('.file_upload_image').fadeOut(500, function(){ // удаляем картинку загруженного изображения
                        $(this).empty().fadeIn(500);
                    });
                    $('div#uploaded_image').fadeOut(500, function(){ // удаляем блок с ранее загруженной картинкой (при редактировании)
                        $(this).empty().fadeIn(500);
                    });
                    $('#file_upload_name_field').val(''); // $('#input[name=image]')
                    $('.file_upload_label').text('Файл не выбран');
                }else{
                    // картинка галереи
                    $('#upload_result').find('div[data-index='+index+']').fadeOut(500, function(){ // удаляем результат загрузки скриншота
                        $(this).remove();
                    });
                    $('#upload_image').find('a[data-index='+index+']').fadeOut(500, function(){ // удаляем картинку загруженного скриншота
                        $(this).remove();
                    });
                    uploadgallery = $('#upload_image').html();
                    $('div#screenshots').find('a[data-index='+index+']').fadeOut(500, function(){ // удаляем блок с ранее загруженными скриншотами (при редактировании)
                        $(this).remove();
                    });
                    //alert(uploadgallery);
                }
                var regexp3 = /(,){2,}/g;
                screenshots = screenshots.replace(img,'').replace(regexp3,','); // переопределяем строку со скриншотами
                screenshots2 = screenshots2.replace(img,'').replace(regexp3,',');
                //alert(screenshots);
                $('textarea#screenshots_field').text('').text(trim(screenshots2,',')); // $('textarea[name=screenshots]')
            },
            error: function(){
                alert('Ошибка при удалении файла');
            }
        });
    });
}
// удаление картинок (конец)


$(document).ready(function(){ /* функция ожидания загрузки страницы (начало) */
//jQuery('document').ready(function($) {

    delimg_click();

    /* formstone v1.3.3 upload.js (начало) */
	$('.upload').upload({
		action: domen + '/admin?ajax=1',
        beforeSend: onBeforeSend,
		label: 'Перетащите файлы или нажмите на блок загрузки',
        leave: 'У вас есть не завершённые загрузки. Вы уверенны, что хотите покинуть эту страницу?',
		postKey: 'file',
		maxQueue: 1, // максимальное количество одновременных загрузок
		maxSize: 104857600, // <?=MAX_FILE_SIZE;?>, //104857600, // максимальный размер файла 100 Мб
		postData:{
		    ajax:true,
            fileupload:'gallery',
			//name:'User',
			//ip:'127.0.0.1'
		}
	})
	.on('start.upload', uploadsStart)
	.on('filestart.upload', fileStart)
	.on('fileprogress.upload', fileProgress)
	.on('filecomplete.upload', fileComplete)
	.on('fileerror.upload', fileError)
	.on('complete.upload', uploadsComplete);

    /* formstone v1.3.3 upload.js (конец) */

    /* Ajaxupload.js (начало) */
    var ajaxupload = $('.file_upload'), interval, //screenshots,
        label = ajaxupload.find('.file_upload_label'),
        button = ajaxupload.find('.file_upload_button'),
        finput = ajaxupload.find('#file_upload_input'),
        fname = $('#file_upload_name_field'), // $('input[name=image]'),
        //screenshots = $('textarea#screenshots_field').text(), // $('textarea[name=screenshots]')
        result = $('.file_upload_result'),
        image = $('.file_upload_image'),
        maxSize = 104857600; //104857600;
        //fname.val('');

    new AjaxUpload(ajaxupload, {
        action: domen + '/admin?ajax=1',
        data: {ajax:true, fileupload:'image'},
        name: 'file',
        autoSubmit: true,
        responseType: false,
        onSubmit: function(file, extension){
            if (!(extension && /^(jpg|jpeg|gif|png|bmp|wbmp)$/i.test(extension))){ // не допустимое расширение
                alert('Ошибка: допустимые типы файлов - .jpg, .gif, .png, .bmp, .wbmp');
                return false; // отмена загрузки
            }
            screenshots = $('textarea#screenshots_field').text(); // $('textarea[name=screenshots]')

            button.text('Загрузка');
            this.disable();
            
            interval = setInterval(function(){
                var text = button.text();
                if(text.length < 11) {
                    button.text(text + '.');
                }
                else {
                    button.text('Загрузка');
                }
            }, 300);
        },
        onComplete: function(file, response){
            button.text('Загрузить файл');
            window.clearInterval(interval);
            this.enable();
            
            //console.log(response);
            //alert(response);
            //var regexp2 = /(?<=^|})[^}{]+?(?={|$)/g;
            var regexp1 = /{.+}/g;
            var res = response.match(regexp1);
            var uploadimg = '';
            //alert(res);
            response = JSON.parse(res);
            if (response.answer.search('Ошибка')) {
                label.text(response.file);
                fname.val(response.file);
                //screenshots.text(response.file);
                if (screenshots == '') {
                    $('textarea#screenshots_field').text(response.file); // $('textarea[name=screenshots]')
                }
                else {
                    if (screenshots.search(response.file) < 0) { // если в строке скриншотов совпадения не найдены
                        $('textarea#screenshots_field').text(screenshots+','+response.file); // то добавляем имя загруженного файла в строку // $('textarea[name=screenshots]')
                    }
                    else {
                        $('textarea#screenshots_field').text(screenshots); // $('textarea[name=screenshots]')
                    }
                }
                if (response.type == 'image') {
                    uploadimg = '<a class="uploadimage" href="'+domen+'/'+response.uploaddir+'/'+response.file+'" rel="image" target="_blank" title="'+response.file+'"><img alt="'+response.file+'" class="oneimage" src="'+domen+'/'+response.uploaddir+'/'+response.file+'" title="'+response.file+'"><div class="delimg" title="Удалить картинку '+response.file+'"></div></a>';
                }
            }
            else {
                label.text('Файл не выбран');
                fname.val('');
            }
            //alert(response.answer.match('Ошибка'));
            result.html(response.answer);
            image.html(uploadimg);
            delimg_click();
        }
    });
    /* Ajaxupload.js (конец) */



    // отображение пароля в формах регистрации и обновления пароля на странице пользователя
    /*
    var create_user_password_field = $("#create_user_password_field");
    var update_generate_password = $("#update_generate_password");
    var update_show_password = $("#update_show_password");
    update_show_password.toggle(function() {
        $(this).attr('title','Скрыть пароль');
        $(this).children('i').attr('class','fa fa-eye-slash');
        create_user_password_field.attr('type','text');
        update_generate_password.css({'display':'block','visibility':'visible'});
    },function() {
        $(this).attr('title','Показать пароль');
        $(this).children('i').attr('class','fa fa-eye');
        create_user_password_field.attr('type','password');
        update_generate_password.css({'display':'none','visibility':'hidden'});
    }); */

// генерация пароля для формы регистрации
    /*
    $("#update_generate_password").click(function(e) {
        //create_user_password_field.attr('type','text');
        create_user_field.val(generate_password());
    }); */

}); /* функция ожидания загрузки страницы (конец) */