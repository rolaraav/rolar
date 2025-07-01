<?php

/**
 * Класс для конвертации валют
 *
 */

class Valuta {

	/**
	 * Выдаёт массив с валютами
	 */
	public static function conv ($cena, $valuta, $usdkurs = false, $eurkurs = false, $uahkurs = false) {

		$v = array ();

		if (!$usdkurs) {
			$usdkurs = Settings::item ('kursUsd');
		}

		if (!$eurkurs) {
			$eurkurs = Settings::item ('kursEur');
		}

		if (!$uahkurs) {
			$uahkurs = Settings::item ('kursUah');
		}


		//Начинаем отбор по типу валюту
		switch ($valuta) {

			case 'rur':

				$v['rur'] = $cena;
				$v['usd'] = round ($v['rur']/$usdkurs,2);
				$v['eur'] = round ($v['rur']/$eurkurs,2);
				$v['uah'] = round ($v['rur']/$uahkurs,2);

				break;

			case 'usd':

				$v['usd'] = $cena;
				$v['rur'] = round ($v['usd']*$usdkurs,2);
				$v['eur'] = round ($v['rur']/$eurkurs,2);
				$v['uah'] = round ($v['rur']/$uahkurs,2);

				break;


			case 'eur':

				$v['eur'] = $cena;
				$v['rur'] = round ($v['eur']*$eurkurs,2);
				$v['usd'] = round ($v['rur']/$usdkurs,2);
				$v['uah'] = round ($v['rur']/$uahkurs,2);

				break;

			case 'uah':

				$v['uah'] = $cena;
				$v['rur'] = round ($v['uah']*$uahkurs,2);
				$v['eur'] = round ($v['rur']/$eurkurs,2);
				$v['usd'] = round ($v['rur']/$usdkurs,2);

				break;


		}
		return $v;
	}
	
	public static function sum ($sum,$valuta = 'rur',$type = 'usd')
	{
		$a = self::conv ($sum,$valuta);
		return $a[$type];
	}
	
	//Надстройки для быстрого доступа
	//Конвертация суммы в рубли
	public static function rur ($sum,$valuta)
	{
		return self::sum ($sum,$valuta,'rur');
	}
	
	public static function usd ($sum,$valuta)
	{
		return self::sum ($sum,$valuta,'usd');
	}
	
	public static function uah ($sum,$valuta)
	{
		return self::sum ($sum,$valuta,'uah');
	}
	
	public static function eur ($sum,$valuta)
	{
		return self::sum ($sum,$valuta,'eur');
	}


}


?>