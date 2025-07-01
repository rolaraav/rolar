<?php
class SupportController extends Controller {

  public function actionIndex() {
    $this->render('/support/index');
  }

  public function actionNewTicket() {
    $model = new Ticket;

    if (isset($_POST['Ticket'])) {
      $model->attributes = $_POST['Ticket'];
      $model->id = '0';
      $model->message = str_replace('[QUOTE]', '', $model->message);
      $model->message = str_replace('[/QUOTE]', '', $model->message);

      if ($model->save()) {
        $needSaveAgain = FALSE;
        for ($i = 1; $i <= 4; $i++) {
          $nm = 'file'.$i;
          if (Settings::item('staffUploadOn')) {
            $model->$nm = CUploadedFile::getInstance($model, $nm);
            if ($model->$nm != NULL) {
              $fname = H::random_string('alnum', 64).'.'.$model->$nm->extensionName;
              $model->$nm->saveAs('./userfiles/'.$fname);
              $model->$nm = $fname;
              $needSaveAgain = TRUE;
            }
          }
          else {
            $model->$nm = '';
            $needSaveAgain = TRUE;
          }
        }

        if ($needSaveAgain) {
          $model->save();
        }

        if (Settings::item('supportLetter')) {
          $data = array('id' => $model->id, 'name' => $model->firstName, 'subject' => $model->subject,);
          Mail::letter('staff_new_ticket', $model->email, $model->firstName, $data);
        }

        $data = array('id' => $model->id, 'name' => $model->firstName, 'subject' => $model->subject, 'body' => $model->message, 'email' => $model->email,);
        Mail::letter('admin_new_ticket', $model->staff->email, $model->staff->firstName, $data);
        Yii::app()->user->setFlash('ticketId', $model->id);
        $this->redirect(array('support/okticket'));
      }
    }
    else {
      $model->priority_id = 2;
    }

    /*
    $dvwAoz90uJPogrSuA = $_SERVER['HTTP_HOST'];
    $EZxgBWW505Rngk0JA = substr(OM_LIC, 528, 16);
    $fJtKyoQPkgluVnGWy = md5($dvwAoz90uJPogrSuA.'414bfaa4f503d64cd5b62cd8db1f2fbb');
    $fJtKyoQPkgluVnGWy = md5($fJtKyoQPkgluVnGWy.$dvwAoz90uJPogrSuA.'0be24d317a189a14f870b32037e3798e');
    $fJtKyoQPkgluVnGWy = md5($fJtKyoQPkgluVnGWy.$dvwAoz90uJPogrSuA.'77591743e9070c77d7ee7ac39e6909c9');
    $fJtKyoQPkgluVnGWy = substr($fJtKyoQPkgluVnGWy, 0, 16);
    if ($fJtKyoQPkgluVnGWy !== $EZxgBWW505Rngk0JA) exit ();
    */

    $this->render('/support/newticket', array('model' => $model,));
  }

  public function actionOpenTicket() {
    $model = new FindTicket;

    if (isset($_POST['FindTicket'])) {
      $model->attributes = $_POST['FindTicket'];

      if ($model->validate()) {
        $ticket = $this->loadModel($model->id);
        $hash = Ticket::hashTicket($ticket->id);
        $this->redirect(array('/support/viewticket', 'ticket_id' => $ticket->id, 'hash' => $hash,));
      }
    }

    $this->render('/support/openticket', array('model' => $model));
  }

