<?php
namespace app\controllers\admin;

use core\libs\Pagination;

class UserController extends AdminController {

  public $current_user; // выбранный пользователь

  public $user_status = ''; // блок select для выбора статуса пользователя
  public $user_method = ''; // блок select для выбора метода регистрации/авторизации пользователя

  public function indexAction(){
    // echo 'Метод indexAction контроллера UserController';

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


    $this->title = 'Пользователи';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    //$limit = pagnav_calc($cnum,$total_users); // параметры для постраничной навигации
    //$users = get_view_users($limit);

    // если нажата кнопка Очистить удалённых пользователей, то чистим пользователей - помещаем адреса электронной почты в чёрный список и присваиваем статус = 0 (удалён)
    if (isset($_POST['clear_users'])) { // очистка удалённых пользователей
      $this->AdminModel->clear_deleted_users();
      redirect(ADMIN.S.$this->alias);
    }

    // если нажата кнопка Изменить пароли пользователей
    if (isset($_POST['change_passwords'])) {
      $this->AdminModel->change_users_passwords();
      redirect(ADMIN.S.$this->alias);
    }

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_users(); // $this->total_data; // общее количество материалов // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $users = $this->AdminModel->get_view_users($limit);
    //debug($posts);
    // get_data($category['type'], $query_category_id, null, $partner_id, ['date', 'id'], ['DESC','DESC'], $limit));
    //$this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
    //debug($this->posts);

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
      'pagination' => $this->pagination,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  public function viewAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор пользователя
    if ((empty($this->id) or ($this->id == 0))) {
      $user_id = 1; // если параметр ID не передан, то показываем первого пользователя
    }
    else {
      $user_id = $this->id;
    }
    //debug($user_id);

    $title = 'Пользователи';
    $this->title = 'Просмотр пользователя';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'view'.S.$user_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->current_user = $this->AdminModel->cp_get_user($user_id);
    //debug($this->current_user);

    if (isset($this->current_user)) {
      if (isset($this->current_user['gender']) and ($this->current_user['gender'] == 1)) {
        $gender = 'женский';
      }
      elseif (isset($this->current_user['gender']) and ($this->current_user['gender'] == 2)) {
        $gender = 'мужской';
      }
      else {
        $gender = 'не указан';
      }
      if (isset($this->current_user['activation']) and ($this->current_user['activation'] == 1)) {
        $activation = 'активирован';
      }
      else {
        $activation = 'не активирован';
      }
      if (isset($this->current_user['letter_type']) and ($this->current_user['letter_type'] == 1)) {
        $letter_type = 'HTML';
      }
      else {
        $letter_type = 'текст';
      }

      switch((int)$this->current_user['status']){
        case(0):
          $this->user_status = 'Удалён';
          break;
        case(1):
          $this->user_status = 'Заблокирован';
          break;
        case(2):
          $this->user_status = 'Подписчик';
          break;
        case(3):
          $this->user_status = 'Обычный';
          break;
        case(4):
          $this->user_status = 'Модератор';
          break;
        case(5):
          $this->user_status = 'Администратор';
          break;
        default:
          $this->user_status = 'Обычный';
      }
      //debug($this->user_status);

      switch((int)$this->current_user['method']){
        case(0):
          $this->user_method = 'rolar.ru';
          break;
        case(1):
          $this->user_method = 'Вконтакте';
          break;
        case(2):
          $this->user_method = 'Facebook';
          break;
        case(3):
          $this->user_method = 'Twitter';
          break;
        case(4):
          $this->user_method = 'Одноклассники';
          break;
        case(5):
          $this->user_method = 'МойМир';
          break;
        case(6):
          $this->user_method = 'Google Plus';
          break;
        case(7):
          $this->user_method = 'Яндекс';
          break;
        default:
          $this->user_method = 'Обычный';
      }
      //debug($this->user_method);
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'user_status' => $this->user_status,
      'user_method' => $this->user_method,
      'current_user' => $this->current_user,
      //'page' => $this->page,
      'gender' => $gender,
      'activation' => $activation,
      'letter_type' => $letter_type,
    ]);

  }

  public function createAction(){
    //echo __METHOD__;

    $title = 'Пользователи';
    $this->title = 'Добавить пользователя';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $gender0 = CHECK;
    $gender1 = '';
    $gender2 = '';
    $activation1 = CHECK;
    $activation0 = '';
    $letter_type1 = '';
    $letter_type0 = CHECK;

    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['gender']) and ($_SESSION['create']['gender'] == 1)) {
        $gender0 = '';
        $gender1 = CHECK;
        $gender2 = '';
      }
      elseif (isset($_SESSION['create']['gender']) and ($_SESSION['create']['gender'] == 2)) {
        $gender0 = '';
        $gender1 = '';
        $gender2 = CHECK;
      }
      else {
        $gender0 = CHECK;
        $gender1 = '';
        $gender2 = '';
      }
      if (isset($_SESSION['create']['activation']) and ($_SESSION['create']['activation'] == 1)) {
        $activation1 = CHECK;
        $activation0 = '';
      }
      else {
        $activation1 = '';
        $activation0 = CHECK;
      }
      if (isset($_SESSION['create']['letter_type']) and ($_SESSION['create']['letter_type'] == 1)) {
        $letter_type1 = CHECK;
        $letter_type0 = '';
      }
      else {
        $letter_type1 = '';
        $letter_type0 = CHECK;
      }
    }

    $user_status = array(['id' => 0, 'title' => 'Удалён'],['id' => 1, 'title' => 'Заблокирован'],['id' => 2, 'title' => 'Подписчик'],['id' => 3, 'title' => 'Обычный'],['id' => 4, 'title' => 'Модератор'],['id' => 5, 'title' => 'Администратор']);
    $this->user_status = $this->renderSelect(['options' => $user_status, 'select_name' => 'status', 'select_title' => 'Выберите статус пользователя', 'select_class' => 'form-select', 'select_id' => 'create_user_status_field', 'selected_id' => 3, 'disabled_id' => false, 'select_important' => true, 'disabled' => false, 'readonly' => false]);
    //debug($this->user_status);

    if (isset($_POST['submit_user'])) {
      if ($this->AdminModel->create_user()) {
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
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'user_status' => $this->user_status,
      //'page' => $this->page,
      'gender0' => $gender0,
      'gender1' => $gender1,
      'gender2' => $gender2,
      'activation1' => $activation1,
      'activation0' => $activation0,
      'letter_type1' => $letter_type1,
      'letter_type0' => $letter_type0,
    ]);

  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор пользователя
    if ((empty($this->id) or ($this->id == 0))) {
      $user_id = 1; // если параметр ID не передан, то показываем первого пользователя
    }
    else {
      $user_id = $this->id;
    }
    //debug($user_id);

    $title = 'Пользователи';
    $this->title = 'Редактировать пользователя';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$user_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->current_user = $this->AdminModel->cp_get_user($user_id);
    //debug($this->current_user);

    $gender0 = CHECK;
    $gender1 = '';
    $gender2 = '';
    $activation1 = CHECK;
    $activation0 = '';
    $letter_type1 = '';
    $letter_type0 = CHECK;

    if (isset($this->current_user)) {
      if (isset($this->current_user['gender']) and ($this->current_user['gender'] == 1)) {
        $gender0 = '';
        $gender1 = CHECK;
        $gender2 = '';
      }
      elseif (isset($this->current_user['gender']) and ($this->current_user['gender'] == 2)) {
        $gender0 = '';
        $gender1 = '';
        $gender2 = CHECK;
      }
      else {
        $gender0 = CHECK;
        $gender1 = '';
        $gender2 = '';
      }
      if (isset($this->current_user['activation']) and ($this->current_user['activation'] == 1)) {
        $activation1 = CHECK;
        $activation0 = '';
      }
      else {
        $activation1 = '';
        $activation0 = CHECK;
      }
      if (isset($this->current_user['letter_type']) and ($this->current_user['letter_type'] == 1)) {
        $letter_type1 = CHECK;
        $letter_type0 = '';
      }
      else {
        $letter_type1 = '';
        $letter_type0 = CHECK;
      }
    }

    $user_status = array(['id' => 0, 'title' => 'Удалён'],['id' => 1, 'title' => 'Заблокирован'],['id' => 2, 'title' => 'Подписчик'],['id' => 3, 'title' => 'Обычный'],['id' => 4, 'title' => 'Модератор'],['id' => 5, 'title' => 'Администратор']);
    $this->user_status = $this->renderSelect(['options' => $user_status, 'select_name' => 'status', 'select_title' => 'Выберите статус пользователя', 'select_class' => 'form-select', 'select_id' => 'create_user_status_field', 'selected_id' => $this->current_user['status'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false, 'readonly' => false]);
    //debug($this->user_status);

    $user_method = array(['id' => 0, 'title' => 'rolar.ru'],['id' => 1, 'title' => 'Вконтакте'],['id' => 2, 'title' => 'Facebook'],['id' => 3, 'title' => 'Twitter'],['id' => 4, 'title' => 'Одноклассники'],['id' => 5, 'title' => 'МойМир'],['id' => 6, 'title' => 'Google Plus'],['id' => 7, 'title' => 'Яндекс']);
    $this->user_method = $this->renderSelect(['options' => $user_method, 'select_name' => 'method', 'select_title' => 'Выберите метод регистрации', 'select_class' => 'form-select', 'select_id' => 'create_user_method_field', 'selected_id' => $this->current_user['method'], 'disabled_id' => false, 'select_important' => false, 'disabled' => true, 'readonly' => false]);
    //debug($this->user_status);

    if (isset($_POST['submit_user'])) {
      if ($this->AdminModel->edit_user($user_id)) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    if (isset($_POST['password_reset'])) {
      $this->AdminModel->password_reset($user_id);
      redirect();
    }
    if (isset($_POST['method_reset'])) {
      $this->AdminModel->method_reset($user_id);
      redirect();
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'user_status' => $this->user_status,
      'user_method' => $this->user_method,
      'current_user' => $this->current_user,
      //'page' => $this->page,
      'gender0' => $gender0,
      'gender1' => $gender1,
      'gender2' => $gender2,
      'activation1' => $activation1,
      'activation0' => $activation0,
      'letter_type1' => $letter_type1,
      'letter_type0' => $letter_type0,
    ]);

  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор пользователя
    if ((empty($this->id) or ($this->id == 0))) {
      $user_id = 1; // если параметр ID не передан, то показываем первого пользователя
    }
    else {
      $user_id = $this->id;
    }
    //debug($user_id);

    $title = 'Пользователи';
    $this->title = 'Удалить пользователя';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$user_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->current_user = $this->AdminModel->cp_get_user($user_id);
    //debug($this->current_user);

    $gender0 = CHECK;
    $gender1 = '';
    $gender2 = '';
    $activation1 = CHECK;
    $activation0 = '';
    $letter_type1 = '';
    $letter_type0 = CHECK;

    if (isset($this->current_user)) {
      if (isset($this->current_user['gender']) and ($this->current_user['gender'] == 1)) {
        $gender0 = '';
        $gender1 = CHECK;
        $gender2 = '';
      }
      elseif (isset($this->current_user['gender']) and ($this->current_user['gender'] == 2)) {
        $gender0 = '';
        $gender1 = '';
        $gender2 = CHECK;
      }
      else {
        $gender0 = CHECK;
        $gender1 = '';
        $gender2 = '';
      }
      if (isset($this->current_user['activation']) and ($this->current_user['activation'] == 1)) {
        $activation1 = CHECK;
        $activation0 = '';
      }
      else {
        $activation1 = '';
        $activation0 = CHECK;
      }
      if (isset($this->current_user['letter_type']) and ($this->current_user['letter_type'] == 1)) {
        $letter_type1 = CHECK;
        $letter_type0 = '';
      }
      else {
        $letter_type1 = '';
        $letter_type0 = CHECK;
      }
    }

    $user_status = array(['id' => 0, 'title' => 'Удалён'],['id' => 1, 'title' => 'Заблокирован'],['id' => 2, 'title' => 'Подписчик'],['id' => 3, 'title' => 'Обычный'],['id' => 4, 'title' => 'Модератор'],['id' => 5, 'title' => 'Администратор']);
    $this->user_status = $this->renderSelect(['options' => $user_status, 'select_name' => 'status', 'select_title' => 'Выберите статус пользователя', 'select_class' => 'form-select', 'select_id' => 'create_user_status_field', 'selected_id' => $this->current_user['status'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true, 'readonly' => false]);
    //debug($this->user_status);

    $user_method = array(['id' => 0, 'title' => 'rolar.ru'],['id' => 1, 'title' => 'Вконтакте'],['id' => 2, 'title' => 'Facebook'],['id' => 3, 'title' => 'Twitter'],['id' => 4, 'title' => 'Одноклассники'],['id' => 5, 'title' => 'МойМир'],['id' => 6, 'title' => 'Google Plus'],['id' => 7, 'title' => 'Яндекс']);
    $this->user_method = $this->renderSelect(['options' => $user_method, 'select_name' => 'method', 'select_title' => 'Выберите метод регистрации', 'select_class' => 'form-select', 'select_id' => 'create_user_method_field', 'selected_id' => $this->current_user['method'], 'disabled_id' => false, 'select_important' => false, 'disabled' => true, 'readonly' => false]);
    //debug($this->user_status);

    if (isset($_POST['submit_user'])) {
      if ($this->AdminModel->delete_user($user_id)) {
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
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'user_status' => $this->user_status,
      'user_method' => $this->user_method,
      'current_user' => $this->current_user,
      //'page' => $this->page,
      'gender0' => $gender0,
      'gender1' => $gender1,
      'gender2' => $gender2,
      'activation1' => $activation1,
      'activation0' => $activation0,
      'letter_type1' => $letter_type1,
      'letter_type0' => $letter_type0,
    ]);

  }


}