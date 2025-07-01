<?php

namespace app\controllers;

use core\libs\Pagination;

class SecretController extends BaseController {

  protected $popular_partner_products; // 5 популярных партнёрских продуктов
  protected $random_downloads; // 5 случайных закачек

  public function indexAction() {
    //echo 'SecretController - метод indexAction()<br>';

    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы
    $this->image = $this->page['image'];

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Об авторе'; // false - на главной странице направляющие не выводятся



    if (isset($_POST['secret_code'])) {
      if ($_POST['secret_code'] == CODE) {
        $_SESSION['secret_access'] = true;
        setcookie('secret_code', CODE, time()+31536000);
        $_SESSION['result'] = '<div class="success">Код подтверждён! Доступ к секретным материалам открыт!</div>';
      }
      else {
        unset($_SESSION['secret_access']);
        setcookie('secret_code', '', time()+31536000);
        $_SESSION['result'] = '<div class="error">Код неверный! Доступ к секретным материалам закрыт!</div>';
      }
    }
    if (isset($_POST['clear_secret'])) {
      unset($_SESSION['secret_access']);
      setcookie('secret_code', '', time()+31536000);
    }

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->Model->get_total_posts('data', null, null, 1); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_pagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $posts = $this->format_posts($this->Model->get_data(null, null, 1, null, ['date', 'id'], ['DESC','DESC'], $limit));
    $this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
    //debug($this->posts);

    //$popular_partner_products = get_popular_partner_products(); // получение 5 популярных партнёрских продуктов
    //$random_downloads = get_random_downloads(); // получение 5 случайных закачек

    $popular_partner_products = $this->Model->get_popular_partner_products(); // получение 5 популярных партнёрских продуктов
    $this->popular_partner_products = $this->renderList(['list' => $popular_partner_products, 'list_block_title' => 'Популярные партнёрские продукты', 'link_pattern' => 'post', 'if_empty' => 'Партнёрских продуктов пока нет']);
    //debug($this->popular_partner_products);


    $random_downloads = $this->Model->get_random_downloads(); // получение 5 случайных закачек
    $this->random_downloads = $this->renderList(['list' => $random_downloads, 'list_block_title' => 'Случайные материалы для скачивания', 'link_pattern' => 'post', 'if_empty' => 'Файлов для скачивания пока нет']);
    //debug($this->random_downloads);

    $this->half_blocks = $this->renderHalf([$this->last_news, $this->rub_news, $this->popular_partner_products, $this->partners_list, $this->random_downloads, $this->cat_downloads]);
    //debug($this->half_blocks);


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      //'partner' => $this->partner,
      //'partners' => $partners,
      //'categories' => $categories,
      'subscription' => $this->subscription,
      'half_blocks' => $this->half_blocks,
      'posts' => $this->posts,
      'pagination' => $this->pagination,
      'user' => $this->user,
    ]);

  }

}