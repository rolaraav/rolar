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

class CategoryController extends BaseController {

  public $categories_li; // список разделов
  public $categories_list; // блок разделов

  public $pagination; // объект-блок с постраничной навигацией

  public function indexAction(){
    //echo 'CategoryController - метод indexAction()<br>';

    //debug($this->id);
    // получаем идентификатор категории $category_id
    if ((empty($this->id) or ($this->id == 0))) {
      $category_id = 3; // если параметр не передан, то показываем новости
    }
    else {
      $category_id = $this->id;
    }
    //debug($category_id);

    //debug($this->route);
    //$alias = $this->route['alias'];
    //echo $this->alias;

    // получаем данные нужной категории по алиасу или ID
    if ($this->alias != 'category') {
      $category = $this->Model->get_category_by_alias($this->alias); // получение данных по выбранной категории по алиасу
      $category_id = $category['id'];
      //debug($category);
      //echo 'Определяем категорию по алиасу';
    }
    else {
      $category = $this->Model->get_category($category_id); // получение данных по выбранной категории по идентификатору
      //echo 'Определяем категорию по идентификатору';
    }
    //debug($category);

    $this->page = $category;
    //debug($this->page);

    //$type = $this->get_type($category_id, 'array'); // определяем тип содержимого страницы (категории) - новости, партнёрские продукты, закачки, товары, галереи или альбомы
    //debug($type);

    // если выбранная категория - партнерские продукты, то получаем список партнёров
    $partners = array();
    $partner_id = null;
    $update_partners_view = false; // просмотры парнёра не обновлялись
    if ($category['type'] == 2) {
      if (empty($this->partners)) {
        $this->partners = $this->Model->get_partners(); // получение данных партнёров
      }
      $this->partners_li = $this->renderLi(['list' => $this->partners, 'list_block_title' => 'Список партнёров', 'link_pattern' => 'partner_products?partner=', 'if_empty' => 'Партнёров пока нет']);
      //debug($this->partners_li);

      // если передан идентификатор парнёра, то получаем данные этого парнёра
      if (isset($_GET['partner'])) {
        //echo $_GET['partner'];
        $partner_id = clear_int($_GET['partner']);
        $this->partner = $this->Model->get_partner($partner_id); // получение данных выбранного партнёра, если есть
        //debug($this->partner);
        if(isset($this->partner['view'])) {
          $update_partners_view = $this->Model->update_view('partners', $partner_id, $this->partner['view']); // обновление количества просмотров выбранного партнёра
          //debug($update_partners_view);
        }

        $this->page = $this->partner;

        $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->partner['title'], $partner_id, $category_id, 'partner_products?partner=');
        //debug($this->breadcrumbs);

      }
    }

    // если просмотры партнёра не обновлялись, то обновляем просмотры у выбранной категории
    if($update_partners_view != true) {
      $this->Model->update_view('categories', $category_id, $category['view']); // обновление количества просмотров выбранной категории
    }

    $this->title = $this->page['title']; // заголовок страницы
    $this->description = $this->page['description'];
    $this->keywords = $this->page['keywords'];
    $this->image = $this->renderImage(['image' => $this->page['image'], 'title' => $this->title]);
    $this->text = $this->page['text'];

    // если у выбранной категории есть родительские категории ($parent больше 0)
    if ((clear_int($category['parent'])) > 0) {

      $current_parent_category_id = clear_int($category['parent']); // запоминаем идентификатор выбранной родительской категории в переменную

      // ищем все родительские категории выбранной категории, пока родительская категория не будет равна 0
      while($current_parent_category_id != 0) {
        $parent_category = $this->Model->get_parent_category($current_parent_category_id); // получение данных по родительской категории

        $this->title = $parent_category['title'].' - '.$category['title']; // переопределяем полный заголовок страницы

        if ($parent_category['parent'] == 0) {
          //debug($category['type']);
          if ($category['type'] == 5) {$category_type_for_galleries = 5;} // определение типа для галерей
          $category['type'] = $parent_category['type']; // переопределяем тип выбранной категории по его родительской категории
          //$category['parent_alias'] = $parent_category['alias'];
        }

        $parent_category_id = $current_parent_category_id; // запоминаем идентификатор выбранной родительской категории в переменную

        $current_parent_category_id = $parent_category['parent']; // переопределяем идентификатор выбранной родительской категории
      }
      //debug($category);

      $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs(false,false, $category_id); // хлебные крошки (верхняя навигация)

      $query_category_id = $category_id;
    }
    else {
      $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($category['title'], $category['alias']); // хлебные крошки (верхняя навигация)

      $parent_category_id = $category_id; // запоминаем идентификатор текущей категории в качестве родительского

      $query_category_id = null;
    }
    if (isset($category_type_for_galleries)) {
      $category['type'] = 5;
    }
    //debug($query_category_id);
    //debug($category);

