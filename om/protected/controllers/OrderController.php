<?php

class OrderController extends Controller
{
	public function actionCart($n = FALSE)
	{

            if (!$n) {
                die ('Bad number');
            }

            $data = TheOrder::listData ($n);

            $goods = $data['goods'];                        
            
            $first = reset ($goods);
            
            if (empty ($first->cartOn)) die ('Cart Disabled');
            if (empty ($first->cartGoods)) die ('No goods');
            
            //Получаем список товаров, которые предлагаются для корзины
            $cartGoods = explode (',',$first->cartGoods);            
            
            $gl = array ();
            foreach ($cartGoods as $one) {
                $gl[] = $this->loadGood (trim ($one));
            }           
            

            if ($_POST) {
                if (isset ($_POST['goods'])) {
                    
                    //Добавляем заказы
                    $gg = $_POST['goods'];
                    
                    foreach ($gg as $one) {
                        if (!preg_match ('/^[a-z0-9_]{1,100}$/',$one)) {
                            die ('Неверный формат ID');
                        }                        
                        
                        $gd = $this->loadGood($one);
                        
                        //Делаем подмену цены - если есть назначение
                        $np = Special::check($first->id, $gd->id);
            
                        if (!empty ($np)) {
                            $gd->price = $np['sum'];
                            $gd->currency = $np['valuta'];
                        } else {

                            //Иначе скидку по карте
                            if ($first->cartMinus>0) {
                                $gd->price = $gd->price-(ceil($gd->price*$first->cartMinus/100)); //Цена с учётом скидки               
                            }
                            
                        }
             
                        TheOrder::addGood ($n,$gd);                 
                    }
                
                }
                    //Переходим на total - просмотр содержимого корзины
                    $this->redirect (array ('order/total','n'=>$n));
                    
                
            }
            
            
            $this->render('cart', array (
                'tgood' => $first,
                'cartGoods' => $cartGoods,
                'gl' => $gl,
            ),FALSE,'order_cart/'.$first->id);
	}

        /*
         * Функция - начало оформления заказа на товар
         */
	public function actionIndex($id = FALSE, $c = '')
	{
            if (!$id) {
                die ('Не передан ID товара');
            }

            //Выбить если не правильный ID
            if (!preg_match ('/^[a-z0-9_]{1,50}$/',$id)) {
            	die ('Неверный формат ID');
            }
            
            $cupon = '';
            if (!empty ($c)) {
               $cc = $c;
               if (preg_match ('/[a-zA-Z0-9_]/',$cc)) {
                   $cupon = $cc;
               }
            }


            $good = $this->loadGood ($id);
            
            //Если товар отключён
            
            if ($good->used!=1) {
                die (Yii::t('order','Извините, но данный товар отключён'));
            }

            $model = new Bill;
            $model->disk = ($good->kind == 'disk');

            if (isset ($_POST['Bill'])) {
                
                //Оставляем только разрешённые поля
                $model->unsetAttributes ();
                $bbb = $_POST['Bill'];
                $ballow = array ('email','uname','amail','cupon','surname','otchestvo','strana','gorod','region','street','comment','phone','postindex','address');
                
                foreach ($bbb as $bbkey=>$one) {
                    if (!in_array ($bbkey,$ballow)) {
                        unset ($bbb[$bbkey]);
                    }
                }
                


		if (isset ($bbb['cupon'])) {
			$bbb['cupon'] = trim ($bbb['cupon']);
			if (!empty ($bbb['cupon']))
			{
				$ccp = Cupon::model ()->find (
		                            array (
		                                'condition' => 'code = :code',
		                                'params' => array (
		                                    ':code' => $bbb['cupon'],
                		                )
		                            )
				);
				if (!$ccp) $bbb['cupon'] = '';
			}
		}


                //{KG}

                $model->attributes = $bbb;
                if ($model->validate ()) {
                    
                    $model->ip = CHttpRequest::getUserHostAddress();
                    
                    if (Black::checkin ($model->ip,$model->phone, $model->email, $model->strana, $model->gorod, $model->address) == TRUE) {
                        die ('Извините, но Вы не можете выписать счёт, так как ваши данные по какой-то причине запрещены администратором.<br> Попробуйте связаться с продавцом, сообщите ему введённые данные и Ваш IP: '.$model->ip);
                    }
                    
                    //Проверка на наличие в базе клиентов
                    if (!empty ($good->needid)) {
                        
                        $c = Client::model ()->find (
                            array (
                                'condition' => 'good_id = :id AND email = :email',
                                'params' => array (
                                    ':id' => $good->needid,
                                    ':email' => $model->email,
                                )
                            )
                        );
                        
                        if (!$c) {
                            die ('Извините, но Вы не можете заказать данный товар, т.к. он доступен к заказу только для тех, кто купил ранее другой, заданный администратором товар, - на указанный Вами e-mail');
                        }
                        
                    }

                    //Создаём заказ
                    $n = TheOrder::makeOrder ($model, $good);

                    //Если нет промежуточных шагов - выписываем счёт
                    if (!$good->stepOk ()) {
                         
                        //Редирект на последний этап
                        $this->redirect (array ('order/ok','n'=>$n));

                    }

                    //Проверяем есть ли апселл 1
                    if ($good->upsellOn) {
                        $this->redirect (array ('order/special1','n'=>$n));
                    }

                    //Проверяем есть ли апселл 2
                    if ($good->tupsellOn) {
                        $this->redirect (array ('order/special2','n'=>$n));
                    }


                    //Проверяем есть ли Корзина
                    if ($good->cartOn) {
                        $this->redirect (array ('order/cart','n'=>$n));
                    }

                    //Если ничего нет - то на последний этап
                    $this->redirect (array ('order/ok','n'=>$n));

                }

            }
            
            $oldprice = 0;

            if (!empty ($cupon)) {
                
                if (Cupon::valid ($model->cupon,$model->email)!='') {
                    $np = Cupon::goodCena($cupon, $good);
                }
                
                if (($np>0) and ($np!=$good->price)) {
                    $oldprice = $good->price;
                    $good->price = $np;
                    $model->cupon = $cupon;
                } else {
                    $cupon = '';
                }
            }

            $this->render('index', array(
                'model' => $model,
                'good'  => $good,
                'kind'  => $good->kind,
                'cupon' => $cupon,
                'oldprice' => $oldprice,
            ),FALSE,'order_form/'.$good->id);
	}

