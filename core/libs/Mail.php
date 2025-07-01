<?php
namespace core\libs;
use \phpmailer\PHPMailer;
// подключение библиотеки PHPMailer и класса отправки методом SMTP
require_once VENDORS.S.'phpmailer/class.phpmailer.php';
require_once VENDORS.S.'phpmailer/class.smtp.php';
//require_once VENDORS.S.'/phpmailer/class.pop3.php';
//require_once VENDORS.S.'/phpmailer/class.phpmaileroauth.php';
//require_once VENDORS.S.'/phpmailer/class.phpmaileroauthgoogle.php';
// echo 'Класс-расширение Mail для отправки почты';
class Mail extends PHPMailer {
    // Установка переменных по умолчанию для всех новых объектов
    public $Priority = 3; // приоритет почты поумолчанию: 1 – высокий, 3 – нормальный, 5 – низкий 
    public $CharSet = 'UTF-8'; // установка кодировки сообщения
    public $ContentType = 'text/plain';	// установка Content-type сообщения
    public $Encoding = '8bit'; // Установка Кодирования сообщения.
    // Доступные варианты "8bit", "7bit", "binary", "base64", и "quoted-printable"
    public $ErrorInfo = ''; // содержит новое сообщение об ошибке отправителя
    public $From = 'info@rolar.ru'; // адрес почты, с которой идёт отправка (по умолчанию root@localhost)
    public $FromName = 'Артур Абзалов'; // имя отправителя (по умолчанию Root User)
    public $Sender = 'info@rolar.ru'; // устанавливает электронную почту Отправителя (Обратный путь) сообщения.
    // Если не пустой, будет послан через -f в sendmail или как 'ПОЧТА ОТ' в smtp способе.
    public $WordWrap = 70; // устанавливает перенос слов в теле сообщения к данному количеству знаков (0 по умолчанию)
    public $Mailer = 'smtp'; // метод отправки почты "mail", "sendmail", or "smtp"; альтернатива IsSMTP()
    public $Sendmail = '/usr/sbin/sendmail'; // устанавливает путь к программе отправки почты
    public $PluginDir = ''; // путь к плагинам PHPMailer. Теперь это применяется только если класс SMTP
    // находится в другой директории, чем путь подключения в PHP.
    public $ConfirmReadingTo = ''; // устаноавливает email адрес, который будет использоваться
    // для подтверждения отправки почты
    public $Hostname = ''; // Устанавливает имя хоста чтобы использовать в id сообщения и Полученных заголовках
    // и как строка HELO по умолчанию. Если пусто, значение, возвращённое SERVER_NAME используется или
    // 'localhost.localdomain'.
    public $Host = 'smtp.beget.com:2525;smtp.beget.ru:2525;smtp.mail.ru:465;smtp.gmail.com:465;localhost';
    // Устанавливает SMTP хосты, все хосты должны быть разделены точкой с запятой.
    // Вы можете также определить различные порты для каждого хоста, используя этот формат: [hostname:port]
    // (например, "smtp1.example.com:25;smtp2.example.com"). Хосты будут испробованы по порядку.
    public $Port = 25; // установка порта SMTP сервера по умолчанию
    public $Helo = ''; // устанавливает SMTP HELO сообщения (по умолчанию $Hostname)
    public $SMTPSecure = 'tls'; // устанавливает тип шифрования для SMTP соединений
    public $SMTPAuth = true; // устанавливает SMTP авторизацию. Использует переменные Имени пользователя и Пароля
    public $Username = 'info@rolar.ru'; // Устанавливает имя пользователя SMTP
    public $Password = '324shOOPe'; // Устанавливает пароль SMTP
    public $Timeout = 10; // устанавливает задержку SMTP сервера в секундах. Эта функция не работает с win32 версией.
    public $SMTPDebug = 0; // устанавливает SMTP класс отладки во включено или выключено
    public $SMTPKeepAlive = false; // Препятствует тому, чтобы связь SMTP была закрыта после каждой почтовой
    // отправки. Если это собирается в истинный затем закрыться, связь требует явного звонка в SmtpClose ().
    public $SingleTo = true; // разделять ли множество адресов на множество сообщений или отправить всем
    // сразу в одном сообщении - работает при отправке методом "mail"

    public $Subject = ''; // устанаовливает тему сообщения
    public $Body = ''; // устанавливает тело сообщения. Это может быть либо HTML, либо текстовым телом.
    // Если HTML, тогда устанавливается IsHTML(true).
    public $AltBody = ''; // устанавливает только текстовое тело сообщения. Это автоматически устанавливает
    // электронную почту в многослойный/альтернативный. Это тело может быть прочитано почтовыми клиентами,
    // у которых нет почтовой способности HTML, такой как дурак. Клиенты, которые могут прочитать HTML,
    // рассмотрят нормальное Тело.
    public $textBody = ''; // то же что и $Body
    public $htmlBody = ''; // то же что и $AltBody
    public $letter_type = 0; // 0 - обычное текстовое письмо, 1 - отформатированное html-письмо
    public $textmessage = null; // передаваемое сообщение

