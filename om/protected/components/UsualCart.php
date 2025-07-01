<?php

/**
 * Компонент обычной корзины
 *
 */


class UsualCart {


	public static function addGood ($id) {

		$all = Yii::app()->session->get ('thecart');

		//Добавляем товар
		$gd = new Good ();
		$gd = $gd->find (array(
			'condition' => 'id=:id',
			'params'	=> array (':id' => $id),
		));

		if ($gd == NULL) {
			throw new CHttpException(404, 'Такого товара не существует');
		}

		//Добавляем сведения
		$data = array ();
		$data['id'] = $gd->id;
		$data['title'] = $gd->title;
		$data['price'] = $gd->price;
                $data['kind'] = $gd->kind;
		$data['currency'] = $gd->currency;
		$rurcena = Valuta::conv($data['price'],$data['currency']);
		$data['rurcena'] = $rurcena['rur'];
		$data['token'] = rand (11111111,99999999);

		$all[] = $data;

		Yii::app()->session['thecart'] = $all;

	}

	public static function listGoods ()
	{
		$all = Yii::app()->session->get ('thecart');
		$cooks = count ($all);

		if ($cooks > 0 && $cooks < 10000) {

			return $all;

		} else {
			return FALSE;
		}

	}

	public static function delGood ($id, $token) {

		$all = Yii::app()->session->get ('thecart');

		if (empty ($all)) {

			return FALSE;

		}

		$ok = array();

		foreach ($all as $one){
			if (($one['id']==$id) AND ($token==$one['token']))
				continue;

			$ok[] = $one;
		}

		if ((count($all)>1) AND (count($ok)==0)) {
			return FALSE;
		}

		Yii::app()->session['thecart'] = $ok;
	}

	public static function emptyCart ()
	{
		Yii::app()->session['thecart'] = array ();
	}

        /*
         * Функция для проверки есть ли физические товары
         */
        public static function checkKind () {
            $goods = self::listGoods();
            $kind = 'ebook';

            foreach ($goods as $good) {
                if ($good['kind'] == 'disk') {
                    $kind = 'disk';
                    break;
                }
            }
            return $kind;
        }


}

?>