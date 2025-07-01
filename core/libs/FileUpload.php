<?php
namespace core\libs;

use core\Core;

// Класс для загрузки файлов
class FileUpload {

  public $original_file_name = ''; // оригинальное имя загружаемого файла с расширением

  public $file_name = ''; // имя загруженного файла с расширением (только имя и расширение, путь и слеши не включены, например rolar.jpg)
  public $mime_type = 'application/octet-stream'; // MIME-тип загужаемого файла
  public $tmp_file = ''; // путь и имя временного файла (полный адрес к временному файлу)
  public $file_error = 0; // ошибки при загрузке файла
  public $file_size = 0; // размер файла в байтах

  public $file_extension = ''; // расширение загружаемого файла
  public $file_type = 'image'; // тип файла (выбирается из массива типов - изображение, документ, аудио, видео, архив, скрипт, программа или другой)

  public $check_type = false; // проверять тип файла
  public $upload_dir = UPLOAD; // путь для загрузки файла

  public $result = array('answer' => 'Ошибка: массив $_FILES пустой. Возможно файл слишком большой. Файл не загружен.', 'files' => ''); // результат загрузки файла

  private $type_categories = array('images', 'documents', 'audio', 'video', 'arhives', 'scripts', 'programs'); // допустимые типы файлов

  //////////config////////////////////
  //const MAX_FILE_SIZE = 104857600; // максимальный размер загружаемого файла 104857600 байт = 100 Мб
  //const UPLOAD_DIR = 'uploads'; // путь для загрзки файла по умолчанию
  //////////config////////////////////


  public function __construct() {
    // для больших файлов СМОТРЕТЬ в настройках php.ini:
    // upload_max_filesize - максимальный размер загружаемого файла
    // post_max_size - устанавливает максимально допустимый размер данных, передаваемых методом POST

    //$max_file_size = MAX_FILE_SIZE // 104857600 - максимальный размер файла 100 Мб // 2097152

    // определяем макимальный размер файла
    if (POST_MAX_SIZE >= UPLOAD_MAX_FILESIZE) {
      define('MAX_FILE_SIZE', get_bytes(UPLOAD_MAX_FILESIZE)); // 104857600 байт = 100 Мб
    }
    else {
      define('MAX_FILE_SIZE', get_bytes(POST_MAX_SIZE)); // 104857600 байт = 100 Мб
    }
    //echo 'есть';
  }




