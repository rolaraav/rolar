<?php
namespace app\models;

use core\libs\ImageResize;
use core\libs\FileUpload;
use \Exception;
use core\Core;
use core\Db;
use \R;

class AdminModel extends BaseModel {

  public function __construct() {
    parent::__construct();
    //echo 'Конструктор AdminModel';
    //$adminModel = new AdminModel; // создание модели и соединение с базой данных
  }


  /* === Подсчёт общего количества материалов === */
  // если задан тип материалов, то подсчёт ведётся только среди материалав выбранного типа
  public function count_admin_total_posts($type=null){
    if (isset($type)) {
      $where = ['type' => (int)$type];
      if ((int)$type == 7) {
        //return $this->count_admin_total_posts2();
        return $this->select('id', 'posts');
        // "SELECT COUNT(id) FROM post"
      }
    }
    else {
      $where = null;
    }
    return $this->select('id', 'data', $where, ['=']);
    // "SELECT COUNT(id) FROM data WHERE type='1'
    // "SELECT COUNT(id) FROM data"
  }
  /* === Подсчёт общего количества материалов === */

  /* === Подсчёт общего количества ВСЕХ категорий === */
  public function count_admin_total_categories($type = null){
    if ((isset($type)) or ((int)$type != 0)) {
      $where = ['type' => (int)$type, 'del' => 0];
    }
    else {
      $where = ['del' => 0];
    }
    return $this->select('id', 'categories', $where, ['=']);
    // "SELECT COUNT(id) FROM categories AND del='0'"
    // "SELECT COUNT(id) FROM categories WHERE type>'0' AND del='0'"
  }
  /* === Подсчёт общего количества ВСЕХ категорий === */

