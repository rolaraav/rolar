<?php
namespace core\libs;

class Pagination {

  protected $current_page; // номер текущей страницы

  protected $quantity_posts; // количество записей, которые нужно вывести на странице QUANTITY_POSTS = 7
  protected $quantity_links; // количество ссылок слева и справа от текущей страницы QUANTITY_LINKS = 3

  protected $total_posts_pagination; // общее количество записей (постов, новостей, отзывов и пр.)
  protected $total_pages = 1; // необходимое (общее) количества страниц для постраничной навигации, как минимум 1

  //protected $countPages; // общее количество страниц, которое расчитывается из переменных $total_posts_pagination и $qyantity_posts

  public $uri; // адрес текущей страницы

  public $pagination = array(); // массив с элементами для постраничной навигации

  public $links = [
    'back' => '', // Ссылка НАЗАД
    'forward' => '', // Ссылка ВПЕРЁД
    'startpage' => '', // Ссылка В НАЧАЛО
    'endpage' => '', // Ссылка В КОНЕЦ
    'page2left' => '', // Ссылка вторая страница слева
    'page2right' => '', // Ссылка первая страница слева
    'pare2right' => '', // Ссылка первая страница справа
    'page1right' => '', // Ссылка сторая страница справа
  ];

  public function __construct($current_page = 1, $quantity_posts = QUANTITY_POSTS, $total_posts_pagination = 1) {
    $this->quantity_posts = $quantity_posts;
    $this->total_posts_pagination = $total_posts_pagination;
    $this->total_pages = $this->get_total_pages(); // подсчет необходимого (общего) количества страниц $this->countPages = $this->getCountPages();
    $this->current_page = $this->get_current_page($current_page);
    $this->uri = $this->getParams();
    //var_dump($this->uri);
    $this->pagination = $this->get_pagination();
    //debug($this->pagination);
  }

  // магический метод для вывода блока постраничной навигации
  public function __toString() {
    return $this->getHtml();
  }

  // подсчет общего количества страниц для постраничной навигации
  public function get_total_pages(){
    return ceil($this->total_posts_pagination / $this->quantity_posts) ?: 1; // округление в большую сторону

  }
  public function get_total_pages2() {
    if (!$this->total_posts_pagination) {
      $this->total_posts_pagination = $this->Model->get_total_posts();
    }
    $this->total_pages = ceil($this->total_posts_pagination/$this->quantity_posts); // необходимое количество страниц, ceil — округляет дробь в большую сторону
    /*if(($this->total_posts%$this->quantity_posts) != 0) {
      $this->total_pages++; // если число страниц дробное, то прибавляем ещё одну страницу
    } */
    //echo $this->total_pages;
    if (!$this->total_pages) {$this->total_pages = 1;} // минимум 1 страница
    //echo $this->total_pages;
    return $this->total_pages;
  }

  // получение текущей страницы
  public function get_current_page($current_page = 1){
    if(!$current_page || $current_page < 1) {
      $current_page = 1;
    }
    if($current_page > $this->total_pages) {
      $current_page = $this->total_pages;
    }
    return $current_page;
  }

  // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
  public function getStart(){
    return ($this->current_page - 1) * $this->quantity_posts;
  }

  // получение параметров url-строки
  public function getParams(){
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    //debug($url);
    $uri = $url[0].'?';
    if(isset($url[1]) && $url[1] != '') {
      $params = explode('&', $url[1]);
      //debug($params);
      foreach($params as $param) {
        if(!preg_match('#page=#', $param)) {
          $uri .= $param.'&';
        }
      }
    }
    return urldecode($uri);
  }

  public function get_pagination() {
    if ($this->total_posts_pagination == 0) { // если постов нет, то возвращаем false
      return false;
    }
    // если общее количество записей меньше количества записей на странице или номер текущей страницы больше общего количества страниц, то возвращаем false
    if($this->total_posts_pagination <= $this->quantity_posts || $this->current_page > $this->total_pages) {
      return false;
    }

    $this->quantity_links = QUANTITY_LINKS;
    $result = array(); // массив постраничной навигации
    if($this->current_page != 1) { // если текущая страница не является первой страницей
      $result['first_page'] = 1; // получение первой страницы
      $result['previous_page'] = $this->current_page - 1; // получение предыдущей страницы
    }
    // если текущая страница больше количества ссылок + 1, то вычисляем номера страниц слева
    if($this->current_page > $this->quantity_links + 1) {
      for($i = $this->current_page - $this->quantity_links; $i < $this->current_page; $i++) {
        $result['previous_pages'][] = $i;
      }
    }
    else {
      for($i = 1; $i < $this->current_page; $i++) {
        $result['previous_pages'][] = $i;
      }
    }
    $result['current_page'] = $this->current_page; // номер текущей старницы
    // если текущая страница+количество ссылок меньше общего количества страниц, то вычисляем номера страниц справа
    if($this->current_page + $this->quantity_links < $this->total_pages) {
      for($i = $this->current_page + 1; $i <= $this->current_page + $this->quantity_links; $i++) {
        $result['next_pages'][] = $i;
      }
    }
    else {
      for($i = $this->current_page + 1; $i <= $this->total_pages; $i++) {
        $result['next_pages'][] = $i;
      }
    }
    if($this->current_page != $this->total_pages) { //если текущая страница не равна общему количству страниц
      $result['next_page'] = $this->current_page + 1; // следующая страница
      $result['last_page'] = $this->total_pages; // последняя страница
    }
    return $result;
  }

  public function getHtml(){
    $back = ''; // ссылка НАЗАД
    $forward = ''; // ссылка ВПЕРЕД
    $startpage = ''; // ссылка В НАЧАЛО
    $endpage = ''; // ссылка В КОНЕЦ
    $page2left = ''; // вторая страница слева
    $page1left = ''; // первая страница слева
    $page2right = ''; // вторая страница справа
    $page1right = ''; // первая страница справа

    if ($this->current_page > 1){
      $back = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page - 1).'">&lt;</a></li>';
    }
    if ($this->current_page < $this->total_pages){
      $forward = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page + 1).'">&gt;</a></li>';
    }
    if ($this->current_page > 3){
      $startpage = '<li><a class="nav-link" href="'.$this->uri.'page=1">&laquo;</a></li>';
    }
    if ($this->current_page < ($this->total_pages - 2)){
      $endpage = '<li><a class="nav-link" href="'.$this->uri.'page='.$this->total_pages.'">&raquo;</a></li>';
    }
    if ($this->current_page - 2 > 0){
      $page2left = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page - 2).'">'.($this->current_page - 2).'</a></li>';
    }
    if ($this->current_page - 1 > 0){
      $page1left = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page - 1).'">'.($this->current_page - 1).'</a></li>';
    }
    if ($this->current_page + 1 <= $this->total_pages){
      $page1right = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page + 1).'">'.($this->current_page + 1).'</a></li>';
    }
    if ($this->current_page + 2 <= $this->total_pages){
      $page2right = '<li><a class="nav-link" href="'.$this->uri.'page='.($this->current_page + 2).'">'.($this->current_page + 2).'</a></li>';
    }

    return '<ul class="pagination">'.$startpage.$back.$page2left.$page1left.'<li class="active"><a>'.$this->current_page.'</a></li>'.$page1right.$page2right.$forward.$endpage .'</ul>';
  }





}