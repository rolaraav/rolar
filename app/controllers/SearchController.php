<?php
namespace app\controllers;

use core\libs\Pagination;
use core\libs\Search;
use core\libs\Validator;

class SearchController extends BaseController {

  public $search = ''; // объект для поиска
  public $post_id = 0; // идентификатор найденного поста

  public $search_query = ''; // поисковый запрос
  public $search_result1 = ''; // вывод html-кода результатов поиска
  public $search_result2 = ''; // вывод html-кода результатов умного поиска
  public $search_result3 = ''; // вывод json-кода результатов поиска typeahead

  public function typeaheadAction() {
    if($this->isAjax()) {
      $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
      if (isset($query)) {
        $this->search_query = Validator::validate($query); // проверка введённых данных
        $search_result = $this->Model->search_typeahead($this->search_query); // получение релевантных постов
        $this->search_result3 = array();
        foreach($search_result as $key => $item) {
          $item['title'] = htmlspecialchars_decode($item['title']);
          $this->search_result3[$key] = $item;
        }
        echo json_encode($this->search_result3);
      }
      die;
    }

  }

  public function indexAction() {
    //echo 'SearchController - метод indexAction()<br>';

    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $this->image = $this->page['image']; // Картинка страницы
    $this->text = $this->page['text']; // Текст страницы

    if ((isset($_POST['search'])) or (!empty($_GET['search']))) {

      $error = ''; // флаг наличия ошибок

      // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
      /*
      if (isset($_POST['search_token'])) {
        $token = trim($_POST['search_token']);
      }
      if (isset($_GET['search_token'])) {
        $token = trim($_GET['search_token']);
      }

      if ((empty($token)) or (!$this->checkToken($token,'search'))) {
        $error = 'Ошибка при отправке данных. Форма не валидна'; //$_SESSION['search_errors']; $this->errors['token'] = $_SESSION['search_errors'].'<br>';
        //$_SESSION['search_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
        unset($token);
        //exit;
      }
      */

      if (!empty($_POST['search'])){
        $this->search_query = Validator::validate($_POST['search']); // проверяем полученные данные
        //echo '$_POST[\'search\']='.$_POST['search'];
      }

      if (!empty($_GET['search'])){
        $search_query_with_id = Validator::validate($_GET['search']); // проверяем полученные данные

        // отрезаем первые символы с цифрами
        $start = mb_strpos($search_query_with_id, '-', 0, 'UTF-8'); // ищем позицию первого дефиса -
        if ($start === false) { // если дефис в строке не найлен, то получаем всю строку
          $this->search_query = $search_query_with_id;
          //debug($this->search_query);
        }
        else {
          $this->search_query = mb_substr($search_query_with_id, $start + 1, mb_strlen($search_query_with_id, "UTF-8") - $start - 1, "UTF-8");
        }
        //debug($this->search_query);


        $this->post_id = abs((int)$_GET['search']); // получаем идентификатор статьи
        if ($this->post_id == 0) {unset($this->post_id);}
        //echo '$_GET[\'search\']='.$_GET['search'];
      }

      /* Проверка переменных searchButton и search (Нажал ли пользователь кнопку Найти, ввел ли в поисковое поле данные больше 4 символов) */
      /*
      if ((empty($this->search_query)) or (mb_strlen($this->search_query,'UTF-8') < 4)) {
        $_POST['message']['title'] = 'Ошибка: неверный поисковый запрос!';
        $_POST['message']['text'] = '<p class="warning_message">Поисковый запрос не введен или он менее 4-х символов.<p>';
        $error = $error.'<p>Вы не ввели поисковый запрос или он менее 4-х символов.</p>';
      } */

      $this->title = 'Поиск по запросу &quot;'.$this->search_query.'&quot;';
      //debug($this->title);

      $this->Model->add_search_query($this->search_query);

      // если все поля заполнены и ошибок нет
      if(empty($error)){
        //$this->search_query = htmlspecialchars(stripslashes(strip_tags($this->search_query)));
        if (!empty($_POST['search'])){
          $posts = $this->Model->search($this->search_query);
          //debug($posts);
          $this->search_result1 = $this->format_posts($posts); // получение релевантных постов
          //debug($this->search_result1);
        }

        if ((!empty($_GET['search'])) and (isset($this->post_id))){ // если $_GET['search'] не пустой и существует $this->post_id
          $posts = $this->Model->search3($this->post_id);
          //debug($posts);
          $this->search_result1 = $this->format_posts($posts); // получение релевантных постов
          //debug($this->search_result1);
        }

        if (!empty($this->search_result1)) { // если массив результатов поиска не пустой, то выводим посты
          $this->posts = $this->renderPosts(['posts' => $this->search_result1, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
        }
        //debug($this->posts);

        /* скрипт поискового ядра (начало) */
        // тут наша функция с первой части урока

        $this->search = new Search($this->search_query); // создание класса для поиска
        //debug($this->search);
        $this->search_result2 = $this->search->run(); // возвращаем наш результат поиска, функцию мы рассмотрим ниже
        //debug($this->search_result2);
        /* скрипт поискового ядра (конец) */
      }

    }

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Поиск'; // false - на главной странице направляющие не выводятся

    //$posts = $this->format_posts($this->Model->get_data(null, null, null, null, ['date', 'id'], ['DESC','DESC'], 10));
    //$this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);

    $this->half_blocks = $this->renderHalf([$this->rub_news, $this->partners_list, $this->cat_downloads]);
    //debug($this->half_blocks);


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      //'page' => $this->page,
      'search_form' => $this->search_form,
      //'partner' => $this->partner,
      //'partners' => $partners,
      //'categories' => $categories,
      'half_blocks' => $this->half_blocks,
      'posts' => $this->posts,
      //'user' => $this->user,
      'search_query' => $this->search_query,
      'search_result1' => $this->search_result1,
      'search_result2' => $this->search_result2,
      //'search_result3' => $this->search_result3,
    ]);

  }

}