<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Pagination;

class PostsController extends BaseController {

  public $category = array(); // массив с текущей категорией

  public $user = array(); // данные пользователя

  public function __construct($category) {
    // parent::__construct($route);

    $this->Model = new BaseModel; // создание модели и соединение с базой данных

    $this->category = $category; // получаем текущую категорию

  }

  public function indexAction($user=array()) {
    //echo 'PostsNew::index';
    //echo 'controller: PostsController, method: indexAction()';
    //echo __METHOD__;

    //debug($this->alias);

    $this->user = $user;
    //debug($this->user);

    /*
    // получаем нужную категорию
    // если у категории есть алиас, то получаем данные категории по её алиасу
    if ((!empty($this->alias)) and ($this->alias != 'posts')) {
      $category_array = $this->Model->get_category_by_alias($this->alias); // получение данных по выбранной категории по алиасу
      $category_id = $category_array['id'];
    }
    else { // иначе получаем данные категории по её ID
      // получаем идентификатор категории $category_id
      // нужна проверка, если $post_id больше имеющихся количества постов, или пост удален (скрыт), то данные этого поста не получаются
      if ((empty($this->id) or ($this->id == 0))) {
        $category_id = 8; // если параметр не передан, то показываем категорию "Интересное"
      }
      else { // иначе показываем пост с переданным ID
        $category_id = $this->id;
      }
      $category_array = $this->Model->get_category($category_id); // массив данных выбранной категории
    }
    //debug($category_id);

    $this->Model->update_view('data', $category_id, $category_array['view']); // обновление количества просмотров
    //debug($category_array);

    if (isset($category_array)) {
      $category = $category_array; // $this->format_category($category_array);
    }
    else {
      $category['text'] = '<p>Такой заметки пока нет!</p>';
    }
    //debug($category);

    $this->description = $category['description'];
    $this->keywords = $category['keywords'];
    $this->title = $category['title'];
    $this->image = $category['image'];
    $this->text = $category['text'];
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($category['title'], $category_id); // определённая категория в определённом разделе

    */

    //$breadcrumbs_array = $this->breadcrumbs_obj->breadcrumbs_array;
    //debug($breadcrumbs_array);

    //debug($this->category);

    $category_in = $this->category['id'];
    if ($this->category['id'] == 8) { // для раздела Интересное
      $category_in = '8,17'; // 14,15,16 - музыка, фильмы, галереи не включены
    }
    if ($this->category['id'] == 9) { // для раздела Творчество
      $category_in = '9,12,13';
    }

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->Model->get_total_posts2($category_in); // общее количество заметок (постов) в выбранной категории
    //debug($this->total_posts_pagination);

    //$limit = pagnav_calc2($num,$total_posts); // параметры для постраничной навигации

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_pagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $order = ['date', 'id'];
    $napr = ['DESC','DESC'];
    // 'date DESC,id DESC';

    $posts = $this->format_posts($this->Model->get_posts($category_in,$order,$napr,$limit)); // получаем заметки (посты) из нужных категорий  и преобразуем их в нужный вид
    //debug($posts);
    $this->posts = $this->renderPosts2(['posts' => $posts, 'if_empty' => 'Заметок пока нет']); // рендерим посты в нужный вид
    //debug($this->posts);

    // отправка комментария
    if (isset($_POST['submit_comment'])){
      $_POST['send_comment'] = $this->send_comment('comments2');
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      //'breadcrumbs' => $this->breadcrumbs,
      'category' => $this->category,
      'page' => $this->page,
      'posts' => $this->posts,
      //'rating' => $rating,
      //'template_view' => $template_view,
      'social_buttons' => $this->social_buttons,
      //'social_comments' => $this->social_comments,
      //'subscription' => $this->subscription,
      //'comments_block' => $comments_block,
      //'half_blocks' => $this->half_blocks,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction

  }

  public function testAction() {
    //echo 'PostsNew::test';
  }

  public function testPageAction() {
    //echo 'PostsNew::testPage';
  }

  public function before(){
    //echo 'PostsNew::before';
  }

  // преобразование полученных данных
  public function format_posts($post = array()){
    if (!is_array($post)) {
      return false;
    }

    foreach($post as $item) {
      $item['type'] = 7; // тип поста: 7 - минипост, заметка, 0 - страница, 1 - новость, 2 - партнерский продукт, 3 - закачка, 4 - товар, 5 - галерея, 6 - альбом

      // преобразование даты и времени в удобный для восприятия вид
      //$item['date'] = rusdate('j %MONTH% Y, G:i:s',strdatetosec($item['date']));
      $item['date'] = get_datetime($item['date']);

      /* Получение имени миниатюры */
      if (($item['image'] == 'images/') or ($item['image'] == 'images/post/')) {unset($item['image']);}
      if (isset($item['image'])) {
        $item['thumbspostimage'] = thumbsfilename($item['image']);
      }

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

      $item['total_comments'] = 0; // зануляем счётчик комментариев
      /* Получение комментариев */
      if ($item['comments'] == 1) {
        // подсчёт комментариев
        $item['total_comments'] = $this->Model->count_comments($item['id'], $item['type']);
        //debug($item['total_comments']);
        //$item['comments_text'] = $this->Model->get_comments2($item['id']);
        //debug($item['comments_text']);

        $comments = $this->format_comments2($this->Model->get_comments($item['id'], $item['type'])); // получение комментариев из базы и формирование html-строки из комментариев
        //debug($comments);
        if (empty($comments)) {
          $comments = '<p>Здесь комментариев пока нет.</p>';
        }
        //debug($comments);
        $item['random'] = mt_rand(1, 9);
        //echo $item['random'];
        // $captcha_image = $this->Model->get_comments_settings($item['random']); // /images/captcha/9.gif // 'captcha_image' => $captcha_image['image'],
        $comments_settings = $this->Model->get_comments_settings($item['random']);
        $item['captcha_image'] = $comments_settings['image'];
        //debug($item['captcha_image']);

       // получение блока с коментарияеми
        $item['comments_block'] = $this->render('comments_block', ['comments' => $comments, 'user' => $this->user, 'post' => $item, 'random' => $item['random'], 'comment_token' => $this->getToken('send_comment')]); // рендеринг блока с комментариями, если он есть
        //debug($item['comments_block']);
      }
      $posts[] = $item;
    }
    return $posts;
  }


  // функция получения и преобразования комментариев
  public function format_comments2($comments2 = array()) {
    if (!is_array($comments2) or empty($comments2)) {
      return false;
    }

    $comments_text = '';
    foreach ($comments2 as $item) {
      // Запрос на выборку имён/фамилий и аватаров авторов комментария (начало)
      $comment_author = $this->Model->get_comment_autor($item['author']); // "SELECT first_name,avatar FROM users WHERE login='$item['author']' AND activation='1'";
      //debug($comment_author);

      if (!empty($comment_author)) {
        // если пользователь зарегистрирован, то по его логину вытаскиваем его имя и присваиваем его к имени автора комментария
        $comment_author_name = $comment_author['first_name'];
        $comment_author_avatar = $comment_author['avatar'];
      }
      else {
        // если пользователь не зарегистрирован, то имя автора комментария извлекаем из базы
        $comment_author_name = $item['author'];
        $comment_author_avatar = DAVATAR;
      }

      // Если пользователь указал адрес сайта, то делаем из его имени ссылку
      if (isset($item['site'])) {
        $comment_author_name = '<a href="'.$item['site'].'" target="_blank" title="'.$comment_author_name.'">'.$comment_author_name.'</a>';
      }

      // преобразование даты и времени в удобный для восприятия вид
      $date_comment = get_datetime($item['date']);

      $comments_text = $comments_text.$this->render('_comment', [
          'comment_author_name' => $comment_author_name,
          'comment_author_avatar' => $comment_author_avatar,
          'comment_author' => $item['author'],
          'date_comment' => $date_comment,
          'comment_text' => $item['text'],
        ]);
    }
    //debug($comments_text);
    return $comments_text;
  }

}