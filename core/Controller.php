<?php
namespace core;
use \Exception;

abstract class Controller {

  use TSingletone;

  /*
   * Запрос, полученный из адресной строки
   * @var string
   */
  protected $url = ''; // запрос, полученный из адресной строки

  /*
   * Текущий маршрут и параметры (controller, action, params)
   * @var array
   */
  protected $route = []; // массив данных для текущего маршрута

  /*
   * Текущий контроллер
   * @var string
   */
  protected $controller = 'Index'; // свойство для хранения имени контроллера

  /*
   * Текущая модель
   * @var string
   */
  protected $model = 'Index'; // нужная модель

  /*
   * Текущий вид
   * @var string
   */
  protected $view = 'index'; // нужный вид

  /*
   * Текущий шаблон
   * @var string
   */
  protected $layout = 'default';

  /*
   * Действие (метод) выбранного контроллера
   * @var string
   */
  protected $action = 'index'; // нужный метод (действие)

  /*
   * Префикс для имени контроллера
   * @var string
   */
  protected $prefix = ''; // префикс для имени контроллера

  /*
 * Разделитель для префикса для имени контроллера
 * @var string
 */
  protected $prefix_separator = ''; // разделитель для префикса и имени контроллера

  /*
   * Алиас текущей страницы
   * @var string
   */
  protected $alias = 'index'; // алиас текущей страницы

  /*
   * идентификатор категории, поста, пользователя и прочее
   * @var integer
   */
  protected $id = 0; // идентификатор категории, поста, пользователя и прочее

  /*
   * пользовательские данные
   * @var array
   */
  protected $vars = [];

  /*
   * конфигурация сайта
   * @var array
   */
  public $config = []; // конфигурация сайта

  /*
   * свойство для хранения изменяющегося контента страницы
   * @var string
   */
  protected $content; // свойство для хранения изменяющегося контента страницы (вида)

  /*
   * свойство для хранения текущей HTML-страницы
   * @var string
   */
  protected $html; // свойство для хранения текущей HTML-страницы

  //protected $params; // массив параметров, полученных из адресной строки
  //protected $styles; // свойство для хранения стилей
  //protected $scripts; // свойство для хранения скриптов
  //protected $error; // свойство для хранения ошибок, которые записываются в файл log.txt

  public $errors = []; // массив для хранения ошибок валидации

  protected $View; // свойство для хранения объектов класса вида/шаблона
  protected $Model; // свойство для хранения объекта класса модели

  //protected $data = []; // различные данные, которые передаются в вид

  //protected $meta = []; // мета-данные для веб-страницы - заголовок, ключевые слова и краткое описание

  // создание объекта класса Controller
  public function __construct($route) {
    //echo 'Controller - метод __construct()<br>';

    $this->route = $route; // получение маршрута из контроллера Router
    //debug($this->route);

    $this->controller = (string)$this->route['controller'];
    $this->model = (string)$this->route['controller'];
    $this->prefix = (string)$this->route['prefix'];
    $this->prefix_separator = (string)$route['prefix_separator']; // разделитель префикса и контроллера
    //$this->prefix_separator = str_replace('\\', '/', $this->prefix_separator);
    $this->id = clear_int($this->route['id']); // abs((int)$this->route['id'])
    $this->alias = (string)$this->route['alias']; // получение алиаса текущей страницы
    $this->view = (string)$this->route['action']; // получение нужного вида из нужного метода
    $this->action = (string)$this->route['action'];
    //echo '$this->view='.$this->view.'<br>';

    //$this->model = ucwords((string)$route['action']); // получение названия модели

    // допустимые значения видов
    $view_array = array('contacts','default',
      'pricelist','error','admin','login','logout','delete','test',
    'bill','oferta',

    'index','about','courses','partner_products','downloads','secret','goods','view_news','view_partner_product','view_download',
    'view_product','date','search','creativity','interesting','verses','songs','music','films','galleries','view_gallery','articles',
    'registration','activation','deactivation','vkauth','fbauth','twauth','okauth','mrauth','goauth','yaauth','user_page','all_users','all_links','links',
    'sitemap','exit','delete_message','send_password','send_login','link','short_link','partner_link','download_link','internet_link',
    'buy_link','banner_link','download_file',

    'page','view','category',
    'phrase','phrases'
    );
    // проверка на имя несуществующего вида, полученного из адресной строки
    //if(!in_array($this->view,$view_array)) { // если в массиве $view_array нет искомого значения из массива $view, то $view = 'index'
    //debug($this->prefix_separator);
    //debug(V.S.$this->prefix.$this->prefix_separator.lcfirst($this->controller).S.$this->view.R);
    if (!is_file(V.S.$this->prefix.$this->prefix_separator.lcfirst($this->controller).S.$this->view.R)) {
      $this->view = 'index';
    }
    //echo '$this->view='.$this->view.'<br>';

    $this->View = new View($this->route, $this->layout, $this->view); // создание объекта класса вида/шаблона
    //$this->View = View::instance();

    //debug($this->View);
  }

