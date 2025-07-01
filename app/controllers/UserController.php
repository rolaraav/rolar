<?php
namespace app\controllers;
use core\View;
use app\models\UserModel;
use core\Model;
use core\libs\Mail;
use core\libs\CheckMail;
use core\libs\Cache;

class UserController extends BaseController {

  //public $user; // переменная для хранения данных пользователя
  protected $UserModel; // переменная для хранения объекта модели пользователей
  //public $attributes = []; //
  // public $errors = []; // массив для хранения ошибок валидации
  //public $rules = []; // правила валидации

  // атрибуты для регистрации пользователя, массив с атрибутами, нужен для получения данных, переданных из формы методом POST
  public $attributes = [
    'first_name' => '',
    //'last_name' => '',
    'login' => '',
    'password' => '',
    //'atavar' => DAVATAR,
    //'photo' => null,
    //'phone' => '',
    'email' => '',
    //'site' => '',
    //'fupload' => '',
    //'activation' => '0',
    //'status' => '0',
    //'method' => '0',
    //'social_id' => null,
    //'reg_date' => '1970-01-01 00:00:00',
    //'login_date' => '1970-01-01 00:00:00',
    //'birthday' => '1970-01-01', // '0000-00-00'
    //'gender' => '0',
    //'ip' => '127.0.0.1',
    //'letter_type' => '0',
    //'view' => 0,
    //'code' => '',
  ];

  // набор правил для валидации формы регистрации
  public $rules = [
    'required' => [
      ['first_name'],
      ['login'],
      ['password'],
      ['email'],
      ['code'],
    ],
    'email' => [
      ['email'],
    ],
    'url' => [
      ['site'],
    ],
    'lengthBetween' => [
      ['first_name', 2, 30],
      ['last_name', 2, 30],
      ['login', 3, 15],
      ['password', 3, 15],
    ],
    'date' => [
      ['birthday'],
    ],
    'dateFormat' => [
      ['birthday', 'Y-m-d'],
    ]
  ];

  public function indexAction() {
    // echo 'Метод indexAction контроллера UserController';
    if (!isset($this->user['login'])){ // если пользователь не авторизован, отправляем его на страницу авторизации
      redirect(D.S.'authorization');
    }

    $this->alias = 'user';
    //echo 'UserController1';

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

    //debug($this->route);
    //$alias = $this->route['alias'];

    $this->UserModel = new UserModel();
    // Извлекаем все данные текущего пользователя с данным id - пользователь, на чью страницу сейчас зашли
    $current_user = $this->UserModel->get_current_user($user_id); // массив данных выбранного пользователя
    $this->UserModel->update_view('users', $user_id, $current_user['view']); // обновление количества просмотров
    //debug($current_user);

    require_once APP.S.'update_user'.R; // подключение файла update_user.php

    // если данные пользователя получены
    if (isset($current_user)) {
      // если логин текущего пользователя совпадает с логином авторизованного пользователя
      if ($current_user['login'] == $this->user['login']) {
        // то, получаем личные сообщения пользователя
        $messages = $this->UserModel->get_messages($current_user['login']);
        //debug($messages);
        $current_user['messages'] = $this->format_messages($messages); // и приводим их к нормальному виду
      }
      $current_user = $this->format_user($current_user); // приводим данные пользователя к нормальному виду
    }
    else {
      $current_user['text'] = '<div class="alert alert-danger">Такого пользоватея нет, либо пользователь был удалён!</div>';
    }
    //debug($current_user);

    $this->title = 'Страница пользователя '.$current_user['login'];
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$user_id,0,$this->alias); // false - на главной странице направляющие не выводятся
    //$breadcrumbs = " &raquo; <a class='current' href='$view.php?id=$current_user[id]' target='_self' title='$title'>$title</a>";
    // если пользователь зашёл на свою страницу

    // $page2 = $this->Model->get_page2('courses'); данные для хлебных крошек и заголовка
    //$this->title = $post['title']; //$page_title.' - '.$post['title_category'].' - '
    //$this->description = $post['description'];
    //$this->keywords = $post['keywords'];
    //$this->image = $post['image'];
    //$this->text = $post['text'];

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  // форматирование данных пользователя
  private function format_user($user = array()) {
    if ((!is_array($user)) or (empty($user))) {
      return false;
    }

    // получение html-кода ссылки сайта
    $user['site_for_view'] = get_html_link($user['site']);

    // получение метода авторизации
    $user['auth_method'] = $this->get_auth_method($user['method']);

    // преобразование даты и времени в удобный для восприятия вид
    $user['reg_date'] = get_datetime($user['reg_date']);
    $user['login_date'] = get_datetime($user['login_date']);

    // преобразование даты рождения в удобный для восприятия вид
    $user['birthday_for_view'] = get_date($user['birthday']);

    // получение статуса подписчика
    if($user['status'] == 1) {
      $user['status_for_view'] = 'Заблокирован/отписан от рассылки';
    }
    if($user['status'] == 2) {
      $user['status_for_view'] = 'Подписчик/подписан на рассылку';
    }
    if($user['status'] > 2) {
      $user['status_for_view'] = 'Обычный пользователь/подписан на рассылку';
    }

    // получение пола пользователя
    if ($user['gender'] == 1) {
      $user['gender_for_view'] = 'женский';
      $user['gender0'] = '';
      $user['gender1'] = CHECK;
      $user['gender2'] = '';
    }
    elseif ($user['gender'] == 2) {
      $user['gender_for_view'] = 'мужской';
      $user['gender0'] = '';
      $user['gender1'] = '';
      $user['gender2'] = CHECK;
    }
    else {
      $user['gender_for_view'] = 'не указан';
      $user['gender0'] = CHECK;
      $user['gender1'] = '';
      $user['gender2'] = '';
    }

    // получение типа письма, получаемого пользователем
    if ($user['letter_type'] == 1) {
      $user['letter_type_for_view'] = 'HTML';
      $user['letter_type0'] = '';
      $user['letter_type1'] = CHECK;
    }
    else {
      $user['letter_type_for_view'] = 'текст';
      $user['letter_type0'] = CHECK;
      $user['letter_type1'] = '';
    }

    return $user;
  }

  // получение метода авторизации
  private function get_auth_method($method = 0) {
    $method = clear_int($method);
    switch($method){
    case(0):
      $auth_method = 'Rolar.ru';
    break;
    case(1):
      $auth_method = 'Вконтакте';
    break;
    case(2):
      $auth_method = 'Facebook';
    break;
    case(3):
      $auth_method = 'Twitter';
    break;
    case(4):
      $auth_method = 'Одноклассники';
    break;
    case(5):
      $auth_method = 'Mail.Ru';
    break;
    case(6):
      $auth_method = 'Google';
    break;
    case(7):
      $auth_method = 'Яндекс';
    break;
    default:
      $auth_method = 'Rolar.ru';
    }
    return $auth_method;
  }

  // форматирование сообщений
  private function format_messages($messages = array()) {
    if ((!is_array($messages)) or (empty($messages))) {
      return false;
    }

    // получаем список всех пользователей
    if (!empty($this->users)) {
      $users_array = $this->users;
    }
    else {
      $users_array = Core::$core->getProperty('users');
    }
    //debug($users_array);

    $messages_array = array(); // пустой массив

    // проходим по всем сообщениям
    foreach($messages as $key =>$message) {

      // преобразование даты в удобный для восприятия вид
      //debug($message['date']);
      $message['date'] = get_datetime($message['date']);

      // получение картинки автора сообщения - проходим по всем пользователям
      foreach($users_array as $item) {
        //$query = "SELECT id,avatar FROM users WHERE login='$author' LIMIT 1";
        if ($item['login'] == $message['author']) {
          $message['author_id'] = $item['id'];
          if (!empty($item['avatar'])) {
            $message['author_avatar'] = $item['avatar'];
          } else {
            $message['author_avatar'] = DAVATAR; // если такового нет, то выводим аватар по-умолчанию
          }
        }
      }

      $messages_array[$key] = $message;
    }
    //debug($messages_array);

    return $messages_array;
  }

