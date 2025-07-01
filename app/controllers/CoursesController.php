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

class CoursesController extends BaseController {

  //public $courses; // html-блок постов с курсами
  //public $course; // список разделов
  public $bill_form; // формы оплаты WebMoney, YooMoney (Yandex Деньги), Payeer и другие

  public function indexAction() {
    // echo 'CoursesController - метод indexAction()<br>';

    $payment_id = $this->Model->get_payment_id();
    //debug($payment_id);
    $this->payment_id = (int)$payment_id + 1; // получение последней платёжной операции
    //debug($this->payment_id);

    if ($this->alias == 'course') {
      if ((empty($this->id) or ($this->id == 0))) {
        $this->id = 1; // если параметр не передан, то показываем первый пост
      }
      $course[0] = $this->Model->get_course($this->id); // получение одного курса из базы данных
      if(isset($course[0]['id'])) { // если такой курс есть
        $this->course = $this->format_courses($course,true); // обрабатываем один курс
        $this->Model->update_view('courses', $this->course['id'], $this->course['view']); // обновление количества просмотров $update_view
        //debug($this->course);

        $this->title = $this->course['title']; // Заголовок страницы
        $this->description = $this->title; // Описание страницы
        $this->keywords = $this->title; // Ключевые слова
        $this->text = $this->course['text']; // Текст страницы

        //echo $this->alias;
        $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->id,18,$this->alias); //'Курсы';

        /*
        echo 'Число типа Decimal (19,2)';

        $order = $this->Model->get_order(1);
        //debug($order);
        if (!empty($order)) {
          //debug($order['amount']);
          $order_amount1 = number_format($order['amount'], 2, '.', '');
          $order_amount = number_format($order_amount1, 2, '.', '');
          //debug($order_amount);
          echo 'не пуст';
        }
        else {echo 'пуст';}
        */

        //Payeer:
        $amount = number_format($this->course['price'], 2, '.', ''); // сумма платежа
        $payeer_m_curr = 'RUB';
        $payeer_desc = base64_encode('Paybill #'.$this->payment_id);

        $payeer_array = array(
          PAYEER_SHOP_ID, // идентификатор магазина Payeer
          $this->payment_id, // уникальный номер платежа
          $amount, // сумма
          $payeer_m_curr, // валюта 'RUB'
          $payeer_desc, // описание платежа
          PAYEER_SECRET_KEY // секретный ключ
        );

        $payeer_crc = $this->get_payeer_crc($payeer_array);


        // формы оплаты WebMoney, YooMoney, Payeer и другие
        $this->bill_form = $this->render('bill_forms', ['amount' => $amount,
          'payment_no' => $this->payment_id,
          'lmi_payment_desc' => 'Oplata_kursa_'.$this->payment_id,
          'course_id' => $this->course['id'],
          'course_alias' => $this->course['alias'],
          'course_title' => $this->course['title'],
          'token' => $this->getToken('pay_form'),
          'payeer_desc' => $payeer_desc,
          'payeer_crc' => $payeer_crc
        ]);
        // ещё можно сгенерировать и передать токен: 'token' => $this->getToken('pay_form')
        //debug($this->bill_form);
        // number_format($this->course['price'], 2, '.', '') // Форматирует число сгруппированными тысячами и, возможно, десятичными цифрами





      }
      else {
        $this->title = 'Курсы'; // Заголовок страницы
        $this->text = 'Такого курса пока нет'; // Текст страницы
        $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Курсы';
      }
    }
    else {
      //echo $this->alias;
      $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
      $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
      //debug($this->page);

      $this->description = $this->page['description']; // Описание страницы
      $this->keywords = $this->page['keywords']; // Ключевые слова
      $this->title = $this->page['title']; // Заголовок страницы
      $this->text = $this->page['text']; // Текст страницы

      //$breadcrumbs = " &raquo; <a class=\"current\" href=\"$view.php\" target=\"_self\" title=\"$title\">$title</a>";

      $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Курсы';

      $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы

      // если количество постов на странице не определено, то берём данные из настроек
      if(!$this->quantity_posts) {
        $this->quantity_posts = QUANTITY_POSTS;
        //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
      }

      $this->total_posts_pagination = $this->Model->get_total_posts('courses', null, 18, null, null); // общее количество курсов (категория курсов 18)
      //debug($this->total_posts_pagination);

      $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
      $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
      //var_dump($pagination->pagination);
      $this->pagination = $this->render_pagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
      //debug($this->pagination);

      //$total_post = count_post($type,$category,null); // общее количество новостей
      $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

      $courses = $this->format_courses($this->Model->get_courses(null,['id'],['ASC'],$limit),false); // обрабатываем один или несколько курсов
      //debug($courses);
      $this->courses = $this->renderCourses(['courses' => $courses, 'courses_block_title' => false, 'link_pattern' => 'course', 'if_empty' => 'Курсов пока нет']);
      //$this->courses = $this->render('post',['posts' => $courses, 'posts_block_title' => 'Новости', 'link_pattern' => '#', 'if_empty' => 'Новостей пока нет']);
      //debug($this->courses);
    }

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'courses' => $this->courses,
      'course' => $this->course,
      'pagination' => $this->pagination,
      'bill_form' => $this->bill_form,
     ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