        /*
         * Получаем окончательный список товаров и формируем счета
         */
	public function actionOk($n = FALSE)
	{
            if (!$n) {
                die ('Bad number');
            }

            $data = TheOrder::listData ($n);

            $goods = $data['goods'];            

            //Формируем вначале счёт
            $bill = $data['bill'];

            $bill->id = NULL;
            $bill->isNewRecord = TRUE;  //Новая запись
            
            //{KG}

            $bill->createDate = time ();
            $bill->payDate = 0;
            $bill->status_id = Bill::BILL_WAITING;
            $bill->ip = Yii::app()->request->userHostAddress;
            $bill->way = '';
            $bill->kind = $goods[0]->kind;
            $bill->orderCount = count ($goods);
            $bill->postNumber = '';

            //Курсы валют
            $bill->usdkurs = Settings::item('kursUsd');
            $bill->eurkurs = Settings::item('kursEur');
            $bill->uahkurs = Settings::item('kursUah');


            if (count($goods)>1) {

                //Сумма
                $bill->valuta = 'rur';

                //Делаем подсчёт
                $total = 0;
                foreach ($goods as $one) {
                    $total += $one->rurcena;
                }

                $bill->sum = $total;


            } else {
                
                $bill->valuta = $goods[0]->currency;
                if ($goods[0]->newprice == 0) $goods[0]->newprice = $goods[0]->price;
                $bill->sum = $goods[0]->newprice;
            }

            //Сохраняем новый счёт
            if (!$bill->save ()) {
                Yii::app()->session->destroy ();
                throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании счёта. Пожалуйста, выпишите новый.');
            }

            $ord = new Order;

            //Формируем заказы и сохраняем
            foreach ($goods as $good) {

                if ($good->newprice == 0)
                {
                    $good->newprice = $good->price;
                }

                $ord->id = NULL;
                $ord->isNewRecord = TRUE;
                $ord->bill_id = $bill->id;
                $ord->good_id = $good->id;
                $ord->createDate = $bill->createDate;                
                $ord->cena = $good->newprice+0;
                $ord->valuta = $good->currency;
                $ord->status_id = $bill->status_id;

                if (!$ord->save ()) {
                    Yii::app()->session->destroy ();
                    throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании заказа. Пожалуйста, сделайте новый заказ');
                }

                Yii::app()->session['order_'.$n] = FALSE;

            }
            //Готовим данные для отправки
            $data = array (
		          'bill_id'   => $bill->id,
		          'sum'       => H::mysum($bill->sum).H::valuta($bill->valuta),
                  'status_link' => Y::bu().'status/index/b/'.$bill->id.'/c/'.Bill::statusCrc ($bill->id),
                  'pay_link' => Y::bu().'bill/index?bill_id='.$bill->id.'&hash='.Bill::hashBill($bill->id),
                  'cancel_link' => Y::bu().'bill/cancel?bill_id='.$bill->id.'&hash='.Bill::hashBill($bill->id),
            );
            
            Mail::letter ('bill_new',$bill->email,$bill->uname,$data);
            
            //{KG}

            $st = (($goods[0]->cartOn == 1) OR ($goods[0]->tupsellOn == 1) OR ($goods[0]->upsellOn == 1))?1:0;
            
            //После того, как счёт выписан - переадресация на его оплату
            if ($st) {
                $this->redirect (array('bill/index','bill_id' => $bill->id, 'hash' => Bill::hashBill($bill->id),'st' => 1));    
            } else {
                $this->redirect (array('bill/index','bill_id' => $bill->id, 'hash' => Bill::hashBill($bill->id)));    
            }
            
            

	}

