function randomizze (min,max)
{
 if( max ) {
return Math.floor(Math.random() * (max - min + 1)) + min;
	    } else {
	        return Math.floor(Math.random() * (min + 1));
	    }
}
function zagrimg(id)
{
       var button = $('#uploadButton'+id), interval;
       var imgname = randomizze(1000000,9999999);  

//$(document).ready(function() {

       $.ajax_upload(button, {
             action : 'functions/imgupload.php?name='+imgname,
             name : 'picture',
             onSubmit : function(file, ext) {
               // показываем картинку загрузки файла
               $("img#load"+id).attr("src", "images/load.gif");
               $("#uploadButton"+id+" font").text('Загрузка');

               /*
                * Выключаем кнопку на время загрузки файла
                */
               this.disable();

             },
             onComplete : function(file, response) {
               // убираем картинку загрузки файла
               $("img#load"+id).attr("src", "images/loadstop.gif");
               $("#imgzagr"+id).attr("src", "../images/products/small/"+imgname+".jpg");
               $("#imginput"+id).val(imgname+".jpg");
               $("#uploadButton"+id+" font").text('Загрузить');

               // снова включаем кнопку
               this.enable();

               // показываем что файл загружен
               $("<li>" + responce + "</li>").appendTo("#uploadbutton"+id);

             }
           });
           
           
  //   });
}

function zagrdopimg(product_id,img_id)
{
       var button = $('#uploadButton'+product_id+img_id), interval;
       var imgname = randomizze(1000000,9999999);  

       $.ajax_upload(button, {
             action : 'functions/imgupload.php?name='+imgname,
             name : 'picture',
             onSubmit : function(file, ext) {
               // показываем картинку загрузки файла
               $("img#load"+product_id+img_id).attr("src", "images/load.gif");
               $("#uploadButton"+product_id+img_id+" font").text('Загрузка');

               /*
                * Выключаем кнопку на время загрузки файла
                */
               this.disable();

             },
             onComplete : function(file, response) {
               // убираем картинку загрузки файла
               $("img#load"+product_id+img_id).attr("src", "images/loadstop.gif");
               $("#imgzagr"+product_id+img_id).attr("src", "../images/products/small/"+imgname+".jpg");
               $("#imginput"+product_id+img_id).val(imgname+".jpg");
               $("#uploadButton"+product_id+img_id+" font").text('Загрузить');

               // снова включаем кнопку
               this.enable();

               // показываем что файл загружен
               $("<li>" + responce + "</li>").appendTo("#uploadbutton"+product_id+img_id);

             }
           });
          
            $.ajax({
            type: "POST",
            url: "http://spestehnika5.ru/admin/functions/jqueryupload.php?add",
            data: ({productid : product_id, image : imgname+".jpg"}),
            success: function(html){/* после окончания */ }  
             });  
}

function dopimgplus(product_id,img_id)
{
    var img_idd = img_id+1;
       $('#dopphoto'+product_id).append("<div id='dopphoto"+product_id+img_idd+"'><div id='uploadButton"+product_id+img_idd+"' class='button' onclick='zagrdopimg("+product_id+","+img_idd+");' style='cursor: pointer;'><font>Загрузить</font><br /><img id='load"+product_id+img_idd+"' src='images/loadstop.gif'/></div><img id='imgzagr"+product_id+img_idd+"' src='images/faq.png' width='200'/><br /><input type='hidden' name='image"+product_id+img_idd+"' id='imginput"+product_id+img_idd+"'/><hr><div id='dopimgplus"+product_id+img_idd+"' onclick='dopimgplus("+product_id+","+img_idd+");' style='cursor: pointer;color:#00f;'>[добавить картинку]</div><div style='float:left; cursor: pointer; color: #00F;' onclick=\"dopimgdelete("+product_id+","+img_idd+");\">[Удалить верхнюю]</div><br><br></div>");  
    $('#dopimgplus'+product_id+img_id).css("display","none");
}

function dopimgdelete(product_id,img_id)
{
        $.ajax({
            type: "POST",
            url: "http://spestehnika5.ru/admin/functions/jqueryupload.php?delete",
            data: ({imgid : img_id}),
            success: function(html){$('#dopphoto'+product_id+img_id).hide(2000); }  
         });  
}

function deadlineimg(id,image)
{
       var button = $('#uploadButton'+id), interval;

       $.ajax_upload(button, {
             action : 'functions/imgdeadlineupload.php?name='+image,
             name : 'picture',
             onSubmit : function(file, ext) {
               // показываем картинку загрузки файла
               $("img#load"+id).attr("src", "images/load.gif");
               $("#uploadButton"+id+" font").text('Загрузка');

               /*
                * Выключаем кнопку на время загрузки файла
                */
               this.disable();

             },
             onComplete : function(file, response) {
               // убираем картинку загрузки файла
               $("img#load"+id).attr("src", "images/loadstop.gif");
               $("#imgzagr"+id).attr("src", "../images/"+image);
               $("#uploadButton"+id+" font").text('Загрузить');

               // снова включаем кнопку
               this.enable();

               // показываем что файл загружен
               $("<li>" + responce + "</li>").appendTo("#uploadbutton"+id);

             }
           });
           
}