    //echo 'получаем категории в контроллере CategoryController';

    // получение списка категорий (применяется и для родительских и для дочерних категорий) // $this->Model->get_categories(3);
    $categories = $this->get_current_categories($this->categories, $parent_category_id);
    //debug($categories);
    $this->categories_li = $this->renderLi(['list' => $categories, 'list_block_title' => 'Список разделов', 'link_pattern' => '', 'if_empty' => 'Разделов пока нет']);
    $this->categories_list = $this->renderList(['list' => $categories, 'list_block_title' => 'Список разделов', 'link_pattern' => '', 'if_empty' => 'Разделов пока нет']);
    //debug($this->categories_li); // список
    //debug($this->categories_list); // блок

    //debug($category_id);
    // получение списка постов в выбранной категории, не больше 10
    $posts_block_list = $this->Model->get_title_post($category['type'], $query_category_id); // список заметок в данной рубрике
    //debug($posts_block_list);
    $this->posts_block_list = $this->renderList(['list' => $posts_block_list, 'list_block_title' => 'Статьи из данного раздела', 'link_pattern' => 'post', 'if_empty' => 'В данном разделе заметок пока нет']);
    //debug($this->posts_block_list);

    if ($category['type'] == 2) {// получение партнёрских продуктов данного партнера
      $this->categories_list = $this->renderList(['list' => $this->partners, 'list_block_title' => 'Список партнёров', 'link_pattern' => 'partner_products?partner=', 'if_empty' => 'Партнёров пока нет']);
      if (isset($this->partner)) { // если парнёр найден
        // получение списка постов в выбранной категории и выбранного партнёра, не больше 10
        $posts_block_list = $this->Model->get_title_post($category['type'], $query_category_id, $partner_id); // список заметок у данного партнёра
        //debug($posts_block_list);
        $this->posts_block_list = $this->renderList(['list' => $posts_block_list, 'list_block_title' => 'Продукты данного партнёра', 'link_pattern' => 'post', 'if_empty' => 'У данного партнёра продуктов пока нет']);
        //debug($this->posts_block_list);
      }
    }

    // рендернинг половинных блоков
    $this->half_blocks = $this->renderHalf([$this->posts_block_list, $this->categories_list]);
    //debug($this->half_blocks);


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    // если алиас категории равен значению алиасов определённых разделов для заметок, то ищем заметки в таблице posts
    if (in_array($category['alias'], ['interesting','creativity','articles','verses','songs'])) { // не добавлены 'music','films','galleries'
      //echo 'есть';
      $posts_object = new PostsController($category);
      $posts_object->indexAction($this->user);

      $this->total_posts_pagination = $posts_object->total_posts_pagination;
      $this->pagination = $posts_object->pagination;

      $this->posts = $posts_object->posts;
      // debug($this->posts);

    }
    else {
      //echo 'нет';
      $this->total_posts_pagination = $this->Model->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
      //debug($this->total_posts_pagination);

      $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
      $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
      //var_dump($pagination->pagination);
      $this->pagination = $this->render_pagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
      //debug($this->pagination);

      //$total_post = count_post($type,$category,null); // общее количество новостей
      $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

      // получаем посты (носовти, партнерские продукты, закачки, товары, галереи, альбомы) из нужных категорий и преобразуем их в нужный вид
      $posts = $this->format_posts($this->Model->get_data($category['type'], $query_category_id, null, $partner_id, ['date', 'id'], ['DESC','DESC'], $limit));
      //debug($posts);
      $this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']); // рендерим посты в нужный вид
      //debug($this->posts);
    }

    //$content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'category' => $category,
      'page' => $this->page,
      //'partner' => $this->partner,
      //'partners' => $this->partners,
      'categories_list' => $this->categories_list,
      'categories_li' => $this->categories_li,
      'partners_li' => $this->partners_li,
      //'categories' => $categories,
      'half_blocks' => $this->half_blocks,
      'posts' => $this->posts,
      'pagination' => $this->pagination,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction

  }

  public function viewAction(){
    debug($this->route);
    $alias = $this->route['alias'];
    debug($alias);
    die;
  }

}