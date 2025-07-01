<?php

/**
 * Основной Хелпер
 
 */

class H {

	public static function random_string($type = 'alnum', $len = 8)
	{
		switch($type)
		{
			case 'alnum'	:
			case 'numeric'	:
			case 'nozero'	:
			case 'lower'	:

				switch ($type)
				{
					case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'lower'	:	$pool = '123456789abcdefghijklmnopqrstuvwxyz123456789';
						break;
					case 'numeric'	:	$pool = '0123456789';
						break;
					case 'nozero'	:	$pool = '123456789';
						break;
				}

				$str = '';
				for ($i=0; $i < $len; $i++)
				{
					$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
				}
				return $str;
				break;
			case 'unique' : return md5(uniqid(mt_rand()));
				break;
		}
	}

	/**
	 * H::convertUrl()
	 * Конвертирует все URL-ы - в реальные активные ссылки
	 *
	 * @param string $str
	 * @return string
	 */
	public static function convertUrl ($str)
	{
		return preg_replace( "/(?<!<a href=\")((http|ftp)+(s)?:\/\/[^<>\s]+)/i", "<a target=\"_blank\" href=\"\\0\">\\0</a>", $str);
	}

	public static function valuta ($str) {

		switch($str){
				case 'usd':
					$r = '$';
				break;
				case 'uah':
					$r = ' грн.';
				break;
				case 'eur':
					$r = '€';
				break;
				default:
					$r = ' р.';
			}
		return $r;
	}

	//Выводит сумму в денежном формате
	public static function mysum ($n) {
		return number_format($n, 2, '.', ' ');
	}

	public static function menuimg ($str)
	{
		return '<img src="'.Y::bu().'images/theme/menu/'.$str.'.png'.'">';
	}

