<?php
namespace core\libs;

use \Exception;
use core\libs\FileUpload;

// Класс для изменения размера изображений

// параметр options задает готовые пресеты:
// 'width' // ширина задана, высота изменяется пропорционально
// 'height' // высота задана, ширина изменяется пропорционально
// 'auto' // ширина и высота выбираются автоматически в зависимости от исходного изображения
// 'crop' // обрезка лишних участков без изменения размеров
// 'exact' // ширина и высота заданы, изображение искажается без сохранения пропорций
// 'noresize' // ширина и высота не изменяются и равны исходной ширине и высоте - исходное изображение просто копируется без изменений, миниатюра не создаётся

// 'postimage' // ширина задана и не больше 580, высота изменяется пропорционально, создаётся миниатюра с шириной не более 1024 и высотой не более 768
// 'postthumbs' // ширина и высота заданы и изменяются пропорционально автоматически, создается миниатюра размером 150x150
// 'partner' // ширина задана и не больше 250, высота изменяется пропорционально, создается миниатура с шириной 250px

class ImageResize {
	private $src_image; // исходное изображение (ресурс)
    public $source; // полный путь к исходному изображению 
    private $src_dir_name = ''; // путь к исходному файлу
    private $src_file_name = ''; // имя исходного файла (без расширения)
    private $src_file_extension = ''; // расширение исходного файла

	private $type; // тип исходного изображения

	private $src_width; // ширина исходного изображения
	private $src_height; // высота исходного изображения

	private $dst_image; // полученное изображение (ресурс)
    public $destination; // полный путь к полученному изображению
    private $dst_dir_name = ''; // путь для сохранения полученного файлу
    private $dst_file_name = ''; // имя полученного файла (без расширения)
    private $dst_file_extension = ''; // расширение полученного файла

    public $suffix = ''; // суффикс для обозначения имени миниатюры thumbs
    public $option = 'auto'; // режим обработки изображения

    public $width; // заданная ширина полученного изображения
    public $height; // заданная высота полученного изображения

    public $dst_width; // вычисленная ширина полученного изображения
    public $dst_height; // вычисленная высота полученного изображения

    public $quality = 65; // качество сохраняемого изображения
    public $copyrite = ''; // вставлять копирайт - created_by_rolar
    public $logo_png = ''; // вставлять логотип - png-картинку - created_by_rolar.png
    public $change_type = false; // разрешено/запрещено изменять тип полученного изображения
    public $remove_source = true; // удалять исходное изображение
    public $fon=0xFFFFFF; // цвет фона полученного изображения

	//////////config////////////////////
	const LIMIT_WIDTH = 1024; // лимит ширины
	const LIMIT_HEIGHT = 768; // лимит высоты
	const DEFAULT_TYPE = 'jpg'; // тип файла (расширение) по умолчанию
	const DEFAULT_DESTINATION_DIR = 'images'; // путь для сохранения полученного изображения по умолчанию
    const DEFAULT_SUFFIX = '_th'; // суффикс для обозначения имени миниатюры thumbs
	//////////config////////////////////

	public function __construct() {
       $this->source = ''; // полный путь к исходному изображению
       $this->destination = self::DEFAULT_DESTINATION_DIR; // полный путь к полученному изображению

	   $this->suffix = ''; // суффикс для обозначения имени миниатюры thumbs
	   $this->option = 'auto'; // режим обработки изображения

       $this->width = self::LIMIT_WIDTH; // заданная ширина полученного изображения
       $this->height = self::LIMIT_HEIGHT; // заданная высота полученного изображения
       
       $this->dst_width; // вычисленная ширина полученного изображения
       $this->dst_height; // вычисленная высота полученного изображения

       $this->quality = 65; // качество сохраняемого изображения
       $this->copyrite = ''; // вставлять копирайт - created_by_rolar
       $this->logo_png = ''; // вставлять логотип - png-картинку - created_by_rolar.png
       $this->change_type = false; // разрешено/запрещено изменять тип полученного изображения
       $this->remove_source = true; // удалять исходное изображение
       $this->fon=0xFFFFFF; // цвет фона полученного изображения
	}

    // определение типа изображения
	private function getImageType($source) {
	    if (!isset($source)) {
          throw new Exception('Файл ' . $source . ' не найден');
	    }
       
	    $type = false;
	    // если функция exif_imagetype определена
        if(function_exists('exif_imagetype')) {
            // то определяем тип изображения по его Exif данным
            $type_number = exif_imagetype($source);
    		switch($type_number) {
    			case IMAGETYPE_GIF:
    				$type = 'gif';
    			break;
    			case IMAGETYPE_JPEG:
    				$type = 'jpg';
    			break;	
    			case IMAGETYPE_PNG:
    				$type = 'png';
    			break;
    			case IMAGETYPE_BMP:
    				$type = 'bmp';
    			break;
    			case IMAGETYPE_WBMP:
    				$type = 'wbmp';
    			break;
    		}
        }
        /*else {
            throw new Exception("Не подключено расширение exif");
        }*/

        // если тип изображения не определился и расширение finfo загружено - extension_loaded, или если класс finfo объявлен - class_exists
        if(($type == false) and (class_exists('finfo'))) {
            // то определяем тип изображения через функцию finfo, которая выдаёт MIME-тип файла
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($source);
     		switch($mime_type) {
    			case 'image/gif':
    				$type = 'gif';
    			break;
    			case 'image/jpeg':
    				$type = 'jpg';
    			break;
    			case 'image/pjpeg':
    				$type = 'jpg';
    			break;
    			case 'image/png':
    				$type = 'png';
    			break;
    			case 'image/x-png':
    				$type = 'png';
    			break;
    			case 'image/bmp':
    				$type = 'bmp';
    			break;
    			case 'image/vnd.wap.wbmp':
    				$type = 'wbmp';
    			break;
    		}
		}
        /*else {
            throw new Exception("Не подключено расширение finfo");
        }*/

        // если тип изображения не определился
        if($type == false) {
            // определяем тип изображения по расширению файла
            $type = getExtension($source);
        }
        if ($type == 'bmp' or $type == 'wbmp') {
            $this->change_type = true;
        }
        return $type;
	}