    public function __construct() {
        //echo 'Constructor<br>'; // начальные установки класса
        $this->Priority = 3; // приоритет почты поумолчанию: 1 – высокий, 3 – нормальный, 5 – низкий 
        $this->CharSet = 'UTF-8'; // установка кодировки сообщения
        $this->ContentType = 'text/plain'; // установка Content-type сообщения
        $this->Encoding = '8bit'; // Установка Кодирования сообщения.
        // Доступные варианты "8bit", "7bit", "binary", "base64", и "quoted-printable"
        $this->ErrorInfo = ''; // содержит новое сообщение об ошибке отправителя
        $this->WordWrap = 70; // устанавливает перенос слов в теле сообщения к данному количеству знаков (0 по умолчанию)
        $this->Mailer = 'smtp'; // метод отправки почты "mail", "sendmail", or "smtp"; альтернатива IsSMTP()
        $this->Sendmail = '/usr/sbin/sendmail'; // устанавливает путь к программе отправки почты
        $this->PluginDir = ''; // путь к плагинам PHPMailer. Теперь это применяется только если класс SMTP
        // находится в другой директории, чем путь подключения в PHP.
        $this->ConfirmReadingTo = ''; // info@rolar.ru устаноавливает email адрес, который будет использоваться
        // для подтверждения отправки почты
        $this->Hostname = ''; // Устанавливает имя хоста чтобы использовать в id сообщения и Полученных заголовках
        // и как строка HELO по умолчанию. Если пусто, значение, возвращённое SERVER_NAME используется или
        // 'localhost.localdomain'.
        $this->Host = 'smtp.beget.com:2525;smtp.beget.ru:2525;smtp.mail.ru:465;smtp.gmail.com:465;localhost:25';
        // Устанавливает SMTP хосты, все хосты должны быть разделены точкой с запятой.
        // Вы можете также определить различные порты для каждого хоста, используя этот формат: [hostname:port]
        // (например, "smtp1.example.com:25;smtp2.example.com"). Хосты будут испробованы по порядку.
        $this->Port = 25; // установка порта SMTP сервера по умолчанию
        $this->Helo = ''; // устанавливает SMTP HELO сообщения (по умолчанию $Hostname)
        $this->SMTPAuth = true; // устанавливает SMTP авторизацию. Использует переменные Имени пользователя и Пароля
        $this->Timeout = 10; // устанавливает задержку SMTP сервера в секундах. Эта функция не работает с win32 версией.
        $this->SMTPDebug = 0; // устанавливает SMTP класс отладки во включено или выключено
        $this->SMTPKeepAlive = false; // Препятствует тому, чтобы связь SMTP была закрыта после каждой почтовой
        // отправки. Если это собирается в истинный затем закрыться, связь требует явного звонка в SmtpClose ().
        $this->SingleTo = false; // разделять ли множество адресов на множество сообщений или отправить всем
        // сразу в одном сообщении - работает при отправке методом "mail"
        $this->setLanguage('ru'); // установка языка
        $this->setSMTPsettings('smtp.beget.com'); // установка параметров для отправки почты методом SMTP
    }

    // установка параметров для отправки почты методом SMTP
    private function setSMTPsettings($Host = 'smtp.beget.com') {
        if (!isset($Host)) {
            $this->Host = 'smtp.beget.com';
        }
        else {
            $this->Host = $Host;
        }
        switch($this->Host){
        case('smtp.beget.com'):
            $this->Port = 2525; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = 'tls'; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'info@rolar.ru'; // Устанавливает имя пользователя SMTP
            $this->Password = '324shOOPe'; // Устанавливает пароль SMTP
        break;
        case('smtp.beget.ru'):
            $this->Port = 2525; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = 'tls'; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'info@rolar.ru'; // Устанавливает имя пользователя SMTP
            $this->Password = '324shOOPe'; // Устанавливает пароль SMTP
        break;
        case('smtp.mail.ru'):
            $this->Port = 465; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = 'ssl'; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'rolar@list.ru'; // Устанавливает имя пользователя SMTP
            $this->Password = 'Foget50&60'; // Устанавливает пароль SMTP
        break;
        case('smtp.gmail.com'):
            $this->Port = 465; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = 'ssl'; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'rolaraav@gmail.com'; // Устанавливает имя пользователя SMTP
            $this->Password = '64present'; // Устанавливает пароль SMTP
        break;
        case('localhost'):
            $this->Port = 25; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = ''; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'info@rolar.ru'; // Устанавливает имя пользователя SMTP
            $this->Password = '324shOOPe'; // Устанавливает пароль SMTP
        break;
        default:
            $this->Port = 2525; // установка порта SMTP сервера по умолчанию
            $this->SMTPSecure = 'tls'; // устанавливает тип шифрования для SMTP соединений
            $this->Username = 'info@rolar.ru'; // Устанавливает имя пользователя SMTP
            $this->Password = '324shOOPe'; // Устанавливает пароль SMTP
        }
        $this->FromName = 'Артур Абзалов'; // имя отправителя (по умолчанию Root User)
        $this->setFromEmail($this->Username); // установка From и Sender - Email-адреса отправителя
        return true;
    }

