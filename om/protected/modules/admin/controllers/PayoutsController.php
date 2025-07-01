<?php

class PayoutsController extends Controller
{
        //Права доступа
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user actions
				'users'=>array('@'),
				'actions' => StaffAccess::allowed('payout'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionPok($id,$way)
	{
            //Готовим выплату

            $p = Partner::model()->findByPk ($id);
            
            if (!$p) die ('Партнёр не найден');
            
            //Проверяем - нужна ли выплата
            if ($p->total==$p->paid) die ('Выплата уже была подтверждена ранее');
            
            $sum = $p->total-$p->paid;
            
            //{KG}
            //Сохраняем выплату
            $p->notify = TRUE;
            $p->paid = $p->total;
            $p->save (FALSE);
            
            //Запись в историю выплат
            $ps = new Payout;
            $ps->kind = 'partner';
            $ps->date = time ();
            $ps->theid = $id;
            $ps->way = $way;
            $ps->sum = $sum;
            $ps->rekv = $p->{$way};
            $ps->valuta = 'rur';
            $ps->save (FALSE);
            
            //Отправляем письмо с уведомлением
            $d = array (
                'refid' => $p->id,
                'sum' => $sum,
                'way' => Lookup::item ('Purse',$way),
                'purse' => $p->$way,
            );
            
            Mail::letter ('aff_payout',$p->email,$p->firstName,$d);
            
            //Устанавливаем статус и редирект на список комиссионных
            Log::add ('paypartner','Выплачено партнёру '.$p->id.' сумму '.$sum.' руб. на кошелёк '.$way.' способом '.Lookup::item ('Purse',$way),true);
            Y::user()->setFlash ('admin','Уведомление о выплате отправлено');
            $this->redirect(array('payouts/index'));
            
            
	}

	public function actionIndex()
	{
            	$model=new Payouta('search');
                $amodel=new Payoutb('search');

                //{KG}
		$this->render('index',array(
			'model'=>$model,
                        'amodel' => $amodel,
		));
	}

	public function actionView($id)
	{
            $p = Partner::model()->findByPk ($id);
            
            if (!$p) die ('Партнёр не найден');
            
            $sum = $p->total-$p->paid;
            $val = Valuta::conv ($sum,'rur');
            if ($sum==0) die ('Выплата уже сделана ранее');
            
            $this->render('view', array (
                'p' => $p,
                'sum' => $sum,
                'usd' => $val['usd'],
            ));
	}
        
	public function actionAview($id)
	{
            $p = Author::model()->findByPk ($id);
            
            if (!$p) die ('Автор не найден');
            
            $sum = $p->total-$p->paid;
            $val = Valuta::conv ($sum,'rur');
            if ($sum==0) die ('Выплата уже сделана ранее');
            
            
           //{KG}
            $this->render('aview', array (
                'p' => $p,
                'sum' => $sum,
                'usd' => $val['usd'],
            ));                        
            
	}        
        
        public function actionAok ($id,$way) {
            
            //Готовим выплату автору

            $p = Author::model()->findByPk ($id);
            
            if (!$p) die ('Автор не найден');
            
            //Проверяем - нужна ли выплата
            if ($p->total==$p->paid) die ('Выплата уже была подтверждена ранее');
            
            $sum = $p->total-$p->paid;
            
            //Сохраняем выплату            
            $p->paid = $p->total;
            $p->save (FALSE);
            
            //Запись в историю выплат
            $ps = new Payout;
            $ps->kind = 'author';
            $ps->date = time ();
            $ps->theid = $id;
            $ps->way = $way;
            $ps->sum = $sum;
            $ps->valuta = 'rur';
            $ps->rekv = $p->purse;
            $ps->save (FALSE);            
            
            //{KG}
            //Отправляем письмо с уведомлением
            $d = array (
                'id' => $p->id,
                'sum' => $sum,
                'way' => Lookup::item ('Purse',$way),
                'purse' => $p->purse,
            );
            
            Mail::letter ('author_payout',$p->email,$p->uname,$d);
            
            Log::add ('payauthor','Выплачено автору '.$p->id.' сумму '.$sum.' руб. на кошелёк '.$way.' способом '.Lookup::item ('Purse',$way),true);
            //Устанавливаем статус и редирект на список комиссионных
            Y::user()->setFlash ('admin','Уведомление о выплате отправлено');
            $this->redirect(array('payouts/index'));
            
            
        }
        

}