	// метод для получения размеров
	private function getSizes($width = self::LIMIT_WIDTH, $height = self::LIMIT_HEIGHT, $option = 'auto') {
        //echo 'Ширина и высота исходного изображения1: '.$width.'x'.$height.'<br>';
	    if ($width > self::LIMIT_WIDTH) {// если ширина нового изображения больше лимита ширины
            if ($width > $this->src_width or $width <= 0) {// если ширина нового изображения больше ширины исходного изображения
                $width = $this->src_width; // то ширина нового изображения равна ширине исходного изображения
            }
            else {
                $width = self::LIMIT_WIDTH; // иначе ширина нового изображения равна лимиту ширины
            }
        }
        else {
            if ($width > $this->src_width or $width <= 0) {// если ширина нового изображения больше ширины исходного изображения
                $width = $this->src_width; // то ширина нового изображения равна ширине исходного изображения
            }
        }

        if ($height > self::LIMIT_HEIGHT) { // если высота нового изображения больше лимита высоты
            if ($height > $this->src_height or $height <= 0) {// если высота нового изображения больше высоты исходного изображения
                $height = $this->src_height; // то ширина нового изображения равна высоте исходного изображения
            }
            else {
                $height = self::LIMIT_HEIGHT; // иначе высота нового изображения равна лимиту высоты
            }
        }
        else {
            if ($height > $this->src_height or $height <= 0) {// если высота нового изображения больше высоты исходного изображения
                $height = $this->src_height; // то высота нового изображения равна высоте исходного изображения
            }
        }
        //echo 'Ширина и высота исходного изображения2: '.$width.'x'.$height.'<br>';
	    switch($option) {
			case 'width': // ширина задана, высота изменяется пропорционально
				$new_width = $width;
				$new_height = $this->getHeight($width);
			break;
			case 'height': // высота задана, ширина изменяется пропорционально
				$new_width = $this->getWidth($height);
				$new_height = $height;
			break;
			case 'auto': // ширина и высота выбираются автоматически в зависимости от исходного изображения
				$auto_sizes = $this->getAuto($width,$height);
				$new_width = $auto_sizes['width'];
				$new_height = $auto_sizes['height'];
			break;
			case 'crop': // обрезка лишних участков без изменения размеров
				$crop_sizes = $this->getCrop($width,$height);
				$new_width = $crop_sizes['width'];
				$new_height = $crop_sizes['height'];
			break;
			case 'exact': // ширина и высота заданы, изображение искажается без сохранения пропорций
				$new_width = $width;
				$new_height = $height;
			break;
			case 'noresize': // ширина и высота не изменяются и равны исходной ширине и высоте
				$new_width = $this->src_width;
				$new_height = $this->src_height;
			break;
			case 'postimage': // ширина задана и не больше 580, высота изменяется пропорционально
                if ($width > 580) {
                    $width = 580;
                }
                $new_width = $width;
                $new_height = $this->getHeight($width);
			break;
			case 'postthumbs': // ширина и высота заданы и изменяются пропорционально автоматически
				$auto_sizes = $this->getAuto(150,150);
				$new_width = $auto_sizes['width'];
				$new_height = $auto_sizes['height'];
			break;
			case 'partner': // ширина задана и не больше 250, высота изменяется пропорционально
                if ($width > 250) {
                    $width = 250;
                }
                $new_width = $width;
                $new_height = $this->getHeight($width);
			break;
		}
        //echo 'Ширина и высота исходного изображения3: '.$new_width.'x'.$new_height.'<br>';
		return array('width' => $new_width,'height' => $new_height);
	}

    // метод для вычисления высоты
	private function getHeight($width) {
		$k = $this->src_height / $this->src_width; // коэффициент изменения ширины
		return round($width * $k,0);
	}
	// метод для вычисления ширины
	private function getWidth($height) {
		$k = $this->src_width / $this->src_height; // коэффициент изменения высоты
		return round($height * $k,0);
	}

