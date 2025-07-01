<?php
namespace app\controllers\admin;

use app\models\BaseModel;
use app\models\AdminModel;
use core\libs\Menu;
use core\libs\Breadcrumbs;
use core\libs\Mail;
use core\libs\CheckMail;
//use core\Model;
use core\Controller;
use core\View;
use core\Core;
use core\libs\Cache;
use core\libs\FileUpload;
use \R;

class AdminController extends Controller {

  public static $registry;

  protected $AdminModel; // переменная для хранения объекта модели админки

  public $layout = 'default';

  /** переменные для шаблона default */
  protected $meta; // мета теги
  protected $styles; // стили с полными путями
  protected $scripts1; // скрипты с полными путями
  protected $title; // хранение заголовка страницы
  protected $analytics; // счетчики для статистики
  protected $body;
  protected $scripts2; // скрипты с полными путями

  /* Переменные для вида _meta */
  //public $view;
  protected $description; // описание
  protected $keywords; // ключевые слова

  /* Переменные для вида _styles */
  protected $template; // шаблон(тема)

  /* Переменные для вида body */
  protected $modal; // вывод модальных окон
  protected $header; // шапка
  protected $topmenu; // верхнее меню
  protected $main; // главный блок
  protected $bottommenu; // нижнее меню
  protected $footer; // подвал
  protected $totop; // кнопка наверх

  /* Переменные для вида _main */
  protected $leftblock; // левый блок
  protected $centerblock; // центральный блок
  protected $rightblock; // правый блок
  protected $display_leftblock = true; // отображать левый блок
  protected $display_rightblock = false; // отображать правый блок

  protected $settings; // настройки сайта

  /* Переменные для вида центрального блока _centerblock */
  protected $breadcrumbs_obj; // объект блока хлебных крошек (верхняя навигация)
  //protected $breadcrumbs_tail; // элементы верхней навигационной цепочки
  protected $breadcrumbs; // готовый html-код блока хлебных крошек

  /* Переменные для элементов левого и правого блока */
  protected $leftmenu; // хранение блока левого меню
  protected $authorization;
  protected $statistics;

  //public $id; // идентификатор категории, поста, пользователя и прочее
  protected $text; // текст страницы
  protected $pages; // список всех страниц и их алиасов
  protected $p; // номер текущей страницы для постраничной навигации
  protected $image;

  protected $current_page = 1; // номер текущей страницы
  protected $quantity_posts; // количество записей на одной странице = константа ADMIN_QUANTITY_POSTS = 30
  protected $total_posts_pagination; // общее количество записей (постов, новостей, отзывов и пр.) для постраничной нвигации
  protected $pagination,$page_navigation; // элементы постраничной навигации

  protected $view_count; // счётчик количества просмотров
  protected $page_alias; // алиас текущей страницы
  protected $page; // данные для текущей страницы
  protected $post; // данные для текущего поста (массив)
  protected $posts; // данные для нескольких постов (массив)// список постов в выбранной категории (если есть)

  public $post_types = ''; // блок select с типами постов (материалов)
  public $category_types = ''; // блок select с типами категорий

  protected $posts_block_list; // блок-список постов

  protected $menu;
  public $categories; // все категории (массив), полученные из базы данных или из кэша

  protected $auth;
  public $user; // массив с данными о текущем пользователе (ID, логин, пароль и пр)
  protected $users; // массив пользователей

  protected $total_admin; // массив со значениями счетчиков
  protected $total_data; // общее количество материалов
  protected $total_news; // общее количество новостей
  protected $total_rubs; // общее количество рубрик
  protected $total_partner_products; // общее количество партнёрских продуктов
  protected $total_downloads; // общее количество закачек
  protected $total_secret; // общее количество секретных материалов
  protected $total_courses; // общее количество курсов
  protected $total_goods; // общее количество товаров
  protected $total_galleries; // общее количество галерей
  protected $total_albums; // общее количество альбомов
  protected $total_categories; // общее количество категорий (разделов)
  protected $total_partners; // общее количество партнёров
  protected $total_posts; // общее количество заметок
  protected $total_comments; // общее количество комментариев
  protected $total_comments2; // общее количество комментариев 2
  protected $total_phrases; // общее количество умных фраз
  protected $total_links; // общее количество ссылок
  protected $total_banners; // общее количество баннеров
  protected $total_pages; // общее количество страниц
  protected $total_users; // общее количество всех пользователей
  protected $total_reg_users; // общее количество зарегистрированных пользователей
  protected $total_subscribers; // общее количество подписчиков
  protected $total_messages; // общее количество сообщений

