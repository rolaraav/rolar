<?php
namespace core\libs;
use app\models\BaseModel;

class Gallery {

  protected $GalleryModel; // переменная для хранения объекта модели галереи

  public function __construct() {
    //echo 'Gallery::__construct()<br>';
    $this->GalleryModel = new BaseModel; // создание модели и соединение с базой данных

  }

  // метод для работы с Галереей через Ajax
  public function index() {
    // вывод всех комментариев Галереи
    if (isset($_POST['allcom'])) {
      // отобразить все комментарии
      $gcomments = array();
      $gcomments = $this->get_gcomments((int)$_POST['gallery_id'],(int)$_POST['image_id'],(int)$_POST['number']);
      if (isset($gcomments)) {
        //ob_start();
        require GALLERY_PATH.'gcomment.tpl.php';
        //echo ob_get_clean();
      }
      exit();
    }

    // отправка комментария Галереи
    if (isset($_POST['act'])) {
      // формирование массива комментариев
      //debug($_POST);
      $gcomments = array();
      $gcomments = $this->send_gcomments($_POST); // отправка комментария
      //debug($gcomments);
      if(isset($gcomments)) { // обновление комментариев
        //ob_start();
        require GALLERY_PATH.'gcomment.tpl.php';
        //echo ob_get_clean();
      }
      exit();
    }

    // отображение и рендеринг одного изображения Галереи
    if (isset($_POST['image_id']) && isset($_POST['gallery_id'])) {
      // echo 'OK'; // отображение большого изображения
      $image_id = (int)$_POST['image_id'];
      $gallery_id = (int)$_POST['gallery_id'];
      if (isset($image_id) && isset($gallery_id)) {
        $show_image = json_encode($this->render_image($image_id,$gallery_id));
        echo $show_image; // отправка методом Ajax одного изображения пользователю
      }
      exit();
    }
  }

  // метод вывода(отображения) Галереи
  public function render_gallery($gallery_id) {
    $gallery = $this->get_gallery($gallery_id); // получение данных из галереи из базы данных
    $images = $this->get_images($gallery_id); // получение всех изображений выбранной галереи
    // debug($gallery);
    // debug($images);

    // приведение изображений к одинаковой высоте
    $simg = $images;
    $count = count($simg); // подсчет всех изображений в галерее
    $rows = array(); // количество рядов
    $imgs = true; // переменная для определения последнего изображения
    $i = 0; // счётчик
    if($count > 9) { // ручное разделение на ряды если изображений больше 9
      $rows[0] = array_splice($simg,0,2); // два верхних изображения
      $rows[1] = array_splice($simg,0,5); // 5 следующих изображений
      $rows[2] = array_splice($simg,0,5); // и все остальные изображения
    }
    else {
      while($imgs) {
        $rowLimit = G_ROW_IMG; // количество изображений в ряду, по умолчанию 4
        $summ = $i + $rowLimit; // определение картинок
        if($summ > $count) {
          $rowLimit = $count - $i; // коррекция кколичества картинок в ряду
        }
        $r = array_splice($simg, 0, $rowLimit); // отбор части массива $simg с нулевой ячейки в количестве $rowLimit
        if(!$r) {
          break;
        }
        $rows[] = $r;
        $i = $i + G_ROW_IMG; // увеличение счётчика на количество изображений в одном ряду
        if($i >= $count) { // условие выхода из цикла
          $imgs = false; // дошли до последнего изображения
        }
      }
    }
    // echo GALLERY_IMAGES.$gallery[0]['name'].'/'.G_IMG_MEDIUM;
    // print_array($rows); // получение рядов изображений
    foreach($rows as $row) {
      $width = array(); // массив значений ширины изображений
      $height = array(); // массив значений высоты изображений

      foreach($row as $img) {
        $i = imagecreatefromjpeg(GALLERY_IMAGES.$gallery['name'].S.G_IMG_LARGE.$img['name']); // G_IMG_MEDIUM получение изображений
        $width[] = imagesx($i); // определение ширины
        $height[] = imagesy($i); // определение высоты
        imagedestroy($i);
      }
      // print_array($width); print_array($height);
      foreach($width as $key=>$val) {
        $width[$key] = floor($val * min($height)/$height[$key]); // обновление ширины изображений
      }
      $rh = floor(min($height) * G_ROW_WIDTH/array_sum($width)); // массив в котором содержится высота каждого ряда
      $width1 = array(); // скорректированная ширина
      foreach($width as $key=>$val) {
        $width1[] = floor($val * $rh/min($height));
      }
      $width_img[] = $width1; // массив ширин изображений
      $row_height[] = $rh;
      // print_array($width_img);
      // print_array($row_height);
    }

    // вывод гелереи и комментариев
    if ($gallery['comments']) { // если комментарии к галерее разрешены
      // подсчёт комментариев в данной галерее
      $count_gcomments = $this->get_count_gcomments(false,$gallery_id);
      $gcomments = $this->get_gcomments($gallery_id,null,null); // получение комментариев данной галереи
      // debug($gcomments);
      $comments_str = $this->tmpl(array('gcomments'=>$gcomments),'gcomment'); // получение отдельных комментариев
      $comments_tmp = $this->tmpl(array('comments_str'=>$comments_str,
        'gallery_id'=>$gallery_id,
        'image_id'=>0,
        'act'=>'gal',
        'count_gcomments'=>$count_gcomments),'gcomments'); // получение блока с комментариями
    }
    else {
      $comments_tmp = '';
    }

    return $this->tmpl(array('gcomments'=>$comments_tmp,
      'row_height'=>$row_height,
      'width_img'=>$width_img,
      'rows'=>$rows,
      'gallery_id'=>$gallery_id,
      'gallery'=>$gallery),'gallery');
  }