	// метод для автоматического определения оптимальных размеров 
	private function getAuto($width,$height) {
		if($this->src_width > $this->src_height) { // изображение альбомное
			$new_width = $width;
			$new_height = $this->getHeight($width);
		}
		elseif($this->src_width < $this->src_height) { // изображение портретное
			$new_width = $this->getWidth($height);
			$new_height = $height;
		}
		else { // изображение квадратное
			$new_width = $width;
			$new_height = $height;
		}
		return array('width' => $new_width, 'height' => $new_height);
	}

    // метод изменения размеров путем обрезки изображения
	private function getCrop($width,$height) {
		$kw = $this->src_width / $width; // коэффициент изменения ширины
        $kh = $this->src_height / $height; // коэффициент изменения высоты
		if($kh < $kw) { // если коэффициент изменения высоты меньше коэффициента изменения ширины
			$k = $kh; // тогда изменяем пропорционально высоте
		}
		else {
			$k = $kw; // иначе изменяем пропорционально ширине
		}
		return array('width' => round($this->src_width/$k,0), 'height' => round($this->src_height/$k,0));
	}

    // метод для получения данных исходного изображения
    private function getSource($source = null) {
        // если файла с путем $source не существует, то выдаем false
		if(!$source) {return false;}

        $source_array = pathinfo($source);
        //pr($source_array);

        $this->src_dir_name = $source_array['dirname']; // получаем путь к исходному файлу
        $this->src_file_name = $source_array['filename']; // получаем имя исходного файла (без расширения)
        $this->src_file_extension = $source_array['extension']; // получаем расширение исходного файла
        // pr($this->src_dir_name);
        // pr($this->src_file_name);
        // pr($this->src_file_extension);
        return true;
    }

    // метод для получения данных полученного изображения
    private function getDestination($destination = '') {
        $destination_array = pathinfo($destination);
        //pr($destination_array);

        // получаем путь для сохранения полученного файла
        // если путь к полученному файлу пустой (не задан), то берем путь по умолчанию
        if(empty($destination_array['dirname']) or ($destination_array['dirname'] == '.') or ($destination_array['dirname'] == '\\')) {
            $this->dst_dir_name = self::DEFAULT_DESTINATION_DIR;
        }
        else {
            $this->dst_dir_name = validate_path($destination_array['dirname']); // иначе берём указанный путь
        }
        //pr($this->dst_dir_name);
        if(!file_exists($this->dst_dir_name)) { // Проверяем на существование папку $this->dst_dir_name
            if (!mkdir($this->dst_dir_name, 0777, true)) { // Для создания вложенной структуры необходимо указать параметр $recursive в mkdir()
                throw new Exception('Ошибка: не удалось создать директорию '.$this->dst_dir_name);
            }
        }

        // получаем имя полученного файла (без расширения)
        // если имя полученного файла пустое (не задано) или полное имя файла начинается с точки, то проверяем имя исходного файла
        if(empty($destination_array['filename']) or (substr($destination_array['basename'],0,1) == '.')) {
            // если имя исходного файла пустое, то
            if (empty($this->src_file_name)) {
                // генерируем имя полученного файла самостоятельно
                $this->dst_file_name = substr(md5(microtime()),0,11); // получаем имя полученного файла
            }
            else {
                // иначе, имя полученного файла равно имени исходного файла
                $this->dst_file_name = $this->src_file_name;
            }
        }
        else {
            $this->dst_file_name = validate_file_name($destination_array['filename']); // иначе берём указанное имя файла
        }
        //pr($this->dst_file_name);

        // получаем тип полученного изображения
        // если не разрешено изменять тип файла, то определяем расширение по типу исходного изображения
        if($this->change_type == false) {
            // если тип исходного изображения определён, то получаем расширение полученного файла
            if ($this->type) {
                $this->dst_file_extension = $this->type; // расширение полученного файла равно типу исходного файла
            }
            else {
                //$this->dst_file_extension = getExtension($this->source); // иначе расширение определяем из расширения исходного файла
                $this->dst_file_extension = $this->src_file_extension; // иначе расширение равно расширению исходного файла
            }
        }
        else { // иначе определяем расширение из указанного расширения
            // если расширение полученного файла пустое (не задано) или полное имя файла начинается с точки, то берём тип (расширение) по умолчанию
            if((empty($destination_array['extension'])) or (substr($destination_array['basename'],0,1) == '.')) {
                $this->dst_file_extension = self::DEFAULT_TYPE; // выбираем расширение файла по умолчанию = jpg
            }
            else {
                $this->dst_file_extension = $destination_array['extension']; // иначе берём указанное расширение
            }
            // если расширение полученного файла совпадает с исходным типом файла, то $this->change_type == false
            if ($this->dst_file_extension == $this->type) {
                $this->change_type = false;
            }
            // если тип файла = bmp, то созраняем файл в формат jpg
            if($this->type == 'bmp' or $this->type == 'wbmp') {
                $this->dst_file_extension = 'jpg';
                $this->change_type = true;
            }
        }
        //pr($this->dst_file_extension);
        return true;
    }

    // Метод для изменения размера и сохранения полученного изображения
    // $source - полный путь и имя исходного изображения
    // $destination - полный путь (и имя) полученного изображения
    // $option - алгаритм преобразования (пресет)
    // $width - заданная ширина полученного изображения
    // $height - заданная высота полученного изображения