  public function actionOkTicket() {
    $data = array('ticketId' => Y::user()->getFlash('ticketId'),);

    if (empty($data['ticketId'])) {
      throw new CHttpException(403, Yii::t('ticket', 'Не указан ID тикета или форма была отправлена повторно - дважды тикет создан не будет'));
    }

    $data['ticketHash'] = Ticket::hashTicket($data['ticketId']);
    $this->render('/support/okticket', $data);

    /*
    $bDHW3zvjNQQeX0b9Q = parse_url(Yii::app()->getBaseUrl(TRUE));
    $bDHW3zvjNQQeX0b9Q = $bDHW3zvjNQQeX0b9Q['host'];
    $CBfXedRPplHpMkxnV = substr(OM_LIC, 544, 16);
    $brqZ54VwxKUwOmkic = md5($bDHW3zvjNQQeX0b9Q.'d83951e2053091d33344cbf7cc82c56f');
    $brqZ54VwxKUwOmkic = md5($brqZ54VwxKUwOmkic.$bDHW3zvjNQQeX0b9Q.'ce07e9ffd6465a58cd582ba39e48a797');
    $brqZ54VwxKUwOmkic = md5($brqZ54VwxKUwOmkic.$bDHW3zvjNQQeX0b9Q.'8bf6134c7f8481952b1a16594c6e6e21');
    $brqZ54VwxKUwOmkic = substr($brqZ54VwxKUwOmkic, 0, 16);
    if ($brqZ54VwxKUwOmkic !== $CBfXedRPplHpMkxnV) exit ();
    */
  }

  public function actionViewTicket($ticket_id = FALSE, $hash = FALSE) {
    if (!preg_match('/^[a-z0-9]{12}$/', $ticket_id) OR (!preg_match('/^[a-z0-9]{32}$/', $hash))) {
      throw new CHttpException(403, 'Wrong or error ticket view URL');
    }

    if (Ticket::hashTicket($ticket_id) !== $hash) {
      throw new CHttpException(403, 'Ticket Hash error');
    }

    $answer = new TicketAnswer ();

    if (isset($_POST['TicketAnswer'])) {
      $ticket = $this->loadModel($ticket_id);
      $answer->attributes = $_POST['TicketAnswer'];
      $answer->id = 0;
      $answer->ticket_id = $ticket_id;
      $answer->staff_id = $ticket->staff_id;
      $answer->kind = 'you';
      $answer->message = str_replace('[QUOTE]', '', $answer->message);
      $answer->message = str_replace('[/QUOTE]', '', $answer->message);

      if ($answer->save()) {
        $ticket->open();
        $needSaveAgain = FALSE;
        for ($i = 1; $i <= 2; $i++) {
          $nm = 'file'.$i;
          if (Settings::item('staffUploadOn')) {
            $answer->$nm = CUploadedFile::getInstance($answer, $nm);
            if ($answer->$nm != NULL) {
              $fname = H::random_string('alnum', 64).'.'.$answer->$nm->extensionName;
              $answer->$nm->saveAs('./userfiles/'.$fname);
              $answer->$nm = $fname;
              $needSaveAgain = TRUE;
            }
          }
          else {
            $answer->$nm = '';
            $needSaveAgain = TRUE;
          }
        }

        if ($needSaveAgain) {
          $answer->save(FALSE);
        }

        $data = array('id' => $ticket->id, 'name' => $ticket->firstName, 'subject' => $ticket->subject, 'body' => $answer->message, 'email' => $ticket->email,);
        Mail::letter('admin_modify_ticket', $ticket->staff->email, $ticket->staff->firstName, $data);
        Y::user()->setFlash('ticket', Yii::t('answer', 'Новый ответ добавлен'));
        $this->redirect(array('/support/viewticket', 'ticket_id' => $ticket_id, 'hash' => $hash,));
      }
    }

    /*
    $Ezixccgkd6cGHrG7c = parse_url(Y::bu());
    $Ezixccgkd6cGHrG7c = $Ezixccgkd6cGHrG7c['host'];
    $BlyTYUOdv2NpduWN4 = substr(OM_LIC, 560, 16);
    $ctu68Y7Jv8xImqSPb = md5($Ezixccgkd6cGHrG7c.'fd27d3e7a8f95fcd08f7de19952a55a7');
    $ctu68Y7Jv8xImqSPb = md5($ctu68Y7Jv8xImqSPb.$Ezixccgkd6cGHrG7c.'b1868215bde2ee4f8f543e7c09430926');
    $ctu68Y7Jv8xImqSPb = md5($ctu68Y7Jv8xImqSPb.$Ezixccgkd6cGHrG7c.'9fcdbe053ec7d7ce7b1475f7999d8fde');
    $ctu68Y7Jv8xImqSPb = substr($ctu68Y7Jv8xImqSPb, 0, 16);
    if ($ctu68Y7Jv8xImqSPb !== $BlyTYUOdv2NpduWN4) exit ();
    */

    $this->render('/support/viewticket', array('model' => $this->loadModel($ticket_id), 'answer' => $answer, 'ticketHash' => $hash,));
  }