  // метод отображения одного изображения
  public function render_image($image_id,$gallery_id) {
    if($image_id && $gallery_id) {
      $gallery = $this->get_gallery($gallery_id); // получение данных из галереи
      $image = $this->get_image($gallery_id); // получение всех изображений (и их полной информации) галереи
      $count_image = count($image); // подсчёт всех изображений в галерее
      // debug($image);
      $arr = array();
      $arr['gallery'] = $gallery; // данные галереи (имя и название, разрешение комментировать)
      $arr['summ'] = $count_image; // количество всех изображений в галерее
      $arr['gal'] = $gallery_id; // идентификатор галереи
      foreach($image as $key=>$item) { // для всех полученных изображений
        if ($item['id'] == $image_id) {// если id посматриваемого изображения равен заданному параметру $id_image
          $item['name'] = GIMAGES.$arr['gallery']['name'].S.G_IMG_LARGE.$item['name'];
          $arr['image'] = $item;
          $arr['image']['date'] = get_datetime($item['date']); // grusdate('j %MONTH% Y, G:i:s',gstrdatetosec($item['date'])
          $arr['pos'] = $key; // определение позиции изображения в галерее
          // определение следующего изображения в галерее
          if ($key == $arr['summ']) {
            $arr['next'] = $image[1]['id']; // если изображение последнее в галерее, то берём первое изображение
          }
          else {
            $arr['next'] = $image[$key+1]['id']; // а если не последнее, то берём следующее изображение
          }
          $arr['back'] = ($key == 1) ? $image[$arr['summ']]['id']:$image[$key-1]['id'];
        }
      }
      // если комментарии к изображению разрешены
      if ($arr['image']['comments'] == 1) {
        // подсчёт комментариев
        $count_gcomments = $this->get_count_gcomments($image_id,false);
        //debug($count_gcomments);
        // получение комментариев для большого изображения
        $gcomments = $this->get_gcomments(false,$image_id,false);
        //debug($gcomments);
        $comments_str = $this->tmpl(array('gcomments'=>$gcomments),'gcomment');
        $arr['gcomments'] = $this->tmpl(array('comments_str'=>$comments_str,
          'gallery_id'=>$gallery_id,
          'image_id'=>$image_id,
          'act'=>'img',
          'count_gcomments'=>$count_gcomments),'gcomments');
      }
      else {
        $arr['gcomments'] = '<div class="gallery_comments"><p class="gallery_not_comments">Комментарии к этой фотографии скрыты настройками приватности.</p></div>';
      }
      //debug($arr['gcomments']);
      //debug($arr);
      return $this->tmpl(array('arr'=>$arr,),'gimage');
    }
    return false;
  }

