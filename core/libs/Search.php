<?php
namespace core\libs;
use core\Controller;
use core\Core;
use app\models\BaseModel;
//use \R;

// Класс для поиска
class Search {

  public $search_query = ''; // поисковый запрос
  public $search_array = []; // результаты поисковой выдачи в виде массива
  public $search_result = ''; // результаты поисковой выдачи в виде строки html-кода

  private $keywords = []; // массив из ключевых слов из поискового запроса
  private $data = []; // массив данных, полученных из базы данных

  protected $cache = 86400; // время кеширования в секундах, одни сутки 60 * 60 * 24 = 86400 секунд
  protected $cacheKey = 'search'; // ключ кеша

  protected $tpl; // путь к шаблону

  public function __construct($search_query = '') {
    //echo 'Search::__construct()<br>';
    $this->tpl = 'search_result.tpl'; // шаблон для поисковой выдачи по умолчанию
    $this->search_query = $search_query; // получаем поисковый запрос
    $this->keywords = $this->explodeQuery($this->search_query); // запускаем процесс для формирования массива ключевых слов
    //$this->run();
  }

  // вывод объекта класса через echo
  public function __toString() {
    return $this->search_result; // вывод строки из поисковой выдачи
  }

  // метод для запуска поисковой выдачи
  public function run() {
    // если ключевые слова получены, то выполняем следующее
    if (!empty($this->keywords)) {
      $this->data = Core::$core->Cache->get($this->cacheKey); // получаем данные из кеша, если они там есть
      //debug($this->data);
      // если данных в кэше не найдено, то получаем их из базы данных
      if(empty($this->data)) {
        $this->Model = new BaseModel; // создание модели и соединение с базой данных
        $this->data = $this->Model->search2(); // получение всех данных из базы данных
        Core::$core->Cache->set($this->cacheKey, $this->data, $this->cache); // сохранение данных в кеш
      }
      $this->search_result = $this->search($this->data, $this->keywords); // запускаем процедуру умного поиска в полученных данных
    }
    return $this->search_result;
  }

  // метод для отрези окончаний слов
  private function dropBackWords($word) { //тут мы обрабатываем одно слово
    $reg = "/(ый|ой|ая|ое|ые|ому|а|о|у|е|ого|ему|и|ство|ых|ох|ия|ий|ь|я|он|ют|ат)$/i"; //данная регулярная функциях будет искать совпадения окончаний
    $word = preg_replace($reg,'',$word); //убиваем окончания
    return $word;
  }

  // метод для убирания стоп-слов
  private function stopWords($query) { //тут мы обрабатываем весь поисковый запрос
    $reg = "/\s(под|много|что|когда|где|или|которые|поэтому|все|будем|как)\s/im"; //данная регулярка отрежет все стоп-слова отбитые пробелами
    $query = preg_replace($reg,'',$query); //убиваем стоп-слова
    return $query;
  }

  // метод для обработки поискового запроса
  private function explodeQuery($query) { // функция вызова поисковой строки
    $query = $this->stopWords($query); // используем написанную нами ранее функцию для удаления стоп-слов
    $words = explode(' ', $query); 	// разбиваем поисковый запрос на слова через пробел и заносим все слова в массив
    $i = 0; // устанавливаем начало массива в 0, помним что нумерация в массивах начинается с 0
    $keywords = array(); // создаем пустой массив
    foreach ($words as $word) { // в цикле для массива words создаем элемент word
      $word = trim($word);
      // если слово короче 6 символов то убиваем его
      if (mb_strlen($word, 'UTF-8') < 4) {
        unset($word);
      }
      // иначе выполняем следующее
      else {
        if (mb_strlen($word, 'UTF-8') > 8) {
          $keywords[$i] = $this->dropBackWords($word); // функция очистки окончаний для слов длинее 8 символов и занесение их в созданный массив
          $i++; // наращиваем значение i для того чтобы перейти к следующему элементу
        }
        else {
          $keywords[$i] = $word; // если короче 8 символов, то просто добавляем в массив
          $i++;
        }
      }
    }
    // print_array($keywords);
    return $keywords; // возвращаем полученный массив
  }

  // метод для выделения найденых слов
  private function colorSearchWord($word, $string, $color) {
    $replacement = '<span style="color:'.$color.';border-bottom:1px dashed '.$color.';">'.$word.'</span>';
    $result = str_replace($word, $replacement, $string);
    return $result;
  }