  protected function format_courses($courses=array(),$one_course = false){
    // $courses - ассоциативный массив из 1 или нескольких элементов
    if(!is_array($courses)) {
      return false;
    }
    $course = array();
    // $count = 0; // счетчик элементов
    foreach($courses as $key=>$item) {
      // Получение названий рубрик, разделов, имён партнёров
      // $item['category'] = 'Курсы';
      // $item['alias']
      // $item['author']
      $item['size'] = get_size($item['size']);
      // $item['year']

// title,alias,author,image,text,size,year,price,author_price,orders,downloaded,transitions,
// buy_link
// download_link
// partner_link

      // если нужно скрыть партнёрские ссылки, тогда удаляем партнёрскую ссылку
      if ($item['hide_plink'] == 1) {
        unset($item['partner_link']);
      }

      // если цена товара на сайте автора курса равна нулю, тогда вычисляем цену товара на сайте автора
      if ($item['author_price'] == 0) {
        $item['author_price'] = $item['price'] * 1.75;
      }

      // Получение названий рубрик, разделов, имён партнёров
      $category = $this->get_title_category($item['category']);
      if (empty($category)) {
        $category = $this->Model->get_title_category($item['category']);
      }
      //debug($category);
      $item['title_category'] = $category['title'];
      $item['alias_category'] = $category['alias'];
      if (empty($item['title_category'])) {
        //$title_category['title'] = 'Без категории';
        $item['title_category'] = 'Курсы';
        $item['alias_category'] = 'courses';
      }

      // получение имени миниатюры
      if (($item['image'] == 'images/') or ($item['image'] == 'images/courses/')) {unset($item['image']);}
      //if (isset($item["image"])) {
      //$item["thumbspostimage"] = thumbsfilename($item["image"]);
      //}
      // преобразование даты в удобный для восприятия вид
      //$item['date'] = get_datetime($item['date']);

      /* Проверка ссылки для заказа и цены */
      if (empty($item['buy_link'])) {
        unset($item['buy_link'],$item['orders']);
      }
      if ((int)$item['price'] == 0) {
        unset($item['price']);
      }
      $course[$key] = $item;
      // $count = $count + 1;
    }
    if ($one_course == true) { // если курс только один, то возвращаем первый элемент массива $course
      return $course[0];
    }
    else {
      return $course;
    }
  }

  protected function format_course($course=array()){
    // $course - ассоциативный массив из 1 или нескольких элементов
    if(!is_array($course)) {
      return false;
    }
    $course = array();
    foreach($course as $key=>$item) {
      // Получение названий рубрик, разделов, имён партнёров
      // $item['category'] = 'Курсы';
      // $item['alias']
      // $item['author']
      $item['size'] = get_size($item['size']);
      // $item['year']

// title,alias,author,image,text,size,year,price,author_price,orders,downloaded,transitions,
// buy_link
// download_link
// partner_link

      // если нужно скрыть партнёрские ссылки, тогда удаляем партнёрскую ссылку
      if ($item['hide_plink'] == 1) {
        unset($item['partner_link']);
      }

      // если цена товара на сайте автора курса равна нулю, тогда вычисляем цену товара на сайте автора
      if ($item['author_price'] == 0) {
        $item['author_price'] = $item['price'] * 1.75;
      }

      // Получение названий рубрик, разделов, имён партнёров
      $category = $this->get_title_category($item['category']);
      if (empty($category)) {
        $category = $this->Model->get_title_category($item['category']);
      }
      //debug($category);
      $item['title_category'] = $category['title'];
      $item['alias_category'] = $category['alias'];
      if (empty($item['title_category'])) {
        //$title_category['title'] = 'Без категории';
        $item['title_category'] = 'Курсы';
        $item['alias_category'] = 'courses';
      }

      // получение имени миниатюры
      if (($item['image'] == 'images/') or ($item['image'] == 'images/courses/')) {unset($item['image']);}
      //if (isset($item["image"])) {
      //$item["thumbspostimage"] = thumbsfilename($item["image"]);
      //}
      // преобразование даты в удобный для восприятия вид
      //$item['date'] = get_datetime($item['date']);

      /* Проверка ссылки для заказа и цены */
      if (empty($item['buy_link'])) {
        unset($item['buy_link'],$item['orders']);
      }
      if ((int)$item['price'] == 0) {
        unset($item['price']);
      }
      $course[$key] = $item;
    }
    return $course;
  }

  public function get_payeer_crc($payeer_array = array()) {
    if (empty($payeer_array)) {return false;}
    $payeer_crc = strtoupper(hash('sha256', implode(':', $payeer_array)));
    return $payeer_crc;
  }


}