  // клонирование объекта класса
  private function __clone() {
    return false;
  }

  // установка несуществующих свойств класса
  public function __set($name,$value) {
    return $this->vars[$name] = $value;
  }

  // вывод несуществующих свойств класса
  public function __get($name) {
    echo '<br>Свойство '.$name.' не существует, либо имеет закрытый ключ private.<br>';
    return debug($name);
  }

  // вызов несуществующих методов класса
  public function __call($name,$vars) {
    // $name - имя метода, $vars - массив параметров
    echo '<br>Метод '.$name.' с параметрами '.debug($vars).' не существует, либо имеет закрытый ключ private.<br>';
    return debug($vars);
  }

  // вывод объекта класса через echo
  public function __toString() {
    return 'Попытка преобразовать объект в строку<br>';
  }

  // удаление объекта класса
  public function __destruct() {

  }

  // метод для генерации страницы и получения HTML-кода
  public function renderHtml() {
    //debug($this->vars);
    //echo 'Рендерим вид '.$this->view.'<br>';
    $this->content = $this->render('', $this->vars); // рендерим нужный вид
    //debug($this->content);
    $this->output(); // получение нужных шаблонов для вывода страницы
    //debug($this->vars);
    //echo 'рендерим шаблон';
    $this->html = $this->renderLayout($this->vars); // рендерим нужный шаблон
    //if(!empty($this->error)) {
    //  $this->write_error($this->error);
    //}
    $this->outputpage(); // выводим готовую страницу на экран
  }

  // метод для получения входных данных, переопределяется в дочерних контроллерах
//  protected function input() {

//  }

  // метод для получения html-кода всей страницы, переопределяется в дочерних контроллерах
  protected function output() {

  }

  // вывод страницы
  public function outputpage() {
    //$this->html = $this->render($this->layout, $this->vars);
    echo $this->html; // выводим готовую страницу на экран
  }

  /* функция шаблонизатор
   * $view_path - путь к файлу вида или шаблона
   * $vars - пользовательские переменные
   */
  public function render($view_path = '',$vars = array()) {
    //debug($vars);
    //debug($view_path);
    $file_view = $this->getFileView($view_path); // получение пути к файлу вида или шаблона
    //$file_view = V.S.$view_path.R; // подключение файла вида из базовой папки с видами
    //echo '$file_view = '.$file_view;
    // если указанный путь является существующим файлом, то запускаем функцию буферизации
    if(is_file($file_view)) {
      // извлечение пользовательских переменных
      if (is_array($vars)) {
        extract($vars); // формирование переменных из массива параметров
      }
      ob_start(); // функция запуска буферизации
      require $file_view; // подгружаем файл вида или шаблона
      return ob_get_clean(); // вернуть данные из буфера
    }
    else {
      //echo '<p>Не найден вид или шаблон <b>'.$file_view.'</b></p>';
      throw new Exception('Не найден вид или шаблон <strong>'.$file_view.'</strong>', 404);
    }
  }