	public function actionSpecial1($n = FALSE)
	{            
            if (!$n) {
                die ('Bad number');
            }

            $data = TheOrder::listData ($n);           
            

            $goods = $data['goods'];                        
            
            $first = reset ($goods);
            
            if (empty ($first->upsellOn)) die ('Bad action');
            
            $agood = $this->loadGood ($first->upsellGood);
            
            //Делаем подмену цены - если есть назначение
            $np = Special::check($first->id, $agood->id);
            //{KG}
            
            if (!empty ($np)) {
                $agood->price = $np['sum'];
                $agood->currency = $np['valuta'];
            }
            
            
            if ($_POST) {
                
                //Если согласен
                if (isset ($_POST['submit_ok'])) {
                    TheOrder::addGood ($n,$agood);
                }
                
                    //Проверяем есть ли апселл 2
                    if ($first->tupsellOn) {
                        $this->redirect (array ('order/special2','n'=>$n));
                    }


                    //Проверяем есть ли Корзина
                    if ($first->cartOn) {
                        $this->redirect (array ('order/cart','n'=>$n));
                    }

                    //Если ничего нет - то на последний этап
                    $this->redirect (array ('order/ok','n'=>$n));                
                
            }
            
            
           
            $this->render('special1',array(
                
                'good' => $first,
                'agood' => $agood,
                
            ),FALSE,'order_upsell/'.$first->id);
	}

	public function actionSpecial2($n = FALSE)
	{            
            if (!$n) {
                die ('Bad number');
            }

            $data = TheOrder::listData ($n);           
            

            $goods = $data['goods'];                        
            
            $first = reset ($goods);
            
            if (empty ($first->tupsellOn)) die ('Bad action');
            
            $agood = $this->loadGood ($first->tupsellGood);
            
            //Делаем подмену цены - если есть назначение
            $np = Special::check($first->id, $agood->id);
            //{KG}
            
            if (!empty ($np)) {
                $agood->price = $np['sum'];
                $agood->currency = $np['valuta'];
            }            
            
            
            if ($_POST) {
                
                //Если согласен
                if (isset ($_POST['submit_ok'])) {
                    TheOrder::addGood ($n,$agood);
                }                

                    //Проверяем есть ли Корзина
                    if ($first->cartOn) {
                        $this->redirect (array ('order/cart','n'=>$n));
                    }

                    //Если ничего нет - то на последний этап
                    $this->redirect (array ('order/ok','n'=>$n));
                
            }
            
            
           
            $this->render('special2',array(
                
                'good' => $first,
                'agood' => $agood,
                
            ),FALSE,'order_tupsell/'.$first->id);
	}

	public function actionTotal($n = FALSE)
	{
            if (!$n) {
                die ('Bad number');
            }

            $data = TheOrder::listData ($n);

            $goods = $data['goods'];
            
            $first = reset ($goods);
            
            if ($_POST) {
                $this->redirect (array ('order/ok','n'=>$n));
            }
            //{KG}
            
            $this->render('total', array (
                'tgood' => $first,                
                'goods' => $goods,
            ),FALSE,'order_total/'.$first->id);
	}

	public function loadGood($id)
	{
		$model=Good::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Товара с таким ID не существует.');
		return $model;
	}


}