  // метод-шаблонизатор
  public function tmpl($var = array(), $tmp) {
    extract($var); // получение переменных из массива $var
    $path = GALLERY_PATH.$tmp.'.tpl.php'; // определение пути шаблона
    // echo $path."<br>";
    if(file_exists($path)) {
      ob_start(); // открытие буфера обмена
      require $path; // подключение шаблона
      return ob_get_clean(); // вывод данных на экран
    }
    exit();
  }

  // метод отправки комментариев
  public function send_gcomments($post) {
    //$post - массив $_POST
    //debug($_POST);
    $arr = array();
    $comment_array = array();
    foreach ($post as $key=>$item) {
      $var = strip_tags($item);
      if($key == 'author') {
        if(empty($var)) return false;
      }
      if($key == 'email') {
        if(empty($var)) return false;
      }
      if($key == 'text') {
        if(empty($var)) return false;
      }
      $arr[$key] = $var;
    }
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['id'] = $this->add_gcomment($arr); // добавление комментария в базу данных - в результат получаем ID последнего добавленного комментария
    //debug($arr);
    $comment_array[$arr['id']] = $arr;
    return $comment_array;
  }



  // ---- Методы по работе Галереи с БД ---- //
  // метод для получения имени и названия галереи
  public function get_gallery($id) {
    // if(!$db instanceof mysql) {$db = gconnect_db();}
    if (!isset($id)) {
      return false;
    }
    return $this->GalleryModel->select(
      ['name','title','comments'],
      'galleries',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1);
    // "SELECT name,title,comments FROM galleries WHERE id = '$id' LIMIT 1";
   }

  // метод получения всех данных галереи
  public function get_full_gallery($id) {
    // if(!$db instanceof mysql) {$db = gconnect_db();}
    if (!isset($id)) {
      return false;
    }
    return $this->GalleryModel->select(
      ['id','name','title','image','comments'],
      'galleries',
      ['id' => (int)$id],
      ['='],
      false,
      false,
      1);
    // "SELECT id,name,title,image,comments FROM galleries WHERE id = '$id' LIMIT 1";
  }

  // метод получения нескольких изображений галереи для отображения галереи
  public function get_images($gallery_id) {
    if (!isset($gallery_id)) {
      return false;
    }
    return $this->GalleryModel->select(
      ['id','name'],
      'gimages',
      ['gallery_id' => (int)$gallery_id],
      ['='],
      false,
      false,
      12);
    // "SELECT id,name FROM gimages WHERE gallery_id = '$gallery_id' LIMIT 12";
  }

  // метод получения ВСЕХ изображений выбранной галереи для отображения одиночных изображений
  public function get_image($gallery_id) {
    if (!isset($gallery_id)) {
      return false;
    }
    return $this->GalleryModel->select(
      ['id','name','text','date','comments'],
      'gimages',
      ['gallery_id' => (int)$gallery_id],
      ['='],
      false,
      false,
      false);
    // "SELECT id,name,text,date,comments FROM gimages WHERE gallery_id='$gallery_id'";
  }