  protected $online_users; // общее количество онлайн пользователей на сайте

  public function __construct($route) {
    //echo 'AdminController - метод __construct() до родительского метода __construct()<br>';
    parent::__construct($route);
    //echo 'AdminController - метод __construct() после родительского метода __construct()<br>';
    //session_start();

    //debug($this->route);
    //debug($this->alias);

    $this->AdminModel = new AdminModel; // создание модели и соединение с базой данных
    //debug($this->AdminModel);

    // * * * РАБОТА С КУКАМИ И СЕССИЯМИ (начало) * * * //

    // проверка сессии и куков авторизации пользователя
    if(!isset($_SESSION['user'])) { // если в сессиях нет массива авторизации, то проверяем куки
      // если есть необходимые переменные в куках (id, login, password, remember)
      if (isset($_COOKIE['id']) and isset($_COOKIE['login']) and isset($_COOKIE['password']) and isset($_COOKIE['remember'])) {
        // если пользователь нажал запомнить меня и желает входить автоматически, то
        if ($_COOKIE['remember'] == 'on') {
          // запускаем пользователю сессию! Можете его поздравить, он вошел!
          $_SESSION['user']['id'] = $_COOKIE['id'];
          $_SESSION['user']['login'] = $_COOKIE['login'];
          // в куках пароль был не зашифрованный, а в сессиях обычно храним зашифрованный
          $_SESSION['user']['password'] = shifr_password($this->decrypt($_COOKIE['password']));
        }
        // echo 'куки на месте';
      }
      //echo 'сессии нету';
      //debug($_COOKIE);
    }

    /* --- Данные для постраничной навигации --- */
    if (isset($_COOKIE['admin_quantity_posts'])) {
      $this->quantity_posts = $_COOKIE['admin_quantity_posts'];
    }
    else {
// если переменной $quantity_posts не существует (пользователь зашел на страницу в первый раз),
// то ей присваиваем значение 30 и сохраняем в куки, время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице
      setcookie('admin_quantity_posts', $this->quantity_posts, time()+31536000);
    }
// если пользователь нажал на кнопку "Выбрать"
    if (isset($_POST['cnum_change'])) {
      // присваиваем переменной $quantity_posts новое значение, выбранное пользователем, сохраняем её в куки и обновляем страницу
      $this->quantity_posts = $_POST['cnum'];
      setcookie('admin_quantity_posts', $this->quantity_posts, time()+31536000);
      redirect();
    }
    /* --- Данные для постраничной навигации --- */

    // Обработчик Ajax-запросов (начало)
    if(isset($_POST['ajax']) or isset($_GET['ajax'])){
      //debug($_POST);
      //debug($_GET);
      //chdir('../'); // Изменяет текущий каталог PHP на указанный в качестве параметра directory.
      //getcwd('../');
      if (isset($_POST['fileupload'])) {
        //$FileUpload = Core::$core->FileUpload;
        $file_upload_result = Core::$core->FileUpload->fileupload('images'); // загружаем файл в папку uploads
        //$result['uploaddir'] = ltrim($result['uploaddir'],'../');
        //debug($result);
        // если нужно обновлять информацию в базе данных
        $this->AdminModel->add_uploaded_file($file_upload_result); // добавляем данные о загруженном файле в базу данных
        exit(json_encode($file_upload_result));
      }

      if (isset($_POST['delimg'])) {
        $file_delete_result = $this->AdminModel->del_img($_POST['path']); // функция для удаления файла картинки, возвращает true или false
        exit($file_delete_result);
      }
      //echo 'Загрузка завершена';
      die;
    }
    // Обработчик Ajax-запросов (конец)


    // если существует логин и пароль в сессиях, то проверяем действительность логина и пароля и извлекаем нужные данные о пользователе (id, login, avatar)
    if (!empty($_SESSION['user']['login']) and !empty($_SESSION['user']['password'])) {
      // извлекаем часть данных пользователя для авторизации, AND activation='1' - выбираем среди активированных пользователей
      $this->user = $this->AdminModel->get_user_for_authorization($_SESSION['user']['login'], $_SESSION['user']['password'], true);
    }
    //debug($this->user);

    if ((!isset($this->user['login'])) or ($this->user['login'] != 'rolar')){ // если пользователь не авторизован, отправляем его на главную страницу сайта (страницу авторизации)
      redirect(D);
    }

    /*
    if ((!isset($this->user['login']) or ($this->user['status'] < 4)) { // $this->user['login'] != 'rolar'
      redirect(D.S.'authorization');
    }
    */

    //debug($this->route);

    // * * * РАБОТА С КУКАМИ И СЕССИЯМИ (конец) * * * //

    //$this->breadcrumbs_obj = new Breadcrumbs(); // получение хлебных крошек
    //debug($this->breadcrumbs_obj);

    // формирование хлебных крошек
    if ($this->controller == 'Index') {
      $current = 'class="current" ';
    }
    else {
      $current = '';
    }
    $this->breadcrumbs = '<a '.$current.'href="'.ADMIN.'" target="_self" title="Главная">Главная</a>';

    // рендеринг блока авторизации
    $this->authorization = $this->renderBlock('_authorization', 'Вход', ['user' => $this->user,'authorization_token' => $this->getToken('authorization')]); // , 'remember_check' => $this->remember_check
    //debug($this->authorization);

    //$categories = $this->get_current_categories($categories, 3);
    $this->categories = Core::$core->getProperty('categories');
    //debug($this->categories);

    //debug($this->view);
    //debug($this->action);

// получение динамичной части шаблона #content
    $page = empty($_GET['p']) ? 'index' : (string)$_GET['p']; // page - страница (загрузка опеределённого шаблона)
    $view = empty($_GET['v']) ? '' : (string)$_GET['v']; // view - вид (выбор элемента)
// echo '$view='.$view;

    $page_array = array('index','view','create','edit','delete','ckeditor','sendmail','subscribers');
    $view_array = array('news','rub','partner_product','partner','download','cat','goods','gallery','album','post','comment','comment2','user','message','link','banner','page');
    if(!in_array($page,$page_array)) {
      // если из адресной строки получено имя несуществующего вида
      $page = 'index';
    }
    if(!in_array($view,$view_array)) {
      // если из адресной строки получено имя несуществующего вида
      $view = '';
    }

    // поисковая форма
    //$this->search_form = $this->render('_search_form', ['search_token' => $this->getToken('search')]);

    // получение категорий и построение элементов меню
    //$this->categories_for_menu = $this->Model->get_categories_for_menu();
    //debug($this->categories_for_menu);

    // получение меню
    //$menu = new Menu([
      //'data' => $this->categories_for_menu,
      //'partners' => $this->partners,
      //'container' => 'ul',
      //'cache' => 600
      //'cacheKey' => 'menu'
    //]);
    //$this->menu = $menu->run();
    //debug($this->menu);

    // рендеринг блока левого меню
    //$this->leftmenu = $this->renderBlock('_cpleftmenu','Навигация', ['menu' => $this->menu]);
    //debug($this->leftmenu);

    // получение данных о статистике
    $this->total_admin = Core::$core->Cache->get('statistics2'); // получение данных из кэша
    if (!$this->total_admin) { // если данные из кэша не получены, то

      // получение данных для блока статистики
      //$this->total_data = $this->AdminModel->count_total_posts(); // получение общего количества материалов для постраничной навигации
      //debug($this->total_data);

      $this->total_news = $this->AdminModel->count_admin_total_news(); // получение общего количества новостей
      $this->total_rubs = $this->AdminModel->count_admin_total_rubs(); // общее количество рубрик
      $this->total_partner_products = $this->AdminModel->count_admin_total_partner_products(); // получение общего количества партнёрских продуктов
      $this->total_downloads = $this->AdminModel->count_admin_total_downloads(); // получение общего количества закачек
      $this->total_secret = $this->AdminModel->count_admin_total_secret(); // получение общего количества секретных материалов
      $this->total_courses = $this->AdminModel->count_admin_total_courses(); // получение общего количества курсов
      $this->total_goods = $this->AdminModel->count_admin_total_goods(); // общее количество товаров
      $this->total_galleries = $this->AdminModel->count_admin_total_galleries(); // общее количество галерей
      $this->total_albums = $this->AdminModel->count_admin_total_albums(); // общее количество альбомов
      $this->total_categories = $this->AdminModel->count_admin_total_categories(); // общее количество разделов
      $this->total_partners = $this->AdminModel->count_admin_total_partners(); // общее количество партнёров

      $this->total_posts = $this->AdminModel->count_admin_total_posts(); // получение общего количества заметок
      $this->total_comments = $this->AdminModel->count_admin_total_comments(); // получение общего количества комментариев
      $this->total_comments2 = $this->AdminModel->count_admin_total_comments2(); // получение общего количества комментариев 2

      $this->total_phrases = $this->AdminModel->count_admin_total_phrases(); // общее количество умных фраз
      $this->total_links = $this->AdminModel->count_admin_total_links(); // общее количество ссылок
      $this->total_banners = $this->AdminModel->count_admin_total_banners(); // получение общего количества баннеров
      $this->total_pages = $this->AdminModel->count_admin_total_pages(); // общее количество страниц

      $this->total_users = $this->AdminModel->count_admin_total_users(); // получение количества всех пользователей
      $this->total_reg_users = $this->AdminModel->count_admin_total_reg_users(); // получение количества зарегистрированных пользователей
      $this->total_subscribers = $this->AdminModel->count_admin_total_subscribers(); // получение количества подписчиков
      $this->total_messages = $this->AdminModel->count_admin_total_messages(); // общее количество сообщений

      $this->total_admin = array(
        'news' => $this->total_news,
        'rubs' => $this->total_rubs,
        'partner_products' => $this->total_partner_products,
        'downloads' => $this->total_downloads,
        'secret' => $this->total_secret,
        'courses' => $this->total_courses,
        'goods' => $this->total_goods,
        'galleries' => $this->total_galleries,
        'albums' => $this->total_albums,
        'categories' => $this->total_categories,
        'partners' => $this->total_partners,
        'posts' => $this->total_posts,
        'comments' => $this->total_comments,
        'comments2' => $this->total_comments2,
        'phrases' => $this->total_phrases,
        'links' => $this->total_links,
        'banners' => $this->total_banners,
        'pages' => $this->total_pages,
        'users' => $this->total_users,
        'reg_users' => $this->total_reg_users,
        'subscribers' => $this->total_subscribers,
        'messages' => $this->total_messages,
      );
      //debug($this->total);

      Core::$core->Cache->set('statistics2', $this->total_admin, 3600); // помещаем полученные данные в кэш на 1 час или 3600 секунд
    }

    $this->online_users = $this->online(); // получение количества пользователей на сайте

    // рендеринг блока статистики
    $this->statistics = $this->renderBlock('statistics','Статистика', array('total' => $this->total_admin, 'online_users' => $this->online_users, 'prefix' => $this->prefix));
    //debug($this->statistics);

    //url_parsing();

    // ПОЛУЧЕНИЕ ДАННЫХ ИЗ БАЗЫ ДАННЫХ (конец)

  }

