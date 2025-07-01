<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use core\libs\Cache;
use core\libs\Pagination;
use \R;

class SitemapController extends BaseController {

  protected $xmlsitemap;
  protected $sitemap;
  protected $sitemap_url;

  public function indexAction() {
    //echo 'PageController - метод indexAction()<br>';

    //debug($this->route);
    //debug($this->id);
    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index


    //debug($this->rub_news); // блок

    //echo $this->view;
    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы
    $this->text = $this->page['text']; // Текст страницы

    //$breadcrumbs = " &raquo; <a class=\"current\" href=\"$view.php\" target=\"_self\" title=\"$title\">$title</a>";

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Карта сайта';

    //debug($this->categories);
    $this->posts = $this->Model->get_title_post(); // получение заголовков всех постов
    //debug($this->posts);
    $this->courses = $this->Model->get_title_course(); // получение заголовков всех курсов
    //debug($this->courses);
    //debug($this->partners);

    $this->sitemap = array();
    $sitemap_url = array();
    $sitemap_url[] = D;
    //$sitemap_url[] = D.S.'index';

    if(isset($this->categories)) {
      foreach($this->categories as $item) {
        $sitemap_url[] = D.S.$item['alias'];

        if(isset($this->posts)) { // для любых постов и материалов
          foreach($this->posts as $key=>$value) {
            if($value['category'] == $item['id']) {
              $sitemap_url[] = D.S.'post'.$value['id'];
              $item['posts'][$key] = $value;
            }
          }
        }

        if ((isset($this->partners)) and ($item['id'] == 4)) { // для партнёрских продуктов
          foreach($this->partners as $key3=>$value3) {
            $sitemap_url[] = D.S.'partner_products?partner='.$value3['id'];
            $item['partners'][$key3] = $value3;
          }
        }

        if(isset($this->courses)) { // для курсов
          foreach($this->courses as $key2=>$value2) {
            if($value2['category'] == $item['id']) {
              $sitemap_url[] = D.S.'course'.$value2['id'];
              $item['courses'][$key2] = $value2;
            }
          }
        }

        $this->sitemap[] = $item;
      }
    }

    $sitemap_url[] = D.S.'autrorization';
    //$sitemap_url[] = D.S.'user/login';
    $sitemap_url[] = D.S.'registration';
    //$sitemap_url[] = D.S.'user/signup';
    $sitemap_url[] = D.S.'send_login';
    //$sitemap_url[] = D.S.'user/send_login';
    $sitemap_url[] = D.S.'send_password';
    //$sitemap_url[] = D.S.'user/send_password';
    $sitemap_url[] = D.S.'subscription';
    //$sitemap_url[] = D.S.'user/subscribe';
    $sitemap_url[] = D.S.'activation';
    //$sitemap_url[] = D.S.'user/activate';
    $sitemap_url[] = D.S.'deactivation';
    //$sitemap_url[] = D.S.'user/deactivate';
    $sitemap_url[] = D.S.'exit';
    //$sitemap_url[] = D.S.'user/logout';
    $sitemap_url[] = D.S.'delete_message';

    $this->sitemap[] = ['alias' => 'autrorization', 'title' => 'Авторизация пользователя'];
    $this->sitemap[] = ['alias' => 'registration', 'title' => 'Регистрация пользователя'];
    $this->sitemap[] = ['alias' => 'send_login', 'title' => 'Восстановить логин'];
    $this->sitemap[] = ['alias' => 'send_password', 'title' => 'Восстановить пароль'];
    $this->sitemap[] = ['alias' => 'subscription', 'title' => 'Почтовая подписка'];
    $this->sitemap[] = ['alias' => 'activation', 'title' => 'Активация пользователя'];
    $this->sitemap[] = ['alias' => 'deactivation', 'title' => 'Отписка от почтовой рассылки'];
    $this->sitemap[] = ['alias' => 'exit', 'title' => 'Выход'];
    $this->sitemap[] = ['alias' => 'delete_message', 'title' => 'Удалить сообщение'];

    $sitemap_url[] = D.S.'date'.date('Y');
    $this->sitemap[] = ['alias' => 'date'.date('Y'), 'title' => 'Архив за '.date('Y').' год'];

    $sitemap_url[] = D.S.'courses';
    $this->sitemap[] = ['alias' => 'courses', 'title' => 'Обучающие курсы'];
    $sitemap_url[] = D.S.'links';
    $this->sitemap[] = ['alias' => 'links', 'title' => 'Все ссылки'];

    //$sitemap_url[] = D.S.'search';
    //$this->sitemap[] = ['alias' => 'search', 'title' => 'Поиск по сайту'];

    if (isset($this->user['id'])) {
      $sitemap_url[] = D.S.'user'. $this->user['id'];
      $this->sitemap[] = ['alias' => 'user'.$this->user['id'], 'title' => 'Страница пользователя'];
      $sitemap_url[] = D.S.'users';
      $this->sitemap[] = ['alias' => 'users', 'title' => 'Пользователи'];
    }

    //$sitemap_url[] = D.S.'sitemap';
    //$this->sitemap[] = ['alias' => 'sitemap', 'title' => 'Карта сайта'];

    //debug($sitemap_url);
    //debug($this->sitemap);

    $this->xmlsitemap = $this->xmlsitemap_generate($sitemap_url);
    //debug($this->xmlsitemap);

    $f = fopen('sitemap.xml', "w"); // Открыть текстовый файл
    fwrite($f, $this->xmlsitemap); // Записать строку текста
    fclose($f); // Закрыть текстовый файл


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'sitemap' => $this->sitemap,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction

  }

  public function viewAction() {
    //echo 'Pages::view';
    //debug($this->route);

    $menu = $this->menu; // \R::findAll('category');

    debug($this->route);
    if(isset($this->route['alias'])) {
      $alias = $this->route['alias'];
      echo 'alias = '.$alias;
    }

    $title = 'Страница';
    $this->set(compact('title', 'menu'));

  }


  protected function xmlsitemap_generate($sitemap_url = array()) {
    if(!is_array($sitemap_url)) {
      return false;
    }
    //date("Y-m-d H:i:s");
    $lastmod_date = date("Y-m-d").'T'.date("H:i:s+06:00"); // "2014-05-20T00:00:00+06:00";
    $changefreq = 'monthly'; //always hourly daily weekly monthly yearly never
    $priority = '1.0';

    $xmlsitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\">';
    foreach ($sitemap_url as $item) {
      $xmlsitemap = $xmlsitemap.'
  <url>
    <loc>'.$item.'</loc>
    <lastmod>'.$lastmod_date.'</lastmod>
    <changefreq>'.$changefreq.'</changefreq>
    <priority>'.$priority.'</priority>
  </url>';
    }
    $xmlsitemap = $xmlsitemap."\r\n".'</urlset>';
    return $xmlsitemap;
  }






}