  // метод для рендеринга шаблона
  public function renderLayout($vars = array()) {
    //debug($vars);
    // если шаблон не равен false, то рендерим его из выбранного шаблона
    if ($this->layout !== false) {
      return $this->render($this->layout, $vars);
    }
    else {
      return '';
    }
  }

  // метод для рендеринга базового блока
  public function renderBlock($view_path = '', $block_title = '', $vars = array()) {
    $block_body = $this->render($view_path, $vars);
    $vars2 = compact('block_title', 'block_body');
    return $this->render('block', $vars2);
  }

  // метод для рендеринга постов
  public function renderPosts($vars = array()) {
    return $this->render('posts',$vars);
  }

  // метод для рендеринга постов 2 для коротких заметок
  public function renderPosts2($vars = array()) {
    return $this->render('posts2',$vars);
  }

  // метод для рендеринга одного поста
  public function renderPost($vars = array()) {
    return $this->render('post',$vars);
  }

  public function renderCourses($vars = array()) {
    return $this->render('courses',$vars);
  }

  // метод для рендеринга блочных списков
  public function renderList($vars = array()) {
    return $this->render('list',$vars);
  }

  // метод для рендеринга списков
  public function renderLi($vars = array()) {
    return $this->render('li',$vars);
  }

  // метод для рендеринга выпадающего списка
  public function renderSelect($vars = array()) {
    return $this->render('select',$vars);
  }

  // метод для рендеринга bpj,hf;tybq
  public function renderImage($vars = array()) {
    return $this->render('image',$vars);
  }

  // метод для рендеринга половинных блоков
  public function renderHalf($blocks = array()) {
    if (empty($blocks)) {
      return false;
    }
    else {
      $half_blocks = ''; // строка с полученными блоками
      $last_block = ''; // предыдущий блок
      $total_blocks = count($blocks); // общее количество блоков всего
      foreach ($blocks as $key => $item) {
        if ($key % 2 === 0) { // $key % 2 === 0 - чётное, первая итерация начинается с 0
          if ($key == $total_blocks - 1) { // если номер текущего блока равен общему количеству блоков - 1 (нумерация блоков $key начинается с 0), то
            $half_blocks = $half_blocks.$item; // основной блок равен основному блоку (из предыдущих итераций) + блок из текущей итерации
          }
          $last_block = $item; // при первой и нечётной итерации запоминается предыдущий блок
        }
        else { // $key & 1 - нечётное, первая итерация начинается с 0
          $half_blocks = $half_blocks.'
    <div class="half">
      <div class="left_half">'.$last_block.'</div>
      <div class="right_half">'.$item.'</div>
    <div class="clear"></div>
    </div>'; // при второй и чётной итерации основной блок равен основному блоку (из предыдущих итераций) +
          // + блок из предыдущей итерации + блок из текущей итерации
          $last_block = ''; // предыдущий блок зануляется
        }
      }
      return $half_blocks;
    }
  }

  // рендеринг постраничной навигации
  public function render_pagination($vars = array()){
    return $this->render('_pagination',$vars);
  }

  // рендеринг постраничной навигации для админки
  public function render_cppagination($vars = array()){
    return $this->render('_cppagination',$vars);
  }


  // получение пути к файлу вида
  protected function getFileView($view_path = '') {
    $file_view = '';
    // если вид не задан или не определён, то вычисляем вид из текущего вида (экшена)
    if (empty($view_path)) {
      if (empty($this->view)) {$this->view = 'index';}
      //debug($this->prefix_separator);
      //$this->prefix_separator = str_replace('\\', '/', $this->prefix_separator);
      //$this->prefix = str_replace('\\', '/', $this->prefix);
      // echo '$this->route[\'controller\']='.$this->route['controller'];
      //echo '$this->view='.$this->view;
      //$file_view = APP."/views/{$this->route['controller']}/{$this->view}.php";
      //$file_view = APP.'/views/'.$this->route['prefix'].$this->route['controller'].'/'.$this->view.'.php';
      //debug($this->route['alias']);
      //debug($this->prefix_separator);
      $file_view = V.S.$this->prefix.$this->prefix_separator.lcfirst($this->controller).S.$this->view.R; // подключение файла вида
      //debug($file_view); // путь в файлу нужного вида
    }
    else {
      $file_view = L.S.(string)$view_path.R; // иначе выбираем нужный шаблон в папке layouts
    }
    //echo '$file_view = '.$file_view;
    return $file_view;
  }

