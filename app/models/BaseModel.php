<?php
namespace app\models;
use core\Model;
use core\Db;

class BaseModel extends Model {

  public $table = 'post';
  public $pk = 'id'; // primary key

  public function __construct() {
    parent::__construct();
    //echo 'Конструктор BaseModel';
    //$model = new Model; // создание модели и соединение с базой данных
  }

  public function __clone() {

  }





  /* === Получение категорий === */
  public function get_categories($parent = false){
    if($parent) {
      return $this->select(['id','alias','title','parent','position','menu'],'categories', ['parent' => $parent, 'published' => 1, 'del' => 0], ['='],'position','ASC');
      // "SELECT id,alias,title,parent,position FROM categories WHERE parent = '$parent' AND 'published' = '1' AND 'del' = '0' ORDER BY 'position' ASC";
    }
    return $this->select(['id','alias','title','parent','position','menu'],'categories', ['published' => 1, 'del' => 0], ['='],'position','ASC');
    // "SELECT id,alias,title,parent,position FROM categories WHERE 'published' = '1' AND 'del' = '0' ORDER BY 'position' ASC";
  }
  /* === Получение категорий === */

  /* === Получение всех страниц для верхнего и бокового меню === */
  public function get_categories_for_menu(){
    return $this->select(['id','alias','title','parent','position'],'categories', ['menu' => 1, 'published' => 1, 'del' => 0], ['='],'position','ASC');
    // $query = "SELECT id,alias,title,parent,position FROM categories WHERE 'menu' = '1' AND 'published' = '1' AND 'del' = '0' ORDER BY 'position' ASC";
  }

  // не используется
  public function get_pages_for_menu(){
    // "SELECT alias,title FROM categories WHERE id BETWEEN 2 AND 9";
    return $this->select(['alias','title'],'categories', ['id' => '2, 9'], ['BETWEEN']);
  }
  /* === Получение всех страниц для верхнего и бокового меню === */

  /* === Получение названия и алиаса категории (раздела, рубрики) === */
  public function get_title_category($category = 3){
    return $this->select(['alias','title'], 'categories', ['id' => (int)$category], ['='], false, false, 1);
    // "SELECT title FROM categories WHERE id='$category' LIMIT 1"
  }
  /* === Получение названия и алиаса категории (раздела, рубрики) === */



  /* === Получение данных выбранной категории по идентификатору === */
  public function get_category($category = 1){
    //if (!isset($category)) {$category = 1;}
    return $this->select(['id','type','alias','title','parent','description','keywords','image','text','view'],'categories', ['id' => $category, 'published' => 1, 'del' => 0], ['='], false, false, 1);
    // "SELECT id,type,alias,title,parent,description,keywords,image,text,view FROM categories WHERE id='$category' AND 'published' = '1' AND 'del' = '0' LIMIT 1";
  }

  /* === Получение данных выбранной категории по алиасу === */
  public function get_category_by_alias($alias = 'index'){
    return $this->select(['id','type','alias','title','parent','description','keywords','image','text','view'],'categories', ['alias' => $alias, 'published' => 1, 'del' => 0], ['='], false, false, 1);
    // "SELECT id,type,alias,title,parent,description,keywords,image,text,view FROM categories WHERE alias='$alias' AND 'published' = '1' AND 'del' = '0' LIMIT 1"
  }
  /* === Получение данных выбранной категории по алиасу === */

  /* === Получение данных родительской категории по идентификатору === */
  public function get_parent_category($parent_id = 3){
    return $this->select(['id','type','alias','title','parent'],'categories', ['id' => $parent_id, 'published' => 1, 'del' => 0], ['='], false, false, 1);
    // "SELECT id,type,alias,title,parent FROM categories WHERE id='$parent_id' AND 'published' = '1' AND 'del' = '0' LIMIT 1"
  }
  /* === Получение данных родительской категории по идентификатору === */




  /* === Отдельная страница для навигации === */
  public function get_page2($alias = 'index'){
    return $this->select(['title'],'pages', ['alias' => $alias],['='],false,false, 1); // "SELECT title FROM pages WHERE alias='$alias' LIMIT 1"
  }
  /* === Отдельная страница для навигации === */



  // получение домена для сервера закачки
  public function get_download_domen(){
    return $this->select(['value'],'settings', ['setting' => 'download_domen'],['='],false,false, 1); // "SELECT value FROM settings WHERE setting='download_domen' LIMIT 1"
  }

  // получение используемого редактора
  public function get_editor(){
    return $this->select(['value'],'settings', ['setting' => 'editor'],['='],false,false, 1); // "SELECT value FROM settings WHERE setting='editor' LIMIT 1"
  }

  // обновление домена для сервера закачки
  public function update_download_domen($domen) {
    if(!isset($domen)) {
      return false;
    }
    $result = $this->update(
      'settings',
      array('value'),
      array((string)$domen),
      array('setting' => 'download_domen'),
      array('=')
    );
    // "UPDATE settings SET value = '$domen' WHERE setting='download_domen'";
    return $result;
  }



  /* === Рубрики новостей === */
  public function get_rub_news(){
    return $this->select(['id','title'],'headings'); // "SELECT id,title FROM headings";
  }
  /* === Рубрики новостей === */

  /* === Известные партнёры === */
  public function get_partners(){
    return $this->select(['id','alias','title'],'partners', ['published' => 1, 'del' => 0]); // "SELECT id,alias,title FROM partners WHERE published = '1' AND del = '0'";
  }
  /* === Известные партнёры === */

  /* === Категории материалов для скачивания === */
  public function get_cat_downloads(){
    return $this->select(['id','title'],'categories'); // "SELECT id,title FROM categories";
  }
  /* === Категории материалов для скачивания === */

  /* === Получение мудрой фразы === */
  function get_phrase(){
    return $this->select(['id','text','author','image','color','view'],'phrases', ['published' => 1, 'del' => 0], ['='],'RAND', false, 1); // "SELECT id,text,author,image,color,view FROM phrases WHERE published='1' AND del='0' ORDER BY RAND() LIMIT 1";
  }
  /* === Получение мудорой фразы === */

  /* === Получение вертикального баннера === */
  public function get_left_banner(){
    return $this->select(['id','title','image','view'],'banners', ['type' => 2, 'published' => 1], ['='],'RAND', false, 1); // "SELECT id,title,image,view FROM banners WHERE type='2' AND published='1' ORDER BY RAND() LIMIT 1";
  }
  /* === Получение вертикального баннера === */

  /* === Получение горизонтального (любого) баннера === */
  public function get_banner($type = 1) {
    $type = (int)$type;
    if (($type < 1) or ($type > 2)) {type == 1;}
    return $this->select(['id', 'title', 'image', 'view'], 'banners', ['type' => $type, 'published' => 1], ['='], 'RAND', false, 1); // "SELECT id,title,image,view FROM banners WHERE type='1' AND published='1' ORDER BY RAND() LIMIT 1";
  }
  /* === Получение горизонтального (любого) баннера === */


  /* Обновление количества просмотров (начало) */
  // "UPDATE $table SET view='$new_view' WHERE id='$id' LIMIT 1";
  // "UPDATE users SET view='$new_view' WHERE id='$user_id' LIMIT 1";
  // "UPDATE banners SET view='$new_view' WHERE id='$banner_id' LIMIT 1";
  // "UPDATE categories SET view='$new_view' WHERE id='$category_id' LIMIT 1";
  public function update_view($table, $id, $view = 0) {
    if((!isset($table)) or (!isset($id))) {
      return false;
    }
    $result = $this->update(
      $table,
      array('view'),
      array((int)$view+1),
      array('id' => (int)$id),
      array('='),
      1
    );
    return $result;
  }
  /* Обновление количества просмотров (конец) */

  // получение количества заказов
  public function get_payment_id() {
    return $this->select('payment_id','orders'); // "SELECT COUNT(payment_id) FROM orders"
  }

