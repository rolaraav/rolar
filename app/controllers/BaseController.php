<?php
namespace app\controllers;
use app\models\BaseModel;
use app\models\UserModel;
use core\libs\Menu;
use core\libs\Breadcrumbs;
use core\libs\Mail;
use core\libs\CheckMail;
//use core\Model;
use core\Controller;
use core\View;
use core\Core;
use core\libs\Cache;
use \R;

class BaseController extends Controller {

  public static $registry;

  protected $UserModel; // переменная для хранения объекта модели пользователей

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
  protected $template = 'light'; // шаблон(тема)

  /* Переменные для вида body */
  protected $modal; // вывод модальных окон
  protected $header; // шапка
  protected $slider; // слайдер
  protected $topmenu; // верхнее меню
  protected $main; // главный блок
  protected $bottommenu; // нижнее меню
  protected $bottombanner; // нижний баннер - HTML-код блока с баннером
  protected $footer; // подвал
  protected $totop;

  protected $search_form; // поисковая форма

  /*Переменные для вида верхнего меню topmenu и нижнего меню bottommenu */
  public $categories_for_menu; // категории для меню
  public $categories; // все категории (массив), полученные из базы данных или из кэша

  /* Переменные для вида bottom_banner */
  protected $banner1; // горизонтальный баннер снизу - получение массива из базы данных
  protected $banner2; // вертикальный баннер слева - получение массива из базы данных

  /* Переменные для вида _main */
  protected $leftblock; // левый блок
  protected $centerblock; // центральный блок
  protected $rightblock; // правый блок
  protected $display_leftblock = true; // отображать левый блок
  protected $display_rightblock = true; // отображать правый блок

  //protected $left_news, $right_news; // новости для левого и правого блоков
  protected $settings; // настройки сайта
  //protected $display_prices; // отображать цены
  //protected $display_slider; // отображать слайдер

  /* Переменные для элементов левого и правого блока */
  protected $leftmenu; // хранение блока левого меню
  protected $authorization; // блок авторизации
  protected $change_template; // блок формы смены шаблона
  protected $telegram; // блок с подпиской на Telegram-канал
  protected $subscription; // подписка и рассылка без блока
  protected $subscription_block; // блок с рассылкой
  protected $statistics; // блок со статистикой
  protected $leftbanner; // блок с рекламным баннером слева, левый баннер - HTML-код блока с баннером
  //protected $advertisement;
  protected $vkontakte; // блок с группой Вконтакте
  protected $facebook; // блок с группой Фейсбук

  protected $wmr_bonus; // получение бонусов WebMoney
  protected $ewm_widget; // блок поддержки WebMoney

  /* Переменные для вида центрального блока _centerblock */
  protected $breadcrumbs_obj; // объект блока хлебных крошек (верхняя навигация)
  //protected $breadcrumbs_tail; // элементы верхней навигационной цепочки
  protected $breadcrumbs; // готовый html-код блока хлебных крошек

  //public $id; // идентификатор категории, поста, пользователя и прочее
  protected $text; // текст страницы
  protected $pages; // список всех страниц и их алиасов
  protected $p; // номер текущей страницы для постраничной навигации
  protected $image;
  protected $post_image;

  protected $current_page = 1; // номер текущей страницы
  protected $quantity_posts; // количество записей на одной странице = константа QUANTITY_POSTS = 7
  protected $total_posts_pagination; // общее количество записей (постов, новостей, отзывов и пр.) для постраничной нвигации
  protected $pagination,$page_navigation; // элементы постраничной навигации

  protected $view_count; // счётчик количества просмотров
  protected $page_alias; // алиас текущей страницы
  protected $page; // данные для текущей страницы
  protected $post; // данные для текущего поста (массив)
  protected $posts; // данные для нескольких постов (массив)// список постов в выбранной категории (если есть)

  protected $courses; // html-блок постов с курсами
  protected $course; // список разделов

  protected $posts_block_list; // блок-список постов

  protected $menu;

  //protected $head;
  protected $social_buttons; // кнопки социальных сетей
  protected $social_comments; // комментарии из социальных сетей
  protected $map; // карта
  protected $projects;
  protected $rightmessages;

  protected $auth;
  public $user; // массив с данными о текущем пользователе (ID, логин, пароль и пр)
  protected $users; // массив пользователей
  //public $remember_check = CHECK; // метка "Запомнить меня" для чекбокса, CHECK - по умолчанию галочка установлена

  protected $centerblock_styles;
  protected $leftblock_styles;
  protected $rightblock_styles;
  //protected $news,$pages,$professions,$categories;

  protected $total; // массив со значениями счетчиков
  protected $total_news; // общее количество заметок
  protected $total_partner_products; // общее количество партнёрских продуктов
  protected $total_downloads; // общее количество закачек
  protected $total_secret; // общее количество секретных материалов
  protected $total_courses; // общее количество обучающих курсов
  protected $total_goods; // общее количество товаров
  protected $total_galleries; // общее количество галерей
  protected $total_albums; // общее количество альбомов
  protected $total_categories; // общее количество категорий (тип больше 0)
  protected $total_partners; // общее количество партнёров
  protected $total_posts; // общее количество заметок
  protected $total_comments; // общее количество комментариев
  protected $total_comments2; // общее количество комментариев 2
  protected $total_phrases; // общее количество умных фраз
  protected $total_pages; // общее количество страниц (категорий с типом 0)
  protected $total_users; // общее количество зарегистрированных пользователей
  protected $total_subscribers; // общее количество подписчиков

  protected $online_users; // общее количество онлайн пользователей на сайте

  protected $random_news; // случайные новости в правой панели
  protected $last_news; // последние новости в правой панели и на главной странице
  protected $popular_news; // популярные новости в правой панели
  protected $archive; // архив новостей в правой панели
  // protected $total_month; // количество уникальных дат (месяцев) - нужно для вывода списка архива новостей

  protected $half_blocks; // половинчатые блоки снизу под постами

  protected $rub_news; // рубрики новостей
  protected $partners; // список партнёров (массив)
  protected $partners_li; // список партнёров (строка)
  protected $partners_list; // список партнёров (блок)
  protected $cat_downloads; // категории закачек

  protected $partner; // информация о выбранном партнёре