  public function defaultAction(){

  }

  public function indexAction(){

    //echo 'AdminController - IndexAction';

  }

  // Обработчик Ajax-запросов (начало)
  public function ajaxAction() {
    //echo 'AdminController - ajaxAction';
    //debug($this->route);
    //debug($_POST);

    if ($this->isAjax()) {
      echo 'Запрос Ajax';

      echo 'Загрузка завершена';
    }
    else {
      if (DEBUG) {
        echo 'Не Ajax-запрос';
      }
    }
    die;
  }
  // Обработчик Ajax-запросов (конец)

//  public function input() {
//    parent::input(); // выполнение родительского inputa

//  }

  // метод для получения HTML-кода и вывода страницы на экран
  public function output() {
    // echo 'BaseController - родительский метод output()<br>';

    // ГЕНЕРАЦИЯ ОБЩИХ ВИДОВ ДЛЯ СТРАНИЦ (начало)


    // подключение центрального блока
    //echo $this->centerblock;
    /*
    $this->centerblock = $this->render('_centerblock', [
      //'centerblock_styles' => $this->centerblock_styles,
      //'breadcrumbs' => $this->breadcrumbs,
      'content' => $this->content
    ]);
    */


    // подключение вывода модального окна
    $this->modal = ''; // $this->render('_modal');
    //echo $this->modal;

    // модальное окно с авторизацией
    //$this->auth = $this->render('_auth');
    //echo $this->auth;

    // подключение шапки и получение готового html-кода блока верхнего меню
    $this->header = $this->render('_cpheader', [
      //'alias' => $this->alias,
      'topmenu' => $this->menu
    ]);
    //echo $this->header;

    // определение стилей для блоков
    //$this->get_blockstyles($this->display_leftblock, $this->display_rightblock);

    $this->slider = '';

    $this->bottommenu = ''; // $this->topmenu

    //$this->leftmenu = $this->render('_cpleftmenu', array('leftmenu' => $this->menu));
    $this->leftmenu = $this->renderBlock('_cpleftmenu','Навигация', ['menu' => $this->menu]);
    //echo $this->leftmenu;

    // подключение подвала
    $this->footer = $this->render('_cpfooter');
    //echo $this->footer;

    // кнопка вверх
    $this->totop = $this->render('_totop');
    //echo $this->totop;

    $this->body = $this->render('_cpbody', array(
      'modal' => $this->modal,
      'header' => $this->header,
      'topmenu' => $this->topmenu,

      'leftmenu' => $this->leftmenu,
      'authorization' => $this->authorization,
      'statistics' => $this->statistics,

      //'centerblock' => $this->centerblock,
      'breadcrumbs' => $this->breadcrumbs,
      'content' => $this->content,
      //'bottommenu' => $this->bottommenu,
      'footer' => $this->footer,
      'totop' => $this->totop,
    ));

    $this->meta = $this->render('_meta', ['view' => $this->view, 'description' => $this->description, 'keywords' => $this->keywords]);
    //debug($this->meta);

    $this->template = 'light';

    $this->styles = $this->render('_styles', ['prefix' => $this->prefix, 'template' => $this->template]);

    $this->scripts1 = $this->render('_scripts1');

    $this->analytics = ''; //$this->render('_analytics');

    $this->scripts2 = $this->render('_scripts2', ['prefix' => $this->prefix]);

    $this->set([
      'meta' => $this->meta,
      'styles' => $this->styles,
      'scripts1' => $this->scripts1,
      'title' => $this->title,
      'analytics' => $this->analytics,
      'body' => $this->body,
      'scripts2' => $this->scripts2
    ]);

    //echo 'BaseController - родительский метод output()';
    // ГЕНЕРАЦИЯ ОБЩИХ ВИДОВ ДЛЯ СТРАНИЦ (конец)

  }


