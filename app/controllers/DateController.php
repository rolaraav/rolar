<?php
namespace app\controllers;


class DateController extends BaseController {

  protected $date_li;
  protected $date_list;
  protected $date; // определение выбранной даты

public function indexAction() {

  if (isset($this->route['date'])) {
    $this->date = trim($this->route['date'],'-');
  }
  else {
    $this->date = date('Y');
  }
  //debug($this->date);

  $this->description = 'Архив новостей, отсортированных по дате и времени публикации'; // Описание страницы
  $this->keywords = 'архив, записи, заметки, новости, время, дата, создание, публикация, период'; // Ключевые слова
  $this->title = 'Архив'; // Заголовок страницы
  $this->text = '<p>Архив новостей, записей, заметок, которые отсортированны по дате и времени публикации.</p>';

  if (mb_strlen($this->date,"UTF-8") == 4) {
    if (!preg_match("#^20[0-9]{2}$#", $this->date) or ($this->date < 2012) or ($this->date > date('Y'))) {$this->date = date('Y');}
    $year = $this->date;
    $date_begin = $this->date.'-01-01 00:00:00'; // Начальная дата $date;
    $date_counter = $this->date;
    $date_counter++; // Увеличение даты на один год
    $date_end = $date_counter.'-01-01 00:00:00'; // Конечная дата
    // echo "Начальная дата ".$date_begin." и конечная дата ".$date_end;
    $date_title = $this->date.' год';
    $this->title = $this->title.' за '.$date_title;
  }
  else {
    if (!preg_match("#^20[0-9]{2}-0[1-9]|1[012]$#", $this->date)) {$this->date = date('Y-m');}
    $year = substr($this->date, 0, 4);
    $date_begin = $this->date.'-01 00:00:00'; // Начальная дата $date;
    $date_counter = $this->date;
    $date_counter++; // Увеличение даты на один месяц
    $date_end = $date_counter.'-01 00:00:00'; // Конечная дата
    // echo "Начальная дата ".$date_begin." и конечная дата ".$date_end;
    $date_title = rusdate('%MONTH% Y',strdatetosec($this->date.'-01 00:00:00'),0).' года';
    $this->title = $this->title.' за '.$date_title;
  }
  $date_archive = $this->format_posts($this->Model->get_date_archive((string)$date_begin,(string)$date_end)); // получение архива новостей
  //debug($date_archive);
  $this->posts = $this->renderPosts(['posts' => $date_archive, 'posts_block_title' => $this->title, 'link_pattern' => 'post', 'if_empty' => 'Архив пустой']);
  //$this->courses = $this->render('post',['posts' => $courses, 'posts_block_title' => 'Новости', 'link_pattern' => '#', 'if_empty' => 'Новостей пока нет']);
  //debug($this->courses);

  $archive = $this->format_archive($this->Model->get_news_archive($year),$year); // получение архива за нужный год
  //debug($archive);
  $this->date_li = $this->render('archive_li', ['archive' => $archive, 'archive_block_title' => 'Архив за '.$year.' год', 'link_pattern' => 'date', 'if_empty' => 'Архив пустой']);
  $this->date_list = $this->render('archive_list', ['archive' => $archive, 'archive_block_title' => 'Архив за '.$year.' год', 'link_pattern' => 'date', 'if_empty' => 'Архив пустой']);
  //debug($this->date_list);

  $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->date,false,$this->alias);

  $this->half_blocks = $this->renderHalf([$this->date_list, $this->rub_news, $this->partners_list, $this->cat_downloads]);
  //debug($this->half_blocks);

  $this->set([
    'description' => $this->description,
    'keywords' => $this->keywords,
    'title' => $this->title,
    'breadcrumbs' => $this->breadcrumbs,
    'text' => $this->text,
    'date_li' => $this->date_li,
    //'date_list' => $this->date_list,
    'posts' => $this->posts,
    'half_blocks' => $this->half_blocks,
  ]);
}




}