  // добавление заказа в базу
  public function add_order($payment_id,$course_id,$amount,$create_date,$pay_date,$payer_purse,$status,$method,$payer_ip,$payer_wmid,$payment_desc){
    $result = $this->insert(
      'orders',
      array('payment_id','course_id','amount','create_date','pay_date','payer_purse','status','method','payer_ip','payer_wmid','payment_desc'),
      array($payment_id,$course_id,$amount,$create_date,$pay_date,$payer_purse,$status,$method,$payer_ip,$payer_wmid,$payment_desc),
      false
    );
    return $result;
    // "INSERT INTO orders (payment_id,course_id,amount,create_date,pay_date,payer_purse,status,method,payer_ip,payer_wmid,payment_desc) VALUES ('$payment_id','$course_id','$amount','$create_date','$pay_date','$payer_purse','$status','$method','$payer_ip','$payer_wmid','$payment_desc')";
  }

  // получение заказа
  public function get_order($payment_id = 1) {
    return $this->select(
      ['payment_id','course_id','amount','create_date','pay_date','payer_purse','status','method','payer_ip','payer_wmid','payment_desc'],
      'orders',
      ['payment_id' => (int)$payment_id],
      ['='],
      false,
      false,
      1);
    // "SELECT payment_id,course_id,amount,create_date,pay_date,payer_purse,status,method,payer_ip,payer_wmid,payment_desc FROM orders WHERE payment_id='$payment_id' LIMIT 1";
  }

  // обновление статуса заказа
  public function update_order_status($payment_id = null, $status = 0, $pay_date='1970-01-01 00:00:00') {
    if (empty($payment_id)) {return false;}
    $result = $this->update(
      'orders',
      ['status','date'],
      [$status,$pay_date],
      ['payment_id' => (int)$payment_id],
      ['='],
      1
    );
    // "UPDATE orders SET status = '$status',pay_date = '$pay_date', WHERE payment_id='$payment_id' LIMIT 1";
    return $result;
  }


  /* === Получение массива из базы данных === */
  public function db_query($query) {
    $result = mysqli_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $array = array();
    while($row = mysqli_fetch_assoc($result)){
        $array[] = $row;
    }
    return $array;
}
/* === Получение массива из базы данных === */




  /* === Пользователи (начало) === */

  // получение некоторых данных одного пользователя по логину и паролю для авторизации, вывода комментариев и сообщений: возвращает некоторые или все данные одного пользователя или false, если пользователь не найден
  // AND activation='1' - выбираем среди активированных пользователей
  public function get_user_for_authorization($login, $shifr_password, $allfields = false) {
    if ((!isset($login)) or (!isset($shifr_password))) {
      return false;
    }
    $fields = ['id','login','password','avatar']; // получать только id, login, password и avatar
    if ($allfields == true) { // если нужно получать все поля
      $fields = ['id','first_name','last_name','login','password','avatar','photo','email','site','activation','status','method','social_id','reg_date','login_date','birthday','gender','ip','letter_type','view']; // ['id','first_name','login','password','avatar','email','site','reg_date'];
    }
    return $this->select(
      $fields,
      'users',
      ['login' => $login, 'password' => $shifr_password, 'activation' => 1],
      ['='],
      false,
      false,
      1);
    // "SELECT id,login,password FROM users WHERE login='$login' AND password='$shifr_password' AND activation='1' LIMIT 1"; - для авторизации
    // "SELECT id,first_name,last_name,login,password,avatar,photo,email,site,activation,status,method,social_id,reg_date,login_date,birthday,gender,ip,letter_type,view FROM users WHERE login='$login' AND password='$shifr_password' AND activation='1' LIMIT 1";  - для авторизации все поля
    // "SELECT id,first_name,login,password,avatar,email,site,reg_date FROM users WHERE login='$login' AND password='$shifr_password' AND activation='1' LIMIT 1" - для авторизации часть полей
  }

  // получение всех пользователей
  // AND activation='1' AND status>'2' - выбираем среди активированных пользователей со статусом "обычный пользователь" и более
  public function get_users($activation=null,$status=null,$status_operand=null){
    if (!isset($status_operand)) {$status_operand = '>';}
    $where = array(); $operand = array('=');
    if (isset($status)) {
      if (isset($activation)) {
        $where = ['activation' => $activation, 'status' => $status];
        $operand = array('=', $status_operand);
      } else {
        $where = ['status' => $status];
        $operand = array($status_operand);
      }
    }
    else {
      if (isset($activation)) {
        $where = ['activation' => $activation];
        //$operand = ['='];
      }
    }

    return $this->select(
      ['id','first_name','login','avatar','activation','status','method'],
      'users',
      $where,
      $operand,
      'id',
      'ASC'
      );
    // "SELECT id,first_name,login,avatar,activation,status,method FROM users WHERE activation='1' AND status>'2' ORDER BY id";
    // "SELECT id,first_name,login,avatar,activation,status,method FROM users WHERE activation='1' ORDER BY id";
    // "SELECT id,first_name,login,avatar,activation,status,method FROM users WHERE status>'2' ORDER BY id";
    // "SELECT id,first_name,login,avatar,activation,status,method FROM users ORDER BY id";
  }

  /* === Пользователи (конец) === */






/* === Получение данных из списка разделов === */
  public function get_rub($category){
    $query = "SELECT title,description,keywords,text,view FROM headings WHERE id='$category' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $rubs = array();
    $rubs = mysql_fetch_assoc($result); // т.к. рубрика только одна, то просто присваиваем значение массива без цикла
    // echo '<strong>'.$category.'</strong>'; echo $rubs['view'];
    $update_view = update_view('headings', $category, $rubs['view']); // обновление количества просмотров
    return $rubs;
}
/* === Получение данных из списка разделов === */

/* === Получение данных из списка партнёров === */
  public function get_partner($partner){
    return $this->select(['id','alias','title','description','keywords','image','text','view'],'partners', ['id' => $partner, 'published' => 1, 'del' => 0],['='],false,false, 1); // "SELECT id,alias,title,description,keywords,image,text,view FROM partners WHERE id='$partner' AND published='1' AND del='0' LIMIT 1";
    /*
    if ($partners['view']) {
        $update_view = update_view('partners', $category, $partners['view']); // обновление количества просмотров
    }
    return $partners; */
}
/* === Получение данных из списка партнёров === */

  /* === Получение названия и алиаса партнёра === */
  public function get_title_partner($partner=0){
    return $this->select(['alias','title'],'partners', ['id' => (int)$partner, 'published' => 1, 'del' => 0],['='],false,false, 1); // "SELECT alias,title FROM partners WHERE id='$partner' AND published='1' AND del='0' LIMIT 1";
    return $partners;
  }
  /* === Получение названия и алиаса партнёра === */





  // получение комментариев к заметкам
  public function get_comments($id = 1, $type = 0) {
    return $this->select(['author', 'site', 'date', 'text'], 'comments', ['post' => $id, 'type' => $type, 'published' => 1, 'del' => 0], ['='], 'date', 'ASC');
    // "SELECT author,site,date,text FROM comments WHERE post='$id' AND type='$type' AND published='1' AND del='0' ORDER BY 'date' ASC";
  }

  // получение имен авторов и изображений авторов комментариев
  public function get_comment_autor($comment_author) {
    return $this->select(['first_name', 'avatar'], 'users', ['login' => $comment_author, 'activation' => 1], ['='], false, false, 1);
    // "SELECT first_name,avatar FROM users WHERE login='$comment_autor' AND activation='1' LIMIT 1";
  }

  // получение заголовка и типа заметки по идентификатору
  public function get_post_title_for_comment($post_id){
    if(empty($post_id)) {return false;}
    return $this->select(['alias','title','type'], 'data', ['id' => $post_id], ['='], false, false, 1);
    // "SELECT alias,title,type FROM data WHERE id='$post_id' LIMIT 1";
  }

  // получение заголовка и алиаса галереи по идентификатору
  public function get_gallery_title_for_comment($gallery_id){
    if(empty($gallery_id)) {return false;}
    return $this->select(['title', 'name'], 'galleries', ['id' => $gallery_id], ['='], false, false, 1);
    // "SELECT title,name FROM galleries WHERE id='$post_id' LIMIT 1";
  }


