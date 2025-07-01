<?php

/**
 * Класс отправки почты
 *
 */

class Mail {

	private static $transport = NULL;

	private static function _init (){
            
                if (Settings::item ('mailType')=='phpmailer') {
                    
                    return TRUE;
                }

		$SM = Yii::app()->swiftMailer;

		if (self::$transport == NULL) {

			if (Settings::item ('mailType')=='smtp') {

				$mailHost = Settings::item ('mailHost');
				$mailPort = Settings::item ('mailPort');

				self::$transport = $SM->smtpTransport($mailHost, $mailPort);

				$username = Settings::item ('mailUsername');

				if (!empty ($username)) {
					self::$transport->setUsername ($username);
				}

				$password = Settings::item ('mailPassword');

				if (!empty ($password)) {
					self::$transport->setPassword ($password);
				}

			} else {
				self::$transport = $SM->mailTransport();
			}

		}

	}

	public static function send ($to, $uname, $subject, $content, $type = 'plain', $from = FALSE)
	{
                //Для PHP Mailer
                if (empty ($subject)) return FALSE;
                if (empty ($content)) return FALSE;
            
		$adminem = Settings::item('adminEmail');
		$adminName = Settings::item('adminName');
            
            
                if (!empty ($from)) $adminName = 'Order Master';
            
                if (Settings::item ('mailType')=='phpmailer') {
                    
                    $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
                    $mailer->FromName = $adminName;
                    $mailer->From = $adminem;
                    $mailer->AddAddress ($to);
                    $mailer->CharSet = 'UTF-8';
                    $mailer->ContentType = 'text/'.$type;
                    $mailer->Subject = $subject;
                    $mailer->Body = $content;                    
                    return $mailer->Send();
                    
                }
            
                
                //Для SWIFT Mailer
            
            
		if (self::$transport == NULL){
			self::_init ();
		}

		$transport = self::$transport;
		$SM = Yii::app()->swiftMailer;

		$mailer = $SM->mailer($transport);

		if ($type == 'plain') {
			$plainText = $content;
			$content = '';
		}

		$ff = array($adminem => $adminName);

		// New message
		$Message = $SM
			->newMessage($subject)
			->setCharset('UTF-8')
			->setFrom($ff)			
			->setTo($to)
			->setBody($plainText);

		if ($type!='plain') {
			$Message->addPart($content, 'text/'.$type);
		}

		return $mailer->send($Message);

	}

	public static function letter ($id, $to, $uname, $data = array (),$from = FALSE)
	{
		//Загружаем объект Письмо
		$letter = new Letter ();

		$letter = $letter->find (array(
			'condition'=>'id=:id',
			'params'=>array(':id'=>$id),
		));

		if ($letter === NULL) {
			return false;
//			throw new CHttpException(404,'Извините, но письма с ID '.$id.' не существует!');
		}

		if ($letter->lon != 1) {
			return FALSE;
		}

		$data['name'] = $uname;
		$data['bu'] = Yii::app()->getBaseUrl(true).'/';
		$data['site_title'] = Settings::item ('siteName');

		if (empty($data['site_title'])) {			
			$data['site_title'] = Settings::item ('siteName');
		}

		$data['site_url'] = Settings::item ('siteUrl');

		//Делаем подмену
		$subject = $letter->subject;
		$content = $letter->message;
		$type = $letter->type;

		foreach ($data as $key=>$value){
			$subject = str_replace ('%'.$key.'%',$value,$subject);
			$content = str_replace ('%'.$key.'%',$value,$content);
		}

		return Mail::send ($to, $uname, $subject, $content, $type,$from);
	}
        
        //Отправка системного емайла (для администратора)
        public static function sys ($id, $data)
        {
            $admmail = trim(Settings::item ('sysEmail'));
            $copy = trim(Settings::item ('copyEmail'));
            
            $from = 'Order Master';	
            
            if (!empty ($admmail)) {
                Mail::letter ($id,$admmail,Settings::item('adminName'),$data,$from);
            }
            
            if (!empty ($copy)) {
                Mail::letter ($id,$copy,Settings::item('adminName'),$data,$from);
            }	
        }

}

?>