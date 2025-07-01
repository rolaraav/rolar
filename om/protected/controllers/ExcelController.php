<?php

class ExcelController extends Controller
{
    
 	public function cut_str ($start, $stop, $str, $inc = '') {
 		
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
    
    
    
	public function actionIndex($id = FALSE)
	{
            if (empty ($id)) die ('No good ID');
            
            
            
            
            
            echo '<pre>';
            
            if (!empty ($_POST)) {
                $d = $_POST['d'];
                
                $c = new Client;
                $c->subscribe = 1;
                $i = 0;
                
                foreach ($d as $rec) {

                    $c->isNewRecord = TRUE;
                    $c->email = trim($rec['email']);
                    $c->date = $rec['date'];
                    $c->uname = trim($rec['uname']);
                    
                    $gid = trim($rec['gid']);
                    
                    //Проверяем - один или несколько ID товаров
                    if (strpos ($gid,',')!==FALSE) {
                        
                        $gids = explode (',',$gid);
                        
                        foreach ($gids as $one) {
                            $gg = trim ($one);
                            $c->id = FALSE;
                            $c->isNewRecord = TRUE;
                            $c->good_id = $gg;
                            $c->save (FALSE);
                            $i++;
                        }
                        
                    } else {
                        $c->id = FALSE;
                        $c->isNewRecord = TRUE;
                        $c->good_id = $gid;
                        $c->save (FALSE);
                        $i++;
                    }
                    
                }                

                
                die ('Клиенты были добавлены в базу ('.$i.' записей). Импорт завершён/');
            }
            
            Yii::import('ext.phpexcelreader.JPhpExcelReader');
            $data=new JPhpExcelReader('./orders.xls');
            $xx = $data->dump_arr(true,true);
            
            if (empty ($xx)) die ('No file /orders.xls or bad format');
            
            //print_r ($xx);
            
            unset ($xx[1]);
            
            $a = array ();
            
            foreach ($xx as $d) {
                $r = array ();
                
                $fio = trim ($d[1]);
                $r['orig_fio'] = $fio;
                
                //Преобрвазования $fio
                
                $uname = trim ($this->cut_str (' ',' ',$fio));
                
                if (empty ($uname)) {
                    $uname = $fio;
                }
                
                
                $r['uname'] = $uname;
                $r['email'] = trim($d[7]);
                $r['date'] = strtotime ($d[11]);                
                $r['sum'] = $d[9];
                $r['adv'] = $d[12]; //примечание
                
                $a[]=$r;
            }
            
            //print_r ($a);
            $this->render ('/main/excelimp', array ('a' => $a, 'gid' => $id));

	}


}