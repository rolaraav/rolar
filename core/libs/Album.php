<?php
namespace core\libs;
use app\models\BaseModel;

class Album {

  protected $AlbumModel; // переменная для хранения объекта модели галереи

  public $album_id; // идентификатор нужного альбома


  public function __construct() {
    //echo 'Album::__construct()<br>';
    $this->AlbumModel = new BaseModel; // создание модели и соединение с базой данных
  }

  // метод для работы с Альбомами через Ajax
  public function index() {

  }

  // метод вывода(отображения) Альбомов
  public function render_album($album_id) {
    $this->album_id = $album_id;

    $files = $this->get_media($album_id); // получение всех медиафайлов выбранного альбома
    //debug($files);

    return $this->tmpl(array(
      'files'=>$files,
      'album_id'=>$this->album_id),'album');
  }

  // метод-шаблонизатор
  public function tmpl($var = array(), $tmp) {
    extract($var); // получение переменных из массива $var
    $path = ALBUM_PATH.$tmp.'.tpl.php'; // определение пути шаблона
    // echo $path."<br>";
    if(file_exists($path)) {
      ob_start(); // открытие буфера обмена
      require $path; // подключение шаблона
      return ob_get_clean(); // вывод данных на экран
    }
    exit();
  }


  // ---- Методы по работе Альбомов с БД ---- //
  // метод получения ВСЕХ мультимедиа файлов выбранного альбома или всех альбомов
  public function get_media($id=null) {
    // if(!$db instanceof mysql) {$db = gconnect_db();}
    if (isset($id)) {$where = ['album_id' => (int)$id, 'published' => 1, 'del' => 0];}
    else {$where = ['published' => 1, 'del' => 0];}
    return $this->AlbumModel->select(
      ['id','type','title','name','path','size'],
      'media',
      $where,
      ['='],
      false,
      false,
      false);
    // "SELECT id,type,title,name,path,size FROM media WHERE album_id = '$id' AND published=1 AND del=0";
    // "SELECT id,type,title,name,path,size FROM media WHERE published=1 AND del=0";
   }

  // метод для получения имени и названия песни
  public function get_song($id) {
    if (!isset($id)) {
      return false;
    }
    return $this->AlbumModel->select(
      ['id','type','title','name','path','size'],
      'media',
      ['id' => (int)$id, 'published' => 1, 'del' => 0],
      ['='],
      false,
      false,
      1);
    // "SELECT id,type,title,name,path,size FROM media WHERE album_id = '$id' AND published=1 AND del=0 LIMIT 1";
  }
  // ---- Методы по работе Альбомов с БД (конец) ---- //

}
?>