    // $quality - качество (степень сжатия) полученного изображения
    // $copyrite - текст копирайтов
    // $logo_png - логитип - png-картинка 
    // $fon=0xFFFFFF - цвет фона
    // change_type - разрешить изменение типа полученного изображения = false
    // $remove_source - удалять исходное изображение = true

    // параметр options задает готовые пресеты:
    // 'width' // ширина задана, высота изменяется пропорционально, ширина не больше заданной, но не более 1024 по ширине и 768 по высоте (даже если задать ширину или высоту большего размера), миниатура не создается
    // 'height' // высота задана, ширина изменяется пропорционально, высота не больше заданной, но не более 1024 по ширине и 768 по высоте (даже если задать ширину или высоту большего размера), миниатура не создается
    // 'auto' // ширина и высота выбираются автоматически в зависимости от исходного изображения, но не более 1024 по ширине и 768 по высоте, миниатура не создается
    // 'crop' // обрезка лишних участков без изменения размеров
    // 'exact' // ширина и высота заданы, изображение искажается без сохранения пропорций
    // 'noresize' // ширина и высота не изменяются и равны исходной ширине и высоте - исходное изображение просто копируется без изменений, миниатюра не создаётся

    // 'postimage' // ширина задана и не больше 580, высота изменяется пропорционально, создаётся миниатюра с шириной не более 1024 и высотой не более 768
    // 'postthumbs' // ширина и высота заданы и изменяются пропорционально автоматически, создается миниатюра размером 150x150
    // 'partner' // ширина задана и не больше 250, высота изменяется пропорционально, создается миниатура с шириной 250px