  // метод для рендеринга нужного шаблона поисковой выдачи
  private function simpleToTemplate($value) {
    ob_start(); // Включаем буферизацию вывода, чтобы шаблон не вывелся в месте вызова функции
    require __DIR__.'/search/'.$this->tpl.'.php'; // Подключаем необходимый нам шаблон, который просто ждет наш массив
    return ob_get_clean(); // Возвращаем результат буфера и очищаем его
  }

  // метод вывода результата поиска
  private function search($materials, $keywords) {
    $result = '';
    $max_relevation = 0; // флаг максимальной релевантности
    $current_relevation = 0; // флаг текущей релевантности
    foreach ($materials as $material) { // Выше мы сформировали массив $materials который мы теперь выводим разбивая на элементы массива $material
      $title = strip_tags($material['title']); //Тут мы чистим все значения массива - title, text и keywords от тегов и посторонних символов
      $text = strip_tags($material['text']);		//как вариант можно еще все слова перевести в нижний регистр
      $key = $material['keywords'];
      $description = $material['description'];

      $wordWeight = 0; //вес слова запроса приравниваем к 0
      $material['relevation'] = 0;
      foreach($keywords as $word) { //теперь для каждого поискового слова из запроса ищем совпадения в тексте
        $reg = "/(".$word.")/"; 	// маска поиска для регулярной функции
        /*
          Автоматически наращиваем вес слова для каждого элемента массива.
          Так же сюда можно включить например поле description если оно у вас есть.
          Оставляем переменную $out, которая выводит значение поиска. Она нам может и не пригодится, но пусть будет, может
          быть вы найдете ей применение.
        */
        $wordWeight = preg_match_all($reg, $title, $out);	// как вариант можно еще для слов в заголовке вес увеличивать в два раза
        $wordWeight += preg_match_all($reg, $text, $out);	// но это вам понадобиться если вы будете выводить материалы в порядке убывания по релевантности
        $wordWeight += preg_match_all($reg, $key, $out);	// мы же пока этого делать не будем
        $wordWeight += preg_match_all($reg, $description, $out);
        $material['relevation'] += $wordWeight; // увеличиваем вес всего материала на вес поискового слова

        // раскрашиваем найденные слова функцией, которую мы писали в первой части урока
        $title = $this->colorSearchWord($word, $title, "#60a0dc");
        $text = $this->colorSearchWord($word, $text, "#60a0dc");
        //$key = $this->colorSearchWord($word, $key, "#60a0dc"); // незнаю зачем ключевые слова окрасил, их ведь не обязательно выводить пользователю :)
      }
      //Теперь ищем те материалы, у которых временный атрибут relevation не равен 0
      if ($material['relevation'] != 0) {
        //Возвращаем массивы в нормальное состояние с уже обработанными данными
        $material['title'] = $title;
        $material['text'] = mbCutString($text,430, '...'); //mb_substr($text,0, 430, 'UTF-8'); // укорачиваем исходный текст
        //$material['keywords'] = $key;
        //$material['description'] = $description;
        unset($material['keywords'],$material['description']); // удаляем ненужные данные
        //$result = $this->simpleToTemplate($material); // возвращаем шаблон с результатами поиска
        // если релевантность мтериала больше текущей релевантности
        if ($material['relevation'] > $current_relevation) { // сортировка по релевантности
          array_unshift($this->search_array, $material); // записываем материал в начало массива поиска с ключом релевантности
          //$this->search_result = $result.$this->search_result; // добавляем полученный материал в начало строки
          if ($material['relevation'] > $max_relevation) {
            $max_relevation = $material['relevation']; // и переопределяем флаг максимальной релевантности
          }
        }
        else {
          array_push($this->search_array, $material); // добавляем полученный материал в конец массива
          //$this->search_result = $this->search_result.$result; // добавляем полученный материал в конец строки
        }
        $current_relevation = $material['relevation'];
      }
      else { // иначе удаляем элемент $material за ненадобностью
        unset($material);
      }
    }
    foreach($this->search_array as $material) {
      $result = $this->simpleToTemplate($material); // возвращаем шаблон с результатами поиска
      // debug($result);
      $this->search_result = $this->search_result.$result; // добавляем полученный материал в конец строки
    }
    //debug($this->search_array);
    //debug($this->search_result);
    return $this->search_result;
  }

}