    // установка From и Sender - адрес почты, с которой идёт отправка (по умолчанию root@localhost)
    private function setFromEmail($From = 'info@rolar.ru') {
        if (!isset($From)) {
            if (isset($this->Username)) {
                $From = $this->Username;
            }
            else {
                $From = 'info@rolar.ru';
            }
        }
        $this->SetFrom($From, $this->FromName);
        $this->Sender = $From;
        return true;
    }

    // замена переменных подстановки данных
    private function replacetext($text=null,$user = array()) {
        //$first_name=null,$last_name=null,$login=null,$email=null,$site=null,$reg_date=null,$login_date=null,$birthday=null,$gender=null
        if (!isset($text)) {
            return $text = '';
        }
        if (!is_array($user)) {
            return $text = '';
        }

        $user['first_name'] = isset($user['first_name']) ? $user['first_name'] : '';
        $user['last_name'] = isset($user['last_name']) ? $user['last_name'] : '';
        $user['login'] = isset($user['login']) ? $user['login'] : '';
        $user['email'] = isset($user['email']) ? $user['email'] : '';
        $user['site'] = isset($user['site']) ? $user['site'] : '';
        $user['reg_date'] = isset($user['reg_date']) ? $user['reg_date'] : '1970-01-01 00:00:00';
        $user['login_date'] = isset($user['login_date']) ? $user['login_date'] : '1970-01-01 00:00:00';
        $user['birthday'] = isset($user['birthday']) ? $user['birthday'] : '1970-01-01';
        $user['gender'] = isset($user['gender']) ? $user['gender'] : 0;
        $user['letter_type'] = isset($user['letter_type']) ? $user['letter_type'] : 0;

        if ($user['gender'] == '1') {
            $gender_text = 'женский';
        }
        elseif ($user['gender'] == '2') {
            $gender_text = 'мужской';
        }
        else {
            $gender_text = 'не указан';
        }
        if ($user['letter_type'] == '1') {
            $letter_type_text = 'html';
        }
        else {
            $letter_type_text = 'текст';
        }
        $text = str_replace('[first_name]', $user['first_name'], $text);
        $text = str_replace('[last_name]', $user['last_name'], $text);
        $text = str_replace('[login]', $user['login'], $text);
        $text = str_replace('[email]', $user['email'], $text);
        $text = str_replace('[site]', $user['site'], $text);
        $text = str_replace('[reg_date]', $user['reg_date'], $text);
        $text = str_replace('[login_date]', $user['login_date'], $text);
        $text = str_replace('[birthday]', $user['birthday'], $text);
        $text = str_replace('[gender]', $gender_text, $text);
        $text = str_replace('[letter_type]', $letter_type_text, $text);
        return $text;
    }

    // выбор типа письма - текст или html
    private function getBody($letter_type = 0) {
        if (!isset($letter_type)) {
            $letter_type = 0;
        }
        if($letter_type == 1) {
            $this->IsHTML(true);
            //$this->ContentType = 'text/html';
            $this->Body = $this->msgHTML($this->htmlBody); // Оценивает сообщение и возвращает модификации
            // для действующих изображений и фонов. Устанавливает метод IsHTML() в значение true,
            // инициализирует AltBody() или к текстовой версии сообщения или к тексту по умолчанию.
            // параметр $basedir = $_SERVER['DOCUMENT_ROOT']
            $this->AltBody = $this->textBody;
        }
        else {
            $this->isHTML(false);
            //$this->ContentType = 'text/plain';
            $this->Body = $this->textBody;
            $this->AltBody = ''; //$this->textBody;
        }
        return true;
    }

