<?php

class ClController extends Controller
{
	
	public function actionG ($g = FALSE)
	{
		//Проверяем форматы
		if (!empty ($_GET['e'])) {
			
			$em = $_GET['e'];
			
			

			if (preg_match ('/^^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/',$em)) 
			{
	
				//Если емайл совпадает - ищем клиента в базе
				$b = Bill::model()->find ('email = :email AND (status_id = "nalozh_ok" OR status_id = "approved" OR status_id = "processing" OR status_id = "sent")', 
					array (
							':email' => $em,
						)
					);

										
					
				if ($b) {
					
					$ar = array ('email','uname','amail','surname','otchestvo','strana','gorod','region','phone','postindex','address');
					
					$ok = array ();
					
					foreach ($ar as $one) {
						$ok[$one] = $b->$one;
					}
					
					Yii::app()->session['predata'] = $ok;
				}
			
			}
			
		}		
		
		$this->redirect (Y::bu().'ord/'.$g);
	}
	
}