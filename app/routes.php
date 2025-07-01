<?php
use core\Router;

defined('A') or die('Access denied');
//echo 'Файл маршрутов!<br>';

//require_once CORE.S.'Router.php';
//$router = new Router();

//Старые ссылки
//courses.php?rub=3
//partner_products.php?partner=3
//downloads.php?cat=2

//view_news.php?id=312
//view_partner_product.php?id=322
//view_download.php?id=307
//view_product.php?id=234
//view_gallery.php?id=104
//view_album.php?id=104

//link.php?id=460
//l460
//partner_link.php?id=460
//download_link.php?id=460
//internet_link.php?id=460
//buy_link.php?id=283
//banner_link.php?id=27

//user_page.php?id=3
//all_users.php
//delete_message.php?id=4
//date.php?date=2016-11

// Маршруты для постов
Router::add('^(?<id>[0-9]+)$', ['controller' => 'Post']);
Router::add('^post/?(?<id>[0-9]+)?$', ['controller' => 'Post']);
Router::add('^post/(?<alias>[0-9a-z_-]+)/?$', ['controller' => 'Post']); // получение постов по алиасу
Router::add('^view_news/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'1']); // старые маршруты для новостей view_news.php?id=312
Router::add('^view_partner_product/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'2']); // старые маршруты для партнёрских продуктов view_partner_product.php?id=322
Router::add('^view_download/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'3']); // старые маршруты для закачек view_download.php?id=307
Router::add('^view_product/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'4']); // старые маршруты для товаров view_product.php?id=234
Router::add('^view_gallery/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'5']); // старые маршруты для галерей view_gallery.php?id=104
Router::add('^view_album/?(?<id>[0-9]+)?$', ['controller' => 'Post', 'type' =>'6']); // старые маршруты для альбомов view_album.php?id=104

//Router::add('^(interesting|creativity|music|films|galleries|articles|verses|songs)$', ['controller' => 'Posts']); // маршрут для разделов Интересное и Творчество
//Router::add('^posts/?(?<alias>[0-9a-z_-]+)/?$', ['controller' => 'Posts']); // маршрут для разделов Интересное и Творчество

Router::add('^courses$', ['controller' => 'Courses', 'alias' =>'courses']); // курсы
Router::add('^course/?(?<id>[0-9]+)?$', ['controller' => 'Courses', 'alias' =>'course']); // курсы

// Маршруты для категорий
Router::add('^cat/?(?<id>[0-9]+)?$', ['controller' => 'Category']);
Router::add('^news/?(?<id>[0-9]+)?$', ['controller' => 'Category', 'alias' =>'news']); // старый маршрут для раздела новости news.php?rub=3
Router::add('^partner_products/?(?<id>[0-9]+)?$', ['controller' => 'Category', 'alias' =>'partner_products']); // старый маршрут для раздела Партнерские продукты partner_products.php?partner=3
Router::add('^downloads/?(?<id>[0-9]+)?$', ['controller' => 'Category', 'alias' =>'downloads']); // старый маршрут для раздела Закачки downloads.php?cat=2

Router::add('^courses$', ['controller' => 'Course']); // старый маршрут для раздела Курсы courses.php совпадает с новым маршрутом

Router::add('^script$', ['controller' => 'Script']); // маршрут для контроллера скриптов

// Маршруты для страницы с датами
Router::add('^date/?(?<date>[0-9]{4}-?([0-9]{2})?)?$', ['controller' => 'Date']); // date/?(?<date>20[0-9]{2}-?(0[1-9]|1[012])?)?$         [12][0-9]{3}-?(0[1-9]|1[012])
//Router::add('^date\.php(\?date=(?<date>[0-9]{4}-[0-9]{2}))?$', ['controller' => 'Date']); // старый маршрут для архива

// Маршруты для страницы поиска
Router::add('^search/?(?<id>[0-9]+)?$', ['controller' => 'Search']);
//Router::add('^search\.php(\?date=(?<date>[0-9]{4}-[0-9]{2}))?$', ['controller' => 'Search']); // старый маршрут для поиска

// Маршруты для страницы пользователей
Router::add('^user/?(?<id>[0-9]+)?$', ['controller' => 'User', 'alias' => 'user', 'action' => 'index']);
Router::add('^user_page/?(?<id>[0-9]+)?$', ['controller' => 'User', 'alias' => 'user', 'action' => 'index']); // старый маршрут для страницы пользователя user_page.php?id=3
Router::add('^users$', ['controller' => 'User', 'alias' => 'users', 'action' => 'users']);
Router::add('^all_users$', ['controller' => 'User', 'alias' => 'users', 'action' => 'users']); // старый маршрут на страницу всех пользователей all_users.php
Router::add('^registration$', ['controller' => 'User', 'alias' => 'registration', 'action' => 'signup']);
Router::add('^authorization$', ['controller' => 'User', 'alias' => 'authorization', 'action' => 'login']);
Router::add('^exit$', ['controller' => 'User', 'alias' => 'logout', 'action' => 'logout']);
Router::add('^activation$', ['controller' => 'User', 'alias' => 'activation', 'action' => 'activate']); // в конце есть ещё параметры
Router::add('^deactivation$', ['controller' => 'User', 'alias' => 'deactivation', 'action' => 'deactivate']); // в конце есть ещё параметры
Router::add('^subscription$', ['controller' => 'User', 'alias' => 'subscription', 'action' => 'subscribe']);
Router::add('^send_login$', ['controller' => 'User', 'alias' => 'send_login', 'action' => 'send_login']);
Router::add('^send_password$', ['controller' => 'User', 'alias' => 'send_password', 'action' => 'send_password']);
Router::add('^delete_message/?(?<id>[0-9]+)?$', ['controller' => 'User', 'alias' => 'delete_message', 'action' => 'delete_message']); // старый путь для удаления сообщения delete_message.php?id=4 совпадает с новым
Router::add('^vkauth$', ['controller' => 'User', 'alias' => 'vkauth', 'action' => 'vkauth']);
Router::add('^fbauth$', ['controller' => 'User', 'alias' => 'fbauth', 'action' => 'fbauth']);
Router::add('^twauth$', ['controller' => 'User', 'alias' => 'twauth', 'action' => 'twauth']);
Router::add('^okauth$', ['controller' => 'User', 'alias' => 'okauth', 'action' => 'okauth']);
Router::add('^mrauth$', ['controller' => 'User', 'alias' => 'mrauth', 'action' => 'mrauth']);
Router::add('^goauth$', ['controller' => 'User', 'alias' => 'goauth', 'action' => 'goauth']);
Router::add('^yaauth$', ['controller' => 'User', 'alias' => 'yaauth', 'action' => 'yaauth']);

// Маршруты со ссылками
Router::add('^link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'link', 'action' => 'index']); // старый маршрут для ссылки link.php?id=460 совпадает с новым
Router::add('^l/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'link', 'action' => 'index']); // короткая ссылка l460

Router::add('^pl/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'partner_link', 'action' => 'partner']);
Router::add('^partner_link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'partner_link', 'action' => 'partner']); // старый маршрут для партнерских ссылок partner_link.php?id=460
Router::add('^plink/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'partner2_link', 'action' => 'partner']); // старый маршрут для партнерских ссылок ОМ plink.php?id=62

Router::add('^dl/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'download_link', 'action' => 'download']);
Router::add('^download_link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'download_link', 'action' => 'download']); // старый маршрут для закачек download_link.php?id=460
Router::add('^dlink/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'download2_link', 'action' => 'download']); // старый маршрут для закачек ОМ dlink.php?id=460

Router::add('^il/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'internet_link', 'action' => 'internet']);
Router::add('^internet_link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'internet_link', 'action' => 'internet']); //старый маршрут для интернет-ссылок internet_link.php?id=460

Router::add('^bl/?(?<id>[0-9]+)$', ['controller' => 'Link', 'alias' => 'buy_link', 'action' => 'buy']);
Router::add('^buy_link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'buy_link', 'action' => 'buy']); // старый маршрут для заказа buy_link.php?id=283
Router::add('^blink/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'buy2_link', 'action' => 'buy']); // старый маршрут для заказа ОМ blink.php?id=283

Router::add('^ba/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'banner_link', 'action' => 'banner']);
Router::add('^banner_link/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'banner_link', 'action' => 'banner']); // старый маршрут для баннера banner_link.php?id=27
Router::add('^tl/?(?<id>[0-9]+)?$', ['controller' => 'Link', 'alias' => 'torrent_link', 'action' => 'torrent']);

Router::add('^links$', ['controller' => 'Link', 'alias' => 'links', 'action' => 'links']); // все ссылки
Router::add('^all_links$', ['controller' => 'Link', 'alias' => 'links', 'action' => 'links']); // старый маршрут для всех ссылок

// заданные статические маршруты
Router::add('^view/?(?<id>[0-9]+)?$', ['controller' => 'View']); // правило для страниц просмотра

Router::add('^page/?(?<alias>[0-9a-z_-]+)?(?:/|.php)?$', ['controller' => 'Page', 'action' => 'view']); // правило для страниц
//Router::add('^(?P<alias>[0-9a-z_-]+).php?$', ['controller' => 'Page', 'action' => 'view']); // правило для страниц

// обработчик Ajax-запросов
Router::add('^ajax$', ['controller' => 'Base', 'action' => 'ajax', 'prefix' => '']); // маршрут для Ajax-запросов на главной странице

//Router::add('^pages/(?P<action>[a-z-]+)?$', ['controller' => 'Page']);
//Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
//Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'index']);

// маршрут для курса по cisco
Router::add('^cisco$', ['controller' => 'Index', 'action' => 'index', 'prefix' => 'cisco']); // маршрут для курса по cisco
Router::add('^cisco/?(?<action>[a-z_-]+)?/?$', ['controller' => 'Index', 'prefix' => 'cisco']); // обработка других маршрутов для курса по cisco
//Router::add('^cisco/?(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?$', ['prefix' => 'cisco']); // обработка других маршрутов для курса по cisco

// маршруты для админки
Router::add('^admin$', ['controller' => 'Index', 'action' => 'index', 'prefix' => 'admin']); // маршрут для админки
Router::add('^admin/ajax$', ['controller' => 'Admin', 'action' => 'ajax', 'prefix' => 'admin']); // маршрут для Ajax-запросов в админке
//Router::add('^admin/?(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?$', ['prefix' => 'admin']); // обработка других маршрутов для админки
Router::add('^admin/?(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?(id)?/?(?<id>[0-9]+)?$', ['prefix' => 'admin']); // обработка других маршрутов для админки

// маршруты для админки по умолчанию
Router::add('^aav$', ['controller' => 'Index', 'action' => 'index', 'prefix' => 'admin']); // обработка пустой строки для админки
Router::add('^aav/?(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?$', ['prefix' => 'admin']); // обработка других маршрутов для админки
//Router::add('^aav/?(?<controller>[a-z_-]+)/?(?<action>[a-z_-]+)?/?(id)?/?(?<id>[0-9]+)?$', ['prefix' => 'admin']); // обработка других маршрутов для админки

// маршруты с алиасами при использовании ЧПУ
Router::add('^(?<alias>[a-z0-9_-]+)/?$', ['action' => 'index']); // обработка других маршрутов

// маршруты по умолчанию
Router::add('^$', ['controller' => 'Index', 'action' => 'index']); // обработка пустой строки
Router::add('^(?P<controller>[a-z_-]+)/?(?P<action>[a-z_-]+)?/?$'); // обработка других маршрутов
// () - запоминаем значение контроллера и экшена в ячейки массива controller и action
// / и экшн могут отсутствовать - после них стоит знак вопроса


//debug(Router::getRoutes());
//Router::dispatch($url);