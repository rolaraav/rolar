<?php
namespace app\controllers\admin;

use core\libs\Pagination;

class PostController extends AdminController {

  public $post = ''; // выбранный материал

  public $post_categories = ''; // блок select с категориями постов
  public $partners = ''; // блок select с партнёрами

  public function indexAction(){
    // echo 'Метод indexAction контроллера PostController';

    //debug($this->id);
    // получаем идентификатор пользователя $user_id
    // нужна проверка, если $user_id больше имеющихся количества пользователей, или пользователь удалён (скрыт), то данные этого пользователя не получаются
    if ((empty($this->id) or ($this->id == 0))) {
      $user_id = 1; // если параметр не передан, то показываем первого пользователя
    }
    else {
      $user_id = $this->id;
    }
    //debug($user_id);
    //debug($_GET);
    if(isset($_GET['type'])) {
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('page');
          $type = 0;
          $this->title = 'Страницы'; // материалы
          $button_name = 'Создать страницу';
          $column_title = 'Название страницы';
          $ifempty = 'Страниц пока нет.';
          break;
        case('news');
          $type = 1;
          $this->title = 'Новости'; // материалы
          $button_name = 'Создать новость';
          $column_title = 'Название новости';
          $ifempty = 'Новостей пока нет.';
          break;
        case('partner_product');
          $type = 2;
          $this->title = 'Партнёрские продукты';
          $button_name = 'Создать партнёрский продукт';
          $column_title = 'Название партнёрского продукта';
          $ifempty = 'Партнёрских продуктов пока нет.';
          break;
        case('download');
          $type = 3;
          $this->title = 'Закачки';
          $button_name = 'Создать закачку';
          $column_title = 'Название закачки';
          $ifempty = 'Закачек пока нет.';
          break;
        case('goods');
          $type = 4;
          $this->title = 'Товары';
          $button_name = 'Создать товар';
          $column_title = 'Название товара';
          $ifempty = 'Товаров пока нет.';
          break;
        case('gallery');
          $type = 5;
          $this->title = 'Галереи';
          $button_name = 'Создать галерею';
          $column_title = 'Название галереи';
          $ifempty = 'Галерей пока нет.';
          break;
        case('album');
          $type = 6;
          $this->title = 'Альбомы';
          $button_name = 'Cоздать альбом';
          $column_title = 'Название альбома';
          $ifempty = 'Альбомов пока нет.';
          break;
        case('post');
          $type = 7;
          $this->title = 'Заметки';
          $button_name = 'Создать заметку';
          $column_title = 'Название заметки';
          $ifempty = 'Заметок пока нет.';
          break;
      }
      $type_string_for_url = '?type='.$type_string;
      $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="Материалы">Материалы</a> &raquo; <a class="current" href="'.ADMIN.S.'post?type='.$type_string.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
    }
    else {
      $type = null; // материалы для обычной страницы
      $this->title = 'Материалы';
      $type_string_for_url = '';
      $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
      $button_name = 'Cоздать материал';
      $column_title = 'Название материала';
      $ifempty = 'Материалов пока нет.';
    }


    //$href = "index.php?v=".$view;


    //$limit = pagnav_calc($cnum,$total_news); // параметры для постраничной навигации
    //$news = get_view_news($limit);

    //debug($this->route);
    //$alias = $this->route['alias'];


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_posts($type); // $this->total_data; // общее количество материалов // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $posts = $this->AdminModel->get_view_data($limit, $type);
    //debug($posts);
    // get_data($category['type'], $query_category_id, null, $partner_id, ['date', 'id'], ['DESC','DESC'], $limit));
    //$this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
    //debug($this->posts);









//    $this->set(['test' => $test,
//      'data' => $data,
//      ]);
    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'alias' => $this->alias,
      'page' => $this->page,
      'user' => $this->user,
      'posts' => $posts,
      'pagination' => $this->pagination,
      'type_string_for_url' => $type_string_for_url,
      'button_name' => $button_name,
      'column_title' => $column_title,
      'ifempty' => $ifempty,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  public function testAction(){
    //echo __METHOD__;

    $this->layout = 'admin';

  }

