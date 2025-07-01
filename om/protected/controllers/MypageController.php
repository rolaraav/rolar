<?php
class MypageController extends Controller {

  public function actionIndex($id) {

    if (!preg_match('/[0-9a-z_]+/', $id))
      die ('Page url error');

    $p = Page::model()->find(array('condition' => 'psevdo = :psevdo', 'params' => array(':psevdo' => $id,),));

    if (!$p)
      die ('Page not found');

    if (!$p->visible)
      die ('Извините, но эта страничка недоступна к просмотру в данное время');

    /*
    $EoyNoDjiR7SRe4ePy = OM_LIC_HOST;
    $EbLkUhpVtjzkjw3EG = substr(OM_LIC, 320, 16);
    $fid6EdT8fUIxRjj1N = md5($EoyNoDjiR7SRe4ePy.'85b8de2d7a1cfd9a513bf1a1d31b702a');
    $fid6EdT8fUIxRjj1N = md5($fid6EdT8fUIxRjj1N.$EoyNoDjiR7SRe4ePy.'002f7c424973877577f098c88ac9ee64');
    $fid6EdT8fUIxRjj1N = md5($fid6EdT8fUIxRjj1N.$EoyNoDjiR7SRe4ePy.'19fc3787f8b39e2debdbaf058c3c351e');
    $fid6EdT8fUIxRjj1N = substr($fid6EdT8fUIxRjj1N, 0, 16);
    if ($fid6EdT8fUIxRjj1N !== $EbLkUhpVtjzkjw3EG) die ();
    */

    $this->layout = '//layouts/mypage';

    if (strpos($p->title, '||') !== false) {

      $title2 = explode('||', $p->title);
      $p->title = trim($title2[0]);
      $name = trim($title2[1]);

      if (preg_match('/^[a-z0-9A-Z]{1,100}$/', $name)) {
        $this->layout = '//layouts/'.$name;
      }

    }

    $this->pageTitle = $p->title;

    $this->render('/main/mpage', array('data' => $p->content));
  }

}