  // метод подсчёта количества комментариев
  public function get_count_gcomments($im = false,$gal = false) {
    if (!empty($im)) {
      $where = ['image_id' => $im];
    }
    elseif(!empty($gal)) {
      $where = ['gallery_id' => $gal];
    }
    return $this->GalleryModel->select('id', 'gcomments', $where); //  ['='], false, false, false, false, false, array(), true
    // "SELECT COUNT(id) FROM gcomments WHERE image_id = ".$im;"
    // "SELECT COUNT(id) FROM gcomments WHERE gallery_id = ".$gal;"

    // "SELECT COUNT(*) as count FROM gcomments WHERE image_id = ".$im; - старый запрос
    // "SELECT COUNT(*) as count FROM gcomments WHERE gallery_id = ".$gal; - старый запрос
  }

  // метод получения комментариев Галереи
  public function get_gcomments($gallery_id = FALSE, $image_id = FALSE, $number = FALSE) {
    // if(!$db instanceof mysql) {$db = gconnect_db();}
    if (!empty($gallery_id)) {
      $where = ['gallery_id' => $gallery_id];
    }
    elseif(!empty($image_id)) {
      $where = ['image_id' => $image_id];
    }
    // количество отображаемых комментариев на странице галереи и странице просмотра изображений
    if ((int)$number > G_LIMIT_COMMENTS) {
      $limit = [G_LIMIT_COMMENTS, ((int)$number - G_LIMIT_COMMENTS)];
    }
    else {
      $limit = [0, G_LIMIT_COMMENTS];
    }
    return $this->GalleryModel->select(
      ['id','text','author','email','date','parent_id'],
      'gcomments',
      $where,
      ['='],
      'id',
      'DESC',
      $limit);
    // "SELECT id,text,author,email,date,parent_id FROM gcomments WHERE gallery_id = 'gallery_id' ORDER BY id DESC LIMIT 0, 'G_LIMIT_COMMENTS'";
    // "SELECT id,text,author,email,date,parent_id FROM gcomments WHERE $image_id = '$image_id' ORDER BY id DESC LIMIT 'G_LIMIT_COMMENTS', 7-'G_LIMIT_COMMENTS'";
  }

  // метод добавления комментария в БД
  public function add_gcomment($post) {
    // if(!$db instanceof mysql) {$db = gconnect_db();}
    if(!is_array($post)) {
      return false;
    }
    //foreach ($post as $key =>$item) {
    //  $post[$key] = mysql_real_escape_string($item);
    //}
    $parent_id = 0;
    //$date = date("Y-m-d H:i:s");
    if ($post['parent_id'] > 0) {
      $parent_id = (int)$post['parent_id'];
    }
    if ($post['act'] == 'img') {
      $post['gallery_id'] = 0;
    }
    elseif($post['act'] == 'gal') {
      $post['image_id'] = 0;
    }
    $id_last_comment = $this->GalleryModel->insert(
      'gcomments',
      array('published','gallery_id','image_id','parent_id','author','email','site','date','text'),
      array(1,$post['gallery_id'],$post['image_id'],$parent_id,$post['author'],$post['email'],'',$post['date'],$post['text']),
      true
    );
    // "INSERT INTO gcomments (published,gallery_id,image_id,parent_id,author,email,site,date,text) VALUES (1,$post['gallery_id'],$post['image_id'],$parent_id,$post['author'],$post['email'],'',$date,$post['text'])";

    return $id_last_comment;
    /*
    //debug($id_last_comment);
    if ($id_last_comment === false) { // определение идентификатора последней добавленной записи
      return false;
    }

    // получаем последний добавленный комментарий
    return $this->GalleryModel->select(
      ['id','text','author','email','date','parent_id'],
      'gcomments',
      ['id' => (int)$id_last_comment],
      ['='],
      'id',
      'DESC',
      1); */
    // "SELECT id,text,author,email,date,parent_id FROM gcomments WHERE id='$id_last_comment' LIMIT 1";
  }
// ---- Методы по работе Галереи с БД (конец) ---- //

}
?>