  public function viewAction(){
    //echo __METHOD__;

  }

  public function createAction(){
    //echo __METHOD__;

    //debug($_GET);
    if(isset($_GET['type'])) { // если указан тип материала (нужен для установки selected_id)
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('page');
          $type = 0;
          $default_image_path = 'images/pages/'; // папка с изображениями по умолчанию
          $name = ['i' => 'страница', 'r' => 'страницы', 'd' => 'странице', 'v' => 'страницу', 't' => 'страницей', 'p' => 'о странице']; // названия во всех падежах
          $names = ['i' => 'Страницы', 'r' => 'Страниц', 'd' => 'Страницам', 'v' => 'Страницы', 't' => 'Страницами', 'p' => 'О страницах']; // названия во всех падежах множественное число
          break;
        case('news');
          $type = 1;
          $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
          $name = ['i' => 'новость', 'r' => 'новости', 'd' => 'новости', 'v' => 'новость', 't' => 'новостью', 'p' => 'о новости']; // названия во всех падежах
          $names = ['i' => 'Новости', 'r' => 'Новостей', 'd' => 'Новостям', 'v' => 'Новости', 't' => 'Новостями', 'p' => 'О новостях']; // названия во всех падежах множественное число
          break;
        case('partner_product');
          $type = 2;
          $default_image_path = 'images/partner_products/'; // папка с изображениями по умолчанию
          $name = ['i' => 'партнёрский продукт', 'r' => 'партнёрского продукта', 'd' => 'партнёрскому продукту', 'v' => 'партнёрский продукт', 't' => 'партнёрским продуктом', 'p' => 'о партнёрском продукте']; // названия во всех падежах
          $names = ['i' => 'Партнёрские продукты', 'r' => 'Партнёрских продуктов', 'd' => 'Партнёрским продуктам', 'v' => 'Партнёрские продукты', 't' => 'Партнёрскими продуктами', 'p' => 'О партнёрских продуктах']; // названия во всех падежах множественное число
          break;
        case('download');
          $type = 3;
          $default_image_path = 'images/downloads/'; // папка с изображениями по умолчанию
          $name = ['i' => 'закачка', 'r' => 'закачки', 'd' => 'закачке', 'v' => 'закачку', 't' => 'закачкой', 'p' => 'о закачке']; // названия во всех падежах
          $names = ['i' => 'Закачки', 'r' => 'Закачек', 'd' => 'Закачкам', 'v' => 'Закачки', 't' => 'Закачками', 'p' => 'О закачках']; // названия во всех падежах множественное число
          break;
        case('goods');
          $type = 4;
          $default_image_path = 'images/goods/'; // папка с изображениями по умолчанию
          $name = ['i' => 'товар', 'r' => 'товара', 'd' => 'товару', 'v' => 'товар', 't' => 'товаром', 'p' => 'о товаре']; // названия во всех падежах
          $names = ['i' => 'Товары', 'r' => 'Товаров', 'd' => 'Товарам', 'v' => 'Товары', 't' => 'Товарами', 'p' => 'О товарах']; // названия во всех падежах множественное число
          break;
        case('gallery');
          $type = 5;
          $default_image_path = 'images/galleries/'; // папка с изображениями по умолчанию
          $names = ['i' => 'галерея', 'r' => 'галереи', 'd' => 'галерее', 'v' => 'галерею', 't' => 'галереей', 'p' => 'о галерее']; // названия во всех падежах
          $namess = ['i' => 'Галереи', 'r' => 'Галерей', 'd' => 'Галереям', 'v' => 'Галереи', 't' => 'Галереями', 'p' => 'О галереях']; // названия во всех падежах множественное число
          break;
        case('album');
          $type = 6;
          $default_image_path = 'images/albums/'; // папка с изображениями по умолчанию
          $name = ['i' => 'альбом', 'r' => 'альбома', 'd' => 'альбому', 'v' => 'альбом', 't' => 'альбомом', 'p' => 'об альбоме']; // названия во всех падежах
          $names = ['i' => 'Альбомы', 'r' => 'Альбомов', 'd' => 'Альбомам', 'v' => 'Альбомов', 't' => 'Альбомами', 'p' => 'Об альбомах']; // названия во всех падежах множественное число
          break;
        case('post');
          $type = 7;
          $default_image_path = 'images/posts/'; // папка с изображениями по умолчанию
          $name = ['i' => 'заметка', 'r' => 'заметки', 'd' => 'заметке', 'v' => 'заметку', 't' => 'заметкой', 'p' => 'о заметке']; // названия во всех падежах
          $names = ['i' => 'Заметки', 'r' => 'Заметок', 'd' => 'Заметкам', 'v' => 'Заметок', 't' => 'Заметками', 'p' => 'О заметках']; // названия во всех падежах множественное число
          break;
      }
    }
    else {
      $type = 1; // тип материала по умолчанию
      $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
      $name = ['i' => 'материал', 'r' => 'материала', 'd' => 'материалу', 'v' => 'материал', 't' => 'материалом', 'p' => 'о материале']; // названия материала во всех падежах
      $names = ['i' => 'Материалы', 'r' => 'Материалов', 'd' => 'Материалам', 'v' => 'Материалы', 't' => 'Материалами', 'p' => 'О материалах']; // названия материала во всех падежах множественное число
    }
    $title = $names['i']; // 'Материалы';
    $this->title = 'Создать '.$name['v'];
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
    //$rub = get_rubs(); // получение рубрик для selecta

