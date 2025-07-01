$(function (){
if (!$.cookie('showPopuper')) {
    setTimeout(showPopuper, 15000); // если кука не установлена (пользователь зашёл в первый раз) - через 30000 
}
else {
    setTimeout(showPopuper, 900000); // при наличии куки окно появится через 900000 миллисекунд (15 минут)
}
$('#popuper .close').click(function() { //$('#popuperOverlayer, #popuper .close').click(function(){
    $('#popuper').fadeOut('fast', function() {
        $('#popuperOverlayer').fadeOut('fast');
    })
});
function showPopuper() {
// Показываем оверлаейер, как закончится анимация запускаем показ самого окна
    $('#popuperOverlayer').fadeIn('fast', function() {
        $('#popuper').animate({'top':'50%'}, 1000, function() {
            $('#popuperContent').effect('bounce', {times: 3, distance: 50}, 400)
        });
    });
    $.cookie('showPopuper', 1);
}
});