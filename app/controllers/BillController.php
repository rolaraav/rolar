<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use \R;

class BillController extends BaseController {

  public $vars; // тут всякие переменные

  public function indexAction() {
    echo 'Не переданы параметры';
    //echo 'BillController - метод indexAction()<br>';

    exit();

    //echo $this->view;
    $this->page = $this->Model->get_page($this->alias); // получение отдельной страницы
    $this->Model->update_view('pages', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $breadcrumbs = new Breadcrumbs(); // получение хлебных крошек
    $this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->title,$this->alias); //'Скачать';

    //$content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      //'balls' => $this->balls,
    ]);
  }

  // метод принимающий данные из формы предварительного запроса и формы оповещения о платеже - адрес Result URL
  public function webmoneyAction() {
    //echo 'BillController - метод webmoneyAction()<br>';

    //debug($_POST);
    if (empty($_POST)) {
      //redirect(D);
      exit('Не переданы параметры');
    }

    //echo 'YES'; exit();
    $error = ''; // флаг проверки на ошибки

    // если в массиве POST есть индикатор предварительного запроса LMI_PREREQUEST = 1 - то обрабатываем данные из формы предварительного запроса платежа
    if ((!empty($_POST['LMI_PREREQUEST'])) && ($_POST['LMI_PREREQUEST'] == 1)) {

      // получаем данные из системы WebMoney Merchant и сохраняем в базу данных

      $payment_no = (int)$_POST['LMI_PAYMENT_NO']; if (empty($payment_no)) {$payment_no = ''; $error = $error.'<li>Не введён номер покупки</li>';} // номер покупки (уникальный)
      $amount = number_format($_POST['LMI_PAYMENT_AMOUNT'], 2, '.', ''); if (empty($amount)) {$amount = ''; $error = $error.'<li>Не введена сумма</li>';} // сумма платежа, дробная часть два знака отделяется точкой
      //debug($_POST['LMI_PAYMENT_AMOUNT']);
      $payee_purse = trim($_POST['LMI_PAYEE_PURSE']); if ((empty($payee_purse)) or ($payee_purse != LMI_PAYEE_PURSE)) {$payee_purse = LMI_PAYEE_PURSE; $error = $error.'<li>Не верный кошелёк продавца</li>';} // кошелёк продавца
      //$lmi_mode = (int)$_POST['LMI_MODE']; // режим платежа: 0 - реальный, 1 - тестовый
      $payer_purse = $_POST['LMI_PAYER_PURSE']; if (empty($payer_purse)) {$payer_purse = ''; $error = $error.'<li>Не введён кошелёк покупателя</li>';} // кошелёк покупателя
      $payer_wm = $_POST['LMI_PAYER_WM']; if (empty($payer_wm)) {$payer_wm = ''; $error = $error.'<li>Не введён WM-идентификатор покупателя</li>';} // WM-идентификатор покупателя
      $payer_ip = $_POST['LMI_PAYER_IP']; if (empty($payer_ip)) {$payer_ip = get_ip();} // IP-адрес покупателя
      $payment_description = trim($_POST['LMI_PAYMENT_DESC']); if (empty($payment_description)) {$payment_description = ''; $error = $error.'<li>Не введено примечание к платежу</li>';} // примечание к платежу Oplata_kursa_{номер}
      //$shop_id = trim($_POST['LMI_SHOP_ID']); if (empty($shop_id)) {$shop_id = '';} // номер магазина в каталоге Мегасток
      $course_id = (int)$_POST['course_id']; if (empty($course_id)) {$course_id = 1; $error = $error.'<li>Не введён ID курса</li>';} // ID курса
      //$course_alias = trim($_POST['course_alias']); if (empty($course_alias)) {$course_alias = ''; $error = $error.'<li>Не введён алиас курса</li>';} // алиас курса
      //$course_title = trim($_POST['course_title']); if (empty($course_title)) {$course_title = ''; $error = $error.'<li>Не введено название курса</li>';} // название курса

      // проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
      /*
      $token = isset($_POST['pay_token']) ? trim($_POST['pay_token']) : null;
      //debug($token);
      if ((empty($token)) or (!$this->checkToken($token,'pay_form'))) {
        $error = $error.'<li>Ошибка при отправке данных. Форма не валидна</li>';
        exit($error);
      }*/

      $create_date = date("Y-m-d H:i:s"); // дата создания платежа
      $pay_date = '1970-01-01 00:00:00'; // дата подтверждения платежа
      $status = 0; // статус платежа: 0 - создан, ожидает оплаты, 1 - оплачен, 2 - не оплачен/отменён
      $method = 'Webmoney P'; // способ оплаты

      // есди ошибок нет, то добавляем заказ в базу данных и отправляем подтверждение YES
      if (empty($error)) {
        $result = $this->Model->add_order($payment_no,$course_id,$amount,$create_date,$pay_date,$payer_purse,$status,$method,$payer_ip,$payer_wm,$payment_description);
        echo 'YES';
        exit();
      }
      else {
        echo $error;
        exit();
      }
    }
    elseif (!empty($_POST['LMI_HASH'])) { // иначе, если есть контрольная подпись оповещения о платеже (хеш), обрабатываем финальный запрос

      $payment_no = (int)$_POST['LMI_PAYMENT_NO']; if (empty($payment_no)) {$payment_no = ''; $error = $error.'<li>Не введён номер покупки</li>';} // номер покупки (уникальный)
      $amount = number_format($_POST['LMI_PAYMENT_AMOUNT'], 2, '.', ''); if (empty($amount)) {$amount = ''; $error = $error.'<li>Не введена сумма</li>';} // сумма платежа, дробная часть два знака отделяется точкой
      $payee_purse = trim($_POST['LMI_PAYEE_PURSE']); if ((empty($payee_purse)) or ($payee_purse != LMI_PAYEE_PURSE)) {$payee_purse = LMI_PAYEE_PURSE; $error = $error.'<li>Не верный кошелёк продавца</li>';} // кошелёк продавца
      // $lmi_mode = (int)$_POST['LMI_MODE']; // режим платежа: 0 - реальный, 1 - тестовый
      // $lmi_sys_invs_no = $_POST['LMI_SYS_INVS_NO']; // номер счета в системе WebMoney Transfer
      // $lmi_sys_trans_no = $_POST['LMI_SYS_TRANS_NO']; // номер платежа в системе WebMoney Transfer
      $payer_purse = $_POST['LMI_PAYER_PURSE']; if (empty($payer_purse)) {$payer_purse = ''; $error = $error.'<li>Не введён кошелёк покупателя</li>';} // кошелёк покупателя
      $payer_wm = $_POST['LMI_PAYER_WM']; if (empty($payer_wm)) {$payer_wm = ''; $error = $error.'<li>Не введён WM-идентификатор покупателя</li>';} // WM-идентификатор покупателя
      $payer_ip = $_POST['LMI_PAYER_IP']; if (empty($payer_ip)) {$payer_ip = get_ip();} // IP-адрес покупателя
      $payment_description = trim($_POST['LMI_PAYMENT_DESC']); if (empty($payment_description)) {$payment_description = ''; $error = $error.'<li>Не введено примечание к платежу</li>';} // примечание к платежу Oplata_kursa_{номер}
      //$shop_id = trim($_POST['LMI_SHOP_ID']); if (empty($shop_id)) {$shop_id = '';} // номер магазина в каталоге Мегасток

      // $lmi_secret_key = $_POST['LMI_SECRET_KEY']; // Значение Secret Key, известное только продавцу и сервису Web Merchant Interface. Это поле будет пустым, если параметр "Result URL" не обеспечивает секретность или не установлен флаг "Высылать Secret Key на Result URL...", или параметр "Result URL" изменен в форме
      $pay_date = $this->format_trans_date($_POST['LMI_SYS_TRANS_DATE']); // дата и время реального прохождения платежа в системе WebMoney Transfer в формате YYYYMMDD HH:MM:SS
      $lmi_hash = $_POST['LMI_HASH']; // контрольная подпись оповещения о выполнении платежа

      $course_id = (int)$_POST['course_id']; if (empty($course_id)) {$course_id = 1; $error = $error.'<li>Не введён ID курса</li>';} // ID курса
      //$course_alias = trim($_POST['course_alias']); if (empty($course_alias)) {$course_alias = ''; $error = $error.'<li>Не введён алиас курса</li>';} // алиас курса
      //$course_title = trim($_POST['course_title']); if (empty($course_title)) {$course_title = ''; $error = $error.'<li>Не введено название курса</li>';} // название курса

      // есди ошибок нет, то обновляем статус заказа и проверяем хеши
      if (empty($error)) {
        // получаем информацию о заказе из базы данных
        $order = $this->Model->get_order($payment_no);

        if (!empty($order)) { // если выбранный заказ существует, то проверяем полученные данные и хеш
          $order_amount = number_format($order['amount'], 2, '.', '');
          $gen_hash = $this->generate_lmi_hash($order['payment_id'],$order_amount); // генерируем хеш на основе сохранённых данных

          // если хеши совпадают
          if ($gen_hash === $lmi_hash) {

            // обновляем статус заказа - оплачен
            $status = 1; // статус платежа: 0 - ожидает оплаты, 1 - оплачен, 2 - не оплачен, отменён
            $result = $this->Model->update_order_status($payment_no,$status,$pay_date);

            //и отправляем пользователю письмо о том что его оплата прошла.

            //redirect(D.S.'bill/ok'); // перенаправляем пользователя на страницу успешной оплаты
            //echo 'YES';
            exit();
          }
          else {
            // обновляем статус заказа - не оплачен/отменён

            $status = 2; // статус платежа: 0 - ожидает оплаты, 1 - оплачен, 2 - не оплачен, отменён
            $result = $this->Model->update_order_status($payment_no,$status,$pay_date);

            //redirect(D.S.'bill/fail'); // перенаправляем пользователя на страницу неудачной оплаты
            exit();
          }
        }
      }
    }
    elseif((!empty($_POST['LMI_FAILREQUEST'])) && ($_POST['LMI_FAILREQUEST'] == 1)){ // иначе если в массиве POST есть индикатор об ошибке платежа LMI_FAILREQUEST = 1 - то обрабатываем данные из формы оповещения об ошибке

      $payment_no = (int)$_POST['LMI_PAYMENT_NO']; if (empty($payment_no)) {$payment_no = ''; $error = $error.'<li>Не введён номер покупки</li>';} // номер покупки (уникальный)
      $amount = number_format($_POST['LMI_PAYMENT_AMOUNT'], 2, '.', ''); if (empty($amount)) {$amount = ''; $error = $error.'<li>Не введена сумма</li>';} // сумма платежа, дробная часть два знака отделяется точкой
      // $lmi_mode = (int)$_POST['LMI_MODE']; // режим платежа: 0 - реальный, 1 - тестовый
      $payer_purse = $_POST['LMI_PAYER_PURSE']; if (empty($payer_purse)) {$payer_purse = ''; $error = $error.'<li>Не введён кошелёк покупателя</li>';} // кошелёк покупателя
      $payer_wm = $_POST['LMI_PAYER_WM']; if (empty($payer_wm)) {$payer_wm = ''; $error = $error.'<li>Не введён WM-идентификатор покупателя</li>';} // WM-идентификатор покупателя
      $lmi_error = $_POST['LMI_ERR']; // код ошибки, которая не позволила выполнить платеж
      $payment_description = trim($_POST['LMI_PAYMENT_DESC']); if (empty($payment_description)) {$payment_description = ''; $error = $error.'<li>Не введено примечание к платежу</li>';} // примечание к платежу Oplata_kursa_{номер}
      $pay_date =  date("Y-m-d H:i:s"); // дата отмены платежа

      $course_id = (int)$_POST['course_id']; if (empty($course_id)) {$course_id = 1; $error = $error.'<li>Не введён ID курса</li>';} // ID курса
      //$course_alias = trim($_POST['course_alias']); if (empty($course_alias)) {$course_alias = ''; $error = $error.'<li>Не введён алиас курса</li>';} // алиас курса
      //$course_title = trim($_POST['course_title']); if (empty($course_title)) {$course_title = ''; $error = $error.'<li>Не введено название курса</li>';} // название курса

      // есди ошибок нет, то обновляем статус заказа и проверяем хеши
      if (empty($error)) {
        // получаем информацию о заказе из базы данных
        $order = $this->Model->get_order($payment_no);

        if (!empty($order)) { // если выбранный заказ существует, то проверяем полученные данные и хеш
          // обновляем статус заказа - не оплачен/отменён

          $status = 2; // статус платежа: 0 - ожидает оплаты, 1 - оплачен, 2 - не оплачен, отменён
          $result = $this->Model->update_order_status($payment_no,$status,$pay_date);

          //redirect(D.S.'bill/fail'); // перенаправляем пользователя на страницу неудачной оплаты
          exit();
        }
      }
    }
    else {
      exit('Не переданы параметры');
    }
  }


  /**
   * Метод для генерации хеша, возвращает строку или false
   *
   * @return string
   */
  private function generate_lmi_hash($payment_no = null, $amount = null) {
    if ((empty($payment_no)) or (empty($amount))){return false;}
    //debug($payment_no);
    //debug($amount);
    $string = LMI_PAYEE_PURSE.
      number_format($amount, 2, '.', '').
      $payment_no.
      $_POST['LMI_MODE'].
      $_POST['LMI_SYS_INVS_NO'].
      $_POST['LMI_SYS_TRANS_NO'].
      $_POST['LMI_SYS_TRANS_DATE'].
      LMI_SECRET_KEY.
      $_POST['LMI_PAYER_PURSE'].
      $_POST['LMI_PAYER_WM'];
    return strtoupper(hash('SHA256',$string));
  }

  // функция для форматирования даты
  private function format_trans_date($string){
    // приходит строка YYYYMMDD HH:MM:SS
    // нужно преобразовать в YYYY-MM-DD HH:MM:SS
    $year = substr($string,0, 4); // вырезаем год - первые 4 цифры
    $month = substr($string,4, 2); // вырезаем месяц - 2 цифры после 4х
    $other = substr($string,6, 11); // вырезаем оставшиеся символы
    $new_string = $year.'-'.$month.'-'.$other; // собираем новую строку
    return $new_string;
  }


  public function okAction() {
    // echo 'BillController - метод okAction()<br>';

    $this->description = 'Оплата прошла успешно'; // Описание страницы
    $this->keywords = 'oплата, успешно, success, pay, ok'; // Ключевые слова
    $this->title = 'Оплата прошла успешно'; // Заголовок страницы

    $breadcrumbs = new Breadcrumbs(); // получение хлебных крошек
    $this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->title,$this->alias.'/ok');

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      //'page' => $this->page,
      //'balls' => $this->balls,
    ]);
  }

  public function failAction() {
    // echo 'BillController - метод failAction()<br>';

    $this->description = 'Оплата не произведена'; // Описание страницы
    $this->keywords = 'oплата, неудачно, fail, pay, error'; // Ключевые слова
    $this->title = 'Оплата не произведена'; // Заголовок страницы

    $breadcrumbs = new Breadcrumbs(); // получение хлебных крошек
    $this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->title,$this->alias.'/fail');

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      //'page' => $this->page,
      //'balls' => $this->balls,
    ]);
  }

  // метод принимающий данные из формы предварительного запроса и формы оповещения о платеже - адрес Result URL
  public function yoomoneyAction() {
    // получаем уведомление от Яндекса

    /*
operation_id = 904035776918098009
notification_type = p2p-incoming
datetime = 2014-04-28T16:31:28Z
sha1_hash = 8693ddf402fe5dcc4c4744d466cabada2628148c
sender = 41003188981230
codepro = false
currency = 643
amount = 0.99
withdraw_amount = 1.00
label = YM.label.12345
     */



  }

  // метод обработчик платежа (взято из документации)
  public function payeerAction() {
    // Отклоняем запросы с IP-адресов, которые не принадлежат Payeer
    if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189','149.202.17.210'))) return;

    if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
      $m_key = 'Ваш секретный ключ';

      // Формируем массив для генерации подписи
      $arHash = array(
        $_POST['m_operation_id'],
        $_POST['m_operation_ps'],
        $_POST['m_operation_date'],
        $_POST['m_operation_pay_date'],
        $_POST['m_shop'],
        $_POST['m_orderid'],
        $_POST['m_amount'],
        $_POST['m_curr'],
        $_POST['m_desc'],
        $_POST['m_status']
      );

      // Если были переданы дополнительные параметры, то добавляем их в массив
      if (isset($_POST['m_params'])) {
        $arHash[] = $_POST['m_params'];
      }

      //Добавляем в массив секретный ключ
      $arHash[] = $m_key;

      // Формируем подпись
      $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

      // Если подписи совпадают и статус платежа “Выполнен”
      if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {
        // Здесь можно пометить счет как оплаченный или зачислить денежные средства Вашему клиенту
        // Возвращаем, что платеж был успешно обработан
        ob_end_clean(); exit($_POST['m_orderid'].'|success');
      }
      // В противном случае возвращаем ошибку
      ob_end_clean(); exit($_POST['m_orderid'].'|error');
    }
  }

}