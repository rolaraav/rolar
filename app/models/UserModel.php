<?php
namespace app\models;
use core\Db;
use \R;

class UserModel extends BaseModel {

  public function __construct() {
    parent::__construct();
    //echo 'Конструктор UserModel';
    //$userModel = new UserModel; // создание модели и соединение с базой данных
  }

  // status: 5 - суперпользователь, 4 - модератор, 3 - обычный пользователь, 2 - подписчик, 1 - заблокированный пользователь, 0 - удалённый пользователь

  // создание (добавление) нового пользователя при регистрации, подписке и отправке комментария
  public function add_user($first_name,$login,$shifr_password,$email,$last_name='',$avatar=DAVATAR,$photo=null,$phone='',$site='',$activation=0,$status=3,$method=0,
                           $social_id=null,$reg_date='1970-01-01 00:00:00',$birthday='1970-01-01',
                           $gender=0,$ip='127.0.0.1',$letter_type=0,$view=0){
    if ((empty($first_name)) or (empty($email))) { // если пустые имя или email, то возвращаем false
      return false;
    }
    if (((empty($login)) or (empty($shifr_password))) and ($status > 2)) { // если пустые логин или пароль и при этом статус > 2 - обычный пользователь, модератор, админ, то возвращаем false
      return false;
    }
    $login_date = $reg_date;
    // "INSERT INTO users (first_name, last_name, login, password, avatar, photo, phone, email, site, activation, status, method, social_id, reg_date, login_date, birthday, gender, ip, letter_type, view) VALUES ('$first_name','$last_name','$login','$shifr_password','$avatar','$photo','$email','$site','$activation','$status','$method','$social_id','$date','$date','$birthday','$gender','$ip','$letter_type','$view')";
    $user_id = $this->insert(
      'users',
      array('first_name','last_name','login','password','avatar','photo','phone','email','site','activation','status','method','social_id','reg_date','login_date','birthday','gender','ip','letter_type','view'),
      array($first_name,$last_name,$login,$shifr_password,$avatar,$photo,$phone,$email,$site,$activation,$status,$method,$social_id,$reg_date,$login_date,$birthday,$gender,$ip,$letter_type,$view),
      true
    );
    return $user_id;
  }

  // получение id и логина одного пользователя по логину для регистрации: возвращает id и логин одного пользователя или false, если пользователь не найден
  // method='0' AND status>'2' - выбираем среди пользователей, авторизованных через сайт rolar.ru, со статусом "обычный пользователь" и более
  public function get_user_for_registration($login='') {
    if (!isset($login)) {
      return false;
    }
    return $this->select(['id'],'users', ['login' => $login], ['='], false, false, 1); // 'method' => 0, 'status' => 2 // '=','>'
    // "SELECT id FROM users WHERE login='$login' AND method='0' AND status>'2' LIMIT 1"; - для регистрации
    // "SELECT id FROM users WHERE login='$login' LIMIT 1"; - для регистрации
    // "SELECT id FROM users WHERE login='$login'";
  }

  // получение данных пользователя для авторизации через соц сети: возвращает данные одного пользователя или false, если пользователь не найден
  public function get_user_for_socialauth($method=0,$social_id='') {
    if (empty($social_id)) {
      return false;
    }
    return $this->select(['id','login','password','avatar','photo'],'users', ['method' => (int)$method, 'social_id' => $social_id], ['='], false, false, 1);
    // "SELECT id,login,password,avatar,photo FROM users WHERE method='$method' AND social_id='$social_id' LIMIT 1";
  }

  // получение длянных пользователя при активации
  // извлекаем id, имя (для письма), пароль и аватар (для авторизации), емайл (для отправки письма), метку об активации и статус пользователя с данным логином или email
  // status>'2' - выбираем среди пользователей со статусом "обычный пользователь" и более
  public function get_user_for_activation($login='',$email='') {
    if ((!isset($login)) and (!isset($email))) {
      return false;
    }

    if (empty($login)) { // если логин пустой, то ищем по email (в случае подписки)
      $where = ['email' => (string)$email, 'status' => 2];
      $operand = ['='];
    }
    else { // иначе проверяем наличие email
      if (empty($email)) { // если email пустой, то ищем по логину (в случае активации и подписки)
        $where = ['login' => (string)$login, 'status' => 1];
        $operand = ['=','>'];
      } else { // иначе ищем по логину и email
        $where = ['login' => (string)$login, 'email' => (string)$email, 'status' => 1];
        $operand = ['=','=','>'];
      }
    }

    return $this->select(
      ['id','first_name','password','avatar','email','activation','status'],
      'users',
      $where,
      $operand,
      false,
      false,
      1);
    // "SELECT id,first_name,password,avatar,email,activation,status FROM users WHERE login='$login' AND 'status'>1 LIMIT 1"; - для активации по логину (в случае активации и подписки)
    // "SELECT id,first_name,password,avatar,email,activation,status FROM users WHERE login='$login' AND email='$email' AND 'status'>1 LIMIT 1"; - для активации по логину и email (в случае активации и подписки)
    // "SELECT id,first_name,password,avatar,email,activation,status FROM users WHERE email='$email' AND 'status'=2 LIMIT 1"; - для активации по email (в случае подписки)
  }

