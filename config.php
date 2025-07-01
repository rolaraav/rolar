<?php
defined('A') or die('Access denied');
//echo 'Конфигурация сайта!<br>';
define('PROTOCOL', $_SERVER['REQUEST_SCHEME']); // протокол http или https
//echo PROTOCOL.'<br>';
define('P', PROTOCOL.'://'); // протокол сайта со слешами http:// или https://
define('S', '/'); // разделитель в URL-адресе - /
//echo S.'<br>';

// echo PHP_OS; // выводит название операционной системы, на которой был собран PHP
// php_uname(); // возвращает описание операционной системы, на которой запущен PHP

// *nix
//echo DIRECTORY_SEPARATOR; // /
//echo PHP_SHLIB_SUFFIX;    // so
//echo PATH_SEPARATOR;      // :

// Win*
//echo DIRECTORY_SEPARATOR; // \
//echo PHP_SHLIB_SUFFIX;    // dll
//echo PATH_SEPARATOR;      // ;

// операционная система, на которой запущен php
if (isset($_SERVER['SystemRoot']) and strpos($_SERVER['SystemRoot'],'Windows') !== false) {
  define('OS', 'Windows'); // операционная система
  define('DS', '\\'); // DIRECTORY_SEPARATOR разделитель пути для Windows - \ (прямой слеш)
}
else {
  define('OS', 'Linux'); // операционная система
  define('DS', '/'); // DIRECTORY_SEPARATOR разделитель пути для Linux - / (обратный слеш)
}

// Программное получение URL главной страницы
$app_path = P.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; // например, https://localhost/public/index.php
//echo $_SERVER['HTTP_HOST'].'<br>';
//echo $_SERVER['PHP_SELF'].'<br>';
$app_path = preg_replace('#[^/]+$#', '', $app_path); // например, https://localhost/public/
//echo $app_path.'<br>';
$app_path = rtrim(str_replace('/public/', '', $app_path), '/'); // например, https://localhost
define('PATH', $app_path); // https://localhost
//echo PATH.'<br>';

define('SITE_URL', '/'); // папка в которой лежит сайт (необходима, если сайт лежит не в корне домена)
define('R', '.php'); // расширение

define('DOMEN', $_SERVER['HTTP_HOST']); // домен сайта без протокола и слеша rolar.ru
//echo DOMEN.'<br>';
define('D', P.$_SERVER['HTTP_HOST']); // домен сайта с протоколом и разделителем, например https://rolar.ru
//echo D.'<br>';

// пути в директориям
define('ROOT', $_SERVER['DOCUMENT_ROOT']); //dirname(__DIR__)); // корневая папка сайта, dirname - возвращает имя родительского каталога из указанного пути
//echo $_SERVER['DOCUMENT_ROOT'].'<br>';
//echo str_replace('\\','/', __DIR__).'<br>';
//define('PUBLIC', ROOT.S.'public'); // папка с публичными файлами (рисунки, стили, шрифты, скрипты и т.д.)
define('CORE', ROOT.S.'core'); // ядро фреймворка
define('APP', ROOT.S.'app'); // приложение

//define('BASE', CORE.S.'base'); // базовая папка ядра
define('LIBS', CORE.S.'libs'); // вспомогательные библиотеки
define('VENDORS', CORE.S.'vendors'); // сторонние библиотеки, модули, расширения и пр.

define('MODEL', CORE.S.'Model'.R); // базовая модель ядра
define('VIEW', CORE.S.'View'.R); // базовый вид
define('CONTROLLER', CORE.S.'Controller'.R); // базовый контроллер ядра

define('M', APP.S.'models'); // директория моделей приложения 'app/models'
define('V', APP.S.'views'); // директория видов приложения 'app/views'
define('C', APP.S.'controllers'); // директория контроллеров приложения 'app/controllers'
define('L', APP.S.'layouts'); // директория шаблонов приложения 'app/layouts'

//define('F', CORE.S.'f'.R); // базовые функции фреймворка 'core/f.php'
define('IMAGES', 'images'); // название директории для изображений 'images'
define('I', D.S.IMAGES); // путь к директории для изображений 'images' относительно домена // полный путь к директории для изображений 'images' - ROOT.S.IMAGES