    $secret1 = '';
    $secret0 = CHECK;
    $hidden1 = '';
    $hidden0 = CHECK;
    $hide_link1 = '';
    $hide_link0 = CHECK;

    $comments1 = CHECK;
    $comments0 = '';

    $published1 = CHECK;
    $published0 = '';
    //$del1 = '';
    //$del0 = CHECK;
    $selected_category = 1; // выбранная категория по умолчанию
    $selected_partner = 0; // выбранный партнёр по умолчанию, 0 - без партнёра

    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['type'])) {
        $type = $_SESSION['create']['type'];
      }
      else {
        $type = 1; // тип материала по умолчанию
      }
      if ($_SESSION['create']['secret'] == 1) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if ($_SESSION['create']['hidden'] == 1) {
        $hidden1 = CHECK;
        $hidden0 = '';
      }
      else {
        $hidden1 = '';
        $hidden0 = CHECK;
      }
      if ($_SESSION['create']['hide_link'] == 1) {
        $hide_link1 = CHECK;
        $hide_link0 = '';
      }
      else {
        $hide_link1 = '';
        $hide_link0 = CHECK;
      }
      if ($_SESSION['create']['comments'] == 1) {
        $comments1 = CHECK;
        $comments0 = '';
      }
      else {
        $comments1 = '';
        $comments0 = CHECK;
      }
      if ($_SESSION['create']['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }

      if (isset($_SESSION['create']['category'])) {
        $selected_category = $_SESSION['create']['category']; // выбранная категрия
      }
      else {
        $selected_category = 1;
      }
      if (isset($_SESSION['create']['partner'])) {
        $selected_partner = $_SESSION['create']['partner']; // выбранный партнёр
      }
      else {
        $selected_partner = 0;
      }
    }

    $post_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом']);
    $this->post_types = $this->renderSelect(['options' => $post_types, 'select_name' => 'type', 'select_title' => 'Выберите тип материала', 'select_class' => 'form-select', 'select_id' => 'create_post_type_field', 'selected_id' => $type, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->post_types);

    //debug($this->categories);
    $this->post_categories = $this->renderSelect(['options' => $this->categories, 'select_name' => 'category', 'select_title' => 'Выберите категорию '.$name['r'], 'select_class' => 'form-select', 'select_id' => 'create_post_category_field', 'selected_id' => $selected_category, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->post_categories);

    $without_partner = array(['id' => 0, 'title' => '[Без партнёра]']);
    $partners = $this->AdminModel->cp_get_partners();
    //debug($partners);
    $partners = array_merge($without_partner, $partners); // сливает один или большее количество массивов
    $this->partners = $this->renderSelect(['options' => $partners, 'select_name' => 'partner', 'select_title' => 'Выберите партнёра (если есть)', 'select_class' => 'form-select', 'select_id' => 'create_post_partner_field', 'selected_id' => $selected_partner, 'disabled_id' => false, 'select_important' => false, 'disabled' => false]);
    //debug($this->partners);

    if (isset($_POST['submit_post'])) {
      if ($this->AdminModel->create_post()) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      //'alias' => $this->alias,
      //'page' => $this->page,
      'user' => $this->user,
      //'posts' => $posts,
      'pagination' => $this->pagination,
      'post_types' => $this->post_types,
      'post_categories' => $this->post_categories,
      'partners' => $this->partners,
      'default_image_path' => $default_image_path,
      'name' => $name,
      'names' => $names,
      //'messages' => $current_user['messages'],
      //'quantity_posts' => $this->quantity_posts,
      //'token' => $this->getToken('update_user'),
      //'message_token' => $this->getToken('send_message'),
      'secret1' => $secret1,
      'secret0' => $secret0,
      'hidden1' => $hidden1,
      'hidden0' => $hidden0,
      'hide_link1' => $hide_link1,
      'hide_link0' => $hide_link0,
      'comments1' => $comments1,
      'comments0' => $comments0,
      'published0' => $published0,
      'published1' => $published1,
    ]);
  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор поста
    if ((empty($this->id) or ($this->id == 0))) {
      $post_id = 1; // если параметр ID не передан, то показываем первый материал
    }
    else {
      $post_id = $this->id;
    }
    //debug($user_id);
    //debug($_GET);
    if(isset($_GET['type'])) { // если указан тип материала (нужен для установки selected_id)
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('page');
          $type = 0;
          $default_image_path = 'images/pages/'; // папка с изображениями по умолчанию
          $name = ['i' => 'страница', 'r' => 'страницы', 'd' => 'странице', 'v' => 'страницу', 't' => 'страницей', 'p' => 'о странице']; // названия во всех падежах
          $names = ['i' => 'Страницы', 'r' => 'Страниц', 'd' => 'Страницам', 'v' => 'Страницы', 't' => 'Страницами', 'p' => 'О страницах']; // названия во всех падежах множественное число
          break;
        case('news');
          $type = 1;
          $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
          $name = ['i' => 'новость', 'r' => 'новости', 'd' => 'новости', 'v' => 'новость', 't' => 'новостью', 'p' => 'о новости']; // названия во всех падежах
          $names = ['i' => 'Новости', 'r' => 'Новостей', 'd' => 'Новостям', 'v' => 'Новости', 't' => 'Новостями', 'p' => 'О новостях']; // названия во всех падежах множественное число
          break;
        case('partner_product');
          $type = 2;
          $default_image_path = 'images/partner_products/'; // папка с изображениями по умолчанию
          $name = ['i' => 'партнёрский продукт', 'r' => 'партнёрского продукта', 'd' => 'партнёрскому продукту', 'v' => 'партнёрский продукт', 't' => 'партнёрским продуктом', 'p' => 'о партнёрском продукте']; // названия во всех падежах
          $names = ['i' => 'Партнёрские продукты', 'r' => 'Партнёрских продуктов', 'd' => 'Партнёрским продуктам', 'v' => 'Партнёрские продукты', 't' => 'Партнёрскими продуктами', 'p' => 'О партнёрских продуктах']; // названия во всех падежах множественное число
          break;
        case('download');
          $type = 3;
          $default_image_path = 'images/downloads/'; // папка с изображениями по умолчанию
          $name = ['i' => 'закачка', 'r' => 'закачки', 'd' => 'закачке', 'v' => 'закачку', 't' => 'закачкой', 'p' => 'о закачке']; // названия во всех падежах
          $names = ['i' => 'Закачки', 'r' => 'Закачек', 'd' => 'Закачкам', 'v' => 'Закачки', 't' => 'Закачками', 'p' => 'О закачках']; // названия во всех падежах множественное число
          break;
        case('goods');
          $type = 4;
          $default_image_path = 'images/goods/'; // папка с изображениями по умолчанию
          $name = ['i' => 'товар', 'r' => 'товара', 'd' => 'товару', 'v' => 'товар', 't' => 'товаром', 'p' => 'о товаре']; // названия во всех падежах
          $names = ['i' => 'Товары', 'r' => 'Товаров', 'd' => 'Товарам', 'v' => 'Товары', 't' => 'Товарами', 'p' => 'О товарах']; // названия во всех падежах множественное число
          break;
        case('gallery');
          $type = 5;
          $default_image_path = 'images/galleries/'; // папка с изображениями по умолчанию
          $name = ['i' => 'галерея', 'r' => 'галереи', 'd' => 'галерее', 'v' => 'галерею', 't' => 'галереей', 'p' => 'о галерее']; // названия во всех падежах
          $names = ['i' => 'Галереи', 'r' => 'Галерей', 'd' => 'Галереям', 'v' => 'Галереи', 't' => 'Галереями', 'p' => 'О галереях']; // названия во всех падежах множественное число
          break;
        case('album');
          $type = 6;
          $default_image_path = 'images/albums/'; // папка с изображениями по умолчанию
          $name = ['i' => 'альбом', 'r' => 'альбома', 'd' => 'альбому', 'v' => 'альбом', 't' => 'альбомом', 'p' => 'об альбоме']; // названия во всех падежах
          $names = ['i' => 'Альбомы', 'r' => 'Альбомов', 'd' => 'Альбомам', 'v' => 'Альбомов', 't' => 'Альбомами', 'p' => 'Об альбомах']; // названия во всех падежах множественное число
          break;
        case('post');
          $type = 7;
          $default_image_path = 'images/posts/'; // папка с изображениями по умолчанию
          $name = ['i' => 'заметка', 'r' => 'заметки', 'd' => 'заметке', 'v' => 'заметку', 't' => 'заметкой', 'p' => 'о заметке']; // названия во всех падежах
          $names = ['i' => 'Заметки', 'r' => 'Заметок', 'd' => 'Заметкам', 'v' => 'Заметок', 't' => 'Заметками', 'p' => 'О заметках']; // названия во всех падежах множественное число
          break;
      }
    }
    else {
      $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
      $name = ['i' => 'материал', 'r' => 'материала', 'd' => 'материалу', 'v' => 'материал', 't' => 'материалом', 'p' => 'о материале']; // названия материала во всех падежах
      $names = ['i' => 'Материалы', 'r' => 'Материалов', 'd' => 'Материалам', 'v' => 'Материалы', 't' => 'Материалами', 'p' => 'О материалах']; // названия материала во всех падежах множественное число
    }
    $title = $names['i']; // 'Материалы';
    $this->title = 'Редактировать '.$name['v'];
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$post_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->post = $this->AdminModel->cp_get_post($post_id);

    $secret1 = '';
    $secret0 = CHECK;
    $hidden1 = '';
    $hidden0 = CHECK;
    $hide_link1 = '';
    $hide_link0 = CHECK;

    $comments1 = CHECK;
    $comments0 = '';

    $published1 = CHECK;
    $published0 = '';
    //$del1 = '';
    //$del0 = CHECK;
    $selected_category = 1; // выбранная категория по умолчанию
    $selected_partner = 0; // выбранный партнёр по умолчанию, 0 - без партнёра

    if (isset($this->post)) {
      if (isset($this->post['type'])) {
        $type = $this->post['type'];
      }
      else {
        $type = 1; // тип материала по умолчанию
      }
      if ($this->post['secret'] == 1) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if ($this->post['hidden'] == 1) {
        $hidden1 = CHECK;
        $hidden0 = '';
      }
      else {
        $hidden1 = '';
        $hidden0 = CHECK;
      }
      if ($this->post['hide_link'] == 1) {
        $hide_link1 = CHECK;
        $hide_link0 = '';
      }
      else {
        $hide_link1 = '';
        $hide_link0 = CHECK;
      }
      if ($this->post['comments'] == 1) {
        $comments1 = CHECK;
        $comments0 = '';
      }
      else {
        $comments1 = '';
        $comments0 = CHECK;
      }
      if ($this->post['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->post['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    $post_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом']);
    $this->post_types = $this->renderSelect(['options' => $post_types, 'select_name' => 'type', 'select_title' => 'Выберите тип материала', 'select_class' => 'form-select', 'select_id' => 'edit_post_type_field', 'selected_id' => $type, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->post_types);

    //debug($this->categories);
    $this->post_categories = $this->renderSelect(['options' => $this->categories, 'select_name' => 'category', 'select_title' => 'Выберите категорию '.$name['r'], 'select_class' => 'form-select', 'select_id' => 'edit_post_category_field', 'selected_id' => $this->post['category'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->post_categories);

    $without_partner = array(['id' => 0, 'title' => '[Без партнёра]']);
    $partners = $this->AdminModel->cp_get_partners();
    //debug($partners);
    $partners = array_merge($without_partner, $partners); // сливает один или большее количество массивов
    $this->partners = $this->renderSelect(['options' => $partners, 'select_name' => 'partner', 'select_title' => 'Выберите партнёра (если есть)', 'select_class' => 'form-select', 'select_id' => 'edit_post_partner_field', 'selected_id' => $this->post['partner'], 'disabled_id' => false, 'select_important' => false, 'disabled' => false]);
    //debug($this->partners);

    if (isset($_POST['submit_post'])) {
      if ($this->AdminModel->edit_post($post_id)) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      //'alias' => $this->alias,
      //'page' => $this->page,
      'user' => $this->user,
      //'posts' => $posts,
      'pagination' => $this->pagination,
      'post_types' => $this->post_types,
      'post_categories' => $this->post_categories,
      'partners' => $this->partners,
      'post' => $this->post,
      'default_image_path' => $default_image_path,
      'name' => $name,
      'names' => $names,
      //'messages' => $current_user['messages'],
      //'quantity_posts' => $this->quantity_posts,
      //'token' => $this->getToken('update_user'),
      //'message_token' => $this->getToken('send_message'),
      'secret1' => $secret1,
      'secret0' => $secret0,
      'hidden1' => $hidden1,
      'hidden0' => $hidden0,
      'hide_link1' => $hide_link1,
      'hide_link0' => $hide_link0,
      'comments1' => $comments1,
      'comments0' => $comments0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);



  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор курса
    if ((empty($this->id) or ($this->id == 0))) {
      $post_id = 1; // если параметр ID не передан, то показываем первый материал
    }
    else {
      $post_id = $this->id;
    }
    //debug($user_id);
    //debug($_GET);
    if(isset($_GET['type'])) { // если указан тип материала (нужен для установки selected_id)
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('page');
          $type = 0;
          $default_image_path = 'images/pages/'; // папка с изображениями по умолчанию
          $name = ['i' => 'страница', 'r' => 'страницы', 'd' => 'странице', 'v' => 'страницу', 't' => 'страницей', 'p' => 'о странице']; // названия во всех падежах
          $names = ['i' => 'Страницы', 'r' => 'Страниц', 'd' => 'Страницам', 'v' => 'Страницы', 't' => 'Страницами', 'p' => 'О страницах']; // названия во всех падежах множественное число
          break;
        case('news');
          $type = 1;
          $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
          $name = ['i' => 'новость', 'r' => 'новости', 'd' => 'новости', 'v' => 'новость', 't' => 'новостью', 'p' => 'о новости']; // названия во всех падежах
          $names = ['i' => 'Новости', 'r' => 'Новостей', 'd' => 'Новостям', 'v' => 'Новости', 't' => 'Новостями', 'p' => 'О новостях']; // названия во всех падежах множественное число
          break;
        case('partner_product');
          $type = 2;
          $default_image_path = 'images/partner_products/'; // папка с изображениями по умолчанию
          $name = ['i' => 'партнёрский продукт', 'r' => 'партнёрского продукта', 'd' => 'партнёрскому продукту', 'v' => 'партнёрский продукт', 't' => 'партнёрским продуктом', 'p' => 'о партнёрском продукте']; // названия во всех падежах
          $names = ['i' => 'Партнёрские продукты', 'r' => 'Партнёрских продуктов', 'd' => 'Партнёрским продуктам', 'v' => 'Партнёрские продукты', 't' => 'Партнёрскими продуктами', 'p' => 'О партнёрских продуктах']; // названия во всех падежах множественное число
          break;
        case('download');
          $type = 3;
          $default_image_path = 'images/downloads/'; // папка с изображениями по умолчанию
          $name = ['i' => 'закачка', 'r' => 'закачки', 'd' => 'закачке', 'v' => 'закачку', 't' => 'закачкой', 'p' => 'о закачке']; // названия во всех падежах
          $names = ['i' => 'Закачки', 'r' => 'Закачек', 'd' => 'Закачкам', 'v' => 'Закачки', 't' => 'Закачками', 'p' => 'О закачках']; // названия во всех падежах множественное число
          break;
        case('goods');
          $type = 4;
          $default_image_path = 'images/goods/'; // папка с изображениями по умолчанию
          $name = ['i' => 'товар', 'r' => 'товара', 'd' => 'товару', 'v' => 'товар', 't' => 'товаром', 'p' => 'о товаре']; // названия во всех падежах
          $names = ['i' => 'Товары', 'r' => 'Товаров', 'd' => 'Товарам', 'v' => 'Товары', 't' => 'Товарами', 'p' => 'О товарах']; // названия во всех падежах множественное число
          break;
        case('gallery');
          $type = 5;
          $default_image_path = 'images/galleries/'; // папка с изображениями по умолчанию
          $names = ['i' => 'галерея', 'r' => 'галереи', 'd' => 'галерее', 'v' => 'галерею', 't' => 'галереей', 'p' => 'о галерее']; // названия во всех падежах
          $namess = ['i' => 'Галереи', 'r' => 'Галерей', 'd' => 'Галереям', 'v' => 'Галереи', 't' => 'Галереями', 'p' => 'О галереях']; // названия во всех падежах множественное число
          break;
        case('album');
          $type = 6;
          $default_image_path = 'images/albums/'; // папка с изображениями по умолчанию
          $name = ['i' => 'альбом', 'r' => 'альбома', 'd' => 'альбому', 'v' => 'альбом', 't' => 'альбомом', 'p' => 'об альбоме']; // названия во всех падежах
          $names = ['i' => 'Альбомы', 'r' => 'Альбомов', 'd' => 'Альбомам', 'v' => 'Альбомов', 't' => 'Альбомами', 'p' => 'Об альбомах']; // названия во всех падежах множественное число
          break;
        case('post');
          $type = 7;
          $default_image_path = 'images/posts/'; // папка с изображениями по умолчанию
          $name = ['i' => 'заметка', 'r' => 'заметки', 'd' => 'заметке', 'v' => 'заметку', 't' => 'заметкой', 'p' => 'о заметке']; // названия во всех падежах
          $names = ['i' => 'Заметки', 'r' => 'Заметок', 'd' => 'Заметкам', 'v' => 'Заметок', 't' => 'Заметками', 'p' => 'О заметках']; // названия во всех падежах множественное число
          break;
      }
    }
    else {
      $default_image_path = 'images/data/'; // папка с изображениями по умолчанию
      $name = ['i' => 'материал', 'r' => 'материала', 'd' => 'материалу', 'v' => 'материал', 't' => 'материалом', 'p' => 'о материале']; // названия материала во всех падежах
      $names = ['i' => 'Материалы', 'r' => 'Материалов', 'd' => 'Материалам', 'v' => 'Материалы', 't' => 'Материалами', 'p' => 'О материалах']; // названия материала во всех падежах множественное число
    }
    $title = $names['i']; // 'Материалы';
    $this->title = 'Удалить '.$name['v'];
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$post_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->post = $this->AdminModel->cp_get_post($post_id);
    //debug($this->post);

    $secret1 = '';
    $secret0 = CHECK;
    $hidden1 = '';
    $hidden0 = CHECK;
    $hide_link1 = '';
    $hide_link0 = CHECK;

    $comments1 = CHECK;
    $comments0 = '';

    $published1 = CHECK;
    $published0 = '';
    //$del1 = '';
    //$del0 = CHECK;
    $selected_category = 1; // выбранная категория по умолчанию
    $selected_partner = 0; // выбранный партнёр по умолчанию, 0 - без партнёра

    if (isset($this->post)) {
      if (isset($this->post['type'])) {
        $type = $this->post['type'];
      }
      else {
        $type = 1; // тип материала по умолчанию
      }
      if ($this->post['secret'] == 1) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if ($this->post['hidden'] == 1) {
        $hidden1 = CHECK;
        $hidden0 = '';
      }
      else {
        $hidden1 = '';
        $hidden0 = CHECK;
      }
      if ($this->post['hide_link'] == 1) {
        $hide_link1 = CHECK;
        $hide_link0 = '';
      }
      else {
        $hide_link1 = '';
        $hide_link0 = CHECK;
      }
      if ($this->post['comments'] == 1) {
        $comments1 = CHECK;
        $comments0 = '';
      }
      else {
        $comments1 = '';
        $comments0 = CHECK;
      }
      if ($this->post['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->post['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    $post_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом']);
    $this->post_types = $this->renderSelect(['options' => $post_types, 'select_name' => 'type', 'select_title' => 'Тип материала', 'select_class' => 'form-select', 'select_id' => 'edit_post_type_field', 'selected_id' => $type, 'disabled_id' => false, 'select_important' => true, 'disabled' => true]);
    //debug($this->post_types);

    //debug($this->categories);
    $this->post_categories = $this->renderSelect(['options' => $this->categories, 'select_name' => 'category', 'select_title' => 'Категория '.$name['r'], 'select_class' => 'form-select', 'select_id' => 'edit_post_category_field', 'selected_id' => $this->post['category'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true]);
    //debug($this->post_categories);

    $without_partner = array(['id' => 0, 'title' => '[Без партнёра]']);
    $partners = $this->AdminModel->cp_get_partners();
    //debug($partners);
    $partners = array_merge($without_partner, $partners); // сливает один или большее количество массивов
    $this->partners = $this->renderSelect(['options' => $partners, 'select_name' => 'partner', 'select_title' => 'Партнёр (если есть)', 'select_class' => 'form-select', 'select_id' => 'edit_post_partner_field', 'selected_id' => $this->post['partner'], 'disabled_id' => false, 'select_important' => false, 'disabled' => true]);
    //debug($this->partners);

    if (isset($_POST['submit_post'])) {
      if ($this->AdminModel->delete_post($post_id)) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      //'alias' => $this->alias,
      //'page' => $this->page,
      'user' => $this->user,
      //'posts' => $posts,
      'pagination' => $this->pagination,
      'post_types' => $this->post_types,
      'post_categories' => $this->post_categories,
      'partners' => $this->partners,
      'post' => $this->post,
      'default_image_path' => $default_image_path,
      'name' => $name,
      'names' => $names,
      //'messages' => $current_user['messages'],
      //'quantity_posts' => $this->quantity_posts,
      //'token' => $this->getToken('update_user'),
      //'message_token' => $this->getToken('send_message'),
      'secret1' => $secret1,
      'secret0' => $secret0,
      'hidden1' => $hidden1,
      'hidden0' => $hidden0,
      'hide_link1' => $hide_link1,
      'hide_link0' => $hide_link0,
      'comments1' => $comments1,
      'comments0' => $comments0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);

  }

  public function sendmailAction(){
    //echo __METHOD__;

  }

  public function subscribersAction(){
    //echo __METHOD__;

  }

  public function ckeditorAction(){
    //echo __METHOD__;

  }


}