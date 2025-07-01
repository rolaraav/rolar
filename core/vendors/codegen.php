<?php // defined('A') or die('Access denied');
session_start(); // создание сессии
date_default_timezone_set('Asia/Yekaterinburg'); // установка часового пояса
error_reporting(E_ALL);
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
define('code_dir', $DOCUMENT_ROOT.'/core/vendors/');
//echo code_dir;
// выше вариант, который надо использывать при расположении сайта в интернете, а не на ПК на локале
// $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
// define('code_dir', '');

// запускаем функцию, генерирующую код. Можно даже вывести её в отдельный файл
function generate_code() {
    $hours = date('H');                 // час
    $minuts = substr(date('H'), 0 , 1); // минута
    $mouns = date('m');                 // месяц
    $year_day = date('z');              // день в году

    $str = $hours.$minuts.$mouns.$year_day; //создаем строку
    $str = md5(md5($str)); //дважды шифруем в md5
	  $str = strrev($str); // реверс строки
	  $str = substr($str, 4, 6); // извлекаем 6 символов, начиная с 4

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand((float)microtime()*1000000);
    shuffle($array_mix);
	  // Тщательно перемешиваем, соль, сахар по вкусу!!!
    return implode('', $array_mix);
}

// Берем карандаши и рисуем картинку :)
function img_code() {
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s", 10000)." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: image/png");
// защита от кэширования... кстати сказать не очень надежная...

$linenum = 2; // линии
$img_arr = array(
    'codegen/codegen.png', //фон изображения. Можете сами нарисовать
    'codegen/codegen0.png' //фон изображения. Можете сами нарисовать
);

$font_arr = array();
$font_arr[0]['fname'] = 'codegen/verdana.ttf'; //ttf шрифты, можно заменить на свои
$font_arr[0]['size'] = mt_rand(20,28); //размер шрифта
$font_arr[1]['fname'] = 'codegen/times.ttf'; //ttf шрифты, можно заменить на свои
$font_arr[1]['size'] = mt_rand(20,28); //размер шрифта

$n = rand(0,sizeof($font_arr)-1);
$img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
$im = imagecreatefrompng(code_dir.$img_fn); //создаем изображение со случайным фоном

// рисуем линии
for ($i=0; $i<$linenum; $i++) {
    $color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

// генерируем код
$str = generate_code(); // код
unset($_SESSION['captcha']);
$_SESSION['captcha'] = $str; // сохранение кода в сессии

// вставляем код
for ($i=0, $x =5; $i<strlen($str); $i++) {
  $color = imagecolorallocate($im, rand(0, 200), rand(0, 150), rand(50, 100));
  imagettftext($im, $font_arr[$n]['size'], rand(-15, 15), $x, rand(25, 40), $color, code_dir.$font_arr[$n]['fname'], $str{$i}); // накладываем код
  $x = $x + 24;
}

// еще раз линии! Уже сверху
for ($i=0; $i<$linenum; $i++) {
    $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

ImagePNG ($im);
ImageDestroy ($im); // ну вот и создано изображение!
}

img_code();
?>