define('UPLOAD', 'uploads'); // загружаемые файлы 'uploads' // ROOT.S.'uploads'
//var_dump(UPLOAD);
define('T', ROOT.S.'tmp'); // временная папка 'tmp'
define('CACHE', T.S.'cache'); // кеш 'tmp/cache'
define('CONF', 'config'); // конфигурации

define('LAYOUT', 'default'); // шаблон по умолчанию

// define('TEMPLATE', VIEW.'light/'); // активный шаблон
define('DAVATAR', 'images/users/avatars/default.png'); // аватар по умолчанию
define('ADMINPANEL', D.S.'admin'); // панель управления сайтом aav/
define('ADMIN', ADMINPANEL); // панель управления сайтом
//define('ACCESSCODE', 'password'); // код доступа в админку
define('CISCO', D.'cisco/'); // продающая страница курса по cisco
define('CODE', 'dTWc627k'); // секретный код
define('CHECKSUM', '569748967'); // результаты сложения кодов с картирок
define('ENCRYPTION_KEY', '3df8cafc1ce45cdaf22d4a3e4e1f8df1'); // ключ для шифрования, получен с помощью функции openssl_random_pseudo_bytes(16);
//echo bin2hex(openssl_random_pseudo_bytes(16));
define('TOKEN_KEY', '78a2ef5a452c0455861f253d77e50e6d'); // ключ для шифрования токена;
define('EXPIRATION_TIME', 86400); // время для проверки токена, 86400 секунд = 24 часа
define('QUANTITY_POSTS', 7); // количество статей/партнёрских продуктов/закачек/товаров для постраничной навигации
define('ADMIN_QUANTITY_POSTS', 30); // количество статей/партнёрских продуктов/закачек/товаров для постраничной навигации в админке
define('QUANTITY_LINKS', 3); // кличество ссылок слева и справа для постраничной навигации
define('TITLE', 'Персональный сайт Артура Абзалова'); // название сайта - title
define('AUTHOR', 'Артур Абзалов');
define('ADMINEMAIL', 'admin@rolar.ru');
define('SITE_BIRTHDAY', '20 may 2012 20:00');
define('DEFAULT_DOWNLOAD_DOMEN', 'rolar.ddns.net'); // домен для закачек по умолчанию DDD
// ftp://rolar.ru:Kr6vX3yu@94.41.86.18.dynamic.ufanet.ru/
// ftp://rolar.ru:Kr6vX3yu@rolar.mykeenetic.ru
// ftp://rolar.ru:Kr6vX3yu@rolar.ddns.net
// ftp://rolar.ru:Kr6vX3yu@rolar.myftp.org
// http://rolar.keenetic.pro, rolar.keenetic.link, rolar.keenetic.name
//define('DOWNLOAD_SERVER', 'ftp://rolar.ru:Kr6vX3yu@rolaraav.no-ip.org/');
//define('DOWNLOAD_SERVER2', 'ftp://rolar.ru:Kr6vX3yu@rolaraav.noip.me/');
//define('DOWNLOAD_SERVER3', 'ftp://rolar.ru:Kr6vX3yu@349941.dyn.ufanet.ru/');
//'anonymous' => '', // 'anonymous:',
//'rolar' => 'rolar.ru:Kr6vX3yu',
//'cisco' => 'cisco:3dPc6F5m', // путь к секретному файлу
//'ciscofree' => 'ciscofree:Ak6vx9Ic',
//'courses' => 'courses:nTf4k9p5'
define('SECRET_FILE', 'cisco/ccna.iso'); // секретный файл
//define('PATH_TO_SECRET_FILE', 'ftp://cisco:3dPc6F5m@rolaraav.no-ip.org/'); // путь к секретному файлу - определён в файле Core.php и f.php
define('POPUPER', 0); // попапер выключен
define('DEBUG', true); // режим отладки, true - включен, false - выключен - ИСПРАВЬ файл init.php
define('SHOW_SQL', false); // отображать sql-запросы и их количество
define('CHECK', 'checked="checked" '); // выбор элемента формы
define('SELECT', 'selected="selected" '); // выбор элемента формы
define('DISABLE', 'disabled="disabled" '); // выключение элемента формы
define('READONLY', 'readonly="readonly" '); // элемента формы доступен только для чтения
define('PERMITTED_CHARS', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-'); // набор символов как в ID-youtube видео https://habr.com/ru/post/334994/

// визуальный текстовый редактор по умолчанию
define('DEFAULT_EDITOR', 'tinymce'); // ckeditor, tinymce, none
//global $editor = 'tinymce';

// ----  Настройки галереи ---- //
define('GALLERY_PATH', LIBS.S.'gallery/'); // путь к папке галереи относительно диска на сервере ..../localhost/core/libs/gallery/
//define('GALLERY_PATH', $_SERVER['DOCUMENT_ROOT'].S.'gallery/'); // полный путь к папке галереи
//echo GALLERY_PATH.'<br>';
//define('GALLERY',D.S.'gallery/'); // путь к папке галереи относительно домена https://rolar.ru/gallery/
define('GIMAGES',I.S.'galleries/'); // Путь к папке изображений галереи относительно домена https://rolar.ru/images/galleries/
define('GALLERY_IMAGES',$_SERVER['DOCUMENT_ROOT'].S.'images/galleries/'); // полный путь к папке изображений галереи относительно сервера
define('G_IMG_LARGE',''); // идентификатор больших изображений
//define('G_IMG_MEDIUM','m_'); // идентификатор средних изображений
//define('G_IMG_SMALL','s_'); // идентификатор малых изображений

define('GALLERY_NAME_SHOW', false); // отображать имя галереи
define('G_ROW_IMG',4); // максимальное количество изображений в одном ряду, по умолчанию 4
define('G_ROW_WIDTH',580); // ширина блока гелереи
define('G_LIMIT_COMMENTS',3); // количество отображаемых комментариев на странице галереи и странице просмотра изображений
// ----  Настройки галереи ---- //

define('ALBUM_PATH', LIBS.S.'album/'); // путь к папке фдьбомов относительно диска на сервере ..../localhost/core/libs/album/

if (DOMEN == 'rolar.ru') {
  /* Настройки подключения к БД на хостинге */
  define('HOST', 'localhost'); // сервер БД
  define('USER', 'rolar_ru'); // пользователь
  define('PASS', 'nDg31eK4m'); // пароль
  define('DB', 'rolar_ru'); // база данных
}
else {
  /* Настройки подключения к БД на локальном сервере */
  define('HOST', 'localhost'); // сервер БД
  define('USER', 'root'); // пользователь
  define('PASS', ''); // пароль
  define('DB', 'rolar'); // база данных
}

//global $db;
//$db = mysql_connect(HOST, USER, PASS) or die('Нет подключения к серверу'); // установка соединения с сервером Базы Данных
//mysql_select_db(DB, $db) or die('Невозможно выбрать базу данных'); // подключение к Базе Данных
//mysql_query("SET LC_TIME_NAMES = 'ru_RU'"); // установка языка/времени
//mysql_query("SET NAMES 'UTF8'") or die('Не установлена кодировка'); // установка кодировки по-умолчанию
//exit("<p>Подключение к базе данных не установлено. Напишите об этом администратору <a href='mailto:".GADMINEMAIL."' target='_blank'>".GADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());

date_default_timezone_set('Asia/Yekaterinburg'); // установка часового пояса
//ini_set('default_charset','UTF-8');
mb_internal_encoding('utf-8');
setlocale(LC_ALL, 'ru_RU.utf-8'); // устанавливает настройки локали

/* if (date_default_timezone_get()) {
    echo 'Дефолтная временная зона: '. date_default_timezone_get().'<br>'; //Дефолтная временная зона: Материк/Город
}
if (ini_get('date.timezone')) {
    echo 'date.timezone: '.ini_get('date.timezone'); //date.timezone: Материк/Город
} */
// header("Content-Type: text/html; Charset=utf-8"); // отправка заголовка с кодировкой (заголовки ставятся до вывода на экран)

// Авторизация через Вконтакте
define('VK_APP_ID','3417892'); // ID приложения
define('VK_APP_SECRET','dehuXWnhfcOTgI2W6tRX'); // Защищённый ключ
define('VK_REDIRECT_URI',D.S.'vkauth'); // Адрес до файла авторизации через Вконтакте
define('VK_URL_AUTH','https://oauth.vk.com/authorize'); // Адрес для авторизации
define('VK_URL_ACCESS_TOKEN','https://oauth.vk.com/access_token'); // Страница для получения Токена
define('VK_URL_GET_USER','https://api.vk.com/method/users.get'); // Адрес для работы с методом users.get и получения данных

//Авторизация через Facebook
define('FB_CLIENT_ID','620288824784224'); // ID приложения на Facebook
define('FB_SECRET','7a3c7190d6099d673f08af6624d3cbfd'); // App Secret секретный ключ для приложения на Facebook
define('FB_REDIRECT_URI',D.S.'fbauth'); // Адрес для страницы авторизации через Facebook на сайте rolar.ru
define('FB_URL_AUTH','https://www.facebook.com/dialog/oauth'); // Адрес для авторизации на Facebook
define('FB_URL_ACCESS_TOKEN','https://graph.facebook.com/oauth/access_token'); // Страница для получения Токена на Facebook
define('FB_URL_GET_USER','https://graph.facebook.com/me'); // Адрес для получения данных пользователя на Facebook

//Авторизация через Twitter
define('TW_CONSUMER_KEY','SB0oyDw0j6wdK0xLpEfAXZ7LF'); // Ключ приложения на Twitter (API Key)
define('TW_CONSUMER_SECRET','fbDnHSPGp8B1yNaA61FUYnRkDriLus3zbCNuELIOk5fj7nmfKu'); // секретный ключ для приложения на Twitter (API Secret)
define('TW_URL_CALLBACK',D.S.'twauth'); // Адрес для страницы авторизации через Twitter на сайте rolar.ru
define('TW_URL_REQUEST_TOKEN','https://api.twitter.com/oauth/request_token'); // Страница для получения Request Token на Twitter
define('TW_URL_AUTH','https://api.twitter.com/oauth/authorize'); // Адрес для авторизации на Twitter
define('TW_URL_ACCESS_TOKEN','https://api.twitter.com/oauth/access_token'); // Страница для получения Access Token на Twitter
define('TW_URL_ACCOUNT_DATA','https://api.twitter.com/1.1/users/show.json'); // Адрес для получения данных пользователя на Twitter

//7867028 - арр в url приложения
//Access level	Read-only
//Sign in with Twitter	No
//App-only authentication	https://api.twitter.com/oauth2/token
//Access Token	541416583-N1NTGZy4NYv7x4YLZVh0r06VN50bLKvPFe45D9UB
//Access Token Secret	UxuyKykXEZH3qnyXxo7XTVCyTAQ1Hggg8d1uNPNiwK1rz
//Owner	rolaraav
//Owner ID	541416583

// Авторизация через Одноклассники
define('OK_CLIENT_ID','1117287936'); // ID приложения
define('OK_PUBLIC_KEY','CBAHHJJDEBABABABA'); // Публичный ключ приложения
define('OK_CLIENT_SECRET','E885079C17C314594E031CAF'); // Секретный ключ приложения
define('OK_REDIRECT_URI',D.S.'okauth'); // Адрес до файла авторизации через Одноклассники
define('OK_URL_AUTH','https://www.odnoklassniki.ru/oauth/authorize'); // Адрес для авторизации на Одноклассниках
define('OK_URL_ACCESS_TOKEN','https://api.odnoklassniki.ru/oauth/token.do'); // Страница для получения Токена
define('OK_URL_GET_USER','https://api.odnoklassniki.ru/fb.do'); // Адрес для получения данных пользователя

// Авторизация через Mail.Ru
define('MR_CLIENT_ID','710226'); // ID приложения
define('MR_PRIVATE_KEY','45b76e28ccdb2a048fe836c45e63b755'); // Приватный ключ приложения (при авторизации не участвует)
define('MR_SECRET_KEY','546da8b0f697bdab88cd3cfab4ec3d8c'); // Секретный ключ приложения
define('MR_REDIRECT_URI',D.S.'mrauth'); // Адрес до файла авторизации через Mail.Ru
define('MR_URL_AUTH','https://connect.mail.ru/oauth/authorize'); // Адрес для авторизации в Mail.Ru
define('MR_URL_ACCESS_TOKEN','https://connect.mail.ru/oauth/token'); // Страница для получения Токена
define('MR_URL_GET_USER','https://www.appsmail.ru/platform/api'); // Адрес для получения данных пользователя

// Авторизация через Google
define('GO_CLIENT_ID','591281549228-hs59djnr5qf93ll1l65afsvqqdbbkk3e.apps.googleusercontent.com'); // ID приложения
define('GO_EMAIL_ADRESS','591281549228-hs59djnr5qf93ll1l65afsvqqdbbkk3e@developer.gserviceaccount.com'); // Емайл адрес (не используется при авторизации)
define('GO_CLIENT_SECRET','d7g6KK6_qN6eru-S1-xDoqPU'); // Секретный ключ приложения
define('GO_REDIRECT_URI',D.S.'goauth'); // Адрес до файла авторизации через Google
define('GO_URL_AUTH','https://accounts.google.com/o/oauth2/auth'); // Адрес для авторизации в Google
define('GO_URL_ACCESS_TOKEN','https://accounts.google.com/o/oauth2/token'); // Страница для получения Токена
define('GO_URL_GET_USER','https://www.googleapis.com/oauth2/v1/userinfo'); // Адрес для получения данных пользователя

// Авторизация через Яндекс
define('YA_CLIENT_ID','ad47214511dd44adb3ada377f84fb656'); // ID приложения
define('YA_PASSWORD','5e97d5065dd3488aa0dcd8d35ab5ae61'); // Пароль приложения
define('YA_REDIRECT_URI',D.S.'yaauth'); // Адрес до файла авторизации через Яндекс
define('YA_URL_AUTH','https://oauth.yandex.ru/authorize'); // Адрес для авторизации в Яндекс
define('YA_URL_ACCESS_TOKEN','https://oauth.yandex.ru/token'); // Страница для получения Токена
define('YA_URL_GET_USER','https://login.yandex.ru/info'); // Адрес для получения данных пользователя

// Оплата через WebMoney
define('WMR','R121012546658'); // WMR-кошелёк продавца
define('WMP','P266611322081'); // WMP-кошелёк продавца
define('WMZ','Z402751813120'); // WMZ-кошелёк продавца
define('WME','E262191568884'); // WME-кошелёк продавца
define('WMB','B305198337941'); // WMB-кошелёк продавца
define('WMG','G293332807549'); // WMG-кошелёк продавца
define('WMX','X703246470500'); // WMX-кошелёк продавца
define('LMI_PAYEE_PURSE',WMP); // Кошелёк продавца
define('LMI_SHOP_ID',''); // Номер магазина в каталоге Мегасток
define('LMI_SECRET_KEY','Gw73fHx2'); // Secret Key
//define('YA_URL_AUTH','https://oauth.yandex.ru/authorize'); // Адрес для авторизации в Яндекс
//define('YA_URL_ACCESS_TOKEN','https://oauth.yandex.ru/token'); // Страница для получения Токена
//define('YA_URL_GET_USER','https://login.yandex.ru/info'); // Адрес для получения данных пользователя

// Оплата через Payeer
define('PAYEER_P_PURSE','P37769433'); // R-кошелёк продавца
define('PAYEER_SHOP_ID','191033119'); // Идентификатор магазина M_SHOP
define('PAYEER_PAYEE_PURSE',PAYEER_P_PURSE); // Кошелёк продавца
define('PAYEER_SECRET_KEY','Kd3s6kpE2dsYnc0XhG'); // Секретный ключ для магазина

// Оплата через YooMoney (Yandex.Деньги)
define('YA_PURSE','410011123840928'); // номер счета (кошелёк продавца)
define('YA_SHOP_ID','191033119'); // Идентификатор магазина
define('YA_SECRET_KEY','eOWqbAJK2ehk1YMpIr9ljBS8'); // Секретный ключ для магазина


// получаем настройки из ini-файла
// upload_max_filesize - максимальный размер загружаемого файла
define('UPLOAD_MAX_FILESIZE', ini_get('upload_max_filesize')); // 104857600 байт = 100 Мб
//echo UPLOAD_MAX_FILESIZE;

// post_max_size - устанавливает максимально допустимый размер данных, передаваемых методом POST
define('POST_MAX_SIZE', ini_get('post_max_size')); // 104857600 байт = 100 Мб
//echo POST_MAX_SIZE;
//phpinfo();


?>