  // метод для передачи пользовательских данных в шаблон или вид
  public function set($vars) {
    $this->vars = $vars;
    //debug($this->vars);
  }

  public function isAjax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  // метод для рендеринга определённого вида
  public function loadView($view_path = '', $vars = array()) {
    return $this->render($view_path, $vars);
  }


  // метод для шифрования строки для записи куков
  protected function encrypt($plaintext = '') {
    $cipher="AES-128-CBC"; // метод шифрования
    $ivlen = openssl_cipher_iv_length($cipher); // получение длины вектора инициализации
    $iv = openssl_random_pseudo_bytes($ivlen); // создание вектора инициализации
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv); // шифрование строки, $key должен быть сгенерирован заранее криптографически безопасным образом, например, с помощью openssl_random_pseudo_bytes
    $hmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true); // генерация хеш-кода на основе ключа, используя метод HMAC
    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw ); // кодирование данныех в формат MIME base64
    return $ciphertext; // возвращение вектора инициализации, хеш-кода и зашифрованной строки
  }

  // метод для расшифровки строки для получения куков
  protected function decrypt($ciphertext = '') {
    $code = base64_decode($ciphertext); // декодирование данныех из формата MIME base64
    $cipher="AES-128-CBC"; // метод шифрования
    $ivlen = openssl_cipher_iv_length($cipher); // получение длины вектора инициализации
    $iv = substr($code, 0, $ivlen); // получение вектора инициализации
    $hmac = substr($code, $ivlen, $sha2len=32); // получение хеш-кода на основе ключа, используя метод HMAC
    $ciphertext_raw = substr($code, $ivlen+$sha2len); // получение зашифрованной строки
    $plaintext = openssl_decrypt($ciphertext_raw, $cipher, ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv); // дешифрование строки, $key должен быть сгенерирован заранее криптографически безопасным образом, например, с помощью openssl_random_pseudo_bytes
    $calcmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true); // генерация хеш-кода на основе ключа, используя метод HMAC
    if (hash_equals($hmac, $calcmac)) { // сравнение строк нечувствительное к атакам по времени
      return $plaintext; // возвращаем исходную строку
    }
    else {
      return false;
    }
  }

  public function getToken($form='token'){
    if (!isset($form)) {
      $form = 'token';
    }
    $str = strrev($form.'+'.DOMEN.'+'.TOKEN_KEY.'+'.time());
    $token = $this->encrypt($str);
    //debug($token);
    return $token;
  }

  public function checkToken($shifr='',$form='token'){
    if (empty($shifr)) return false;
    if (empty($form)) {
      $form = 'token';
    }
    $str = $this->decrypt($shifr);
    //debug($str);
    $str = strrev($str);
    list($shifr_form, $domen, $token, $time) = explode('+', $str); // создание переменных из массива
    //debug($shifr_form);
    //debug($domen);
    //debug($token);
    //debug($time);
    if ($shifr_form == $form and $domen == DOMEN and $token == TOKEN_KEY and ((time()-$time) < EXPIRATION_TIME)){ // если текущее время - время создания токена меньше 86400 сек
      return true;
    }
    else {
      return false;
    }
  }

  public function setMeta($title = '', $desc = '', $keywords = ''){
    $this->meta['title'] = $title;
    $this->meta['desc'] = $desc;
    $this->meta['keywords'] = $keywords;
  }


//////////////////////////////////////////////////////////


  // метод для возвращения параметров
  protected function getVars() {
    return $this->vars;
  }


}