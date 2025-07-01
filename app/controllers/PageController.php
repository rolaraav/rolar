<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use core\libs\Cache;
use core\libs\Pagination;
use \R;

class PageController extends BaseController {

  public $news; // html-блок постов с новостями
  public $rub_news_li; // список разделов

  public $pagination; // объект-блок с постраничной навигацией

  public function indexAction() {
    //echo 'PageController - метод indexAction()<br>';

    //debug($this->route);
    //debug($this->id);
    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    $rub_news = $this->get_current_categories($this->categories, 3); // получение рубрик новостей // $this->Model->get_categories(3);
    $this->rub_news_li = $this->renderLi(['list' => $rub_news, 'list_block_title' => 'Список разделов', 'link_pattern' => 'courses?cat=', 'if_empty' => 'Разделов пока нет']);
    $this->rub_news = $this->renderList(['list' => $rub_news, 'list_block_title' => 'Список разделов', 'link_pattern' => 'courses?cat=', 'if_empty' => 'Разделов пока нет']);
    //debug($this->rub_news_li); // список
    //debug($this->rub_news); // блок

    $type = 0;
    if (isset($_GET['cat']) and (abs((int)$_GET['cat']) > 0)) { // если в запросе выбран номер рубрики и он больше 0
      $cat = abs((int)$_GET['cat']);

      // получение списка постов в выбранной рубрике, не больше 10
      $posts = $this->Model->get_title_post($type, $cat); // список заметок в данной рубрике
      $this->posts = $this->renderList(['list' => $posts, 'list_block_title' => 'Статьи из данного раздела', 'link_pattern' => 'view_news?id=', 'if_empty' => 'В данном разделе новостей пока нет']);
      //debug($this->posts);

      // рендернинг половинных блоков
      $this->half_blocks = $this->renderHalf([$this->posts, $this->rub_news]);
      //debug($this->half_blocks);

      $rubrika = $this->Model->get_category($cat); // информация по выбранной рубрике
      $this->Model->update_view('categories', $cat, $rubrika['view']); // обновление количества просмотров выбранной рубрики

      $this->description = $rubrika['description'];
      $this->keywords = $rubrika['keywords'];
      $section_title = 'Новости';

      $this->title = $section_title.' - '.$rubrika['title'];

      //$breadcrumbs = " &raquo; <a href='$view.php' target='_self' title='$section_title'>$section_title</a> &raquo; <a class='current' href='$view.php?rub=$category' target='_self' title='$rubrika[title]'>$rubrika[title]</a>";

      $this->breadcrumbs = $breadcrumbs->getBreadcrumbs(false,false, $cat); //'Текущая категория новостей';


    }
    else {
      unset($_GET['cat']);

      $cat = null;
      $rubrika = false;

      //echo $this->view;
      $this->page = $this->Model->get_page($this->alias); // получение отдельной страницы
      $this->Model->update_view('pages', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
      //debug($this->page);

      $this->description = $this->page['description']; // Описание страницы
      $this->keywords = $this->page['keywords']; // Ключевые слова
      $this->title = $this->page['title']; // Заголовок страницы

      //$breadcrumbs = " &raquo; <a class=\"current\" href=\"$view.php\" target=\"_self\" title=\"$title\">$title</a>";

      $this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->alias,$this->title); //'Новости';

    }

    //$cache = Cache::instance();
    //$categories = $cache->get('categories'); // получение категорий из кэша
    //if(!$categories) {// если данные из кеша не получены, то обращаемся к базе данных
    //  $categories = $this->Model->get_categories(); // получение категорий из базы данных
    //  $cache->set('categories', $categories, 86400); // сохранение в кеш
    //}

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->Model->get_total_posts('data', $type, $cat, null); // общее количество новостей
    //debug($this->total_posts_pagination);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_pagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);




    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $news = $this->format_posts($this->Model->get_data(0,$cat,null,null,['date', 'id'],['DESC','DESC'],$limit));
    $this->news = $this->renderPosts(['posts' => $news, 'posts_block_title' => false, 'link_pattern' => 'view_news?id=', 'if_empty' => 'Новостей пока нет']);
    //$this->courses = $this->render('post',['posts' => $courses, 'posts_block_title' => 'Новости', 'link_pattern' => '#', 'if_empty' => 'Новостей пока нет']);
    //debug($this->courses);



    //$content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'rubrika' => $rubrika,
      'page' => $this->page,
      'rub_news_li' => $this->rub_news_li,
      'rub_news' => $this->rub_news,
      'half_blocks' => $this->half_blocks,
      'courses' => $this->news,
      'pagination' => $this->pagination,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction

  }

  public function viewAction() {
    //echo 'Pages::view';
    //debug($this->route);

    $menu = $this->menu; // \R::findAll('category');

    debug($this->route);
    if(isset($this->route['alias'])) {
      $alias = $this->route['alias'];
      echo 'alias = '.$alias;
    }

    $title = 'Страница';
    $this->set(compact('title', 'menu'));

  }

}