  protected $ref_links; // 10 случайных реферальных ссылок в правой панели
  protected $partner_links; // 5 случайных партнёрских ссылок в правой панели
  //protected $download_links; // 5 случайных ссылок на закачку в правой панели
  protected $internet_links; // 5 случайных ссылок на закачку в правой панели

  protected $payment_id; // последняя запись в таблице orders


  public function __construct($route) {
    //echo 'BaseController - метод __construct() до родительского метода __construct()<br>';
    parent::__construct($route);
    //echo 'BaseController - метод __construct() после родительского метода __construct()<br>';
    //session_start();

    //debug($this->route);

    $this->Model = new BaseModel; // создание модели и соединение с базой данных
    //debug($this->Model);

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

    // если в куках есть метка "запомнить меня" и она имеет значение "on" (пользователь нажал на чекбокс "Запомнить меня" при прошлом входе на сайт)
    /*
    if (isset($_COOKIE['remember'])) {
      if ($_COOKIE['remember'] == 'on') {
        $this->remember_check = CHECK; // тогда метка "Запомнить меня" = CHECK
      } else {
        $this->remember_check = ''; // тогда метка "Запомнить меня" = пустой строке
      }
    }
    */

// установка и проверка куков для шаблона
    if (isset($_COOKIE['template'])) {$this->template = $_COOKIE['template'];}
// если переменной $this->template не существует (пользователь зашел на страницу в первый раз), то ей присваиваем значение light и сохраняем в куки, время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
    if (!isset($this->template) or $this->template == '') {
      $this->template = 'light';
      setcookie('template', $this->template, time()+31536000);
    }

    /* --- Данные для постраничной навигации --- */
    if (isset($_COOKIE['quantity_posts'])) {
      $this->quantity_posts = $_COOKIE['quantity_posts'];
    }
    else {
// если переменной $quantity_posts не существует (пользователь зашел на страницу в первый раз),
// то ей присваиваем значение 7 и сохраняем в куки, время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
      $this->quantity_posts = QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице
      setcookie('quantity_posts', $this->quantity_posts, time()+31536000);
    }
// если пользователь нажал на кнопку "Выбрать"
    if (isset($_POST['num_change'])) {
      // присваиваем переменной $quantity_posts новое значение, выбранное пользователем, сохраняем её в куки и обновляем страницу
      $this->quantity_posts = $_POST['num'];
      setcookie('quantity_posts', $this->quantity_posts, time()+31536000);
      redirect();
    }
    /* --- Данные для постраничной навигации --- */

// проверка доступа в секретный раздел
    if ((isset($_COOKIE['secret_code'])) and ($_COOKIE['secret_code'] == CODE)) {
      $_SESSION['secret_access'] = true;
    }
    else {
      unset($_SESSION['secret_access']);
      setcookie('secret_code', '', time()+31536000);
    }
    //$_SESSION['secret_access'] = true; - эта строка нужна для принудительной установки открытого доступа и тестирования

// смена внешнего вида
    if(isset($_POST['change_template_submit'])){
      change_template();
      redirect();
    }

// получение email пользователя
    if (isset($_POST['semail'])) {
      // echo $email." - из массива $POST";
      $_SESSION['auth']['email'] = get_email($_POST['semail']);
      // print_array($_SESSION['auth']);
      social_authorization();
      // unset($_SESSION['auth']);
      // redirect(DOMEN);
    }

    // Обработчик Ajax-запросов (начало)
    if(isset($_POST['ajax']) or isset($_GET['ajax'])){
      //debug($_POST);
      //debug($_GET);
      //chdir('../'); // Изменяет текущий каталог PHP на указанный в качестве параметра directory.
      //getcwd('../');

      Core::$core->Gallery->index();

      //echo 'Загрузка завершена';
      die;
    }
    // Обработчик Ajax-запросов (конец)

// регистрация
    /*
    if(isset($_POST['registration_submit'])){
      registration();
      redirect();
    } */

// авторизация
    /*
    if(isset($_POST['authorization_submit'])){
      echo 'авторизация';
      exit;
    //  $this->Model->loginAction();
    //  redirect();
      //if (!empty($_SESSION['authorization']['id']) and !empty($_SESSION['authorization']['login']) and !empty($_SESSION['authorization']['password'])) {
      //    echo "Авторизация прошла успешно!";
      //}
    } */

    //debug($_SESSION);

// подписка
    /*
    if(isset($_POST['subscription_submit'])){
      subscription();
      //redirect;
    }
    */

    // отправка комментария
    if(isset($_POST['comment_submit'])){
      $this->send_comment();
      redirect();
    }


    // если существует логин и пароль в сессиях, то проверяем действительность логина и пароля и извлекаем нужные данные о пользователе (id, login, avatar)
    if (!empty($_SESSION['user']['login']) and !empty($_SESSION['user']['password'])) {
      // извлекаем часть данных пользователя для авторизации, AND activation='1' - выбираем среди активированных пользователей
      $this->user = $this->Model->get_user_for_authorization($_SESSION['user']['login'], $_SESSION['user']['password'], true);
    }
    //debug($this->user);

    // отправка сообщения пользователю
    if (isset($_POST['submit_message'])) {
      $_POST['send_message'] = $this->send_message();
      //redirect();
    }


    if (isset($_SESSION['get_email_form'])) {
      include ('_get_email.php');
    }
    unset($_SESSION['get_email_form']);

    // popuper begin
    if ((!isset($this->user['login'])) and (!isset($_SESSION['secret_access']))) {
      if (POPUPER == 1) {
        include '_popuper.php';
      }
    }
    // popuper end

    //if ($subscription_form) {echo $subscription_form;}
    /*
    if (isset($_SESSION['subscription_form'])) {
        echo $_SESSION['subscription_form'];
        unset($_SESSION['subscription_form']);
    }
    */

    //debug($this->route);

    // * * * РАБОТА С КУКАМИ И СЕССИЯМИ (конец) * * * //

    $this->breadcrumbs_obj = new Breadcrumbs(); // получение хлебных крошек
    //debug($this->breadcrumbs);

    // подключение верхней навигации
    //$this->breadcrumbs = $this->render('_breadcrumbs',array(
    //  'page' => $this->page,
    //  'breadcrumbs_tail' => $this->breadcrumbs_tail
    //));
    //echo $this->breadcrumbs;

    // ПОЛУЧЕНИЕ ДАННЫХ ИЗ БАЗЫ ДАННЫХ (начало)
    /*
    $cache = Cache::instance();
    $this->categories = $cache->get('categories');  // получение категорий из кэша
    if(!$this->categories) {// если данные из кеша не получены, то обращаемся к базе данных
      $this->categories = $this->format_categories($this->Model->get_categories()); // получение категорий из базы данных
      $cache->set('categories', $this->categories, 86400); // сохранение в кеш
    } */
    //Core::$core->setProperty('categories', $this->categories);

    //echo 'получаем категории в контроллере BaseController';

    //$categories = $this->get_current_categories($categories, 3);
    $this->categories = Core::$core->getProperty('categories');
    //debug($this->categories);
    //$categories = $this->Model->get_categories(); // все имеющиеся категории

    $this->users = Core::$core->getProperty('users'); // получение всех пользователей
    //$users = $this->Model->get_users(); // все пользователи
    //debug($users);
    //debug($this->users);

    //$rub_news = $this->get_current_categories($categories, 3);; // получение рубрик новостей
    $rub_news = $this->get_current_categories($this->categories, 3); // получение рубрик новостей // $this->Model->get_categories(3);
    $this->rub_news = $this->renderList(['list' => $rub_news, 'list_block_title' => 'Рубрики новостей', 'link_pattern' => '', 'if_empty' => 'Рубрик новостей пока нет']);
    //debug($this->rub_news);

    $this->partners = Core::$core->getProperty('partners'); // получение списка партнёров
    //debug($this->partners);
    $this->partners_list = $this->renderList(['list' => $this->partners, 'list_block_title' => 'Известные партнёры', 'link_pattern' => 'partner_products?partner=', 'if_empty' => 'Партнёров пока нет']);
    //debug($this->partners_list);

    //$cat_downloads = $this->Model->get_cat_downloads(); // получение категорий закачек
    $cat_downloads = $this->get_current_categories($this->categories, 5); // получение категорий закачек // $this->Model->get_categories(5);
    $this->cat_downloads = $this->renderList(['list' => $cat_downloads, 'list_block_title' => 'Категории файлов для скачивания', 'link_pattern' => '', 'if_empty' => 'Категорий файлов для скачивания пока нет']);
    //debug($this->cat_downloads);

    // поисковая форма
    $this->search_form = $this->render('_search_form', ['search_token' => $this->getToken('search')]);

    // получение категорий и построение элементов меню
    //$this->categories_for_menu = $this->Model->get_categories_for_menu();
    //debug($this->categories_for_menu);

    // получение меню
    $menu = new Menu([
      //'data' => $this->categories_for_menu,
      'partners' => $this->partners,
      //'container' => 'ul',
      //'cache' => 600
      //'cacheKey' => 'menu'
    ]);
    $this->menu = $menu->run();
    //debug($this->menu);

    // рендеринг блока левого меню
    $this->leftmenu = $this->renderBlock('_leftmenu','Навигация', ['menu' => $this->menu]);
    //debug($this->leftmenu);

    // рендеринг блока авторизации
    $this->authorization = $this->renderBlock('_authorization', 'Вход', ['user' => $this->user,'authorization_token' => $this->getToken('authorization')]); // , 'remember_check' => $this->remember_check
    //debug($this->authorization);

    // рендеринг блока смены шаблона
    $this->change_template = $this->renderBlock('_change_template', 'Внешний вид сайта', ['template' => $this->template]);
    //debug($this->change_template);

    // рендеринг блока подписки на Telegram-канал
    $this->telegram = $this->renderBlock('_telegram', 'Telegram');
    //debug($this->telegram);

    if (($this->alias != 'subscription') and ($this->action != 'subscribe')) {
      // рендеринг блока подписки на рассылку новостей
      $this->subscription = $this->render('_subscription', ['subscription_token' => $this->getToken('subscription')]);
      //debug($this->subscription);
      $this->subscription_block = $this->renderBlock('_subscription', 'Рассылка', ['subscription_token' => $this->getToken('subscription')]);
      //debug($this->subscription_block);
    }

    // кнопки для репостинга в социальные сети
    $this->social_buttons = $this->render('_social_buttons');

    // комментарии в социальных сетях
    $this->social_comments = $this->render('_social_comments');


    // получение данных о статистике
    $this->total = Core::$core->Cache->get('statistics'); // получение данных из кэша
    if (!$this->total) { // если данные из кэша не получены, то

      // получение данных для блока статистики
      $this->total_news = $this->Model->count_total_news(); // получение общего количества заметок
      $this->total_partner_products = $this->Model->count_total_partner_products(); // получение общего количества партнёрских продуктов
      $this->total_downloads = $this->Model->count_total_downloads(); // получение общего количества закачек
      $this->total_secret = $this->Model->count_total_secret(); // получение общего количества секретных материалов
      $this->total_courses = $this->Model->count_total_courses(); // получение общего количества обучающих курсов
      $this->total_goods = $this->Model->count_total_goods(); // получение общего количества товаров
      $this->total_galleries = $this->Model->count_total_galleries(); // получение общего количества галерей
      $this->total_albums = $this->Model->count_total_albums(); // получение общего количества альбомов
      $this->total_categories = $this->Model->count_total_categories(); // получение общего количества категорий (тип больше 0)
      $this->total_partners = $this->Model->count_total_partners(); // получение общего количества партнёров
      $this->total_posts = $this->Model->count_total_posts(); // получение общего количества заметок
      $this->total_comments = $this->Model->count_total_comments(null); // получение общего количества комментариев
      $this->total_comments2 = $this->Model->count_total_comments(7); // получение общего количества комментариев 2
      $this->total_phrases = $this->Model->count_total_phrases(); // получение общего количества умных фраз
      $this->total_pages = $this->Model->count_total_pages(); // получение общего количества страниц (категорий с типом 0)
      $this->total_users = $this->Model->count_registrated_users(); // получение количества зарегистрированных пользователей
      $this->total_subscribers = $this->Model->count_subscribers(); // получение количества подписчиков

      $this->total = array(
        'news' => $this->total_news,
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
        'pages' => $this->total_pages,
        'users' => $this->total_users,
        'subscribers' => $this->total_subscribers,
      );
      //debug($this->total);

      Core::$core->Cache->set('statistics', $this->total, 3600); // помещаем полученные данные в кэш на 1 час или 3600 секунд
    }

    $this->online_users = $this->online(); // получение количества пользователей на сайте

    // рендеринг блока статистики
    $this->statistics = $this->renderBlock('statistics','Статистика', array('total' => $this->total, 'online_users' => $this->online_users, 'prefix' => $this->prefix));
    //debug($this->statistics);


    // получение вертикального баннера для левой панели
    $this->banner2 = $this->format_banner($this->Model->get_left_banner());
    //debug($this->banner2);

    /* $new_view = 0; echo "Количество просмотров до прибавления $new_view и $left_banner[view]<br>"; */
    //$new_view = (int)$left_banner['view'] + 1;
    /* echo "Количество просмотров после прибавления $new_view и $left_banner[view]<br>"; */
    //$banner_id = (int)$left_banner['id'];
    $this->Model->update_view('banners',$this->banner2['id'],$this->banner2['view']); // обновление количества просмотров
    //echo "Количество просмотров после сохранения в базу $new_view и $banner_id<br>";

    // получение нижнего горизонтального баннера
    $this->banner1 = $this->format_banner($this->Model->get_banner(1));
    $this->Model->update_view('banners',$this->banner1['id'],$this->banner1['view']); // обновление количества просмотров
    //debug($this->banner1);

    // рендеринг блока рекламы с вертикальным баннером слева
    $this->leftbanner = $this->renderBlock('_leftbanner', 'Реклама', ['left_banner' => $this->banner2]); // блок с рекламным баннером слева
    //debug($this->leftbanner);

    // рендеринг блока Группы Вконтакте
    $this->vkontakte = $this->renderBlock('_vkontakte', 'Группа Вконтакте'); // блок с группой Вконтакте
    //debug($this->vkontakte);

    // рендеринг блока Группы Facebook
    $this->facebook = $this->renderBlock('_facebook', 'Группа Facebook'); // блок с группой Фейсбук
    //debug($this->facebook);



    //$this->wmr_bonus = $this->renderBlock('wmr_bonus','WMR-бонус');
    //debug($this->wmr_bonus);

    //$this->ewm_widget = $this->renderBlock('ewm_widget','Поддержка');
    //debug($this->ewm_widget);

    // получение случайных новостей
    $random_news = $this->Model->get_random_news(); // получение случайных новостей в правой панели
    $this->random_news = $this->renderList(['list' => $random_news, 'list_block_title' => 'Случайные новости', 'link_pattern' => 'post', 'if_empty' => 'Новостей пока нет']);
    //debug($this->random_news);

    // получение последних новостей в правой панели и на главной странице
    $last_news = Core::$core->Cache->get('last_news'); // получение последних новостей из кэша
    //debug($last_news);
    if (!$last_news) { // если данные из кэша не получены, то
      $last_news = $this->Model->get_last_news(); // получение последних новостей из базы данных
      //debug($last_news);
      Core::$core->Cache->set('last_news', $last_news, 86400); // помещаем полученные данные в кэш на 1 сутки или 86400 секунд
    }
    $this->last_news = $this->renderList(['list' => $last_news, 'list_block_title' => 'Последние новости', 'link_pattern' => 'post', 'if_empty' => 'Новостей пока нет']);
    //debug($this->last_news);

    // получение популярных новостей в правой панели
    $popular_news = Core::$core->Cache->get('popular_news'); // получение популярных новостей из кэша
    if (!$popular_news) { // если данные из кэша не получены, то
      $popular_news = $this->Model->get_popular_news(); // получение популярных новостей из базы данных
      Core::$core->Cache->set('popular_news', $popular_news, 86400); // помещаем полученные данные в кэш на 1 сутки или 86400 секунд
    }
    $this->popular_news = $this->renderList(['list' => $popular_news, 'list_block_title' => 'Популярные новости', 'link_pattern' => 'post', 'if_empty' => 'Новостей пока нет']);
    //debug($this->popular_news);


    // получение архива новостей в правой панели
    $archive = Core::$core->Cache->get('archive'); // получение архива новостей из кэша
    if (!$archive) { // если данные из кэша не получены, то
      $archive = $this->format_news_archive($this->Model->get_news_archive()); // получение архива новостей из базы данных
      Core::$core->Cache->set('archive', $archive, 86400); // помещаем полученные данные в кэш на 1 сутки или 86400 секунд
    }
    //debug($archive);
    //$this->total_month = count($archive); // подсчет количества уникальных дат (месяцев) - нужно для вывода списка архива новостей
    $this->archive = $this->render('archive', ['archive' => $archive, 'archive_block_title' => 'Архив новостей', 'link_pattern' => 'date', 'if_empty' => 'Новостей пока нет']);
    //debug($this->archive);


    $ref_links = $this->Model->get_ref_links(); // получение 10 случайных реферальных ссылок в правой панели
    $this->ref_links = $this->renderList(['list' => $ref_links, 'list_block_title' => 'Полезные ссылки', 'link_pattern' => 'l', 'if_empty' => 'Ссылок пока нет', 'target' => '_blank']);
    //debug($this->ref_links);

    $partner_links = $this->Model->get_partner_links(); // получение 5 случайных партнёрских ссылок в правой панели
    $this->partner_links = $this->renderList(['list' => $partner_links, 'list_block_title' => 'Партнёрские ссылки', 'link_pattern' => 'pl', 'if_empty' => 'Ссылок пока нет', 'target' => '_blank']);
    //debug($this->partner_links);

    //$download_links = $this->Model->get_download_links(); // получение 5 случайных ссылок на закачку в правой панели
    //$this->download_links = $this->renderList(['list' => $download_links, 'list_block_title' => 'Скачать файлы 2', 'link_pattern' => 'dl', 'if_empty' => 'Файлов для скачивания пока нет', 'target' => '_blank']);
    //debug($this->download_links);

    $internet_links = $this->Model->get_internet_links(); // получение 5 случайных ссылок на закачку в правой панели
    $this->internet_links = $this->renderList(['list' => $internet_links, 'list_block_title' => 'Скачать файлы', 'link_pattern' => 'il', 'if_empty' => 'Файлов для скачивания пока нет', 'target' => '_blank']);
    //debug($this->internet_links);


    //url_parsing();

    // ПОЛУЧЕНИЕ ДАННЫХ ИЗ БАЗЫ ДАННЫХ (конец)

  }

