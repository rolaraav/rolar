<?php defined('A') or die('Access denied');
// Функции авторизации Вконтакте
/* Функция проверки логина */
function login_of_vk($nickname = null,$social_id=null) {
    if (empty($nickname) or ($nickname == '')) {
        if (empty($social_id) or ($social_id == '')) {
            $login = 'vk'.(string)time();
        }
        else {
            $login = 'vk'.(string)$social_id;
        }
    }
    else {
        $login = (string)$nickname;
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}

/* Функция для проверки сайта или страницы пользователя */
function site_of_vk($site = null,$screen_name = null,$social_id) {
    if (empty($site) or ($site == "")) {
        if (empty($screen_name) or ($screen_name == "")) {
            $site = 'https://vk.com/id'.(string)$social_id;
        }
        else {
            $site = 'https://vk.com/'.(string)$screen_name;
        }
    }
    $site = validate($site,'url'); // проверяем введенные данные и чистим от ссылок адрес сайта
    return $site;
}
/* Функция, которая преобразовывает дату из контакта в нужный вид */
function birthday_of_vk($strdate) { // 22.5.1987
    if (empty($strdate)) {$strdate = '00.00.0000';}
    $date_elements = explode('.',$strdate); // Разбиение строки на части
    if (empty($date_elements[0])) {$date_elements[0] = '00';}
    if (empty($date_elements[1])) {$date_elements[1] = '00';}
    if (empty($date_elements[2])) {$date_elements[2] = '0000';}
    if (mb_strlen($date_elements[0],'UTF-8') == 1) {
        $date_elements[0] = '0'.$date_elements[0];
    }
    if (mb_strlen($date_elements[1],'UTF-8') == 1) {
        $date_elements[1] = '0'.$date_elements[1];
    }
    $newstrdate = $date_elements[2].'-'.$date_elements[1].'-'.$date_elements[0]; // преобразование даты в нужный вид
    return $newstrdate; // вывод результата
}

// Функция получения кода
function vk_get_code() {
    $vk_code_url = VK_URL_AUTH.'?client_id='.VK_APP_ID.'&scope=email,offline&redirect_uri='.urlencode(VK_REDIRECT_URI).'&response_type=code';
    // echo $vk_code_url; // адрес для получения кода авторизации Вконтакте
   	redirect($vk_code_url);
}
function vk_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $vk_access_token_url = VK_URL_ACCESS_TOKEN.'?client_id='.VK_APP_ID.'&client_secret='.VK_APP_SECRET.'&code='.$code.'&redirect_uri='.urlencode(VK_REDIRECT_URI);
    // echo $vk_access_token_url; // адрес для получения access token, строка

	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,$vk_access_token_url);
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($url); // ответ от сервера Вконтакте
	curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Вконтакте - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$access_token = json_decode($response, true); // ассоциативный массив
    // var_dump($access_token); // ассоциативный массив
    if ($access_token['access_token']) {
        $_SESSION['auth']['social_id'] = (string)$access_token['user_id']; // поулучаем ID пользователя
        // $access_token['email'] = "";
        $_SESSION['auth']['email'] = get_email((string)$access_token['email']); // получаем email пользователя
        //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
        //echo "\$access_token['expires_in'] = ".$access_token['expires_in']."<br>";
        //echo "\$access_token['user_id'] = ".$access_token['user_id']."<br>";
        //echo "\$access_token['email'] = ".$access_token['email']."<br>";
		return $access_token;
	}
	elseif ($access_token['error']) {
		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$access_token['error_description'];
		return false;
	}
}
function vk_get_user_data($access_token = array()) {
	if((!$access_token['access_token']) or empty($access_token['access_token'])) {
		exit('Не верный токен');
	}
	if((!$access_token['user_id']) or empty($access_token['user_id'])) {
		exit('Неверный идентификатор пользователя');
	}
    $vk_user_data_url = VK_URL_GET_USER.'?user_ids='.$access_token['user_id'].'&fields=id,first_name,last_name,deactivated,sex,bdate,photo_100,site,nickname,timezone,screen_name&name_case=nom&access_token='.$access_token['access_token'];
    // echo $vk_user_data_url; // адрес для получения данных пользователя, строка

    //Параметры fields:
    //id - идентификатор пользователя, положительное число
    //first_name - имя пользователя, строка
    //last_name - фамилия пользователя, строка
    //deactivated - возвращается, если страница пользователя удалена или заблокирована, содержит значение deleted или banned. Обратите внимание, в этом случае дополнительные поля fields не возвращаются
    //sex - пол пользователя, 1 — женский, 2 — мужской, 0 — пол не указан
    //bdate - дата рождения, возвращается в формате DD.MM.YYYY или DD.MM (если год рождения скрыт). Если дата рождения скрыта целиком, поле отсутствует в ответе
    //photo_100 - url квадратной фотографии пользователя, имеющей ширину 100 пикселей. В случае отсутствия у пользователя фотографии возвращается http://vk.com/images/camera_b.gif
    //site - возвращает указанный в профиле сайт пользователя
    //nickname - никнейм (отчество) пользователя
    //timezone - временная зона пользователя. Возвращается только при запросе информации о текущем пользователе, число integer
    //screen_name - короткое имя (поддомен) страницы пользователя, например id3591008

    // name_case=nom - падеж для склонения имени и фамилии пользователя, именительный – nom

	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,$vk_user_data_url);
	curl_setopt($url,CURLOPT_SSL_VERIFYPEER,false); // для отмены проверки ssl-сертификата
	curl_setopt($url,CURLOPT_SSL_VERIFYHOST,false); // для отмены проверки ssl-сертификата
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($url); // ответ от сервера Вконтакте
	curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Вконтакте - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$vk_user_data = json_decode($response, true); // ассоциативный массив
    // var_dump($vk_user_data); // ассоциативный массив
    // print_array($vk_user_data);
    if ($vk_user_data['response'][0]['first_name']) {
        if ($vk_user_data['response'][0]['deactivated'] != '') {
            $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя: страница пользователя удалена или заблокирована.';
            return false;
        }
        // $_SESSION['auth']['id'] = '';
        $_SESSION['auth']['first_name'] = validate((string)$vk_user_data['response'][0]['first_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$vk_user_data['response'][0]['last_name'],'name');
        $_SESSION['auth']['login'] = login_of_vk((string)$vk_user_data['response'][0]['nickname'],$_SESSION['auth']['social_id']);
        // $_SESSION['auth']['password'] = '111';
        // $_SESSION['auth']['avatar'] = get_avatar((string)$vk_user_data['response'][0]['photo_100']);
        $_SESSION['auth']['photo'] = (string)$vk_user_data['response'][0]['photo_100'];
        // $_SESSION['auth']['email'] = '';
        $_SESSION['auth']['site'] = site_of_vk((string)$vk_user_data['response'][0]['site'],(string)$vk_user_data['response'][0]['screen_name'],$_SESSION['auth']['social_id']);
        // $_SESSION['auth']['activation'] = '1';
        $_SESSION['auth']['method'] = 1;
        // $_SESSION['auth']['social_id'] = (string)$vk_user_data['response'][0]['uid'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = birthday_of_vk((string)$vk_user_data['response'][0]['bdate']);
        $_SESSION['auth']['gender'] = (integer)$vk_user_data['response'][0]['sex'];
        // $_SESSION['auth']['nickname'] = $vk_user_data['response'][0]['nickname'];
        // $_SESSION['auth']['timezone'] = $vk_user_data['response'][0]['timezone'];
        // $_SESSION['auth']['screen_name'] = $vk_user_data['response'][0]['screen_name'];
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
[uid] => 3591008
[first_name] => Артур
[last_name] => Абзалов
[sex] => 2
[nickname] => 
[screen_name] => id3591008
[bdate] => 22.5.1987
[timezone] => 5
[photo_100] => http://cs624828.vk.me/v624828008/11a10/1ofHfi2avxs.jpg
[site] => http://rolar.ru
*/
        return true;
    }
    else {
		$_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя: '.$vk_user_data['error_description'];
		return false;
    }
}

// Функции авторизации в Фейсбук
/* Функция получения логина из Фейсбука */
function login_of_fb($name=null,$social_id=null) {
    if (empty($name) or ($name == "")) {
        if (empty($social_id) or ($social_id == '')) {
            $login = 'fb'.(string)time();
        }
        else {
            $login = (string)$social_id;
        }
    }
    else {
        $login = str_replace(' ','',(string)$name);
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,"UTF-8");
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}
/* Функция для проверки сайта или страницы пользователя */
function site_of_fb($website = null,$link) {
    if (empty($website) or ($website == '')) {
        $site = $link;
    }
    else {
        $site = $website;
    }
    $site = validate($site,'url'); // проверяем введенные данные и чистим от ссылок адрес сайта
    return $site;
}
/* Функция, которая преобразовывает дату из фейсбука в нужный вид */
function birthday_of_fb($strdate) { // 05/22/1987
    if (empty($strdate)) {$strdate = '00/00/0000';}
    $date_elements = explode('/',$strdate); // Разбиение строки на части
    if (empty($date_elements[0])) {$date_elements[0] = '00';}
    if (empty($date_elements[1])) {$date_elements[1] = '00';}
    if (empty($date_elements[2])) {$date_elements[2] = '0000';}
    $newstrdate = $date_elements[2].'-'.$date_elements[0].'-'.$date_elements[1]; // преобразование даты в нужный вид
    return $newstrdate; // вывод результата
}
// Функция для получения пола пользователя из фейсбука
function gender_of_fb($strgender = null) {
    if (empty($strgender) or ($strgender == '')) {
        $gender = 0;
    }
    if ($strgender == 'female') {
        $gender = 1;
    }
    if ($strgender == 'male') {
        $gender = 2;
    }
    return $gender;
}

/* Функция для получения кода */
function fb_get_code(){
    $fb_code_url = FB_URL_AUTH.'?client_id='.FB_CLIENT_ID.'&redirect_uri='.FB_REDIRECT_URI.'&response_type=code&scope=email,user_photos,user_website';
    // echo $fb_code_url; // адрес для получения кода авторизации в Фейсбуке
   	redirect($fb_code_url); // при возврате с сервера на конце GET-запроса приходят лишние символы #_=_
}
function fb_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $fb_access_token_url = FB_URL_ACCESS_TOKEN.'?client_id='.FB_CLIENT_ID.'&redirect_uri='.urlencode(FB_REDIRECT_URI).'&client_secret='.FB_SECRET.'&code='.$code;
    // echo $fb_access_token_url; // адрес для получения access token, строка

	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,$fb_access_token_url);
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($url); // ответ от сервера Фейсбук
	curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Фейсбук: в случае успешного ответа - обычная строка, в случае ошибки - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

    $result = json_decode($response, true); // если полученный результат с ошибкой и его можно преобразовать из формата json
    if ($result['error']) {
        // var_dump($result); // ассоциативный массив
  		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$result['error']['message'].'<br>Тип: '.$result['error']['type'].'.<br> Код ошибки: '.$result['error']['code'].'.';
		return false;
    }
    else {
    	parse_str($response,$access_token); // преобразование строки $response в ассоциативный массив $access_token
        // var_dump($access_token); // ассоциативный массив
        if ($access_token['access_token']) {
            //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
            //echo "\$access_token['expires'] = ".$access_token['expires']."<br>";
    		return $access_token;
    	}
    }
}
function fb_get_user_data($access_token = array()) {
	if((!$access_token['access_token']) or empty($access_token['access_token'])) {
		exit('Не верный токен');
	}
    $fb_user_data_url = FB_URL_GET_USER."?access_token=".$access_token['access_token'];
    // echo $fb_user_data_url; // адрес для получения данных пользователя, строка

	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,$fb_user_data_url);
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($url); // ответ от сервера Вконтакте
	curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Вконтакте - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$fb_user_data = json_decode($response, true); // ассоциативный массив
    // var_dump($fb_user_data); // ассоциативный массив
    // print_array($fb_user_data);
    if ($fb_user_data['id']) {
        // $_SESSION['auth']['id'] = "";
        $_SESSION['auth']['first_name'] = validate((string)$fb_user_data['first_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$fb_user_data['last_name'],'name');
        $_SESSION['auth']['login'] = login_of_fb((string)$fb_user_data['name'],(string)$fb_user_data['id']);
        // $_SESSION['auth']['password'] = "111";
        // $_SESSION['auth']['avatar'] = get_avatar("http://graph.facebook.com/".$fb_user_data['id']."/picture?type=square");
        $_SESSION['auth']['photo'] = 'https://graph.facebook.com/'.(string)$fb_user_data['id'].'/picture?type=square';
        //$fb_user_data['email'] = '';
        $_SESSION['auth']['email'] = get_email((string)$fb_user_data['email']);
        $_SESSION['auth']['site'] = site_of_fb((string)$fb_user_data['website'],(string)$fb_user_data['link']);
        // $_SESSION['auth']['activation'] = "1";
        $_SESSION['auth']['method'] = 2;
        $_SESSION['auth']['social_id'] = (string)$fb_user_data['id'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = birthday_of_fb((string)$fb_user_data['birthday']);
        $_SESSION['auth']['gender'] = (integer)gender_of_fb($fb_user_data['gender']);
        // $_SESSION['auth']['timezone'] = $fb_user_data['timezone'];
        // $_SESSION['auth']['link'] = $fb_user_data['link'];
        // $_SESSION['auth']['name'] = $fb_user_data['name'];
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
    [id] => 591120991021629
    [birthday] => 05/22/1987
    [email] => rolar@list.ru
    [first_name] => Artur
    [gender] => male
    [last_name] => Abzalov
    [link] => https://www.facebook.com/app_scoped_user_id/591120991021629/
    [locale] => ru_RU
    [name] => Artur  Abzalov
    [timezone] => 5
    [updated_time] => 2013-09-14T08:17:22+0000
    [verified] => 1
    [website] => http://rolar.ru
*/
        return true;
    }
    elseif($fb_user_data['error']) {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя: '.$fb_user_data['error']['message'].'<br>Тип: '.$fb_user_data['error']['type'].'.<br> Код ошибки: '.$fb_user_data['error']['code'].'.';
		return false;
    }
}

// функции для авторизации в Твиттере
// Функция получения имени пользователя
function first_name_of_tw($name) {
    $probel = mb_stripos((string)$name,' ',0,'UTF-8')+1; // поиск позиции пробела (т.к. нумерация символов начинается с 0, то прибавляем 1)
    $first_name = mb_substr($name,0,$probel-1,'UTF-8'); // получаем имя
    // stripos($haystack,$needle) - ищет позицию первого вхождения подстроки needle в строку haystack
    $first_name = validate($first_name,'name'); // проверяем введенные данные и чистим от ссылок имя/фамилию
    return $first_name;
}
// Функция получения фамилии пользователя
function last_name_of_tw($name) {
    $name_length = mb_strlen($name,'UTF-8'); // общая длина имени+фамилии
    // echo "\$name_length = ".$name_length."<br><br>";
    $probel = mb_stripos((string)$name,' ',0,'UTF-8')+1; // поиск позиции пробела (т.к. нумерация символов начинается с 0, то прибавляем 1)
    // echo "\$probel = ".$probel."<br><br>";
    $last_name_length = $name_length-$probel; // определяем длину фамилии = общая длина - позиция пробела
    // echo "\$last_name_length = ".$last_name_length."<br><br>";
    $last_name = mb_substr($name,$probel,$last_name_length,'UTF-8'); // получаем фамилию
    //echo "<br>".stripos($name,' ')+1;
    $last_name = validate($last_name,'name'); // проверяем введенные данные и чистим от ссылок логин
    return $last_name;
}
// Функция для получения логина
function login_of_tw($screen_name=null,$social_id=null) {
    if (empty($screen_name) or ($screen_name == '')) {
        if (empty($social_id) or ($social_id == '')) {
            $login = 'tw'.(string)time();
        }
        else {
            $login = 'tw'.(string)$social_id;
        }
    }
    else {
        $login = (string)$screen_name;
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}
/* Функция для проверки сайта или страницы пользователя */
function site_of_tw($url = null,$url2 = null,$screen_name) {
    if (empty($url) or ($url == '')) {
        if (empty($url2) or ($url2 == '')) {
            $url = 'https://twitter.com/'.(string)$screen_name;
        }
        else {
            $url = (string)$url2;
        }
    }
    $site = validate($url,'url'); // проверяем введенные данные и чистим от ссылок адрес сайта
    return $site;
}
/* Функция, которая преобразовывает дату из твиттера в нужный вид */
function birthday_of_tw($strdate) { // Sat Mar 31 06:30:56 +0000 2012 // Sun Dec 19 22:12:45 +0000 2010
    if (empty($strdate)) {$newstrdate = '0000-00-00';}
    else {
        $date_elements = explode(' ',$strdate); // Разбиение строки на части
        if (empty($date_elements[2])) {$date_elements[2] = '00';} // день
        $strmontharr = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        $nummontharr = array('01','02','03','04','05','06','07','08','09','10','11','12');
        if (empty($date_elements[1])) {$mounth = '00';} // месяц
        else {
            for($i=1;$i<=12;$i++) {
                if ($strmontharr[$i-1] == $date_elements[1]) {
                    $mounth = $nummontharr[$i-1];
                    break;
                }
                else {$mounth = '00';}
            }
            // preg_replace($pattern,$replacement,$subject) - выполняет поиск и замену совпадений по регулярному выражению в строке subject с шаблоном pattern и заменяет их на replacement
        }
        if (empty($date_elements[5])) {$date_elements[5] = '0000';} // год
        //if (mb_strlen($date_elements[2],"UTF-8") == 1) {
        //    $date_elements[2] = '0'.$date_elements[2];
        //}
        $newstrdate = $date_elements[5].'-'.$mounth.'-'.$date_elements[2]; // преобразование даты в нужный вид
    }
    return $newstrdate; // вывод результата "YYYY-MM-DD"
}


//функция для получения случайной строки
function tw_get_oauth_nonce(){
    $oauth_nonce = md5(uniqid(rand(), true));
    // echo "\$oauth_nonce = ".$oauth_nonce."<br>";
    return $oauth_nonce;
}
// функция для получения подписи
function tw_get_oauth_signature($oauth_base_text,$key){
    // Хэш-код (hash_hmac, base64_encode)наверх
    // В функцию hash_hmac() передаются 4 параметра: алгоритм, строка, ключ, булево значение — true
    // Алгоритм — sha1, строка была сформирована выше
    $oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));
    // oauth_signature: BB6w/jAdrHQD1/iUqqEZiI8o2M0=
    // echo "\$oauth_signature = ".$oauth_signature."<br>";
    return $oauth_signature;
}
function tw_get_oauth_token_and_verifier(){
    $oauth_nonce = tw_get_oauth_nonce(); // рандомная строка (для безопасности) ae058c443ef60f0fea73f10a89104eb9
    $oauth_timestamp = time(); // 1310727371; время когда будет выполняться запрос (в секундах)
    // echo '$oauth_timestamp = '.$oauth_timestamp.'<br>';
// Обратите внимание на использование функции urlencode и расположение амперсандов
// Если поменяете положение параметров oauth_... или уберете где-нибудь urlencode - получите ошибку
    $oauth_base_text = "GET&";
    $oauth_base_text .= urlencode(TW_URL_REQUEST_TOKEN).'&';
    $oauth_base_text .= urlencode('oauth_callback='.urlencode(TW_URL_CALLBACK).'&');
    $oauth_base_text .= urlencode('oauth_consumer_key='.TW_CONSUMER_KEY.'&');
    $oauth_base_text .= urlencode('oauth_nonce='.$oauth_nonce.'&');
    $oauth_base_text .= urlencode('oauth_signature_method=HMAC-SHA1&');
    $oauth_base_text .= urlencode('oauth_timestamp='.$oauth_timestamp.'&');
    $oauth_base_text .= urlencode('oauth_version=1.1');
    // echo '$oauth_base_text = '.$oauth_base_text.'<br>';
/**
* В результате получим строку, такого вида:

GET&https%3A%2F%2Fapi.twitter.com%2Foauth%2Frequest_token&
oauth_callback%3Dhttp%253A%252F%252Fexpange.ru%252Ftwitter_auth.php%253Fauth%253D1%26
oauth_consumer_key%3DO0IgnYHonW4KGL6pJr0YCQ%26
oauth_nonce%3Dae058c443ef60f0fea73f10a89104eb9%26
oauth_signature_method%3DHMAC-SHA1%26
oauth_timestamp%3D1310727371%26
oauth_version%3D1.0

 * Естественно строка должны быть однострочной (переносы сделаны для удобства сравнения)
 */
    $key = TW_CONSUMER_SECRET."&"; // На конце должен быть амперсанд & !!!
    // key: OYUjBgJPl4yra3N32sSpSSVGboLSCo5pLGsky20VJE&
    // echo '$key = '.$key.'<br>';
    $oauth_signature = tw_get_oauth_signature($oauth_base_text,$key);
    // echo '$oauth_signature = '.$oauth_signature.'<br>';

    // формирование GET-запроса request_token
    // Опять же внимательно смотрим на функцию urlencode
    $url = TW_URL_REQUEST_TOKEN;
    $url .= '?oauth_callback='.urlencode(TW_URL_CALLBACK);
    $url .= '&oauth_consumer_key='.TW_CONSUMER_KEY;
    $url .= '&oauth_nonce='.$oauth_nonce;
    $url .= '&oauth_signature='.urlencode($oauth_signature);
    $url .= '&oauth_signature_method=HMAC-SHA1';
    $url .= '&oauth_timestamp='.$oauth_timestamp;
    $url .= '&oauth_version=1.1';
    // echo "\$url = ".$url."<br><br>";
/**
 * Строка запроса (Переносы строк естественно не нужны):

https://api.twitter.com/oauth/request_token
?oauth_callback=http%3A%2F%2Fexpange.ru%2Ftwitter_auth.php%3Fauth%3D1
&oauth_consumer_key=O0IgnYHonW4KGL6pJr0YCQ
&oauth_nonce=ae058c443ef60f0fea73f10a89104eb9
&oauth_signature=BB6w%2FjAdrHQD1%2FiUqqEZiI8o2M0%3D
&oauth_signature_method=HMAC-SHA1
&oauth_timestamp=1310727371
&oauth_version=1.0

 * Получить результат GET-запроса будем функцией file_get_contents
 * можно и даже лучше использовать curl, но здесь и эта функция справляется отлично
 *
 */
    $response = file_get_contents($url); // получение данных от сервера Twitter - обычная строка
    // var_dump($response); // обычная строка
    // echo "\$response = ".$response."<br>";

// если все сделано правильно, $response будет содержать нечто подобное:
// oauth_token=DZmWEaKh7EqOJKScI48IgYMxYyFF2riTyD5N9wqTA&oauth_token_secret=NuAL0AvzocI9zxO7VnVPrNEcb9EW8kwpwJmcqg5pMWg&oauth_callback_confirmed=true

// Если что-то не так, будет выведено следующее:
// Failed to validate oauth signature and token
// Самая распространенная ошибка, означающая, что в большинстве случаев
// подпись oauth_signature сформирована неправильно.
// Еще раз внимательно просмотрите как формируется строка и кодируется oauth_signature,
// сверьте с примером использования функций urlencode

// И так все выведено правильно. Разбираем полученную строку.

    parse_str($response, $result); // преобразование строки $response в ассоциативный массив $result
    // var_dump($result); // ассоциативный массив
    // print_array($result);
/**
 * $result:
Array
(
    [oauth_token] => DZmWEaKh7EqOJKScI48IgYMxYyFF2riTyD5N9wqTA
    [oauth_token_secret] => NuAL0AvzocI9zxO7VnVPrNEcb9EW8kwpwJmcqg5pMWg
    [oauth_callback_confirmed] => true
)
*/
    if (($result['oauth_token']) and ($result['oauth_token_secret'])) {
        $_SESSION['auth']['oauth_token'] = $result['oauth_token'];
        $_SESSION['auth']['oauth_token_secret'] = $result['oauth_token_secret'];
        //echo "\$result['oauth_token'] = ".$result['oauth_token']."<br>";
        //echo "\$result['oauth_token_secret'] = ".$result['oauth_token_secret']."<br>";
        //echo "\$result['oauth_callback_confirmed'] = ".$result['oauth_callback_confirmed']."<br>";
		return true;
	}
    else {
  		$_SESSION['auth']['error'] = 'Ошибка при получении oauth_token и oauth_verifier.';
		return false;
    }
}
function tw_authorize(){
    // Авторизация - самый простой этап, нам нужно сформировать строку запроса и перейти по сформированному адресу
    $url = TW_URL_AUTH.'?oauth_token='.$_SESSION['auth']['oauth_token'];
    // url: https://api.twitter.com/oauth/authorize?oauth_token=qexSk7ySxVV5DPr9j9zE0RuxT5Zxbp1rOPqemizeU
    // echo "\$url = ".$url;
    redirect($url);
}
function tw_get_access_token($oauth_token,$oauth_verifier) {
	if((!$oauth_token) or empty($oauth_token)) {
		exit('Не верный код авторизации');
	}
    if((!$oauth_verifier) or empty($oauth_verifier)) {
		exit('Не верный код авторизации2');
	}

    // oauth_token_secret получаем из сессии, которую зарегистрировали во время запроса request_token
    $oauth_token_secret = $_SESSION['auth']['oauth_token_secret'];
    // echo '$oauth_token_secret = '.$oauth_token_secret.'<br>';

    // удаляем из сессии ненужные токены
    unset($_SESSION['auth']['oauth_token']);
    unset($_SESSION['auth']['oauth_token_secret']);

    // Заново создаем oauth_nonce и oauth_timestamp
    $oauth_nonce = tw_get_oauth_nonce(); // рандомная строка (для безопасности) c775a2221c0d3a187438628e8427f262
    $oauth_timestamp = time(); // 1310727378; время когда будет выполняться запрос (в секундах)
    // echo '$oauth_timestamp = '.$oauth_timestamp.'<br>';
// Обратите внимание на использование функции urlencode и расположение амперсандов
// Если поменяете положение параметров oauth_... или уберете где-нибудь urlencode - получите ошибку
    $oauth_base_text = 'GET&';
    $oauth_base_text .= urlencode(TW_URL_ACCESS_TOKEN).'&';
    $oauth_base_text .= urlencode('oauth_consumer_key='.TW_CONSUMER_KEY.'&');
    $oauth_base_text .= urlencode('oauth_nonce='.$oauth_nonce.'&');
    $oauth_base_text .= urlencode('oauth_signature_method=HMAC-SHA1&');
    $oauth_base_text .= urlencode('oauth_token='.$oauth_token.'&');
    $oauth_base_text .= urlencode('oauth_timestamp='.$oauth_timestamp.'&');
    $oauth_base_text .= urlencode('oauth_verifier='.$oauth_verifier.'&');
    $oauth_base_text .= urlencode('oauth_version=1.1');
    // echo '$oauth_base_text = '.$oauth_base_text.'<br>';
/**
 * В результате получим строку, такого вида:

GET&https%3A%2F%2Fapi.twitter.com%2Foauth%2Faccess_token&
oauth_consumer_key%3DO0IgnYHonW4KGL6pJr0YCQ%26
oauth_nonce%3Dc775a2221c0d3a187438628e8427f262%26
oauth_signature_method%3DHMAC-SHA1%26
oauth_token%3DDZmWEaKh7EqOJKScI48IgYMxYyFF2riTyD5N9wqTA%26
oauth_timestamp%3D1310727378%26
oauth_verifier%3DEJxb8eSgNdiUZPwi5Qwwt7JPE13nfXpCXOZSwCqBU%26
oauth_version%3D1.0

 * Естественно строка должны быть однострочной (переносы сделаны для удобства сравнения)
 */

    // Ключ имеет следующее значение: Consumer secret + знак амперсанда + oauth_token_secret
    $key = TW_CONSUMER_SECRET.'&'.$oauth_token_secret;
    // key: OYUjBgJPl4yra3N32sSpSSVGboLSCo5pLGsky20VJE&NuAL0AvzocI9zxO7VnVPrNEcb9EW8kwpwJmcqg5pMWg
    // echo '$key = '.$key.'<br>';
    $oauth_signature = tw_get_oauth_signature($oauth_base_text,$key);
    // echo '$oauth_signature = '.$oauth_signature.'<br>';

    //Формирование GET-запроса access_token
    // Опять же внимательно смотрим на функцию urlencode
    $url = TW_URL_ACCESS_TOKEN;
    $url .= '?oauth_nonce='.$oauth_nonce;
    $url .= '&oauth_signature_method=HMAC-SHA1';
    $url .= '&oauth_timestamp='.$oauth_timestamp;
    $url .= '&oauth_consumer_key='.TW_CONSUMER_KEY;
    $url .= '&oauth_token='.urlencode($oauth_token);
    $url .= '&oauth_verifier='.urlencode($oauth_verifier);
    $url .= '&oauth_signature='.urlencode($oauth_signature);
    $url .= '&oauth_version=1.1';
    // echo "\$url = ".$url."<br><br>";
/**
 * Строка запроса $url (Переносы строк естественно не нужны):

https://api.twitter.com/oauth/access_token
?oauth_nonce=c775a2221c0d3a187438628e8427f262
&oauth_signature_method=HMAC-SHA1
&oauth_timestamp=1310727378
&oauth_consumer_key=O0IgnYHonW4KGL6pJr0YCQ
&oauth_token=DZmWEaKh7EqOJKScI48IgYMxYyFF2riTyD5N9wqTA
&oauth_verifier=EJxb8eSgNdiUZPwi5Qwwt7JPE13nfXpCXOZSwCqBU
&oauth_signature=WqIpf1g6fEdNk67Rc%2BcP9zxji5k%3D
&oauth_version=1.0

 * Получить результат GET-запроса будем функцией file_get_contents
 * можно и даже лучше использовать curl, но здесь и эта функция справляется отлично
 */

    $response = file_get_contents($url); // получение данных от сервера Twitter - обычная строка
    // var_dump($response); // обычная строка
    // echo "\$response = ".$response."<br>";

// если все сделано правильно, $response будет содержать нечто подобное:
// oauth_token=228497030-pmcYm211OCBvlRnLBA9pjbtpKtMQ7ofghRwWJYlA&oauth_token_secret=IyZ5SFgTfRWtluEyavSAkUi8MJMgdYCZUlt5aNNMg&user_id=228497030&screen_name=expange

// Разбираем полученную строку
    parse_str($response, $access_token); // преобразование строки $response в ассоциативный массив $access_token
    // var_dump($access_token); // ассоциативный массив
    // print_array($access_token);
/**
 * $access_token:
Array
(
    [oauth_token] => 228497030-pmcYm211OCBvlRnLBA9pjbtpKtMQ7ofghRwWJYlA
    [oauth_token_secret] => IyZ5SFgTfRWtluEyavSAkUi8MJMgdYCZUlt5aNNMg
    [user_id] => 228497030
    [screen_name] => expange
)
*/
    if (($access_token['oauth_token']) and ($access_token['oauth_token_secret'])) {
        //$_SESSION['auth']['oauth_token'] = $access_token['oauth_token']; // токен доступа
        //$_SESSION['auth']['oauth_token_secret'] = $access_token['oauth_token_secret']; // секретный токен
        $_SESSION['auth']['social_id'] = (string)$access_token['user_id']; // ID пользователя
        $_SESSION['auth']['screen_name'] = (string)$access_token['screen_name']; // отображаемое имя пользователя (логин)
        //echo "\$access_token['oauth_token'] = ".$access_token['oauth_token']."<br>";
        //echo "\$access_token['oauth_token_secret'] = ".$access_token['oauth_token_secret']."<br>";
        //echo "\$access_token['user_id'] = ".$access_token['user_id']."<br>";
        //echo "\$access_token['screen_name'] = ".$access_token['screen_name']."<br>";
		return $access_token;
	}
    else {
  		$_SESSION['auth']['error'] = 'Ошибка при получении access_token.';
		return false;
    }
}
function tw_get_user_data($access_token = array()) {
    // получение данных пользователя
    $oauth_token = $access_token['oauth_token']; // $_SESSION['auth']['oauth_token'];
    // echo "\$oauth_token = ".$oauth_token."<br>";
    $oauth_token_secret = $access_token['oauth_token_secret']; // $_SESSION['auth']['oauth_token_secret'];
    // echo "\$oauth_token_secret = ".$oauth_token_secret."<br>";
    $screen_name = $access_token['screen_name']; // $_SESSION['auth']['screen_name'];
    // echo "\$screen_name = ".$screen_name."<br>";

    // Заново создаем oauth_nonce и oauth_timestamp
    $oauth_nonce = tw_get_oauth_nonce(); // рандомная строка (для безопасности) c775a2221c0d3a187438628e8427f262
    $oauth_timestamp = time(); // 1310727378; время когда будет выполняться запрос (в секундах)
    // echo "\$oauth_timestamp = ".$oauth_timestamp."<br>";

    $oauth_base_text = 'GET&';
    $oauth_base_text .= urlencode(TW_URL_ACCOUNT_DATA).'&';
    $oauth_base_text .= urlencode('oauth_consumer_key='.TW_CONSUMER_KEY.'&');
    $oauth_base_text .= urlencode('oauth_nonce='.$oauth_nonce.'&');
    $oauth_base_text .= urlencode('oauth_signature_method=HMAC-SHA1&');
    $oauth_base_text .= urlencode('oauth_timestamp='.$oauth_timestamp."&");
    $oauth_base_text .= urlencode('oauth_token='.$oauth_token."&");
    $oauth_base_text .= urlencode('oauth_version=1.0&'); // версия отличается
    $oauth_base_text .= urlencode('screen_name='.$screen_name);
    // echo "\$oauth_base_text = ".$oauth_base_text."<br><br>";

    $key = TW_CONSUMER_SECRET.'&'.$oauth_token_secret;
    // echo '$key = '.$key.'<br><br>';
    $oauth_signature = tw_get_oauth_signature($oauth_base_text,$key);
    // echo '$oauth_signature = '.$oauth_signature.'<br><br>';

    // Формируем GET-запрос
    $url = TW_URL_ACCOUNT_DATA;
    $url .= '?oauth_consumer_key='.TW_CONSUMER_KEY;
    $url .= '&oauth_nonce='.$oauth_nonce;
    $url .= '&oauth_signature='.urlencode($oauth_signature);
    $url .= '&oauth_signature_method=HMAC-SHA1';
    $url .= '&oauth_timestamp='.$oauth_timestamp;
    $url .= '&oauth_token='.urlencode($oauth_token);
    $url .= '&oauth_version=1.0'; // версия отличается
    $url .= '&screen_name='.$screen_name;
    // echo '$url = '.$url.'<br><br>';

    // делаем запрос
    $response = file_get_contents($url); // получение данных от сервера Twitter - строка в формате json
    // var_dump($response); // строка в формате json
    // echo '$response = '.$response.'<br>';
    // разбираем запрос
    $tw_user_data = json_decode($response, true); // преобразование строки $response в ассоциативный массив $result
    // var_dump($tw_user_data); // ассоциативный массив
    // print_array($tw_user_data);
    if ($tw_user_data['id']) {
        // $_SESSION['auth']['id'] = "";
        $_SESSION['auth']['first_name'] = first_name_of_tw((string)$tw_user_data['name']);
        $_SESSION['auth']['last_name'] = last_name_of_tw((string)$tw_user_data['name']);
        $_SESSION['auth']['login'] = login_of_tw((string)$tw_user_data['screen_name'],(string)$tw_user_data['id']);
        // $_SESSION['auth']['password'] = '111';
        // $_SESSION['auth']['avatar'] = (string)$tw_user_data['profile_image_url'];
        $_SESSION['auth']['photo'] = (string)$tw_user_data['profile_image_url'];
        //$tw_user_data["email"] = '';
        $_SESSION['auth']['email'] = get_email();
        $_SESSION['auth']['site'] = site_of_tw((string)$tw_user_data['entities']['url']['urls'][0]['expanded_url'],(string)$tw_user_data['url'],(string)$tw_user_data['screen_name']);
        // $_SESSION['auth']['activation'] = "1";
        $_SESSION['auth']['method'] = 3;
        // $_SESSION['auth']['social_id'] = (string)$tw_user_data['id'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = birthday_of_tw((string)$tw_user_data['created_at']); // '0000-00-00';
        $_SESSION['auth']['gender'] = 0;
        //$_SESSION['auth']['timezone'] = $tw_user_data['time_zone'];
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
    [id] => 541416583
    [id_str] => 541416583
    [name] => Артур Абзалов
    [screen_name] => rolaraav
    [url] => http://t.co/tlrjSiv1N3
    [entities][url][urls][0] => Array
                                    [url] => http://t.co/tlrjSiv1N3
                                    [expanded_url] => http://rolar.ru
                                    [display_url] => rolar.ru
    [protected] => 
    [followers_count] => 11
    [friends_count] => 37
    [listed_count] => 1
    [created_at] => Sat Mar 31 06:30:56 +0000 2012
    [favourites_count] => 1
    [utc_offset] => 21600
    [time_zone] => Ekaterinburg
    [geo_enabled] => 
    [verified] => 
    [statuses_count] => 177
    [lang] => ru
    [profile_image_url] => http://pbs.twimg.com/profile_images/2774599445/c45f88f5bc85fa7ceb4732f9a403e69a_normal.jpeg
    [profile_image_url_https] => https://pbs.twimg.com/profile_images/2774599445/c45f88f5bc85fa7ceb4732f9a403e69a_normal.jpeg
)
*/
        return true;
    }
    else {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя.';
		return false;
    }
/** Результат в виде объекта будет примерно следующего содержания:
    [default_profile_image] => 
    [profile_background_tile] => 
    [protected] => 
    [default_profile] => 
    [contributors_enabled] => 
    [url] => http://expange.ru
    [name] => expange.ru
    [id_str] => 228497030
    [is_translator] => 
    [show_all_inline_media] => 1
    [geo_enabled] => 
    [profile_link_color] => 1F98C7
    [follow_request_sent] => 
    [utc_offset] => 10800
    [created_at] => Sun Dec 19 22:12:45 +0000 2010
    [friends_count] => 2
    [profile_sidebar_border_color] => C6E2EE
    [following] => 
    [time_zone] => Moscow
    [profile_image_url] => http://a3.twimg.com/profile_images/1228124572/expange_normal.png
    [description] => 
    [statuses_count] => 106
    [profile_use_background_image] => 1
    [favourites_count] => 0
    [status] => stdClass Object
        (
            [place] => 
            [truncated] => 
            [id_str] => 91646116151570432
            [in_reply_to_status_id] => 
            [text] => Авторизация на сайте через twitter (PHP) http://t.co/SRtztLi via @expange
            [created_at] => Thu Jul 14 23:11:51 +0000 2011
            [geo] => 
            [favorited] => 
            [in_reply_to_status_id_str] => 
            [coordinates] => 
            [id] => 91646116151570432
            [in_reply_to_screen_name] => 
            [source] => Tweet Button
            [in_reply_to_user_id_str] => 
            [in_reply_to_user_id] => 
            [contributors] => 
            [retweeted] => 
            [retweet_count] => 0
        )
    [verified] => 
    [profile_background_color] => C6E2EE
    [screen_name] => expange
    [listed_count] => 0
    [profile_background_image_url] => http://a1.twimg.com/images/themes/theme2/bg.gif
    [id] => 228497030
    [notifications] => 
    [profile_background_image_url_https] => https://si0.twimg.com/images/themes/theme2/bg.gif
    [profile_text_color] => 663B12
    [lang] => en
    [profile_sidebar_fill_color] => DAECF4
    [followers_count] => 1
    [profile_image_url_https] => https://si0.twimg.com/profile_images/1228124572/expange_normal.png
    [location] => Moscow
-------------------------------------------------------------------------------------------------------
    [id] => 541416583
    [id_str] => 541416583
    [name] => Артур Абзалов
    [screen_name] => rolaraav
    [location] => 
    [profile_location] => 
    [description] => 
    [url] => http://t.co/tlrjSiv1N3
    [protected] => 
    [followers_count] => 11
    [friends_count] => 37
    [listed_count] => 0
    [created_at] => Sat Mar 31 06:30:56 +0000 2012
    [favourites_count] => 0
    [utc_offset] => 21600
    [time_zone] => Ekaterinburg
    [geo_enabled] => 
    [verified] => 
    [statuses_count] => 173
    [lang] => ru
    [contributors_enabled] => 
    [is_translator] => 
    [is_translation_enabled] => 
    [profile_background_color] => C0DEED
    [profile_background_image_url] => http://abs.twimg.com/images/themes/theme1/bg.png
    [profile_background_image_url_https] => https://abs.twimg.com/images/themes/theme1/bg.png
    [profile_background_tile] => 
    [profile_image_url] => http://pbs.twimg.com/profile_images/2774599445/c45f88f5bc85fa7ceb4732f9a403e69a_normal.jpeg
    [profile_image_url_https] => https://pbs.twimg.com/profile_images/2774599445/c45f88f5bc85fa7ceb4732f9a403e69a_normal.jpeg
    [profile_link_color] => 0084B4
    [profile_sidebar_border_color] => C0DEED
    [profile_sidebar_fill_color] => DDEEF6
    [profile_text_color] => 333333
    [profile_use_background_image] => 1
    [default_profile] => 1
    [default_profile_image] => 
    [following] => 
    [follow_request_sent] => 
    [notifications] => 
    [suspended] => 
    [needs_phone_verification] => 
**/
}