  public function actionCloseTicket($ticket_id = FALSE, $hash = FALSE) {
    if (!preg_match('/^[a-z0-9]{12}$/', $ticket_id) OR (!preg_match('/^[a-z0-9]{32}$/', $hash))) {
      throw new CHttpException(403, 'Wrong or error ticket view URL');
    }

    if (Ticket::hashTicket($ticket_id) !== $hash) {
      throw new CHttpException(403, 'Ticket Hash error');
    }

    $ticket = $this->loadModel($ticket_id);
    $ticket->close();

    $this->redirect(array('/support/viewticket', 'ticket_id' => $ticket_id, 'hash' => $hash,));
  }

  public function actionBase($category = FALSE) {
    if ($category === FALSE) {
      $categories = $models = ArticleCategory::model()->findAll(array('order' => 'position',));
      $this->render('/support/base', array('categories' => $categories,));
      return TRUE;
    }

    if (!is_numeric($category)) {
      throw new CHttpException(404, 'Не найдена категория');
    }

    $model = $this->loadCategory($category);

    /*
    $D4zezU4JIA4AypcNn = parse_url(Yii::app()->getBaseUrl(TRUE));
    $D4zezU4JIA4AypcNn = $D4zezU4JIA4AypcNn['host'];
    $FmpkFa0Lfelq3aBMu = substr(OM_LIC, 512, 16);
    $BL9tUwsC4qUrHie0D = md5($D4zezU4JIA4AypcNn.'eewe00ac2cc3a1109e1c5e056424d2a4');
    $BL9tUwsC4qUrHie0D = md5($BL9tUwsC4qUrHie0D.$D4zezU4JIA4AypcNn.'10dac73c46ce7afd716484e3b49fac04');
    $BL9tUwsC4qUrHie0D = md5($BL9tUwsC4qUrHie0D.$D4zezU4JIA4AypcNn.'66538a77278e9b1718321c16826bc5fd');
    $BL9tUwsC4qUrHie0D = substr($BL9tUwsC4qUrHie0D, 0, 16);
    if ($BL9tUwsC4qUrHie0D !== $FmpkFa0Lfelq3aBMu) die ();
    */

    $this->render('/support/category', array('model' => $model,));
  }

  public function actionArticle($id = FALSE) {
    if (!is_numeric($id)) {
      throw new CHttpException(404, 'Не найдена статья');
    }

    $model = $this->loadArticle($id);

    if (!$model->visible)
      die ('Извините, но данная статья временно скрыта');

    $this->render('/support/article', array('model' => $model,));
  }

  public function init() {
    parent::init();
    $this->layout = '//layouts/support';
  }

  public function actions() {
    return array('captcha' => array('class' => 'MyCCaptchaAction', 'backColor' => 0xFFFFFF,),);
  }

  public function loadModel($id) {
    $model = Ticket::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Тикета с таким ID не существует.');
    return $model;
  }

  public function loadCategory($id) {
    $model = ArticleCategory::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Категории с таким ID не существует.');
    return $model;
  }

  public function loadArticle($id) {
    $model = Article::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Статьи с таким ID не существует.');
    return $model;
  }

  public function beforeAction($action) {
    switch (strtolower($action->id)) {
      case 'index':
      case 'viewticket':
      case 'closeticket':
      case 'newticket':
      case 'okticket':
      case 'openticket':
        if (Settings::item('staffOn') == FALSE) {
          throw new CHttpException(404, 'Служба поддержки отключена.');
        }
        break;
      case 'base':
      case 'article':
        if (Settings::item('staffBaseOn') == FALSE) {
          throw new CHttpException(404, 'База знаний отключена.');
        }
    }
    return parent::beforeAction($action);
  }
}