	public function resize($source = null, $destination = '', $option = 'auto', $width = self::LIMIT_WIDTH, $height = self::LIMIT_HEIGHT, $quality = 100, $copyrite = '', $logo_png = '', $change_type = false, $remove_source = true, $fon=0xFFFFFF) {
	    $this->source = (string)$source; // исходный файл
        // если файла с путем $source не существует, то генерируем исключение
		if(!file_exists($this->source)) {
			  throw new Exception('Файл '.$this->source.' не найден');
		}

        $this->destination = iconv('UTF-8','cp1251',(string)$destination); // путь и имя полученного файла
        //echo '$this->destination='.$this->destination.'<br>';

        // массив возможных опций
        $options_array = array('width','height','auto','crop','exact','noresize','postimage','postthumbs','partner');
        $this->option = in_array((string)$option, $options_array) ? (string)$option : $this->option;
        //echo '$this->option='.$this->option.'<br>';

        // заданные значения ширины и высоты полученного изображения
        $this->width = (int)$width;
        $this->height = (int)$height;
        //echo 'Заданные ширина и высота нового изображения: '.$this->width.'x'.$this->height.'<br>';

        $this->quality = isset($quality) ? (int)$quality : $this->quality; // качество (степень сжатия) полученного изображения
        // если качество меньше 1 или больше 100, тогда ставим его 100
        if ($this->quality < 1 or $this->quality > 100) {
            $this->quality = 100;
        }
        //echo '$this->quality = '.$this->quality;

        $this->copyrite = isset($copyrite) ? (string)$copyrite : $this->copyrite; // копирайты
        $this->logo_png = isset($logo_png) ? (string)$logo_png : $this->logo_png; // логотип

        $this->change_type = isset($change_type) ? (bool)$change_type : $this->change_type; // разрешить изменение типа полученного изображения
        //echo '$change_type1='.$this->change_type.'<br>';

        $this->remove_source = isset($remove_source) ? (bool)$remove_source : $this->remove_source; // удалять исходный файл

        $this->fon = isset($fon) ? $fon : $this->fon; // определяем цвет фона полученного изображения

        // получение данных исходного изображения 
        $this->getSource($this->source);

		$this->type = $this->getImageType($this->source); // определение типа исходного изображения
        //echo '$type='.$this->type.'<br>';
        //echo '$change_type2='.$this->change_type.'<br>';

        $this->suffix = '';

        // переопределение суффикса и $change_type для изображения и миниатюры поста
        if ($this->option == 'postimage' or $this->option == 'postthumbs' or $this->option == 'partner') {
            $this->suffix = self::DEFAULT_SUFFIX;
            if ($this->type != 'bmp' and $this->type != 'wbmp') {
                $this->change_type = false;
            }
        }
        //echo '$change_type3='.$this->change_type.'<br>';

        $this->getDestination($this->destination);
        //echo '$change_type4='.$this->change_type.'<br>';

        // полный путь (БЕЗ суффикса) назначения равен пути к файлу + имя файла + расширение
        $image_destination = $this->dst_dir_name.S.$this->dst_file_name.'.'.$this->dst_file_extension;
        //pr($image_destination);

        // новый полный путь назначения равен пути к файлу + имя файла и суффикс + расширение
        $thumb_destination = $this->dst_dir_name.S.$this->dst_file_name.$this->suffix.'.'.$this->dst_file_extension;
        //pr($thumb_destination);

        // создание дескриптора исходного изображения
		switch($this->type) {
			case 'jpg':
				$this->src_image = @imagecreatefromjpeg($this->source);
			break;	
			case 'gif':
				$this->src_image = @imagecreatefromgif($this->source);
			break;
			case 'png':
				$this->src_image = @imagecreatefrompng($this->source);
			break;
			case 'bmp':
				$this->src_image = $this->imagecreatefrombmp($this->source);
			break;
			case 'wbmp':
				$this->src_image = @imagecreatefromwbmp($this->source);
			break;
			default:
				$this->src_image = false;
		}
		if(!$this->src_image) {
    	throw new Exception('Не удалось создать дескриптор изображения');
		}

		// определение ширины и высоты исходного изображения
		$this->src_width = imagesx($this->src_image);
		$this->src_height = imagesy($this->src_image);
		//echo 'Ширина и высота исходного изображения: '.$this->src_width.'x'.$this->src_height.'<br>';

        $renamed = false; // false - исходный файл не перемещён, true - перемещён
        
        // если тип полученного файла не меняется, и если копирайты и логотип не указаны, и если опция равна noresize или postimage или postthumbs или partner
        if (($this->change_type == false) and (empty($this->copyrite)) and (!file_exists($this->logo_png)) and (($this->option == 'noresize') or ($this->option == 'postimage') or ($this->option == 'postthumbs') or ($this->option == 'partner'))) {
            // если ширина и высота исходного изображения меньше или равны лимитам ширины и высоты или если опция равна noresize, 
            if ((($this->src_width <= self::LIMIT_WIDTH) and ($this->src_height <= self::LIMIT_HEIGHT)) or ($this->option == 'noresize')) {
                // то перемещаем исходный файл в место назначения без изменений
                $renamed = rename($this->source,$image_destination);
            }
            if ($this->option == 'noresize') { // если опция = noresize, то
                return array('image' => $image_destination); // завершаем обработку изображения и возвращаем полное имя полученного файла
            }
        }
        //echo '$renamed = '.$renamed;

		$sizes = $this->getSizes($this->width, $this->height, $this->option); // вычисление размеров для нового изображения
        //pr($sizes);

        // вычисленные значения ширины и высоты полученного изображения
        $this->dst_width = $sizes['width'];
        $this->dst_height = $sizes['height'];

        // если ширина и высота исходного и полученного изображения совпадают,
        // и если ширина и высота исходного изображения меньше или равны лимитам ширины и высоты,
        // и если копирайты и логотип не указаны, и если тип полученного файла не меняется, то
        if (($this->dst_width == $this->src_width) and ($this->dst_height == $this->src_height)
        and ($this->src_width <= self::LIMIT_WIDTH) and ($this->src_height <= self::LIMIT_HEIGHT)
        and (empty($this->copyrite)) and (!file_exists($this->logo_png)) and ($this->change_type == false)) {
            if ($renamed == false) { // если исходный файл не перемещён
                // то, перемещаем исходный файл в место назначения без изменений
                $renamed = rename($this->source,$image_destination);
            }
            // если опция не равна postimage или postthumbs или partner
            if (($this->option != 'postimage') or ($this->option != 'postthumbs') or ($this->option != 'partner')) {
                return array('image' => $image_destination); // и завершаем обработку изображения и возвращаем полное имя полученного файла
            }
        }

        // создание подложки для нового изображения
		$this->dst_image = imagecreatetruecolor($this->dst_width,$this->dst_height);

        // получение цвета фона для заливки
        $this->fon = $this->getFonColor($this->dst_image, $this->fon);
        imagefill($this->dst_image, 0, 0, $this->fon); // заливка фоновым цветом (по умолчанию белый) или прозрачными пикселами, начиная с заданных координат - верхний левый угол 0,0

		// копирование исходного изображения на подложку с интерполяцией
		imagecopyresampled($this->dst_image,$this->src_image,0,0,0,0,$this->dst_width,$this->dst_height,$this->src_width,$this->src_height);

        // если нужно вставлять копирайты
        if ((!empty($this->copyrite)) and ($this->option != 'postimage') and ($this->option != 'postthumbs') and ($this->option != 'partner')) {
            $darkness = 80;
            $dark = imagecolorallocatealpha($this->dst_image, 0, 0, 0, $darkness); // imagecolorallocatealpha - создание тёмного полупрозрачного фона для изображения
            $white = imagecolorallocate($this->dst_image, 255, 255, 255); // создание белого цвета для текста
            $size_copy = mb_strlen($copyrite,'UTF-8'); // вычисляем длину текста
            //echo '$size_copy='.$size_copy;
            imagefilledrectangle($this->dst_image, $this->dst_width - 120, $this->dst_height - 15, $this->dst_width, $this->dst_height, $dark); // imagefilledrectangle - рисование закрашенного прямоугольника
            imagestring($this->dst_image, 3, $this->dst_width - 115, $this->dst_height - 15, (string)$copyrite, $white); // imagestring - рисование строки текста горизонтально
        }

        // если нужно вставлять логотип
        if ((file_exists($this->logo_png)) and ($this->option != 'postimage') and ($this->option != 'postthumbs') and ($this->option != 'partner')) {
            //echo '$this->logo_png='.$this->logo_png;
            $logoImage = imagecreatefrompng($this->logo_png); // создает новое изображение из файла или URL
            $logoWidth = imagesx($logoImage); // получение ширины логотипа
            $logoHeight = imagesy($logoImage); // получение высоты логотипа
            imagealphablending($logoImage, false); // imagealphablending - задание режима сопряжения цветов для изображения
            imagesavealpha($logoImage, true); // imagesavealpha - установка флага сохранения всей информации альфа компонента (в противовес одноцветной прозрачности) и сохранение PNG изображения
            imagecopymerge($this->dst_image, $logoImage, $this->dst_width - $logoWidth, $this->dst_height - $logoHeight, 0, 0, $logoWidth, $logoHeight,65);
            // imagecopy — копирование части изображения, копирует часть src_im в dst_im, начиная с координат x, y src_x, src_y с шириной src_w и высотой src_h. Скопированная часть помещается на координаты dst_x и dst_y
        }

		// 2ой шаг обработки для режима с обрезкой
		if ($this->option == 'crop') {
			$w = $this->dst_width;
			$h = $this->dst_height;
			$sx = round($w/2 - $this->width/2); // смещение по горизонтали
			$sy = round($h/2 - $this->height/2); // смещение по вертикали
			$img = imagecreatetruecolor($this->width,$this->height); // создание новой подложки
            $cropfon = $this->getFonColor($img, $this->fon); // определение цвета фона
            imagefill($img, 0, 0, $cropfon); // заливка фоновым цветом
            // копирование предварительно уменьшенного изображения на обрезанную подложку
			imagecopyresampled($img,$this->dst_image,0,0,$sx,$sy,$this->width,$this->height,$this->width,$this->height);
			$this->dst_image = $img; // перезаписываем дескриптор изображения
		}
        // 2ой шаг обработки для режима миниатюр для постов
		if ($this->option == 'postthumbs') {
			$w = $this->dst_width;
			$h = $this->dst_height;
			$sx = round(75 - $w/2); // смещение по горизонтали
			$sy = round(75 - $h/2); // смещение по вертикали
            //echo 'смещение по горизонтали - '.$sx.'<br>смещение по вертикали - '.$sy;
			$img = imagecreatetruecolor(150,150); // создание новой подложки
            $thumbsfon = $this->getFonColor($img, $this->fon); // определение цвета фона
            imagefill($img, 0, 0, $thumbsfon); // заливка фоновым цветом
            // копирование предварительно уменьшенного изображения на обрезанную подложку
			imagecopyresampled($img,$this->dst_image,$sx,$sy,0,0,$w,$h,$w,$h);
			$this->dst_image = $img; // перезаписываем дескриптор изображения
		}

        // если опция равна postimage или postthumbs или partner и если файл не перемещён, то генерируем ещё одно изображение
        if ((($this->option == 'postimage') or ($this->option == 'postthumbs') or ($this->option == 'partner')) and ($renamed == false)) {
            // определяем размеры нового изображения
            $sizes2 = $this->getSizes($this->src_width, $this->src_height, 'auto');
            // создание подложки для нового изображения
		    $dst2_image = imagecreatetruecolor($sizes2['width'],$sizes2['height']);
		    // копирование исходного изображения на подложку с интерполяцией
            imagecopyresampled($dst2_image,$this->src_image,0,0,0,0,$sizes2['width'],$sizes2['height'],$this->src_width,$this->src_height);
            $this->saveImage($dst2_image, $image_destination); // сохранение полученного изображения
            imagedestroy($dst2_image); // удаление нового изображения из памяти
        }

        if (($this->option == 'postimage') or ($this->option == 'postthumbs') or ($this->option == 'partner')) {
            $this->saveImage($this->dst_image, $thumb_destination); // сохранение миниатюры изображения
        }
        else {
            $this->saveImage($this->dst_image, $image_destination); // сохранение полученного изображения
        }

		imagedestroy($this->dst_image); // удаление нового изображения миниатюры из памяти
		imagedestroy($this->src_image); // удаление исходного изображения из памяти
        
        // если нужно удалять исходный файл и он не был перемещён, то
        if (($this->remove_source == true) and ($renamed == false)) {
            @unlink($this->source); // удаляем исходный файл
        }
        if (($this->option == 'postimage') or ($this->option == 'postthumbs') or ($this->option == 'partner')) {
            return array('image' => $image_destination,'thumb' => $thumb_destination);
        }
        return array('image' => $image_destination);
	}