// Функции авторизации в Одноклассниках
/* Функция получения логина из одноклассников */
function login_of_ok($name=null,$social_id) {
    if (empty($name) or ($name == '')) {
        if (empty($social_id) or ($social_id == '')) {
            $login = 'ok'.(string)time();
        }
        else {
            $login = 'ok'.(string)$social_id;
        }
    }
    else {
        $login = translit_text(str_replace(' ','',(string)$name));
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}
// Функция для получения пола пользователя из одноклассников
function gender_of_ok($strgender = null) {
    if (empty($strgender) or ($strgender == '')) {
        $gender = 0;
    }
    if ($strgender == 'female') {
        $gender = 1;
    }
    if ($strgender == 'male') {
        $gender = 2;
    }
    return $gender;
}

// Функция получения кода авторизации
function ok_get_code(){
    $parametrs = array(
        'client_id' => OK_CLIENT_ID,
        //'scope' => 'VALUABLE_ACCESS', // основное право, без которого доступ возможен только к методам users.getLoggedInUser и users.getCurrentUser;
        'response_type' => 'code',
        'redirect_uri' => OK_REDIRECT_URI
    );
    $ok_code_url = OK_URL_AUTH."?".urldecode(http_build_query($parametrs));
    // echo $ok_code_url;
	redirect($ok_code_url);
}
function ok_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $parametrs = array(
        'code' => $code,
        'redirect_uri' => OK_REDIRECT_URI,
        'grant_type' => 'authorization_code',
        'client_id' => OK_CLIENT_ID,
        'client_secret' => OK_CLIENT_SECRET
    );
	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,OK_URL_ACCESS_TOKEN); // адрес, куда будет отправлен запрос на получение Токена
    curl_setopt($url,CURLOPT_POST, 1);
    curl_setopt($url,CURLOPT_POSTFIELDS,urldecode(http_build_query($parametrs))); // передаём параметры
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,false);
	$response = curl_exec($url); // ответ от сервера Одноклассники
    curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Одноклассники - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$access_token = json_decode($response, true); // ассоциативный массив
    // var_dump($access_token); // ассоциативный массив
    // print_array($access_token);
    if ($access_token['access_token']) {
        //$_SESSION['auth']['token_type'] = $access_token['token_type']; // тип токена, значение session
        //$_SESSION['auth']['refresh_token'] = $access_token['refresh_token']; // refresh_token
        //$_SESSION['auth']['access_token'] = $access_token['access_token']; // access_token
        //echo "\$access_token['token_type'] = ".$access_token['token_type']."<br>";
        //echo "\$access_token['refresh_token'] = ".$access_token['refresh_token']."<br>";
        //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
		return $access_token; // $access_token - это массив, в который будут сохранятся данные из строки $response
	}
	elseif ($access_token['error']) {
		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$access_token['error_description'];
		return false;
	}
}
function ok_get_user_data($access_token = array()) {
    // echo $token['access_token'];
    // прописываем все необходимые поля
    $fields = 'uid,first_name,last_name,name,gender,birthday,has_email,photo_id,pic128x128,email'; // необходимые поля
    // получаем упорядоченную по алфавиту конкатенацию параметров в UTF-8
    $parametrs_for_sig = 'application_key='.OK_PUBLIC_KEY.'fields='.$fields.'format=jsonmethod=users.getCurrentUser'; // Обратите внимание, что параметр "access_token" не участвует в конкатенации
    // получаем код md5 для access_token и application_secret_key
    $md5_atsk = md5($access_token['access_token'].OK_CLIENT_SECRET); // получение кода md5 для access_token и application_secret_key
    // Добавляем к конкатенации MD5 (access_token + application_secret_key) и расчитываем MD5 от полученной строки и приводим её к нижнему регистру - это и есть подпись (параметр sig):
    $sign = mb_strtolower(md5($parametrs_for_sig.$md5_atsk), 'UTF-8'); // получение подписи sig
    //$parametrs_for_url = "application_key=".OK_PUBLIC_KEY."&fields=".$fields."&format=json&method=users.getCurrentUser&access_token=".$access_token['access_token']."&sig=".$sign; // параметры для url-запроса, не используются
    $parametrs = array(
        'application_key' => OK_PUBLIC_KEY,
        'fields' => $fields,
        'format' => 'json',
        'method' => 'users.getCurrentUser',
        'access_token' => $access_token['access_token'],
        'sig' => $sign,
    );
    //$url1 = OK_URL_GET_USER.'?'.$parametrs_for_url; - рабочий вариант получения ссылки, но не используется
    $url = OK_URL_GET_USER.'?'.urldecode(http_build_query($parametrs)); // получение полного адреса запроса
    // echo $url1.'<br>';
    // echo $url.'<br>'; // адрес получения данных пользователя
    $response = file_get_contents($url); // получение данных от сервера Одноклассников - строка в формате json
    // var_dump($response); // строка в формате json
    // echo "\$response = ".$response."<br>";
    $ok_user_data = json_decode($response, true); // преобразование строки $response в ассоциативный массив $ok_user_data
    // var_dump($ok_user_data); // ассоциативный массив
    // print_array($ok_user_data);
    if ($ok_user_data['uid']) {
        // $_SESSION['auth']['id'] = "";
        $_SESSION['auth']['first_name'] = validate((string)$ok_user_data['first_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$ok_user_data['last_name'],'name');
        $_SESSION['auth']['login'] = login_of_ok((string)$ok_user_data['name'],(string)$ok_user_data['uid']);
        // $_SESSION['auth']['password'] = '111';
        // $_SESSION['auth']['avatar'] = (string)$ok_user_data['pic128x128'];
        $_SESSION['auth']['photo'] = (string)$ok_user_data['pic128x128'];
        //$ok_user_data['email'] = '';
        $_SESSION['auth']['email'] = get_email();
        $_SESSION['auth']['site'] = 'https://ok.ru/profile/'.(string)$ok_user_data['uid'];
        // $_SESSION['auth']['activation'] = '1';
        $_SESSION['auth']['method'] = 4;
        $_SESSION['auth']['social_id'] = (string)$ok_user_data['uid'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = (string)$ok_user_data['birthday']; // '1987-05-22';
        $_SESSION['auth']['gender'] = gender_of_ok((string)$ok_user_data['gender']);
        // $_SESSION['auth']['has_email'] = $ok_user_data['has_email'];
        // $_SESSION['auth']['photo_id'] = $ok_user_data['photo_id'];
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
    [uid] => 63599469546
    [birthday] => 1987-05-22
    [first_name] => Артур
    [last_name] => Абзалов
    [name] => Артур Абзалов
    [gender] => male
    [has_email] => 1
    [photo_id] => 395198197994
    [pic128x128] => http://umd3.mycdn.me/image?id=395198197994&bid=395198197994&t=34&plc=API&viewToken=vUnaWXMP-exNSDgUs6884Q&tkn=rPNdhS_tPSqrMGM3g5KiQPadqVo
*/
        return true;
    }
    elseif($ok_user_data['error_code']) {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя: '.$ok_user_data['error_msg'].'.<br> Код ошибки: '.$ok_user_data['error_code'].'.';
		return false;
    }
}

// Функции авторизации через Mail.ru
/* Функция получения логина из Mail.ru */
function login_of_mr($nick,$last_visit) {
    if (empty($nick) or ($nick == "")) {
        if (empty($last_visit) or ($last_visit == '')) {
            $login = 'mr'.(string)time();
        }
        else {
            $login = 'mr'.(string)$last_visit;
        }
    }
    else {
        $login = translit_text(str_replace(' ','',(string)$nick));
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}
/* Функция, которая преобразовывает дату из Mail.ru в нужный вид */
function birthday_of_mr($strdate) { // 22.05.1987
    if (empty($strdate)) {$strdate = '00.00.0000';}
    $date_elements = explode('.',$strdate); // Разбиение строки на части
    if (empty($date_elements[0])) {$date_elements[0] = '00';}
    if (empty($date_elements[1])) {$date_elements[1] = '00';}
    if (empty($date_elements[2])) {$date_elements[2] = '0000';}
    if (mb_strlen($date_elements[0],'UTF-8') == 1) {
        $date_elements[0] = '0'.$date_elements[0]; // день
    }
    if (mb_strlen($date_elements[1],'UTF-8') == 1) {
        $date_elements[1] = '0'.$date_elements[1]; // месяц
    }
    $newstrdate = $date_elements[2].'-'.$date_elements[1].'-'.$date_elements[0]; // преобразование даты в нужный вид
    return $newstrdate; // вывод результата YYYY-MM-DD
}
// Функция для получения пола пользователя из Mail.ru
function gender_of_mr($mrgender = null) {
    if (empty($mrgender) or ($mrgender == '')) {
        $gender = 0;
    }
    if ($mrgender == 1) {
        $gender = 1;
    }
    if ($mrgender == 0) {
        $gender = 2;
    }
    return $gender;
}

// Функция получения кода авторизации Mail.ru
function mr_get_code(){
    $parametrs = array(
        'client_id' => MR_CLIENT_ID,
        'response_type' => 'code',
        'redirect_uri' => MR_REDIRECT_URI
    );
    $mr_code_url = MR_URL_AUTH.'?'.urldecode(http_build_query($parametrs));
    // echo $mr_code_url;
	redirect($mr_code_url);
}
function mr_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $parametrs = array(
        'client_id'     => MR_CLIENT_ID,
        'client_secret' => MR_SECRET_KEY,
        'grant_type'    => 'authorization_code',
        'code'          => $code,
        'redirect_uri'  => MR_REDIRECT_URI
    );
	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,MR_URL_ACCESS_TOKEN); // адрес, куда будет отправлен запрос на получение Токена
    curl_setopt($url,CURLOPT_POST, 1);
    curl_setopt($url,CURLOPT_POSTFIELDS,urldecode(http_build_query($parametrs))); // передаём параметры
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,false);
	$response = curl_exec($url); // ответ от сервера Mail.Ru
    curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Mail.Ru - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$access_token = json_decode($response, true); // ассоциативный массив
    // var_dump($access_token); // ассоциативный массив
    // print_array($access_token);
    if ($access_token['access_token']) {
        //$_SESSION['auth']['refresh_token'] = $access_token['refresh_token']; // refresh_token
        //$_SESSION['auth']['expires_in'] = $access_token['expires_in']; // время жизни
        //$_SESSION['auth']['access_token'] = $access_token['access_token']; // access_token
        //$_SESSION['auth']['token_type'] = $access_token['token_type']; // тип токена, значение bearer
        $_SESSION['auth']['social_id'] = $access_token['x_mailru_vid']; // id пользователя
        //echo "\$access_token['refresh_token'] = ".$access_token['refresh_token']."<br>";
        //echo "\$access_token['expires_in'] = ".$access_token['expires_in']."<br>";
        //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
        //echo "\$access_token['token_type'] = ".$access_token['token_type']."<br>";
        //echo "\$access_token['x_mailru_vid'] = ".$access_token['x_mailru_vid']."<br>";
		return $access_token; // $access_token - это массив, в который будут сохранятся данные из строки $response
	}
	elseif ($access_token['error']) {
		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$access_token['error'];
		return false;
	}
}
function mr_get_user_data($access_token = array()) {
    // получаем упорядоченную по алфавиту конкатенацию параметров в UTF-8
    $parametrs_for_sig = 'app_id='.MR_CLIENT_ID.'method=users.getInfosecure=1session_key='.$access_token['access_token'].MR_SECRET_KEY;
    // echo '$parametrs_for_sig = '.$parametrs_for_sig.'<br>';
    $sign = mb_strtolower(md5($parametrs_for_sig), 'UTF-8'); // получение подписи sig
    // echo '$sign = '.$sign.'<br>';
    $parametrs = array(
        'method' => 'users.getInfo',
        'secure' => '1',
        'app_id' => MR_CLIENT_ID,
        'session_key' => $access_token['access_token'],
        'sig' => $sign
    );
    $url = MR_URL_GET_USER.'?'.urldecode(http_build_query($parametrs)); // получение полного адреса запроса
    // echo $url.'<br>'; // адрес получения данных пользователя
    $response = file_get_contents($url); // получение данных от сервера Mail.Ru - строка в формате json
    // var_dump($response); // строка в формате json
    // echo "\$response = ".$response."<br>";
    $mr_user_data = json_decode($response, true); // преобразование строки $response в ассоциативный массив $mr_user_data
    // var_dump($mr_user_data); // ассоциативный массив
    // print_array($mr_user_data);
    if ($mr_user_data[0]['uid']) {
        // $_SESSION['auth']['id'] = '';
        $_SESSION['auth']['first_name'] = validate((string)$mr_user_data[0]['first_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$mr_user_data[0]['last_name'],'name');
        $_SESSION['auth']['login'] = login_of_mr((string)$mr_user_data[0]['nick'],(string)$mr_user_data[0]['last_visit']);
        // $_SESSION['auth']['password'] = '111';
        // $_SESSION['auth']['avatar'] = (string)$mr_user_data[0]['pic'];
        $_SESSION['auth']['photo'] = (string)$mr_user_data[0]['pic'];
        // $mr_user_data[0]["email"] = '';
        $_SESSION['auth']['email'] = get_email((string)$mr_user_data[0]['email']);
        $_SESSION['auth']['site'] = (string)$mr_user_data[0]['link']; // страница пользователя
        // $_SESSION['auth']['activation'] = "1";
        $_SESSION['auth']['method'] = 5;
        // $_SESSION['auth']['social_id'] = (string)$mr_user_data[0]['uid'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = birthday_of_mr((string)$mr_user_data[0]['birthday']); // '1987-05-22';
        $_SESSION['auth']['gender'] = gender_of_mr((integer)$mr_user_data[0]['sex']); // ['sex'] = 0 - мужчина, 1 - женщина
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
            [pic_50] => http://avt-12.foto.mail.ru/list/rolar/_avatar50?1329576826
            [video_count] => 3
            [friends_count] => 79
            [show_age] => 1
            [nick] => Артур Абзалов
            [is_friend] => 0
            [is_online] => 1
            [email] => rolar@list.ru
            [has_pic] => 1
            [pic_190] => http://avt-8.foto.mail.ru/list/rolar/_avatar190?1329576826
            [referer_id] => 
            [pic_32] => http://avt-22.foto.mail.ru/list/rolar/_avatar32?1329576826
            [referer_type] => 
            [last_visit] => 1423766698
            [location] => Array
                (
                    [country] => Array
                        (
                            [name] => Россия
                            [id] => 24
                        )

                    [city] => Array
                        (
                            [name] => Уфа
                            [id] => 501
                        )

                    [region] => Array
                        (
                            [name] => Башкортостан
                            [id] => 237
                        )

                )

            [uid] => 11913669547422588513
            [app_installed] => 1
            [status_text] => 
            [pic_22] => http://avt-3.foto.mail.ru/list/rolar/_avatar22?1329576826
            [age] => 27
            [last_name] => Абзалов
            [is_verified] => 1
            [pic_big] => http://avt-26.foto.mail.ru/list/rolar/_avatarbig?1329576826
            [vip] => 0
            [birthday] => 22.05.1987
            [link] => http://my.mail.ru/list/rolar/
            [pic_128] => http://avt-17.foto.mail.ru/list/rolar/_avatar128?1329576826
            [sex] => 0
            [pic_small] => http://avt-22.foto.mail.ru/list/rolar/_avatarsmall?1329576826
            [pic] => http://avt-21.foto.mail.ru/list/rolar/_avatar?1329576826
            [pic_180] => http://avt-3.foto.mail.ru/list/rolar/_avatar180?1329576826
            [first_name] => Артур
            [pic_40] => http://avt-5.foto.mail.ru/list/rolar/_avatar40?1329576826
        )
*/
        return true;
    }
    else {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя.';
		return false;
    }
}

// Функции авторизации через Google
/* Функция получения логина из Google */
function login_of_go($name) {
    if (empty($name) or ($name == '')) {
        $login = 'go'.(string)time();
    }
    else {
        $login = translit_text(str_replace(' ','',(string)$name));
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}

// функция получения кода авторизации
function go_get_code(){
    $parametrs = array(
        'redirect_uri' => GO_REDIRECT_URI,
        'response_type' => 'code',
        'client_id' => GO_CLIENT_ID,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.login'
        // 'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        // 'include_granted_scopes' => 'true'
    );
    $go_code_url = GO_URL_AUTH.'?'.urldecode(http_build_query($parametrs));
    // echo $go_code_url;
	redirect($go_code_url);
}
function go_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $parametrs = array(
        'client_id' => GO_CLIENT_ID,
        'client_secret' => GO_CLIENT_SECRET,
        'redirect_uri' => GO_REDIRECT_URI,
        'grant_type' => 'authorization_code',
        'code' => $code
    );
	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,GO_URL_ACCESS_TOKEN); // адрес, куда будет отправлен запрос на получение Токена
    curl_setopt($url,CURLOPT_POST, 1);
    curl_setopt($url,CURLOPT_POSTFIELDS,urldecode(http_build_query($parametrs))); // передаём параметры
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,false);
	$response = curl_exec($url); // ответ от сервера Google
    curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Google - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$access_token = json_decode($response, true); // ассоциативный массив
    // var_dump($access_token); // ассоциативный массив
    // print_array($access_token);
    if ($access_token['access_token']) {
        //$_SESSION['auth']['access_token'] = $access_token['access_token']; // access_token
        //$_SESSION['auth']['token_type'] = $access_token['token_type']; // тип токена, значение Bearer
        //$_SESSION['auth']['expires_in'] = $access_token['expires_in']; // время жизни
        //$_SESSION['auth']['id_token'] = $access_token['id_token'];
        //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
        //echo "\$access_token['token_type'] = ".$access_token['token_type']."<br>";
        //echo "\$access_token['expires_in'] = ".$access_token['expires_in']."<br>";
        //echo "\$access_token['id_token'] = ".$access_token['id_token']."<br>";
		return $access_token; // $access_token - это массив, в который будут сохранятся данные из строки $response
	}
	elseif ($access_token['error']) {
		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$access_token['error_description'];
		return false;
	}
}
function go_get_user_data($access_token = array(),$code = null) {
    $parametrs = array(
        'client_id' => GO_CLIENT_ID,
        'client_secret' => GO_CLIENT_SECRET,
        'redirect_uri' => GO_REDIRECT_URI,
        'grant_type' => 'authorization_code',
        'code' => $code, // передавать необязательно
        'access_token' => $access_token['access_token']
    );
    $url = GO_URL_GET_USER.'?'.urldecode(http_build_query($parametrs)); // получение полного адреса запроса
    // echo $url.'<br>'; // адрес получения данных пользователя
    $response = file_get_contents($url); // получение данных от сервера Google - строка в формате json
    // var_dump($response); // строка в формате json
    // echo "\$response = ".$response."<br>";
    $go_user_data = json_decode($response, true); // преобразование строки $response в ассоциативный массив $mr_user_data
    // var_dump($go_user_data); // ассоциативный массив
    // print_array($go_user_data);
    if ($go_user_data['id']) {
        // $_SESSION['auth']['id'] = "";
        $_SESSION['auth']['first_name'] = validate((string)$go_user_data['given_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$go_user_data['family_name'],'name');
        $_SESSION['auth']['login'] = login_of_go((string)$go_user_data['name']);
        // $_SESSION['auth']['password'] = "111";
        //$_SESSION['auth']['avatar'] = (string)$go_user_data['picture'];
        $_SESSION['auth']['photo'] = (string)$go_user_data['picture'];
        // $go_user_data['email'] = '';
        $_SESSION['auth']['email'] = get_email((string)$go_user_data['email']);
        $_SESSION['auth']['site'] = (string)$go_user_data['link']; // страница пользователя
        // $_SESSION['auth']['activation'] = "1";
        $_SESSION['auth']['method'] = 6;
        $_SESSION['auth']['social_id'] = (string)$go_user_data['id'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = '0000-00-00'; // '1987-05-22';
        $_SESSION['auth']['gender'] = 0;
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
    [id] => 103554015623328237159
    [email] => rolaraav@gmail.com
    [verified_email] => 1
    [name] => Артур Абзалов
    [given_name] => Артур
    [family_name] => Абзалов
    [link] => https://plus.google.com/103554015623328237159
    [picture] => https://lh3.googleusercontent.com/-irM-3cpYJao/AAAAAAAAAAI/AAAAAAAAAEA/4nyWErR-m2M/photo.jpg
    [locale] => ru
*/
        return true;
    }
    else {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя.';
		return false;
    }
}

// Функции авторизации через Яндекс
/* Функция получения логина из Яндекса */
function login_of_ya($login=null,$display_name=null,$real_name=null,$social_id) {
    if (empty($login) or ($login == "")) {
        if (empty($display_name) or ($display_name == '')) {
            if (empty($real_name) or ($real_name == '')) {
                if (empty($social_id) or ($social_id == '')) {
                    $login = 'ya'.(string)time();
                }
                else {
                    $login = 'ya'.(string)$social_id;
                }
            }
            else {
                $login = translit_text(str_replace(' ','',(string)$real_name));
            }
        }
        else {
            $login = (string)$display_name;
        }
    }
    else {
        $login = (string)$login;
    }
    if (strlen($login) > 15) {
        $login = mb_substr($login,0,15,'UTF-8');
    }
    $login = validate($login,'login'); // проверяем введенные данные и чистим от ссылок логин
    return $login;
}
// Функция для получения пола пользователя из яндекса
function gender_of_ya($strgender = null) {
    if (empty($strgender) or ($strgender == '')) {
        $gender = 0;
    }
    if ($strgender == 'female') {
        $gender = 1;
    }
    if ($strgender == 'male') {
        $gender = 2;
    }
    return $gender;
}

// Функция для получения кода авторизации
function ya_get_code(){
    $parametrs = array(
        'response_type' => 'code',
        'client_id' => YA_CLIENT_ID,
        'display' => 'popup'
    );
    $ya_code_url = YA_URL_AUTH.'?'.urldecode(http_build_query($parametrs));
    // echo $ya_code_url;
	redirect($ya_code_url);
}
function ya_get_access_token($code) {
	if((!$code) or empty($code)) {
		exit('Не верный код авторизации');
	}

    $parametrs = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'client_id' => YA_CLIENT_ID,
        'client_secret' => YA_PASSWORD
    );
	$url = curl_init(); // открытие соединения с библиотекой curl
	curl_setopt($url,CURLOPT_URL,YA_URL_ACCESS_TOKEN); // адрес, куда будет отправлен запрос на получение Токена
    curl_setopt($url,CURLOPT_POST, 1);
    curl_setopt($url,CURLOPT_POSTFIELDS,urldecode(http_build_query($parametrs))); // передаём параметры
	curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($url,CURLOPT_SSL_VERIFYPEER,false);
	$response = curl_exec($url); // ответ от сервера Яндекс
    curl_close($url); // закрытие соединения с библиотекой curl
    // var_dump($response); // ответ от сервера Яндекс - строка в формате json
    if(!$response) { // если ответ от сервера не получен, то выдаём сообщение об ошибке
        exit(curl_error($url));
    }

	$access_token = json_decode($response, true); // ассоциативный массив
    // var_dump($access_token); // ассоциативный массив
    // print_array($access_token);
    if ($access_token['access_token']) {
        //$_SESSION['auth']['token_type'] = $access_token['token_type']; // тип токена, значение bearer
        //$_SESSION['auth']['access_token'] = $access_token['access_token']; // access_token
        //$_SESSION['auth']['expires_in'] = $access_token['expires_in']; // время жизни
        //echo "\$access_token['token_type'] = ".$access_token['token_type']."<br>";
        //echo "\$access_token['access_token'] = ".$access_token['access_token']."<br>";
        //echo "\$access_token['expires_in'] = ".$access_token['expires_in']."<br>";
		return $access_token; // $access_token - это массив, в который будут сохранятся данные из строки $response
	}
	elseif ($access_token['error']) {
		$_SESSION['auth']['error'] = 'Ошибка при получении токена: '.$access_token['error_description'];
		return false;
	}
}
function ya_get_user_data($access_token = array()) {
    $parametrs = array(
        'format' => 'json',
        'oauth_token' => $access_token['access_token']
    );
    $url = YA_URL_GET_USER.'?'.urldecode(http_build_query($parametrs)); // получение полного адреса запроса
    // echo $url.'<br>'; // адрес получения данных пользователя
    $response = file_get_contents($url); // получение данных от сервера Яндекс - строка в формате json
    // var_dump($response); // строка в формате json
    // echo "\$response = ".$response."<br>";
    $ya_user_data = json_decode($response, true); // преобразование строки $response в ассоциативный массив $mr_user_data
    // var_dump($ya_user_data); // ассоциативный массив
    // print_array($ya_user_data);
    if ($ya_user_data['id']) {
        // $_SESSION['auth']['id'] = "";
        $_SESSION['auth']['first_name'] = validate((string)$ya_user_data['first_name'],'name');
        $_SESSION['auth']['last_name'] = validate((string)$ya_user_data['last_name'],'name');
        $_SESSION['auth']['login'] = login_of_ya((string)$ya_user_data['login'],(string)$ya_user_data['display_name'],(string)$ya_user_data['real_name'],(string)$ya_user_data['id']);
        // $_SESSION['auth']['password'] = '111';
        //$_SESSION['auth']['avatar'] = 'https://upics.yandex.net/'.(string)$ya_user_data['default_avatar_id'].'/normal';
        $_SESSION['auth']['photo'] = 'https://upics.yandex.net/'.(string)$ya_user_data['default_avatar_id'].'/normal';
        // $ya_user_data['default_email'] = '';
        $_SESSION['auth']['email'] = get_email((string)$ya_user_data['default_email']);
        $_SESSION['auth']['site'] = 'https://api-yaru.yandex.ru/person/'.(string)$ya_user_data['id']; // страница пользователя
        // $_SESSION['auth']['activation'] = "1";
        $_SESSION['auth']['method'] = 7;
        $_SESSION['auth']['social_id'] = (string)$ya_user_data['id'];
        // $_SESSION['auth']['date'] = date("Y-m-d H:i:s");
        $_SESSION['auth']['birthday'] = (string)$ya_user_data['birthday']; // '1987-05-22';
        $_SESSION['auth']['gender'] = gender_of_ya((string)$ya_user_data['sex']);
        if ($_SESSION['auth']['email'] == '') {
            redirect(D);
        }
/**
    [first_name] => Артур
    [last_name] => Абзалов
    [display_name] => rolaraav
    [emails] => Array
        (
            [0] => rolaraav@yandex.ru
        )

    [default_email] => rolaraav@yandex.ru
    [real_name] => Артур Абзалов
    [birthday] => 1987-05-22
    [default_avatar_id] => 22180553
    [login] => rolaraav
    [sex] => male
    [id] => 22180553
*/
        return true;
    }
    else {
        $_SESSION['auth']['error'] = 'Ошибка при получении данных пользователя.';
		return false;
    }
}
?>