  // получение данных пользователя при деактивации
  // извлекаем id, метку об активации и статус пользователя с данным email
  // status='2' - выбираем среди пользователей со статусом "подписчик"
  public function get_user_for_deactivation($email='') {
    if (!isset($email)) {
      return false;
    }
    return $this->select(
      ['id','activation','status'],
      'users',
      ['email' => (string)$email, 'status' => 2],
      ['='],
      false,
      false,
      1);
    // "SELECT id,activation,status FROM users WHERE email='$email' AND 'status'=2 LIMIT 1"; - для деактивации по email (в случае подписки)
  }

  // получение пользователей по email для подписки, method='0' - выбираем среди пользователей, авторизованных через сайт rolar.ru
  public function get_user_for_subscription($email, $method = false) {
    if (!isset($email)) {
      return false;
    }
    $where = ['email' => $email];
    if ($method !== false) {
      $where = ['email' => $email, 'method' => (int)$method];
    }
    return $this->select(['id'],'users', $where, ['='], false, false, 1);
    // "SELECT id,email FROM users WHERE email='$email' AND method='0' LIMIT 1";
    // "SELECT id,email FROM users WHERE email='$email' LIMIT 1";
  }

  // получение пользователя по логину и email для восстановления пароля
  public function get_user_for_send_password($login='',$email='') {
    if ((!isset($login)) or (!isset($email))) {
      return false;
    }
    return $this->select(['id','first_name'],'users', ['login' => $login, 'email' => $email, 'activation' => 1, 'status' => 2], ['=','=','=','>'], false, false, 1);
    // "SELECT id,first_name FROM users WHERE login='$login' AND email='$email' AND activation='1' AND status>'2' LIMIT 1"; - для восстановления пароля пользователя
  }

  // получение пользователя по email для восстановления логина
  public function get_user_for_send_login($email='') {
    if (!isset($email)) {return false;}
    return $this->select(['id','first_name','login'],'users', ['email' => $email, 'activation' => 1, 'status' => 2], ['=','=','>'], false, false, 1);
    // "SELECT id,first_name,login FROM users WHERE email='$email' AND activation='1' AND status>'2' LIMIT 1"; - для восстановления логина пользователя
  }

  // получение всех данных выбранного пользователя по его ID
  // AND activation='1' AND status>'2' - выбираем среди активированных пользователей со статусом "обычный пользователь" и более
  public function get_current_user($id){
    return $this->select(
      ['id','first_name','last_name','login','password','avatar','photo','phone','email','site','activation','status','method','social_id','reg_date','login_date','birthday','gender','ip','letter_type','view'],
      'users',
      ['id' => $id, 'activation' => 1, 'status' => 2],
      ['=','=','>'],
      false,
      false,
      1);
    // "SELECT id,first_name,last_name,login,(password),avatar,photo,phone,email,site,activation,status,method,social_id,reg_date,login_date,birthday,gender,ip,letter_type,view FROM users WHERE id='$id' AND activation='1' AND status>'2' LIMIT 1";
  }