  /////////////////////////////////////////////

  // Функция определения количества человек на сайте
  // также эта функция описана в BaseController - дублирование кода
  // https://webscript.ru/stories/02/01/26/6213672
  protected function online() {
    $ip = get_ip(); // получение IP-адреса - здесь нужна проверка на валидность ip-адреса
    $this->AdminModel->delete_ip_online(); // удаление старых записей
    // проверка на присутствие или занесение нового онлайн-посетителя
    if ($this->AdminModel->get_ip_online($ip) == $ip) { // если посетитель с текущим IP-адресом уже есть в базе, то
      $this->AdminModel->update_ip_online($ip); // обновляем данные
    }
    else {
      $this->AdminModel->insert_ip_online($ip); // иначе добавляем новую запись
    }
    return $this->AdminModel->count_elements('online','ip'); // считывание результатов (подсчёт посетителей), total_count_ip_online();
  }

  public function get_type($category = 0, $return = 'string') {
    if(!isset($category)) {
      $type = 0; // новости (посты)
    }

    switch((int)$category){
      case(3):
        $type = 1; // новости
        $title = 'Новости';
        $template_view = 'news';
        $link_pattern = 'news';
        break;
      case(4):
        $type = 2; // партнёрские продукты
        $title = 'Партнёрские продукты';
        $template_view = 'partner_product';
        $link_pattern = 'partner_products';
        break;
      case(5):
        $type = 3; // закачки
        $title = 'Закачки';
        $template_view = 'download';
        $link_pattern = 'downloads';
        break;
      case(7):
        $type = 4; // товары
        $title = 'Товары';
        $template_view = 'good';
        $link_pattern = 'goods';
        break;
      case(16):
        $type = 5; // галереи
        $title = 'Галереи';
        $template_view = 'gallery';
        $link_pattern = 'galleries';
        break;
      case(14):
        $type = 6; // альбомы музыкальные
        $title = 'Альбомы';
        $template_view = 'album';
        $link_pattern = 'albums';
        break;
      default:
        $type = 0; // посты короткие
        $title = 'Заметки'; // Посты
        $template_view = 'post';
        $link_pattern = 'posts';
    }
    if ($return == 'array') {
      return array('id' => $type, 'title' => $title, 'template_view' => $template_view, 'link_pattern' => $link_pattern);
    }
    else {
      return $type;
    }

  }