    // метод для получения фонового цвета для заливки
    protected function getFonColor($image,$fon){
        if (!isset($image)) {
          throw new Exception('Не передан дескриптор изображения');
        }
        
        // если исходное изображение в формате png
        if ($this->type == 'png'){
            imagealphablending($image, false); // imagealphablending - задание режима сопряжения цветов для изображения
            imagesavealpha($image, true); // сохранение альфа канала
            $foncolor = imagecolorallocatealpha($image,0,0,0,127); // добавляем прозрачность
        }
        elseif (isset($fon)) {
            $foncolor = $fon; // если цвет фона задан, то используем его
        }
        else {
            $foncolor = imagecolorallocate($image, 255, 255, 255); // заливка белым цветом
        }
        return $foncolor;
    }


    // метод для сохранения полученного изображения
    protected function saveImage($image, $destination = '') {
        if (!isset($image)) {
            throw new Exception('Не передан дескриптор изображения');
        }
        
        //$type = isset($type) ? (string)$type : $this->dst_file_extension;
        $destination = (string)$destination;

  		switch($this->dst_file_extension) {
    		case 'jpg':
    			imagejpeg($image,$destination,$this->quality); // сохранение в формат jpg
    		break;
    		/*case 'bmp':
    			imagejpeg($image,$destination,$this->quality); // сохранение полученного изображения в формат jpg
    		break;
    		case 'wbmp':
    			imagejpeg($image,$destination,$this->quality); // сохранение полученного изображения в формат jpg
    		break; */
    		case 'png':
    			$this->quality = round(($this->quality*9)/100,0);
    			$this->quality = 9 - $this->quality;
    			//echo $quality;
    			imagepng($image,$destination,$this->quality,PNG_NO_FILTER); // сохранение в формат png
    		break;
    		case 'gif':
    			imagegif($image,$destination); // сохранение в формат gif
    		break;
    	}
        return true;
    }