  	function directoryMap($source_dir,$skeys = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$source_dir = rtrim($source_dir, '/').'/';
			$filedata = array();

			while (FALSE !== ($file = readdir($fp)))
			{
				if ((strncmp($file, '.', 1) == 0) OR ($file == '.' OR $file == '..'))
				{
					continue;
				}

				if (!is_dir($source_dir.$file))
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);

                        if ($skeys) {
                            $nn = array ();
                            foreach ($filedata as $one) {
                                $nn[$one] = $one;
                            }
                            $filedata = $nn;
                        }

			return $filedata;
		}
		else
		{
			return FALSE;
		}
	}
        
    /**
    * Генерирует JavaScript-код
    * Для вывод и сокрытия слоёв
    */
    static public function moredivCode ($div_letter,$showtext,$hidetext,
                $showimg = 'arrow-right.gif', $hideimg = 'arrow-left.gif') {

    $out = '

    <script type="text/javascript">
    <!--
        $(function () {

            $("#more_'.$div_letter.' a").click (function () {

                 $("#morediv_'.$div_letter.'").toggle ("fast", function () {

                    if (this.style.display!="none") {
                        $("#more_'.$div_letter.' a").text ("'.$hidetext.'");
                        $("#more_'.$div_letter.' img").attr ("src", "'.Y::bu().'images/theme/btn/'.$hideimg.'");
                    } else {
                        $("#more_'.$div_letter.' a").text ("'.$showtext.'");
                        $("#more_'.$div_letter.' img").attr ("src", "'.Y::bu().'images/theme/btn/'.$showimg.'");
                    }
                 });
                 return false;
            });

        });
    //-->
    </script>';

    return $out;

    }

    /**
    * Всё для раскрывающегося слоя
    */
   static public function moredivAll ($title = 'больше', $name = 'a') {

        $out = '<div class="more" id="more_'.$name.'">
                <img src="'.Y::bu().'images/theme/btn/arrow-right.gif"><a href="#show">Показать '.$title.'</a>
                </div>';
        
        $out .=

            self::moredivCode($name,'Показать '.$title,'Скрыть '.$title)

        .'<div id="morediv_'.$name.'" class="morediv">

        ';

        return $out;
    }
    
    public static function date ($dd = FALSE) 
    {
        if ($dd) {
            return date('d.m.Y',$dd);    
        } else {
            return date('d.m.Y');
        }
        
    }
    
    
    public static function dateParse ($dd) 
    {
        return CDateTimeParser::parse($dd,'dd.MM.yyyy');
    }
    
    /*
     * Добавляет empty в массив
     */
    public static function emp ($a)
    {
        return array_merge (array('' => ''),$a);
    }
    
	//Кодирует строку
	public static function mcode_str ($s) {
		
		$l = strlen ($s);
		$r = '';
		
		for ($i=0; $i<$l; $i++) {
			$r .=  dechex (ord ($s[$i]));
		}
		return $r;
	}
	
	//Декодирует строку
	public static function mdecode_str ($s) {
		
		$l = strlen ($s);
		$r = '';
		
		for ($i=0; $i<$l; $i=$i+2) {
			$r .= chr (hexdec ('$'.$s[$i].$s[$i+1]));
		}
		return $r;
	}
    
        function allowChars ($name, $ok_chars) {
            $ass=str_split($ok_chars);
            $al=array();
            
            foreach ($ass as $a) {
                $al[ord($a)]=TRUE;
            }

            $s=str_split($name);
            $ret="";
            foreach ($s as $c) {
                $jj = ord($c);
                if (!isset($al[$jj])) continue;
                if (!$al[$jj]) continue;
                $ret.=$c;
            }

            return $ret;
        }        
        
	//Кодирование емайл
	public static function codemail ($em) {		
            
                if (Settings::item('affAllTrusted')==1) {
                    return $em;
                }
				
		$nm = $em;
				
		$l = strlen ($em)-3;		
		for ($i=3; $i<$l; $i++) {
			if ($nm[$i]!='@') $nm[$i] = '*';
		}
		
		return $nm;
	}        
	
	//Валюта по умолчанию
	public static function dv ($name = FALSE) 
	{
		$dv = Settings::item ('dv');
		if ($name) {
			return self::valuta($dv);
		} else {
			return $dv;			
		}
	}
	
	//В валюте по умолчанию
	public static function indv ($sum,$valuta = 'rur') {
		return Valuta::sum ($sum,$valuta,self::dv());
	}

        //Обрезка строки
        public static function cut_str ($start, $stop, $str, $inc = '') {
 		
		//Поиск начала
		$spos = strpos ($str, $start);		
		
		// Удлиняем позицию на длину стартовой строки,
		// чтобы не включать её в результат
		$spos = $spos + strlen ($start);
		
		//Режем строку от этой позиции
		$text = substr ($str,$spos);
		
		//Ищем конец в полученной строке
		$end_pos = strpos ($text,$stop);
		
		//Режем по конечной позиции
		$text = substr ($text,0,$end_pos);
		
		//Опции управления обрезкой указателей
		if ($inc == 'before' || $inc == 'both') {
			$text = $start.$text;
		}
		if ($inc == 'after' || $inc == 'both') {
			$text = $text.$stop;
		}		
		
		//Возвращаем результат
		return $text; 		
 		
 	} 
        
        //Объединяет ID товаров в список
        public static function compOrders ($ords)
        {
            $res = '';
            foreach ($ords as $one)
            {
                $res .= $one->good_id . "<br>";
            }
            return $res;
        }
        
        //Расчёт EPC
        public static function epc ($clicks,$earn)
        {
            if ($clicks == 0) return '0.00';
            if ($earn == 0) return '0.00';
            $res = $earn/$clicks;
            return round ($res,2);
        }
        
        //Расчёт % конверсий
        public static function econv ($clicks,$conv)
        {
            if ($clicks == 0) return '0.00';
            if ($conv == 0) return '0.00';
            $res = $conv/$clicks*100;
            return round ($res,2);
        }        
	

}