  public function format_posts($data = array()){
    // $data - ассоциативный массив из 1 или нескольких элементов
    if(!is_array($data)) {
      return false;
    }
    /*
    if(!isset($data[1])) { // если в переданном массиве нет нулевого элемента, то присваиваем ему значение всего массива
      $data[1] = $data;
    } */
    $post = array();
    foreach($data as $item) {
      $item['secret'] = secret_check($item['secret']); // получение стилей флага для скрытого поста
      $item['comments'] = $this->Model->count_comments($item['id']); // подсчет количества комментариев

      // Получение названий рубрик, разделов
      $category = $this->get_title_category($item['category']);
      if (empty($category)) {
        $category = $this->Model->get_title_category($item['category']);
      }
      //debug($category);
      $item['title_category'] = $category['title'];
      $item['alias_category'] = $category['alias'];
      if (empty($item['title_category'])) {
        $title_category['title'] = 'Без категории';
      }

      // получение имён партнёров
      if (!empty($item['partner'])) {
        // получение имени партнера
        $partner = $this->get_title_partner($item['partner']);
        if (empty($partner)) {
          $partner = $this->Model->get_title_partner($item['partner']);
        }
        //debug($partner);
        $item['partner_title'] = $partner['title'];
        $item['partner_alias'] = $partner['alias'];
      }

      // получение имени миниатюры
      if (($item['image'] == 'images/')
        or ($item['image'] == 'images/data/')
        or ($item['image'] == 'images/partner_products/')
        or ($item['image'] == 'images/downloads/')
        or ($item['image'] == 'images/goods/')
        or ($item['image'] == 'images/galleries/')
        or ($item['image'] == 'images/albums/')) {unset($item['image']);}
      if (isset($item['image'])) {
        $item['thumbspostimage'] = thumbsfilename($item['image']);
      }

      // преобразование даты в удобный для восприятия вид
      $item['date'] = get_datetime($item['date']);

      // подсчёт рейтинга
      $item['rating'] = intval($item['rating']/$item['quantity_vote']);

      // Если к материалу прикреплена галерея или альбом, но они пустые, тогда уничтожаем переменные
      if (empty($item['gallery_id'])) {
        unset($item['gallery_id']);
      }
      if (empty($item['album_id'])) {
        unset($item['album_id']);
      }
      /* Проверка ссылки для заказа и цены */
      if (empty($item['buy_link'])) {
        unset($item['buy_link'],$item['orders']);
      }
      if ((int)$item['price'] == 0) {
        unset($item['price']);
      }
      $post[] = $item;
    }
    return $post;
  }