  // активация пользователя
  public function activation_user($id=null){
    if (!isset($id)) return false;
    $result = $this->update(
      'users',
      array('activation'),
      array(1),
      array('id' => $id),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET activation='1' WHERE id='$id' LIMIT 1";
    // "UPDATE users SET activation='1' WHERE login='$login' LIMIT 1";
    // "UPDATE users SET activation='1' WHERE email='$email' LIMIT 1";
  }

  // status: 5 - суперпользователь, 4 - модератор, 3 - обычный пользователь, 2 - подписчик, 1 - заблокированный пользователь, 0 - удалённый пользователь

  // деактивация пользователя, отписка от почтовой рассылки
  public function deactivation_user($id=null){
    if (!isset($id)) return false;
    $result = $this->update(
      'users',
      array('status'),
      array(1),
      array('id' => $id),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET activation='0', status='1' WHERE id='$id' LIMIT 1";
    // "UPDATE users SET status='1' WHERE id='$id' LIMIT 1";
  }

  // обновление даты и IP-адреса последней успешной авторизации пользователя
  public function update_login_date($login, $shifr_password = false, $ip = '127.0.0.1') {
    if ((!isset($login)) or (!isset($shifr_password))) {
      return false;
    }
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    $date = date("Y-m-d H:i:s"); // формируем дату и время
    if (!empty($ip)) {$ip = get_ip();} // если IP-адрес не передан, то получаем IP-адрес
    $result = $this->update(
      'users',
      array('login_date','ip'),
      array($date, $ip),
      array('login' => $login, 'password' => $shifr_password, 'activation' => 1),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET login_date='$date',ip='$ip' WHERE login='$login' AND password='$shifr_password' AND activation='1' LIMIT 1";
  }

  public function update_avatar_login_date($id, $new_avatar = '', $photo = ''){
    if ((empty($new_avatar)) or (empty($photo)) or (empty($id))) {
      return false;
    }
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    $date = date("Y-m-d H:i:s"); // формируем дату и время
    $ip = get_ip(); // получаем IP-адрес
    $result = $this->update(
      'users',
      array('avatar','photo','login_date','ip'),
      array($new_avatar, $photo, $date, $ip),
      array('id' => $id),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET avatar='$new_avatar', photo='$photo', login_date='$login_date', ip='$ip' WHERE id='$id'";
  }


  // === *** Обновления пользователя (начало) *** === //

  // обновление имени пользователя
  public function update_first_name($first_name='',$login=''){
    if ((!isset($first_name)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('first_name'),
      array($first_name),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET first_name='$first_name' WHERE login='$login' LIMIT 1";
  }

  // обновление фамилии пользователя
  public function update_last_name($last_name='',$login=''){
    if ((!isset($last_name)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('last_name'),
      array($last_name),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET last_name='$last_name' WHERE login='$login' LIMIT 1";
  }

  // обновление логина пользователя
  public function update_login($login='',$old_login=''){
    if ((!isset($login)) or (!isset($old_login))) return false;
    $result = $this->update(
      'users',
      array('login'),
      array($login),
      array('login' => $old_login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET login='$login' WHERE login='$old_login' LIMIT 1";
  }

  // обновление автора (отправителя) сообщений
  public function update_author_messages($login='',$old_login=''){
    if ((!isset($login)) or (!isset($old_login))) return false;
    $result = $this->update(
      'messages',
      array('author'),
      array($login),
      array('author' => $old_login),
      array('='),
      false
    );
    return $result;
    // "UPDATE messages SET author='$login' WHERE author='$old_login'";
  }

  // обновление получателя сообщений
  public function update_addressee_messages($login='',$old_login=''){
    if ((!isset($login)) or (!isset($old_login))) return false;
    $result = $this->update(
      'messages',
      array('addressee'),
      array($login),
      array('addressee' => $old_login),
      array('='),
      false
    );
    return $result;
    // "UPDATE messages SET addressee='$login' WHERE addressee='$old_login'";
  }

  // обновление отправителя комментариев
  public function update_author_comments($login='',$old_login=''){
    if ((!isset($login)) or (!isset($old_login))) return false;
    $result = $this->update(
      'comments',
      array('author'),
      array($login),
      array('author' => $old_login),
      array('='),
      false
    );
    return $result;
    // "UPDATE comments SET author='$login' WHERE author='$old_login'";
  }

  // обновление пароля пользователя
  public function update_password($shifr_password='',$login=''){
    if ((!isset($shifr_password)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('password'),
      array($shifr_password),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET password='$shifr_password' WHERE login='$login' LIMIT 1";
  }

  // обновление email пользователя
  public function update_email($email='',$login=''){
    if ((!isset($email)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('email'),
      array($email),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET email='$email' WHERE login='$login' LIMIT 1";
  }

  // обновление номера телефона пользователя
  public function update_phone($phone='',$login=''){
    if ((!isset($phone)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('phone'),
      array($phone),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET phone='$phone' WHERE login='$login' LIMIT 1";
  }

  // обновление сайта пользователя
  public function update_site($site='',$login=''){
    if ((!isset($site)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('site'),
      array($site),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET site='$site' WHERE login='$login' LIMIT 1";
  }

  // обновление аватара пользователя
  public function update_avatar($avatar=DAVATAR,$login=''){
    if ((!isset($avatar)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('avatar'),
      array($avatar),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET avatar='$avatar' WHERE login='$login' LIMIT 1";
  }

  // обновление даты рождения пользователя
  public function update_birthday($birthday='1970-01-01',$login=''){
    if ((!isset($birthday)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('birthday'),
      array($birthday),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET birthday='$birthday' WHERE login='$login' LIMIT 1";
  }

  // обновление даты рождения пользователя
  public function update_gender($gender=0,$login=''){
    if ((!isset($gender)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('gender'),
      array($gender),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET gender='$gender' WHERE login='$login' LIMIT 1";
  }

  // обновление типа письма пользователя
  public function update_letter_type($letter_type=0,$login=''){
    if ((!isset($letter_type)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('letter_type'),
      array($letter_type),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET letter_type='$letter_type' WHERE login='$login' LIMIT 1";
  }

  // обновление статуса пользователя (для подписки на новости)
  public function update_subscribe($status='',$login=''){
    if ((!isset($status)) or (!isset($login))) return false;
    $result = $this->update(
      'users',
      array('status'),
      array((int)$status),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET status='$status' WHERE login='$login' LIMIT 1";
  }

  // удаление пользователя
  public function update_status_user($login=''){
    if (!isset($login)) return false;
    $result = $this->update(
      'users',
      array('activation', 'status'),
      array(0, 0),
      array('login' => $login),
      array('='),
      1
    );
    return $result;
    // "UPDATE users SET activation='0' AND status='0' WHERE login='$login' LIMIT 1";
  }
  // === *** Обновления пользователя (конец) *** === //


  // получение отправителя (автора) и получателя мообщения
  public function get_addressee_message($id=0){
    if(!isset($id)) {return false;}
    return $this->select(['author','addressee'], 'messages', ['id' => $id], ['='], false, false, 1);
    // "SELECT author,addressee FROM messages WHERE id='$id' LIMIT 1";
  }

  // обновление публикации сообщения (удаление сообщения)
  public function update_message($id) {
    if(!isset($id)) {return false;}
    $result = $this->update(
      'messages',
      array('published'),
      array(0),
      array('id' => (int)$id),
      array('='),
      1
    );
    // "UPDATE messages SET published='0' WHERE id='$id' LIMIT 1";
    return $result;
  }























  /* === Попытки авторизации login errors (начало) === */

  // Удаление всех неудачных попыток авторизации, совершенных более 15 минут назад
  public function delete_login_errors($ip = null) {
    if (isset($ip)) {
      $query = "DELETE FROM login_errors WHERE ip = '$ip' LIMIT 1";
    }
    else {
      $query = "DELETE FROM login_errors WHERE UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 900";
    }
    return $this->sql($query, false);
  }

  // Получение количества неудачных попыток авторизации для одного IP-адреса
  public function get_count_login_errors($ip = '127.0.0.1') {
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    $row = $this->select(['col'],'login_errors', ['ip' => $ip], ['='], false, false, 1); // "SELECT col FROM login_errors WHERE ip='$ip' LIMIT 1"
    return abs((int)$row['col']);
  }

  // Получение одной записи IP-адреса c неудачными попытками авторизации
  public function get_login_error($ip = '127.0.0.1') {
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    return $this->select(['ip','col'],'login_errors', ['ip' => $ip], ['='], false, false, 1); // "SELECT ip,col FROM login_errors WHERE ip='$ip' LIMIT 1"
  }

  // обновление количества попыток неудачной авторизации
  public function update_login_errors($col = 0, $ip = '127.0.0.1') {
    if (!isset($col)) {
      return false;
    }
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    $date = date('Y-m-d H:i:s');
    $result = $this->update(
      'login_errors',
      array('date','col'),
      array($date, $col), // array('NOW()', $col),
      array('ip' => $ip),
      array('='),
      1
    ); // "UPDATE login_errors SET col=$col,date=NOW() WHERE ip='$ip' LIMIT 1"
    return $result;
  }

  // вставка новой записи о неудачной попытке авторизации
  public function insert_login_errors($ip = '127.0.0.1') {
    //if (!isset($ip)) {$ip = '127.0.0.1';}
    $date = date('Y-m-d H:i:s');
    return $this->insert('login_errors', ['ip','date','col'], [$ip, $date, 1]); // "INSERT INTO login_errors (ip,date,col) VALUES ('$ip',NOW(),'1')";
  }

  /* === Попытки авторизации login errors (конец) === */





  /* === Получение сообщений === */
  public function get_messages($login=''){
    if(!isset($login)) {return false;}
    $query = "SELECT id,author,addressee,date,text FROM messages WHERE (author = '$login' OR addressee='$login') AND published='1' ORDER BY id ASC";
    return $this->sql($query, true);
    // "SELECT id,author,addressee,date,text FROM messages WHERE (author = '$login' OR addressee='$login') AND published='1' ORDER BY id ASC"
  }
  /* === Получение сообщений === */

  // получение аватара автора сообщения - не используется
  public function get_author_avatar($author = '') {
    if (empty($author)) return false;

    $result = $this->select(
      ['id','avatar'],
      'users',
      ['login' => $author, 'activation' => 1, 'status' => 2],
      ['='],
      false,
      false,
      1);
    foreach ($result as $item) {
      $author_avatar['id'] = $item['id'];
      if (!empty($item['avatar'])) {
        $author_avatar['avatar'] = $item['avatar'];
      }
      else { // если такового нет, то выводим стандартный аватар по умолчанию
        $author_avatar['avatar'] = DAVATAR;
      }
    }

    return $author_avatar;
  // "SELECT id,avatar FROM users WHERE login='$author' LIMIT 1";
  }















}