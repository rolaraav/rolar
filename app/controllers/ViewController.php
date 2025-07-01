<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;

class ViewController extends BaseController {

  public function indexAction() {
    //echo 'ViewController - метод indexAction()<br>';

    $url = explode('/', $_SERVER['REQUEST_URI'], 3);

    if ((isset($url[2])) and (abs((int)$url[2]) > 0)) {
      $post_id = abs((int)$url[2]);
    }
    else {
      $post_id = 1;
    }
    //debug($post_id);

    // нужна проверка, если post_id больше имеющихся количества постов, или пост удален (скрыт), то данные этого поста не получаются

    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    $post_array = $this->Model->get_post($post_id); // массив данных выбранного поста
    //debug($post);

    // echo '<strong>'.$post['id'].'</strong>'; echo $post['view'];
    $this->Model->update_view('data', $post_id, $post_array['view']); // обновление количества просмотров

    if (isset($post_array)) {
      $post = $this->format_post($post_array);
    }
    else {
      $post['text'] = '<p>Такого поста (новости, продукта, закачки, товара, галереи, альбома) пока нет!</p>';
    }
    //debug($post);

    // определение шаблона вида по типу данных поста
    switch($post['type']){
      case(0):
        $template_view = 'courses';
        $page_title = 'Новости';
        $link_pattern = 'courses';
      break;
      case(1):
        $template_view = 'partner_product';
        $page_title = 'Партнёрские продукты';
        $link_pattern = 'partner_products';
      break;
      case(2):
        $template_view = 'download';
        $page_title = 'Закачки';
        $link_pattern = 'downloads';
      break;
      case(3):
        $template_view = 'good';
        $page_title = 'Товары';
        $link_pattern = 'goods';
      break;
      case(4):
        $template_view = 'gallery';
        $page_title = 'Галереи';
        $link_pattern = 'galleries';
      break;
      case(5):
        $template_view = 'album';
        $page_title = 'Альбомы';
        $link_pattern = 'albums';
      break;
      default:
        $template_view = 'post';
        $page_title = 'Посты';
        $link_pattern = 'posts';
    }

    // $page2 = $this->Model->get_page2('courses'); данные для хлебных крошек и заголовка
    $this->description = $post['description'];
    $this->keywords = $post['keywords'];
    $this->title = $page_title.' - '.$post['title_category'].' - '.$post['title'];

    //$this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->alias,$this->title); //'Об авторе'; // false - на главной странице направляющие не выводятся
    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs(false,false, $post['category']); // определённая категория и определённая статья в определённом разделе
    //$breadcrumbs = " &raquo; <a href='courses.php' target='_self' title='$page2[title]'>$page2[title]</a> &raquo; <a href='courses.php?rub=$post[category]' target='_self' title='$post[title_category]'>$post[title_category]</a> &raquo; <a class='current' href='$view.php?id=$id' target='_self' title='$post[title]'>$post[title]</a>";

    if (isset($_POST['quantity_vote_submit'])){
      $this->update_rating();
      // redirect();
    }

    $rating = $this->render('rating', ['post' => $post]); // рендеринг блока оценки рейтинга

    if ($post['comments'] == 1) {
      $comments = $this->format_comments($this->Model->get_comments($post_id));
      if (empty($comments)) {
        $comments = '<p>Здесь комментариев пока нет.</p>';
      }
      //debug($comments);
      $randomimage = mt_rand(1, 9);
      // echo $randomimage;
      $comments_settings = $this->Model->get_comments_settings($randomimage);

      $comments_block = $this->render('comments_block', ['comments' => $comments, 'comments_settings' => $comments_settings['image'], 'user' => $this->user, 'post' => $post, 'randomimage' => $randomimage]); // рендеринг блока с комментариями, если он есть

      if (isset($_POST['submit_comment'])){
        $_POST['send_comment'] = send_comment();
      }
    }
    else {
      $comments_block = '<div class="comments">Комментарии:</div><p>Комментарии для этой заметки выключены.</p>';
    }

    $rub_news = $this->get_current_categories($this->categories, 3); // получение рубрик новостей // $this->Model->get_categories(3);
    $this->rub_news = $this->renderList(['list' => $rub_news, 'list_block_title' => 'Список разделов', 'link_pattern' => $link_pattern, 'if_empty' => 'Разделов пока нет']); // 'link_pattern' => 'courses?cat='
    //debug($this->rub_news); // блок


    // получение списка постов в выбранной рубрике, не больше 10
    // $posts = $this->Model->get_other_title_post($post_id, $this->post['type'], $this->post['category']); // список заметок в данной рубрике
    $similar_posts = $this->Model->get_similar_posts($post['id'],$post['type'],$post['category']); // другие посты (новости, закачки) из данного раздела
    $posts = $this->renderList(['list' => $similar_posts, 'list_block_title' => 'Другие статьи из данного раздела', 'link_pattern' => 'view_news?id=', 'if_empty' => 'В данном разделе других статей пока нет']);
    //debug($posts);


    // рендернинг половинных блоков
    $this->half_blocks = $this->renderHalf([$posts, $this->rub_news]);
    //debug($this->half_blocks);

    //$content = 'Тут текст контента';

    $this->post = $this->render('post', ['post' => $post, 'user' => $this->user]); // рендеринг поста, получение html-кода из элементов массива
    //debug($this->post);

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'post' => $this->post,
      'rating' => $rating,
      'template_view' => $template_view,
      //'social_buttons' => $this->social_comments,
      //'social_comments' => $this->social_comments,
      //'subscription' => $this->subscription,
      'comments_block' => $comments_block,
      'half_blocks' => $this->half_blocks,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

  protected function format_post($post = array()) {
    if (!is_array($post)) {
      return false;
    }

    $post['secret2'] = secret_check($post['secret']); // получение флага-указателя для секретных постов (данные об открытии/закрытии доступа берутся из сессии)
    // подсчет количества комментариев, count_comments - количество комментариев, comments - разрешено ли комментировать
    if ($post['comments'] == 1) {
      $post['count_comments'] = $this->Model->count_comments($post['id']);
    }
    else {
      $post['count_comments'] = 0;
    }
    // Получение названий рубрик, разделов, имён партнёров
    if ($post['type'] <= 2) {
      $post['title_category'] = $this->Model->get_title_category($post['type'], $post['category']);
    }

    // получение путей и проверка изображения
    if (!empty($post['image'])) {
      $post['images_path'] = get_images_path($post['image']); // получаем путь к файлам изображений
      // если путь к файлу изображения верный
      if (mb_substr($post['image'], -1, 2, 'UTF-8') != '/') {
        /* Получение имени миниатюры */
        $post['thumbspostimage'] = thumbsfilename($post['image']);
      }
      /* Получение скриншотов и массива ссылок для галереи */
      if (!empty($post['screenshots'])) {
        // если галерея, то получаем массив ссылок
        if ($post['type'] == 4) {
          $post['gallery_images'] = get_galleryimages($post['images_path'], $post['screenshots']);
          unset($post['screenshots']);
        } else { // если другой материал, то получаем скриншоты
          $post['screenshots'] = get_screenshots($post['images_path'], $post['screenshots']);
        }
      } else {
        unset($post['screenshots']);
      }
    } else {
      unset($post['image']);
    }

    /* Преобразование даты в удобный для восприятия вид */
    $post['date'] = rusdate('j %MONTH% Y, G:i:s', strdatetosec($post['date']));
    /* Подсчет рейтинга */
    $post['rating'] = intval($post['rating'] / $post['quantity_vote']);

    if ((empty($post['size'])) or ((int)$post['size'] == 0)) {
      unset($post['size']);
    } // если размер не указан уничтожаем переменную
    else {
      $post['size'] = get_size($post['size']);
    }

    // Если к материалу прикреплена галерея или альбом, но они пустые, тогда уничтожаем переменные
    if (empty($post['gallery_id'])) {
      unset($post['gallery_id']);
    }
    if (empty($post['album_id'])) {
      unset($post['album_id']);
    }

    /* Уничтожаем лишние переменные */
    // echo 'partner_link: '.$post['partner_link'].'<br>';
    if (empty($post['partner_link'])) {
      unset($post['partner_link'], $post['transitions']);
    }
    if ($post['secret'] == 1) {
      if ($_SESSION['secret_access'] != true) {
        unset($post['internet_link'], $post['download_link']);
      }
    }
    if ($post['hide_link'] == 1) {
      unset($post['download_link'], $post['downloaded'], $post['internet_link'], $post['internet_downloaded']);
    }
    // echo 'download_link: '.$post['download_link'].'<br>';
    if ((empty($post['download_link'])) or ($post['download_link'] == 'downloads/')) {
      unset($post['download_link'], $post['downloaded']);
    }
    // echo 'internet_link: '.$post['internet_link'];
    if (empty($post['internet_link'])) {
      unset($post['internet_link'], $post['internet_downloaded']);
    }
    // echo 'buy_link: '.$post['buy_link'];
    if (empty($post['buy_link'])) {
      unset($post['buy_link'], $post['orders']);
    }
    if ((int)$post['price'] == 0) {
      unset($post['price']);
    }
    return $post;
  }

  // функция обновления рейтинга
  public function update_rating() {
    $score = (int)$_POST['score'];
    $id = (int)$_POST['id'];
    $rating = $this->Model->get_rating($id); // получение рейтинга и количества голосов
    $new_rating = $rating['rating'] + $score;
    $new_quantity_vote = $rating['quantity_vote'] + 1;
    $update = $this->Model->update_rating($id, $new_rating, $new_quantity_vote); // Обновление голосов для текущей заметки

    if ($rating['type'] == 0) {$cookie_name = "news_quantity_vote";}
    if ($rating['type'] == 1) {$cookie_name = "partner_products_quantity_vote";}
    if ($rating['type'] == 2) {$cookie_name = "downloads_quantity_vote";}
    if ($rating['type'] == 3) {$cookie_name = "goods_quantity_vote";}
    if ($rating['type'] == 4) {$cookie_name = "gallery_quantity_vote";}
    if ($rating['type'] == 5) {$cookie_name = "album_quantity_vote";}

    if ($update) {
      // запоминаем в куки, что пользователь голосовал за эту заметку, время жизни куки 60 сек * 60 мин * 24 часа * 7 дней = 604 800 сек = 1 неделя
      setcookie($cookie_name, $id, time()+604800);
      $_POST['message']['title'] = 'Ваш голос учтён!';
      $_POST['message']['text'] = '<p class="good_message">Благодарим за Вашу оценку! Ваш голос учтён!</p>';
    }
    else {
      $_POST['message']['title'] = 'Ошибка: Ваш голос не учтён';
      $_POST['message']['text'] = '<p class="bad_message">Произошла ошибка! Ваш голос не учтён</p>';
    }
  }

  // функция получения и преобразования комментариев
  public function format_comments($comments = array()) {
    if (!is_array($comments) or empty($comments)) {
      return false;
    }

    //$comments = $this->Model->get_comments($id); // получение комментариев из базы

    $comments_text = '';
    foreach ($comments as $item) {
      $comment_author = $this->Model->get_comment_autor($item['author']);
      //debug($comment_author);

      if (!empty($comment_author)) {
        /* если пользователь зарегистрирован, то по его логину вытаскиваем его имя и присваиваем его к имени автора комментария */
        $comment_author_name = $comment_author['first_name'];
        $comment_author_avatar = $comment_author['avatar'];
      }
      else {
        /* если пользователь не зарегистрирован, то имя автора комментария извлекаем из базы */
        $comment_author_name = $item['author'];
        $comment_author_avatar = DAVATAR;
      }

      // Если пользователь указал адрес сайта, то делаем из его имени ссылку
      if (isset($item['site'])) {
        $comment_author_name = '<a href="'.$item['site'].'" target="_blank" title="'.$comment_author_name.'">'.$comment_author_name.'</a>';
      }

      /* Преобразование даты в удобный для восприятия вид */
      $date_comment = rusdate('j %MONTH% Y, G:i:s', strdatetosec($item['date']));

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