  public function defaultAction(){

  }

  public function indexAction(){

    //echo 'BaseController - IndexAction';

  }

  // Обработчик Ajax-запросов (начало)
  public function ajaxAction() {
    echo 'BaseController - ajaxAction';
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
    $this->centerblock = $this->render('_centerblock', [
      //'centerblock_styles' => $this->centerblock_styles,
      //'breadcrumbs' => $this->breadcrumbs,
      'content' => $this->content
    ]);


    // левый блок
    if($this->display_leftblock) {
      $this->leftblock = $this->render('_leftblock', [
        'leftmenu' => $this->leftmenu,
        'authorization' => $this->authorization,
        'change_template' => $this->change_template,
        'telegram' => $this->telegram,
        'subscription_block' => $this->subscription_block,
        //'rub_news' => $this->rub_news,
        //'partners' => $this->partners,
        //'cat_downloads' => $this->cat_downloads,
        //'template' => $this->template,
        'statistics' => $this->statistics,
        'leftbanner' => $this->leftbanner,
        'vkontakte' => $this->vkontakte,
        'facebook' => $this->facebook,
      ]);
    }
    //echo $this->leftblock;

    // правый блок
    $this->rightblock = $this->render('_rightblock', [
      //'wmr_bonus' => $this->wmr_bonus,
      //'ewm_widget' => $this->ewm_widget,
      'random_news' => $this->random_news,
      'last_news' => $this->last_news,
      'popular_news' => $this->popular_news,
      'archive' => $this->archive,
      //'total_month' => $this->total_month,
      'ref_links' => $this->ref_links,
      'partner_links' => $this->partner_links,
      'internet_links' => $this->internet_links,
    ]);
    //echo $this->rightblock;

    $this->main = $this->render('_main', [
      'leftblock' => $this->leftblock,
      'centerblock' => $this->centerblock,
      'rightblock' => $this->rightblock,
      'display_leftblock' => $this->display_leftblock,
      'display_rightblock' => $this->display_rightblock,
    ]);


    // подключение вывода модального окна
    $this->modal = $this->render('_modal');
    //echo $this->modal;

    // модальное окно с авторизацией
    //$this->auth = $this->render('_auth');
    //echo $this->auth;

    // подключение шапки
    $this->header = $this->render('_header', [
      'search_form' => $this->search_form,
      //'alias' => $this->alias,
    ]);
    //echo $this->header;

    // определение стилей для блоков
    //$this->get_blockstyles($this->display_leftblock, $this->display_rightblock);

    $this->slider = '';

    // получение готового html-кода блока верхнего меню
    $this->topmenu = $this->render('_topmenu', array('topmenu' => $this->menu));
    //echo $this->topmenu;

    $this->bottommenu = ''; // $this->topmenu

    //$this->leftmenu = $this->render('_leftmenu', array('leftmenu' => $this->menu));

    $this->bottombanner = $this->render('_banner', ['banner' => $this->banner1]);
    //echo $this->bottombanner;

    // подключение подвала
    $this->footer = $this->render('_footer');
    //echo $this->footer;

    // кнопка вверх
    $this->totop = $this->render('_totop');
    //echo $this->totop;


    $this->body = $this->render('_body', array(
      'modal' => $this->modal,
      'header' => $this->header,
      'slider' => $this->slider,
      'topmenu' => $this->topmenu,
      'main' => $this->main,
      'bottommenu' => $this->bottommenu,
      'bottombanner' => $this->bottombanner,
      'footer' => $this->footer,
      'totop' => $this->totop
    ));

    $this->meta = $this->render('_meta', ['view' => $this->view, 'description' => $this->description, 'keywords' => $this->keywords]);
    //debug($this->meta);

    //$this->template = 'light';

    $this->styles = $this->render('_styles', ['template' => $this->template, 'prefix' => $this->prefix]);

    $this->scripts1 = $this->render('_scripts1');

    $this->analytics = $this->render('_analytics');

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

  // форматирование баннеров
  protected function format_banner($banner = array()){
    if (!is_array($banner)) {
      return false;
    }
    $banner['file_extension'] = getExtension($banner['image']); // получаем расширение файла (отрезаем все символы, кроме 3-х последних символов в названии файла)
    return $banner;
  }

  // Функция определения количества человек на сайте
  // также эта функция описана в AdminController - дублирование кода
  // https://webscript.ru/stories/02/01/26/6213672
  protected function online() {
    $ip = get_ip(); // получение IP-адреса - здесь нужна проверка на валидность ip-адреса
    $this->Model->delete_ip_online(); // удаление старых записей
    // проверка на присутствие или занесение нового онлайн-посетителя
    if ($this->Model->get_ip_online($ip) == $ip) { // если посетитель с текущим IP-адресом уже есть в базе, то
      $this->Model->update_ip_online($ip); // обновляем данные
    }
    else {
      $this->Model->insert_ip_online($ip); // иначе добавляем новую запись
    }
    return $this->Model->count_elements('online','ip'); // считывание результатов (подсчёт посетителей), total_count_ip_online();
  }

  // форматирование архива новостей
  protected function format_news_archive($data = array()) {
    $archive = array();
    $current_year = ''; // текущий год
    $count_year = 0; // счетчик годов
    $count_month = 0; // счетчик месяцев внутри каждого года
    $count_total_month = 0; // общее количество месяцев (итераций)

    foreach($data as $key => $item){
      $item['year'] = substr($item['month'],0,4); // rusdate('Y',strdatetosec($item['month'].'-01 00:00:00'),0,true);

      if ($current_year != $item['year']){
        $current_year = $item['year']; // устанавливаем новое значение текущего года
        $count_year = $count_year + 1; // увеличиваем счетчик годов
        $count_month = 0; // сбрасываем счетчик месяцев в году
      }
      $archive[$current_year][$count_month]['month'] = $item['month']; // текущий месяц
      $archive[$current_year][$count_month]['month_string'] = rusdate('%MONTH%',strdatetosec($item['month'].'-01 00:00:00'),0);
      // $archive[$current_year][$count_month]['month_count'] = $count_total_month; // текущая итерация (номер месяца)
      $count_month = $count_month + 1; // счетчик месяцев внутри каждого года
      $count_total_month = $count_total_month + 1; // увеличиваем счетчик месяцев (итераций)
    }
    //$archive['total_month'] = $count_total_month;
    return $archive;
  }

  // форматирование архива новостей
  protected function format_archive($data = array(),$year=2012) {
    $archive = array();
    for ($i=2012; $i<=date('Y'); $i++) {
      $archive[$i] = array();
      if ($i == $year) {
        $count_month = 0; // счетчик месяцев внутри каждого года
        if(!empty($data)) {
          foreach($data as $item){
            $archive[$i][$count_month]['month'] = $item['month']; // текущий месяц
            $archive[$i][$count_month]['month_string'] = rusdate('%MONTH%',strdatetosec($item['month'].'-01 00:00:00'),0);
            $count_month = $count_month + 1; // счетчик месяцев внутри каждого года
          }
        }
      }
    }
    return $archive;
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
      $item['comments'] = $this->Model->count_comments($item['id'],$item['type']); // подсчет количества комментариев

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

  /* === Отправка сообщения (начало) === */
  public function send_message(){
    $_SESSION['send_message_errors'] = array(); // массив для проверки наличия ошибок отправки сообщений

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['message_token']) ? trim($_POST['message_token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'send_message'))) {
      $_SESSION['send_message_errors'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['registration_errors']['token'].'<br>';
      $_SESSION['send_message_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
      unset($token);
      return false;
    }

    // получаем текст сообщения
    // удаляем лишние пробелы, если пользователь не ввёл текст сообщения, то выдаем ошибку
    // заносим введенный пользователем текст сообщения в переменную $message_text, если он пустой, то выдаём сообщение о ошибке
    $message_text = isset($_POST['message_text']) ? trim($_POST['message_text']) : null;
    if (empty($message_text)) {$_SESSION['send_message_errors'] = 'Не введён текст сообщения';
      $this->errors['send_message'] = $_SESSION['send_message_errors'].'<br>';
    }

    // Обработка введённого текста сообщения: чистка от программного кода, чистка от ссылок, экранирующих слешей, преобразование спецсимволов в их HTML эквиваленты
    $message_text = validate($message_text,'text'); // clear($message_text,true, false,false, true,false, true);
    //debug($message_text);

    // получаем логин получателя сообщения
    $message_addressee = validate($_POST['message_addressee'],'login');
    if ((empty($_SESSION['send_message_errors'])) and (isset($_SESSION['message']))) {
      $_SESSION['send_message_errors'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['send_message'] = $_SESSION['send_message_errors'].'<br>';
    }
    //debug($message_addressee);

      // если все поля заполнены и ошибок нет
      if(empty($_SESSION['send_message_errors'])){

      // Подготовка данных для сохранения в БД
      // получаем идентификатор страницы получателя
      // $id = clear_int($_POST['id']);

      // логин автора
      $message_author = $_SESSION['user']['login']; // $this->user['login'];
      //debug($message_author);
      // дата добавления
      $date = date("Y-m-d H:i:s");
      $published = 1; // сообщение опубликовано

      // заносим в базу сообщение
      $result_add_message = $this->Model->add_message($message_author,$message_addressee,$published,$date,$message_text);
      //debug($result_add_message);
      // если сообщение отправлено - перенаправляем на страничку пользователя
      if ($result_add_message == true) {
        $_SESSION['send_message_result'] = '<div class="alert alert-success">Ваше сообщение для <strong>'.$message_addressee.'</strong> успешно отправлено</div>';
        return true;
      }
      else { // если сообщение не отправлено, то перенаправляем и выдаём сообщение о неудаче
        $_SESSION['send_message_result'] = '<div class="alert alert-danger">Произошла ошибка! Ваше сообщение не отправлено</div>';
        return false;
      }
    }
    else {
      // если не заполнено поле отправки сообщения
      $_SESSION['send_message_result'] = '<div class="alert alert-danger">'.$_SESSION['send_message_errors'].'</div>';
      return false;
    }
  }
  /* === Отправка сообщения (конец) === */

  /* === Отправка комментария (начало) === */
  public function send_comment($table=null) {
    $_SESSION['comment_errors'] = array(); // массив для проверки наличия ошибок отправки комментария
    $_SESSION['comment_data'] = array(); // массив для хранения введённых данных пользователя

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['comment_token']) ? trim($_POST['comment_token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'send_comment'))) {
      $_SESSION['comment_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['comment_errors']['token'].'<br>';
      $_SESSION['comment_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
      unset($token);
      return false;
    }

    // удаляем лишние пробелы, если пользователь не ввёл имя, e-mail, текст комментария или код капчи, то выдаём ошибку
    // заносим введенное пользователем имя в переменную $comment_author, если оно пустое, то выдаём сообщение о ошибке
    $comment_author = isset($_POST['comment_author']) ? trim($_POST['comment_author']) : null;
    if (empty($comment_author)) {$_SESSION['comment_errors']['comment_author'] = 'Не введено имя'; $this->errors['comment_author'] = $_SESSION['comment_errors']['comment_author'].'<br>';}

    // заносим введенный пользователем адрес электронной почты в переменную $author_email, если он пустой, то выдаём сообщение о ошибке
    $author_email = isset($_POST['author_email']) ? trim($_POST['author_email']) : null;
    if (empty($author_email)) {$_SESSION['comment_errors']['author_email'] = 'Не введён адрес электронной почты'; $this->errors['author_email'] = $_SESSION['comment_errors']['author_email'].'<br>';}

    // заносим введенный пользователем сайт в переменную $author_site
    $author_site = isset($_POST['author_site']) ? trim($_POST['author_site']) : null;

    // заносим введенный пользователем текст комментария в переменную $comment_text, если он пустой, то выдаём сообщение о ошибке
    $comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : null;
    if (empty($comment_text)) {$_SESSION['comment_errors']['comment_text'] = 'Не введён текст комментария'; $this->errors['comment_text'] = $_SESSION['comment_errors']['comment_text'].'<br>';}

    // заносим введенный пользователем код капчи в переменную $checksum, если он пустой, то выдаём сообщение о ошибке
    $checksum = isset($_POST['checksum']) ? clear_int($_POST['checksum']) : null;
    if (empty($checksum)) {$_SESSION['comment_errors']['checksum'] = 'Не введён код с картинки'; $this->errors['checksum'] = $_SESSION['comment_errors']['checksum'].'<br>';}

    $type = clear_int($_POST['type']);
    $post_id = clear_int($_POST['post_id']);
    $gallery_id = clear_int($_POST['gallery_id']);
    $image_id = clear_int($_POST['image_id']);
    $album_id = clear_int($_POST['album_id']);
    $parent_id = clear_int($_POST['parent_id']);

    $random = clear_int($_POST['random']);

    // 2. Сохранение полученных данных в сессии
    $_SESSION['comment_data']['comment_author'] = $comment_author;
    $_SESSION['comment_data']['author_email'] = $author_email;
    $_SESSION['comment_data']['author_site'] = $author_site;
    $_SESSION['comment_data']['comment_text'] = $comment_text;
    // $_SESSION['comment_data']['code'] = $code; // код запоминать не нужно

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных (начало)
    // если сумма чисел неверна, то удаляем переменную $checksum и выдаём ошибку
    if (check_sum($checksum, $random) === false) {
      unset($checksum);
      if (empty($_SESSION['comment_errors']['checksum'])) {
        $_SESSION['comment_errors']['checksum'] = 'Код с картинки введён неверно';
        $_SESSION['comment_result'] = '<div class="alert alert-danger">Код с картинки введён неверно</div>';
        $this->errors['checksum'] = $_SESSION['comment_errors']['checksum'].'<br>';
        return false;
      }
    }

    // если имя автора, е-майл, сайт и текст введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $comment_author = validate($comment_author,'name');
    if ((empty($_SESSION['comment_errors']['comment_author'])) and (isset($_SESSION['message']))) {
      $_SESSION['comment_errors']['comment_author'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['comment_author'] = $_SESSION['comment_errors']['comment_author'].'<br>';
    }
    $author_email = validate($author_email, 'email');
    if ((empty($_SESSION['comment_errors']['author_email'])) and (isset($_SESSION['message']))) {
      $_SESSION['comment_errors']['author_email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['author_email'] = $_SESSION['comment_errors']['author_email'].'<br>';
    }
    $author_site = validate($author_site, 'url');
    if ((empty($_SESSION['comment_errors']['author_site'])) and (isset($_SESSION['message']))) {
      $_SESSION['comment_errors']['author_site'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['author_site'] = $_SESSION['comment_errors']['author_site'].'<br>';
    }
    $comment_text = validate($comment_text, 'html');
    /* if ((empty($_SESSION['comment_errors']['comment_text'])) and (isset($_SESSION['message']))) {
      $_SESSION['comment_errors']['comment_text'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['comment_text'] = $_SESSION['comment_errors']['comment_text'].'<br>';
    } */

    // если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($comment_author, 2, 30)) {
      if (empty($_SESSION['comment_errors']['comment_author'])) {
        $_SESSION['comment_errors']['comment_author'] = 'Имя должно состоять не менее чем из 2-х символов и не более чем из 30';
        $this->errors['comment_author'] = $_SESSION['comment_errors']['comment_author'].'<br>';
      }
    }

    // проверка еmail на существование и доступность, если email не существует или не доступен, то выдаём ошибку
    /*
    $checkmail = new CheckMail();
    if ((empty($author_email)) or (!$checkmail->execute($author_email))) {
      if (empty($_SESSION['comment_errors']['author_email'])) {
        $_SESSION['comment_errors']['author_email'] = 'Адрес электронной почты не существует или не доступен';
        $this->errors['author_email'] = $_SESSION['comment_errors']['author_email'].'<br>';
      }
    } */

    // 4. Проверка на наличие ошибок: если все поля заполнены и ошибок нет
    if (empty($_SESSION['comment_errors'])){
      //debug($_SESSION);
      unset($_SESSION['comment_errors']);

      // 5. Проверка email на уникальность (проверка на существование пользователя с таким же email) и автоматическая подписка НАЧАЛО
      $this->UserModel = new UserModel();
      $result_user = $this->UserModel->get_user_for_subscription($author_email); // извлекаем из базы данных id пользователя с введённым email - получаем либо массив, либо false если пользователь не найден
      //debug((int)$result_user);
      if ((int)$result_user > 0) { // 1 - такой email есть, 0 - такого email нет
        $user_id = (int)$result_user['id']; // если совпадение найдено и получен массив (пользователь с таким email уже есть), то выдаём id пользователя
        //$_SESSION['comment_result'] = '<div class="alert alert-danger">Пользователь с таким адресом электронной почты уже подписан на сайте. Введите другой адрес электронной почты.</div>';
        //$_SESSION['comment_data']['author_email'] = ''; // сбрасываем email
      }
      else { // иначе, если такого email нет, email - уникальный, то сохраняем данные пользователя в БД

        // 6. Подготовка данных к сохранению в БД
        $last_name = ''; // фамилия
        $login = ''; // логин ПУСТОЙ
        $password = ''; // пароль ПУСТОЙ
        $avatar = DAVATAR; // путь к заранее приготовленной картинке с надписью "нет аватара"
        $photo = ''; // путь к фотографии, null - пустое значение
        $phone = ''; // номер телефона
        if (!isset($author_site)) {$author_site = '';} // адрес сайта или веб-страница
        $activ = 0; // активация: 0 - не активирован, 1 - активирован
        $status = 2; // статус пользователя: 0 - не существует/удалён, 1 - заблокирован, 2 - подписчик, 3 - обычный, 4 - модератор, 5 - администратор
        $method = 0; // способ авторизации: 0 - сайт rolar.ru, 1 - Вконтакте, 2 - Facebook, 3 - Twitter, 4 - Одноклассники, 5 - Mail.ru, 6 - Google, 7 -Yandex
        $social_id = ''; // ID в соц. сетях, null - пустое значение
        $reg_date = date("Y-m-d H:i:s"); // дата регистрации пользователя '1970-01-01 00:00:00'
        //$login_date = $reg_date; // дата авторизации пользователя '1970-01-01 00:00:00'
        $birthday = date("Y-m-d"); // дата рождения '1970-01-01'
        $gender = 0; // пол: 0 - не определён, 1 - женский, 2 - мужской
        $ip = get_ip(); // IPv4-адрес пользователя '127.0.0.1'
        $letter_type = 0; // Тип письма: 0 - обычное текстовое письмо, 1 - html-письмо
        $view = 0; // количество просмотров

        // 7. Сохранение пользователя в базе данных
        $user_id = $this->UserModel->add_user($comment_author,$login,$password,$author_email, $last_name,$avatar,$photo,$phone,$author_site,$activ,$status,$method,$social_id,$reg_date,$birthday,$gender,$ip,$letter_type,$view);
        //debug($user_id);
        if ($user_id > 0) { // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации

          // 8. Генерация кода активации аккаунта
          $activation = shifr_activation($user_id, $login, $author_email);

          // 9. Отправка уведомления на email
          // тема сообщения
          $subject = 'Подтверждение подписки на сайте '.DOMEN;
          // содержание сообщения
          $message_for_mail = 'Здравствуйте, '.$comment_author.'! Благодарим Вас за подписку на сайте '.DOMEN.'.'."\n".'
Ваш email: '.$author_email."\n".'
Чтобы активировать Ваш аккаунт, перейдите по ссылке:'."\n".D.S.'activation?email='.$author_email.'&code='.$activation."\n".'
С уважением,'."\n".'
    Администрация сайта '.DOMEN.'.';
          // отправляем сообщение
          //mail($email, $subject, $message_for_mail, "content-type: text/plane; charset=utf-8\r\n");
          $emails = get_one_email($author_email, $comment_author, 0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с активацией

          // 10. Формирование сообщений об успешной подписке
          // сообщаем пользователю об успешной подписке и о необходимости активации в полученном письме
          //$_SESSION['comment_result'] = '<div class="alert alert-success">Подписка прошла успешно.<br><br><strong>'.$first_name.'</strong>, благодарим Вас за подписку на сайте '.DOMEN.'!<br><br>Вам на e-mail <strong>'.$email.'</strong> было выслано письмо с темой &quot;<strong>Подтверждение подписки на сайте '.DOMEN.'&quot;</strong>.<br>Для подтверждения подписки:<br>1. Откройте это письмо,<br>2. Перейдите по специальной ссылке.<br>И тогда Ваш адрес электронной почты будет зарегистрирован.<br><br><strong>Внимание! Ссылка для активации действительна 24 часа!</strong></div>';
          $_SESSION['subscription_success'] = true; // создаём метку об успешной подписке (чтобы форма регистрации не отображалась)
          setcookie('subscription', true, time() + 86400, '/'); // создаем куку Подписака со значением true на 24 часа
        }
        /*
        else { // в случае ошибки при добавлении пользователя в базу данных
          $_SESSION['comment_result'] = '<div class="alert alert-danger">Произошла ошибка! Вы не подписаны</div>';
          return false;
        }*/
      }
      // 5. Проверка email на уникальность (проверка на существование пользователя с таким же email) и автоматическая подписка КОНЕЦ

      // 6. подготовка данных к сохранению в БД
      $published = 1; // 1 - комментарий опубликован, 0 - не опубликован
      $del = 0; // 0 - не удалён, 1 - удалён
      $date = date("Y-m-d H:i:s");

      // 7. Добавление полученных данных в базу
      $result_add_comment = $this->Model->add_comment($published,$del,$type,$post_id,$gallery_id,$image_id,$album_id,$parent_id,$user_id,$comment_author,$author_email,$author_site,$date,$comment_text);
      // debug($result_add_comment);
      if ($result_add_comment == 'true') { // если данные комментария успешно добавлены отправляем администратору письмо с уведомлением
        unset($_SESSION['comment_data'], $_SESSION['comment_errors']); // удаляем из сессии массивы пользовательских данных и ошибок при отправке комментария

        // 8. Подготовка данных к отправке сообщения
        if (empty($author_site)) {$author_site_for_mail = 'не указан';}
        else {$author_site_for_mail = $author_site;}

        if ($post_id > 0) {
          $post = $this->Model->get_post_title_for_comment($post_id);
          $put = D.S.'post'.$post_id.' или '.D.S.'post/'.$post['alias'];
          // Сопоставление разделов с их номером и адресом
          if ($post['type'] == 0) {$razdel='Новости';}
          if ($post['type'] == 1) {$razdel='Партнёрские продукты';}
          if ($post['type'] == 2) {$razdel='Скачать';}
          if ($post['type'] == 3) {$razdel='Товары';}
          if ($post['type'] == 4) {$razdel='Галерея';}
          if ($post['type'] == 5) {$razdel='Музыка';}
          $subject = 'Новый комментарий к заметке '.$post['title'];
          $mail_message = 'Добавлен новый комментарий в разделе "'.$razdel.'" к заметке "'.$post['title'].'"'."\r\n".'Комментарий добавил(а): '.$comment_author."\r\n".'Электронная почта (e-mail): '.$author_email."\r\n".'Сайт: '.$author_site_for_mail."\r\n".'Текст комментария: '.$comment_text."\r\n".'Дата добавления: '.$date."\r\n".'Ссылка на заметку: '.$put;
        }
        if ($gallery_id > 0) {
          $gallery = $this->Model->get_gallery_title_for_comment($gallery_id);
          $put = D.S.$gallery['name']; // D.S.'gallery'.$gallery_id;
          $subject = 'Новый комментарий к галерее '.$gallery['title'];
          $mail_message = 'Добавлен новый комментарий к галерее "'.$gallery['title'].'"'."\r\n".'Комментарий добавил(а): '.$comment_author."\r\n".'Электронная почта (e-mail): '.$author_email."\r\n".'Сайт: '.$author_site_for_mail."\r\n".'Текст комментария: '.$comment_text."\r\n".'Дата добавления: '.$date."\r\n".'Ссылка на галерею: '.$put;
        }
        /* if ($image_id > 0) {
          $post = $this->Model->get_image_title_for_comment($image_id);
        }
        if ($album_id > 0) {
          $post = $this->Model->get_album_title_for_comment($album_id);
        } */

        // 9. Отправка сообщения
        //mail($address,$subject,$mail_message,"Content-type: comment_text/plain; Charset=utf-8\r\n");
        $emails = get_one_email(ADMINEMAIL,AUTHOR,0);
        $mail = new Mail(); // инициализируем класс
        $mail->Mail($emails, $subject, $mail_message);
        $_SESSION['comment_result'] = '<div class="alert alert-success">Ваш комментарий успешно отправлен</div>';
        return true;
      }
      else { // если сообщение не отправлено, то перенаправляем и выдаём сообщение о неудаче
        $_SESSION['comment_result'] = '<div class="alert alert-danger">Произошла ошибка! Комментарий не отправлен</div>';
        return false;
      }
    }
    else { // иначе если есть ошибки в ходе заполнения, то выдаём ошибку
      $_SESSION['comment_result'] = '<div class="alert alert-danger">В ходе отправки комментария были допущены ошибки</div>';
      return false;
    }
  }
  /* === Отправка комментария (конец) === */




}