    // функция для получения изображения из bmp-файла
    protected function imagecreatefrombmp($file) {
        //global $CurrentBit, $echoMode;
        $f = fopen($file, 'r'); // fopen - открывает файл или URL только для чтения 'r'
        $Header = fread($f, 2); // fread - бинарно-безопасное чтение файла
        if ($Header == 'BM') {
            $Size = $this->freaddword($f);
            $Reserved1 = $this->freadword($f);
            $Reserved2 = $this->freadword($f);
            $FirstByteOfImage = $this->freaddword($f);

            $SizeBITMAPINFOHEADER = $this->freaddword($f);
            $Width = $this->freaddword($f);
            $Height = $this->freaddword($f);
            $biPlanes = $this->freadword($f);
            $biBitCount = $this->freadword($f);
            $RLECompression = $this->freaddword($f);
            $WidthxHeight = $this->freaddword($f);
            $biXPelsPerMeter = $this->freaddword($f);
            $biYPelsPerMeter = $this->freaddword($f);
            $NumberOfPalettesUsed = $this->freaddword($f);
            $NumberOfImportantColors = $this->freaddword($f);

            if ($biBitCount < 24) {
                $img = imagecreate($Width, $Height); // imagecreate - создание нового палитрового изображения
                $Colors = pow(2, $biBitCount); // возведение в степень 2 - основание, $biBitCount - показатель
                for ($p = 0; $p < $Colors; $p++) {
                    $B = $this->freadbyte($f);
                    $G = $this->freadbyte($f);
                    $R = $this->freadbyte($f);
                    $Reserved = $this->freadbyte($f);
                    $Palette[] = imagecolorallocate($img, $R, $G, $B); // imagecolorallocate - создание цвета для изображения, возвращает идентификатор цвета в соответствии с заданными RGB компонентами
                }
                if ($RLECompression == 0) {
                    $Zbytek = (4 - ceil(($Width / (8 / $biBitCount))) % 4) % 4; // ceil - округляет дробь в большую сторону
                    for ($y = $Height - 1; $y >= 0; $y--) {
                        $this->CurrentBit = 0;
                        for ($x = 0; $x < $Width; $x++) {
                            $C = $this->freadbits($f, $biBitCount);
                            imagesetpixel($img, $x, $y, $Palette[$C]); // imagesetpixel - рисование точки
                        }
                        if ($this->CurrentBit != 0) {
                            $this->freadbyte($f);
                        }
                        for ($g = 0; $g < $Zbytek; $g++) {
                            $this->freadbyte($f);
                        }
                    }
                }
            }
            if ($RLECompression == 1) {
                $y = $Height;
                $pocetb = 0;
                while (true) {
                    $y--;
                    $prefix = $this->freadbyte($f);
                    $suffix = $this->freadbyte($f);
                    $pocetb += 2;
                    $echoit = false;
                    if ($echoit) {
                        echo 'Prefix: '.$prefix.' Suffix: '.$suffix.'<br>';
                    }
                    if (($prefix == 0) and ($suffix == 1)) {break;}
                    if (feof($f)) {break;}
                    while (!(($prefix == 0) and ($suffix == 0))) {
                        if ($prefix == 0) {
                            $pocet = $suffix;
                            $Data .= fread($f, $pocet); // fread - бинарно-безопасное чтение файла
                            $pocetb += $pocet;
                            if ($pocetb % 2 == 1) {
                                $this->freadbyte($f);
                                $pocetb++;
                            }
                        }
                        if ($prefix > 0) {
                            $pocet = $prefix;
                            for ($r = 0; $r < $pocet; $r++) {
                                $Data .= chr($suffix);
                            }
                        }
                        $prefix = $this->freadbyte($f);
                        $suffix = $this->freadbyte($f);
                        $pocetb += 2;
                        if ($echoit) {
                            echo 'Prefix: '.$prefix.' Suffix: '.$suffix.'<br>';
                        }
                    }
                    for ($x = 0; $x < strlen($Data); $x++) {
                        imagesetpixel($img, $x, $y, $Palette[ord($Data[$x])]); // imagesetpixel - рисование точки
                    }
                    $Data = '';
                }
            }
            if ($RLECompression == 2) {
                $y = $Height;
                $pocetb = 0;
                while (true) {
                    $y--;
                    $prefix = $this->freadbyte($f);
                    $suffix = $this->freadbyte($f);
                    $pocetb += 2;
                    $echoit = false;
                    if ($echoit) {
                        echo 'Prefix: '.$prefix.' Suffix: '.$suffix.'<br>';
                    }
                    if (($prefix == 0) and ($suffix == 1)) {break;}
                    if (feof($f)) {break;}
                    while (!(($prefix == 0) and ($suffix == 0))) {
                        if ($prefix == 0) {
                            $pocet = $suffix;
                            $this->CurrentBit = 0;
                            for ($h = 0; $h < $pocet; $h++) {
                                $Data .= chr($this->freadbits($f, 4));
                            }
                            if ($this->CurrentBit != 0) {
                                $this->freadbits($f, 4);
                            }
                            $pocetb += ceil(($pocet / 2)); // ceil - округляет дробь в большую сторону
                            if ($pocetb % 2 == 1) {
                                $this->freadbyte($f);
                                $pocetb++;
                            }
                        }
                        if ($prefix > 0) {
                            $pocet = $prefix;
                            $i = 0;
                            for ($r = 0; $r < $pocet; $r++) {
                                if ($i % 2 == 0) {
                                    $Data .= chr($suffix % 16);
                                }
                                else {
                                    $Data .= chr(floor($suffix / 16));
                                }
                                $i++;
                            }
                        }
                        $prefix = $this->freadbyte($f);
                        $suffix = $this->freadbyte($f);
                        $pocetb+=2;
                        if ($echoit) {
                            echo 'Prefix: '.$prefix.' Suffix: '.$suffix.'<br>';
                        }
                    }
                    for ($x = 0; $x < strlen($Data); $x++) {
                        imagesetpixel($img, $x, $y, $Palette[ord($Data[$x])]); // imagesetpixel - рисование точки
                    }
                    $Data = '';
                }
            }
            if ($biBitCount == 24) {
                $img = imagecreatetruecolor($Width, $Height);
                $Zbytek = $Width % 4;
                for ($y = $Height - 1; $y >= 0; $y--) {
                    for ($x = 0; $x < $Width; $x++) {
                        $B = $this->freadbyte($f);
                        $G = $this->freadbyte($f);
                        $R = $this->freadbyte($f);
                        $color = imagecolorexact($img, $R, $G, $B); // imagecolorexact - получение индекса заданного цвета
                        if ($color == -1) {
                            $color = imagecolorallocate($img, $R, $G, $B); // imagecolorallocate - создание цвета для изображения
                        }
                        imagesetpixel($img, $x, $y, $color); // imagesetpixel - рисование точки
                    }
                    for ($z = 0; $z < $Zbytek; $z++) {
                        $this->freadbyte($f);
                    }
                }
            }
            return $img;
        }
        fclose($f);
    }