  public function format_categories($categories = array()){
    if(!is_array($categories)) {
      return false;
    }
    $cats = array();
    foreach($categories as $key => $item) {
      $cats[$key+1] = $item;
    }
    return $cats;
  }

  // получение названия и алиаса нужной категории из массива категорий в памяти
  public function get_title_category($category_id = 3) {
    $category = array();
    if (!empty($this->categories)) {
      $categories_array = $this->categories;
    }
    else {
      $categories_array = Core::$core->getProperty('categories');
    }
    foreach($categories_array as $item) {
      if ($item['id'] == $category_id) {
        $category['alias'] = $item['alias'];
        $category['title'] = $item['title'];
      }
    }
    return $category;
  }

  // получение названия и алиаса нужного партнёра из массива партнёров в памяти
  public function get_title_partner($partner_id=null) {
    if (empty($partner_id)) return false;
    $partner = array();
    if (!empty($this->partners)) {
      $partner_array = $this->partners;
    }
    else {
      $partner_array = Core::$core->getProperty('partners');
    }
    //debug($partner_array);
    foreach($partner_array as $item) {
      if ($item['id'] == $partner_id) {
        $partner['alias'] = $item['alias'];
        $partner['title'] = $item['title'];
      }
    }
    return $partner;
  }

  // получение текущих категорий
  public function get_current_categories($categories = array(), $parent = 3){ //$parent = false
    if(empty($categories)) return false;
    $categories_array = array();
    if($parent) {
      foreach($categories as $item) {
        if ($item['parent'] == $parent) {
          $categories_array[] = $item;
        }
      }
      return $categories_array;
    }
    else {
      return $categories;
    }
  }

  // получение родительской категории
  public function get_parent_category($categories = array(), $parent = 3) {
    if(empty($categories)) return false;
    $categories_array = array();
    if($parent) {
      foreach($categories as $item) {
        if ($item['parent'] == $parent) {
          $categories_array[] = $item;
        }
      }
      return $categories_array;
    }
    else {
      return $categories;
    }
  }


}