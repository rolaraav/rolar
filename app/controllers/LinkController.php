<?php
namespace app\controllers;
use core\Model;
use core\libs\Mail;

class LinkController extends BaseController {

  private $all_links;
  private $all_partner_links;
  private $all_download_links;
  private $all_internet_links;
  private $all_buy_links;
  private $all_banner_links;

  public function indexAction() {
    //echo 'Метод indexAction контроллера LinkController';
    $link = $this->Model->get_link($this->id);
    //debug($link);
    if (!empty($link)) {
      //if (isDomainAvailible($link)) { // если сайт доступен, то перенаправляем его
        redirect($link);
      /*}
      else { // иначе снимаем ссылку с публикации и уведомляем об этом администратора
        $this->Model->unpublish_link($this->id); // снимаем ссылку с публикации
        // Отправка уведомления на email
        $subject = 'Не рабочая ссылка'; // тема сообщения
        // содержание сообщения
        $message_for_mail = 'Ссылка '.$link.' с ID '.$this->id.' не доступна и снята с публикации.'."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        // отправляем сообщение
        $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
      } */
    }
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function partnerAction() {
    // echo 'Метод partnerAction контроллера LinkController';
    if ($this->alias == 'partner_link') {
      $table='data';
    }
    else {
      $table='courses';
    }
    $partner_link = $this->Model->get_partner_link($this->id,$table);
    //debug($partner_link);
    if (!empty($partner_link)) {
      //if (isDomainAvailible($partner_link)) { // если сайт доступен, то перенаправляем его
        redirect($partner_link);
      /*}
      else { // иначе уведомляем об этом администратора
        // Отправка уведомления на email
        $subject = 'Не рабочая партнёрская ссылка'; // тема сообщения
        // содержание сообщения
        if ($this->alias == 'buy_link') {
          $message_for_mail = 'Ссылка '.$partner_link.' с ID '.$this->id.' не доступна.'."\n".'Адрес заметки '.D.S.'post'.$this->id."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        }
        else {
          $message_for_mail = 'Ссылка '.$partner_link.' с ID '.$this->id.' не доступна.'."\n".'Адрес курса '.D.S.'course'.$this->id."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        }
        // отправляем сообщение
        $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
      } */
    }
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function downloadAction() {
    //echo 'Метод downloadAction контроллера LinkController';
    /*
    $this->Model->update_hash();
    exit();
    for($i=1;$i < 291;$i++){
      $hash = substr(md5(microtime().mt_rand(1,10000)),7,16);
      $this->Model->update_hash($i,$hash);
    }
    echo 'OK';
    exit();
    */
    $hash = isset($_GET['hash']) ? trim((string)$_GET['hash']) : null;
    //debug($hash);
    //if (!empty($hash)) { // если хеш не пустой, то получаем массив со ссылками для закачки
      if ($this->alias == 'download_link') {
        $table = 'data';
        $path = DOWNLOAD_SERVER;
        $download_link = $this->Model->get_download_link($this->id);
      }
      else {
        $table = 'courses';
        $path = DOWNLOAD_SERVER4;
        if (isset($_GET['alias'])) {
          $alias = (string)$_GET['alias'];
        }
        $download_link = $this->Model->get_download_link_by_alias($alias);
        $this->id = $download_link['id'];
      }
      if (!empty($download_link['download_link'])) { // если хеши совпадают И ссылка на закачку не пустая, то проверяем ссылку на доступность
      // если нужно проверить хеш, то нужно добавить ($hash === $download_link['hash']) and ( в условие выше
      //debug($path.$download_link['download_link']);
        //if (isDomainAvailible($path.$download_link['download_link'])) { // если сайт доступен, то обновляем количество скачиваний и перенаправляем на закачку
        $this->Model->update_downloaded($this->id,$download_link['downloaded'],$table); // обновляем количество скачиваний
        redirect($path.$download_link['download_link']);
        //download_file($path.$download_link['download_link']);
        /*
        }
        else { // иначе уведомляем об этом администратора
          // Отправка уведомления на email
          $subject = 'Не рабочая ссылка для закачки'; // тема сообщения
          // содержание сообщения
          if ($this->alias == 'download_link') {
            $message_for_mail = 'Ссылка на закачку '.$download_link['download_link'].' с ID '.$this->id.' не доступна.'."\n".'Полный путь '.$path.$download_link['download_link']."\n".'Сервер '.DOWNLOAD_SERVER."\n".'Адрес заметки '.D.S.'post'.$this->id."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
          }
          else {
            $message_for_mail = 'Ссылка на закачку OM '.$download_link['download_link'].' с ID '.$this->id.' не доступна.'."\n".'Полный путь '.$path.$download_link['download_link']."\n".'Сервер '.DOWNLOAD_SERVER4."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
          }
          // отправляем сообщение
          $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
        } */
      }
      //echo 'хеш не правильный';
    //}
    //echo 'без хеша не дам';
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function internetAction() {
    /*
    for($i=1;$i < 61;$i++){
      $hash = substr(md5(microtime().mt_rand(1,10000)),7,16);
      $this->Model->update_hash($i,$hash,'courses');
    }
    echo 'OK';
    exit();
    */
    $hash = isset($_GET['hash']) ? trim((string)$_GET['hash']) : null;
    //debug($hash);
    //if (!empty($hash)) { // если хеш не пустой, то получаем массив со ссылками для закачки
      $internet_link = $this->Model->get_internet_link($this->id);
      //debug($internet_link);
      if (!empty($internet_link['internet_link'])) { // если хеши совпадают И ссылка на закачку не пустая, то проверяем ссылку на доступность
        // Если нужно проверить хеш, то нужно добавить ($hash === $internet_link['hash']) and ( в условие више
        //if (isDomainAvailible($internet_link['internet_link'])) { // если сайт доступен, то обновляем количество скачиваний и перенаправляем на страницу закачки
          $this->Model->update_internet_downloaded($this->id,$internet_link['internet_downloaded']); // обновляем количество скачиваний
          redirect($internet_link['internet_link']);
        /*}
        else { // иначе уведомляем об этом администратора
          // Отправка уведомления на email
          $subject = 'Не рабочая ссылка для скачивания с интернета'; // тема сообщения
          // содержание сообщения
          $message_for_mail = 'Ссылка '.$internet_link['internet_link'].' с ID '.$this->id.' не доступна.'."\n".'Адрес заметки '.D.S.'post'.$this->id."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
          // отправляем сообщение
          $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
          $mail = new Mail(); // инициализируем класс для работы с почтой
          $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
        } */
      }
      //echo 'хеш не правильный';
    //}
    //echo 'без хеша не дам';
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function buyAction() {
    if ($this->alias == 'buy_link') {
      $table='data';
      $path = '';
    }
    else {
      $table='courses';
      $path = D.S.'om/ord/'; // http://rolar.ru/om/ord/{алиас товара из Order Master}
    }
    $buy_link = $this->Model->get_buy_link($this->id,$table);
    //debug($buy_link);
    if (!empty($buy_link)) {
      //if (isDomainAvailible($path.$buy_link)) { // если сайт доступен, то перенаправляем его
        redirect($path.$buy_link);
      /*}
      else { // иначе уведомляем об этом администратора
        // Отправка уведомления на email
        $subject = 'Не рабочая ссылка для оформления заказа'; // тема сообщения
        // содержание сообщения
        if ($this->alias == 'buy_link') {
          $message_for_mail = 'Ссылка на заметку '.$buy_link.' с ID '.$this->id.' не доступна.'."\n".'Адрес заметки '.D.S.'post'.$this->id."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        }
        else {
          $message_for_mail = 'Ссылка на курс '.$buy_link.' с ID '.$this->id.' не доступна.'."\n".'Полный путь '.$path.$buy_link."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        }
        // отправляем сообщение
        $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
      } */
    }
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function bannerAction() {
    $banner_link = $this->Model->get_banner_link($this->id);
    //debug($banner_link);
    if (!empty($banner_link)) {
      // if (isDomainAvailible($banner_link)) { // если сайт доступен, то перенаправляем его
        redirect($banner_link);
      /* }
      else { // иначе уведомляем об этом администратора
        // Отправка уведомления на email
        $subject = 'Не рабочая ссылка для баннера'; // тема сообщения
        // содержание сообщения
        $message_for_mail = 'Ссылка '.$banner_link.' с ID '.$this->id.' не доступна.'."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        // отправляем сообщение
        $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
      } */
    }
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function torrentAction() {
    $torrent_link = $this->Model->get_torrent_link($this->id);
    //debug($torrent_link);
    if (!empty($torrent_link)) {
      // if (isDomainAvailible($torrent_link)) { // если сайт доступен, то перенаправляем его
        redirect($torrent_link);
      /* }
      else { // иначе уведомляем об этом администратора
        // Отправка уведомления на email
        $subject = 'Не рабочая ссылка для торрента'; // тема сообщения
        // содержание сообщения
        $message_for_mail = 'Ссылка '.$torrent_link.' с ID '.$this->id.' не доступна.'."\n".'Дата проверки: '.date("Y-m-d H:i:s").'.';
        // отправляем сообщение
        $emails = get_one_email(ADMINEMAIL,AUTHOR, 0); // получаем массив из адреса почты, имени получателя и типа письма
        $mail = new Mail(); // инициализируем класс для работы с почтой
        $mail->Mail($emails, $subject, $message_for_mail); // отправляем письмо с уведомлением
      } */
    }
    echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
    exit(); // останавливаем скрипт
  }

  public function linksAction() {
    //echo 'LinkController - метод linksAction()<br>';

    //echo $this->view;
    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // 'Все ссылки'; Описание страницы
    $this->keywords = $this->page['keywords']; // 'ссылки, ссылка, link, links'; Ключевые слова
    $this->title = $this->page['title']; // 'Все ссылки'; Заголовок страницы
    $this->text = $this->page['text']; // '<p>На данной странице приведены все внешние ссылки сайта <a href="'.D.'" target="_self" title="Персональный сайт Артура Абзалова">'.DOMEN.'</a>.</p>'; // Текст страницы

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Все ссылки';

    $this->all_links = $this->format_links($this->Model->get_all_links());
    //debug($this->all_links);

    $this->all_partner_links = $this->format_partner_links($this->Model->get_all_partner_links());
    //debug($this->all_partner_links);
    if($this->user['login'] == 'rolar') {
      $this->all_download_links = $this->format_download_links($this->Model->get_all_download_links());
      //debug($this->all_download_links);
      $this->all_internet_links = $this->format_internet_links($this->Model->get_all_internet_links());
      //debug($this->all_internet_links);
    }
    $this->all_buy_links = $this->format_buy_links($this->Model->get_all_buy_links());
    //debug($this->all_buy_links);
    $this->all_banner_links = $this->Model->get_all_banner_links();
    //debug($this->all_banner_links);


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'all_links' => $this->all_links,
      'all_partner_links' => $this->all_partner_links,
      'all_download_links' => $this->all_download_links,
      'all_internet_links' => $this->all_internet_links,
      'all_buy_links' => $this->all_buy_links,
      'all_banner_links' => $this->all_banner_links,
    ]);

  }

  private function format_links($links=array()){
    if (empty($links)) return false;
    $links_array = array();
    foreach($links as $link) {
      if ($link['ref'] == 1) {
        $link['ref'] = ' class="green_link"';
      }
      else {
        $link['ref'] = '';
      }
      $links_array[] = $link;
    }
    return $links_array;
  }

  private function format_partner_links($partner_links=array()){
    if (empty($partner_links)) return false;
    $links_array = array();
    foreach($partner_links as $link) {
      if (empty($link['partner_link'])) {
        continue;
      }
      $links_array[] = $link;
    }
    return $links_array;
  }

  private function format_download_links($download_links=array()){
    if (empty($download_links)) return false;
    $links_array = array();
    foreach($download_links as $link) {
      if ((empty($link['download_link'])) or ($link['download_link'] == 'downloads/')) {
        continue;
      }
      $links_array[] = $link;
    }
    return $links_array;
  }

  private function format_internet_links($internet_links=array()){
    if (empty($internet_links)) return false;
    $links_array = array();
    foreach($internet_links as $link) {
      if (empty($link['internet_link'])) {
        continue;
      }
      $links_array[] = $link;
    }
    return $links_array;
  }

  private function format_buy_links($buy_links=array()){
    if (empty($buy_links)) return false;
    $links_array = array();
    foreach($buy_links as $link) {
      if (empty($link['buy_link'])) {
        continue;
      }
      $links_array[] = $link;
    }
    return $links_array;
  }

  }