  // Функция загрузки файлов (начало)
  public function fileupload($check_type = false, $upload_dir = UPLOAD) {

    // проверка наличия массива $_FILES
    if (!isset($_FILES['file'])) {
      $this->result = array('answer' => 'Ошибка: массив $_FILES пустой. Возможно файл слишком большой. Файл не загружен.', 'files' => $_FILES['file']);
      exit(json_encode($this->result));
    }

    // получаем имя загруженного файла
    //$file_name = $_FILES['file']['name'];
    //unset($_FILES['file']['name']);
    $this->original_file_name = basename((string)$_FILES['file']['name']); // оригинальное имя файла с расширением
    $this->file_name = translit2($this->original_file_name); // имя загруженного файла с расширением
    //$this->file_name = basename($_FILES['file']['name']); // имя файла с расширением
    //$this->file_name = iconv('UTF-8', 'Windows-1251', $_FILES['file']['name']);

    // получаем все данные из массива $_FILES
    $this->mime_type = (string)$_FILES['file']['type']; // MIME-тип загруженного файла
    $this->tmp_file = (string)$_FILES['file']['tmp_name']; // временный файл
    $this->file_error = (int)$_FILES['file']['error']; // ошибки при загрузке файлов
    $this->file_size = (int)$_FILES['file']['size']; // размер загруженного файла

    // получаем расширение загруженного файла
    $this->file_extension = getExtension($this->file_name); // определение расширения файла
    if ($this->file_extension == 'jpeg' or $this->file_extension == 'jpe') {
      $this->file_extension = 'jpg';
    }

    // если MIME-тип загруженного файла равен 'application/octet-stream'
    if ((string)$_FILES['file']['type'] == 'application/octet-stream') {
      $this->mime_type = $this->getMimeTypeOfExtension($this->file_extension); // то проверяем MIME-тип по расширению файла
    }
    /* else {
      $this->mime_type = $_FILES['file']['type']; // иначе оставляем MIME-тип загруженного файла
    } */

    // получаем тип загруженного файла
    $this->file_type = $this->getFileType($this->file_name); // определение типа файла

    // проверка типа файла из заданных допустимых типов по его расширению
    $check_type = in_array((string)$check_type, $this->type_categories) ? (string)$check_type : false;
    switch ($check_type) {
      case('images'):
        $enabled_types = 'jpg,jpeg,gif,png,bmp,wbmp';
        break;
      case('documents'):
        $enabled_types = 'chm,doc,docx,djv,djvu,pdf,pps,ppt,pptx,rtf,txt,vsd,vsdx,xls,xlsx';
        break;
      case('audio'):
        $enabled_types = 'mp3,wav,wmv,ogg,mid,midi';
        break;
      case('video'):
        $enabled_types = 'avi,mpg,mpeg,mp4,mov,m4v,swf,flv,qt,vob';
        break;
      case('arhives'):
        $enabled_types = 'zip,rar,7z,iso,tar,gz,gzip';
        break;
      case('scripts'):
        $enabled_types = 'htm,html,css,php,js,xml';
        break;
      case('programs'):
        $enabled_types = 'exe,com,bat,msi,pif';
        break;
      default:
        $enabled_types = 'jpg,jpeg,gif,png,bmp,wbmp';
    }
    // проверяем расширение на соответствие заданным типам
    if (($check_type != false) and (strpos($enabled_types, $this->file_extension) === false)) {
      $this->result = array('answer' => 'Ошибка: не допустимый тип файла. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      exit(json_encode($this->result));
    }

    /* ===Обработка данных (начало)=== */
    // если есть ошибки при загрузке файла
    if ($this->file_error != 0) {
      switch ($this->file_error) {
        case(1):
          $message = ' - размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini';
          break;
        case(2):
          $message = ' - размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме';
          break;
        case(3):
          $message = ' - загружаемый файл был получен только частично';
          break;
        case(4):
          $message = ' - файл не был загружен';
          break;
        case(6):
          $message = ' - отсутствует временная папка';
          break;
        case(7):
          $message = ' - не удалось записать файл на диск';
          break;
        case(8):
          $message = ' - PHP-расширение остановило загрузку файла';
          break;
        default:
          $message = '';
      }
      $this->result = array('answer' => 'Ошибка: код ошибки '.$this->file_error.$message.'. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      exit(json_encode($this->result));
    }

    // Если временный файл не загружен по каким-то причинам, то выводим ошибку
    if (!@is_uploaded_file($this->tmp_file) or empty($this->tmp_file)) {
      $this->result = array('answer' => 'Ошибка: временный файл '.$this->tmp_file.' пустой. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      exit(json_encode($this->result));
    }

    // Если размер загруженного файла больше максимально допустимого размера или размер файла равен нулю
    if ($this->file_size > MAX_FILE_SIZE or $this->file_size == 0) {
      $result = array('answer' => 'Ошибка: максимальный размер файла - '.MAX_FILE_SIZE.' байт, минимальный размер файла - 1 байт. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      exit(json_encode($result));
    }

    // Если MIME-тип изображения не соотествует допустимым значениям
    if ($check_type == 'images') {
      // допустимые типы файлов (изображений)
      $images_types = array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/x-png', 'image/bmp', 'image/vnd.wap.wbmp');
      if (!in_array($this->mime_type, $images_types)) {
        $this->result = array('answer' => 'Ошибка: допустимые типы файлов - .jpg, .gif, .png, .bmp, .wbmp. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
        delete_file($this->tmp_file); // удаляем временный файл
        exit(json_encode($this->result));
      }
    }

    // если имя файла пустое, то генерируем новое имя
    if (empty($this->file_name)) {
      $ext = $this->getExtencionOfMimeType($this->mime_type); // получаем расширение файла по его MIME-типу
      if (empty($ext)) {
        $this->result = array('answer' => 'Ошибка: не передано имя файла. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
        delete_file($this->tmp_file); // удаляем временный файл
        exit(json_encode($this->result));
      }
      $name = substr(md5(microtime()), 0, 11); // генерируем произвольное имя из 11 символов
      $this->file_name = $name.'.'.$ext;
    }
    /* ===Обработка данных (конец)=== */

    // проверка существования директории
    //chr(47) = '/';
    //echo getcwd(); // возвращает имя текущего рабочего каталога
    //$upload_dir = getcwd().'/files';
    if (empty($this->upload_dir) or ($this->upload_dir == '/')) {
      $this->upload_dir = UPLOAD; // 'uploads';
    }
    // $this->upload_dir = validate_path($upload_dir); - для функции validate_path ВОЗМОЖНО ТРЕБУЕТСЯ ДОРАБОТКА и проверка
    //debug($upload_dir);
    if (!file_exists($this->upload_dir)) { // Проверяем на существование папку $upload_dir
      if (!mkdir($this->upload_dir, 0777, true)) { // Для создания вложенной структуры необходимо указать параметр $recursive в mkdir()
        $this->result = array('answer' => 'Ошибка: не удалось создать директорию '.$this->upload_dir.'. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
        delete_file($this->tmp_file); // удаляем временный файл
        exit(json_encode($this->result));
      }
    }

    // перемещение загруженного файла в нужную директорию
    if (@move_uploaded_file($this->tmp_file, $this->upload_dir.S.iconv('UTF-8', 'cp1251', $this->file_name))) {
      $this->result = array('answer' => 'Файл '.$this->original_file_name.' успешно загружен.', 'file' => $this->file_name, 'uploaddir' => $this->upload_dir, 'type' => $this->file_type, 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      return $this->result;
    } else {
      $this->result = array('answer' => 'Ошибка: проверьте права на запись в каталог '.$this->upload_dir.'. Файл '.$this->original_file_name.' не загружен.', 'files' => $_FILES['file']);
      delete_file($this->tmp_file); // удаляем временный файл
      exit(json_encode($this->result));
    }
  }
// Функция загрузки файлов (конец)



  // функция для определения типа файла
  public function getFileType($file_name) {
    if (empty($file_name)) {
      return false;
    }
    $type = false;
    // определяем тип файла по его расширению
    $extension = getExtension($file_name);
    //echo '$extension='.$extension;
    $images = 'ani,art,awd,bmp,bw,cdr,cgm,clp,crw,cur,dcx,dib,drw,dxf,emf,eps,fon,fpx,gif,icc,icl,icm,icn,ico,iff,ilbm,img,int,inta,jfif,jif,jpe,jpeg,jpg,kdc,lbm,ldf,lwf,mag,pbm,pcd,pct,pcx,pgm,pic,pict,pix,png,ppm,psd,psp,qtif,ras,rdb,rgb,rgba,rle,rsb,sfw,sgi,sid,tga,thm,tif,tiff,ttc,ttf,wbmp,wmf,wpg,xbm,xif,xpm';
    $documents = 'ans,asc,bbs,chm,dic,diz,djv,djvu,doc,docx,dochtml,dot,dothtml,exc,ion,log,mcv,mdb,nfo,pdf,pps,ppsx,ppt,pptx,prn,rtf,scp,srt,ssa,std,sub,txt,text,vsd,vsdx,xls,xlsx,xlb,xlc,xlk,xlm,xls,xlw,wbk,wiz,wps';
    $audio = '669,ac3,aif,aifc,aiff,amf,au,cda,far,it,itz,kar,m3u,mdz,med,mid,midi,miz,mka,mod,mp1,mp2,mp3,mpa,mtm,nsa,nst,ogg,okt,pcm,pls,ptm,ra,rm,rmi,s3m,s3z,snd,stm,stz,ult,vvs,voc,wav,wave,wma,xm,xmz';
    $video = '3gp,asf,asx,avi,divx,flc,fli,flv,flx,ifo,ivf,m1v,m2v,m3v,m4v,mkv,mov,mp2v,mp4,mpe,mpeg,mpg,mpv,mpv2,ogm,qt,ram,swf,vob,wm,wmv,wmx';
    $arhives = '7z,ace,arj,b64,bz,bz2,cab,gz,gzip,jar,lha,lzh,mim,mme,pae,r00,r01,r02,r03,r04,r05,r06,r07,r08,r09,rar,rev,sef,tar,taz,tbz,tbz2,tgz,uu,uue,wms,wsz,xxe,z,zip,bwt,ccd,cdc,cdi,cmi,cue,iso,mdf,mds,nbi,ncd,nco,nct,nhf,nhv,nji,nmd,nr3,nr4,nra,nrb,nrc,nrd,nre,nrg,nrh,nri,nrm,nrs,nru,nrv,nrw,nsd,pdi';
    $scripts = 'asp,bat,cht,chtm,chtml,css,dhm,dht,dhtm,dhtml,fphtml,hlp,htm,html,htt,htx,inf,ini,its,java,js,ise,mfp,mhm,mht,mhtm,mhtml,php,sct,shm,sht,shtm,shtml,vbe,vbs,wsc,wsf,wsh,xml,xsl';
    $programs = 'bin,cpl,crl,crt,dll,drv,msc,oca,ocx,sys,vxd,wcx,wdx,wfx,wlx,com,cmd,exe,msi,lnk,mad,maf,mam,maq,mar,mas,mav,maw,pif,scr,shb,url';
    // strpos - возвращает false, если искомая строка не найдена
    // если среди расширений изображений есть нужное расширение (совпадение найдено), то тип файла - изображение
    if (strpos($images, $extension) !== false) {
      $type = 'image';
    } // если среди расширений документов есть нужное расширение (совпадение найдено), то тип файла - документ
    elseif (strpos($documents, $extension) !== false) {
      $type = 'document';
    } // если среди расширений аудио есть нужное расширение (совпадение найдено), то тип файла - аудио
    elseif (strpos($audio, $extension) !== false) {
      $type = 'audio';
    } // если среди расширений видео есть нужное расширение (совпадение найдено), то тип файла - видео
    elseif (strpos($video, $extension) !== false) {
      $type = 'video';
    } // если среди расширений архивов есть нужное расширение (совпадение найдено), то тип файла - архив
    elseif (strpos($arhives, $extension) !== false) {
      $type = 'arhive';
    } // если среди расширений скриптов есть нужное расширение (совпадение найдено), то тип файла - скрипт
    elseif (strpos($scripts, $extension) !== false) {
      $type = 'script';
    } // если среди расширений программ есть нужное расширение (совпадение найдено), то тип файла - программа
    elseif (strpos($programs, $extension) !== false) {
      $type = 'program';
    } else { // иначе тип файла - иной
      $type = 'other';
    }
    return $type;
  }



  /**
   * Get the MIME type for a file extension.
   * @param string $ext File extension
   * @access public
   * @return string MIME type of file.
   * @static
   */
  public function getMimeTypeOfExtension($extension = '') {
    $mimes = array(
      // приложения
      'bin' => 'application/octet-stream',
      //'bin' => 'application/macbinary',
      'class' => 'application/octet-stream',
      'dll' => 'application/octet-stream',
      'dms' => 'application/octet-stream',
      'exe' => 'application/octet-stream',
      //'exe' => 'application/x-msdownload',
      'lha' => 'application/octet-stream',
      'lzh' => 'application/octet-stream',
      //'psd' => 'application/octet-stream',
      'sea' => 'application/octet-stream',
      'so' => 'application/octet-stream',
      'dmg' => 'application/octet-stream',
      'iso' => 'application/octet-stream',

      // архивы
      'zip' => 'application/zip',
      'rar' => 'application/x-rar-compressed',
      'msi' => 'application/x-msdownload',
      'cab' => 'application/vnd.ms-cab-compressed',
      'tar' => 'application/x-tar',
      'tgz' => 'application/x-tar',
      //'tgz' => 'application/x-gzip',
      'gz' => 'application/x-gzip',
      'img' => 'application/x-img',

      // ms office
      'doc' => 'application/msword',
      'word' => 'application/msword',
      'rtf' => 'application/rtf',
      'xls' => 'application/vnd.ms-excel',
      'xl' => 'application/excel',
      'ppt' => 'application/vnd.ms-powerpoint',
      'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
      'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
      'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
      'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
      'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
      'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
      'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
      'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
      'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',

      // open office
      'odt' => 'application/vnd.oasis.opendocument.text',
      'ods' => 'application/vnd.oasis.opendocument.spreadsheet',

      // adobe
      'pdf' => 'application/pdf',
      'psd' => 'application/x-photoshop', // 'image/vnd.adobe.photoshop',
      'ai' => 'application/postscript',
      'eps' => 'application/postscript',
      'ps' => 'application/postscript',

      // текст
      'txt' => 'text/plain',
      'text' => 'text/plain',
      'asc' => 'text/plain',
      'htm' => 'text/html',
      'html' => 'text/html',
      'shtml' => 'text/html',
      'css' => 'text/css',
      'log' => 'text/plain',
      //'log' => 'text/x-log',
      'rtx' => 'text/richtext',
      //'rtf' => 'text/rtf',
      'vcf' => 'text/vcard',
      'vcard' => 'text/vcard',
      'xml' => 'text/xml',
      'xsl' => 'text/xml',
      'reg' => 'text/x-registry',
      'etx' => 'text/x-setext',
      'sql' => 'text/x-sql',
      'ics' => 'text/calendar',
      'ifb' => 'text/calendar',
      'sgml' => 'text/sgml',
      'sgm' => 'text/sgml',
      'tsv' => 'text/tab-separated-values',
      'vbs' => 'text/vbscript',
      'wml' => 'text/vnd.wap.wml',
      'wmls' => 'text/vnd.wap.wmlscript',
      'cnf' => 'text/x-config',
      'conf' => 'text/x-config',

      'php' => 'application/x-httpd-php',
      //'php' => 'text/html',
      'php3' => 'application/x-httpd-php',
      'php4' => 'application/x-httpd-php',
      'php5' => 'application/x-httpd-php',
      'php6' => 'application/x-httpd-php',
      'phtml' => 'application/x-httpd-php',
      'phps' => 'application/x-httpd-php-source',
      'swf' => 'application/x-shockwave-flash',
      'sit' => 'application/x-stuffit',
      'cgi' => 'application/cgi',
      'js' => 'application/javascript',
      //'js' => 'application/x-javascript',
      'json' => 'application/json',
      //'xml' => 'application/xml',
      'dtd' => 'application/xml-dtd',
      'xht' => 'application/xhtml+xml',
      'xhtml' => 'application/xhtml+xml',
      'mathml' => 'application/mathml+xml',
      'pl' => 'application/perl',
      'plx' => 'application/perl',
      'ppl' => 'application/perl',
      'perl' => 'application/perl',
      'pm' => 'application/perl',
      'rdf' => 'application/rdf+xml',
      'rb' => 'application/ruby',

      'eml' => 'message/rfc822',

      // изображения
      'png' => 'image/png',
      //'png' => 'image/x-png',
      'jpe' => 'image/jpeg',
      'jpeg' => 'image/jpeg',
      'jpg' => 'image/jpeg',
      //'jpg' => 'image/pjpeg',
      'gif' => 'image/gif',
      'bmp' => 'image/bmp',
      'ico' => 'image/x-icon',
      //'ico' => 'image/vnd.microsoft.icon',
      'tiff' => 'image/tiff',
      'tif' => 'image/tiff',
      'svg' => 'image/svg+xml',
      'svgz' => 'image/svg+xml',
      'cgm' => 'image/cgm',
      'ief' => 'image/ief',
      'djvu' => 'image/vnd.djvu',
      'djv' => 'image/vnd.djvu',
      'wbmp' => 'image/vnd.wap.wbmp',
      'ras' => 'image/x-cmu-raster',
      'pnm' => 'image/x-portable-anymap',
      'pbm' => 'image/x-portable-bitmap',
      'pgm' => 'image/x-portable-graymap',
      'ppm' => 'image/x-portable-pixmap',
      'rgb' => 'image/x-rgb',
      'xbm' => 'image/x-xbitmap',
      'xpm' => 'image/x-xpixmap',
      'xwd' => 'image/x-xwindowdump',

      // аудио
      'au' => 'audio/basic',
      'snd' => 'audio/basic',
      'm4p' => 'audio/mp4',
      'm4a' => 'audio/mp4',
      'ogg' => 'application/ogg',
      'mid' => 'audio/mid',
      'midi' => 'audio/midi',
      'kar' => 'audio/midi',
      'mp2' => 'audio/mpeg',
      'mp3' => 'audio/mpeg',
      'mpga' => 'audio/mpeg',
      'aif' => 'audio/x-aiff',
      'aifc' => 'audio/x-aiff',
      'aiff' => 'audio/x-aiff',
      'ram' => 'audio/x-pn-realaudio',
      'rm' => 'audio/x-pn-realaudio',
      //'rm' => 'application/vnd.rn-realmedia',
      'rpm' => 'audio/x-pn-realaudio-plugin',
      'ra' => 'audio/x-realaudio',
      //'ra' => 'audio/x-pn-realaudio',
      'wav' => 'audio/wav',
      //'wav' => 'audio/x-wav',
      'wma' => 'audio/x-ms-wma',
      'm3u' => 'audio/mpegurl',
      //'m3u' => 'audio/x-mpegurl',
      'wax' => 'audio/x-ms-wax',

      // видео
      'mpeg' => 'video/mpeg',
      'mpe' => 'video/mpeg',
      'mpg' => 'video/mpeg',
      'rv' => 'video/vnd.rn-realvideo',
      'avi' => 'video/avi',
      //'avi' => 'video/x-msvideo',
      'mp4' => 'video/mp4',
      'movie' => 'video/x-sgi-movie',
      'flv' => 'video/x-flv',
      'qt' => 'video/quicktime',
      'mov' => 'video/quicktime',
      'mxu' => 'video/vnd.mpegurl',
      'm4u' => 'video/vnd.mpegurl',

      // прочие
      'oda' => 'application/oda',
      'smi' => 'application/smil',
      'smil' => 'application/smil',
      'gram' => 'application/srgs',
      'grxml' => 'application/srgs+xml',
      'mif' => 'application/vnd.mif',
      'wbxml' => 'application/vnd.wap.wbxml',
      'wmlc' => 'application/vnd.wap.wmlc',
      'wmlsc' => 'application/vnd.wap.wmlscriptc',
      'dcr' => 'application/x-director',
      'dir' => 'application/x-director',
      'dxr' => 'application/x-director',
      'dvi' => 'application/x-dvi',
      'gtar' => 'application/x-gtar',
      'hqx' => 'application/mac-binhex40',
      'cpt' => 'application/mac-compactpro',
      'ez' => 'application/andrew-inset',
      'atom' => 'application/atom+xml',
      'xul' => 'application/vnd.mozilla.xul+xml',
      'vxml' => 'application/voicexml+xml',
      'bcpio' => 'application/x-bcpio',
      'vcd' => 'application/x-cdlink',
      'pgn' => 'application/x-chess-pgn',
      'z' => 'application/x-compress',
      'cpio' => 'application/x-cpio',
      'csh' => 'application/x-csh',
      'spl' => 'application/x-futuresplash',
      'hdf' => 'application/x-hdf',
      'skp' => 'application/x-koan',
      'skd' => 'application/x-koan',
      'skt' => 'application/x-koan',
      'skm' => 'application/x-koan',
      'latex' => 'application/x-latex',
      'nc' => 'application/x-netcdf',
      'cdf' => 'application/x-netcdf',
      'crl' => 'application/x-pkcs7-crl',
      'sh' => 'application/x-sh',
      'shar' => 'application/x-shar',
      'sv4cpio' => 'application/x-sv4cpio',
      'sv4crc' => 'application/x-sv4crc',
      'tcl' => 'application/x-tcl',
      'tex' => 'application/x-tex',
      'texinfo' => 'application/x-texinfo',
      'texi' => 'application/x-texinfo',
      't' => 'application/x-troff',
      'tr' => 'application/x-troff',
      'roff' => 'application/x-troff',
      'man' => 'application/x-troff-man',
      'me' => 'application/x-troff-me',
      'ms' => 'application/x-troff-ms',
      'ustar' => 'application/x-ustar',
      'src' => 'application/x-wais-source',
      'crt' => 'application/x-x509-ca-cert',
      'xslt' => 'application/xslt+xml',
      'pdb' => 'chemical/x-pdb',
      'xyz' => 'chemical/x-xyz',
      'igs' => 'model/iges',
      'iges' => 'model/iges',
      'msh' => 'model/mesh',
      'mesh' => 'model/mesh',
      'silo' => 'model/mesh',
      'wrl' => 'model/vrml',
      'vrml' => 'model/vrml',
      'ice' => 'x-conference/x-cooltalk'
    );
    if (array_key_exists(strtolower($extension), $mimes)) {
      return $mimes[strtolower($extension)];
    }
    return 'application/octet-stream';
  }

  private function getExtencionOfMimeType($mime_type = '') {
    $mimes = array(
      // приложения
      'application/octet-stream' => 'bin',
      //'application/macbinary' => 'bin',
      'application/x-msdownload' => 'exe',
      //'application/x-msdownload' => 'msi',

      // архивы
      'application/zip' => 'zip',
      'application/x-rar-compressed' => 'rar',
      'application/vnd.ms-cab-compressed' => 'cab',
      'application/x-tar' => 'tar',
      //'application/x-tar' => 'tgz',
      'application/x-gzip' => 'gz',
      'application/x-img' => 'img',

      // ms office
      'application/msword' => 'doc',
      'application/rtf' => 'rtf',
      'application/vnd.ms-excel' => 'xls',
      'application/excel' => 'xl',
      'application/vnd.ms-powerpoint' => 'ppt',
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
      'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'xltx',
      'application/vnd.openxmlformats-officedocument.presentationml.template' => 'potx',
      'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'ppsx',
      'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
      'application/vnd.openxmlformats-officedocument.presentationml.slide' => 'sldx',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
      'application/vnd.ms-excel.addin.macroEnabled.12' => 'xlam',
      'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => 'xlsb',

      // open office
      'application/vnd.oasis.opendocument.text' => 'odt',
      'application/vnd.oasis.opendocument.spreadsheet' => 'ods',

      // adobe
      'application/pdf' => 'pdf',
      'image/vnd.adobe.photoshop' => 'psd',
      'application/postscript' => 'ai',

      // текст
      'text/plain' => 'txt',
      'text/html' => 'html',
      'text/css' => 'css',
      'text/x-log' => 'log',
      'text/richtext' => 'rtx',
      'text/rtf' => 'rtf',
      'text/vcard' => 'vcf',
      'text/xml' => 'xml',
      'text/x-registry' => 'reg',
      'text/x-setext' => 'etx',
      'text/x-sql' => 'sql',
      'text/calendar' => 'ics',
      'text/sgml' => 'sgml',
      'text/tab-separated-values' => 'tsv',
      'text/vbscript' => 'vbs',
      'text/vnd.wap.wml' => 'wml',
      'text/vnd.wap.wmlscript' => 'wmls',
      'text/x-config' => 'conf',

      'application/x-httpd-php' => 'php',
      'application/x-httpd-php-source' => 'phps',
      'application/x-shockwave-flash' => 'swf',
      'application/x-stuffit' => 'sit',
      'application/cgi' => 'cgi',
      'application/javascript' => 'js',
      'application/x-javascript' => 'js',
      'application/json' => 'json',
      'application/xml' => 'xml',
      'application/xml-dtd' => 'dtd',
      'application/xhtml+xml' => 'xht',
      //'application/xhtml+xml' => 'xhtml',
      'application/mathml+xml' => 'mathml',
      'application/perl' => 'pl',
      'application/x-perl' => 'perl',
      'application/rdf+xml' => 'rdf',
      'application/ruby' => 'rb',

      'message/rfc822' => 'eml',

      // изображения
      'image/png' => 'png',
      'image/x-png' => 'png',
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/gif' => 'gif',
      'image/bmp' => 'bmp',
      'image/x-icon' => 'ico',
      'image/vnd.microsoft.icon' => 'ico',
      'image/tiff' => 'tif',
      'image/svg+xml' => 'svg',
      'image/cgm' => 'cgm',
      'image/ief' => 'ief',
      'image/vnd.djvu' => 'djvu',
      'image/vnd.wap.wbmp' => 'wbmp',
      'image/x-cmu-raster' => 'ras',
      'image/x-portable-anymap' => 'pnm',
      'image/x-portable-bitmap' => 'pbm',
      'image/x-portable-graymap' => 'pgm',
      'image/x-portable-pixmap' => 'ppm',
      'image/x-rgb' => 'rgb',
      'image/x-xbitmap' => 'xbm',
      'image/x-xpixmap' => 'xpm',
      'image/x-xwindowdump' => 'xwd',

      // аудио
      'audio/basic' => 'au',
      'audio/mp4' => 'm4a',
      'application/ogg' => 'ogg',
      'audio/mid' => 'mid',
      'audio/midi' => 'mid',
      'audio/mpeg' => 'mp3',
      'audio/x-aiff' => 'aif',
      'audio/x-pn-realaudio' => 'ram',
      'application/vnd.rn-realmedia' => 'rm',
      'audio/x-pn-realaudio-plugin' => 'rpm',
      'audio/x-realaudio' => 'ra',
      'audio/wav' => 'wav',
      'audio/x-wav' => 'wav',
      'audio/x-ms-wma' => 'wma',
      'audio/mpegurl' => 'm3u',
      'audio/x-mpegurl' => 'm3u',
      'audio/x-ms-wax' => 'wax',

      // видео
      'video/mpeg' => 'mpg',
      'video/vnd.rn-realvideo' => 'rv',
      'video/avi' => 'avi',
      'video/x-msvideo' => 'avi',
      'video/mp4' => 'mp4',
      'video/x-sgi-movie' => 'movie',
      'video/x-flv' => 'flv',
      'video/quicktime' => 'mov',
      //'video/quicktime' => 'qt',
      'video/vnd.mpegurl' => 'm4u',

      // прочие
      'application/oda' => 'oda',
      'application/smil' => 'smi',
      'application/srgs' => 'gram',
      'application/srgs+xml' => 'grxml',
      'application/vnd.mif' => 'mif',
      'application/vnd.wap.wbxml' => 'wbxml',
      'application/vnd.wap.wmlc' => 'wmlc',
      'application/vnd.wap.wmlscriptc' => 'wmlsc',
      'application/x-director' => 'dir',
      'application/x-dvi' => 'dvi',
      'application/x-gtar' => 'gtar',
      'application/mac-binhex40' => 'hqx',
      'application/mac-compactpro' => 'cpt',
      'application/andrew-inset' => 'ez',
      'application/atom+xml' => 'atom',
      'application/vnd.mozilla.xul+xml' => 'xul',
      'application/voicexml+xml' => 'vxml',
      'application/x-bcpio' => 'bcpio',
      'application/x-cdlink' => 'vcd',
      'application/x-chess-pgn' => 'pgn',
      'application/x-compress' => 'z',
      'application/x-cpio' => 'cpio',
      'application/x-csh' => 'csh',
      'application/x-futuresplash' => 'spl',
      'application/x-hdf' => 'hdf',
      'application/x-koan' => 'skp',
      'application/x-latex' => 'latex',
      'application/x-netcdf' => 'nc',
      //'application/x-netcdf' => 'cdf',
      'application/x-pkcs7-crl' => 'crl',
      'application/x-sh' => 'sh',
      'application/x-shar' => 'shar',
      'application/x-sv4cpio' => 'sv4cpio',
      'application/x-sv4crc' => 'sv4crc',
      'application/x-tcl' => 'tcl',
      'application/x-tex' => 'tex',
      'application/x-texinfo' => 'texi',
      'application/x-troff' => 'tr',
      'application/x-troff-man' => 'man',
      'application/x-troff-me' => 'me',
      'application/x-troff-ms' => 'ms',
      'application/x-ustar' => 'ustar',
      'application/x-wais-source' => 'src',
      'application/x-x509-ca-cert' => 'crt',
      'application/xslt+xml' => 'xslt',
      'chemical/x-pdb' => 'pdb',
      'chemical/x-xyz' => 'xyz',
      'model/iges' => 'igs',
      //'model/iges' => 'iges',
      'model/mesh' => 'msh',
      'model/vrml' => 'wrl',
      'x-conference/x-cooltalk' => 'ice'
    );
    if (array_key_exists(strtolower($mime_type), $mimes)) {
      return $mimes[strtolower($mime_type)];
    }
    return false;
  }



}