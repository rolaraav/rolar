<?php
class SupportController extends Controller {
  public $layout = '/layouts/main';

  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed('support'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $this->autoClose();
    $answer = new TicketAnswer ();
    $model = $this->loadModel($id);
    if (Settings::item('staffFullAccess') != 1) {
      if ((Y::user()->id > 1) AND (Y::user()->id <> $model->staff_id)) {
        Y::user()->setFlash('admin', Yii::t('admin', 'У Вас нет прав на просмотр этого тикета, т.к. Вы не владелец'));
        $this->redirect(array('support/index'));
      }
    }
    if (!empty ($model->answers)) {
      $last = end($model->answers);
    } else {
      $last = $model;
    }
    $answer->message = Yii::t('admin', 'Здравствуйте, ').$model->firstName.".\r\n\r\n".'[QUOTE]'.$last->message.'[/QUOTE]';
    $this->render('view', array(
      'model' => $model,
      'answer' => $answer,
    ));
  }

  public function actionDelete($id, $a = FALSE) {
    if ($a) {
      $a = TicketAnswer::model()->findByPk($id);
      if ($a) {
        $tid = $a->ticket_id;
        if (!empty ($a->file1)) {
          $fn = './userfiles/'.$a->file1;
          if (file_exists($fn)) {
            unlink($fn);
          }
        }
        if (!empty ($a->file2)) {
          $fn = './userfiles/'.$a->file2;
          if (file_exists($fn)) {
            unlink($fn);
          }
        }
        $a->delete();
        Y::user()->setFlash('admin', Yii::t('admin', 'Ответ удален'));
        $this->redirect(array('view', 'id' => $tid));
      } else {
        die ('Answer does not exists');
      }
      return TRUE;
    }
    if (Yii::app()->request->isPostRequest) {
      $model = $this->loadModel($id);
      $answers = $model->answers;
      foreach ($answers as $answ) {
        if (!empty ($answ->file1)) {
          $fn = './userfiles/'.$answ->file1;
          if (file_exists($fn)) {
            unlink($fn);
          }
        }
        if (!empty ($answ->file2)) {
          $fn = './userfiles/'.$answ->file2;
          if (file_exists($fn)) {
            unlink($fn);
          }
        }
        $answ->delete();
      }
      for ($i = 1; $i <= 4; $i++) {
        $fld = 'file'.$i;
        if (!empty ($model->$fld)) {
          $fn = './userfiles/'.$model->$fld;
          if (file_exists($fn)) {
            unlink($fn);
          }
        }
      }
      $model->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', Yii::t('admin', 'Запись удалена'));
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionTickets($id) {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $this->autoClose();
    $allowed = StaffAccess::allowed('departaments');
    if (!empty ($allowed)) {
      if (!in_array($id, $allowed)) {
        throw new CHttpException(403, 'Извините, но доступ к этому отделу Вам запрещён.');
      }
    }
    $model = new Ticket('search');
    $model->unsetAttributes();
    if (isset($_GET['Ticket'])) {
      $model->attributes = $_GET['Ticket'];
    } else {
    }
    $model->section_id = $id;
    if (Settings::item('staffFullAccess') != 1) {
      if (Y::user()->id != 1) {
        $model->staff_id = Y::user()->id;
      }
    }
    $this->render('tickets', array(
      'model' => $model,
    ));
  }

  public function actionIndex() {
    $dataProvider = new CActiveDataProvider('TicketSection', array(
      'sort' => array(
        'defaultOrder' => 'position ASC',
      ),
    ));
    $this->render('index', array(
      'dataProvider' => $dataProvider,
    ));
  }

  public function actionUpdate($id) {
    if (!isset ($_POST['Ticket'])) {
      throw new CHttpException(404, 'Не переданы данные');
    }
    $model = $this->loadModel($id);
    $tdata = $_POST['Ticket'];
    if (Settings::item('staffFullAccess') != 1) {
      if ((Y::user()->id > 1) AND (Y::user()->id <> $model->staff_id)) {
        Y::user()->setFlash('admin', Yii::t('answer', 'У Вас нет прав на изменение этого тикета, т.к. Вы не владелец'));
        $this->redirect(array('support/index'));
      }
    }
    if (isset ($tdata['section_id'])) {
      $model->section_id = $tdata['section_id'];
    }
    $model->status_id = $tdata['status_id'];
    $model->staff_id = $tdata['staff_id'];
    $model->priority_id = $tdata['priority_id'];
    $model->save(FALSE, array('status_id', 'priority_id', 'staff_id', 'section_id'));
    Y::user()->setFlash('admin', 'Данные тикета изменены');
    $this->redirect(array('view', 'id' => $id));
  }

  public function actionAnswer($id) {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $answer = new TicketAnswer ();
    if (isset($_POST['TicketAnswer'])) {
      if (empty($_POST['TicketAnswer']['message'])) {
        throw new CHttpException(404, 'Нужно ввести ответ');
      }
      $answer->attributes = $_POST['TicketAnswer'];
      $answer->id = 0;
      $answer->ticket_id = $id;
      $answer->staff_id = Y::user()->id;
      $answer->kind = 'staff';
      $ticket = $this->loadModel($id);
      if (Settings::item('staffFullAccess') != 1) {
        if ((Y::user()->id > 1) AND (Y::user()->id <> $ticket->staff_id)) {
          Y::user()->setFlash('admin', Yii::t('answer', 'У Вас нет прав на изменение этого тикета, т.к. Вы не владелец'));
          $this->redirect(array('support/index'));
        }
      }
      if ($answer->save(FALSE)) {
        $ticket->open();
        $ticket->status_id = $answer->status_id;
        $ticket->save(FALSE);
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
          } else {
            $answer->$nm = '';
            $needSaveAgain = TRUE;
          }
        }
        if ($needSaveAgain) {
          $answer->save(FALSE);
        }
        $data = array(
          'id' => $ticket->id,
          'name' => $ticket->firstName,
          'subject' => $ticket->subject,
          'link' => Yii::app()->getBaseUrl(TRUE).'/support/viewticket?ticket_id='.$ticket->id.'&hash='.Ticket::hashTicket($ticket->id),
        );
        Mail::letter('staff_answer', $ticket->email, $ticket->firstName, $data);
        Y::user()->setFlash('admin', Yii::t('answer', 'Новый ответ добавлен'));
        $this->redirect(array('view', 'id' => $id));
      }
    } else {
      throw new CHttpException(404, 'Не переданы данные.');
    }
  }

  public function loadModel($id) {
    $model = Ticket::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  private function autoClose() {
    if (Settings::item('staffAutoClose') == 0) {
      return FALSE;
    }
    $rdate = time() - 3600 * (Settings::item('staffAutoClose'));
    $t = Ticket::model()->findAll(array(
      'condition' => 'status_id = 2 AND updateTime < :date',
      'params' => array(
        ':date' => $rdate,
      ),
    ));
    foreach ($t as $one) {
      $one->close();
    }
  }
}