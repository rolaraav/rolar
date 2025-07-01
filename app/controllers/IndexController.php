<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Mail;
use core\View;
use core\Controller;
use core\Core;
use \R;

class IndexController extends BaseController {

  public $news; // html-блок постов с новостями
  public $partner_products; // html-блок постов с партнерскими продуктами
  public $downloads; // html-блок постов с закачками
  public $goods; // html-блок постов с товарами
  public $phrase; // html-блок c мудрой фразой

  protected $popular_partner_products; // 5 популярных партнёрских продуктов
  protected $random_downloads; // 5 случайных закачек

  // метод, выполняющийся при создании класса - его можно не прописывать
  // метод может пригодится для задания свойства $this->layout для данного контроллера
  //public function __construct($route) {
    //echo 'IndexController - метод __construct() до родительского метода __construct()<br>';
    //parent::__construct($route);
    //echo 'IndexController - метод __construct() после родительского метода __construct()<br>';

  //}

  public function indexAction() {
    //echo 'IndexController - метод indexAction()<br>';

    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    //$this->layout = false;

    //echo $this->render();
    //$posts = Core::$core->Cache->get('posts'); // получение данных из кэша
    //if (!$posts) { // если данные из кэша не получены, то
    //  $posts = R::findAll('posts'); // получаем посты из базы данных
    //  Core::$core->Cache->set('posts', $posts, 3600 * 24); // помещаем полученные данные в кэш
    //}

    //$post = R::findOne('posts', 'id = 1');
    //$menu = $this->menu; //\R::findAll('category');
    //var_dump($menu);

    //$this->test();

    //echo 'Main::index';
    //$this->layout = 'index';
    //$this->layout = false;
    //$this->view = 'test';

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $this->breadcrumbs = false; // false - на главной странице направляющие не выводятся

    // получение новостей
    $news = $this->format_posts($this->Model->get_data(1,null,null,null,['date', 'id'],['DESC','DESC'],5));
    $this->news = $this->renderPosts(['posts' => $news, 'posts_block_title' => 'Новости', 'link_pattern' => 'post', 'if_empty' => 'Новостей пока нет']);
    //$this->courses = $this->render('post',['posts' => $news, 'posts_block_title' => 'Новости', 'link_pattern' => 'post', 'if_empty' => 'Новостей пока нет']);
    //debug($this->news);

    // получение партнерских продуктов
    $partner_products = $this->format_posts($this->Model->get_data(2,null,null,null,['date', 'id'],['DESC','DESC'],5));
    $this->partner_products = $this->renderPosts(['posts' => $partner_products, 'posts_block_title' => 'Партнёрские продукты', 'link_pattern' => 'post', 'if_empty' => 'Партнёрских продуктов пока нет']);
    //debug($this->partner_products);

    // получение закачек
    $downloads = $this->format_posts($this->Model->get_data(3,null,null,null,['date', 'id'],['DESC','DESC'],5));
    $this->downloads = $this->renderPosts(['posts' => $downloads, 'posts_block_title' => 'Закачки', 'link_pattern' => 'post', 'if_empty' => 'Файлов для скачивания пока нет']);
    //debug($this->downloads);

    // получение товаров
    $goods = $this->format_posts($this->Model->get_data(4,null,null,null,['date', 'id'],['DESC','DESC'],5));
    //debug($goods);
    $this->goods = $this->renderPosts(['posts' => $goods, 'posts_block_title' => 'Товары', 'link_pattern' => 'post', 'if_empty' => 'Товаров пока нет']);
    //debug($this->goods);


    $popular_partner_products = $this->Model->get_popular_partner_products(); // получение 5 популярных партнёрских продуктов
    $this->popular_partner_products = $this->renderList(['list' => $popular_partner_products, 'list_block_title' => 'Популярные партнёрские продукты', 'link_pattern' => 'post', 'if_empty' => 'Партнёрских продуктов пока нет']);
    //debug($this->popular_partner_products);


    $random_downloads = $this->Model->get_random_downloads(); // получение 5 случайных закачек
    $this->random_downloads = $this->renderList(['list' => $random_downloads, 'list_block_title' => 'Случайные материалы для скачивания', 'link_pattern' => 'post', 'if_empty' => 'Файлов для скачивания пока нет']);
    //debug($this->random_downloads);

    $this->half_blocks = $this->renderHalf([$this->last_news, $this->rub_news, $this->popular_partner_products, $this->partners_list, $this->random_downloads, $this->cat_downloads]);
    //debug($this->half_blocks);

    // получение мудрой фразы и рендеринг блока с мудрой фразой
    $phrase = $this->Model->get_phrase(); // получение мудрой фразы
    $this->Model->update_view('phrases',$phrase['id'],$phrase['view']); // обновление количества просмотров
    $this->phrase = $this->renderBlock('_phrase', 'Мудрые фразы', ['phrase' => $phrase]); // блок с мудрой фразой
    // debug($this->phrase);

    //$content = 'Тут текст контента';

    //$this->centerblock_styles = 'стили центрального блока';

    //$banner = ['file_extension' => 'swf'];

    //$banner2 = $this->loadView('_banner', compact( 'banner'));


    //$this->setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
    //$meta = $this->meta;
    //View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');


    //debug($vars);
    //exit();
    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'news' => $this->news,
      'partner_products' => $this->partner_products,
      'downloads' => $this->downloads,
      'goods' => $this->goods,
      //'last_news' => $this->last_news,
      //'rub_news' => $this->rub_news,
      //'popular_partner_products' => $this->popular_partner_products,
      //'partners' => $this->partners,
      //'random_downloads' => $this->random_downloads,
      //'cat_downloads' => $this->cat_downloads,
      'half_blocks' => $this->half_blocks,
      'phrase' => $this->phrase,
    ]);



    //parent::indexAction(); // выполнение рдительского indexAction
  }

  public function viewAction() {
    //echo 'Main::view';
  }

  public function testAction() {
    if ($this->isAjax()) {
      $model = new Main();
      //$data = ['answer' => 'Ответ с сервера', 'code' => 200];
      //echo json_encode($data);
      $post = R::findOne('post', "id = {$_POST['id']}");
      //debug($post);
      $this->loadView('test', compact('post'));
      die;
    }
    echo 222;
  }

  ////////////////////////////////////////////////////

  // метод для получения HTML-кода и вывода страницы на экран
  public function output() {
    // echo 'IndexController - метод output()<br>';

    // генерация контента выполняется до выполнения метода output
//    $this->content = $this->render(V.'index',array(
//      //'title' => $this->title,
//      'image' => $this->image,
//      'text' => $this->text,
//      'professions' => $this->professions,
//      'categories' => $this->categories,
//      'social_buttons' => $this->social_buttons
//    ));
    //echo $this->content;

    //$this->projects = $this->render(V.'_projects');
    //echo $this->projects;

    //$this->banners = $this->render(V.'_banners');
    //echo $this->banners;

    //$this->partners = $this->render(V.'_partners');
    //echo $this->partners;

    parent::output();
  }


}