    protected function freadbyte($f) {
        return ord(fread($f, 1));
    }
    protected function freadword($f) {
        $b1 = $this->freadbyte($f);
        $b2 = $this->freadbyte($f);
        return $b2 * 256 + $b1;
    }
    protected function freadlngint($f) {
        return $this->freaddword($f);
    }
    protected function freaddword($f) {
        $b1 = $this->freadword($f);
        $b2 = $this->freadword($f);
        return $b2 * 65536 + $b1;
    }
    protected function RetBits($byte, $start, $len) {
        $bin = $this->decbin8($byte);
        $r = bindec(substr($bin, $start, $len));
        return $r;
    }
    protected function freadbits($f, $count) {
        //global $CurrentBit, $SMode;
        $Byte = $this->freadbyte($f);
        $LastCBit = $this->CurrentBit;
        $this->CurrentBit+=$count;
        if ($this->CurrentBit == 8) {
            $this->CurrentBit = 0;
        }
        else {
            fseek($f, ftell($f) - 1);
        }
        return $this->RetBits($Byte, $LastCBit, $count);
    }
    protected function RGBToHex($Red, $Green, $Blue) {
        $hRed = dechex($Red);
        if (strlen($hRed) == 1) {
            $hRed = '0'.$hRed;
        }
        $hGreen = dechex($Green);
        if (strlen($hGreen) == 1) {
            $hGreen = '0'.$hGreen;
        }
        $hBlue = dechex($Blue);
        if (strlen($hBlue) == 1) {
            $hBlue = '0'.$hBlue;
        }
        return($hRed.$hGreen.$hBlue);
    }
    protected function int_to_dword($n) {
        return chr($n & 255).chr(($n >> 8) & 255).chr(($n >> 16) & 255).chr(($n >> 24) & 255);
    }
    protected function int_to_word($n) {
        return chr($n & 255).chr(($n >> 8) & 255);
    }
    protected function decbin8($d) {
        return $this->decbinx($d, 8);
    }
    protected function decbinx($d, $n) {
        $bin = decbin($d);
        $sbin = strlen($bin);
        for ($j = 0; $j < $n - $sbin; $j++) {
            $bin = '0'.$bin;
        }
        return $bin;
    }
    protected function inttobyte($n) {
        return chr($n);
    }

}
?>