  // получение комментариев к заметкам
  public function get_comments2($id) {
    return $this->select(['author', 'site', 'date','text'], 'comments2', ['post' => $id, 'published' => 1], ['='],'date', 'ASC');
    // "SELECT author,site,date,text FROM comments2 WHERE post='$id' AND published='1' ORDER BY 'date' ASC";
  }


/* === Картинка для защиты автоотправки комментариев === */
  public function get_comments_settings($randomimage) {
    return $this->select(['image'], 'comments_settings', ['id' => (int)$randomimage], ['='], false, false, 1);
    // "SELECT image FROM comments_settings WHERE id='$randomimage' LIMIT 1" Запрос на выборку картинок для комментариев
  }
/* === Картинка для защиты автоотправки комментариев === */


  /* === Подсчёт элементов в базе данных === */
  // подсчёт элементов в таблице
  public function count_elements($table='pages',$field='id') {
    $result = $this->select(
      $field, // поле, по которому считаем данные
      $table // таблица, в которой считаем данные
    );
    return $result;
  }
  /* === Подсчёт элементов в базе данных === */

  /* === Подсчёт общего количества новостей === */
  public function count_total_news(){
    return $this->select('id', 'data', ['type' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='1' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества новостей === */

  /* === Подсчёт общего количества партнёрских продуктов === */
  public function count_total_partner_products(){
    return $this->select('id', 'data', ['type' => 2, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='2' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества партнёрских продуктов === */

  /* === Подсчёт общего количества закачек === */
  public function count_total_downloads(){
    return $this->select('id', 'data', ['type' => 3, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='3' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества закачек === */

  /* === Подсчёт общего количества секретных материалов === */
  public function count_total_secret(){
    return $this->select('id', 'data', ['secret' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE secret='1' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества секретных материалов === */

  /* === Подсчёт общего количества обучающих курсов === */
  public function count_total_courses(){
    return $this->select('id', 'courses', ['published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM courses WHERE published='1' AND del='0'"
  }
  /* === Подсчёт общего количества обучающих курсов === */

  /* === Подсчёт общего количества товаров === */
  public function count_total_goods(){
    return $this->select('id', 'data', ['type' => 4, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='4' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества товаров === */

  /* === Подсчёт общего количества галерей === */
  public function count_total_galleries(){
    return $this->select('id', 'data', ['type' => 5, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='5' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества галерей === */

  /* === Подсчёт общего количества альбомов === */
  public function count_total_albums(){
    return $this->select('id', 'data', ['type' => 6, 'hidden' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='6' AND hidden='0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества альбомов === */

  /* === Подсчёт общего количества категорий === */
  public function count_total_categories(){
    return $this->select('id', 'categories', ['type' => 0, 'published' => 1, 'del' => 0],['>','=']);
    // "SELECT COUNT(id) FROM categories WHERE type>'0' AND published='1' AND del='0'"
  }
  /* === Подсчёт общего количества категорий === */

  /* === Подсчёт общего количества партнёров === */
  public function count_total_partners(){
    return $this->select('id', 'partners', ['published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM partners WHERE published='1' AND del='0'"
  }
  /* === Подсчёт общего количества партнёров === */

  /* === Подсчёт общего количества заметок === */
  public function count_total_posts(){
    return $this->select('id', 'posts', ['hidden' => 0, 'published' => 1]);
    // "SELECT COUNT(id) FROM post WHERE hidden='0' AND published='1'"
  }
  /* === Подсчёт общего количества заметок === */

  /* === Подсчёт общего количества комментариев === */
  public function count_total_comments($type=null){
    if (isset($type)) {
      $where = ['type' => (int)$type, 'published' => 1, 'del' => 0];
      $operand = ['='];
    }
    else {
      $where = ['type' => 7, 'published' => 1, 'del' => 0];
      $operand = ['<','='];
    }
    return $this->select('id', 'comments', $where, $operand);
    // "SELECT COUNT(id) FROM comments WHERE type<'7' AND published='1' AND del='0'";
    // "SELECT COUNT(id) FROM comments WHERE type='$type' AND published='1' AND del='0'";
  }
  /* === Подсчёт общего количества комментариев === */

  /* === Подсчёт общего количества комментариев 2 === */
  public function count_total_comments2(){
    return $this->select('id', 'comments2', ['published' => 1]);
    // "SELECT COUNT(id) FROM comments2 WHERE published='1'"
  }
  /* === Подсчёт общего количества комментариев 2 === */

  /* === Подсчёт общего количества умных фраз === */
  public function count_total_phrases(){
    return $this->select('id', 'phrases', ['published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM phrases WHERE published='1' AND del='0'"
  }
  /* === Подсчёт общего количества умных фраз === */

  /* === Подсчёт общего количества страниц === */
  public function count_total_pages(){
    return $this->select('id', 'categories', ['type' => 0, 'published' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM categories WHERE type='0' AND published='1' AND del='0'"
  }
/* === Подсчёт общего количества страниц === */

  /* === Подсчёт количества зарегистрированных пользователей === */
  public function count_registrated_users(){
    return $this->select('id', 'users', ['activation' => 1, 'status' => 2],['=','>']);
    // "SELECT COUNT(id) FROM users WHERE activation='1' AND status>'2'"
  }
  /* === Подсчёт количества зарегистрированных пользователей === */

  /* === Подсчёт количества подписчиков === */
  public function count_subscribers(){
    return $this->select('id', 'users', ['activation' => 1, 'status' => 2]);
    // "SELECT COUNT(id) FROM users WHERE activation='1' AND status='2'"
  }
  /* === Подсчёт количества подписчиков === */


  /* === Подсчёт комментариев === */
  public function count_comments($post, $type = 0){
    return $this->select('id', 'comments', ['post' => $post, 'type' => (int)$type, 'published' => 1, 'del' => 0]); // "SELECT COUNT(id) FROM comments WHERE post='$post' AND type='$type' AND published='1' AND del='0'"
  }
  /* === Подсчёт комментариев === */

  /* === Подсчёт комментариев 2 === */
  public function count_comments2($post){
    return $this->select('id', 'comments2', ['post' => $post, 'published' => 1]); // "SELECT COUNT(id) FROM comments2 WHERE post='$post' AND published='1'"
  }
  /* === Подсчёт комментариев 2 === */

/* === Подсчёт количества заметок (закачек, партнёрских продуктов) для навигации === */
  public function count_post($type=null,$category=null,$secret=null){
    $query_parametrs = '';
    if (isset($type)) {$query_parametrs = 'type=\''.$type.'\' AND ';}
    if (isset($category)) {$query_parametrs = $query_parametrs.'category=\''.$category.'\' AND ';}
    if (isset($secret)) {$query_parametrs = $query_parametrs.'secret=\''.$secret.'\' AND ';}
    $query = "SELECT COUNT(id) FROM data WHERE ".$query_parametrs."hidden='0' AND published='1'";
    // echo $query."<br>";
    $count_post = count_elements($query);
    return $count_post;
}
/* === Подсчёт количества заметок (закачек, партнёрских продуктов) для навигации === */

  // метод для подсчета общего количества всех записей (постов) для постраничной навигации
  public function get_total_posts($tablename='data',$type=null,$category=null,$secret=null,$partner=null) {
    if (!isset($tablename)) {$tablename = 'data';}
    $where = array();
    if (isset($type)) {$where['type'] = (int)$type;}
    if (isset($category)) {$where['category'] = (int)$category;}
    if (isset($secret)) {$where['secret'] = (int)$secret;}
    if ($tablename=='data') {
      if (isset($partner)) {$where['partner'] = (int)$partner;}
      $where['hidden'] = 0;
    }
    $where['published'] = 1;
    $where['del'] = 0;
    return $this->select('id', $tablename, $where);
    // "SELECT COUNT(id) FROM data WHERE type='0' AND category='1' AND secret='0' AND partner='$partner' AND hidden='0' AND published='1' AND del='0'"
    // "SELECT COUNT(id) FROM data WHERE type='0' AND category='1' AND secret='0' AND hidden='0' AND published='1' AND del='0'"
    // "SELECT COUNT(id) FROM courses WHERE category='1' AND published='1' AND del='0'"
  }

  // метод для подсчёта общего количества всех заметок (постов) для постраничной навигации !!! Таблица posts !!!
  public function get_total_posts2($category=null){
    $where = [];
    $operand = ['='];
    if (isset($category)) {
      $where['category'] = (string)$category;
      $operand = ['IN','='];
    }
    $where['hidden'] = 0;
    $where['published'] = 1;
    $where['del'] = 0;
    return $this->select('id', 'posts', $where, $operand);
    // "SELECT COUNT(id) FROM posts WHERE category IN (".$category.") AND hidden='0' AND published='1' AND del='0'";
    // "SELECT COUNT(id) FROM posts WHERE hidden='0' AND published='1' AND del='0'";
  }
  /* === Подсчёт количества заметок для навигации === */

/* === Подсчёт количества товаров для навигации === */
  public function count_goods($query_parametrs=null){
    $query = "SELECT COUNT(id) FROM data WHERE ".$query_parametrs."hidden='0' AND published='1'";
    // echo $query."<br>";
    $count_goods = $this->count_elements('data','id');
    return $count_goods;
}
/* === Подсчёт количества товаров для навигации === */



/* === Подсчёт общего количества рубрик === */
  public function count_total_rub(){
    $query = "SELECT COUNT(id) FROM headings";
    $total_rub = count_elements($query);
    return $total_rub;
}
/* === Подсчёт общего количества рубрик === */

/* === Подсчёт общего количества партнёров === */
  public function count_total_partner(){
    $query = "SELECT COUNT(id) FROM partners WHERE published='1'";
    $total_partner = count_elements($query);
    return $total_partner;
}
/* === Подсчёт общего количества партнёров === */

/* === Подсчёт общего количества категорий === */
  public function count_total_cat(){
    $query = "SELECT COUNT(id) FROM categories";
    $total_cat = count_elements($query);
    return $total_cat;
}
/* === Подсчёт общего количества категорий === */

/* === Получение названий статей (партнёрских продуктов, закачек) из выбранного раздела === */
  public function get_title_post($type = null, $category = null, $partner = null){
    if(isset($type)) {
      if(isset($category)) {
        if(isset($partner)) {
          return $this->select(['id','alias','title'], 'data', ['type' => $type, 'category' => $category, 'partner' => $partner, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='], 'RAND', false, 10);
          // "SELECT id,alias,title FROM data WHERE type='".$type."' AND category='".$category."' AND partner='".$partner."' AND hidden='0' AND published='1' AND del='0' ORDER BY RAND() LIMIT 10";
        }
        return $this->select(['id','alias','title'], 'data', ['type' => $type, 'category' => $category, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='], 'RAND', false, 10);
        // "SELECT id,alias,title FROM data WHERE type='".$type."' AND category='".$category."' AND hidden='0' AND published='1' AND del='0' ORDER BY RAND() LIMIT 10";
      }
      return $this->select(['id','alias','title'], 'data', ['type' => $type, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='], 'RAND', false, 10);
      // "SELECT id,alias,title FROM data WHERE type='".$type."' AND hidden='0' AND published='1' AND del='0' ORDER BY 'id' ASC LIMIT 10";
    }
    return $this->select(['id','type','category','partner','alias','title'], 'data', ['hidden' => 0, 'published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
    // "SELECT id,type,category,partner,alias,title FROM data WHERE hidden='0' AND published='1' AND del='0' ORDER BY 'id' ASC";
}
/* === Получение названий статей (партнёрских продуктов, закачек) из выбранного раздела === */

  /* === Получение названий курсов === */
  public function get_title_course($category = null, $author = null){
    if (isset($category)) {
      if (isset($author)) {
        return $this->select(['id','category','alias','title','author'], 'courses', ['category' => $category, 'author' => $author, 'published' => 1, 'del' => 0], ['='], 'RAND', false, 10);
        // "SELECT id,category,alias,title,author FROM courses WHERE category='".$category."' AND author='".$author."' AND published='1' AND del='0' ORDER BY RAND() LIMIT 10";
      }
      return $this->select(['id','category','alias','title','author'], 'courses', ['category' => $category, 'published' => 1, 'del' => 0], ['='], 'RAND', false, 10);
      // "SELECT id,category,alias,title,author FROM courses WHERE category='".$category."' AND published='1' AND del='0' ORDER BY RAND() LIMIT 10";
    }
    return $this->select(['id','category','alias','title','author'], 'courses', ['published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
    // "SELECT id,category,alias,title,author FROM courses WHERE published='1' AND del='0' ORDER BY 'id' ASC";
  }
  /* === Получение названий курсов === */



  /* === Получение названий статей (партнёрских продуктов, закачек) из выбранного раздела === */
  // аналог функции get_similar_posts()
  public function get_other_title_post($post_id = 1, $type = 0, $category = 1){ // не применяется
    //if(!isset($post_id)) {$post_id = 1;}
    //if(!isset($type)) {$type = 0;}
    //if(!isset($category)) {$category = 1;}
    return $this->select(['id','alias','title'], 'data', ['id' => $post_id, 'type' => $type, 'category' => $category, 'hidden' => 0, 'published' => 1, 'del' => 0], ['!=','='], 'id', 'DESC', 5);
    // "SELECT id,alias,title FROM data WHERE id != ".$post_id." type='".$type."' AND category='".$category."' AND hidden='0' AND published='1' AND del='1' LIMIT 10";
  }
  /* === Получение названий статей (партнёрских продуктов, закачек) из выбранного раздела === */

// названия таблиц для запросов
  public function get_table_name($type){
    switch($type){
        case(0):
        $table_name = 'headings';
        break;
        case(1):
        $table_name = 'partners';
        break;
        case(2):
        $table_name = 'categories';
        break;
        case(3):
        // $table_name = 'goods';
        break;
        case(4):
        // $table_name = 'galleries';
        break;
        case(5):
        // $table_name = 'albums';
        break;
        // default:
        // $table_name = 'headings';
    }
    return $table_name;
}
// названия таблиц для запросов

/* === Параметры запроса === */
  public function query_parametrs($type=null,$category=null,$secret=null,$order=null,$limit=null) {
    $query_parametrs = "";
    if (isset($type)) {$query_parametrs = " WHERE type='".$type."'";} // else {$query_paramets = "";}

    if (isset($category)) {
        if (empty($query_parametrs)) {
            $query_parametrs = " WHERE category='".$category."'";
        }
        else {
            $query_parametrs = $query_parametrs." AND category='".$category."'";
        }
    }

    if (isset($secret)) {
        if (empty($query_parametrs)) {
            $query_parametrs = " WHERE secret='".$secret."'";
        }
        else {
            $query_parametrs = $query_parametrs." AND secret='".$secret."'";
        }
    }

    if (empty($query_parametrs)) {
        $query_parametrs = " WHERE hidden='0' AND published='1'";
    }
    else {
        $query_parametrs = $query_parametrs." AND hidden='0' AND published='1'";
    }

    if (isset($order)) {$query_parametrs = $query_parametrs." ORDER BY ".$order;}
    if (isset($limit)) {$query_parametrs = $query_parametrs." LIMIT ".$limit;}
    // echo $query_parametrs;
    return $query_parametrs;
}
/* === Параметры запроса === */

/* === Параметры запроса 2 === */
  public function query_parametrs2($category=null,$order=null,$limit=null) {
    $query_parametrs = "";
    if (isset($category)) {$query_parametrs = " WHERE category IN (".$category.")";} // else {$query_paramets = "";}
    if (empty($query_parametrs)) {
        $query_parametrs = " WHERE hidden='0' AND published='1'";
    }
    else {
        $query_parametrs = $query_parametrs." AND hidden='0' AND published='1'";
    }
    if (isset($order)) {$query_parametrs = $query_parametrs." ORDER BY ".$order;}
    if (isset($limit)) {$query_parametrs = $query_parametrs." LIMIT ".$limit;}
    // echo $query_parametrs;
    return $query_parametrs;
}
/* === Параметры запроса 2 === */

/* === Получение данных === */
  public function get_data($type=null,$category=null,$secret=null,$partner=null,$order=false,$napr=false,$limit=false){
    $where = [];
    if (isset($type)) {
      $where['type'] = (int)$type;
    }
    if (isset($category)) {
      $where['category'] = (int)$category;
    }
    if (isset($partner)) {
      $where['partner'] = (int)$partner;
    }
    if (isset($secret)) {
      $where['secret'] = (int)$secret;
    }
    $where['hidden'] = 0;
    $where['published'] = 1;
    $where['del'] = 0;
    if (!isset($order)) {
      $napr = false;
    }
    return $this->select(
      ['id','type','category','partner','secret','alias','title','author','date','view','rating','quantity_vote','image','gallery_id','album_id','buy_link','orders','price','introduction'],
      'data',
      $where,
      ['='],
      $order,
      $napr,
      $limit);
    // false, false, [], true
    // "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,gallery_id,album_id,buy_link,orders,price,introduction FROM data WHERE type = '0' AND hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC LIMIT 5"
    // "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,gallery_id,album_id,buy_link,orders,price,introduction FROM data WHERE type = '0' AND partner = '$partner' AND secret = '0' AND hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC LIMIT 5"
  }

  // получение данных - ID и названия
  public function get_aliases_title($table='data'){
    return $this->select(
      ['id','alias','title'],
      $table,
      array(),
      ['='],
      false,
      false,
      false);
    // "SELECT id,alias,title FROM data"
  }

  // обновление алиасов
  public function update_data_aliases($id, $alias='',$table='data') {
    if (!isset($id)) {
      return false;
    }
    $result = $this->update(
      $table,
      array('alias'),
      array((string)$alias),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE data SET alias = '$alias' WHERE id='$id' LIMIT 1";
    return $result;
  }


  public function get_data_old($query_parametrs=null){
    $query = "SELECT id,type,category,secret,title,author,date,view,rating,quantity_vote,image,gallery_id,album_id,buy_link,orders,price,introduction FROM data".$query_parametrs;
    // echo $query;
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $post = array();
    while($row = mysql_fetch_assoc($result)){
        $row["secret"] = secret_check($row["secret"]);
        $row["comments"] = count_comments($row["id"]);
        // Получение названий рубрик, разделов, имён партнёров
        if ($row["type"] <= 2) {
            $row["title_category"] = get_title_category($row["type"],$row["category"]);
        }
        /* Получение имени миниатюры */
        if (($row["image"] == 'images/')
         or ($row["image"] == 'images/data/')
         or ($row["image"] == 'images/partner_products/')
         or ($row["image"] == 'images/downloads/')
         or ($row["image"] == 'images/goods/')
         or ($row["image"] == 'images/galleries/')
         or ($row["image"] == 'images/albums/')) {unset($row["image"]);}
        if (isset($row["image"])) {
            $row["thumbspostimage"] = thumbsfilename($row["image"]);
        }
        /* Преобразование даты в удобный для восприятия вид */
        $row["date"] = rusdate('j %MONTH% Y, G:i:s',strdatetosec($row["date"]));
        /* Подсчет рейтинга */
        $row["rating"] = intval($row["rating"]/$row["quantity_vote"]);
        // Если к материалу прикреплена галерея или альбом, но они пустые, тогда уничтожаем переменные
        if (empty($row["gallery_id"])) {
            unset($row["gallery_id"]);
        }
        if (empty($row["album_id"])) {
            unset($row["album_id"]);
        }
        /* Проверка ссылки для заказа и цены */
        if (empty($row["buy_link"])) {
            unset($row["buy_link"],$row["orders"]);
        }
        if ((int)$row["price"] == 0) {
            unset($row["price"]);
        }
        $post[] = $row;
    }
    return $post;
}
/* === Получение данных === */

/* === Получение архива новостей === */
  public function get_date_archive($date_begin,$date_end){
    if ((!isset($date_begin)) or (!isset($date_end))) {
      return false;
    }
    $query = "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,gallery_id,album_id,buy_link,orders,price,introduction FROM data WHERE date > '$date_begin' AND date < '$date_end' AND hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC"; // получаем посты из нужного временного интервала
    return $this->sql($query);
    /* не работает, так как в элемент WHERE передается массив и в нем только один элемент date
    return $this->select(
      ['id','type','category','secret','alias','title','author','date','view','rating','quantity_vote','image','gallery_id','album_id','buy_link','orders','price','introduction'],
      'data',
      ['date' => $date_begin, 'date' => $date_end, 'hidden' => 0, 'published' => 1, 'del' => 0],
      ['>','<','='],
      ['date','id'],
      ['DESC','DESC'],
      false); */
    // "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,gallery_id,album_id,buy_link,orders,price,introduction FROM data WHERE date > '$date_begin' AND date < '$date_end' AND hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC"
  }
/* === Получение архива новостей === */

/* === Получение новости (партнёрского продукта, закачки, музыки, галереи) === */
  public function get_post($id) {
    if(!isset($id)) return false;
    return $this->select(
      ['id','type','category','partner','secret','comments','alias','title','description','keywords','author','date','view','rating','quantity_vote','image','size','screenshots','gallery_id','album_id','album_id','partner_link','transitions','download_link','downloaded','internet_link','internet_downloaded','buy_link','orders','price','hide_link','hash','text'],
      'data',
      ['id' => (int)$id, 'published' => 1, 'del' => 0],
      ['='],
      false,
      false,
      1);
    // "SELECT id,type,category,partner,secret,comments,alias,title,description,keywords,author,date,view,rating,quantity_vote,image,size,screenshots,gallery_id,album_id,partner_link,transitions,download_link,downloaded,internet_link,internet_downloaded,buy_link,orders,price,hide_link,hash,text FROM data WHERE id='$id' AND published='1' AND del='1' LIMIT 1";
}
/* === Получение новости (партнёрского продукта, закачки, музыки, галереи) === */
  /* === Получение новости (партнёрского продукта, закачки, музыки, галереи) по алиасу === */
  public function get_post_by_alias($alias) {
    if(!isset($alias)) return false;
    return $this->select(
      ['id','type','category','partner','secret','comments','alias','title','description','keywords','author','date','view','rating','quantity_vote','image','size','screenshots','gallery_id','album_id','album_id','partner_link','transitions','download_link','downloaded','internet_link','internet_downloaded','buy_link','orders','price','hide_link','hash','text'],
      'data',
      ['alias' => (string)$alias, 'published' => 1, 'del' => 0],
      ['='],
      false,
      false,
      1);
    // "SELECT id,type,category,partner,secret,comments,alias,title,description,keywords,author,date,view,rating,quantity_vote,image,size,screenshots,gallery_id,album_id,partner_link,transitions,download_link,downloaded,internet_link,internet_downloaded,buy_link,orders,price,hide_link,hash,text FROM data WHERE alias='$alias' AND published='1' AND del='1' LIMIT 1";
  }
  /* === Получение новости (партнёрского продукта, закачки, музыки, галереи) по алиасу === */

  /* === Получение курсов === */
  function get_courses($category=null,$order=false,$napr=false,$limit=false){
      $where = [];
      if (isset($category)) {
        $where['category'] = (int)$category;
      }
      $where['published'] = 1;
      $where['del'] = 0;
      if (!isset($order)) {
        $napr = false;
      }
      return $this->select(
        ['id','category','title','alias','author','image','text','view','size','year','price','author_price','buy_link','orders','download_link','downloaded','partner_link','transitions','hash','hide_plink'],
        'courses',
        $where,
        ['='],
        $order,
        $napr,
        $limit);
    // "SELECT id,category,title,alias,author,image,text,view,size,year,price,author_price,buy_link,orders,download_link,downloaded,partner_link,transitions,hash,hide_plink FROM courses WHERE category='$category' AND published='1' AND del='1' ORDER by id ASC LIMIT 0,7";
  }
  /* === Получение курсов === */

  /* === Получение одного курса === */
  function get_course($id){
    if(!isset($id)) return false;
    return $this->select(
      ['id','category','title','alias','author','image','text','view','size','year','price','author_price','buy_link','orders','download_link','downloaded','partner_link','transitions','hash','hide_plink'],
      'courses',
      ['id' => (int)$id, 'published' => 1, 'del' => 0],
      ['='],
      false,
      false,
      1);
    // "SELECT id,category,title,alias,author,image,text,view,size,year,price,author_price,buy_link,orders,download_link,downloaded,partner_link,transitions,hash,hide_plink FROM courses WHERE id='$id' AND published='1' AND del='1' LIMIT 1";
  }
  /* === Получение одного курса === */


/* === Получение заметок === */
  public function get_posts($category=null,$order=false,$napr=false,$limit=false){
      $where = [];
      $operand = ['='];
      if (isset($category)) {
        $where['category'] = (string)$category;
        $operand = ['IN','='];
      }
      $where['hidden'] = 0;
      $where['published'] = 1;
      $where['del'] = 0;
      if (!isset($order)) {
        $napr = false;
      }
      return $this->select(
        ['id','category','hidden','comments','title','author','date','image','text','view'],
        'posts',
        $where,
        $operand,
        $order,
        $napr,
        $limit);
      // false, false, [], true
      // "SELECT id,category,hidden,comments,title,author,date,image,text,view FROM posts WHERE category IN (".$category.") AND hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC LIMIT 5"
      // "SELECT id,category,hidden,comments,title,author,date,image,text,view FROM posts WHERE hidden = '0' AND published = '1' AND del='0' ORDER BY date DESC, id DESC LIMIT 5"
}
/* === Получение заметок === */

/* Получение заголовков заметок для карты сайта */
  public function get_post_title($type,$category=null) {
    $query_category = "";
    if (isset($category)) {
        $query_category = " AND category = '$category'";
    }
    $query = "SELECT id,title FROM data WHERE type='$type'".$query_category." AND hidden='0' AND published='1'";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $post_title = '';
    global $sitemap_url;
    if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_assoc($result)){
            switch($type){
                case(0):
                $post_title = $post_title."<li><a href='view_news.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_news.php?id=".$row['id'];
                break;
                case(1):
                $post_title = $post_title."<li><a href='view_partner_product.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_partner_product.php?id=".$row['id'];
                break;
                case(2):
                $post_title = $post_title."<li><a href='view_download.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_download.php?id=".$row['id'];
                break;
                case(3):
                $post_title = $post_title."<li><a href='view_product.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_product.php?id=".$row['id'];
                break;
                case(4):
                $post_title = $post_title."<li><a href='view_gallery.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_gallery.php?id=".$row['id'];
                break;
                case(5):
                $post_title = $post_title."<li><a href='view_albums.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                $sitemap_url[] = DOMEN."view_albums.php?id=".$row['id'];
                break;
                // default:
                // $post_title = $post_title."<li><a href='view_news.php?id=$row[id]' target='_self'>$row[title]</a></li>";
                // $sitemap_url[] = DOMEN."view_news.php?id=".$row['id'];
            }
        }
    }
    return $post_title;
}
/* Получение заголовков заметок для карты сайта */





/* === Последние новости === */
  public function get_last_news(){
    return $this->select(['id','alias','title'], 'data', ['type' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],['date','id'],['DESC','DESC'],5);
    // "SELECT id,alias,title FROM data WHERE type='0' AND hidden='0' AND published='1' AND del='1' ORDER BY date DESC,id DESC LIMIT 5"
}
/* === Последние новости === */

  /* === Случайные новости === */
  public function get_random_news(){
    return $this->select(['id','alias','title'], 'data', ['type' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],'RAND','',5);
    // "SELECT id,alias,title FROM data WHERE type='0' AND hidden='0' AND published='1' AND del='1' ORDER BY RAND() LIMIT 5"
  }
  /* === Случайные новости === */

  /* === Популярные новости === */
  public function get_popular_news(){
    return $this->select(['id','alias','title'], 'data', ['type' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],['view','id'],['DESC','DESC'],5);
    // "SELECT id,alias,title FROM data WHERE type='0' AND hidden='0' AND published='1' AND del='1' ORDER BY view DESC,id DESC LIMIT 5"
  }
  /* === Популярные новости === */

  /* === Популярные партнёрские продукты === */
  public function get_popular_partner_products(){
    return $this->select(['id','alias','title'], 'data', ['type' => 2, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],['view','id'],['DESC','DESC'],5);
    // "SELECT id,alias,title FROM data WHERE type='1' AND hidden='0' AND published='1' AND del='1' ORDER BY view DESC,id DESC LIMIT 5";
  }
  /* === Популярные партнёрские продукты === */

  /* === Случайные материалы для скачивания === */
  public function get_random_downloads(){
    return $this->select(['id','alias','title'], 'data', ['type' => 3, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],'RAND','DESC',5);
    // "SELECT id,alias,title FROM data WHERE type='2' AND hidden='0' AND published='1' AND del='1' ORDER BY RAND() DESC LIMIT 5";
  }
  /* === Случайные материалы для скачивания === */

/* === Популярные товары === */
  public function get_popular_goods(){
    $query = "SELECT id,alias,title FROM data WHERE type='3' AND hidden='0' AND published='1' ORDER BY view DESC,id DESC LIMIT 5";
    $popular_goods = db_query($query);
    return $popular_goods;
}
/* === Популярные товары === */

/* === Последние галереи === */
  public function get_last_galleries(){
    $query = "SELECT id,alias,title FROM data WHERE type='4' AND hidden='0' AND published='1' ORDER BY date DESC,id DESC LIMIT 5";
    $title_galleries = db_query($query);
    return $title_galleries;
}
/* === Последние галереи === */

  /* === Архив новостей на правой панели === */
  public function get_news_archive($year=''){
    if (!empty($year)) {
      $query = "SELECT DISTINCT left(date,7) AS month FROM data WHERE left(date,4)='$year' AND hidden='0' AND published='1' ORDER BY month DESC";
    }
    else {
      $query = "SELECT DISTINCT left(date,7) AS month FROM data WHERE hidden='0' AND published='1' ORDER BY month DESC";
    }
    return $this->sql($query);
  }
  /* === Архив новостей на правой панели === */

/* === Другие посты (новости, закачки) в выбраном разделе === */
  public function get_similar_posts($id,$type,$category){
    return $this->select(['id','alias','title'],'data',['id' => $id, 'type' => $type, 'category' => $category, 'hidden'=> 0, 'published'=> 1, 'del' => 0],['!=','='],'id', 'DESC', 5);
    //$query = "SELECT id,alias,title FROM data WHERE id!='$id' AND type=$type AND category=$category AND hidden='0' AND published='1' AND del='1' ORDER BY id DESC LIMIT 5";
}
/* === Другие посты (новости, закачки) в выбраном разделе === */

/* === Другие продукты выбранного партнера === */
  public function get_similar_partner_products($id,$category){
    $query = "SELECT id,alias,title FROM data WHERE type='1' AND category='$category' AND hidden='0' AND published='1' AND id!='$id' ORDER BY id DESC LIMIT 5";
    $title_partner_products = db_query($query);
    return $title_partner_products;
}
/* === Другие продукты выбранного партнера === */

/* === Другие закачки в выбранной категории === */
  public function get_similar_downloads($id,$category){
    $query = "SELECT id,alias,title FROM data WHERE type='2' AND hidden='0' AND category='$category' AND published='1' AND id!='$id' ORDER BY id DESC LIMIT 5";
    $title_downloads = db_query($query);
    return $title_downloads;
}
/* === Другие закачки в выбранной категории === */

/* === Другие товары === */
  public function get_similar_goods($id){
    $query = "SELECT id,alias,title FROM data WHERE type='3' AND hidden='0' AND published='1' AND id!='$id' ORDER BY id DESC LIMIT 5";
    $title_goods = db_query($query);
    return $title_goods;
}
/* === Другие товары === */

/* === Другие товары === */
  public function get_similar_galleries($id){
    $query = "SELECT id,alias,title FROM data WHERE type='4' AND hidden='0' AND published='1' AND id!='$id' ORDER BY id DESC LIMIT 5";
    $title_galleries = db_query($query);
    return $title_galleries;
}
/* === Другие товары === */

  // Реферальные ссылки
  public function get_ref_links(){
    return $this->select(['id','title'], 'links', ['ref' => 1], ['='],'RAND','', 10);
    // "SELECT id,title FROM links WHERE ref='1' ORDER BY RAND() LIMIT 10"
  }

  // Партнёрские ссылки
  public function get_partner_links(){
    return $this->select(['id','title'], 'data', ['type' => 1, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],'RAND','', 5);
    // "SELECT id,alias,title FROM data WHERE type='1' AND hidden='0' AND published='1' AND del='1' ORDER BY RAND() LIMIT 5"
  }

  // Ссылки на закачку с ftp-сервера
  public function get_download_links(){
    return $this->select(['id','title','hash'], 'data', ['type' => 2, 'secret' => 0, 'hide_link' => 0, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],'RAND','', 5);
    // "SELECT id,title,hash FROM data WHERE type='2' AND secret='0' AND hide_link='0' AND hidden='0' AND published='1' AND del='1' ORDER BY RAND() LIMIT 5"
  }

  // Ссылки на закачку с интернета
  public function get_internet_links(){
    return $this->select(['id','title','hash'], 'data', ['type' => 2, 'secret' => 0, 'hide_link' => 0, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='],'RAND','', 5);
    // "SELECT id,title,hash FROM data WHERE type='2' AND secret='0' AND hide_link='0' AND hidden='0' AND published='1' AND del='1' ORDER BY RAND() LIMIT 5"
  }


 // Получение всех ссылок
  public function get_all_links() {
    return $this->select(['id', 'ref', 'title', 'link', 'transitions'], 'links', ['published' => 1], ['='], ['id'], ['ASC'], false);
    // "SELECT id,ref,title,link,transitions FROM links WHERE published='1' ORDER BY id ASC";
  }

  // Получение всех партнёрских ссылок
  public function get_all_partner_links() {
    return $this->select(['id', 'title', 'partner_link', 'transitions'], 'data', ['hidden' => 0, 'published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
    // "SELECT id,title,partner_link,transitions FROM data WHERE hidden='0' AND published='1' AND del='0' ORDER BY id ASC";
  }

  // Получение всех ссылок на скачивание с ftp-сервера
  public function get_all_download_links() {
    return $this->select(['id', 'title', 'download_link', 'downloaded', 'hash'], 'data', ['hide_link' => 0, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
  // "SELECT id,title,download_link,downloaded,hash FROM data WHERE hide_link='0' AND hidden='0' AND published='1' AND del='0' ORDER BY id ASC";
  }
  // Получение всех ссылок на скачивание с Облако Mail.ru
  public function get_all_internet_links() {
    return $this->select(['id', 'title', 'internet_link', 'internet_downloaded', 'hash'], 'data', ['hide_link' => 0, 'hidden' => 0, 'published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
    // "SELECT id,title,internet_link,internet_downloaded,hash FROM data WHERE hide_link='0' AND hidden='0' AND published='1' AND del='0' ORDER BY id ASC";
  }

  // Получение всех ссылок на оформление заказа
  public function get_all_buy_links() {
    return $this->select(['id', 'title', 'buy_link', 'orders'], 'data', ['hidden' => 0, 'published' => 1, 'del' => 0], ['='], ['id'], ['ASC'], false);
    // $query = "SELECT id,title,buy_link,orders FROM data WHERE hidden='0' AND published='1' AND del='0' ORDER BY id ASC";
  }

  // Получение всех ссылок на беннерах
  public function get_all_banner_links() {
    return $this->select(['id', 'title', 'link', 'view', 'click'], 'banners', ['published' => 1], ['='], ['id'], ['ASC'], false);
    // "SELECT id,title,link,view,click FROM banners WHERE published='1' ORDER BY id ASC";
  }


/* === Поиск === */
  public function search($searth) {
    if (empty($searth)) {
      return false;
    }
    $query = "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,buy_link,orders,price,introduction FROM data WHERE MATCH(text) AGAINST('$searth') AND hidden='0' AND published='1' AND del='0' ORDER BY id DESC";
    return $this->sql($query, true);
  }
/* === Поиск === */
  /* === Поиск по id поста === */
  public function search3($id) {
    $id = abs((int)$id);
    if ($id == 0) {
      return false;
    }
    return $this->select(['id', 'type', 'category', 'secret', 'alias', 'title', 'author', 'date', 'view', 'rating', 'quantity_vote', 'image', 'buy_link', 'orders', 'price', 'introduction'], 'data', ['id' => $id, 'hidden' => 0, 'published' => 1, 'del' => 0], ['=']);
    // "SELECT id,type,category,secret,alias,title,author,date,view,rating,quantity_vote,image,buy_link,orders,price,introduction FROM data WHERE id='$id' AND hidden='0' AND published='1' AND del='0'"; // LIMIT 1
    // return $this->sql($query);
  }
  /* === Поиск по id поста === */
  /* === Поиск для typeahead === */
  public function search_typeahead($searth) {
    if (empty($searth)) {
      return false;
    }
    //debug($searth);
    //$query = "SELECT id,title FROM data WHERE text LIKE '$searth' AND hidden='0' AND published='1' AND del='0' ORDER BY id DESC LIMIT 11";
    $query = "SELECT id,title FROM data WHERE MATCH(text) AGAINST('$searth') AND hidden='0' AND published='1' AND del='0' ORDER BY id DESC LIMIT 11";
    //$query = "SELECT id,title FROM data WHERE hidden='0' AND published='1' AND del='0' ORDER BY id DESC LIMIT 11";
    return $this->sql($query, true);
  }
  /* === Поиск для typeahead === */

/* === Продвинутый поиск === */
  public function search2() {
    return $this->select(['id', 'alias', 'title', 'description', 'keywords', 'text'], 'data', ['hidden' => 0, 'published' => 1, 'del' => 0], ['=']);
    // "SELECT id,alias,title,description,keywords,text FROM data WHERE hidden='0' AND published='1' AND del='0'";
  }
/* === Продвинутый поиск === */
  /* === Добавление поискового запроса === */
  public function add_search_query($query='') {
    if (empty($query)) {return false;}
    $date = date("Y-m-d H:i:s");
    $ip = get_ip();
    $result = $this->insert(
      'search_queries',
      array('query','date','ip'),
      array($query,$date,$ip),
      false
    );
    return $result;
    // "INSERT INTO search_queries (query, date, ip) VALUES ('$query','$date','$ip')";
  }
  /* === Добавление поискового запроса === */


/* === Получение рейтинга новостей === */
  public function get_rating($id) {
    return $this->select(['type','rating','quantity_vote'], 'data', ['id' => $id], ['='], false, false, 1);
    // "SELECT type,rating,quantity_vote FROM data WHERE id='$id' LIMIT 1";
}
/* === Получение рейтинга новостей === */

  /* Обновление голосов для текущей заметки */
  public function update_rating($id, $new_rating = 0, $new_quantity_vote = 0) {
    if(!isset($id)) {
      return false;
    }
    $result = $this->update(
      'data',
      array('rating','quantity_vote'),
      array((int)$new_rating, (int)$new_quantity_vote),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE data SET rating = '$new_rating',quantity_vote = '$new_quantity_vote' WHERE id='$id' LIMIT 1";
    return $result;
  }
  /* Обновление голосов для текущей заметки */

  // добавление сообщения в базу данных
  public function add_message($author,$addressee,$published=1,$date='1970-01-01 00:00:00',$text=''){
    if ((empty($author)) or (empty($addressee)) or (empty($text))) { // если пустые отправитель (автор), получатель сообщения или текст сообщения, то возвращаем false
      return false;
    }
    $result = $this->insert(
      'messages',
      array('author','addressee','published','date','text'),
      array($author,$addressee,$published,$date,$text),
      false
    );
    return $result;
    // "INSERT INTO messages (author, addressee, published, date, text) VALUES ('$message_author','$message_addressee','$published','$date','$message_text')";
  }

  // добавление комментария в базу
  public function add_comment($published=1,$del=0,$type=0,$post=0,$gallery=0,$image=0,$album=0,$parent=0,$user=0,$author='',$email='',$site='',$date='1970-01-01 00:00:00',$text=''){
    if ((empty($text)) or (empty($user))) { // если пустой текст комментария и id отправителя комментария, то возвращаем false
      return false;
    }
    $result = $this->insert(
      'comments',
      array('published','del','type','post','gallery','image','album','parent','user','author','email','site','date','text'),
      array($published,$del,$type,$post,$gallery,$image,$album,$parent,$user,$author,$email,$site,$date,$text),
      false
    );
    return $result;
    // "INSERT INTO comments (published,del,type,post,author,email,site,date,text) VALUES ('$published','$id','$comment_author','$author_email','$author_site','$date','$comment_text')";
  }





  // снятие ссылки с публикации
  public function unpublish_link($id){
    if (empty($id)) return false;
    return $this->update('links', ['published'], [0], ['id' => (int)$id], ['='], 1); // "UPDATE links SET published = '0' WHERE id='$id' LIMIT 1";
  }

  // Получение внешней ссылки
  public function get_link($id) {
    if (empty($id)) return false;
    $link = $this->select(['link', 'transitions'], 'links', ['id' => (int)$id, 'published' => 1], ['='], false, false, 1); // "SELECT link,transitions FROM links WHERE id='$id' AND published=1 LIMIT 1";
    if (!empty($link)) {
      // Обновление количества переходов по ссылке
      $this->update('links', ['transitions'], [(int)$link['transitions'] + 1], ['id' => (int)$id], ['='], 1); // "UPDATE links SET transitions = '$new_transitions' WHERE id='$id' LIMIT 1";
      return (string)$link['link'];
    }
    return false;
  }

  // Получение партнёрской ссылки
  public function get_partner_link($id,$table='data') {
    if (empty($id)) return false;
    $partner_link = $this->select(['partner_link', 'transitions'], $table, ['id' => (int)$id], ['='], false, false, 1); // "SELECT partner_link,transitions FROM data WHERE id='$id' LIMIT 1";
    if (!empty($partner_link)) {
      // Обновление количества переходов по ссылке
      $this->update($table, ['transitions'], [(int)$partner_link['transitions'] + 1], ['id' => (int)$id], ['='], 1); // "UPDATE data SET transitions = '$new_transitions' WHERE id='$id' LIMIT 1";
      return (string)$partner_link['partner_link'];
    }
    return false;
  }

  // Получение ссылки на закачку с ftp-сервера по ID
  public function get_download_link($id) {
    if (empty($id)) return false;
    $download_link = $this->select(['download_link', 'downloaded', 'hash'], 'data', ['id' => (int)$id], ['='], false, false, 1); // "SELECT download_link,downloaded FROM data WHERE id='$id' LIMIT 1";
    if (!empty($download_link)) {
      return $download_link;
    }
    return false;
  }

  // Получение ссылки на закачку с ftp-сервера по алиасу
  public function get_download_link_by_alias($alias) {
    if (empty($alias)) return false;
    $download_link = $this->select(['id', 'download_link', 'downloaded', 'hash'], 'courses', ['alias' => $alias], ['='], false, false, 1); // "SELECT id,download_link,downloaded,hash FROM courses WHERE id='$id' LIMIT 1";
    if ((!empty($download_link)) and ((string)$download_link['download_link'] != 'downloads/')) {
      return $download_link;
    }
    return false;
  }

  // Обновление количества скачиваний с ftp-сервера
  public function update_downloaded($id, $downloaded=0, $table='data') {
    if((!isset($table)) or (!isset($id))) {
      return false;
    }
    $result = $this->update($table, ['downloaded'], [(int)$downloaded+1], ['id' => (int)$id], ['='], 1);
    return $result;
    // "UPDATE data SET downloaded = '$new_downloaded' WHERE id='$id' LIMIT 1";
    // "UPDATE courses SET downloaded = '$new_downloaded' WHERE id='$id' LIMIT 1";
  }

  // Получение ссылки на закачку с внешнего сервера
  public function get_internet_link($id) {
    if (empty($id)) return false;
    $internet_link = $this->select(['internet_link', 'internet_downloaded','hash'], 'data', ['id' => (int)$id], ['='], false, false, 1); // "SELECT internet_link,internet_downloaded,hash FROM data WHERE id='$id' LIMIT 1";
    if (!empty($internet_link)) {
      return $internet_link;
    }
    return false;
  }

  // Обновление количества скачиваний с внешнего сервера
  public function update_internet_downloaded($id, $downloaded=0) {
    if(!isset($id)) {
      return false;
    }
    $result = $this->update('data', ['internet_downloaded'], [(int)$downloaded+1], ['id' => (int)$id], ['='], 1);
    return $result;
    // "UPDATE data SET internet_downloaded = '$new_internet_downloaded' WHERE id='$id' LIMIT 1";
  }

  // Получение ссылки на оформление заказа партнёрского продукта, товара или курса
  public function get_buy_link($id,$table='data') {
    if (empty($id)) return false;
    $buy_link = $this->select(['buy_link', 'orders'], $table, ['id' => (int)$id], ['='], false, false, 1); // "SELECT buy_link,orders FROM data WHERE id='$id' LIMIT 1";
    if (!empty($buy_link)) {
      // Обновление количества переходов по ссылке
      $this->update($table, ['orders'], [(int)$buy_link['orders'] + 1], ['id' => (int)$id], ['='], 1); // "UPDATE data SET orders = '$new_orders' WHERE id='$id' LIMIT 1";
      return (string)$buy_link['buy_link'];
    }
    return false;
  }

  // Получение баннерной ссылки
  public function get_banner_link($id) {
    if (empty($id)) return false;
    $banner_link = $this->select(['link', 'click'], 'banners', ['id' => (int)$id], ['='], false, false, 1); // "SELECT link,click FROM banners WHERE id='$id' LIMIT 1";
    if (!empty($banner_link)) {
      // Обновление количества переходов по ссылке
      $this->update('banners', ['click'], [(int)$banner_link['click'] + 1], ['id' => (int)$id], ['='], 1); // "UPDATE banners SET click = '$new_click' WHERE id='$id' LIMIT 1";
      return (string)$banner_link['link'];
    }
    return false;
  }

  // Получение торрент-ссылки
  public function get_torrent_link($id) {
    if (empty($id)) return false;
    $torrent_link = $this->select(['torrent_link', 'torrent_downloaded'], 'data', ['id' => (int)$id], ['='], false, false, 1); // "SELECT torrent_link,torrent_downloaded FROM data WHERE id='$id' LIMIT 1";
    if (!empty($torrent_link)) {
      // Обновление количества переходов по ссылке
      $this->update('data', ['downloaded'], [(int)$torrent_link['torrent_downloaded'] + 1], ['id' => (int)$id], ['='], 1); // "UPDATE data SET torrent_downloaded = '$new_torrent_downloaded' WHERE id='$id' LIMIT 1";
      return (string)$torrent_link['download_link'];
    }
    return false;
  }

  // добавление хешей в файлах для скачивания
  public function update_hash($id='',$hash='',$table='data') {
    if((empty($id)) or (empty($hash))) {
      // удаляем все хеши
      $result = $this->update(
        $table,
        array('hash'),
        array('')
      ); // "UPDATE data SET hash = ''";
    }
    else {
      $result = $this->update(
        $table,
        array('hash'),
        array((string)$hash),
        array('id' => (int)$id),
        array('='),
        1
      );
    }
    // "UPDATE data SET hash = '$hash' WHERE id='$id' LIMIT 1";
    // "UPDATE courses SET hash = '$hash' WHERE id='$id' LIMIT 1";
    return $result;
  }



  // удаление старых записей IP-адресов и времени посещения из таблицы онлайн-посетителей
  public function delete_ip_online(){
    $query = "DELETE FROM online WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(time) > 300"; // интервал обновления 5 минут (300 секунд)
    return $this->sql($query, false);
  }

  // получение записей онлайн-посетителей с существующим IP-адресом
  public function get_ip_online($ip){
    if(empty($ip)) {
      return false;
    }
    $result = $this->select(['ip'],'online', ['ip' => $ip],['='],false,false,1); // "SELECT ip FROM online WHERE ip='$ip' LIMIT 1"
    //debug($result);
    return $result['ip']; // возвращает ip-адрес в виде строки
  }

  // обновление времени посещения для онлайн-посетителя с текущим IP-адресом
  public function update_ip_online($ip){
    if(empty($ip)) {
      return false;
    }
    $query = "UPDATE online SET time=NOW() WHERE ip='$ip'";
    return $this->sql($query, false); // "UPDATE online SET time=NOW() WHERE ip='$ip'"
  }

  // добавление новой записи IP-адреса и времени посещения для онлайн-посетителя
  public function insert_ip_online($ip){
    if(empty($ip)) {
      return false;
    }
    $query = "INSERT INTO online (ip,time) VALUES ('$ip',NOW())";
    return $this->sql($query,false); // "INSERT INTO online (ip,time) VALUES ('$ip',NOW())";
  }

  // подсчет общего количества онлайн-посетителей
  public function total_count_ip_online(){
    return $this->select('id','online'); // "SELECT COUNT(id) FROM online";
  }

}