    public function Mail($recipients = null,$subject = null,$textmessage = null) {
        if((!isset($recipients)) or (!is_array($recipients))) {
            return false;
        }
        $_SESSION['logmessage'] = ''; // удаляем предыдущее сообщение, если оно есть в сессиях
        $count_send_mail = 0; // зануляем счётчик всех отправленных писем
        $count_send_mail_smtp = 0; // зануляем счётчик писем, отправленных скриптом PHPMailer методом smtp
        $count_send_mail_mail = 0; // зануляем счётчик писем, отправленных скриптом PHPMailer методом mail
        $count_send_mail_phpmail = 0; // зануляем счётчик писем, отправленных PHP-функцией mail()
        $count_send_error = 0; // зануляем счётчик не отправленных писем
        // Отправляем письма в цикле
        foreach($recipients as $item){
            if (!isset($item['first_name'])) {
                $item['first_name'] = 'уважаемый подписчик';
            }
            //$item['first_name'] = isset($item['first_name']) ? $item['first_name'] : '';
            $item['last_name'] = isset($item['last_name']) ? $item['last_name'] : '';
            //if(!empty($item['last_name'])) {
            //    $item['first_name'] .= ' '.$item['last_name'];
            //}
            $this->AddAddress($item['email'], $item['first_name']); // адрес получателя
            $this->Subject = $this->replacetext((string)$subject, $item); // тема письма
            
            // если сообщение передано в виде массива обычного текста и форматированного html
            if(is_array($textmessage)) {
                // то заменяем данные и в тексте и в html
                $this->htmlBody = $this->replacetext((string)$textmessage[1], $item);
                $this->textBody = $this->replacetext((string)$textmessage[0], $item);
            }
            else {
                // иначе - заменяем данные только в тексте
                $this->htmlBody = $this->replacetext((string)$textmessage, $item);
                $this->textBody = $this->replacetext((string)$textmessage, $item);
            }
            if (!isset($item['letter_type'])) {
                $letter_type = 0;
            }
            else {
                $letter_type = (int)$item['letter_type'];
            }

            $this->getBody($letter_type);

            if($this->Send()){
                $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="green1">Письмо на адрес <a href="mailto:'.$item['email'].'" target="_blank">'.$item['email'].'</a> отправлено скриптом PHPMailer методом smtp. Получатель: '.$item['first_name'].' '.$item['last_name'].'.</div>';
                $count_send_mail = $count_send_mail + 1;
                $count_send_mail_smtp = $count_send_mail_smtp + 1;
            }
            else {
                $this->Mailer = 'mail'; // метод отправки почты "mail", "sendmail", or "smtp"; альтернатива IsSMTP();
                if ($this->Send()) {
                    $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="orange">Письмо на адрес <a href="mailto:'.$item['email'].'" target="_blank">'.$item['email'].'</a> отправлено скриптом PHPMailer методом mail. Получатель: '.$item['first_name'].' '.$item['last_name'].'.</div>';
                    $count_send_mail = $count_send_mail + 1;
                    $count_send_mail_mail = $count_send_mail_mail + 1;
                }
                else {
                    if(@mail($item['email'], $this->Subject, $this->Body, "Content-Type: text/plain; charset=UTF-8\r\n")){
                        $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="blue1">Письмо на адрес <a href="mailto:'.$item['email'].'" target="_blank">'.$item['email'].'</a> отправлено PHP функцией mail(). Получатель: '.$item['first_name'].' '.$item['last_name'].'.</div>';
                        $count_send_mail = $count_send_mail + 1;
                        $count_send_mail_phpmail = $count_send_mail_phpmail + 1;
                    }
                    else {
                        $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="red1">Письмо на адрес <a href="mailto:'.$item['email'].'" target="_blank">'.$item['email'].'</a> не отправлено. Получатель: '.$item['first_name'].' '.$item['last_name'].'.</div>';
                        $count_send_error = $count_send_error + 1;
                    }
                }
            }
            $this->Mailer = 'smtp'; // метод отправки почты "mail", "sendmail", or "smtp"; альтернатива IsSMTP()            
            $this->ClearAddresses(); // Очищает всех получателей, назначенных в массиве Кому. Возвращает пустоту
            // $this->ClearAllRecipients(); // Очищает всех получателей, назначенных в массивах Кому, Копия, скрытая Копия. Возвращает пустоту
            $this->ClearAttachments(); // Очищает все ранее установленные файловые системы, строки и двоичные приложения. Возвращает пустоту
            $this->IsHTML(false);
            //echo "Письмо отправлено. Пользователь: $first_name";
        }
        unset($item);
        //$_SESSION['logmessage'] = $logmessage;
        if ($count_send_mail > 0) {
            $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="bold">Итого '.$count_send_mail.' писем отправлено, из них:<br>
            '.$count_send_mail_smtp.' - отправлено скриптом PHPMailer методом smtp,<br>
            '.$count_send_mail_mail.' - отправлено скриптом PHPMailer методом mail,<br>
            '.$count_send_mail_phpmail.' - отправлено PHP-функцией mail(),<br>
            '.$count_send_error.' ошибок при отправке писем.</div>';
        }
        else {
            $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="bold">Ни одного письма не отправлено.</div>';
        }
        return true;
    }
}
?>