  public function usersAction() {
    if (!isset($this->user['login'])){ // если пользователь не авторизован, отправляем его на страницу авторизации
      redirect(D.S.'authorization');
    }

    $this->title = 'Пользователи';
    $this->alias = 'users';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    //if ($this->user['status'] > 3) { // список пользователей показываем только для администратора и модераторов
      $users = $this->get_users(1,2); // получение из кэша (или БД) списка пользователей, зарегистрированных на сайте
    //debug($users);
    //}
    //else {
    //  $users = false;
    //}

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'users' => $users,
    ]);

  }

  // получение списка пользователей, зарегистрированных на сайте
  // "SELECT id,first_name,login,avatar FROM users WHERE activation='1' AND status>'2' ORDER BY id";
  public function get_users($activation=null,$status=null,$status_operand=null) {
    if (!isset($status_operand)) {$status_operand = '>';}
    if (!empty($this->users)) { // если в массиве пользователй не пусто, получаем нужных пользователей из этого массива
      $array = array(); // пустой массив

      foreach($this->users as $key => $item) {
        if (isset($status)) {
          if (isset($activation)) {
            if ($status_operand == '>') {
              if (($item['activation'] == $activation) and ($item['status'] > $status)) {
                $array[$key] = $item;
              }
            }
            else {
              if (($item['activation'] == $activation) and ($item['status'] == $status)) {
                $array[$key] = $item;
              }
            }
          }
          else {
            if ($status_operand == '>') {
              if ($item['status'] > $status) {
                $array[$key] = $item;
              }
            }
            else {
              if ($item['status'] == $status) {
                $array[$key] = $item;
              }
            }
          }
        }
        else {
          if (isset($activation)) {
            if ($item['activation'] == $activation) {
              $array[$key] = $item;
            }
          }
          else {
            $array[$key] = $item;
          }
        }
      }

      /*
      if (isset($status)) {
        if ($status_operand == '>') {
          if (isset($activation)) {
            foreach($this->users as $key => $item) {
              if (($item['activation'] == $activation) and ($item['status'] > $status)) {
                $array[$key] = $item;
              }
            }
          }
          else {
            foreach($this->users as $key => $item) {
              if ($item['status'] > $status) {
                $array[$key] = $item;
              }
            }
          }
        }
        else {
          if (isset($activation)) {
            foreach($this->users as $key => $item) {
              if (($item['activation'] == $activation) and ($item['status'] == $status)) {
                $array[$key] = $item;
              }
            }
          }
          else {
            foreach($this->users as $key => $item) {
              if ($item['status'] == $status) {
                $array[$key] = $item;
              }
            }
          }
        }
      }
      else {
        if (isset($activation)) {
          foreach($this->users as $key => $item) {
            if ($item['activation'] == $activation) {
              $array[$key] = $item;
            }
          }
        }
        else {
          $array = $this->users;
        }
      } */
      //debug($array);

      return $array;
    }
    else { // иначе получаем пользователей из базы данных
      $this->UserModel = new UserModel();
      return $this->UserModel->get_users($activation,$status,$status_operand);
      // "SELECT id,first_name,login,avatar FROM users WHERE activation='1' AND status>'2' ORDER BY id";
    }
  }

  // метод для регистрации пользователя
  public function signupAction(){
    $this->title = 'Регистрация пользователя';
    //$this->alias = 'registration';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    // если нажата кнопка Зарегистрировать
    if(!empty($_POST['registration_submit'])){
      $this->UserModel = new UserModel();
      //debug($this->UserModel);
      $this->registration();
      redirect();
    }
    //View::setMeta('Регистрация');

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'token' => $this->getToken('registration'),
    ]);

  }

  // метод для авторизации пользователя
  public function loginAction(){
    $this->title = 'Авторизация пользователя';
    $this->alias = 'authorization';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias);

    if (!empty($_POST['authorization_submit'])) {
    //if($this->isAjax()) {
      //echo 'Ajax-запрос';
      $this->UserModel = new UserModel();
      //debug($this->UserModel);
      $this->login();
      //redirect();

      //debug($_SESSION);
      //debug($this->user);

      // рендеринг блока авторизации
      $authorization = $this->render('_authorization', ['user' => $this->user,'authorization_token' => $this->getToken('authorization')]); // , 'remember_check' => $this->remember_check
      echo $authorization;

      exit();
    }
    //View::setMeta('Вход');

    // рендеринг блока авторизации
    //$this->authorization = $this->renderBlock('_authorization', 'Вход', ['user' => $this->user]); // , 'remember_check' => $this->remember_check

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      //'token' => $this->getToken('authorization'), //'iK5Ld2j9cF'
      //'authorization' => $this->authorization,
    ]);

  }

  // метод для активации пользователя
  public function activateAction(){
    $this->title = 'Активация пользователя';
    $this->alias = 'activation';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    $this->UserModel = new UserModel();
    //debug($this->UserModel);
    $this->activation(); // http://localhost/activation?login=rolar&code=11d9fdf170585f75516dfb054f26508b
    //redirect();

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      //'token' => '',
      //'$message' => $message,
    ]);

  }

  // метод для отписки от почтовой рассылки (деактивации) пользователя
  public function deactivateAction(){
    $this->title = 'Отписка от почтовой рассылки';
    $this->alias = 'deactivation';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    $this->UserModel = new UserModel();
    //debug($this->UserModel);
    $this->deactivation(); // http://localhost/deactivation?email=admin@rolar.ru&code=11d9fdf170585f75516dfb054f26508b
    //redirect();

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      //'token' => '',
      //'$message' => $message,
    ]);

  }

  // метод для подписки на почтовые рассылки
  public function subscribeAction(){
    $this->title = 'Почтовая подписка';
    $this->alias = 'subscription';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    if (!empty($_POST['subscription_submit'])) {
      //if($this->isAjax()) {
      //echo 'Ajax-запрос';
      $this->UserModel = new UserModel();
      //debug($this->UserModel);
      $this->subscription();
      //redirect();

      //debug($_SESSION);
      //debug($this->user);

    }
    //View::setMeta('Вход');

    // рендеринг блока подписки
    $subscription = $this->render('_subscription', ['subscription_token' => $this->getToken('subscription')]); // , 'remember_check' => $this->remember_check
    //echo $subscription;

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      // 'token' => $this->getToken('subscription'), //'iK5Ld2j9cF',
      'subscription' => $subscription,
      //'$message' => $message,
    ]);

    // redirect();
  }


  // метод для восстановления пароля пользователя
  public function sendPasswordAction(){
    $this->title = 'Восстановить пароль';
    $this->alias = 'send_password';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    // если нажата кнопка Зарегистрировать
    if(!empty($_POST['send_password_submit'])){
      $this->UserModel = new UserModel();
      //debug($this->UserModel);
      $this->send_password();
      //redirect();
    }
    //View::setMeta('Восстановить пароль');

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'token' => $this->getToken('send_password'),
    ]);

  }

  // метод для восстановления логина пользователя
  public function sendLoginAction(){
    $this->title = 'Восстановить логин';
    $this->alias = 'send_login';
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); // false - на главной странице направляющие не выводятся

    // если нажата кнопка Зарегистрировать
    if(!empty($_POST['send_login_submit'])){
      $this->UserModel = new UserModel();
      //debug($this->UserModel);
      $this->send_login();
      //redirect();
    }
    //View::setMeta('Восстановить логин');

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'token' => $this->getToken('send_login'),
    ]);

  }

  // метод для удаления сообщения пользователя
  public function deleteMessageAction(){
    if (!isset($this->user['login'])){ // если пользователь не авторизован, отправляем его на страницу авторизации
      redirect(D);
    }

    //$this->alias = 'delete_message';
    //debug($this->alias);

    //debug($this->id);
    // получаем идентификатор сообщения $message_id
    // нужна проверка, если $message_id больше имеющихся количества пользователей, или пользователь удалён (скрыт), то данные этого пользователя не получаются
    if ((empty($this->id) or ($this->id == 0))) {
      $message_id = false; // если параметр не передан, то ничего не передаём
    }
    else {
      $message_id = $this->id;
    }
    //debug($message_id);

    $this->UserModel = new UserModel();
    $this->delete_message($message_id,$this->user['login']);
    redirect(D.S.'user'.$this->user['id']); // перенаправляем обратно на страницу пользователя
  }

  /* === Удаление сообщения (начало) === */
  public function delete_message($id,$login) {
    if((!isset($id)) or (!isset($login))) {return false;}
    // нужно уточнить, кому сообщение отправлено, ведь через GET запрос пользователь может ввести любой идентификатор и как следствие удалить сообщения, которые отправляли не ему
    $result_addressee = $this->UserModel->get_addressee_message($id); // получаем отправителя и получателя сообщения
    // если сообщение отправляли данному пользователю или же он сам его отправил, то разрешаем его удалить
    if (($result_addressee['author'] == $login) or ($result_addressee['addressee'] == $login)) {
      // удаляем сообщение (снимаем с публикации)
      $result_delete_message = $this->UserModel->update_message($id);
      // если удалено - перенаправляем на страничку пользователя
      if ($result_delete_message == true) {
        $_SESSION['delete_message_result'] = '<div class="alert alert-success">Ваше сообщение успешно удалено</div>';
        return true;
      }
      // если не удалено, то перенаправляем, но выдаём сообщение о неудаче
      else {
        $_SESSION['delete_message_result'] = '<div class="alert alert-danger">Произошла ошибка! Сообщение не удалено</div>';
        return false;
      }
    }
    else { // если сообщение отправлено не этому пользователю. Значит, он попытался удалить его, введя в адресной строке какой-то другой идентификатор
      $_SESSION['delete_message_result'] = '<div class="alert alert-danger">Вы пытаетесь удалить сообщение, отправленное другому пользователю</div>';
      return false;
    }
  }
  /* === Удаление сообщения (конец) === */

  /* === Авторизвация через Вконтакте (начало) === */
  public function vkauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if (!isset($_GET['code'])) {
      vk_get_code();
    }
    else {
      // echo $_GET['code'];
      $vk_access_token = vk_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo $vk_access_token['access_token'];
      if ($vk_access_token['access_token']) {
        $vk_user = vk_get_user_data($vk_access_token); // получение данных пользователя
        if($vk_user) {
          // print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
    if ($_GET['error']) {
      exit($_GET['error_description']);
    }
  }
  /* === Авторизвация через Вконтакте (конец) === */

  /* === Авторизвация через Facebook (начало) === */
  public function fbauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if (!$_GET['code']) {
      fb_get_code();
    }
    else {
      // echo $_GET['code'];
      $fb_access_token = fb_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo $fb_access_token['access_token'];
      if ($fb_access_token['access_token']) {
        $fb_user = fb_get_user_data($fb_access_token); // получение данных пользователя
        if ($fb_user) {
          //print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Facebook (конец) === */

  /* === Авторизвация через Twitter (начало) === */
  public function twauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if ((!$_GET['oauth_token']) or (!$_GET['oauth_verifier'])) {
      tw_get_oauth_token_and_verifier(); // возвращает булево значение
      if ($_SESSION['auth']['oauth_token']) {
        tw_authorize();
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
    else {
      // После авторизации приложения происходит возврат на страницу TW_URL_CALLBACK
      // в GET-запрос добавляется 2 параметра oauth_token и oauth_verifier
      // echo $_GET['oauth_token']."<br>";
      // echo $_GET['oauth_verifier']."<br>";
      $tw_access_token = tw_get_access_token($_GET['oauth_token'],$_GET['oauth_verifier']); // получение токена, ассоциативный массив
      // echo $tw_access_token['oauth_token'];
      if ($tw_access_token['oauth_token']) {
        $tw_user = tw_get_user_data($tw_access_token); // получение данных пользователя
        if ($tw_user) {
          //print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Twitter (конец) === */

  /* === Авторизвация через Одноклассники (начало) === */
  public function okauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if (!$_GET['code']) {
      ok_get_code();
    }
    else {
      // echo "\$_GET['code'] = ".$_GET['code']."<br>";
      $ok_access_token = ok_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo "\$ok_access_token = ".$ok_access_token['access_token']."<br>";
      if ($ok_access_token['access_token']) {
        $ok_user = ok_get_user_data($ok_access_token); // получение данных пользователя
        if($ok_user) {
          // print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Одноклассники (конец) === */

  /* === Авторизвация через Mail.Ru (начало) === */
  public function mrauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if(!$_GET['code']) {
      mr_get_code();
    }
    else {
      // echo "\$_GET['code'] = ".$_GET['code']."<br>";
      $mr_access_token = mr_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo "\$mr_access_token = ".$mr_access_token['access_token']."<br>";
      if ($mr_access_token['access_token']) {
        $mr_user = mr_get_user_data($mr_access_token); // получение данных пользователя
        if ($mr_user) {
          // print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Mail.Ru (конец) === */

  /* === Авторизвация через Google (начало) === */
  public function goauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if(!$_GET['code']) {
      go_get_code();
    }
    else {
      // echo "\$_GET['code'] = ".$_GET['code']."<br>";
      //print_array($_GET); // вместе с кодом сервер отдает ещё несколько GET-параметров, вытаскиваем эти параметры
      $go_access_token = go_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo "\$go_access_token = ".$go_access_token['access_token']."<br>";
      if ($go_access_token['access_token']) {
        $go_user = go_get_user_data($go_access_token, $_GET['code']); // получение данных пользователя
        if ($go_user) {
          // print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Google (конец) === */

  /* === Авторизвация через Yandex (начало) === */
  public function yaauthAction() {
    require_once APP.S.'social_auth'.R; // подключение файла функций social_auth.php для авторизации через социальные сети
    if(!$_GET['code']) {
      ya_get_code();
    }
    else {
      // echo "\$_GET['code'] = ".$_GET['code']."<br>";
      $ya_access_token = ya_get_access_token($_GET['code']); // получение токена, ассоциативный массив
      // echo "\$ya_access_token = ".$ya_access_token['access_token']."<br>";
      if ($ya_access_token['access_token']) {
        $ya_user = ya_get_user_data($ya_access_token); // получение данных пользователя
        if ($ya_user) {
          // print_array($_SESSION['auth']);
          $this->UserModel = new UserModel();
          $this->social_authorization();
          unset($_SESSION['auth']);
          redirect(D);
        }
        else {
          exit($_SESSION['auth']['error']);
        }
      }
      else {
        exit($_SESSION['auth']['error']);
      }
    }
  }
  /* === Авторизвация через Yandex (конец) === */



  /* === Деавторизация (выход) пользователя (начало) === */
  public function logoutAction(){
    // если при входе пользователя метка "Запомнить меня" была установлена в значение 'on' (запомнить)
    if (isset($_COOKIE['remember'])) {
      if ($_COOKIE['remember'] == 'on') { // сохраняем в сессии логин, пароль и метку "Запомнить меня" из кук
        $_SESSION['authorization_data']['login'] = $_COOKIE['login'];
        $_SESSION['authorization_data']['password'] = $this->decrypt($_COOKIE['password']);
        $_SESSION['authorization_data']['remember'] = $_COOKIE['remember'];
        setcookie('remember', 'off', time() + 31536000, '/'); // переключаем куку метки "Запомнить меня" в значение off
      }
    }
    else { // иначе чистим куки id, логина и пароля
      setcookie('id', '', time() - 1, '/');
      setcookie('login', '', time() - 1, '/');
      setcookie('password', '', time() - 1, '/');
      setcookie('remember', 'off', time() + 31536000, '/'); // создаем куку метки "Запомнить меня" со значением off
      unset($_SESSION['authorization_data']['remember']);
    }

    // уничтожаем переменные в сессиях, если они есть
    if (isset($_SESSION['user'])) {unset($_SESSION['user'],$this->user);}

    // перенаправляем на страницу авторизации
    redirect(D.S.'user/login');
  }
  /* === Деавторизация (выход) пользователя (конец) === */

  // Авторизация пользователя - сохранение данных пользователя в сессии
  public function authorization($user){
    if ((!is_array($user)) or (empty($user))) {return false;}
    foreach($user as $k => $v) {
      $_SESSION['user'][$k] = $v; // сохраняем полученные данные пользователя в сессии
      //$_SESSION['user']['id'] = $user['id'];
      //$_SESSION['user']['login'] = $user['login'];
      //$_SESSION['user']['password'] = $user['password'];
      $this->user[$k] = $v;
    }
    return true;
  }

  /* === Авторизация пользователя (начало) === */
  private function login(){
    unset($_SESSION['user']); // удаление данных пользователя из сессии
    $_SESSION['authorization_errors'] = array(); // массив для проверки наличия ошибок авторизации
    $_SESSION['authorization_data'] = array(); // массив для хранения введённых данных пользователя
    // $_SESSION['authorization_result'] = ''; // пуская строка

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['token']) ? trim($_POST['token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'authorization'))) {
      $_SESSION['authorization_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['authorization_errors']['token'].'<br>';
      $_SESSION['authorization_result'] = 'Ошибка при отправке данных. Форма не валидна';
      unset($token);
      return false;
    }

    // заносим введенный пользователем логин в переменную $login, если он пустой, то выдаём сообщение о ошибке
    $login = isset($_POST['login']) ? trim($_POST['login']) : null;
    if (empty($login)) {$_SESSION['authorization_errors']['login'] = 'Не введён логин'; $this->errors['login'] = $_SESSION['authorization_errors']['login'].'<br>'; $_SESSION['authorization_result'] = 'Поля логин и пароль должны быть заполнены';}

    // заносим введенный пользователем пароль в переменную $password, если он пустой, то выдаём сообщение о ошибке
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    if (empty($password)) {$_SESSION['authorization_errors']['password'] = 'Не введён пароль'; $this->errors['password'] = $_SESSION['authorization_errors']['password'].'<br>'; $_SESSION['authorization_result'] = 'Поля логин и пароль должны быть заполнены';}

    // если галочка выставлена, то $remember принимает значение 'on', а если не выставлена, то значение 'off'
    $remember = ((string)$_POST['remember'] == 'true') ? 'on' : 'off';
    //debug($remember);

    // 2. Сохранение полученных данных в сессии
    $_SESSION['authorization_data']['login'] = $login;
    $_SESSION['authorization_data']['password'] = $password;
    if ($remember == 'on') {
      $_SESSION['authorization_data']['remember'] = $remember;
    }
    else {
      unset($_SESSION['authorization_data']['remember']);
    }

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных
    // если логин и пароль введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $login = validate($login, 'login');
    if ((empty($_SESSION['authorization_errors']['login'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['login'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['login'] = $_SESSION['authorization_errors']['login'].'<br>';
      // $_SESSION['authorization_result'] = 'Логин/пароль введены неверно';
    }
    $password = validate($password, 'password');
    if ((empty($_SESSION['authorization_errors']['password'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['password'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['password'] = $_SESSION['authorization_errors']['password'].'<br>';
      // $_SESSION['authorization_result'] = 'Логин/пароль введены неверно';
    }

    // 4. Проверка на подбор паролей (начало)
    // удаляем неудачные попытки авторизации, которые были допущены больше 15 минут назад (15 * 60 сек = 900 сек)
    $this->UserModel->delete_login_errors();

    $ip = get_ip(); // получаем IP-адрес

    // извлекаем из базы количество неудачных попыток авторизации пользователя с данным ip
    $col = $this->UserModel->get_count_login_errors($ip);
    //debug($col);

    // если количество неудачных попыток авторизации больше двух, то выдаём сообщение.
    if ($col > 2) {
      $_SESSION['authorization_result'] = 'Вы неверно ввели логин или пароль '.$col.' раза подряд. Подождите 15 минут до следующей попытки';
      return false;
    }
    // Проверка на подбор паролей (конец)

    // 5. Проверка наличия ошибок в ходе заполнения
    // если все поля заполнены верно и ошибок нет
    if (empty($_SESSION['authorization_errors'])){

      // 6. Шифрование пароля
      // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
      // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
      $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa

      // 7. Получение данных пользователя с введённым логином и паролем из базы данных
      // AND activation='1' - выбираем среди активированных пользователей
      $user = $this->UserModel->get_user_for_authorization($login, $shifr_password, true);

      //debug($user);

      // если логин и пароль совпадают (пользователь найден!), то запускаем пользователю сессию! Можете его поздравить, он вошёл!
      if((!empty($user)) and (is_array($user)) and (empty($_SESSION['authorization_result']))){
        //debug($user);

        // 8. Авторизация пользователя - сохранение данных пользователя в сессии
        $this->authorization($user); // сохраняем полученные данные пользователя в сессии, здесь присваиваем значение для переменной $this->user
        //$_SESSION['user']['id'] = $user['id'];
        //$_SESSION['user']['login'] = $user['login'];
        //$_SESSION['user']['password'] = $user['password'];
        unset($_SESSION['authorization_data'],$_SESSION['authorization_errors']); // удаляем данные авторизации и ошибки авторизации из сессии

        // 9. Обновление даты последней авторизации и IP-адреса пользователя в базе данных
        $this->UserModel->update_login_date($login, $shifr_password, $ip);

        $this->UserModel->delete_login_errors($ip); // удаляем записи о неудачных попытках авторизации для данного IP-адреса пользователя

        //$remember = 'on';
        // 10. Сохранение данных пользователя в куках для последующего входа
        // ВНИМАНИЕ!!! ДЕЛАЙТЕ ЭТО НА ВАШЕ УСМОТРЕНИЕ, ТАК КАК ДАННЫЕ ХРАНЯТСЯ В КУКАХ БЕЗ ШИФРОВАНИЯ
        // если есть метка "Запомнить меня" (пользователь хочет, чтобы его данные сохранились для последующего входа), то сохраняем данные пользователя в куках браузера
        if ($remember == 'on') {
          // сохраняем в куки id пользователя, введённые логин и пароль и метку "Запомнить меня". Время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
          setcookie('id', $user['id'], time()+31536000, '/');
          setcookie('login', $user['login'], time()+31536000, '/');
          setcookie('password', $this->encrypt($password), time()+31536000, '/');
        }
        else {
          // иначе удаляем куки id пользователя, логина и пароля
          setcookie('id', '', time()-1, '/');
          setcookie('login', '', time()-1, '/');
          setcookie('password', '', time()-1, '/');
        }
        setcookie('remember', $remember, time()+31536000, '/');

        // 11. Формирование сообщения об успешной авторизации пользователя
        // сообщаем пользователю об удачном входе и перенаправляем его на главную страничку
        $_SESSION['authorization_success'] = 'Вы зашли на сайт как <strong>'.$user['login'].'</strong>!';

        return true;
      }
      // иначе если введённого логина и пароля в базе данных не найдено, делаем запись о том, что пользователь с текущим ip не смог авторизоваться
      else {
        $login_errors = $this->UserModel->get_login_error($ip); // ищем и извлекаем существующую запись IP-адреса и количество неудачных попыткок авторизации
        //debug($login_errors);

        // если запись IP-адреса есть, то
        if ($login_errors['ip'] == $ip) {

          //$col = $this->UserModel->get_count_login_errors($ip); // извлекаем из базы количество неудачных попыток авторизации пользователя с данным IP-адресом
          $col = abs((int)$login_errors['col']);
          //var_dump($col);

          $this->UserModel->update_login_errors($col+1, $ip); // и прибавляем ещё одну попытку неудачной авторизации
        }
        else {
          // иначе вставляем новую запись о неудачной авторизации в таблицу "login_errors"
          $this->UserModel->insert_login_errors($ip);
        }

        // 11. Формирование сообщения о неудачной авторизации пользователя
        // если логин/пароль введены не верно (не найдены в базе данных)
        $_SESSION['authorization_result'] = 'Логин/пароль введены неверно';
        return false;
      }
    }
    else {
      // если обязательные поля не заполнены или заполнены с ошибками
      $_SESSION['authorization_result'] = 'В ходе заполнения формы авторизации были допущены ошибки';
      return false;
    }
  }
  /* === Авторизация пользователя (конец) === */

  // проверка на существование пользователя с таким же логином
  // выдаёт Empty login, если логин пустой, false, если пользователь с таким логином найден, и true - если логин не найден
  private function check_unique_login($login=''){
    if (empty($login)) {
      return 'Empty login';
    }
    // извлекаем из базы данных id и login пользователя с введённым логином
    $result_user = $this->UserModel->get_user_for_registration($login); // получаем либо массив с данными пользователя, либо false - пользователь не найден
    //debug((int)$result_user);
    if ((int)$result_user > 0) { // 1 - такой логин есть, 0 - такого логина нет
      return false; // если совпадение найдено и получен массив (пользователь с таким логином уже есть), то выдаём false
    }
    return true; // иначе выдаём true - логин уникальный
  }

  /* === Регистрация пользователя (начало) === */
  private function registration(){
    $_SESSION['registration_errors'] = array(); // массив для проверки наличия ошибок регистрации
    $_SESSION['registration_data'] = array(); // массив для хранения введённых данных пользователя

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['token']) ? trim($_POST['token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'registration'))) {
      $_SESSION['registration_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['registration_errors']['token'].'<br>';
      $_SESSION['registration_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
      unset($token);
      return false;
    }

    // удаляем лишние пробелы, если пользователь не ввёл имя/фамилию или логин или пароль или e-mail или код капчи, то выдаем ошибку
    // заносим введенное пользователем имя в переменную $first_name, если оно пустое, то выдаём сообщение о ошибке
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
    if (empty($first_name)) {$_SESSION['registration_errors']['first_name'] = 'Не введено имя'; $this->errors['first_name'] = $_SESSION['registration_errors']['first_name'].'<br>';}

    // заносим введенный пользователем логин в переменную $login, если он пустой, то выдаём сообщение о ошибке
    $login = isset($_POST['login']) ? trim($_POST['login']) : null;
    if (empty($login)) {$_SESSION['registration_errors']['login'] = 'Не введён логин'; $this->errors['login'] = $_SESSION['registration_errors']['login'].'<br>';}

    // заносим введенный пользователем пароль в переменную $password, если он пустой, то выдаём сообщение о ошибке
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    if (empty($password)) {$_SESSION['registration_errors']['password'] = 'Не введён пароль'; $this->errors['password'] = $_SESSION['registration_errors']['password'].'<br>';}

    // заносим введенный пользователем адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {$_SESSION['registration_errors']['email'] = 'Не введён адрес электронной почты'; $this->errors['email'] = $_SESSION['registration_errors']['email'].'<br>';}

    // заносим введенный пользователем код капчи в переменную $code, если он пустой, то выдаём сообщение о ошибке
    $code = isset($_POST['code']) ? trim($_POST['code']) : null;
    if (empty($code)) {$_SESSION['registration_errors']['code'] = 'Не введён код с картинки'; $this->errors['code'] = $_SESSION['registration_errors']['code'].'<br>';}

    // 2. Сохранение полученных данных в сессии
    $_SESSION['registration_data']['first_name'] = $first_name;
    $_SESSION['registration_data']['login'] = $login;
    // $_SESSION['registration_data']['password'] = $password; // пароль запоминать не нужно
    $_SESSION['registration_data']['email'] = $email;
    // $_SESSION['registration_data']['code'] = $code; // код запоминать не нужно

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных (начало)
    // если код не проходит валидацию, то выдаём сообщение об ошибке
    $code = validate($code, 'code');
    if ((empty($_SESSION['registration_errors']['code'])) and (isset($_SESSION['message']))) {
      $_SESSION['registration_errors']['code'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['code'] = $_SESSION['registration_errors']['code'].'<br>';
    }

    // если код капчи неверный, то удаляем переменную $code и выдаём ошибку
    if (check_code($code) === false) {
      unset($code,$_SESSION['captcha']);
      if (empty($_SESSION['registration_errors']['code'])) {
        $_SESSION['registration_errors']['code'] = 'Код с картинки введён неверно';
        //$_SESSION['registration_result'] = '<div class="alert alert-danger">Код с картинки введён неверно</div>';
        $this->errors['code'] = $_SESSION['registration_errors']['code'].'<br>';
        return false;
      }
    }

    // если имя, логин, пароль, е-майл введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $first_name = validate($first_name,'name');
    if ((empty($_SESSION['registration_errors']['first_name'])) and (isset($_SESSION['message']))) {
      $_SESSION['registration_errors']['first_name'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['first_name'] = $_SESSION['registration_errors']['first_name'].'<br>';
    }
    $login = validate($login, 'login');
    if ((empty($_SESSION['registration_errors']['login'])) and (isset($_SESSION['message']))) {
      $_SESSION['registration_errors']['login'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['login'] = $_SESSION['registration_errors']['login'].'<br>';
    }
    $password = validate($password, 'password');
    if ((empty($_SESSION['registration_errors']['password'])) and (isset($_SESSION['message']))) {
      $_SESSION['registration_errors']['password'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['password'] = $_SESSION['registration_errors']['password'].'<br>';
    }
    $email = validate($email, 'email');
    if ((empty($_SESSION['registration_errors']['email'])) and (isset($_SESSION['message']))) {
      $_SESSION['registration_errors']['email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['email'] = $_SESSION['registration_errors']['email'].'<br>';
    }

    // если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($first_name, 2, 30)) {
      if (empty($_SESSION['registration_errors']['first_name'])) {
        $_SESSION['registration_errors']['first_name'] = 'Имя должно состоять не менее чем из 2-х символов и не более чем из 30';
        $this->errors['first_name'] = $_SESSION['registration_errors']['first_name'].'<br>';
      }
    }

    // если длина логина меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($login, 3, 15)) {
      if (empty($_SESSION['registration_errors']['login'])) {
        $_SESSION['registration_errors']['login'] = 'Логин должен состоять не менее чем из 3-х символов и не более чем из 15';
        $this->errors['login'] = $_SESSION['registration_errors']['login'].'<br>';
      }
    }

    // если длина пароля меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($password, 3, 15)) {
      if (empty($_SESSION['registration_errors']['password'])) {
        $_SESSION['registration_errors']['password'] = 'Пароль должен состоять не менее чем из 3-х символов и не более чем из 15';
        $this->errors['password'] = $_SESSION['registration_errors']['password'].'<br>';
      }
    }

    // если пароль совпадает с логином или электронной почтой, то выдаём ошибку
    if (($password == $login) or ($password == $email)) {
      if (empty($_SESSION['registration_errors']['password'])) {
        $_SESSION['registration_errors']['password'] = 'Пароль не должен совпадать с логином или адресом электронной почты. Введите другой пароль';
        $this->errors['password'] = $_SESSION['registration_errors']['password'].'<br>';
      }
    }
    // Проверка (валидация) и обработка полученных данных (конец)

    //debug($_SESSION);

    // 4. Проверка логина на уникальность (проверка на существование пользователя с таким же логином)
    $unique_login = $this->check_unique_login($login); // проверяем логин на уникальность: true - логин уникальный, false - такой логин уже занят, Empty login - логин пустой
    //debug($unique_login);
    if ($unique_login === false) { // если получаем false - такой логин уже занят, то выдаём ошибку
      if (empty($_SESSION['registration_errors']['login'])) {
        $_SESSION['registration_errors']['login'] = 'Пользователь с логином '.$login.' уже зарегистрирован на сайте. Введите другой логин';
        $this->errors['login'] = $_SESSION['registration_errors']['login'].'<br>';
      }
      $_SESSION['registration_result'] = '<div class="alert alert-danger">Пользователь с логином <strong>'.$login.'</strong> уже зарегистрирован на сайте. Введите другой логин</div>';
      // $_SESSION['registration_data']['login'] = ''; // сбрасываем логин
      unset($login);
      return false;
    }
    else { // иначе если получаем true (логин уникальный) или Empty login - логин пустой, то проверяем наличие ошибок и готовим данные для сохранения в БД
      //debug($_SESSION['registration_errors']);
      //debug($_SESSION);

      // 5. Проверка наличия ошибок в ходе заполнения
      // если все поля заполнены верно и ошибок нет
      if (empty($_SESSION['registration_errors'])){

        // 6. Шифрование пароля
        // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
        // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
        $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa

        // 7. Подготовка данных к сохранению в БД
        $last_name = ''; // фамилия
        $avatar = DAVATAR; // путь к заранее приготовленной картинке с надписью "нет аватара"
        $photo = ''; // путь к фотографии, null - пустое значение
        $phone = ''; // номер телефона
        $site = ''; // адрес сайта или веб-страница
        $activ = 0; // активация: 0 - не активирован, 1 - активирован
        $status = 3; // статус пользователя: 0 - не существует/удалён, 1 - заблокирован, 2 - подписчик, 3 - обычный, 4 - модератор, 5 - администратор
        $method = 0; // способ авторизации: 0 - сайт rolar.ru, 1 - Вконтакте, 2 - Facebook, 3 - Twitter, 4 - Одноклассники, 5 - Mail.ru, 6 - Google, 7 -Yandex
        $social_id = ''; // ID в соц. сетях, null - пустое значение
        $reg_date = date("Y-m-d H:i:s"); // дата регистрации пользователя '1970-01-01 00:00:00'
        //$login_date = $reg_date; // дата авторизации пользователя '1970-01-01 00:00:00'
        $birthday = date("Y-m-d"); // дата рождения '1970-01-01'
        $gender = 0; // пол: 0 - не определён, 1 - женский, 2 - мужской
        $ip = get_ip(); // IPv4-адрес пользователя '127.0.0.1'
        $letter_type = 0; // Тип письма: 0 - обычное текстовое письмо, 1 - html-письмо
        $view = 0; // количество просмотров

        // 8. Сохранение пользователя в базе данных
        $user_id = $this->UserModel->add_user($first_name,$login,$shifr_password,$email, $last_name,$avatar,$photo,$phone,$site,$activ,$status,$method,$social_id,$reg_date,$birthday,$gender,$ip,$letter_type,$view);
        //debug($user_id);
        if ($user_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
          unset($_SESSION['registration_data'],$_SESSION['registration_errors']); // удаляем из сессии массивы пользовательских данных и ошибок при регистрации

          // 9. Генерация кода активации аккаунта
          $activation = shifr_activation($user_id,$login); // $email - не передаём, пустая строка

          // 10. Отправка уведомления на email
          // тема сообщения
          $subject = 'Подтверждение регистрации на сайте '.DOMEN;
          // содержание сообщения
          $message_for_mail = 'Здравствуйте, '.$first_name.'! Благодарим Вас за регистрацию на сайте '.DOMEN.'.'."\n".'
Ваш логин: '.$login."\n".'Ваш пароль: '.$password."\n".'
Чтобы активировать Ваш аккаунт, перейдите по ссылке:'."\n".D.S.'activation?login='.$login.'&code='.$activation."\n".'
С уважением,'."\n".'
  Администрация сайта '.DOMEN.'.';
          // отправляем сообщение
          //mail($email, $subject, $message_for_mail, "content-type: text/plane; charset=utf-8\r\n");
          $emails = get_one_email($email,$first_name,0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с активацией

          // 11. Формирование сообщений об успешной регистрации
          // добавляем скрипт перенаправления на главную страницу
          $registration_redirect = '<script language="javascript" type="text/javascript">setTimeout("document.location.href=\''.D.'\'", 60000);</script>'; // $_SESSION['registration_redirect']
          // сообщаем пользователю об успешной регистрации и о необходимости активации в полученном письме
          $_SESSION['registration_result'] = '<div class="alert alert-success">Регистрация прошла успешно.<br><br><strong>'.$first_name.'</strong>, благодарим Вас за регистрацию на сайте '.DOMEN.'!<br><br>Вам на e-mail <strong>'.$email.'</strong> было выслано письмо с темой &quot;<strong>Подтверждение регистрации на сайте '.DOMEN.'&quot;</strong>.<br>Для подтверждения регистрации:<br>1. Откройте это письмо,<br>2. Перейдите по специальной ссылке.<br>И тогда Ваш аккаунт будет полностью зарегистрирован и активирован.<br><br><strong>Внимание! Ссылка для активации действительна 24 часа!</strong></div>'.$registration_redirect; // $_SESSION['registration_redirect']
          $_SESSION['registration_success'] = true; // создаём метку об успешной регистрации (чтобы форма регистрации не отображалась)
          return true;
        }
        else {
          // в случае ошибки при добавлении пользователя в базу данных
          $_SESSION['registration_result'] = '<div class="alert alert-danger">Произошла ошибка! Вы не зарегистрированы</div>';
          return false;
        }
      }
      else {
        // если обязательные поля не заполнены или заполнены с ошибками
        $_SESSION['registration_result'] = '<div class="alert alert-danger">В ходе заполнения формы регистрации были допущены ошибки</div>';
        return false;
      }
    }
  }
  /* === Регистрация пользователя (конец) === */

  /* === Авторизация через социальные сети (начало) === */
  public function social_authorization(){
    unset($_SESSION['user']); // удаление данных пользователя из сессии
    $_SESSION['authorization_errors'] = array(); // массив для проверки наличия ошибок авторизации
    // $_SESSION['authorization_result'] = ''; // пуская строка

    // 1. Получение данных из массива $_SESSION['auth']
    //debug($_SESSION['auth']);

    // заносим имя в переменную $first_name, если оно пустое, то выдаём сообщение о ошибке
    $first_name = isset($_SESSION['auth']['first_name']) ? trim($_SESSION['auth']['first_name']) : null;
    if (empty($login)) {$_SESSION['authorization_errors']['first_name'] = 'Отсутствует имя'; $this->errors['first_name'] = $_SESSION['authorization_errors']['first_name'].'<br>';}

    // заносим фамилию в переменную $last_name, если она пустая, то выдаём сообщение о ошибке
    $last_name = isset($_SESSION['auth']['last_name']) ? trim($_SESSION['auth']['last_name']) : null;
    if (empty($login)) {$_SESSION['authorization_errors']['last_name'] = 'Отсутствует фамилия'; $this->errors['last_name'] = $_SESSION['authorization_errors']['last_name'].'<br>';}

    // заносим логин в переменную $login, если он пустой, то выдаём сообщение о ошибке
    $login = isset($_SESSION['auth']['login']) ? trim($_SESSION['auth']['login']) : null;
    if (empty($login)) {$_SESSION['authorization_errors']['login'] = 'Отсутствует логин'; $this->errors['login'] = $_SESSION['authorization_errors']['login'].'<br>';}

    // $avatar = $_SESSION['auth']['avatar']; if ($avatar == '' or empty($avatar)) {unset($avatar); $error = $error.'<li>Изображение для аватара не получено</li>';}

    // заносим изображение для аватара в переменную $photo, если оно пустое, то выдаём сообщение о ошибке
    $photo = isset($_SESSION['auth']['photo']) ? trim($_SESSION['auth']['photo']) : null;
    if (empty($photo)) {$_SESSION['authorization_errors']['photo'] = 'Изображение для аватара не получено'; $this->errors['photo'] = $_SESSION['authorization_errors']['photo'].'<br>';}

    // заносим адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке
    $email = isset($_SESSION['auth']['email']) ? trim($_SESSION['auth']['email']) : null;
    if (empty($email)) {$_SESSION['authorization_errors']['email'] = 'Отсутсвует адрес электронной почты'; $this->errors['email'] = $_SESSION['authorization_errors']['email'].'<br>';}

    // заносим адрес сайта в переменную $site
    $site = isset($_SESSION['auth']['site']) ? trim($_SESSION['auth']['site']) : null;

    // заносим метод авторизации в переменную $method, если он равен 0, то выдаём сообщение о ошибке
    $method = isset($_SESSION['auth']['method']) ? abs((int)$_SESSION['auth']['method']) : 0;
    if ($method == 0) {$_SESSION['authorization_errors']['method'] = 'Неверный способ авторизации'; $this->errors['method'] = $_SESSION['authorization_errors']['method'].'<br>';}

    // заносим social ID в переменную $social_id, если он пустой, то выдаём сообщение о ошибке
    $social_id = isset($_SESSION['auth']['social_id']) ? $_SESSION['auth']['social_id'] : '';
    if (empty($social_id)) {$_SESSION['authorization_errors']['social_id'] = 'Не получен ID пользователя'; $this->errors['social_id'] = $_SESSION['authorization_errors']['social_id'].'<br>';}

    $birthday = $_SESSION['auth']['birthday']; if ($birthday == '') {$birthday = '0000-00-00';}
    $gender = $_SESSION['auth']['gender']; if (empty($gender)) {$gender = 0;}

    // 2. Проверка (валидация) полученных данных (начало)
    // если имя, фамилия, логин, е-майл, сайт введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $first_name = validate($first_name,'name');
    if ((empty($_SESSION['registration_errors']['first_name'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['first_name'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['first_name'] = $_SESSION['authorization_errors']['first_name'].'<br>';
    }
    $last_name = validate($last_name, 'name');
    if ((empty($_SESSION['authorization_errors']['last_name'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['last_name'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['last_name'] = $_SESSION['authorization_errors']['last_name'].'<br>';
    }
    $login = validate($login, 'login');
    if ((empty($_SESSION['authorization_errors']['login'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['login'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['login'] = $_SESSION['authorization_errors']['login'].'<br>';
    }
    $email = validate($email, 'email');
    if ((empty($_SESSION['authorization_errors']['email'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['email'] = $_SESSION['authorization_errors']['email'].'<br>';
    }
    $site = validate($site, 'url');
    if ((empty($_SESSION['authorization_errors']['site'])) and (isset($_SESSION['message']))) {
      $_SESSION['authorization_errors']['site'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['site'] = $_SESSION['authorization_errors']['site'].'<br>';
    }

    // если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($first_name, 2, 30)) {
      if (empty($_SESSION['authorization_errors']['first_name'])) {
        $_SESSION['authorization_errors']['first_name'] = 'Имя должно состоять не менее чем из 2-х символов и не более чем из 30';
        $this->errors['first_name'] = $_SESSION['authorization_errors']['first_name'].'<br>';
      }
    }

    // если длина фамилии меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($last_name, 2, 30)) {
      if (empty($_SESSION['authorization_errors']['last_name'])) {
        $_SESSION['authorization_errors']['last_name'] = 'Фамилия должна состоять не менее чем из 2-х символов и не более чем из 30';
        $this->errors['last_name'] = $_SESSION['authorization_errors']['last_name'].'<br>';
      }
    }

    // если длина логина меньше 3 и больше 15 символов, то выдаём ошибку
    if (!check_length($login, 3, 15)) {
      if (empty($_SESSION['authorization_errors']['login'])) {
        $_SESSION['authorization_errors']['login'] = 'Логин должен состоять не менее чем из 3-х символов и не более чем из 15';
        $this->errors['login'] = $_SESSION['authorization_errors']['login'].'<br>';
      }
    }
    // 2. Проверка (валидация) полученных данных (конец)

    // 3. Проверка наличия ошибок в ходе заполнения
    // если все поля заполнены верно и ошибок нет
    if (empty($_SESSION['authorization_errors'])){

      // 4. Проверка на существование пользователя с таким же методом авторизации и социальным ID
      $result_user = $this->UserModel->get_user_for_socialauth($method,$social_id);

      if ((int)$result_user > 0) { // если совпадение найдено и получен массив (пользователь с таким social_id уже есть), то проверяем его логин и авторизуем его

        // 5. Авторизация пользователя - сохранение данных пользователя в сессии
        $this->authorization(['id' => $result_user['id'], 'login' => $result_user['login'], 'password' => $result_user['password']]);
        //$_SESSION['user']['id'] = $result_user['id'];
        //$_SESSION['user']['login'] = $result_user['login'];
        //$_SESSION['user']['password'] = $result_user['password'];
        $password = $result_user['password'];

        // 6. Обновление файла аватара и фотографии на сервере и в БД
        if (($result_user['photo'] != $photo) or (get_images_name($result_user['avatar']) != get_images_name($photo))) {
          $new_avatar = get_avatar($photo); // загружаем новый аватар и получаем ссылку на него
          $result_update_user = $this->UserModel->update_avatar_login_date($result_user['id'], $new_avatar, $photo);
          if ($result_update_user == true) {
            $delfull = $result_user['avatar']; // удаляем старый аватар
            unlink($delfull);
          }
        }

      }
      else {
        // иначе если такого пользователя нет, то регистрируем его и сохраняем данные

        // 7. Шифрование пароля
        $password = '111';
        // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
        // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
        $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa

        // 8. Подготовка данных к сохранению в БД
        //$last_name = ''; // фамилия
        $avatar = get_avatar($photo); // загружаем новый аватар и получаем ссылку на него
        //$photo = ''; // путь к фотографии, null - пустое значение
        $phone = ''; // номер телефона
        //$site = ''; // адрес сайта или веб-страница
        $activ = 1; // активация: 0 - не активирован, 1 - активирован
        $status = 3; // статус пользователя: 0 - не существует/удалён, 1 - заблокирован, 2 - подписчик, 3 - обычный, 4 - модератор, 5 - администратор
        //$method = 0; // способ авторизации: 0 - сайт rolar.ru, 1 - Вконтакте, 2 - Facebook, 3 - Twitter, 4 - Одноклассники, 5 - Mail.ru, 6 - Google, 7 -Yandex
        //$social_id = ''; // ID в соц. сетях, null - пустое значение
        $reg_date = date("Y-m-d H:i:s"); // дата регистрации пользователя '1970-01-01 00:00:00'
        //$login_date = $reg_date; // дата авторизации пользователя '1970-01-01 00:00:00'
        //$birthday = date("Y-m-d"); // дата рождения '1970-01-01'
        //$gender = 0; // пол: 0 - не определён, 1 - женский, 2 - мужской
        $ip = get_ip(); // IPv4-адрес пользователя '127.0.0.1'
        $letter_type = 0; // Тип письма: 0 - обычное текстовое письмо, 1 - html-письмо
        $view = 0; // количество просмотров

        // 9. Сохранение пользователя в базе данных
        $user_id = $this->UserModel->add_user($first_name,$login,$shifr_password,$email, $last_name,$avatar,$photo,$phone,$site,$activ,$status,$method,$social_id,$reg_date,$birthday,$gender,$ip,$letter_type,$view);
        //debug($user_id);
        if ($user_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
          unset($_SESSION['authorization_errors']); // удаляем из сессии массив ошибок при авторизации

          // 10. Авторизация пользователя - сохранение данных пользователя в сессии
          $this->authorization(['id' => $user_id, 'login' => $login, 'password' => $shifr_password]);

          // 11. Обновление даты последней авторизации и IP-адреса пользователя в базе данных
          $this->UserModel->update_login_date($login, $shifr_password, $ip);

          // 12. Отправка уведомления на email
          // тема сообщения
          $subject = 'Регистрации на сайте '.DOMEN.' успешно завершена + ПОДАРОК!';
          // содержание сообщения
          $message_for_mail = 'Здравствуйте, '.$first_name.'! Благодарим Вас за регистрацию на сайте '.DOMEN.'.'."\n".'
Ваш e-mail подтверждён и регистрация успешно завершена!'."\n".'
Теперь Вы можете зайти на сайт, используя Ваш логин: '.$login."\n".'и Ваш пароль: '.$password."\n".'
В знак благодарности мы дарим Вам специальный Код подписчика, благодаря которому Вы сможете скачивать материалы в Секретном разделе сайта.'."\n".'
Код подписчика: '.CODE."\n".'
С уважением,'."\n".'
  Администрация сайта '.DOMEN.'.';
          // отправляем сообщение
          //mail($email, $subject, $message_for_mail, "content-type: text/plane; charset=utf-8\r\n");
          $emails = get_one_email($email,$first_name,0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо об успешной регистрации
        }
      }

      // 13. Сохранение данных пользователя в куках для последующего входа
      // сохраняем в куки id пользователя, логин и пароль и метку "Запомнить меня". Время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
      setcookie('id', $_SESSION['user']['id'], time()+31536000, '/');
      setcookie('login', $_SESSION['user']['login'], time()+31536000, '/');
      setcookie('password', $this->encrypt($password), time()+31536000, '/');
      setcookie('remember', 'on', time()+31536000, '/');

      // сообщаем пользователю об удачном входе и перенаправляем его на главную страничку
      $_SESSION['authorization_success'] = 'Вы зашли на сайт как <strong>'.$_SESSION['user']['login'].'</strong>';
      unset($_SESSION['authorization_errors']);
    }
    else {
      // если обязательные поля не заполнены или заполнены с ошибками
      $_SESSION['authorization_result'] = '<div class="alert alert-danger">В ходе регистрации и авторизации были допущены ошибки</div>';
      return false;
    }
  }
  /* === Авторизация через социальные сети (конец) === */

  /* === Активация аккаунта или подтверждение email (начало) === */
  public function activation(){
    // удаляем пользователей, которые в течении часа не активировали свой аккаунт
    $query = "UPDATE users SET status='0' WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(reg_date) > 86400";
    $this->UserModel->sql($query, false);

    $_SESSION['activation_errors'] = array(); // массив для проверки наличия ошибок активации

    // 1. Получение данных из массива $_GET
    //debug($_GET);

    // принимаем логин, email и код активации, удаляем лишние пробелы
    // заносим логин в переменную $login, если он пустой, то выдаём сообщение о ошибке
    $login = isset($_GET['login']) ? trim($_GET['login']) : null;
    //if (empty($login)) {$_SESSION['activation_errors']['login'] = 'Отсутсвует логин'; $this->errors['login'] = $_SESSION['activation_errors']['login'].'<br>';}

    // заносим адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке (передаётся в случае активации подписки!)
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    //if (empty($email)) {$_SESSION['activation_errors']['email'] = 'Отсутствует адрес электронной почты'; $this->errors['email'] = $_SESSION['activation_errors']['email'].'<br>';}

    // заносим код активации в переменную $code, если он пустой, то выдаём сообщение о ошибке
    $code = isset($_GET['code']) ? trim($_GET['code']) : null;
    if (empty($code)) {
      $_SESSION['activation_errors'] = 'Отсутствует код подтверждения';
      $_SESSION['activation_result'] = '<div class="alert alert-danger">Отсутствует код подтверждения</div>';
      $this->errors = $_SESSION['activation_errors'].'<br>';
      return false;
    }

    // 3. Проверка (валидация) и обработка полученных данных
    if (!empty($login)) { // если логин не пустой, то проверяем его
      $login = validate($login, 'login');
      if ((empty($_SESSION['activation_errors'])) and (isset($_SESSION['message']))) {
        $_SESSION['activation_errors'] = $_SESSION['message']; unset($_SESSION['message']);
        $this->errors = $_SESSION['activation_errors'].'<br>';
      }
    }
    if (!empty($email)) { // если email не пустой, то проверяем его
      $email = validate($email, 'email');
      if ((empty($_SESSION['activation_errors'])) and (isset($_SESSION['message']))) {
        $_SESSION['activation_errors'] = $_SESSION['message']; unset($_SESSION['message']);
        $this->errors = $_SESSION['activation_errors'].'<br>';
      }
    }
    // если код не проходит валидацию, то выдаём сообщение об ошибке
    $code = validate($code, 'md5');
    if ((empty($_SESSION['activation_errors'])) and (isset($_SESSION['message']))) {
      $_SESSION['activation_errors'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors = $_SESSION['activation_errors'].'<br>';
    }

    // 4. Проверка на заполнение данных
    // если не указан логин и email или код активации, то выдаём ошибку
    if (((empty($login)) and (empty($email))) or (empty($code)) or (!empty($_SESSION['activation_errors']))) {
      $message = 'Вы зашли на страницу активации без логина, адреса электронной почты и кода подтверждения, либо данные переданы неверно';
      $_SESSION['activation_result'] = '<div class="alert alert-danger">'.$message.'</div>';
      $this->errors = $message.'<br>';
      //$message = '<div class="error">Вы зашли на страницу активации без логина, адреса электронной почты и кода подтверждения, либо данные неверны</div>';
      return false;
    }
    else {
      unset($_SESSION['activation_errors']);

      // 5. Получение данных пользователя из базы данных
      // извлекаем id пользователя, имя (для письма), пароль (для авторизации), емайл (для отправки письма), метку об активации и статус пользователя с данным логином или email
      $result_user = $this->UserModel->get_user_for_activation($login,$email);
      //debug($result_user);

      // 6. Проверка на существование пользователя с таким логином или email и его нужно активировать (метка активации равна 0)
      // если пользователь с введённым логином или email есть в БД и его метака об активации равна 0, то продолжаем процесс активации
      if (((int)$result_user > 0) and ($result_user['activation'] == 0)) {

        // 7. Проверка кода подтверждения активации
        // генерируем код подтверждения и сравниваем с кодом, полученным из url
        $activation = shifr_activation($result_user['id'],$login,$email);
        //debug($activation); // http://localhost/activation?login=rolar&code=11d9fdf170585f75516dfb054f26508b

        if ($activation === $code) { // если код совпадает

          // 8. Активация аккаунта или подтверждение email
          $result_activation = $this->UserModel->activation_user($result_user['id']); // то активируем пользователя
          if ($result_activation == true) { // если активация прошла успешно

            //debug($login);
            //debug($email);
            //debug($result_user['email']);
            //debug($result_user['status']);

            // 9. Формирование писем и сообщений об успешной активации
            if ((!empty($login)) and ($result_user['status'] > 2)) { // для активации пользователя
              // тема сообщения
              $subject = 'Регистрация на сайте '.DOMEN.' успешно завершена + ПОДАРОК!';
              // содержание сообщения
              $message_for_mail = 'Здравствуйте, '.$result_user['first_name'].'! Благодарим Вас за регистрацию на сайте '.DOMEN."\n".'
Ваш e-mail '.$result_user['email'].' подтверждён и регистрация успешно завершена!'."\n".'
Теперь Вы можете зайти на сайт под своим логином '.$login.'!'."\n".'
В знак благодарности мы дарим Вам специальный Код подписчика, благодаря которому Вы сможете скачивать материалы в Секретном разделе сайта.'."\n".'
Код подписчика: '.CODE."\n".'
С уважением,'."\n".'
    Администрация сайта '.DOMEN.'.';
              // уведомление об успешной активации
              $message = 'Благодарим Вас за регистрацию на сайте '.DOMEN.'!<br>Ваш e-mail <strong>'.$result_user['email'].'</strong> подтверждён и регистрация успешно завершена!<br>Теперь Вы можете зайти на сайт под своим логином <strong>'.$login.'</strong>';

              // 10. Автоматически авторизуем пользователя
              $this->authorization(['id' => $result_user['id'], 'login'=>$login, 'password'=>$result_user['password'], 'avatar'=>$result_user['avatar']]);
              //$_SESSION['user']['id'] = $result_user['id'];
              //$_SESSION['user']['login'] = $login;
              //$_SESSION['user']['password'] = $result_user['password'];

              // 11. Обновление даты последней авторизации и IP-адреса пользователя в базе данных
              $this->UserModel->update_login_date($login, $result_user['password']);
            }
            else { // для активации подписчика
              // тема сообщения
              $subject = 'Подписка на сайте '.DOMEN.' успешно завершена';
              // содержание сообщения
              $message_for_mail = 'Здравствуйте, '.$result_user['first_name'].'! Благодарим Вас за подписку на сайте '.DOMEN.'.'."\n".'
Ваш e-mail '.$result_user['email'].' подтверждён и подписка успешно завершена!'."\n".'
С уважением,'."\n".'
    Администрация сайта '.DOMEN.'.';
              // уведомление об успешной подписке
              $message = 'Благодарим Вас за подписку на сайте '.DOMEN.'!<br>Ваш e-mail <strong>'.$result_user['email'].'</strong> подтверждён и подписка успешно завершена';
            }

            // 12. Отправка уведомлений на email
            //mail($email, $subject, $message_for_mail, "content-type: text/plane; charset=utf-8\r\n");
            $emails = get_one_email($result_user['email'],$result_user['first_name'],0);
            $mail = new Mail(); // инициализируем класс
            $mail->Mail($emails, $subject, $message_for_mail); // отправляем сообщение

            $_SESSION['activation_result'] = '<div class="alert alert-success">'.$message.'</div>'; // сообщение об успешной активации
            return true;
          }
          else { // иначе, если активация не произошла
            $message = 'Произошла ошибка! Ваш аккаунт не зарегистрирован, e-mail не подтверждён';
            $_SESSION['activation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
            return false;
          }
        }
        else {
          // если же полученный из url и сгенерированный код не равны, то выдаём ошибку
          $message = 'Код подтверждения неверный! Ваш аккаунт не зарегистрирован, e-mail не подтверждён';
          $_SESSION['activation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
          return false;
        }
      }
      else {
        // если пользователь с введённым логином или email не найден в БД или его метка об активации не равна 0, то выдаём ошибку
        $message = 'Ваш аккаунт либо не найден или удалён, либо уже активирован, email подтверждён. Активация не требуется';
        $_SESSION['activation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
        return false;
      }
    }
  }
  /* === Активация аккаунта или подтверждение email (конец) === */

  /* === Отписка от почтовой рассылки (деактивация) (начало) === */
  public function deactivation(){
    // удаляем пользователей, которые в течении часа не активировали свой аккаунт
    $query = "UPDATE users SET status='0' WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(reg_date) > 86400";
    $this->UserModel->sql($query, false);

    $_SESSION['deactivation_errors'] = array(); // массив для проверки наличия ошибок активации

    // 1. Получение данных из массива $_GET
    //debug($_GET);

    // принимаем email и код деактивации, удаляем лишние пробелы
    // заносим адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке (передаётся в случае активации подписки!)
    $email = isset($_GET['email']) ? trim($_GET['email']) : null;
    //if (empty($email)) {$_SESSION['deactivation_errors']['email'] = 'Отсутствует адрес электронной почты'; $this->errors['email'] = $_SESSION['deactivation_errors']['email'].'<br>';}

    // заносим код активации в переменную $code, если он пустой, то выдаём сообщение о ошибке
    $code = isset($_GET['code']) ? trim($_GET['code']) : null;
    if (empty($code)) {
      $_SESSION['deactivation_errors'] = 'Отсутствует код подтверждения';
      $_SESSION['deactivation_result'] = '<div class="alert alert-danger">Отсутствует код подтверждения</div>';
      $this->errors = $_SESSION['deactivation_errors'].'<br>';
      return false;
    }

    // 3. Проверка (валидация) и обработка полученных данных
    if (!empty($email)) { // если email не пустой, то проверяем его
      $email = validate($email, 'email');
      if ((empty($_SESSION['deactivation_errors'])) and (isset($_SESSION['message']))) {
        $_SESSION['deactivation_errors'] = $_SESSION['message']; unset($_SESSION['message']);
        $this->errors = $_SESSION['deactivation_errors'].'<br>';
      }
    }
    // если код не проходит валидацию, то выдаём сообщение об ошибке
    $code = validate($code, 'md5');
    if ((empty($_SESSION['deactivation_errors'])) and (isset($_SESSION['message']))) {
      $_SESSION['deactivation_errors'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors = $_SESSION['deactivation_errors'].'<br>';
    }

    // 4. Проверка на заполнение данных
    // если не указан логин и email или код активации, то выдаём ошибку
    if (((empty($email))) or (empty($code)) or (!empty($_SESSION['deactivation_errors']))) {
      $message = 'Вы зашли на страницу деактивации без адреса электронной почты и кода подтверждения, либо данные переданы неверно';
      $_SESSION['deactivation_result'] = '<div class="alert alert-danger">'.$message.'</div>';
      $this->errors = $message.'<br>';
      //$message = '<div class="error">Вы зашли на страницу деактивации без адреса электронной почты и кода подтверждения, либо данные неверны</div>';
      return false;
    }
    else {
      unset($_SESSION['deactivation_errors']);

      // 5. Получение данных пользователя из базы данных
      // извлекаем id пользователя, метку об активации и статус пользователя с данным email
      $result_user = $this->UserModel->get_user_for_deactivation($email);
      //debug($result_user);

      // 6. Проверка на существование пользователя с таким email и его нужно деактивировать (метка активации равна 1)
      // если пользователь с введённым email есть в БД и его метака об активации равна 1, то продолжаем процесс деактивации
      if (((int)$result_user > 0) and ($result_user['activation'] == 1) and ($result_user['status'] == 2)) {

        // 7. Проверка кода подтверждения деактивации
        // генерируем код подтверждения и сравниваем с кодом, полученным из url
        $deactivation = shifr_activation($result_user['id'],'',$email);
        //debug($deactivation); // http://localhost/deactivation?email=admin@rolar.ru&code=11d9fdf170585f75516dfb054f26508b

        if ($deactivation === $code) { // если код совпадает

          // 8. Деактивация почтовой рассылки
          $result_activation = $this->UserModel->deactivation_user($result_user['id']); // то деактивируем пользователя
          if ($result_activation == true) { // если деактивация прошла успешно
            //debug($email);
            //debug($result_user['status']);

            // уведомление об успешной отписки от почтовой рассылки
            $message = 'Благодарим Вас за отписку на сайте '.DOMEN.'!<br>Ваш e-mail <strong>'.$email.'</strong> отписан от рассылки новостей!<br>Теперь письма с новостями на сайте '.DOMEN.' к вам приходить не будут';
            $_SESSION['deactivation_result'] = '<div class="alert alert-success">'.$message.'</div>'; // сообщение об успешной активации
            return true;
          }
          else { // иначе, если отписка не произошла
            $message = 'Произошла ошибка! Ваш e-mail не отписан';
            $_SESSION['deactivation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
            return false;
          }
        }
        else {
          // если же полученный из url и сгенерированный код не равны, то выдаём ошибку
          $message = 'Код подтверждения неверный! Ваш e-mail не отписан';
          $_SESSION['deactivation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
          return false;
        }
      }
      else {
        // если пользователь с введённым email не найден в БД или его метка об активации не равна 1, то выдаём ошибку
        $message = 'Ваш e-mail либо не найден или удалён, либо уже отписан. Отписка не требуется';
        $_SESSION['deactivation_result'] = '<div class="alert alert-danger">'.$message.'</div>'; $this->errors = $message.'<br>';
        return false;
      }
    }
  }
  /* === Отписка от почтовой рассылки (деактивация) (конец) === */

  /* === Подписка на почтовую рассылку (начало) === */
  public function subscription(){
    $_SESSION['subscription_errors'] = array(); // массив для проверки наличия ошибок подписки
    $_SESSION['subscription_data'] = array(); // массив для хранения введённых данных пользователя
    // $_SESSION['authorization_result'] = ''; // пуская строка

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['subscription_token']) ? trim($_POST['subscription_token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'subscription'))) {
      $_SESSION['subscription_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['subscription_errors']['token'].'<br>';
      $_SESSION['subscription_result'] = 'Ошибка при отправке данных. Форма не валидна';
      unset($token);
      return false;
    }

    // удаляем лишние пробелы, если пользователь не ввёл имя/фамилию или e-mail, то выдаем ошибку
    // заносим введенное пользователем имя в переменную $first_name, если оно пустое, то выдаём сообщение о ошибке
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : null;
    if (empty($first_name)) {$_SESSION['subscription_errors']['first_name'] = 'Не введено имя'; $this->errors['first_name'] = $_SESSION['subscription_errors']['first_name'].'<br>';}

    // заносим введенный пользователем адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {$_SESSION['subscription_errors']['email'] = 'Не введён адрес электронной почты'; $this->errors['email'] = $_SESSION['subscription_errors']['email'].'<br>';}

    // заносим введенный пользователем адрес сайта в переменную $site, если он пустой, то удаляем переменную
    $site = isset($_POST['site']) ? trim($_POST['site']) : null;

    // 2. Сохранение полученных данных в сессии
    $_SESSION['subscription_data']['first_name'] = $first_name;
    $_SESSION['subscription_data']['email'] = $email;
    if (isset($site)) {
      $_SESSION['subscription_data']['site'] = $site;
    }
    else {
      $site = '';
      unset($_SESSION['subscription_data']['site']);
    }

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных (начало)
    // если имя, email, сайт введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $first_name = validate($first_name,'name');
    if ((empty($_SESSION['subscription_errors']['first_name'])) and (isset($_SESSION['message']))) {
      $_SESSION['subscription_errors']['first_name'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['first_name'] = $_SESSION['subscription_errors']['first_name'].'<br>';
    }
    $email = validate($email, 'email');
    if ((empty($_SESSION['subscription_errors']['email'])) and (isset($_SESSION['message']))) {
      $_SESSION['subscription_errors']['email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['email'] = $_SESSION['subscription_errors']['email'].'<br>';
    }
    $site = validate($site, 'url');
    /*
    if ((empty($_SESSION['subscription_errors']['site'])) and (isset($_SESSION['message']))) {
      $_SESSION['subscription_errors']['site'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['site'] = $_SESSION['subscription_errors']['site'].'<br>';
    } */

    // если длина имени/фамилии меньше 2 и больше 30 символов, то выдаём ошибку
    if (!check_length($first_name, 2, 30)) {
      if (empty($_SESSION['subscription_errors']['first_name'])) {
        $_SESSION['subscription_errors']['first_name'] = 'Имя должно состоять не менее чем из 2-х символов и не более чем из 30';
        $this->errors['first_name'] = $_SESSION['subscription_errors']['first_name'].'<br>';
      }
    }

    // проверка еmail на существование и доступность, если email не существует или не доступен, то выдаём ошибку
    $checkmail = new CheckMail();
    if ((empty($email)) or (!$checkmail->execute($email))) {
      if (empty($_SESSION['subscription_errors']['email'])) {
        $_SESSION['subscription_errors']['email'] = 'Адрес электронной почты не существует или не доступен';
        $this->errors['email'] = $_SESSION['subscription_errors']['email'].'<br>';
      }
    }
    // 3. Проверка (валидация) и обработка полученных данных (конец)

    //debug($_SESSION);
    //echo '$first_name = '.$first_name.'<br>$email = '.$email;

    // 4. Проверка на наличие ошибок: если все поля заполнены и ошибок нет
    if (empty($_SESSION['subscription_errors'])){
      //debug($_SESSION);

      // 5. Проверка на существование пользователя с таким же email в базе данных (проверка email на уникальность)
      $result_user = $this->UserModel->get_user_for_subscription($email); // извлекаем из базы данных id пользователя с введённым email - получаем либо массив, либо false если пользователь не найден
      //debug((int)$result_user);
      if ((int)$result_user > 0) { // 1 - такой email есть, 0 - такого email нет; если получаем false - такой email уже есть, то выдаём ошибку
        /* if (empty($_SESSION['subscription_errors']['email'])) {
          $_SESSION['subscription_errors']['email'] = 'Пользователь с таким адресом электронной почты уже подписан на сайте. Введите другой адрес электронной почты';
          $this->errors['email'] = $_SESSION['subscription_errors']['email'].'<br>';
        } */
        $_SESSION['subscription_result'] = '<div class="alert alert-danger">Пользователь с таким адресом электронной почты уже подписан на сайте. Введите другой адрес электронной почты</div>';
        // $_SESSION['subscription_data']['email'] = ''; // сбрасываем email
        unset($email);
        return false;
      }
      else {
        // иначе если такого email нет, то сохраняем данные

        // 6. Подготовка данных к сохранению в БД
        $last_name = ''; // фамилия
        $login = ''; // логин ПУСТОЙ
        $password = ''; // пароль ПУСТОЙ
        $avatar = DAVATAR; // путь к заранее приготовленной картинке с надписью "нет аватара"
        $photo = ''; // путь к фотографии, null - пустое значение
        $phone = ''; // номер телефона
        if (!isset($site)) {$site = '';} // адрес сайта или веб-страница
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
        $user_id = $this->UserModel->add_user($first_name,$login,$password,$email, $last_name,$avatar,$photo,$phone,$site,$activ,$status,$method,$social_id,$reg_date,$birthday,$gender,$ip,$letter_type,$view);
        //debug($user_id);
        if ($user_id > 0){ // если запись добавлена, получаем id пользователя по последней вставленной записи - необходим для получения кода активации
          unset($_SESSION['subscription_data'],$_SESSION['subscription_errors']); // удаляем из сессии массивы пользовательских данных и ошибок при подписке

          // 8. Генерация кода активации аккаунта
          $activation = shifr_activation($user_id,$login,$email);

          // 9. Отправка уведомления на email
          // тема сообщения
          $subject = 'Подтверждение подписки на сайте '.DOMEN;
          // содержание сообщения
          $message_for_mail = 'Здравствуйте, '.$first_name.'! Благодарим Вас за подписку на сайте '.DOMEN.'.'."\n".'
Ваш email: '.$email."\n".'
Чтобы активировать Ваш аккаунт, перейдите по ссылке:'."\n".D.S.'activation?email='.$email.'&code='.$activation."\n".'
С уважением,'."\n".'
    Администрация сайта '.DOMEN.'.';
          // отправляем сообщение
          //mail($email, $subject, $message_for_mail, "content-type: text/plane; charset=utf-8\r\n");
          $emails = get_one_email($email,$first_name,0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с активацией

          // 10. Формирование сообщений об успешной подписке
          // сообщаем пользователю об успешной подписке и о необходимости активации в полученном письме
          $_SESSION['subscription_result'] = '<div class="alert alert-success">Подписка прошла успешно.<br><br><strong>'.$first_name.'</strong>, благодарим Вас за подписку на сайте '.DOMEN.'!<br><br>Вам на e-mail <strong>'.$email.'</strong> было выслано письмо с темой &quot;<strong>Подтверждение подписки на сайте '.DOMEN.'&quot;</strong>.<br>Для подтверждения подписки:<br>1. Откройте это письмо,<br>2. Перейдите по специальной ссылке.<br>И тогда Ваш адрес электронной почты будет зарегистрирован.<br><br><strong>Внимание! Ссылка для активации действительна 24 часа!</strong></div>';
          $_SESSION['subscription_success'] = true; // создаём метку об успешной подписке (чтобы форма регистрации не отображалась)
          setcookie('subscription', true, time() + EXPIRATION_TIME, '/'); // создаем куку Подписака со значением true на 24 часа
          return true;
        }
        else {
          // в случае ошибки при добавлении пользователя в базу данных
          $_SESSION['subscription_result'] = '<div class="alert alert-danger">Произошла ошибка! Вы не подписаны</div>';
          return false;
        }
      }
    }
    else {
      // если обязательные поля не заполнены или заполнены с ошибками
      $_SESSION['subscription_result'] = '<div class="alert alert-danger">В ходе заполнения формы подписки были допущены ошибки</div>';
      return false;
    }
  }
  /* === Подписка на почтовую рассылку (конец) === */

  /* === Восстановление пароля (начало) === */
  public function send_password() {
    $_SESSION['send_password_errors'] = array(); // массив для проверки наличия ошибок восстановления пароля
    $_SESSION['send_password_data'] = array(); // массив для хранения введённых данных пользователя
    // $_SESSION['send_password_result'] = ''; // пуская строка

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['token']) ? trim($_POST['token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'send_password'))) {
      $_SESSION['send_password_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['send_password_errors']['token'].'<br>';
      $_SESSION['send_password_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
      unset($token);
      return false;
    }

    // заносим введенный пользователем логин в переменную $login, если он пустой, то выдаём сообщение о ошибке
    $login = isset($_POST['login']) ? trim($_POST['login']) : null;
    if (empty($login)) {$_SESSION['send_password_errors']['login'] = 'Не введён логин'; $this->errors['login'] = $_SESSION['send_password_errors']['login'].'<br>';}

    // заносим введенный пользователем адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {$_SESSION['send_password_errors']['email'] = 'Не введён адрес электронной почты'; $this->errors['email'] = $_SESSION['send_password_errors']['email'].'<br>';}

    // 2. Сохранение полученных данных в сессии
    $_SESSION['send_password_data']['login'] = $login;
    $_SESSION['send_password_data']['email'] = $email;

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных (начало)
    // если логин и email введены, то проверяем и обрабатываем их, чтобы теги и скрипты не сработали
    $login = validate($login,'login');
    if ((empty($_SESSION['send_password_errors']['login'])) and (isset($_SESSION['message']))) {
      $_SESSION['send_password_errors']['login'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['login'] = $_SESSION['send_password_errors']['login'].'<br>';
    }
    $email = validate($email, 'email');
    if ((empty($_SESSION['send_password_errors']['email'])) and (isset($_SESSION['message']))) {
      $_SESSION['send_password_errors']['email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['email'] = $_SESSION['send_password_errors']['email'].'<br>';
    }

    // 4. Проверка наличия ошибок при заполнении формы
    // если все поля заполнены верно и ошибок нет
    if (empty($_SESSION['send_password_errors'])) {

      // 5. Проверка существования пользователя с таким логинои и email в базе данных
      $result_user = $this->UserModel->get_user_for_send_password($login,$email);
      //debug($result_user);
      if ($result_user == false) { // если совпадение не найдено и id-пользователя пустой (1 - такой id есть, 0 - нет), то выдаём ошибку
        $_SESSION['send_password_result'] = '<div class="alert alert-danger">Пользователь с таким логином и адресом электронной почты не найден</div>';
        $this->errors['email'] = 'Пользователь с таким логином и адресом электронной почты не найден<br>';
        return false;
      }
      else {
        // иначе если такой пользователь есть, то необходимо сгенерировать новый случайный пароль для пользователя, обновить его в базе данных и отправить на е-мейл
        //debug($_SESSION);
        unset($_SESSION['send_password_errors'],$_SESSION['send_password_data']);

        // 6. Генерация нового случайного пароля
        $new_password = generate_password();
        //debug($new_password);

        // 7. Шифрование пароля
        // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
        // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
        $shifr_password = shifr_password($new_password); // 111 = ca89b6b21f977a18455187a4e229f1fa

        // 8. Обновление пароля в базе данных
        $result_update_password = $this->UserModel->update_password($shifr_password,$login);
        if ($result_update_password == 'true') { // если пароль успешно обновился

          // 9. формирование сообшения об успешном обновлении пароля
          $subject = 'Восстановление пароля';
          $message_for_mail = 'Здравствуйте, '.$result_user['first_name'].'!'."\n".'Для Вас был сгенерирован новый пароль. Теперь Вы сможете войти на сайт '.DOMEN.', используя его.'."\n".'Ваш новый пароль:'."\n".$new_password."\n".'После входа желательно его сменить.'."\n".'С уважением,'."\n".'Администрация сайта '.DOMEN.'.';

          // 10. Отправка сообщения
          //mail($email, "Восстановление пароля", $message, "content-type: text/plane; charset=utf-8\r\n");
          $emails = get_one_email($email,$result_user['first_name'],0); // получаем массив из адреса почты, логина получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо о восстановлении пароля

          // 11. Выдаём пользователю сообщение
          $_SESSION['send_password_result'] = '<div class="alert alert-success">Для Вас был сгенерирован новый пароль. На Ваш e-mail '.$email.' отправлено письмо с Вашим новым паролем.</div>';
          return true;
        }
        else { // если пароль не обновился выдаём сообщение об ошибке
          $_SESSION['send_password_result'] = '<div class="alert alert-danger">Произошла ошибка! Пароль не обновился</div>';
          return false;
        }
      }
    }
    else {
      // иначе если возникли ошибки в ходе заполнения
      $_SESSION['send_password_result'] = '<div class="alert alert-danger">В ходе заполнения формы восстановления пароля были допущены ошибки</div>';
      return false;
    }
  }
  /* === Восстановление пароля (конец) === */

  /* === Восстановление логина (начало) === */
  public function send_login() {
    $_SESSION['send_login_errors'] = array(); // массив для проверки наличия ошибок восстановления логина
    $_SESSION['send_login_data'] = array(); // массив для хранения введённых данных пользователя
    // $_SESSION['send_login_result'] = ''; // пуская строка

    // 1. Получение данных из массива $_POST
    //debug($_POST);

    // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
    $token = isset($_POST['token']) ? trim($_POST['token']) : null;
    //debug($token);
    if ((empty($token)) or (!$this->checkToken($token,'send_login'))) {
      $_SESSION['send_login_errors']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['send_login_errors']['token'].'<br>';
      $_SESSION['send_login_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
      unset($token);
      return false;
    }

    // заносим введенный пользователем адрес электронной почты в переменную $email, если он пустой, то выдаём сообщение о ошибке
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {$_SESSION['send_login_errors']['email'] = 'Не введён адрес электронной почты'; $this->errors['email'] = $_SESSION['send_login_errors']['email'].'<br>';}

    // 2. Сохранение полученных данных в сессии
    $_SESSION['send_password_data']['email'] = $email;

    //debug($_SESSION);

    // 3. Проверка (валидация) и обработка полученных данных (начало)
    // если email введён, то проверяем и обрабатываем его, чтобы теги и скрипты не сработали
    $email = validate($email, 'email');
    if ((empty($_SESSION['send_login_errors']['email'])) and (isset($_SESSION['message']))) {
      $_SESSION['send_login_errors']['email'] = $_SESSION['message']; unset($_SESSION['message']);
      $this->errors['email'] = $_SESSION['send_login_errors']['email'].'<br>';
    }

    // 4. Проверка наличия ошибок при заполнении формы
    // если все поля заполнены верно и ошибок нет
    if (empty($_SESSION['send_login_errors'])) {

      // 5. Проверка существования пользователя с таким email в базе данных
      $result_user = $this->UserModel->get_user_for_send_login($email);
      //debug($result_user);
      if ($result_user == false) { // если совпадение не найдено и id-пользователя пустой (1 - такой id есть, 0 - нет), то выдаём ошибку
        $_SESSION['send_login_result'] = '<div class="alert alert-danger">Пользователь с таким адресом электронной почты не найден</div>';
        $this->errors['email'] = 'Пользователь с таким адресом электронной почты не найден<br>';
        return false;
      }
      else {
        // иначе если такой пользователь есть, то необходимо отправить его логин на е-мейл
        //debug($_SESSION);
        unset($_SESSION['send_login_errors'],$_SESSION['send_login_data']);

        // 6. формирование сообшения об успешном обновлении пароля
        $subject = 'Восстановление логина';
        $message_for_mail = 'Здравствуйте, '.$result_user['first_name'].'!'."\n".'Ваш логин:'."\n".$result_user['login']."\n".'Запишите его в удобное для Вас место, чтобы не забыть его в следующий раз :-)'."\n".'С уважением,'."\n".'Администрация сайта '.DOMEN.'.';

        // 7. Отправка сообщения
        //mail($email, "Восстановление логина", $message, "content-type: text/plane; charset=utf-8\r\n");
        $emails = get_one_email($email,$result_user['first_name'],0); // получаем массив из адреса почты, логина получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо о восстановлении пароля

        // 8. Выдаём пользователю сообщение
        $_SESSION['send_login_result'] = '<div class="alert alert-success">Ваш логин:<br><strong>'.$result_user['login'].'</strong><br>Запишите его в удобное для Вас место, чтобы не забыть его в следующий раз :-)<br><br>На Ваш e-mail отправлено письмо с Вашим логином на случай, если Вы его снова забудете</div>';
        return true;
      }
    }
    else {
      // иначе если возникли ошибки в ходе заполнения
      $_SESSION['send_login_result'] = '<div class="alert alert-danger">В ходе заполнения формы восстановления логина были допущены ошибки</div>';
      return false;
    }
  }
  /* === Восстановление логина (конец) === */


}