  /* === Подсчёт общего количества новостей === */
  public function count_admin_total_news(){
    return $this->select('id', 'data', ['type' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='1' AND del='0'"
  }
  /* === Подсчёт общего количества новостей === */
  /* === Подсчёт общего количества рубрик === */
  public function count_admin_total_rubs(){
    return $this->select('id', 'categories', ['type' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM categories WHERE type='1' AND del='0'"
  }
  /* === Подсчёт общего количества рубрик === */
  /* === Подсчёт общего количества партнёрских продуктов === */
  public function count_admin_total_partner_products(){
    return $this->select('id', 'data', ['type' => 2, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='2' AND del='0'"
  }
  /* === Подсчёт общего количества партнёрских продуктов === */
  /* === Подсчёт общего количества закачек === */
  public function count_admin_total_downloads(){
    return $this->select('id', 'data', ['type' => 3, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='3' AND del='0'"
  }
  /* === Подсчёт общего количества закачек === */
  /* === Подсчёт общего количества секретных материалов === */
  public function count_admin_total_secret(){
    return $this->select('id', 'data', ['secret' => 1, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE secret='1' AND del='0'"
  }
  /* === Подсчёт общего количества секретных материалов === */
  /* === Подсчёт общего количества курсов === */
  public function count_admin_total_courses(){
    return $this->select('id', 'courses', ['del' => 0] );
    // "SELECT COUNT(id) FROM courses WHERE del='0'"
  }
  /* === Подсчёт общего количества курсов === */
  /* === Подсчёт общего количества товаров === */
  public function count_admin_total_goods(){
    return $this->select('id', 'data', ['type' => 4, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='4' AND del='0'"
  }
  /* === Подсчёт общего количества товаров === */
  /* === Подсчёт общего количества галлерей === */
  public function count_admin_total_galleries(){
    return $this->select('id', 'data', ['type' => 5, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='5' AND del='0'"
  }
  /* === Подсчёт общего количества галлерей === */
  /* === Подсчёт общего количества альбомов === */
  public function count_admin_total_albums(){
    return $this->select('id', 'data', ['type' => 6, 'del' => 0]);
    // "SELECT COUNT(id) FROM data WHERE type='6' AND del='0'"
  }
  /* === Подсчёт общего количества альбомов === */

  /* === Подсчёт общего количества партнёров === */
  public function count_admin_total_partners(){
    return $this->select('id', 'partners', ['del' => 0]);
    // "SELECT COUNT(id) FROM partners WHERE del='0'"
  }
  /* === Подсчёт общего количества партнёров === */
  /* === Подсчёт общего количества заметок === */
  public function count_admin_total_posts2(){
    return $this->select('id', 'posts');
    // "SELECT COUNT(id) FROM posts"
  }
  /* === Подсчёт общего количества заметок === */
  /* === Подсчёт общего количества комментариев === */
  public function count_admin_total_comments(){
    return $this->select('id', 'comments', ['del' => 0]);
    // "SELECT COUNT(id) FROM comments WHERE del='0'";
  }
  /* === Подсчёт общего количества комментариев === */
  /* === Подсчёт общего количества комментариев 2 === */
  public function count_admin_total_comments2(){
    return $this->select('id', 'comments2');
    // "SELECT COUNT(id) FROM comments2"
  }
  /* === Подсчёт общего количества комментариев 2 === */
  /* === Подсчёт общего количества умных фраз === */
  public function count_admin_total_phrases(){
    return $this->select('id', 'phrases', ['del' => 0]);
    // "SELECT COUNT(id) FROM phrases WHERE del='0'"
  }
  /* === Подсчёт общего количества умных фраз === */
  /* === Подсчёт общего количества ссылок === */
  public function count_admin_total_links(){
    return $this->select('id', 'links');
    // "SELECT COUNT(id) FROM links"
  }
  /* === Подсчёт общего количества ссылок === */
  /* === Подсчёт общего количества баннеров === */
  public function count_admin_total_banners(){
    return $this->select('id', 'banners');
    // "SELECT COUNT(id) FROM banners"
  }
  /* === Подсчёт общего количества баннеров === */
  /* === Подсчёт общего количества страниц === */
  public function count_admin_total_pages(){
    return $this->select('id', 'categories', ['type' => 0, 'del' => 0]);
    // "SELECT COUNT(id) FROM categories WHERE type='0' AND del='0'"
    // "SELECT COUNT(id) FROM pages";
  }
  /* === Подсчёт общего количества страниц === */
  /* === Подсчёт количества всех пользователей === */
  public function count_admin_total_users(){
    return $this->select('id', 'users');
    // "SELECT COUNT(id) FROM users"
  }
  /* === Подсчёт количества всех пользователей === */
  /* === Подсчёт количества только зарегистрированных пользователей === */
  public function count_admin_total_reg_users(){
    return $this->select('id', 'users', ['status' => 2], ['>']);
    // "SELECT COUNT(id) FROM users WHERE status>'2'"
  }
  /* === Подсчёт количества только зарегистрированных пользователей === */
  /* === Подсчёт количества подписчиков === */
  public function count_admin_total_subscribers(){
    return $this->select('id', 'users', ['status' => 2]);
    // "SELECT COUNT(id) FROM users WHERE status='2'"
  }
  /* === Подсчёт количества подписчиков === */
  /* === Подсчёт общего количества сообщений === */
  public function count_admin_total_messages(){
    return $this->select('id', 'messages');
    // "SELECT COUNT(id) FROM messages"
  }
  /* === Подсчёт общего количества сообщений === */



  /* === Изменение текстового редактора === */
  public function change_editor($editor = 'tinymce') {
    if (empty($editor)) {return false;}
    if (!in_array((string)$editor, ['tinymce', 'ckeditor', 'none'])) {$editor = 'tinymce';} // если переданные значения соответсвуют значениям в массиве

    $result = $this->update(
      'settings',
      array('value'),
      array((string)$editor),
      array('setting' => 'editor'),
      array('='),
      1
    );
    // "UPDATE settings SET value=$editor WHERE setting='editor' LIMIT 1";)

    return $result;
  }
  /* === Изменение текстового редактора === */

  /* === Данные пользователя === */
  public function get_auth_user($id,$login,$shifr_password){
    $query = "SELECT id,first_name,login,password,avatar,email,site,reg_date FROM users WHERE id='$id' AND login='$login' AND password='$shifr_password' AND activation='1' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $get_user = array();
    $get_user = mysql_fetch_assoc($result); // т.к. пользователь только один, то просто присваиваем значение массива без цикла
    return $get_user;
  }
  /* === Данные пользователя === */

  /* === Получение адресов почты === */
  public function get_subscriber_emails($where = null){
    switch($where){
      case('subscribers'):
        $parametr = ' WHERE activation=\'1\' AND status = \'2\''; // только подписчики
        break;
      case('users'):
        $parametr = ' WHERE activation=\'1\' AND status > \'2\''; // зарегистрированные пользователи, модераторы, администраторы
        break;
      case('users&subscribers'):
        $parametr = ' WHERE activation=\'1\' AND status > \'1\''; // все зарегистриорванные пользователи и подписчики, кроме заблокированных
        break;
      case('banned_users'):
        $parametr = ' WHERE activation=\'1\' AND status = \'1\''; // заблокированные пользователи
        break;
      case('all'):
        $parametr = ' WHERE activation=\'1\' AND status > \'0\''; // все зарегистриорванные пользователи, подписчики и заблокированные пользователи, кроме удалённых
        break;
      default:
        $parametr = ''; // все зарегистриорванные пользователи и подписчики, даже те кто удалён
    }
    $query = 'SELECT id,first_name,last_name,login,email,site,reg_date,login_date,birthday,gender,letter_type FROM users'.$parametr;
    $subscriber_emails = db_query($query); // т.к. пользователь только один, то просто присваиваем значение массива без цикла
    return $subscriber_emails;
  }
  /* === Получение адресов почты === */

  /* === Изменение паролей пользователей === */
  public function change_users_passwords() {
    // получение данных всех пользователей
    $users = $this->select(['id','first_name','last_name','login','email','password','activation','status','reg_date','login_date','letter_type','ip'],
      'users',
      [],
      ['='],
      'id',
      'DESC',
      false
    );
    // 'SELECT id,first_name,last_name,login,email,site,reg_date,login_date,birthday,gender,letter_type FROM users ORDER BY id DESC';
    //debug($users);

    $_SESSION['logmessage'] = ''; // вывод сообщений

    foreach ($users as $item) {

      // если хеше пароля есть символы 'g96vnh5p' и 'xr3qf8a5'
      if (preg_match('/^g96vnh5p(.{32})xr3qf8a5$/', $item['password']) == 1) {
        // тогда обновляем хеш пароля в базе данных

        // новый алгоритм шифрования отличается от старого дополнительной обёрткой полученной строки функцией md5
        // новый пароль = md5(старый пароль);
        $new_password = md5((string)$item['password']);
        //debug($new_password);

        // можно получить чистый md5-хеш пароля и закодировать пароль по новому:
        $string = preg_replace('/^g96vnh5p(.{32})xr3qf8a5$/', '$1', $item['password']); // очищаем хеши от лишних символов
        $string = strrev($string); // отменяем реверс строки хеша и получаем чистый md5-хеш пароля
        //debug($string);

        // старый алгоритм шифрования:
        //$shifr_password = md5($password);
        //$shifr_password = strrev($shifr_password);
        //$shifr_password = "g96vnh5p".$shifr_password."xr3qf8a5"; // g96vnh5p 29e2be6e06befb4e2c94f621a25da8df xr3qf8a5

        // новый алгоритм шифрования:
        // добавляем дополнительные символы в начале и в конце строки, чтобы пароль не смогли подобрать
        // добавляем реверс для надёжности и шифруем пароль по алогитму md5
        $shifr_password = md5('g96vnh5p'.strrev($string).'xr3qf8a5');
        // debug($shifr_password);

        // Шифрование пароля функцией shifr_password($password):
        // $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa

        // обновляем хеш пароля в базе данных
        $result2 = $this->update(
          'users',
          array('password'),
          array($new_password),
          array('id' => (int)$item['id']),
          array('='),
          1
        );
        // "UPDATE users SET password=$new_passord WHERE id='$item['id']' LIMIT 1";

        if ($result2 == true) {
          $_SESSION['logmessage'] = $_SESSION['logmessage'].'Хеш пароля пользователя <strong>'.$item['first_name'].'</strong> с id <strong>'.$item['id'].'</strong> изменён.<br><hr>'; // вывод сообщений
        }

      }

    }

    return true;
  }
  /* === Изменение паролей пользователей === */


// очистка удалённых пользователей
  public function clear_deleted_users() {

    // получение данных удалённых пользователей
    $deleted_users = $this->select(['id','first_name','last_name','login','avatar','email','site','activation','status','reg_date','login_date','birthday','gender','letter_type','ip'],
      'users',
    ['activation' => 0, 'status' => 3],
      ['=', '<'],
      'id',
      'DESC',
      false
    );
    // 'SELECT id,first_name,last_name,login,email,site,activation,status,reg_date,login_date,birthday,gender,letter_type,ip FROM users WHERE activation=\'0\' AND status < \'3\' ORDER BY id DESC LIMIT 300';
    //debug($deleted_users);

    $_SESSION['logmessage'] = ''; // вывод сообщений
    //require_once '../class/CheckMail.php';
    //$checkmail = new CheckMail();

    foreach ($deleted_users as $item) {
      $blackemails = $this->get_blackemails('users'); // получаем массив заблокированных email-адресов пользователей (админские адреса проходят)
      //debug($blackemails);

      // если проверяемый email не пустой и проходит проверку е-mail адреса регулярными выражениями на корректность и не содержится в массиве заблокированных emailов
      if ((!empty($item['email'])) and (!in_array($item['email'],$blackemails))) { //  and (!$checkmail->execute($item['email']))
        // то добавляем емайл в черный список
        // "INSERT INTO blacklist (email, admin) VALUES ('$item['email']',0)";
        $result = $this->insert(
          'blacklist',
          array('email','admin'),
          array($item['email'],0),
          true
        );

        if ($result == true) {
          $_SESSION['logmessage'] = $_SESSION['logmessage'].'Адрес электронной почты <strong>'.$item['email'].'</strong> добавлен в чёрный список.<br>'; // вывод сообщений
        }
      }

      $result2 = $this->update(
        'users',
        array('activation','status'),
        array(0,0),
        array('id' => (int)$item['id']),
        array('='),
        1
      );
      // "UPDATE users SET activation=0, status=0 WHERE id='$item['id']' LIMIT 1";
      // "DELETE FROM users WHERE id = '$item['id']'";

      if ($result2 == true) {
        $_SESSION['logmessage'] = $_SESSION['logmessage'].'Пользователь <strong>'.$item['first_name'].'</strong> с адресом электронной почты <strong>'.$item['email'].'</strong> и id <strong>'.$item['id'].'</strong> полностью удалён.<br><hr>'; // вывод сообщений
      }

      // Изменение автоинкремента SQL-запрос:
      /*
      $auto_increment = (int)$item['id'];
      //debug($auto_increment);

      $query = "ALTER TABLE users auto_increment = ".$auto_increment;
      //debug($query);

      $result3 = $this->sql($query, false);
      if ($result3 == true) {
        $_SESSION['logmessage'] = $_SESSION['logmessage'].'Автоинкремент изменён.<hr>';
      }
      */
    }
    return true;
  }

  /* === Получение заблокированных адресов почты === */
  public function get_blackemails($parametr = null){
    switch($parametr){
      case('admin'):
        // $parametr = ' WHERE admin=\'1\''; // только email-адреса, исключенные администратором
        $where = ['admin' => 1];
        break;
      case('users'):
        // $parametr = ' WHERE admin=\'0\''; // только email-адреса заблокированных пользователей
        $where = ['admin' => 0];
        break;
      default:
        // $parametr = ''; // все email адреса
        $where = [];
    }

    $blackemails = $this->select(['id','email','user_id'],
      'blacklist',
      $where,
      ['='],
      false,
      false,
      false
    );
    // 'SELECT id,email,user_id FROM blacklist'.$parametr;

    //debug($blackemails);
    return $blackemails;
  }
  /* === Получение заблокированных адресов почты === */

  /* === Вставка адресов почты === */
  public function insert_subscriber_emails($array) {
    if((empty($array['email'])) or (!preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $array['email']))) {
      return false;
    }
    else {
      $email = trim($array['email']);
    }
    if (!empty($array['first_name'])) {$first_name = trim($array['first_name']);}
    if (!empty($array['last_name'])) {$last_name = trim($array['last_name']);}
    if (!empty($array['login'])) {$login = trim($array['login']);}
    $password = '';
    $avatar = DAVATAR;
    if (!empty($array['site'])) {$site = trim($array['site']);}
    $activation = 1;
    $status = 2;
    $method = 0;
    if (!empty($array['reg_date'])) {$reg_date = trim($array['reg_date']);} else {$reg_date = date("Y-m-d H:i:s");}
    if (!empty($array['login_date'])) {$login_date = trim($array['login_date']);} else {$login_date = date("Y-m-d H:i:s");}
    if (!empty($array['birthday'])) {$birthday = trim($array['birthday']);} else {$birthday = date("Y-m-d");}
    if (!empty($array['gender'])) {$gender = (int)$array['gender'];} else {$gender = 0;}
    $ip = '127.0.0.1';
    if (!empty($array['letter_type'])) {$letter_type = (int)$array['letter_type'];} else {$letter_type = 0;}
    $view = 0;

    $query = "INSERT INTO users (first_name,last_name,login,password,avatar,email,site,activation,status,method,reg_date,login_date,birthday,gender,ip,letter_type,view) VALUES ('$first_name','$last_name','$login','$password','$avatar','$email','$site','$activation','$status','$method','$reg_date','$login_date','$birthday','$gender','$ip','$letter_type','$view')";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if (mysql_affected_rows() > 0) {
      // $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="green1">Подписчик '.$array['email'].' в базу данных добавлен.</div>';
    }
    else {
      // $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="red1">Подписчик '.$array['email'].' в базу данных не добавлен.</div>';
      return false;
    }
    return true;
  }
  /* === Вставка адресов почты === */

  /* === Получение списка материалов === */
  // если задан тип материалов, то получаем материалы только выбранного типа
  public function get_view_data($limit=null,$type=null) {
    if (!is_array($limit)) {
      return false;
    }
    if (isset($type)) {
      $where = ['type' => (int)$type, 'del' => 0];
      if ((int)$type == 7) {
        //return $this->get_view_posts($limit);
        return $this->select(['id','category','hidden','published','title'],
          'posts',
          null,
          ['='],
          'id',
          'DESC',
          $limit
        );
        // "SELECT id,hidden,published,title FROM posts ORDER BY id DESC".$limit;
      }
    }
    else {
      $where = ['del' => 0];
    }
    return $this->select(['id','type','category','secret','hidden','published','del','alias','title'],
      'data',
      $where,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,type,category,secret,hidden,published,del,alias,title FROM data WHERE del='0' ORDER BY id DESC".$limit;
    // "SELECT id,type,category,secret,hidden,published,del,alias,title FROM data WHERE type='1' AND del='0' ORDER BY id DESC".$limit;
  }
  /* === Получение списка материалов === */

  /* === Получение списка категорий === */
  public function get_view_categories($limit=null,$type=null) {
    if (!is_array($limit)) {
      return false;
    }
    if (isset($type)) {
      $where = ['type' => (int)$type, 'del' => 0];
    }
    else {
      $where = ['del' => 0];
    }
    return $this->select(['id','type','alias','title','parent','position','published','del'],
      'categories',
      $where,
      ['='],
      'id',
      'DESC',
      $limit
    );
    //"SELECT id,type,alias,title,parent,position,published,del FROM categories WHERE del='0' ORDER BY id DESC".$limit;
    //"SELECT id,type,alias,title,parent,position,published,del FROM categories WHERE type='1' AND del='0' ORDER BY id DESC".$limit;
  }
  /* === Получение списка категорий === */


  /* === Получение списка новостей === */
  public function get_view_news($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='0' ORDER BY id DESC".$limit;
    $news = db_query($query);
    return $news;
  }
  /* === Получение списка новостей === */
  /* === Получение списка рубрик новостей === */
  public function get_view_rub_news($limit = null) {
    $query = "SELECT id,title FROM headings ORDER BY id DESC".$limit;
    $rub_news = db_query($query);
    return $rub_news;
  }
  /* === Получение списка рубрик новостей === */
  /* === Получение списка партнёрских продуктов === */
  public function get_view_partner_products($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='1' ORDER BY id DESC".$limit;
    $partner_products = db_query($query);
    return $partner_products;
  }
  /* === Получение списка партнёрских продуктов === */
  /* === Получение списка партнёров === */
  public function get_view_partners($limit = null) {
    if (!is_array($limit)) {
      return false;
    }
    return $this->select(['id','alias','title','published','del'],
      'partners',
      ['del' => 0],
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,alias,title,published FROM partners WHERE del='0' ORDER BY id DESC".$limit;
  }
  /* === Получение списка партнёров === */
  /* === Получение списка закачек === */
  public function get_view_downloads($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='2' ORDER BY id DESC".$limit;
    $downloads = db_query($query);
    return $downloads;
  }
  /* === Получение списка закачек === */
  /* === Получение списка разделов === */
  public function get_view_cat_download($limit = null) {
    $query = "SELECT id,title FROM categories ORDER BY id DESC".$limit;
    $cat_download = db_query($query);
    return $cat_download;
  }
  /* === Получение списка разделов === */
  /* === Получение списка товаров === */
  public function get_view_goods($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='3' ORDER BY id DESC".$limit;
    $goods = db_query($query);
    return $goods;
  }
  /* === Получение списка товаров === */
  /* === Получение списка галлерей === */
  public function get_view_galleries($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='4' ORDER BY id DESC".$limit;
    $galleries = db_query($query);
    return $galleries;
  }
  /* === Получение списка галлерей === */
  /* === Получение списка альбомов === */
  public function get_view_albums($limit = null) {
    $query = "SELECT id,secret,hidden,published,title FROM data WHERE type='5' ORDER BY id DESC".$limit;
    $albums = db_query($query);
    return $albums;
  }
  /* === Получение списка альбомов === */
  /* === Получение списка заметок === */
  public function get_view_posts($limit = null) {
    return $this->select(['id','category','hidden','published','title'],
      'posts',
      null,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,hidden,published,title FROM posts ORDER BY id DESC".$limit;
  }
  /* === Получение списка заметок === */
  /* === Получение списка комментариев === */
  public function get_view_comments($limit = null) {
    return $this->select(['id','published','post','gallery','image','album','user','author','text'],
      'comments',
      ['del' => 0],
      ['='],
      'id',
      'DESC',
      $limit
    );
    //"SELECT id,published,author,text FROM comments WHERE del='0' ORDER BY id DESC".$limit;
  }
  /* === Получение списка комментариев === */
  /* === Получение списка комментариев 2 === */
  public function get_view_comments2($limit = null) {
    return $this->select(['id','published','author','text'],
      'comments2',
      null,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,published,author,text FROM comments2 ORDER BY id DESC".$limit;
  }
  /* === Получение списка комментариев 2 === */
  /* === Получение списка курсов === */
  public function get_view_courses($limit = null) {
    return $this->select(['id','category','title','alias','author','year','published','del'],
      'courses',
      ['del' => 0],
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,category,title,alias,published,del FROM courses WHRER del='0' ORDER BY id DESC".$limit;
  }
  /* === Получение списка курсов === */


  /* === Получение всех мудрых фраз === */
  public function get_view_phrases($limit = null) {
    if (!is_array($limit)) {
      return false;
    }
    return $this->select(['id','text','author','image','color','published','del'],
      'phrases',
      ['del' => 0],
      ['='],
      'id',
      'ASC',
      $limit
    );
    // "SELECT id,text,author,image,color,view FROM phrases WHRER del='0' ORDER BY 'id' ASC".$limit;;
  }
  /* === Получение всех мудрых фраз === */

  /* === Получение списка пользователей === */
  public function get_view_users($limit = null) {
    return $this->select(['id','first_name','last_name','login','avatar','email','activation','status','reg_date','login_date','gender','ip'],
      'users',
      null,
      ['='],
      'id',
      'ASC',
      $limit
    );
    // "SELECT id,first_name,login,email,activation,status FROM users ORDER BY id DESC".$limit;
  }
  /* === Получение списка пользователей === */
  /* === Получение списка подписчиков === */
  public function get_view_subscribers($limit = null) {
    $query = "SELECT id,first_name,email,activation FROM users WHERE status = '2' ORDER BY id DESC".$limit;
    $users = db_query($query);
    return $users;
  }
  /* === Получение списка подписчиков === */
  /* === Получение списка сообщений === */
  public function get_view_messages($limit = null) {
    return $this->select(['id','author','addressee','published','text'],
      'messages',
      null,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,author,addressee,published,text FROM messages ORDER BY id DESC".$limit;
  }
  /* === Получение списка сообщений === */
  /* === Получение списка ссылок === */
  public function get_view_links($limit = null) {
    return $this->select(['id','secret','ref','published','title','link','transitions'],
      'links',
      null,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,secret,ref,title,link,transitions FROM links ORDER BY id DESC".$limit;
  }
  /* === Получение списка ссылок === */
  /* === Получение списка баннеров === */
  public function get_view_banners($limit = null) {
    return $this->select(['id','title','published','type','link','image','view','click'],
      'banners',
      null,
      ['='],
      'id',
      'DESC',
      $limit
    );
    // "SELECT id,published,title,link,image,view,click FROM banners ORDER BY id DESC".$limit;
  }
  /* === Получение списка баннеров === */
  /* === Получение списка страниц === */
  public function get_view_pages($limit = null) {
    $query = "SELECT id,page,title FROM pages ORDER BY id DESC".$limit;
    $pages = db_query($query);
    return $pages;
  }
  /* === Получение списка страниц === */

  /* === Получение рубрик новостей для selecta === */
  public function get_rubs() {
    $query = "SELECT id,title FROM headings ORDER BY id";
    $rub = db_query($query);
    return $rub;
  }
  /* === Получение рубрик новостей для selecta === */

  /* === Получение партнёров для selecta === */
  public function cp_get_partners() {
    return $this->select(['id','title'],'partners', ['published' => 1, 'del' => 0], ['='], 'id', 'ASC');
    // "SELECT id,title FROM partners WHERE published='1' AND del='0' ORDER BY id ASC";
  }
  /* === Получение партнёров для selecta === */

  /* === Получение разделов для selecta === */
  public function get_cats() {
    $query = "SELECT id,title FROM categories ORDER BY id";
    $cat = db_query($query);
    return $cat;
  }
  /* === Получение разделов для selecta === */

  /* === Получение пользователей для selecta === */
  public function get_users2() {
    $query = "SELECT id,login FROM users ORDER BY id";
    $users2 = db_query($query);
    return $users2;
  }
  /* === Получение пользователей для selecta === */

  /* === Получение страниц для selecta === */
  public function get_pages() {
    $query = "SELECT id,title FROM pages WHERE id IN (12,13,15,17) ORDER BY id";
    $pages = db_query($query);
    return $pages;
  }
  /* === Получение страниц для selecta === */


  /* === Получение новости/партнёрского продукта/закачки/товара/галереи/альбома для редактирования/удаления === */
  public function cp_get_post($id,$type = null) {
    $where = ['id' => (int)$id];
    if (isset($type)) {
      $where = ['id' => (int)$id, 'type' => (int)$type];
    }
    return $this->select(['type','category','partner','secret','hidden','hide_link','comments','published','del','alias','title','description','keywords','author','date','view','rating','quantity_vote','image','size','screenshots','gallery_id','album_id','partner_link','transitions','download_link','downloaded','internet_link','internet_downloaded','buy_link','orders','price','hash','introduction','text'],
      'data',
      $where,
      ['='],
      false,
      false,
      1
    );
    // "SELECT type,category,partner,secret,hidden,hide_link,comments,published,del,alias,title,description,keywords,author,date,view,rating,quantity_vote,image,size,screenshots,gallery_id,album_id,partner_link,transitions,download_link,downloaded,internet_link,internet_downloaded,buy_link,orders,price,hash,introduction,text FROM data WHERE id='$id' AND type='$type' LIMIT 1";
  }
  /* === Получение новости/партнёрского продукта/закачки/товара/галереи/альбома для редактирования/удаления === */

  /* === Получение заметки для редактирования/удаления === */
  public function get_post2($id) {
    $query = "SELECT category,hidden,published,comments,title,author,date,image,text FROM posts WHERE id=$id LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $post2 = array();
    $post2 = mysql_fetch_assoc($result); // т.к. заметка только одна, то просто присваиваем значение массива без цикла
    return $post2;
  }
  /* === Получение заметки для редактирования/удаления === */

  /* === Получение рубрики для редактирования/удаления === */
  public function get_rub($id) {
    $query = "SELECT title,description,keywords,text FROM headings WHERE id='$id' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $rub_news = array();
    $rub_news = mysql_fetch_assoc($result); // т.к. заметка только одна, то просто присваиваем значение массива без цикла
    return $rub_news;
  }
  /* === Получение рубрики для редактирования/удаления === */

  /* === Получение партнёра для редактирования/удаления === */
  public function cp_get_partner($id) {
    return $this->select(['alias','title','description','keywords','image','text','view','published','del'],
      'partners',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT alias,title,description,keywords,image,text,view,published,del FROM partners WHERE id='$id' LIMIT 1";
  }
  /* === Получение партнёра для редактирования/удаления === */

  /* === Получение раздела для редактирования/удаления === */
  public function get_cat($id) {
    $query = "SELECT title,description,keywords,text FROM categories WHERE id='$id' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $cat = array();
    $cat = mysql_fetch_assoc($result); // т.к. заметка только одна, то просто присваиваем значение массива без цикла
    return $cat;
  }
  /* === Получение раздела для редактирования/удаления === */

  /* === Получение категории для редактирования/удаления === */
  public function cp_get_category($id) {
    return $this->select(['type','alias','title','parent','position','menu','description','keywords','image','text','view','published','del'],
      'categories',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT type,alias,title,parent,position,menu,description,keywords,image,text,view,published,del FROM categories WHERE id='$id' LIMIT 1";
  }
  /* === Получение категории для редактирования/удаления === */

  /* === Получение комментария для редактирования/удаления === */
  public function cp_get_comment($id) {
    return $this->select(['published','del','type','post','gallery','image','album','parent','user','author','email','site','date','text'],
      'comments',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT published,post,gallery,image,album,parent,user,author,email,site,date,text FROM comments WHERE id='$id' LIMIT 1";
  }
  /* === Получение комментария для редактирования/удаления === */

  /* === Получение комментария 2 для редактирования/удаления === */
  public function get_comment2($id) {
    $query = "SELECT published,post,author,email,site,date,text FROM comments2 WHERE id='$id' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $comment2 = array();
    $comment2 = mysql_fetch_assoc($result); // т.к. заметка только одна, то просто присваиваем значение массива без цикла
    return $comment2;
  }
  /* === Получение комментария 2 для редактирования/удаления === */

  /* === Получение фразы для редактирования/удаления === */
  public function cp_get_phrase($id) {
    return $this->select(['text','author','image','color','view','published','del'],
      'phrases',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT text,author,image,color,view,published,del FROM phrases WHERE id='$id' LIMIT 1";
  }
  /* === Получение фразы для редактирования/удаления === */

  /* === Получение пользователя для редактирования/удаления === */
  public function cp_get_user($id) {
    return $this->select(['first_name','last_name','login','password','avatar','photo','phone','email','site','activation','status','method','social_id','reg_date','login_date','birthday','gender','ip','letter_type','view'],
      'users',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT first_name,last_name,login,password,avatar,photo,phone,email,site,activation,status,method,social_id,reg_date,login_date,birthday,gender,ip,letter_type,view FROM users WHERE id='$id' LIMIT 1";
  }
  /* === Получение пользователя для редактирования/удаления === */

  /* === Получение сообщения для редактирования/удаления === */
  public function cp_get_message($id) {
    return $this->select(['author','addressee','published','date','text'],
      'messages',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT author,addressee,published,date,text FROM messages WHERE id='$id' LIMIT 1";
  }
  /* === Получение сообщения для редактирования/удаления === */

  /* === Получение курса для редактирования/удаления === */
  public function cp_get_course($id) {
    return $this->select(['category','title','alias','author','image','text','view','size','year','price','author_price','buy_link','orders','download_link','downloaded','partner_link','transitions','hash','hide_plink','published','del'],
      'courses',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT category,title,alias,author,image,text,view,size,year,price,author_price,buy_link,orders,download_link,downloaded,partner_link,transitions,hash,hide_plink,published,del FROM courses WHERE id='$id' LIMIT 1";
  }
  /* === Получение курса для редактирования/удаления === */

  /* === Получение ссылки для редактирования/удаления === */
  public function cp_get_link($id) {
    return $this->select(['secret','ref','published','title','link','short_link','transitions'],
      'links',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT secret,ref,published,title,link,short_link,transitions FROM links WHERE id='$id' LIMIT 1";
  }
  /* === Получение ссылки для редактирования/удаления === */

  /* === Получение баннера для редактирования/удаления === */
  public function cp_get_banner($id) {
    return $this->select(['title','published','type','link','image','view','click'],
      'banners',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1
    );
    // "SELECT title,published,type,link,image,view,click FROM banners WHERE id='$id' LIMIT 1";
  }
  /* === Получение баннера для редактирования/удаления === */

  /* === Получение страницы для редактирования/удаления === */
  public function get_page($id) {
    $query = "SELECT page,title,description,keywords,text,view FROM pages WHERE id='$id' LIMIT 1";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    $page2 = array();
    $page2 = mysql_fetch_assoc($result); // т.к. заметка только одна, то просто присваиваем значение массива без цикла
    return $page2;
  }
  /* === Получение страницы для редактирования/удаления === */


  /* === Создание новости/партнёрского продукта/закачки/товара/галереи/альбома === */
  public function create_post() {
    $error = ''; // флаг проверки пустых полей

    //debug($_POST);

    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    switch($type){
      case(0):
        $tp1 = 'материал';
        $tp2 = 'Новый материал успешно создан';
        $tp3 = 'Новый материал не создан';
        break;
      case(1):
        $tp1 = 'новости';
        $tp2 = 'Новая новость успешно создана';
        $tp3 = 'Новая новость не создана';
        break;
      case(2):
        $tp1 = 'партнёрского продукта';
        $tp2 = 'Новый партнёрский продукт успешно создан';
        $tp3 = 'Новый партнёрский продукт не создан';
        break;
      case(3):
        $tp1 = 'закачки';
        $tp2 = 'Новая закачка успешно создана';
        $tp3 = 'Новая закачка не создана';
        break;
      case(4):
        $tp1 = 'товара';
        $tp2 = 'Новый товар успешно создан';
        $tp3 = 'Новый товар не создан';
        break;
      case(5):
        $tp1 = 'галереи';
        $tp2 = 'Новая галерея успешно создана';
        $tp3 = 'Новая галерея не создана';
        break;
      case(6):
        $tp1 = 'альбома';
        $tp2 = 'Новый альбом успешно создан';
        $tp3 = 'Новый альбом не создан';
        break;
      // default:
    }
    $category = (int)$_POST['category']; if (empty($category)) {$category = 1;}
    $partner = (int)$_POST['partner']; if (empty($partner)) {$partner = 0;}
    $secret = (int)$_POST['secret']; if (empty($secret)) {$secret = 0;}
    $hidden = (int)$_POST['hidden']; if (empty($hidden)) {$hidden = 0;}
    $hide_link = (int)$_POST['hide_link']; if (empty($hide_link)) {$hide_link = 0;}
    $comments = (int)$_POST['comments']; if (empty($comments)) {$comments = 1;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = 0; // удаление материала
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название '.$tp1.'</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас '.$tp1.'</li>';}
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание '.$tp1.' (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора '.$tp1.'</li>';}
    $date = trim($_POST['date']); if (empty($date)) {$date = date("Y-m-d H:i:s");} // $error = $error.'<li>Не введены дата и время создания '.$tp1.'</li>';
    $view = 0;
    $rating = 5;
    $quantity_vote = 1;
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/data/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $size = (int)$_POST['size']; if (empty($size)) {$size = 0;} // $error = $error.'<li>Не введён размер прикреплённых файлов</li>';
    $screenshots = trim(trim($_POST['screenshots'],',')); if (empty($screenshots)) {$screenshots = '';}
    $gallery_id = (int)$_POST['gallery_id']; if (empty($gallery_id)) {$gallery_id = 0;}
    $album_id = (int)$_POST['album_id']; if (empty($album_id)) {$album_id = 0;}
    $partner_link = trim($_POST['partner_link']); if (empty($partner_link)) {$partner_link = '';} // $error = $error.'<li>Не введён адрес партнёрской ссылки</li>';
    $transitions = 0;
    $download_link = trim($_POST['download_link']); if (empty($download_link)) {$download_link = '';} // $error = $error.'<li>Не введён адрес ссылки для скачивания с ftp-сервера</li>';
    $downloaded = 0;
    $internet_link = trim($_POST['internet_link']); if (empty($internet_link)) {$internet_link = '';} // $error = $error.'<li>Не введён адрес ссылки для скачивания с интернета</li>';
    $internet_downloaded = 0;
    $buy_link = trim($_POST['buy_link']); if (empty($buy_link)) {$buy_link = '';} // $error = $error.'<li>Не введён адрес ссылки для оформления заказа</li>';
    $orders = 0;
    $price = (int)$_POST['price']; if (empty($price)) {$price = 0;} // $error = $error.'<li>Не введена цена '.$tp1.'</li>';
    $hash = generate_hash(); // функция для генерации хеша для скачивания файлов
    $introduction = trim($_POST['introduction']); if (empty($introduction)) {$introduction = ''; $error = $error.'<li>Не введено краткое описание '.$tp1.' с html-тэгами</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст '.$tp1.' с html-тэгами</li>';}

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $author = clear($author, true, true, false, true, false, true);
    $introduction = clear($introduction, false, false, false, false, false, false);
    $text = clear($text, false, false, false, false, false, false);

    $_SESSION['create']['type'] = $type;
    $_SESSION['create']['category'] = $category;
    $_SESSION['create']['partner'] = $partner;
    $_SESSION['create']['secret'] = $secret;
    $_SESSION['create']['hidden'] = $hidden;
    $_SESSION['create']['hide_link'] = $hide_link;
    $_SESSION['create']['comments'] = $comments;
    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['alias'] = $alias;
    $_SESSION['create']['description'] = $description;
    $_SESSION['create']['keywords'] = $keywords;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['date'] = $date;
    //$_SESSION['create']['view'] = $view;
    //$_SESSION['create']['rating'] = $rating;
    //$_SESSION['create']['quantity_vote'] = $quantity_vote;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['image_path'] = $image_path;
    $_SESSION['create']['size'] = $size;
    $_SESSION['create']['screenshots'] = $screenshots;
    $_SESSION['create']['gallery_id'] = $gallery_id;
    $_SESSION['create']['album_id'] = $album_id;
    $_SESSION['create']['partner_link'] = $partner_link;
    //$_SESSION['create']['transitions'] = $transitions;
    $_SESSION['create']['download_link'] = $download_link;
    //$_SESSION['create']['downloaded'] = $downloaded;
    $_SESSION['create']['internet_link'] = $internet_link;
    //$_SESSION['create']['internet_downloaded'] = $internet_downloaded;
    $_SESSION['create']['buy_link'] = $buy_link;
    //$_SESSION['create']['orders'] = $orders;
    $_SESSION['create']['price'] = $price;
    $_SESSION['create']['introduction'] = $introduction;
    $_SESSION['create']['text'] = $text;

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {

        try {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          //debug($image_resize_obj);
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'postthumbs'); // изменяем размер полученной картинки и получаем миниатюру
          //debug($destination);
          $this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)

          if (!empty($screenshots)) { // если есть скриншоты
            $screenshots_array = explode(',',$screenshots); // получаем массив с именами скриншотов
            foreach($screenshots_array as $item) {
              if ($item == $image) continue; // если имя миниатюры совпадает с именем скриншота, то пропускаем
              if (!file_exists(UPLOAD.S.$item)) { // если нет исходного файла
                //if (!file_exists('../'.$image_path.$item)) { // если нет конечного файла, удаляем скриншот
                //    $screenshots = preg_replace('#(,){2,}#',',',preg_replace('#^(,)+|(,)+$#','',preg_replace('#'.$item.'#','',$screenshots)));
                //}
                continue;
              }
              $destination2 = $image_resize_obj->resize(UPLOAD.S.$item,$image_path.$item,'postthumbs'); // изменяем размеры скриншотов и получаем миниатюру
              //debug($destination2);
              $this->delete_uploaded_file(UPLOAD.S.$item); // удаляем оригинальные файлы скриншотов
              $this->add_resized_file($destination2); // добавляем полученный файл в базу данных
              if (basename($destination2['image']) != $item) { // если после сохранения название скриншота изменилось
                $screenshots = preg_replace('#'.$item.'#',basename($destination2['image']),$screenshots); // изменяем название скриншота (если вдруг его тип изменился)
              }
            }
          }
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      // "INSERT INTO data (type,category,partner,secret,hidden,hide_link,comments,published,del,alias,title,description,keywords,author,date,view,rating,quantity_vote,image,size,screenshots,gallery_id,album_id,partner_link,transitions,download_link,downloaded,internet_link,internet_downloaded,buy_link,orders,price,hash,introduction,text) VALUES ('$type','$category','$partner','$secret','$hidden','$hide_link','$comments','$published','$del','$alias','$title','$description','$keywords','$author','$date','$view','$rating','$quantity_vote','$image_path.$image','$size','$screenshots','$gallery_id','$album_id','$partner_link','$transitions','$download_link','$downloaded','$internet_link','$internet_downloaded','$buy_link','$orders','$price','$hash','$introduction','$text')";
      $post_id = $this->insert(
        'data',
        array('type','category','partner','secret','hidden','hide_link','comments','published','del','alias','title','description','keywords','author','date','view','rating,quantity_vote','image','size','screenshots','gallery_id','album_id','partner_link','transitions','download_link','downloaded','internet_link','internet_downloaded','buy_link','orders','price','hash','introduction','text'),
        array($type,$category,$partner,$secret,$hidden,$hide_link,$comments,$published,$del,$alias,$title,$description,$keywords,$author,$date,$view,$rating,$quantity_vote,$image_path.$image,$size,$screenshots,$gallery_id,$album_id,$partner_link,$transitions,$download_link,$downloaded,$internet_link,$internet_downloaded,$buy_link,$orders,$price,$hash,$introduction,$text),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($post_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">'.$tp2.' в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. '.$tp3.'!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>';
      return false;
    }
  }
  /* === Создание новости/партнёрского продукта/закачки/товара/галереи/альбома === */

  /* === Редактирование новости/партнёрского продукта/закачки/товара/галереи/альбома === */
  public function edit_post($id) {
    $error = ''; // флаг проверки пустых полей
    // $id = $_POST['id']; if ($id == '') {unset($id);}
    //debug($_POST);
    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    switch($type){
      case(0):
        $tp1 = 'материала';
        $tp2 = 'Материал успешно сохранён';
        break;
      case(1):
        $tp1 = 'новости';
        $tp2 = 'Новость успешно сохранена';
        break;
      case(2):
        $tp1 = 'партнёрского продукта';
        $tp2 = 'Партнёрский продукт успешно сохранён';
        break;
      case(3):
        $tp1 = 'закачки';
        $tp2 = 'Закачка успешно сохранена';
        break;
      case(4):
        $tp1 = 'товара';
        $tp2 = 'Товар успешно сохранён';
        break;
      case(5):
        $tp1 = 'галереи';
        $tp2 = 'Галерея успешно сохранена';
        break;
      case(6):
        $tp1 = 'альбома';
        $tp2 = 'Альбом успешно сохранён';
        break;
      // default:
    }
    $category = (int)$_POST['category']; if (empty($category)) {$category = 1;}
    $partner = (int)$_POST['partner']; if (empty($partner)) {$partner = 0;}
    $secret = (int)$_POST['secret']; if (empty($secret)) {$secret = 0;}
    $hidden = (int)$_POST['hidden']; if (empty($hidden)) {$hidden = 0;}
    $hide_link = (int)$_POST['hide_link']; if (empty($hide_link)) {$hide_link = 0;}
    $comments = (int)$_POST['comments']; if (empty($comments)) {$comments = 1;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;} // удаление материала
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название '.$tp1.'</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас '.$tp1.'</li>';}
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание '.$tp1.' (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора '.$tp1.'</li>';}
    $date = trim($_POST['date']); if (empty($date)) {$date = date("Y-m-d H:i:s");} // $error = $error.'<li>Не введены дата и время создания '.$tp1.'</li>';
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;}
    $rating = (int)$_POST['rating']; if (empty($rating)) {$rating = 5;}
    $quantity_vote = (int)$_POST['quantity_vote']; if (empty($quantity_vote)) {$quantity_vote = 1;};
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/data/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $size = (int)$_POST['size']; if (empty($size)) {$size = 0;} // $error = $error.'<li>Не введён размер прикреплённых файлов</li>';
    $screenshots = trim(trim($_POST['screenshots'],',')); if (empty($screenshots)) {$screenshots = '';}
    $gallery_id = (int)$_POST['gallery_id']; if (empty($gallery_id)) {$gallery_id = 0;}
    $album_id = (int)$_POST['album_id']; if (empty($album_id)) {$album_id = 0;}
    $partner_link = trim($_POST['partner_link']); if (empty($partner_link)) {$partner_link = '';} // $error = $error.'<li>Не введён адрес партнёрской ссылки</li>';
    $transitions = (int)$_POST['transitions']; if (empty($transitions)) {$transitions = 0;}
    $download_link = trim($_POST['download_link']); if (empty($download_link)) {$download_link = '';} // $error = $error.'<li>Не введён адрес ссылки для скачивания с ftp-сервера</li>';
    $downloaded = (int)$_POST['downloaded']; if (empty($downloaded)) {$downloaded = 0;}
    $internet_link = trim($_POST['internet_link']); if (empty($internet_link)) {$internet_link = '';} // $error = $error.'<li>Не введён адрес ссылки для скачивания с интернета</li>';
    $internet_downloaded = (int)$_POST['internet_downloaded']; if (empty($internet_downloaded)) {$internet_downloaded = 0;}
    $buy_link = trim($_POST['buy_link']); if (empty($buy_link)) {$buy_link = '';} // $error = $error.'<li>Не введён адрес ссылки для оформления заказа</li>';
    $orders = (int)$_POST['orders']; if (empty($orders)) {$orders = 0;}
    $price = (int)$_POST['price']; if (empty($price)) {$price = 0;} // $error = $error.'<li>Не введена цена '.$tp1.'</li>';
    $hash = trim($_POST['hash']); if (empty($hash)) {$hash = generate_hash();} // функция для генерации хеша для скачивания файлов
    $introduction = trim($_POST['introduction']); if (empty($introduction)) {$introduction = ''; $error = $error.'<li>Не введено краткое описание '.$tp1.' с html-тэгами</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст '.$tp1.' с html-тэгами</li>';}

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $author = clear($author, true, true, false, true, false, true);
    $introduction = clear($introduction, false, false, false, false, false, false);
    $text = clear($text, false, false, false, false, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {
        // получаем имя картинки и скриншоты из базы данных
        $res = $this->select(['image','screenshots'], 'data', ['id' => $id], ['='], false, false, 1); // "SELECT image,screenshots FROM data WHERE id = '$id' LIMIT 1";
        //debug($res);

        try {
          //$rename_file = false; // метка о переименовании файла
          $rename_dir = false; // метка о переименовании директории

          // определяем директория или файл сохранены в базе
          if (is_file($res['image'])) { // если в базе сохранен файл
            // если переданное имя директории не совпадает с именем директории в базе данных, то
            if ($image_path != dirname($res['image']).S) {
              if (@rename(dirname($res['image']).S,$image_path)) { // переименовываем старую директорию
                $rename_dir = true; // метка об успешном переименовании директории
              }
            }
            // если переданное имя файла не совпадает с именем файла в базе данных, то
            /*if ($image != basename($res['image'])) {
              if (@rename($res['image'],$image_path.$image)) { // переименовываем старый файл
                $rename_file = true; // метка об успешном переименовании файла
              }
            } */
          }
          if (is_dir($res['image'])) { // если в базе сохранена директория
            // устанавливаем в конце слеш, если его нет
            if (mb_substr($res['image'],-1,1,'utf-8') != '/') {
              $res['image'] = $res['image'].'/';
            }
            // если переданное имя директории не совпадает с именем директории в базе данных, то
            if ($image_path != $res['image']) {
              if (@rename($res['image'],$image_path)) { // переименовываем старую директорию
                $rename_dir = true; // метка об успешном переименовании директории
              }
            }
          }

          // если загружаемый файл присутствует, то загружаем его
          if (file_exists(UPLOAD.S.$image)) {
            $image_resize_obj = new ImageResize();
            //debug($image_resize_obj);
            $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'postthumbs'); // изменяем размер полученной картинки и получаем миниатюру
            //debug($destination);
            $this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
            $this->add_resized_file($destination); // добавляем полученный файл в базу данных
            $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
            if ($rename_dir) { //если папка была переименована
              @$this->del_img($image_path.basename($res['image'])); // удаляем ранее загруженную картинку и миниатюру из новой директории
            }
            else {
              @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру из старой директории
            }
          }
          else {
            // иначе имя и путь к файлу берутся из базы данных
            $image = basename($res['image']);
            // если получаемый файл отсутствует (либо он был удалён, либо ещё не загружен)
            if (!file_exists($image_path.$image)) {
              $image = '';
              @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру из старой директории
            }
            //if ($rename_dir) { //если папка была переименована
            //@del_img('../'.$res['image']); // удаляем ранее загруженную картинку и миниатюру из старой директории
            //}
          }

          if (!empty($screenshots)) {
            $screenshots_resize_obj = new ImageResize();
            $screenshots_array = explode(',',$screenshots);
            $db_screenshots_array = explode(',',$res['screenshots']);
            foreach($screenshots_array as $item) {
              if ($item == $image) continue; // если имя миниатюры совпадает с именем скриншота, то пропускаем
              if (file_exists(UPLOAD.S.$item)) { // если есть загружаемый исходный файл, то загружаем его
                $destination2 = $screenshots_resize_obj->resize(UPLOAD.S.$item,$image_path.$item,'postthumbs'); // изменяем размеры скриншотов и получаем миниатюру

                //debug($destination2);
                $this->delete_uploaded_file(UPLOAD.S.$item); // удаляем оригинальные файлы скриншотов
                $this->add_resized_file($destination2); // добавляем полученный файл в базу данных
                if (basename($destination2['image']) != $item) { // если после сохранения название скриншота изменилось
                  $screenshots = preg_replace('#'.$item.'#',basename($destination2['image']),$screenshots); // изменяем название скриншота (если вдруг его тип изменился)
                }
              }
              else {// иначе проверяем был ли файл загружен ранее
                if (!file_exists($image_path.$item)) { // если нет загруженного (конечного файла), удаляем скриншот
                  $screenshots = preg_replace('#(,){2,}#',',',preg_replace('#^(,)+|(,)+$#','',preg_replace('#'.$item.'#','',$screenshots))); // меняем строку из названий скриншотов
                  @$this->del_img($image_path.$item); // удаляем ранее загруженную картинку и миниатюру
                }
              }
            }
            foreach($db_screenshots_array as $val) { // перебираем все скриншоты из базы данных и удаляем лишние изображения
              if ($val == $image) continue; // если имя миниатюры совпадает с именем скриншота, то пропускаем
              if(!in_array($val,$screenshots_array)){ // если элемент массива скриншотов из базы данных не найден в массиве скриншотов, то
                @$this->del_img($image_path.$val); // удаляем ранее загруженную картинку и миниатюру
              }
            }
          }
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }
      // изменение размеров изображения и скриншотов и сохранение в нужную директорию (конец)

      /* Здесь вводятся данные в базу */

      $result = $this->update(
      'data',
      array('type','category','partner','secret','hidden','hide_link','comments','published','del','title','alias','description','keywords','author','date','view','rating','quantity_vote','image','size','screenshots','gallery_id','album_id','partner_link','transitions','download_link','downloaded','internet_link','internet_downloaded','buy_link','orders','price','hash','introduction','text'),
      array($type,$category,$partner,$secret,$hidden,$hide_link,$comments,$published,$del,$title,$alias,$description,$keywords,$author,$date,$view,$rating,$quantity_vote,$image_path.$image,$size,$screenshots,$gallery_id,$album_id,$partner_link,$transitions,$download_link,$downloaded,$internet_link,$internet_downloaded,$buy_link,$orders,$price,$hash,$introduction,$text),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE data SET type='$type', category='$category', partner='$partner', secret='$secret', hidden='$hidden', hide_link='$hide_link', comments='$comments', published='$published', del='$del', title='$title', alias='$alias', description='$description', keywords='$keywords', author='$author', date='$date', view='$view', rating='$rating', quantity_vote='$quantity_vote', image='$image_path.$image', size='$size', screenshots='$screenshots', gallery_id='$gallery_id', album_id='$album_id', partner_link='$partner_link', transitions='$transitions', download_link='$download_link', downloaded='$downloaded', internet_link='$internet_link', internet_downloaded='$internet_downloaded', buy_link='$buy_link', orders='$orders', price='$price', hash='$hash', introduction='$introduction', text='$text' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">'.$tp2.' успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения '.$tp1.' не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование новости/партнёрского продукта/закачки/товара/галереи/альбома === */

  /* === Удаление новости/партнёрского продукта/закачки/товара/галереи/альбома === */
  public function delete_post($id) {
    $type = 0;
    if (isset($_GET['type'])) {
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('page');
          $type = 0;
          $tp1 = "Материал успешно удалён";
          $tp2 = "Материал не удалён";
          break;
        case('news');
          $type = 1;
          $tp1 = "Новость успешно удалена";
          $tp2 = "Новость не удалена";
          break;
        case('partner_product');
          $type = 2;
          $tp1 = "Партнёрский продукт успешно удалён";
          $tp2 = "Партнёрский продукт не удалён";
          break;
        case('download');
          $type = 3;
          $tp1 = "Закачка успешно удалена";
          $tp2 = "Закачка не удалена";
          break;
        case('goods');
          $type = 4;
          $tp1 = "Товар успешно удалён";
          $tp2 = "Товар не удалён";
          break;
        case('gallery');
          $type = 5;
          $tp1 = "Галерея успешно удалена";
          $tp2 = "Галерея не удалена";
          break;
        case('album');
          $type = 6;
          $tp1 = "Альбом успешно удалён";
          $tp2 = "Альбом не удалён";
          break;
        case('post');
          $type = 7;
          $tp1 = "Заметка успешно удалена";
          $tp2 = "Заметка не удалена";
          break;
      }
    }

    // получаем имя картинки и скриншотов из базы данных
    // "SELECT image,screenshots FROM data WHERE id = '$id'";
    $res = $this->select(['image','screenshots'], 'data', ['id' => $id], ['='], false, false, 1); // "SELECT image,screenshots FROM data WHERE id = '$id' LIMIT 1";
    //debug($res);

    try{
      if (!empty($res['image'])) { // 1 - такой файл есть, 0 - нет
        @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
      }
      if (!empty($res['screenshots'])) {
        $screenshots_array = explode(',',$res['screenshots']);
        foreach($screenshots_array as $item) {
          @$this->del_img(dirname($res['image']).S.$item); // удаляем ранее загруженную картинку и миниатюру
        }
      }
      // определяем директория или файл сохранены в базе
      if (is_file($res['image'])) { // если в базе сохранён файл
        delete_file($res['image']); // очистка директории от файлов
        // если имя директории не является общей зарезервированной директорией, то удаляем директорию
        if (in_array(dirname($res['image']).S, ['images/pages/', 'images/data/', 'images/partner_products/', 'images/downloads/', 'images/goods/', 'images/galleries/', 'images/albums/', 'images/posts/'])) {
          @rmdir(dirname($res['image']).S); // полное удаление директории
        }
      }
      if (is_dir($res['image'])) { // если в базе сохранена директория
        // если имя директории не является общей зарезервированной директорией, то удаляем директорию
        if (in_array($res['image'], ['images/pages/','images/data/','images/partner_products/','images/downloads/','images/goods/','images/galleries/','images/albums/','images/posts/'])) {
          @rmdir($res['image']); // полное удаление директории
        }
      }
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }

    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'data',
      array('image','screenshots','published','del'),
      array('images/data/','',0,1),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE data SET image='images/data/', screenshots='', published='0', del='1' WHERE id='$id' LIMIT 1";
    // "DELETE FROM data WHERE id='$id'";

    /* Если данные успешно обновлены в базе данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">'.$tp1.' из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. '.$tp2.'!</div>';
      return false;
    }
  }
  /* === Удаление новости/партнёрского продукта/закачки/товара/галереи/альбома === */

  /* === Создание заметки === */
  public function create_post2() {
    $error = ''; // флаг проверки пустых полей
    $category = (int)$_POST['category']; if ($category == '') {unset($category);}
    $hidden = (int)$_POST['hidden']; if ($hidden == '') {$hidden = 0;}
    $published = (int)$_POST['published']; if ($published == '') {$published = 0;}
    $comments = (int)$_POST['comments']; if ($comments == '') {$comments = 0;}
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название заметки</li>';}
    $author = trim($_POST['author']); if ($author == '') {unset($author); $error = $error.'<li>Не введено имя автора заметки</li>';}
    $date = trim($_POST['date']); if ($date == '') {unset($date); $error = $error.'<li>Не введены дата и время создания заметки</li>';}
    $image = trim($_POST['image']); if ($image == '') {unset($image);}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён полный текст заметки с html-тэгами</li>';}

    $title = clear2($title);
    $author = clear2($author);
    $text = clear2($text);

    $_SESSION['create']['category'] = $category;
    $_SESSION['create']['hidden'] = $hidden;
    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['comments'] = $comments;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['date'] = $date;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['text'] = $text;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "INSERT INTO posts (category,hidden,published,comments,title,author,date,image,text) VALUES ('$category','$hidden','$published','$comments','$title','$author','$date','$image','$text')";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Новая заметка успешно создана в базе данных!</div>";
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Новая заметка не создана!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Создание заметки === */

  /* === Редактирование заметки === */
  public function edit_post2($id) {
    $error = ''; // флаг проверки пустых полей
    // $id = $_POST['id']; if ($id == '') {unset($id);}
    $category = (int)$_POST['category']; if ($category == '') {unset($category);}
    $hidden = (int)$_POST['hidden']; if ($hidden == '') {$hidden = 0;}
    $published = (int)$_POST['published']; if ($published == '') {$published = 0;}
    $comments = (int)$_POST['comments']; if ($comments == '') {$comments = 0;}
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название заметки</li>';}
    $author = trim($_POST['author']); if ($author == '') {unset($author); $error = $error.'<li>Не введено имя автора заметки</li>';}
    $date = trim($_POST['date']); if ($date == '') {unset($date); $error = $error.'<li>Не введены дата и время создания заметки</li>';}
    $image = trim($_POST['image']); if ($image == '') {unset($image);}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён полный текст '.$tp1.' с html-тэгами</li>';}

    $title = clear2($title);
    $author = clear2($author);
    $text = clear2($text);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "UPDATE posts SET category='$category', hidden='$hidden', published='$published', comments='$comments', title='$title', author='$author', date='$date', image='$image', text='$text' WHERE id='$id'";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Заметка успешно сохранена в базе данных со всеми изменениями!</div>";
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения заметки не сохранены!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Редактирование заметки === */

  /* === Удаление заметки === */
  public function delete_post2($id) {
    /* Здесь вводятся данные в базу */
    $query = "DELETE FROM posts WHERE id='$id'";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if (mysql_affected_rows() > 0) {
      $_SESSION['result'] = "<div class='success'>Заметка успешно удалена из базы данных!</div>";
      return true;
    }
    else {
      $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Заметка не удалена!</div>";
      return false;
    }
  }
  /* === Удаление заметки === */

  /* === Создание рубрики === */
  public function create_rub() {
    $error = ''; // флаг проверки пустых полей
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название рубрики</li>';}
    $description = trim($_POST['description']); if ($description == '') {unset($description); $error = $error.'<li>Не введено краткое описание рубрики (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if ($keywords == '') {unset($keywords); $error = $error.'<li>Не введены ключевые слова</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён полный текст рубрики с html-тэгами</li>';}

    $title = clear2($title);
    $description = clear2($description);
    $keywords = clear2($keywords);
    $text = clear2($text);

    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['description'] = $description;
    $_SESSION['create']['keywords'] = $keywords;
    $_SESSION['create']['text'] = $text;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "INSERT INTO headings (title,description,keywords,text) VALUES ('$title','$description','$keywords','$text')";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Новая рубрика успешно добавлена в базу данных!</div>";
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Новая рубрика не добавлена!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Создание рубрики === */

  /* === Редактирование рубрики === */
  public function edit_rub($id) {
    $error = ''; // флаг проверки пустых полей
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название рубрики</li>';}
    $description = trim($_POST['description']); if ($description == '') {unset($description); $error = $error.'<li>Не введено краткое описание рубрики (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if ($keywords == '') {unset($keywords); $error = $error.'<li>Не введены ключевые слова</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён полный текст рубрики с html-тэгами</li>';}

    $title = clear2($title);
    $description = clear2($description);
    $keywords = clear2($keywords);
    $text = clear2($text);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "UPDATE headings SET title='$title', description='$description', keywords='$keywords', text='$text' WHERE id='$id'";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Рубрика успешно сохранена в базе данных со всеми изменениями!</div>";
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения рубрики не сохранены!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Редактирование рубрики === */

  /* === Удаление рубрики === */
  public function delete_rub($id) {
    /* Запрос для проверки наличия заметок в удаляемой рубрике */
    $query = "SELECT id,title FROM data WHERE type='0' AND category='$id' ORDER BY id";
    $result_post = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    if (mysql_num_rows($result_post) > 0) {
      $post = "";
      while($row = mysql_fetch_assoc($result_post)){
        $post = $post."$row[id]. <a href='index.php?p=edit&amp;v=news&amp;id=$row[id]'>$row[title]</a><br>";
      }
      $_SESSION['result'] = "<div class='error'>Выбранную рубрику удалить невозможно, т.к. в ней имются заметки.<br>
       Для удаления рубрики их нужно распределить по другим рубрикам или удалить.<br><br><strong>Список заметок в данной рубрике:</strong><br>$post</div>";
      return false;
    }
    else {
      /* Здесь вводятся данные в базу */
      $query = "DELETE FROM headings WHERE id='$id'";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Рубрика успешно удалена из базы данных!</div>";
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Рубрика не удалена!</div>";
        return false;
      }
    }
  }
  /* === Удаление рубрики === */

  /* === Создание партнёра === */
  public function create_partner() {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введены имя и фамилия партнёра</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас партнёра</li>';}
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание партнёра (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/partners/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст страницы партнёра с html-тэгами</li>';}
    $view = 0;
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = 0; // удаление партнёра

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['alias'] = $alias;
    $_SESSION['create']['description'] = $description;
    $_SESSION['create']['keywords'] = $keywords;
    $_SESSION['create']['image'] = $image;
    //$_SESSION['create']['image_path'] = $image_path;
    $_SESSION['create']['text'] = $text;
    $_SESSION['create']['published'] = $published;

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {
        try {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'partner'); // изменяем размер полученной картинки
          //debug($destination);
          @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      // "INSERT INTO partners (title,published,description,keywords,image,text) VALUES ('$title','$published','$description','$keywords','$image_path$image','$text')";
      $partner_id = $this->insert(
        'partners',
        array('alias','title','description','keywords','image','text','view','published','del'),
        array($alias,$title,$description,$keywords,$image_path.$image,$text,$view,$published,$del),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($partner_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">Новый партнёр успешно добавлен в базу данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новый партнёр не добавлен!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание партнёра === */

  /* === Редактирование партнёра === */
  public function edit_partner($id) {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введены имя и фамилия партнёра</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас партнёра</li>';}
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание партнёра (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/partners/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст страницы партнёра с html-тэгами</li>';}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;}; // удаление партнёра

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {

        // получаем имя картинки из базы данных
        $res = $this->select(['image'], 'partners', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM partners WHERE id = '$id' LIMIT 1";
        //debug($res);

        try {
          // если загружаемый файл присутствует, то загружаем его
          if (file_exists(UPLOAD.S.$image)) {
            $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
            $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'partner'); // изменяем размер полученной картинки, опция partner устанавливает ширину миниатюры 250px
            //debug($destination);
            @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
            $this->add_resized_file($destination); // добавляем полученный файл в базу данных
            $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
            if (is_file($res['image'])) { //если есть старая картинка
              @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
            }
          }
          else {
            // иначе имя и путь к файлу берутся из базы данных
            $image = basename($res['image']);
            // если получаемый файл отсутствует (либо он был удалён, либо ещё не загружен)
            if (!file_exists($image_path.$image)) {
              $image = '';
            }
          }
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'partners',
        array('alias','title','description','keywords','image','text','view','published','del'),
        array($alias,$title,$description,$keywords,$image_path.$image,$text,$view,$published,$del),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE partners SET title='$title', published='$published', description='$description', keywords='$keywords', image='$image_path$image', text='$text' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Партнёр успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения партнёра не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование партнёра === */

  /* === Удаление партнёра === */
  public function delete_partner($id) {

    // получаем имя картинки и скриншотов из базы данных
    $res = $this->select(['image'], 'partners', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM partners WHERE id = '$id' LIMIT 1";
    //debug($res);

    try{
      if (!empty($res['image'])) { // 1 - такой файл есть, 0 - нет
        @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
      }
      // определяем директория или файл сохранены в базе
      //if (is_file($res['image'])) { // если в базе сохранён файл
      //  delete_file($res['image']); // очистка директории от файлов
      //}
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }

    /* Запрос для проверки наличия партнёрских продуктов у удаляемого партнёра */
    $result_post = $this->select(['id', 'title'], 'data', ['type' => 2, 'category' =>(int)$id], ['='], 'id', 'ASC');
    // "SELECT id,title FROM data WHERE type='1' AND category='$id' ORDER BY id ASC";
    //debug($result_post);
    if ($result_post > 0) {
      $post = '';
      foreach($result_post as $row){
        $post = $post.$row['id'].'<a href="'.ADMIN.S.$this->alias.S.'edit/'.$row['id'].'?type=partner_product">'.$row['title'].'</a><br>';
      }
      $_SESSION['result'] = '<div class="error">Выбранного партнёра удалить невозможно, т.к. у него имются партнёрские продукты.<br>
       Для удаления партнёра их нужно распределить по другим партнёрам или удалить.<br><br><strong>Список партнёрских продуктов у данного партнёра:</strong><br>'.$post.'</div>';
      return false;
    }
    else {
      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'partners',
        array('image','published','del'),
        array('images/partners/',0,1),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE partners SET image='images/partners/', published='0', del='1' WHERE id='$id' LIMIT 1";
      // "DELETE FROM partners WHERE id='$id'";

      /* Если данные успешно обновлены в базе данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Партнёр успешно удалён из базы данных!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Партнёр не удалён!</div>';
        return false;
      }
    }
  }
  /* === Удаление партнёра === */

  /* === Создание категории === */
  public function create_category() {
    $error = ''; // флаг проверки пустых полей

    //debug($_POST);

    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас категории</li>';}
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название категории</li>';}
    $parent = (int)$_POST['parent']; if (empty($parent)) {$parent = 0;} // $error = $error.'<li>Не выбрана родительская категория</li>';
    $position = (int)$_POST['position']; if (empty($position)) {$position = 0;} // $error = $error.'<li>Не выбрана позиция категории</li>';
    $menu = (int)$_POST['menu']; if (empty($menu)) {$menu = 0;} // не отображать категорию в меню
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание категории (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/categories/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст категории с html-тэгами</li>';}
    $view = 0;
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = 0; // удаление курса

    //$alias = clear($alias);
    $title = clear($title, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    $_SESSION['create']['type'] = $type;
    $_SESSION['create']['alias'] = $alias;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['parent'] = $parent;
    $_SESSION['create']['position'] = $position;
    $_SESSION['create']['menu'] = $menu;
    $_SESSION['create']['description'] = $description;
    $_SESSION['create']['keywords'] = $keywords;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['image_path'] = $image_path;
    $_SESSION['create']['text'] = $text;
    // $_SESSION['create']['view'] = $view;
    $_SESSION['create']['published'] = $published;
    // $_SESSION['create']['del'] = $del;

    /*
    debug($category);
    debug($hide_plink);
    debug($published);
    debug($title);
    debug($alias);
    debug($author);
    debug($image_path.$image);
    debug($text);
    debug($size);
    debug($year);
    debug($price);
    debug($author_price);
    debug($buy_link);
    debug($download_link);
    debug($partner_link);
    debug($hash);
    */

    // если все поля заполнены и ошибок нет
    if (empty($error)){

      // изменение размеров изображения и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {
        try {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'partner'); // изменяем размер полученной картинки, опция partner устанавливает ширину миниатюры на 250px
          //debug($destination);
          @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      // "INSERT INTO courses (secret,ref,title,link,short_link,transitions) VALUES ('$secret','$ref','$title','$link','$short_link','$transitions')";
      $category_id = $this->insert(
        'categories',
        array('type','alias','title','parent','position','menu','description','keywords','image','text','view','published','del'),
        array($type,$alias,$title,$parent,$position,$menu,$description,$keywords,$image_path.$image,$text,$view,$published,$del),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($category_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">Новая категория успешно создана в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новая категория не создана!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание категории === */

  /* === Редактирование категории === */
  public function edit_category($id) {
    $error = ''; // флаг проверки пустых полей

    //debug($_POST);

    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас категории</li>';}
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название категории</li>';}
    $parent = (int)$_POST['parent']; if (empty($parent)) {$parent = 0;} // $error = $error.'<li>Не выбрана родительская категория</li>';
    $position = (int)$_POST['position']; if (empty($position)) {$position = 0;} // $error = $error.'<li>Не выбрана позиция категории</li>';
    $menu = (int)$_POST['menu']; if (empty($menu)) {$menu = 0;} // не отображать категорию в меню
    $description = trim($_POST['description']); if (empty($description)) {$description = ''; $error = $error.'<li>Не введено краткое описание категории (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if (empty($keywords)) {$keywords = ''; $error = $error.'<li>Не введены ключевые слова</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/categories/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст категории с html-тэгами</li>';}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;}

    $title = clear($title, true, true, false, true, false, true);
    $description = clear($description, true, true, false, true, false, true);
    $keywords = clear($keywords, true, true, false, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // получаем имя картинки из базы данных
    $res = $this->select(['image'], 'categories', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM categories WHERE id = '$id' LIMIT 1";
    //debug($res);

    try {
      // если загружаемый файл присутствует, то загружаем его
      if (file_exists(UPLOAD.S.$image)) {
        $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
        $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'partner'); // изменяем размер полученной картинки, опция partner устанавливает ширину миниатюры на 250px
        //debug($destination);
        @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
        $this->add_resized_file($destination); // добавляем полученный файл в базу данных
        $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
        if (is_file($res['image'])) { //если есть старая картинка
          @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
        }
      }
      else {
        // иначе имя и путь к файлу берутся из базы данных
        $image = basename($res['image']);
        // если получаемый файл отсутствует (либо он был удалён, либо ещё не загружен)
        if (!file_exists($image_path.$image)) {
          $image = '';
        }
      }
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }

    // если все поля заполнены и ошибок нет
    if (empty($error)) {
      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'categories',
        array('type','alias','title','parent','position','menu','description','keywords','image','text','view','published','del'),
        array($type,$alias,$title,$parent,$position,$menu,$description,$keywords,$image_path.$image,$text,$view,$published,$del),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE categories SET type='$type', alias='$alias', title='$title', position='$position', menu='$menu', description='$description', keywords='$keywords', image='image_path.$image', text='$text', view='$view',  published='$published', del='$del' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Категория успешно сохранена в базе данных со всеми изменениями!</div>';
        return true;
      } else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения категории не сохранены!</div>';
        return false;
      }
    } else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование категории === */

  /* === Удаление раздела === */
  public function delete_category($id) {
    /* Запрос для проверки наличия закачек в удаляемом разделе */
    $result_post = $this->select(['id','title'],
        'data',
        ['category' => (int)$id, 'del' => 0],
        ['='],
        'id',
        'ASC'
      );
    // "SELECT id,title FROM data WHERE category='$id' AND del='0' ORDER BY id";
    if ($result_post > 0) {
      $posts = '';
      foreach($result_post as $item){
        $posts = $posts.'<a href="'.ADMIN.S.'post/edit/'.$item['id'].'" target="self">'.$item['id'].' - '.$item['title'].'</a><br>';
      }
      $_SESSION['result'] = '<div class="error">Выбранную категорию удалить невозможно, т.к. в ней имются материалы.<br>
       Для удаления выбранной категории, материалы, содержащиеся в этой категории нужно распределить по другим разделам или удалить.<br><br><strong>Список материалов в данной категории:</strong><br>'.$posts.'</div>';
      return false;
    }
    else {

      // получаем имя картинки и скриншотов из базы данных
      $res = $this->select(['image'], 'categories', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM categories WHERE id = '$id' LIMIT 1";
      //debug($res);

      try{
        if (!empty($res['image'])) { // 1 - такой файл есть, 0 - нет
          @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
        }
        // определяем директория или файл сохранены в базе
        //if (is_file($res['image'])) { // если в базе сохранён файл
        //  delete_file($res['image']); // очистка директории от файлов
        //}
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }

      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'categories',
        array('image','published','del'),
        array('images/categories/',0,1),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE categories SET image='images/categories/', published='0', del='1' WHERE id='$id' LIMIT 1";
      // "DELETE FROM categories WHERE id='$id'";

      /* Если данные успешно обновлены в базе данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Категория успешно удалена из базы данных!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Категория не удалена!</div>';
        return false;
      }
    }
  }
  /* === Удаление раздела === */

  /* === Создание комментария === */
  public function create_comment() {
    $error = ''; // флаг проверки пустых полей

    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = 0;
    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    $post = (int)$_POST['post']; if (empty($post)) {$post = 1;}
    $gallery = (int)$_POST['gallery']; if (empty($gallery)) {$gallery = 0;}
    $image = (int)$_POST['image']; if (empty($image)) {$image = 0;}
    $album = (int)$_POST['album']; if (empty($album)) {$album = 0;}
    $parent = (int)$_POST['parent']; if (empty($parent)) {$parent = 0;}
    $user = (int)$_POST['user']; if (empty($user)) {$user = 0;}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора комментария</li>';}
    $email = trim($_POST['email']); if (empty($email)) {$email = ''; $error = $error.'<li>Не введён e-mail автора комментария</li>';}
    $site = trim($_POST['site']); if (empty($site)) {$site = '';}
    $date = trim($_POST['date']); if (empty($date)) {$date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания комментария</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст комментария</li>';}

    // проверка идентификаторов поста, галереи, изображения, альбомов, родительского комментария, пользователя
    $totlal_posts = $this->count_elements('data','id');
    if ($post > $totlal_posts) {
      $post = $totlal_posts;
      $album = $totlal_posts;
    }
    $totlal_galleries = $this->count_elements('galleries','id');
    if ($gallery > $totlal_galleries) {
      $gallery = $totlal_galleries;
    }
    $totlal_images = $this->count_elements('gimages','id');
    if ($image > $totlal_images) {
      $image = $totlal_images;
    }
    /* $totlal_albums = $this->count_elements('data','id');
    if ($album > $totlal_albums) {
      $album = $totlal_albums;
    } */
    $totlal_parent = $this->count_elements('comments','id');
    if ($parent > $totlal_parent) {
      $parent = $totlal_parent;
    }
    $totlal_users = $this->count_elements('users','id');
    if ($user > $totlal_users) {
      $user = $totlal_users;
    }

    $text = clear($text, false, false, false, true, false, false);
    $author = clear($author, true, true, true, true, false, true);

    $_SESSION['create']['published'] = $published;
    //$_SESSION['create']['type'] = $type;
    $_SESSION['create']['post'] = $post;
    $_SESSION['create']['gallery'] = $gallery;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['album'] = $album;
    $_SESSION['create']['parent'] = $parent;
    $_SESSION['create']['user'] = $user;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['email'] = $email;
    $_SESSION['create']['site'] = $site;
    $_SESSION['create']['date'] = $date;
    $_SESSION['create']['text'] = $text;

    // проверка е-mail адреса регулярными выражениями на корректность
    $email = validate($email, 'email');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка сайта регулярными выражениями на корректность
    $site = validate($site, 'url');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $comment_id = $this->insert(
        'comments',
        array('published','del','type','post','gallery','image','album','parent','user','author','email','site','date','text'),
        array($published,$del,$type,$post,$gallery,$image,$album,$parent,$user,$author,$email,$site,$date,$text),
        true
      );
      // "INSERT INTO comments (published,post,gallery,image,album,parent,user,author,email,site,date,text) VALUES ('$published','$post','$gallery','$image','$album','$parent','$user','$author','$email','$site','$date','$text')";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($comment_id > 0){ // если запись добавлена, получаем id комментария по последней вставленной записи
        $_SESSION['result'] = '<div class="success">Новый комментарий успешно создан в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новый комментарий не создан!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание комментария === */

  /* === Редактирование комментария === */
  public function edit_comment($id) {
    $error = ''; // флаг проверки пустых полей

    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;}
    $type = (int)$_POST['type']; if (empty($type)) {$type = 0;}
    $post = (int)$_POST['post']; if (empty($post)) {$post = 1;}
    $gallery = (int)$_POST['gallery']; if (empty($gallery)) {$gallery = 0;}
    $image = (int)$_POST['image']; if (empty($image)) {$image = 0;}
    $album = (int)$_POST['album']; if (empty($album)) {$album = 0;}
    $parent = (int)$_POST['parent']; if (empty($parent)) {$parent = 0;}
    $user = (int)$_POST['user']; if (empty($user)) {$user = 0;}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора комментария</li>';}
    $email = trim($_POST['email']); if (empty($email)) {$email = ''; $error = $error.'<li>Не введён e-mail автора комментария</li>';}
    $site = trim($_POST['site']); if (empty($site)) {$site = '';}
    $date = trim($_POST['date']); if (empty($date)) {$date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания комментария</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст комментария</li>';}

    // проверка идентификаторов поста, галереи, изображения, альбомов, родительского комментария, пользователя
    $totlal_posts = $this->count_elements('data','id');
    if ($post > $totlal_posts) {
      $post = $totlal_posts;
      $album = $totlal_posts;
    }
    $totlal_galleries = $this->count_elements('galleries','id');
    if ($gallery > $totlal_galleries) {
      $gallery = $totlal_galleries;
    }
    $totlal_images = $this->count_elements('gimages','id');
    if ($image > $totlal_images) {
      $image = $totlal_images;
    }
    /* $totlal_albums = $this->count_elements('data','id');
    if ($album > $totlal_albums) {
      $album = $totlal_albums;
    } */
    $totlal_parent = $this->count_elements('comments','id');
    if ($parent > $totlal_parent) {
      $parent = $totlal_parent;
    }
    $totlal_users = $this->count_elements('users','id');
    if ($user > $totlal_users) {
      $user = $totlal_users;
    }

    $text = clear($text, false, false, false, true, false, false);
    $author = clear($author, true, true, true, true, false, true);

    // проверка е-mail адреса регулярными выражениями на корректность
    $email = validate($email, 'email');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка сайта регулярными выражениями на корректность
    $site = validate($site, 'url');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'comments',
        array('published','del','type','post','gallery','image','album','parent','user','author','email','site','date','text'),
        array($published,$del,$type,$post,$gallery,$image,$album,$parent,$user,$author,$email,$site,$date,$text),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE comments SET published='$published', post='$post', gallery='$gallery', image='$image', album='$album', parent='$parent', user='$user', author='$author', email='$email', site='$site', date='$date', text='$text' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Комментарий успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения комментария не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование комментария === */

  /* === Удаление комментария === */
  public function delete_comment($id) {
    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'comments',
      array('published','del'),
      array(0,1),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE comments SET published='0', del='1' WHERE id='$id' LIMIT 1";
    // "DELETE FROM comments WHERE id='$id'";

    /* Если данные успешно обновлены в базе данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Комментарий успешно удалён из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Комментарий не удалён!</div>';
      return false;
    }
  }
  /* === Удаление комментария === */

  /* === Создание комментария 2 === */
  public function create_comment2() {
    $error = ''; // флаг проверки пустых полей
    $published = (int)$_POST['published']; if ($published == '') {$published = 0;}
    $post = (int)$_POST['post']; if ($post == '') {$post = 1;}
    $author = trim($_POST['author']); if ($author == '') {unset($author); $error = $error.'<li>Не введено имя автора комментария 2</li>';}
    $email = trim($_POST['email']); if ($email == '') {unset($email); $error = $error.'<li>Не введён e-mail автора комментария 2</li>';}
    $site = trim($_POST['site']); if ($site == '') {unset($site);}
    $date = trim($_POST['date']); if ($date == '') {unset($date); $error = $error.'<li>Не введены дата и время создания комментария 2</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён текст комментария 2</li>';}

    $totlal_posts = count_total_posts();
    if ($post > $totlal_posts) {
      $post = $totlal_posts;
    }

    $author = clear2($author);
    $text = clear2($text);

    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['post'] = $post;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['email'] = $email;
    $_SESSION['create']['site'] = $site;
    $_SESSION['create']['date'] = $date;
    $_SESSION['create']['text'] = $text;

    // проверка е-mail адреса регулярными выражениями на корректность
    if (!preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $email)) {
      // if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) { - альтернативная проверка из примера
      $error = $error.'<li>Введён неверный e-mail автора комментария 2</li>';
    }
    // проверка сайта регулярными выражениями на корректность
    if ($site != "" and !preg_match("/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i", $site)) {
      $error = $error.'<li>Введён неверный адрес сайта автора комментария 2</li>';
    }
    // проверяем введенные данные и чистим от ссылок е-майл, чистим неверный адрес сайта
    $email = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $email);
    $site = preg_replace('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', '', $site);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "INSERT INTO comments2 (published,post,author,email,site,date,text) VALUES ('$published','$post','$author','$email','$site','$date','$text')";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Новый комментарий 2 успешно создан в базе данных!</div>";
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Новый комментарий 2 не создан!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы возникли следующие ошибки:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Создание комментария 2 === */

  /* === Редактирование комментария 2 === */
  public function edit_comment2($id) {
    $error = ''; // флаг проверки пустых полей
    $published = (int)$_POST['published']; if ($published == '') {$published = 0;}
    $post = (int)$_POST['post']; if ($post == '') {$post = 1;}
    $author = trim($_POST['author']); if ($author == '') {unset($author); $error = $error.'<li>Не введено имя автора комментария 2</li>';}
    $email = trim($_POST['email']); if ($email == '') {unset($email); $error = $error.'<li>Не введён e-mail автора комментария 2</li>';}
    $site = trim($_POST['site']); if ($site == '') {unset($site);}
    $date = trim($_POST['date']); if ($date == '') {unset($date); $error = $error.'<li>Не введены дата и время создания комментария 2</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён текст комментария 2</li>';}

    $totlal_post2 = count_total_posts();
    if ($post > $totlal_post2) {
      $post = $totlal_post2;
    }

    $author = clear2($author);
    $text = clear2($text);

    // проверка е-mail адреса регулярными выражениями на корректность
    if (!preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $email)) {
      // if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) { - альтернативная проверка из примера
      $error = $error.'<li>Введён неверный e-mail автора комментария 2</li>';
    }
    // проверка сайта регулярными выражениями на корректность
    if ($site != "" and !preg_match("/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i", $site)) {
      $error = $error.'<li>Введён неверный адрес сайта автора комментария 2</li>';
    }
    // проверяем введенные данные и чистим от ссылок е-майл, чистим неверный адрес сайта
    $email = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $email);
    $site = preg_replace('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', '', $site);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "UPDATE comments2 SET published='$published', post='$post', author='$author', email='$email', site='$site', date='$date', text='$text' WHERE id='$id'";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Комментарий 2 успешно сохранён в базе данных со всеми изменениями!</div>";
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения комментария 2 не сохранены!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы возникли следующие ошибки:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Редактирование комментария === */

  /* === Удаление комментария 2 === */
  public function delete_comment2($id) {
    /* Здесь вводятся данные в базу */
    $query = "DELETE FROM comments2 WHERE id='$id'";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if (mysql_affected_rows() > 0) {
      $_SESSION['result'] = "<div class='success'>Комментарий 2 успешно удалён из базы данных!</div>";
      return true;
    }
    else {
      $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Комментарий 2 не удалён!</div>";
      return false;
    }
  }
  /* === Удаление комментария 2 === */

  /* === Создание мудрой фразы === */
  public function create_phrase() {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст мудрой фразы</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора фразы</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = 'fon.jpg';}
    $color = trim($_POST['color']); if (empty($color)) {$color = '#ffffff';}
    $view = 0; // количество просмотров
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = 0; // удаление фразы

    $text = clear($text, false, false, false, true, false, false);
    $author = clear($author, true, true, true, true, false, true);

    $_SESSION['create']['text'] = $text;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['color'] = $color;
    // $_SESSION['create']['view'] = $view;
    $_SESSION['create']['published'] = $published;
    // $_SESSION['create']['del'] = $del;

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and ($image != 'fon.jpg')) {
        $image_path = 'images/phrases/'; // дефолтный путь для фоновых картинок мудрых фраз

        try {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'noresize'); // изменяем размер полученной картинки, опция noresize просто копирует файл картинки в нужную директории без изменений
          //debug($destination);
          @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }


      /* Здесь вводятся данные в базу */
      $phrase_id = $this->insert(
        'phrases',
        array('text','author','image','color','view','published','del'),
        array($text,$author,$image,$color,$view,$published,$del),
        true
      );
      // "INSERT INTO phrases (text,author,image,color,view,published,del) VALUES ('$text','$author','$image','$color','$view','$published','$del')";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($phrase_id > 0){ // если запись добавлена, получаем id фразы по последней вставленной записи
        $_SESSION['result'] = '<div class="success">Новая фраза успешно добавлена в базу данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новая фраза не добавлена!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }

  }
  /* === Создание мудрой фразы === */

  /* === Редактирование мудрой фразы === */
  public function edit_phrase($id) {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст мудрой фразы</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора фразы</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = 'fon.jpg';}
    $color = trim($_POST['color']); if (empty($color)) {$color = '#ffffff';}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;} // количество просмотров
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;} // удаление фразы

    $text = clear($text, false, false, false, false, false, false);
    $author = clear($author, true, true, true, true, false, true);

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and ($image != 'fon.jpg')) {

        // получаем имя картинки из базы данных
        $res = $this->select(['image'], 'phrases', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM phrases WHERE id = '$id' LIMIT 1";
        //debug($res);
        $image_path = 'images/phrases/'; // дефолтный путь для фоновых картинок мудрых фраз

        try {
          // если загружаемый файл присутствует, то загружаем его
          if (file_exists(UPLOAD.S.$image)) {
            $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
            $destination = $image_resize_obj->resize(UPLOAD.S.$image, $image_path.$image, 'noresize'); // изменяем размер полученной картинки, опция noresize копирует исходное изображение без изменений, миниатюра не создается
            //debug($destination);
            @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
            $this->add_resized_file($destination); // добавляем полученный файл в базу данных
            $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
            if ((is_file($res['image'])) and ($res['image'] != 'fon.jpg')) { // если есть старая картинка, и она не равна дефолтной
              @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
            }
          } else {
            // иначе имя и путь к файлу берутся из базы данных
            $image = $res['image'];
            // если получаемый файл отсутствует (либо он был удалён, либо ещё не загружен)
            if (!file_exists($image_path.$image)) {
              $image = '';
            }
          }
        } catch (Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'phrases',
        array('text','author','image','color','view','published','del'),
        array($text,$author,$image,$color,$view,$published,$del),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE phrases SET text='$text', author='$author', image='$image', color='$color', view='$view', published='$published', del='$del' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Фраза успешно сохранена в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения фразы не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование мудрой фразы === */

  /* === Удаление мудрой фразы === */
  public function delete_phrase($id) {
    // получаем имя картинки и скриншотов из базы данных
    $res = $this->select(['image'], 'phrases', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM phrases WHERE id = '$id' LIMIT 1";
    //debug($res);
    $image_path = 'images/phrases/'; // дефолтный путь для фоновых картинок мудрых фраз

    try{
      if ((!empty($res['image'])) and ($res['image'] != 'fon.jpg')) { // 1 - такой файл есть, 0 - нет
        @$this->del_img($image_path.$res['image']); // удаляем ранее загруженную картинку и миниатюру
      }
      // определяем директория или файл сохранены в базе
      //if ((is_file($image_path.$res['image'])) and ($res['image'] != 'fon.jpg')) { // если в базе сохранён файл
      //  delete_file($image_path.$res['image']); // очистка директории от файлов
      //}
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }

    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'phrases',
      array('image','published','del'),
      array('fon.jpg',0,1),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE phrases SET image='fon.jpg', published='0', del='1' WHERE id='$id' LIMIT 1";
    // "DELETE FROM phrases WHERE id='$id' LIMIT 1";

    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Фраза успешно удалена из базы данных!</div>';
      return true;
    } else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Фраза не удалена!</div>';
      return false;
    }
  }
  /* === Удаление мудрой фразы === */

  /* === Создание пользователя === */
  public function create_user() {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $first_name = trim($_POST['first_name']); if (empty($first_name)) {$first_name = ''; $error = $error.'<li>Не введено имя пользователя</li>';}
    $last_name = trim($_POST['last_name']); if (empty($last_name)) {$last_name = ''; $error = $error.'<li>Не введена фамилия пользователя</li>';}
    $login = trim($_POST['login']); if (empty($login)) {$login = ''; $error = $error.'<li>Не введён логин пользователя</li>';}
    $password = trim($_POST['password']); if (empty($password)) {$password = ''; $error = $error.'<li>Не введён пароль пользователя</li>';}
    $avatar = trim($_POST['avatar']); if (empty($avatar)) {$avatar = ''; $error = $error.'<li>Не введён полный путь к картинке-аватару</li>';}
    $photo = ''; // фотография из соц сетей, если есть
    $phone = trim($_POST['phone']); if (empty($phone)) {$phone = ''; $error = $error.'<li>Не введён номер телефона пользователя</li>';}
    $email = trim($_POST['email']); if (empty($email)) {$email = ''; $error = $error.'<li>Не введён e-mail пользователя</li>';}
    $site = trim($_POST['site']); if (empty($site)) {$site = '';}
    $activation = (int)$_POST['activation']; if (empty($activation)) {$activation = 0;}
    $status = (int)$_POST['status']; if (empty($status)) {$status = 3;}
    $method = 0; // регистрация и авторизация через сайт rolar.ru
    $social_id = ''; // ID в социальной сети
    $reg_date = trim($_POST['reg_date']); if (empty($reg_date)) {$reg_date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания пользователя</li>';}
    $login_date = trim($_POST['login_date']); if (empty($login_date)) {$login_date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время авторизации пользователя</li>';}
    $birthday = trim($_POST['birthday']); if (empty($birthday)) {$birthday = '1970-01-01';}
    $gender = trim($_POST['gender']); if (empty($gender)) {$gender = 0;}
    $ip = '127.0.0.1'; //ip-адрес
    $letter_type = trim($_POST['letter_type']); if (empty($letter_type)) {$letter_type = 0;}
    $view = 0; // количество просмотров

    $first_name = clear($first_name, true, true, true, true, false, true);
    $last_name = clear($last_name, true, true, true, true, false, true);
    $login = clear($login,true, true, true, true, false, true);
    // $password = clear($password);

    $_SESSION['create']['first_name'] = $first_name;
    $_SESSION['create']['last_name'] = $last_name;
    $_SESSION['create']['login'] = $login;
    $_SESSION['create']['password'] = $password;
    $_SESSION['create']['avatar'] = $avatar;
    $_SESSION['create']['phone'] = $phone;
    $_SESSION['create']['email'] = $email;
    $_SESSION['create']['site'] = $site;
    $_SESSION['create']['activation'] = $activation;
    $_SESSION['create']['status'] = $status;
    $_SESSION['create']['reg_date'] = $reg_date;
    $_SESSION['create']['login_date'] = $login_date;
    $_SESSION['create']['birthday'] = $birthday;
    $_SESSION['create']['gender'] = $gender;
    $_SESSION['create']['letter_type'] = $letter_type;

    // Проверка (валидация) и обработка полученных данных
    // если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($first_name, 2, 30)) {
      $error = $error.'<li>Имя должно состоять не менее чем из 2-х символов и не более чем из 30</li>';
    }
    if (!check_length($last_name, 2, 30)) {
      $error = $error.'<li>Фамилия должна состоять не менее чем из 2-х символов и не более чем из 30</li>';
    }
    // если длина логина меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($login, 3, 15)) {
      $error = $error.'<li>Логин должен состоять не менее чем из 3-х символов и не более чем из 15</li>';
    }
    // если длина пароля меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($password, 3, 15)) {
      $error = $error.'<li>Пароль должен состоять не менее чем из 3-х символов и не более чем из 15</li>';
    }

    // если имя, логин, пароль, е-майл введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $first_name = validate($first_name,'name');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $last_name = validate($last_name,'name');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $login = validate($login, 'login');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $password = validate($password, 'password');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $email = validate($email, 'email');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка сайта регулярными выражениями на корректность
    $site = validate($site, 'url');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка даты рождения регулярными выражениями
    $birthday = validate($birthday, 'date');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }

    // если пароль совпадает с логином или электронной почтой, то выдаём ошибку
    if (($password == $login) or ($password == $email)) {
      $error = $error.'<li>Пароль не должен совпадать с логином или адресом электронной почты. Введите другой пароль</li>';
    }

    // Шифрование пароля
    // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
    // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
    $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa
    // шифруем пароль (старая версия)
    //$shifr_password = md5($password);
    // для надежности добавим реверс
    //$shifr_password = strrev($shifr_password);
    // можно добавить несколько своих символов по вкусу, например, вписав "b3p6f". Если этот пароль будут взламывать методом подбора у себя на сервере этой же md5, то явно ничего хорошего не выйдет. Но советую ставить другие символы, можно в начале строки или в середине
    // $shifr_password = "g96vnh5p".$shifr_password."xr3qf8a5";
    // При этом необходимо увеличить длину поля password в базе. Зашифрованный пароль может получится гораздо большего размера

    //$method = 0; // способ авторизации через сайт rolar.ru

    //$view = 0; // количество просмотров

    //$ip = '127.0.0.1'; //ip-адрес

    // Проверка логина на уникальность (проверка на существование пользователя с таким же логином)
    $result_login = $this->select(['id'],'users', ['login' => $login], ['='], false, false, 1);
    // "SELECT id FROM users WHERE login='$login' LIMIT 1";
    if (!empty($result_login['id'])) {
      $error = $error.'<li>Пользователь с логином <strong>'.$login.'</strong> уже зарегистрирован на сайте. Введите другой логин</li>';
    }

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      // "INSERT INTO users (first_name,last_name,login,password,avatar,email,site,activation,status,method,reg_date,login_date,birthday,gender,ip,letter_type,view) VALUES ('$first_name','$last_name','$login','$shifr_password','$avatar','$email','$site','$activation','$status','$method','$reg_date','$login_date','$birthday','$gender','$ip','$letter_type','$view')";

      $user_id = $this->insert(
        'users',
        array('first_name','last_name','login','password','avatar','photo','phone','email','site','activation','status','method','social_id','reg_date','login_date','birthday','gender,ip','letter_type','view'),
        array($first_name,$last_name,$login,$shifr_password,$avatar,$photo,$phone,$email,$site,$activation,$status,$method,$social_id,$reg_date,$login_date,$birthday,$gender,$ip,$letter_type,$view),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($user_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">Новый пользователь успешно добавлен в базу данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новый пользователь не добавлен!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание пользователя === */

  /* === Редактирование пользователя === */
  public function edit_user($id) {
    $error = ''; // флаг проверки пустых полей
    //debug($_POST);

    $old_login = $_POST['old_login']; if (empty($old_login)) {$old_login = '';}

    $first_name = trim($_POST['first_name']); if (empty($first_name)) {$first_name = ''; $error = $error.'<li>Не введено имя пользователя</li>';}
    $last_name = trim($_POST['last_name']); if (empty($last_name)) {$last_name = ''; $error = $error.'<li>Не введена фамилия пользователя</li>';}
    $login = trim($_POST['login']); if (empty($login)) {$login = ''; $error = $error.'<li>Не введён логин пользователя</li>';}
    // $password = trim($_POST['password']); if (empty($password)) {$password = ''; $error = $error.'<li>Не введён пароль пользователя</li>';}
    $avatar = trim($_POST['avatar']); if (empty($avatar)) {$avatar = ''; $error = $error.'<li>Не введён полный путь к картинке-аватару</li>';}
    //$photo = ''; // фотография из соц сетей, если есть
    $phone = trim($_POST['phone']); if (empty($phone)) {$phone = ''; $error = $error.'<li>Не введён номер телефона пользователя</li>';}
    $email = trim($_POST['email']); if (empty($email)) {$email = ''; $error = $error.'<li>Не введён e-mail пользователя</li>';}
    $site = trim($_POST['site']); if (empty($site)) {$site = '';}
    $activation = (int)$_POST['activation']; if (empty($activation)) {$activation = 0;}
    $status = (int)$_POST['status']; if (empty($status)) {$status = 3;}
    //$method = (int)$_POST['method']; if (empty($method)) {$method = 0;}; // регистрация и авторизация через сайт rolar.ru
    $social_id = trim($_POST['social_id']); if (empty($social_id)) {$social_id = '';}; // ID в социальной сети
    $reg_date = trim($_POST['reg_date']); if (empty($reg_date)) {$reg_date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания пользователя</li>';}
    $login_date = trim($_POST['login_date']); if (empty($login_date)) {$login_date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время авторизации пользователя</li>';}
    $birthday = trim($_POST['birthday']); if (empty($birthday)) {$birthday = '1970-01-01';}
    $gender = (int)$_POST['gender']; if (empty($gender)) {$gender = 0;}
    $ip = trim($_POST['ip']); if (empty($ip)) {$ip = '127.0.0.1';}; //ip-адрес
    $letter_type = trim($_POST['letter_type']); if (empty($letter_type)) {$letter_type = 0;}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;} // количество просмотров

    // если имя/фамилия, логин, е-майл введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $first_name = clear($first_name, true, true, true, true, false, true);
    $last_name = clear($last_name, true, true, true, true, false, true);
    $login = clear($login,true, true, true, true, false, true);
    // $password = clear($password);

    // Проверка (валидация) и обработка полученных данных
    // если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($first_name, 2, 30)) {
      $error = $error.'<li>Имя должно состоять не менее чем из 2-х символов и не более чем из 30</li>';
    }
    if (!check_length($last_name, 2, 30)) {
      $error = $error.'<li>Фамилия должна состоять не менее чем из 2-х символов и не более чем из 30</li>';
    }
    // если длина логина меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($login, 3, 15)) {
      $error = $error.'<li>Логин должен состоять не менее чем из 3-х символов и не более чем из 15</li>';
    }


    // если имя, логин, пароль, е-майл введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $first_name = validate($first_name,'name');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $last_name = validate($last_name,'name');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $login = validate($login, 'login');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    $email = validate($email, 'email');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка сайта регулярными выражениями на корректность
    $site = validate($site, 'url');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }
    // проверка даты рождения регулярными выражениями
    $birthday = validate($birthday, 'date');
    if (isset($_SESSION['message'])) {
      $error = $error.'<li>'.$_SESSION['message'].'</li>'; unset($_SESSION['message']);
    }

    /* Если логин изменился, то проверяем новый логин на сходство с уже существующими логинами */
    if ($login != $old_login) {
      /* Проверка логина на наличие уже существующих */
      // проверка на существование пользователя с таким же логином
      $result_login = $this->select(['id'],'users', ['login' => $login], ['='], false, false, 1);
      // "SELECT id FROM users WHERE login='$login' LIMIT 1";
      if (!empty($result_login['id'])) {
        $error = $error.'<li>Пользователь с логином <strong>'.$login.'</strong> уже зарегистрирован на сайте. Введите другой логин</li>';
      }
    }

    // если все поля заполнены и ошибок нет
    if(empty($error)){

      /* Здесь вводятся данные в базу */
      // "UPDATE users SET first_name='$first_name', last_name='$last_name', login='$login', avatar='$avatar', photo='$photo', phone='$phone', email='$email', site='$site', activation='$activation', status='$status', method='$method', social_id='$social_id', reg_date='$reg_date', login_date='$login_date', birthday='$birthday', gender='$gender', ip='$ip', letter_type='$letter_type', view='$view' WHERE id='$id' LIMIT 1";
      $result = $this->update(
        'users',
        array('first_name','last_name','login','avatar','phone','email','site','activation','status','social_id','reg_date','login_date','birthday','gender','ip','letter_type','view'),
        array($first_name,$last_name,$login,$avatar,$phone,$email,$site,$activation,$status,$social_id,$reg_date,$login_date,$birthday,$gender,$ip,$letter_type,$view),
        array('id' => (int)$id),
        array('='),
        1
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Пользователь успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения пользователя не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование пользователя === */

  /* === Сброс пароля пользователя === */
  public function password_reset($id) {
    // Пароль по умолчанию
    $password = 111;

    // шифруем пароль
    // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
    // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
    $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa
    // шифруем пароль (старая версия)
    // $shifr_password = md5($password);
    // для надежности добавим реверс
    // $shifr_password = strrev($shifr_password);
    // можно добавить несколько своих символов по вкусу, например, вписав "b3p6f". Если этот пароль будут взламывать методом подбора у себя на сервере этой же md5, то явно ничего хорошего не выйдет. Но советую ставить другие символы, можно в начале строки или в середине
    // $shifr_password = "g96vnh5p".$shifr_password."xr3qf8a5";
    // При этом необходимо увеличить длину поля password в базе. Зашифрованный пароль может получится гораздо большего размера

    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'users',
      array('password'),
      array($shifr_password),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE users SET password='$shifr_password' WHERE id='$id' LIMIT 1";

    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Пароль пользователя успешно сброшен на пароль по умолчанию!</div>';
      return true;
    } else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Пароль пользователя не изменён!</div>';
      return false;
    }
  }
  /* === Сброс пароля пользователя === */

  /* === Установка способа авторизации через rolar.ru === */
  public function method_reset($id) {
    $method = 0; // Авторизация чере rolar.ru
    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'users',
      array('photo','method','social_id'),
      array(null, $method, null),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE users SET photo=NULL, method='$method', social_id=NULL WHERE id='$id' LIMIT 1";

    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Способ авторизации установлен через сайт Rolar.ru!</div>';
      return true;
    } else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Способ авторизации пользователя не изменён!</div>';
      return false;
    }
  }
  /* === Установка способа авторизации через rolar.ru === */

  /* === Удаление пользователя === */
  public function delete_user($id) {
    $status = 0; // Статус пользователя 0 - Удалён

    $result = $this->update(
      'users',
      array('activation','status'),
      array(0,$status),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE users SET activation=0, status='$status' WHERE id='$id' LIMIT 1";
    // "DELETE FROM users WHERE id='$id' LIMIT 1";

    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Пользователь успешно удалён из базы данных!</div>';
      return true;
    } else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Пользователь не удалён!</div>';
      return false;
    }

  }
  /* === Удаление пользователя === */

  /* === Создание сообщения === */
  public function create_message() {
    $error = ''; // флаг проверки пустых полей

    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора сообщения</li>';}
    $addressee = $_POST['addressee']; if (empty($addressee)) {$addressee = ''; $error = $error.'<li>Не выбран получатель (адресат) сообщения</li>';}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $date = trim($_POST['date']); if (empty($date)) {$date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания сообщения</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст сообщения</li>';}
    if (isset($_POST['all_users'])) {$all_users = true; $_SESSION['create']['all_users'] = $all_users;} // групповая отправка сообщения всем пользователям

    $author = clear($author, true, true, true, true, false, true);
    // $text = clear($text, true, true, true, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['addressee'] = $addressee;
    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['date'] = $date;
    $_SESSION['create']['text'] = $text;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $message_id = $this->insert(
        'messages',
        array('author','addressee','published','date','text'),
        array($author,$addressee,$published,$date,$text),
        true
      );
       // "INSERT INTO messages (author,addressee,published,date,text) VALUES ('$author','$addressee','$published','$date','$text')";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($message_id > 0){ // если запись добавлена, получаем id комментария по последней вставленной записи
        $_SESSION['result'] = '<div class="success">Новое сообщение успешно создано в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новое сообщение не создано!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание сообщения === */

  /* === Редактирование сообщения === */
  public function edit_message($id) {
    $error = ''; // флаг проверки пустых полей
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора сообщения</li>';}
    $addressee = $_POST['addressee']; if (empty($addressee)) {$addressee = ''; $error = $error.'<li>Не выбран получатель (адресат) сообщения</li>';}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $date = trim($_POST['date']); if (empty($date)) {$date = '1970-01-01 00:00:00'; $error = $error.'<li>Не введены дата и время создания сообщения</li>';}
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён текст сообщения</li>';}
    if (isset($_POST['all_users'])) {$all_users = true; $_SESSION['create']['all_users'] = $all_users;} // групповая отправка сообщения всем пользователям

    $author = clear($author, true, true, true, true, false, true);
    // $text = clear($text, true, true, true, true, false, true);
    $text = clear($text, false, false, false, true, false, false);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'messages',
        array('author','addressee','published','date','text'),
        array($author,$addressee,$published,$date,$text),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE messages SET author='$author', addressee='$addressee', published='$published', date='$date', text='$text' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Сообщение успешно сохранено в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения сообщения не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы возникли следующие ошибки:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование сообщения === */

  /* === Удаление сообщения === */
  public function delete_message($id) {
    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'messages',
      array('published'),
      array(0),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE messages SET published='0' WHERE id='$id' LIMIT 1";
    // "DELETE FROM messages WHERE id='$id' LIMIT 1";

    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Сообщение успешно удалено из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Сообщение не удалено!</div>';
      return false;
    }
  }
  /* === Удаление сообщения === */

  /* === Создание курса === */
  public function create_course() {
    $error = ''; // флаг проверки пустых полей

    //debug($_POST);

    $category = (int)$_POST['category']; if (empty($category)) {$category = 1;}
    $hide_plink = (int)$_POST['hide_plink']; if (empty($hide_plink)) {$hide_plink = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название курса</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас курса</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора курса</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} // $error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/courses/';} // $error = $error.'<li>Не введён полный путь к картинке</li>';
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст курса с html-тэгами</li>';}
    $view = 0;
    $size = (int)$_POST['size']; if (empty($size)) {$size = 0;} // $error = $error.'<li>Не введён размер прикреплённых файлов</li>';
    $year = (int)$_POST['year']; if (empty($year)) {$year = 2000;} // $error = $error.'<li>Не введён год выпуска курса</li>';
    $price = (int)$_POST['price']; if (empty($price)) {$price = 0; $error = $error.'<li>Не введена цена курса</li>';}
    $author_price = (int)$_POST['author_price']; if (empty($author_price)) {$author_price = 0;}
    $buy_link = trim($_POST['buy_link']); if (empty($buy_link)) {$buy_link = ''; $error = $error.'<li>Не введён адрес ссылки для оформления заказа</li>';}
    $orders = 0;
    $download_link = trim($_POST['download_link']); if (empty($download_link)) {$download_link = ''; $error = $error.'<li>Не введён адрес ссылки для скачивания</li>';}
    $downloaded = 0;
    $partner_link = trim($_POST['partner_link']); if (empty($partner_link)) {$partner_link = '';}
    $transitions = 0;
    $hash = generate_hash(); // функция для генерации хеша для скачивания файлов
    $del = 0; // удаление курса

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $author = clear($author, true, true, false, true, false, true);
    $text = clear($text, false, false, false, false, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    $_SESSION['create']['category'] = $category;
    $_SESSION['create']['hide_plink'] = $hide_plink;
    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['alias'] = $alias;
    $_SESSION['create']['author'] = $author;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['image_path'] = $image_path;
    $_SESSION['create']['text'] = $text;
    // $_SESSION['create']['view'] = $view;
    $_SESSION['create']['size'] = $size;
    $_SESSION['create']['year'] = $year;
    $_SESSION['create']['price'] = $price;
    $_SESSION['create']['author_price'] = $author_price;
    $_SESSION['create']['buy_link'] = $buy_link;
    // $_SESSION['create']['orders'] = $orders;
    $_SESSION['create']['download_link'] = $download_link;
    // $_SESSION['create']['downloaded'] = $downloaded;
    $_SESSION['create']['partner_link'] = $partner_link;
    // $_SESSION['create']['transitions'] = $transitions;
    // $_SESSION['create']['hash'] = $hash;
    // $_SESSION['create']['del'] = $del;

    /*
    debug($category);
    debug($hide_plink);
    debug($published);
    debug($title);
    debug($alias);
    debug($author);
    debug($image_path.$image);
    debug($text);
    debug($size);
    debug($year);
    debug($price);
    debug($author_price);
    debug($buy_link);
    debug($download_link);
    debug($partner_link);
    debug($hash);
    */

    // если все поля заполнены и ошибок нет
    if (empty($error)){

      // изменение размеров изображения и скриншотов и сохранение в нужную директорию
      if ((!empty($image)) and (!empty($image_path))) {
        try {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'width', 790); // изменяем размер полученной картинки, опция width пропорционально уменьшает изображение до нужной ширины, если ширина больше заданной или больше дефолтной 1024, миниатюра не создается
          //debug($destination);
          @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
        }
        catch(Exception $e) {
          echo $e->getMessage();
        }
      }

      /* Здесь вводятся данные в базу */
      // "INSERT INTO courses (secret,ref,title,link,short_link,transitions) VALUES ('$secret','$ref','$title','$link','$short_link','$transitions')";
      $course_id = $this->insert(
        'courses',
        array('category','hide_plink','published','title','alias','author','image','text','view','size','year','price','author_price','buy_link','orders','download_link','downloaded','partner_link','transitions','hash','del'),
        array($category,$hide_plink,$published,$title,$alias,$author,$image_path.$image,$text,$view,$size,$year,$price,$author_price,$buy_link,$orders,$download_link,$downloaded,$partner_link,$transitions,$hash,$del),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($course_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">Новый курс успешно создан в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новый курс не создан!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание курса === */

  /* === Редактирование курса === */
  public function edit_course($id) {
    $error = ''; // флаг проверки пустых полей

    //debug($_POST);

    $category = (int)$_POST['category']; if (empty($category)) {$category = 1;}
    $hide_plink = (int)$_POST['hide_plink']; if (empty($hide_plink)) {$hide_plink = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $del = (int)$_POST['del']; if (empty($del)) {$del = 0;}; // удаление курса
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название курса</li>';}
    $alias = trim($_POST['alias']); if (empty($alias)) {$alias = ''; $error = $error.'<li>Не введён алиас курса</li>';}
    $author = trim($_POST['author']); if (empty($author)) {$author = ''; $error = $error.'<li>Не введено имя автора курса</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = '';} //$error = $error.'<li>Не введёно название картинки</li>';
    $image_path = trim($_POST['image_path']); if (empty($image_path)) {$image_path = 'images/courses/';} //$error = $error.'<li>Не введён полный путь к картинке</li>';
    $text = trim($_POST['text']); if (empty($text)) {$text = ''; $error = $error.'<li>Не введён полный текст курса с html-тэгами</li>';}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;}
    $size = (int)$_POST['size']; if (empty($size)) {$size = 0;} // $error = $error.'<li>Не введён размер прикреплённых файлов</li>';
    $year = (int)$_POST['year']; if (empty($year)) {$year = 2000;} // $error = $error.'<li>Не введён год выпуска курса</li>';
    $price = (int)$_POST['price']; if (empty($price)) {$price = 0; $error = $error.'<li>Не введена цена курса</li>';}
    $author_price = (int)$_POST['author_price']; if (empty($author_price)) {$author_price = 0;}
    $buy_link = trim($_POST['buy_link']); if (empty($buy_link)) {$buy_link = ''; $error = $error.'<li>Не введён адрес ссылки для оформления заказа</li>';}
    $orders = (int)$_POST['orders']; if (empty($orders)) {$orders = 0;}
    $download_link = trim($_POST['download_link']); if (empty($download_link)) {$download_link = ''; $error = $error.'<li>Не введён адрес ссылки для скачивания</li>';}
    $downloaded = (int)$_POST['downloaded']; if (empty($downloaded)) {$downloaded = 0;}
    $partner_link = trim($_POST['partner_link']); if (empty($partner_link) or $partner_link == 'http://') {$partner_link = '';}
    $transitions = (int)$_POST['transitions']; if (empty($transitions)) {$transitions = 0;}
    $hash = trim($_POST['hash']); if (empty($hash)) {$hash = generate_hash();} // функция для генерации хеша для скачивания файлов

    $title = clear($title, true, true, false, true, false, true);
    $alias = clear($alias, true, true, false, true, false, true);
    $author = clear($author, true, true, false, true, false, true);
    $text = clear($text, false, false, false, false, false, false);

    if (mb_substr($image_path,-1,1,'utf-8') != '/') {
      $image_path = $image_path.'/';
    }
    //echo '$image_path = '.$image_path.'<br>';

    // если все поля заполнены и ошибок нет
    if (empty($error)) {

      // получаем имя картинки из базы данных
      $res = $this->select(['image'], 'courses', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM courses WHERE id = '$id' LIMIT 1";
      //debug($res);

      try {
        // если загружаемый файл присутствует, то загружаем его
        if (file_exists(UPLOAD.S.$image)) {
          $image_resize_obj = new ImageResize(); // Core::$core->ImageResize();
          $destination = $image_resize_obj->resize(UPLOAD.S.$image,$image_path.$image,'width', 790); // изменяем размер полученной картинки, опция width пропорционально уменьшает изображение до нужной ширины, если ширина больше заданной или больше дефолтной 1024, миниатюра не создается
          //debug($destination);
          @$this->delete_uploaded_file(UPLOAD.S.$image); // удаляем загруженный файл
          $this->add_resized_file($destination); // добавляем полученный файл в базу данных
          $image = basename($destination['image']); // переопределение названия картинки (если вдруг его тип изменился)
          if (is_file($res['image'])) { //если есть старая картинка
            @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
          }
        }
        else {
          // иначе имя и путь к файлу берутся из базы данных
          $image = basename($res['image']);
          // если получаемый файл отсутствует (либо он был удалён, либо ещё не загружен)
          if (!file_exists($image_path.$image)) {
            $image = '';
          }
        }
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }

      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'courses',
        array('category','hide_plink','published','title','alias','author','image','text','view','size','year','price','author_price','buy_link','orders','download_link','downloaded','partner_link','transitions','hash','del'),
        array($category,$hide_plink,$published,$title,$alias,$author,$image_path.$image,$text,$view,$size,$year,$price,$author_price,$buy_link,$orders,$download_link,$downloaded,$partner_link,$transitions,$hash,$del),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE courses SET category='$category', hide_plink='$hide_plink', published='$published', title='$title', alias='$alias', author='$author', image='image_path.$image', text='$text', view='$view', size='$size', year='$year', price='$price', author_price='$author_price', buy_link='$buy_link', orders='$orders', download_link='$download_link', downloaded='$downloaded', partner_link='$partner_link', transitions='$transitions', hash='$hash', del='$del' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Курс успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      } else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения курса не сохранены!</div>';
        return false;
      }
    } else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование курса === */
  /* === Удаление курса === */
  public function delete_course($id) {
    // получаем имя картинки и скриншотов из базы данных
    $res = $this->select(['image'], 'courses', ['id' => $id], ['='], false, false, 1); // "SELECT image FROM courses WHERE id = '$id' LIMIT 1";
    //debug($res);

    try{
      if (!empty($res['image'])) { // 1 - такой файл есть, 0 - нет
        @$this->del_img($res['image']); // удаляем ранее загруженную картинку и миниатюру
      }
      // определяем директория или файл сохранены в базе
      //if (is_file($res['image'])) { // если в базе сохранён файл
      //  delete_file($res['image']); // очистка директории от файлов
      //}
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }

    $result = $this->update(
      'courses',
      array('images','published','del'),
      array('images/courses/',0,1),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE courses SET image='images/courses/', published='0', del='1' WHERE id='$id' LIMIT 1";
    // "DELETE FROM courses WHERE id='$id' LIMIT 1";

    /* Если данные успешно обновлены в базе данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Курс успешно удалён из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Курс не удалён!</div>';
      return false;
    }
  }
  /* === Удаление курса === */

  /* === Создание ссылки === */
  public function create_link() {
    $error = ''; // флаг проверки пустых полей
    $secret = (int)$_POST['secret']; if (empty($secret)) {$secret = 0;}
    $ref = (int)$_POST['ref']; if (empty($ref)) {$ref = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название ссылки</li>';}
    $link = trim($_POST['link']); if (empty($link) or $link == 'http://') {$link = ''; $error = $error.'<li>Не введён адрес ссылки</li>';}
    $short_link = generate_string(PERMITTED_CHARS, 8); // trim($_POST['short_link']); if ($short_link == '') {unset($short_link);} // короткая ссылка генерируется автоматически
    $transitions = 0;

    $title = clear($title, true, true, false, true, false, true);

    $_SESSION['create']['secret'] = $secret;
    $_SESSION['create']['ref'] = $ref;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['link'] = $link;
    //$_SESSION['create']['short_link'] = $short_link;
    $_SESSION['create']['transitions'] = $transitions;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      // "INSERT INTO links (secret,ref,title,link,short_link,transitions) VALUES ('$secret','$ref','$title','$link','$short_link','$transitions')";
      $link_id = $this->insert(
        'links',
        array('secret','ref','published','title','link','short_link','transitions'),
        array($secret,$ref,$published,$title,$link,$short_link,$transitions),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($link_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
        $_SESSION['result'] = '<div class="success">Новая ссылка успешно создана в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новая ссылка не создана!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание ссылки === */

  /* === Редактирование ссылки === */
  public function edit_link($id) {
    $error = ''; // флаг проверки пустых полей
    $secret = (int)$_POST['secret']; if (empty($secret)) {$secret = 0;}
    $ref = (int)$_POST['ref']; if (empty($ref)) {$ref = 0;}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название ссылки</li>';}
    $link = trim($_POST['link']); if (empty($link) or $link == 'http://') {$link = ''; $error = $error.'<li>Не введён адрес ссылки</li>';}
    $short_link = trim($_POST['short_link']); if (empty($short_link)) {$short_link = generate_string(PERMITTED_CHARS, 8);} // короткая ссылка генерируется автоматически
    $transitions = (int)$_POST['transitions']; if (empty($transitions)) {$transitions = 0;}

    $title = clear($title, true, true, false, true, false, true);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */

      $result = $this->update(
        'links',
        array('secret','ref','published', 'title', 'link', 'short_link','transitions'),
        array($secret, $ref, $published, $title, $link, $short_link, $transitions),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE links SET secret='$secret', ref='$ref', published='$published', title='$title', link='$link', short_link='$short_link', transitions='$transitions' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Ссылка успешно сохранена в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения ссылки не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование ссылки === */

  /* === Удаление ссылки === */
  public function delete_link($id) {
    $result = $this->update(
      'links',
      array('published'),
      array(0),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE links SET published='0' WHERE id='$id' LIMIT 1";
    // "DELETE FROM links WHERE id='$id' LIMIT 1";

    /* Если данные успешно обновлены в базе данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Ссылка успешно удалена из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Ссылка не удалена!</div>';
      return false;
    }
  }
  /* === Удаление ссылки === */

  /* === Создание баннера === */
  public function create_banner() {
    $error = ''; // флаг проверки пустых полей

    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название баннера</li>';}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $type = (int)$_POST['type']; if (empty($type)) {$type = 1;}
    $link = trim($_POST['link']); if (empty($link) or $link == 'http://') {$link = ''; $error = $error.'<li>Не введён адрес баннера</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = ''; $error = $error.'<li>Не введён полный путь к изображению или flash-ролику</li>';}
    $view = 0;
    $click = 0;

    $title = clear($title, true, true, false, true, false, true);

    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['published'] = $published;
    $_SESSION['create']['type'] = $type;
    $_SESSION['create']['link'] = $link;
    $_SESSION['create']['image'] = $image;
    $_SESSION['create']['view'] = $view;
    $_SESSION['create']['click'] = $click;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      // "INSERT INTO banners (title,published,type,link,image,view,click) VALUES ('$title','$published','$type','$link','$image','$view','$click')";
      $banner_id = $this->insert(
        'banners',
        array('title','published','type','link','image','view','click'),
        array($title,$published,$type,$link,$image,$view,$click),
        true
      );

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($banner_id > 0){
        $_SESSION['result'] = '<div class="success">Новый баннер успешно создан в базе данных!</div>';
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Новый баннер не создан!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Создание баннера === */

  /* === Редактирование баннера === */
  public function edit_banner($id) {
    $error = ''; // флаг проверки пустых полей

    $title = trim($_POST['title']); if (empty($title)) {$title = ''; $error = $error.'<li>Не введено название баннера</li>';}
    $published = (int)$_POST['published']; if (empty($published)) {$published = 0;}
    $type = (int)$_POST['type']; if (empty($type)) {$type = 1;}
    $link = trim($_POST['link']); if (empty($link) or $link == 'http://') {$link = ''; $error = $error.'<li>Не введён адрес баннера</li>';}
    $image = trim($_POST['image']); if (empty($image)) {$image = ''; $error = $error.'<li>Не введён полный путь к изображению или flash-ролику</li>';}
    $view = (int)$_POST['view']; if (empty($view)) {$view = 0;}
    $click = (int)$_POST['click']; if (empty($click)) {$click = 0;};

    $title = clear($title, true, true, false, true, false, true);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $result = $this->update(
        'banners',
        array('title','published','type','link','image','view','click'),
        array($title,$published,$type,$link,$image,$view,$click),
        array('id' => (int)$id),
        array('='),
        1
      );
      // "UPDATE banners SET title='$title', published='$published', type='$type', link='$link', image='$image', view='$view', click='$click' WHERE id='$id' LIMIT 1";

      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if ($result == true) {
        $_SESSION['result'] = '<div class="success">Баннер успешно сохранён в базе данных со всеми изменениями!</div>';
        return true;
      }
      else {
        $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения баннера не сохранены!</div>';
        return false;
      }
    }
    else {
      $_SESSION['result'] = '<div class="error">В ходе заполнения формы заполнены не все необходимые поля:<ul>'.$error.'</ul></div>';
      return false;
    }
  }
  /* === Редактирование баннера === */

  /* === Удаление баннера === */
  public function delete_banner($id) {
    /* Здесь вводятся данные в базу */
    $result = $this->update(
      'banners',
      array('published'),
      array(0),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE banners SET published='0' WHERE id='$id' LIMIT 1";
    // "DELETE FROM banners WHERE id='$id' LIMIT 1";

    /* Если данные успешно обновлены в базе данных, то выводим сообщение */
    if ($result == true) {
      $_SESSION['result'] = '<div class="success">Баннер успешно удалён из базы данных!</div>';
      return true;
    }
    else {
      $_SESSION['result'] = '<div class="error">Произошла ошибка при обращении к базе данных. Баннер не удалён!</div>';
      return false;
    }
  }
  /* === Удаление баннера === */

  /* === Создание страницы === */
  public function create_page() {
    $error = ''; // флаг проверки пустых полей
    $page = trim($_POST['page']); if ($page == '') {unset($page); $error = $error.'<li>Не введён идентификатор страницы</li>';}
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название страницы</li>';}
    $description = trim($_POST['description']); if ($description == '') {unset($description); $error = $error.'<li>Не введено краткое описание страницы (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if ($keywords == '') {unset($keywords); $error = $error.'<li>Не введены ключевые слова</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён текст страницы с html-тэгами</li>';}
    $view = 0;

    $title = clear2($title);
    $description = clear2($description);
    $keywords = clear2($keywords);
    $text = clear2($text);

    $_SESSION['create']['page'] = $page;
    $_SESSION['create']['title'] = $title;
    $_SESSION['create']['description'] = $description;
    $_SESSION['create']['keywords'] = $keywords;
    $_SESSION['create']['text'] = $text;
    $_SESSION['create']['view'] = $view;

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "INSERT INTO pages (page,title,description,keywords,text,view) VALUES ('$page','$title','$description','$keywords','$text','$view')";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Новая страница успешно создана в базе данных!</div>";
        unset($_SESSION['create']);
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Новая страница не создана!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Создание страницы === */

  /* === Редактирование страницы === */
  public function edit_page($id) {
    $error = ''; // флаг проверки пустых полей
    $page = trim($_POST['page']); if ($page == '') {unset($page); $error = $error.'<li>Не введён идентификатор страницы</li>';}
    $title = trim($_POST['title']); if ($title == '') {unset($title); $error = $error.'<li>Не введено название страницы</li>';}
    $description = trim($_POST['description']); if ($description == '') {unset($description); $error = $error.'<li>Не введено краткое описание страницы (для SEO)</li>';}
    $keywords = trim($_POST['keywords']); if ($keywords == '') {unset($keywords); $error = $error.'<li>Не введены ключевые слова</li>';}
    $text = trim($_POST['text']); if ($text == '') {unset($text); $error = $error.'<li>Не введён текст страницы с html-тэгами</li>';}
    $view = (int)$_POST['view']; if ($view == '') {$view = 0;}

    $title = clear2($title);
    $description = clear2($description);
    $keywords = clear2($keywords);
    $text = clear2($text);

    // если все поля заполнены и ошибок нет
    if(empty($error)){
      /* Здесь вводятся данные в базу */
      $query = "UPDATE pages SET page='$page', title='$title', description='$description', keywords='$keywords', text='$text', view='$view' WHERE id='$id'";
      $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
      /* Если данные успешно сохранены в базу данных, то выводим сообщение */
      if (mysql_affected_rows() > 0) {
        $_SESSION['result'] = "<div class='success'>Страница успешно сохранена в базе данных со всеми изменениями!</div>";
        return true;
      }
      else {
        $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных, либо Вы ничего не меняли. Все изменения страницы не сохранены!</div>";
        return false;
      }
    }
    else {
      $_SESSION['result'] = "<div class='error'>В ходе заполнения формы заполнены не все необходимые поля:<ul>$error</ul></div>";
      return false;
    }
  }
  /* === Редактирование страницы === */

  /* === Удаление страницы === */
  public function delete_page($id) {
    /* Здесь вводятся данные в базу */
    $query = "DELETE FROM pages WHERE id='$id'";
    $result = mysql_query($query) or die($error = "<p>Запрос на выборку данных из базы не прошёл. Напишите об этом администратору <a href='mailto:".ADMINEMAIL."' target='_blank'>".ADMINEMAIL."</a>.<br><strong>Код ошибки: </strong></p>".mysql_error());
    /* Если данные успешно сохранены в базу данных, то выводим сообщение */
    if (mysql_affected_rows() > 0) {
      $_SESSION['result'] = "<div class='success'>Страница успешно удалена из базы данных!</div>";
      return true;
    }
    else {
      $_SESSION['result'] = "<div class='error'>Произошла ошибка при обращении к базе данных. Страница не удалена!</div>";
      return false;
    }
  }
  /* === Удаление страницы === */



// функция для добавления загруженного файла в БД
  public function add_uploaded_file($result = array()){
    if ((!is_array($result)) or (empty($result))) {
      return false;
    }

    //pr($result);
    $file_name = $result['file'];
    $original_file_name = $result['files']['name'];
    $file_extension = getExtension($file_name); // $result['file'];
    $mime_type = $result['files']['type']; // getMimeTypeOfExtension($file_extension);
    $type = $result['type']; //getFileType($file_name);
    $upload_dir = $result['uploaddir'];
    $file_size = $result['files']['size'];
    $date = date("Y-m-d H:i:s");
    $user = 1;
    $downloaded = 0;
    $published = 1;
    $hidden = 0;
    $del = 0;
    $md5 = md5_file($upload_dir.S.$file_name);
    $sha1 = sha1_file($upload_dir.S.$file_name);

    // ищем совпадения хешей md5 и sha1
    $res = $this->select(['id','name','path'], 'files', ['md5' => $md5, 'sha1' => $sha1], ['='], false, false, 1);
    // "SELECT id, name, path FROM files WHERE md5 = '$md5' AND sha1 = '$sha1' LIMIT 1";

    if ((int)$res['id'] > 0) { // 1 - такой файл есть, 0 - нет
      // если загружаемый файл был загружен ранее, то удаляем старый файл и обновляем данные
      if ($res['name'] != $file_name) {
        delete_file($res['path'].S.$res['name']);
      }
      $result = $this->update(
        'files',
        array('name','original_name','extension','mime_type','type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
        array($file_name,$original_file_name,$file_extension,$mime_type,$type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
        array('id' => (int)$res['id']),
        array('='),
        1
      );
      // "UPDATE files SET name='$file_name',original_name='$original_file_name',extension='$file_extension',mime_type='$mime_type',type='$type',path='$upload_dir',size='$file_size',date='$date',user='$user',downloaded='$downloaded',published='$published',hidden='$hidden',del='$del',md5='$md5',sha1='$sha1' WHERE id='$res[id]' LIMIT 1";
    }
    else {
      $result = $this->insert(
        'files',
        array('name','original_name','extension','mime_type','type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
        array($file_name,$original_file_name,$file_extension,$mime_type,$type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
        false
      );
      // "INSERT INTO files (name, original_name, extension, mime_type, type, path, size, date, user, downloaded, published, hidden, del, md5, sha1) VALUES ('$file_name','$original_file_name','$file_extension','$mime_type','$type','$upload_dir','$file_size','$date','$user','$downloaded','$published','$hidden','$del','$md5','$sha1')";
    }

    return true;
  }

// функция для удаления одиночного загруженного файла в БД
  public function delete_uploaded_file($source = ''){
    if (empty($source)) {
      return false;
    }

    $img = basename($source);
    //debug($img);
    $upload_dir = pathinfo($source,PATHINFO_DIRNAME);
    if (empty($upload_dir)) {
      $upload_dir = UPLOAD; // 'uploads';
    }
    //debug($upload_dir);

    // ищем совпадения имени файла и директории
    $res = $this->select(['id'], 'files', ['name' => $img, 'path' => $upload_dir], ['='], false, false, 1);
    // "SELECT id FROM files WHERE name = '$img' AND path = '$upload_dir' LIMIT 1";
    //debug($res);

    if (!empty($res)) {  // если такой файл есть (массив не пуст), то обновляем данные в таблице files - устанавливаем метку об удалении
      $result = $this->update(
        'files',
        array('published','del'),
        array(0,1),
        array('id' => (int)$res['id']),
        array('='),
        1
      );
      // "UPDATE files SET published='0', del='1' WHERE id='$res[id]' LIMIT 1";
    }

    // удаляем загруженный файл
    delete_file($source); // ($upload_dir.'/'.$img)
    return true;
  }

// функция для добавления изменёного (полученного) файла в БД
  public function add_resized_file($destination = array()){
    if ((!is_array($destination)) or (empty($destination))) {
      return false;
    }

    $file_name = basename($destination['image']);
    $original_file_name = $file_name;
    $file_extension = pathinfo($destination['image'],PATHINFO_EXTENSION);
    $mime_type = Core::$core->FileUpload->getMimeTypeOfExtension($file_extension);
    $type = 'image';
    $upload_dir = pathinfo($destination['image'],PATHINFO_DIRNAME);
    $file_size = filesize($destination['image']);

    $date = date("Y-m-d H:i:s");
    $user = 1;
    $downloaded = 0;
    $published = 1;
    $hidden = 0;
    $del = 0;

    $md5 = md5_file($destination['image']);
    $sha1 = sha1_file($destination['image']);

    // ищем совпадения хешей md5 и sha1
    $res = $this->select(['id','name','path'], 'files', ['md5' => $md5, 'sha1' => $sha1], ['='], false, false, 1);
    // "SELECT id, name, path FROM files WHERE md5 = '$md5' AND sha1 = '$sha1' LIMIT 1";

    if (!empty($res)) { // если такой файл есть (массив не пуст)
      // если загружаемый файл был загружен ранее, то удаляем старый файл и обновляем данные
      if ($res['name'] != $file_name) {
        delete_file($res['path'].S.$res['name']);
      }

      $result = $this->update(
        'files',
        array('name','extension','mime_type','type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
        array($file_name,$file_extension,$mime_type,$type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
        array('id' => (int)$res['id']),
        array('='),
        1
      );
      // "UPDATE files SET name='$file_name',extension='$file_extension',mime_type='$mime_type',type='$type',path='$upload_dir',size='$file_size',date='$date',user='$user',downloaded='$downloaded',published='$published',hidden='$hidden',del='$del',md5='$md5',sha1='$sha1' WHERE id='$res[id]' LIMIT 1";
    }
    else {
      $result = $this->insert(
        'files',
        array('name','original_name','extension','mime_type','type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
        array($file_name,$original_file_name,$file_extension,$mime_type,$type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
        false
      );
      // "INSERT INTO files (name,original_name,extension,mime_type,type,path,size,date,user,downloaded,published,hidden,del,md5,sha1) VALUES ('$file_name','$original_file_name','$file_extension','$mime_type','$type','$upload_dir','$file_size','$date','$user','$downloaded','$published','$hidden','$del','$md5','$sha1')";
    }

    if (isset($destination['thumb'])) {
      $file_name = basename($destination['thumb']);
      $original_file_name = $file_name;
      $file_extension = pathinfo($destination['thumb'],PATHINFO_EXTENSION);
      $mime_type = Core::$core->FileUpload->getMimeTypeOfExtension($file_extension);
      $type = 'thumb';
      $upload_dir = pathinfo($destination['thumb'],PATHINFO_DIRNAME);
      $file_size = filesize($destination['thumb']);

      $md5 = md5_file($destination['thumb']);
      $sha1 = sha1_file($destination['thumb']);

      // ищем совпадения хешей md5 и sha1
      $res = $this->select(['id','name','path'], 'files', ['md5' => $md5, 'sha1' => $sha1], ['='], false, false, 1);
      // "SELECT id, name, path FROM files WHERE md5 = '$md5' AND sha1 = '$sha1' LIMIT 1";

      if (!empty($res)) { // если такой файл есть (массив не пуст)
        // если загружаемый файл был загружен ранее, то удаляем старый файл и обновляем данные
        if ($res['name'] != $file_name) {
          delete_file($res['path'].S.$res['name']);
        }
        $result = $this->update(
          'files',
          array('name','extension','mime_type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
          array($file_name,$file_extension,$mime_type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
          array('id' => (int)$res['id']),
          array('='),
          1
        );
        // "UPDATE files SET name='$file_name',extension='$file_extension',mime_type='$mime_type',path='$upload_dir',size='$file_size',date='$date',user='$user',downloaded='$downloaded',published='$published',hidden='$hidden',del='$del',md5='$md5',sha1='$sha1' WHERE id='$res[id]' LIMIT 1";
      }
      else {
        $result = $this->insert(
          'files',
          array('name','original_name','extension','mime_type','type','path','size','date','user','downloaded','published','hidden','del','md5','sha1'),
          array($file_name,$original_file_name,$file_extension,$mime_type,$type,$upload_dir,$file_size,$date,$user,$downloaded,$published,$hidden,$del,$md5,$sha1),
          false
        );
        // "INSERT INTO files (name, original_name, extension, mime_type, type, path, size, date, user, downloaded, published, hidden, del, md5, sha1) VALUES ('$file_name','$original_file_name','$file_extension','$mime_type','$type','$upload_dir','$file_size','$date','$user','$downloaded','$published','$hidden','$del','$md5','$sha1')";
      }
    }
    return true;
  }
// функция для добавления изменёного (полученного) файла в БД (конец)


  /* ===Удаление картинок=== */
  public function del_img($source = null){
    //$post_id = (int)$_POST['post_id'];
    if (empty($source)) {
      $img = (string)$_POST['img']; // получаем имя картинки
    }
    else {
      $img = basename($source);
    }
    //$rel = (string)$_POST['rel']; // получаем тип картинки - галерея или одиночное изображение
    $source = preg_replace('#'.D.'#','',$source); // чистим источник от домена

    $thumb = pathinfo($img,PATHINFO_FILENAME).'_th.'.@pathinfo($img,PATHINFO_EXTENSION);

    $upload_dir = pathinfo($source,PATHINFO_DIRNAME);
    if (empty($upload_dir)) {
      $upload_dir = UPLOAD; // 'uploads';
    }
    if(!file_exists($upload_dir)) { // Проверяем на существование папку $upload_dir
      return false;
      //$result = 'Ошибка: директория '.$upload_dir.' не найдена. Файл '.$img.' не удалён.';
      //exit($result);
    }

    if((file_exists($source)) and (is_file($source))) { // если удаляемый файл существует
      $md5 = @md5_file($source); // ($upload_dir.'/'.$img);
      $sha1 = @sha1_file($source); // ($upload_dir.'/'.$img);
      $where = ['name' => $img, 'md5' => $md5, 'sha1' => $sha1];
    }
    else {
      $where = ['name' => $img, 'path' => $upload_dir];
    }

    // ищем совпадения имени файла и хешей md5 и sha1
    $res = $this->select(['id'],
      'files',
      $where,
      ['='],
      false,
      false,
      1
    );
    // "SELECT id FROM files WHERE name='$img' AND md5='$md5' AND sha1='$sha1' LIMIT 1";
    // "SELECT id FROM files WHERE name='$img' AND path='$upload_dir' LIMIT 1";

    if (!empty($res)) { // если такой файл есть (массив не пуст)
      $this->update(
        'files',
        array('published','del'),
        array(0,1),
        array('id' => (int)$res['id']),
        array('='),
        1
      );
      // "UPDATE files SET published='0',del='1' WHERE id='$res[id]' LIMIT 1";
    }

    if ((file_exists($upload_dir.S.$thumb)) and (is_file($upload_dir.S.$thumb))) { // если есть миниатюра
      // чистка базы даннх от эскизов миниатюр
      $md5_th = md5_file($upload_dir . S . $thumb); // ($upload_dir.'/'.$img);
      $sha1_th = sha1_file($upload_dir . S . $thumb); // ($upload_dir.'/'.$img);
      $where = ['name' => $thumb, 'md5' => $md5_th, 'sha1' => $sha1_th];
    }
    else {
      $where = ['name' => $img, 'path' => $upload_dir];
    }

    // ищем совпадения имени файла и хешей md5 и sha1
    $res = $this->select(['id'],
      'files',
      $where,
      ['='],
      false,
      false,
      1
    );
    // "SELECT id FROM files WHERE name='$thumb' AND md5='$md5_th' AND sha1='$sha1_th' LIMIT 1";
    // "SELECT id FROM files WHERE name='$thumb' AND path='$upload_dir' LIMIT 1";

    if (!empty($res)) { // если такой файл есть (массив не пуст)
      $this->update(
        'files',
        array('published','del'),
        array(0,1),
        array('id' => (int)$res['id']),
        array('='),
        1
      );
      // "UPDATE files SET published='0',del='1' WHERE id='$res[id]' LIMIT 1";
    }
    delete_file($upload_dir.S.$thumb); // удаляем миниатюру

    // удаляем загруженный файл
    if (delete_file($source)){ // ($upload_dir.'/'.$img)
      return true;
    }
    return false;
  }
  /* ===Удаление картинок=== */









}