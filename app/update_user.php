<?php
defined('A') or die('Access denied');
// изменение данных пользователя
if (isset($_POST['update_submit'])) {

// Старый логин нам пригодится
$old_login = $this->user['login'];
// идентификатор пользователя тоже нужен для переадресации на его страницу
$user_id = $this->user['id']; //$id

// проверка токена - заносим сгенерированный токен в переменную $token, если он пустой, то уничтожаем переменную и останавливаем скрипт
$token = isset($_POST['token']) ? trim($_POST['token']) : null;
//debug($token);
if ((empty($token)) or (!$this->checkToken($token,'update_user'))) {
  $_SESSION['update_user']['token'] = 'Ошибка при отправке данных. Форма не валидна'; $this->errors['token'] = $_SESSION['update_user']['token'].'<br>';
  $_SESSION['update_user_result'] = '<div class="alert alert-danger">Ошибка при отправке данных. Форма не валидна</div>';
  unset($token);
  return false;
}

// сообщение об ошибке
//$warning_message = '';
//$good_message = '';
//$bad_message = '';
//$_SESSION['update_first_name']['error'] = '';
//$_SESSION['update_first_name']['result'] = '';

//debug($_POST);

// ИЗМЕНЕНИЕ ИМЕНИ
// если существует имя
if (isset($_POST['first_name'])) {
  //$_SESSION['update_first_name']['error'] = '';
  //$_SESSION['update_first_name']['result'] = '';
  // получаем имя из массива $_POST
  $first_name = trim($_POST['first_name']);
  // если имя пустое, то выводим сообщение об ошибке
  if (empty($first_name)) {
    $_SESSION['update_first_name']['error'] = 'Вы не ввели Ваше имя! Введите Ваше новое имя';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $first_name = validate($first_name,'name');
  if ((empty($_SESSION['update_first_name']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_first_name']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  // проверяем длину имени: если длина имени меньше 2 и больше 30 символов, то выдаём ошибку
  if (!check_length($first_name, 2, 30)) {
    if (empty($_SESSION['update_first_name']['error'])) {
      $_SESSION['update_first_name']['error'] = 'Имя должно состоять не менее чем из 2-х символов и не более чем из 30';
    }
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_first_name']['error'])) {
    // обновляем в базе имя пользователя
    $result_update_first_name = $this->UserModel->update_first_name($first_name, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_first_name == true) {
      // сообщаем пользователю, что его имя изменено и отправляем пользователя назад на его страницу
      $_SESSION['update_first_name']['result'] = 'Ваше имя успешно изменено! Ваше новое имя: <strong>'.$first_name.'</strong>';
      unset($_SESSION['update_first_name']['error']);
    }
    else { // иначе сообщаем об ошибке
      $_SESSION['update_first_name']['error'] = 'Произошла ошибка! Ваше имя не изменено';
    }
  }
}

// ИЗМЕНЕНИЕ ФАМИЛИИ
// если существует фамилия
if (isset($_POST['last_name'])) {
  //$_SESSION['update_last_name']['error'] = '';
  //$_SESSION['update_last_name']['result'] = '';
  // получаем фамилию из массива $_POST
  $last_name = trim($_POST['last_name']);
  // если фамилия пустая, то выводим сообщение об ошибке
  if (empty($last_name)) {
    $_SESSION['update_last_name']['error'] = 'Вы не ввели Вашу фамилию! Введите Вашу новую фамилию';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $last_name = validate($last_name, 'name');
  if ((empty($_SESSION['update_last_name']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_last_name']['error'] = 'Фамилия введёна неверно. Фамилия должна состоять только из русских или только из латинских букв';
    unset($_SESSION['message']);
  }
  // проверяем длину фамилии: если длина фамилии меньше 2 и больше 30 символов, то выдаём ошибку
  if (!check_length($last_name, 2, 30)) {
    if (empty($_SESSION['update_last_name']['error'])) {
      $_SESSION['update_last_name']['error'] = 'Фамилия должна состоять не менее чем из 2-х символов и не более чем из 30';
    }
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_last_name']['error'])) {
    // обновляем в базе фамилию пользователя
    $result_update_last_name = $this->UserModel->update_last_name($last_name, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_last_name == true) {
      // сообщаем пользователю, что его фамилия изменена и отправляем пользователя назад на его страницу
      $_SESSION['update_last_name']['result'] = 'Ваша фамилия успешно изменена! Ваша новая фамилия: <strong>'.$last_name.'</strong>';
      unset($_SESSION['update_last_name']['error']);
    }
    else { // иначе сообщаем об ошибке
      $_SESSION['update_last_name']['error'] = 'Произошла ошибка! Ваша фамилия не изменена';
    }
  }
}

// ИЗМЕНЕНИЕ ЛОГИНА
// если существует логин
if (isset($_POST['login'])) {
  // получаем логин из массива $_POST
  $login = trim($_POST['login']);
  // если логин пустой, то выводим сообщение об ошибке
  if (empty($login)) {
    $_SESSION['update_login']['error'] = 'Вы не ввели логин! Введите Ваш новый логин';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $login = validate($login, 'login');
  if ((empty($_SESSION['update_login']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_login']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  // проверяем длину логина: если длина логина меньше 3 и больше 15 символов, то выдаём ошибку
  if (!check_length($login, 3, 15)) {
    if (empty($_SESSION['update_login']['error'])) {
      $_SESSION['update_login']['error'] = 'Логин должен состоять не менее чем из 3-х символов и не более чем из 15';
    }
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_login']['error'])) {
    // проверка логина на уникальность (проверка на существование пользователя с таким же логином)
    $unique_login = $this->check_unique_login($login); // проверяем логин на уникальность: true - логин уникальный, false - такой логин уже занят, Empty login - логин пустой
    //debug($unique_login);
    if ($unique_login === false) { // если получаем false - такой логин уже занят, то выдаём ошибку
      $_SESSION['update_login']['error'] = 'Введённый Вами логин уже зарегистрирован. Введите другой логин.';
    }
    else { // если пользователя с таким логином нет (совпадение не найдено), то
      // обновляем в базе логин пользователя
      $result_update_login = $this->UserModel->update_login($login, $old_login);
      // если обновление выполнено верно, то
      if ($result_update_login == true) {
        // обновляем все сообщения, которые отправил пользователь и которые были отправлены ему
        $this->UserModel->update_author_messages($login,$old_login); // пользователь является автором сообщений
        $this->UserModel->update_addressee_messages($login,$old_login); // пользователь является получателем сообщений
        // обновляем все комментарии, которые он отправил
        $this->UserModel->update_author_comments($login,$old_login); // пользователь является автором комментариев
        $this->user['login'] = $login; // переопределяем логин
        $_SESSION['user']['login'] = $login; // обновляем логин в сессии
        if (isset($_COOKIE['login'])) { // обновляем логин в куках, если они есть
          setcookie('login', $login, time()+31536000, '/');
        }
        $cache = core\libs\Cache::instance();
        $cache->delete('users'); // удаление пользователей из кэша
        // сообщаем пользователю, что его логин изменён и отправляем пользователя назад на его страницу
        $_SESSION['update_login']['result'] = 'Ваш логин успешно изменён! Ваш новый логин: <strong>'.$login.'</strong>';
        unset($_SESSION['update_login']['error']);
      }
      else { // иначе сообщаем об ошибке
        $_SESSION['update_login']['error'] = 'Произошла ошибка! Ваш логин не изменён';
      }
    }
  }
}

// ИЗМЕНЕНИЕ ПАРОЛЯ
// если существует пароль
if (isset($_POST['password'])) {
  // получаем пароль из массива $_POST
  $password = trim($_POST['password']);
  // если пароль пустой, то выводим сообщение об ошибке
  if (empty($password)) {
    $_SESSION['update_password']['error'] = 'Вы не ввели пароль! Введите Ваш новый пароль';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $password = validate($password, 'password');
  if ((empty($_SESSION['update_password']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_password']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  // проверяем длину пароля: если длина пароля меньше 3 и больше 15 символов, то выдаём ошибку
  if (!check_length($password, 3, 15)) {
    if (empty($_SESSION['update_password']['error'])) {
      $_SESSION['update_password']['error'] = 'Пароль должен состоять не менее чем из 3-х символов и не более чем из 15';
    }
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_password']['error'])) {
    // шифрование пароля
    // добавляем дополнительные символы вначале и в конце строки, чтобы пароль не могли взломать методом подбора md5
    // шифруем пароль по алогитму md5 и добавляем реверс для надёжности
    $shifr_password = shifr_password($password); // 111 = ca89b6b21f977a18455187a4e229f1fa
    // обновляем в базе пароль пользователя
    $result_update_password = $this->UserModel->update_password($shifr_password, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_password == true) {
      $this->user['password'] = $shifr_password; // переопределяем пароль
      $_SESSION['user']['password'] = $shifr_password; // обновляем пароль в сессии
      if (isset($_COOKIE['password'])) { // обновляем пароль в куках, если они есть
          setcookie('password', $this->encrypt($password), time()+31536000, '/');
      }
      // сообщаем пользователю, что его пароль изменен и отправляем пользователя назад на его страницу
      $_SESSION['update_password']['result'] = 'Ваш пароль успешно изменён! Ваш новый пароль: <strong>'.$password.'</strong>';
      unset($_SESSION['update_password']['error']);
    }
    else { // иначе сообщаем об ошибке
      $_SESSION['update_password']['error'] = 'Произошла ошибка! Ваш пароль не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ АДРЕСА ЭЛЕКТРОННОЙ ПОЧТЫ
// если существует email
if (isset($_POST['email'])) {
  // получаем email из массива $_POST
  $email = trim($_POST['email']);
  // если email пустой, то выводим сообщение об ошибке
  if (empty($email)) {
    $_SESSION['update_email']['error'] = 'Вы не ввели адрес Вашей электронной почты (e-mail)! Введите Ваш новый e-mail';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $email = validate($email, 'email');
  if ((empty($_SESSION['update_email']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_email']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  // проверка еmail на существование и доступность, если email не существует или не доступен, то выдаём ошибку
  $checkmail = new core\libs\CheckMail();
  if ((empty($email)) or (!$checkmail->execute($email))) {
    if (empty($_SESSION['update_email']['error'])) {
      $_SESSION['update_email']['error'] = 'Адрес электронной почты (e-mail) не существует или не доступен';
    }
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_email']['error'])) {
    // обновляем в базе email пользователя
    $result_update_email = $this->UserModel->update_email($email, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_email == true) {
      // сообщаем пользователю, что его email изменён и отправляем пользователя назад на его страницу
      $_SESSION['update_email']['result'] = 'Адрес Вашей электронной почты (e-mail) успешно изменён! Ваш новый e-mail: <strong>'.$email.'</strong>';
      unset($_SESSION['update_email']['error']);
    }
    else {
        $_SESSION['update_email']['error'] = 'Произошла ошибка! Адрес Вашей электронной почты (e-mail) не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ НОМЕРА ТЕЛЕФОНА
// если существует номер телефона
  if (isset($_POST['phone'])) {
    // получаем номер телефона из массива $_POST
    $phone = trim($_POST['phone']);
    // если номер телефона пустой, то выводим сообщение об ошибке
    if (empty($phone)) {
      $_SESSION['update_phone']['error'] = 'Вы не ввели Ваш номер телфона! Введите Ваш новый номер телефона';
    }
    // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
    $phone = validate($phone, 'phone');
    if ((empty($_SESSION['update_phone']['error'])) and (isset($_SESSION['message']))) {
      $_SESSION['update_phone']['error'] = $_SESSION['message']; unset($_SESSION['message']);
    }
    //debug($_SESSION);
    // если ошибок нет
    if (empty($_SESSION['update_phone']['error'])) {
      // обновляем в базе номер телефона пользователя
      $result_update_phone = $this->UserModel->update_phone($phone, $old_login);
      // если обновление выполнено верно, то
      if ($result_update_phone == true) {
        // сообщаем пользователю, что его номер телефона изменён и отправляем пользователя назад на его страницу
        $_SESSION['update_phone']['result'] = 'Ваш номер телефона успешно изменён! Ваш новый номер телефона: <strong>+'.$phone.'</strong>';
        unset($_SESSION['update_phone']['error']);
      }
      else {
        $_SESSION['update_phone']['error'] = 'Произошла ошибка! Ваш номер телефона не изменён';
      }
    }
  }

// ИЗМЕНЕНИЕ САЙТА
// если существует адрес сайта
if (isset($_POST['site'])) {
  // получаем сайт из массива $_POST
  $site = trim($_POST['site']);
  // если сайт пустой, то выводим сообщение об ошибке
  if (empty($site)) {
    $_SESSION['update_site']['error'] = 'Вы не ввели адрес Вашего сайта! Введите Ваш новый адрес Вашего сайта';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $site = validate($site, 'url');
  if ((empty($_SESSION['update_site']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_site']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_site']['error'])) {
    // обновляем в базе сайт пользователя
    $result_update_site = $this->UserModel->update_site($site, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_site == true) {
      // сообщаем пользователю, что его сайт изменён и отправляем пользователя назад на его страницу
      $_SESSION['update_site']['result'] = 'Адрес Вашего сайта успешно изменен! Новый адрес Вашего сайта: <strong>'.$site.'</strong>';
      unset($_SESSION['update_site']['error']);
    }
    else {
      $_SESSION['update_site']['error'] = 'Произошла ошибка! Адрес Вашего сайта не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ АВАТАРЫ
// отправлялась ли переменная (если не отправлялась, то возвращаем пользователю стандартный аватар)
if (isset($_FILES['fupload']['name'])) {
  // если переменная пустая (пользователь не отправил изображение), то присваиваем ему заранее приготовленную картинку с надписью "нет аватара"
  if (empty($_FILES['fupload']['name'])) {
    $avatar = DAVATAR;
  }
  else { // иначе - загружаем изображение пользователя для обновления
    //папка, куда будет загружаться начальная картинка и её сжатая копия
    $path_to_90_directory = 'images/users/avatars/';
    // проверка формата исходного изображения
    if (preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name'])) {
      $filename = $_FILES['fupload']['name'];
      $source = $_FILES['fupload']['tmp_name'];
      $target = $path_to_90_directory.$filename;
      // загрузка оригинала в папку $path_to_90_directory
      move_uploaded_file($source, $target);
      // если оригинал был в формате gif, то создаем изображение в этом же формате. Необходимо для последующего сжатия
      if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
        $im = imagecreatefromgif($path_to_90_directory.$filename);
      }
      // если оригинал был в формате png, то создаем изображение в этом же формате. Необходимо для последующего сжатия
      if(preg_match('/[.](PNG)|(png)$/', $filename)) {
        $im = imagecreatefrompng($path_to_90_directory.$filename);
      }
      // если оригинал был в формате jpg, то создаем изображение в этом же формате. Необходимо для последующего сжатия
      if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
        $im = imagecreatefromjpeg($path_to_90_directory.$filename);
      }
      // СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ ВЗЯТО С САЙТА www.codenet.ru
      // Создание квадрата 64x64
      // dest - результирующее изображение
      // w - ширина изображения
      // ratio - коэффициент пропорциональности
      $w = 64; // квадратная 64x64. Можно поставить и другой размер
      // создаём исходное изображение на основе исходного файла и определяем его размеры
      $w_src = imagesx($im); // вычисляем ширину
      $h_src = imagesy($im); // вычисляем высоту изображения
      // создаём пустую квадратную картинку важно именно truecolor, иначе будем иметь 8-битный результат
      $dest = imagecreatetruecolor($w,$w);
      // вырезаем квадратную серединку по x, если фото горизонтальное
      if ($w_src > $h_src) {
        imagecopyresampled($dest, $im, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
      }
      // вырезаем квадратную верхушку по y, если фото вертикальное (хотя можно тоже серединку)
      if ($w_src<$h_src) {
        imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
      }
      // квадратная картинка масштабируется без вырезок
      if ($w_src == $h_src) {
        imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
      }
      // вычисляем время в настоящий момент
      $date = time();
      // сохраняем изображение формата jpg в нужную папку, именем будет текущее время, чтобы у аватаров не было одинаковых имен
      imagejpeg($dest, $path_to_90_directory.$date.'.jpg');
      // почему именно jpg? Он занимает очень мало места + уничтожается анимирование gif изображения, которое отвлекает пользователя. Не очень приятно читать его комментарий, когда краем глаза замечаешь какое-то движение
      // заносим в переменную путь до аватара
      $avatar = $path_to_90_directory.$date.'.jpg';
      // удаляем оригинал загруженного изображения, он нам больше не нужен. Задачей было - получить миниатюру
      $delfull = $path_to_90_directory.$filename;
      if (file_exists($delfull)) { // если файл существует то удаляем его
        unlink($delfull);
      }
    }
    else { // в случае несоответствия формата, выдаём соответствующее сообщение
      $_SESSION['update_avatar']['error'] = 'Изображение для аватара должно быть в формате <strong>JPG</strong>, <strong>GIF</strong> или <strong>PNG</strong> и размером не более 2 Мб. Выберите изображение подходящего формата и размера';
      //$avatar = DAVATAR;
    }
  }
  // если ошибок нет
  if (empty($_SESSION['update_avatar']['error'])) {
    // обновляем аватар в базе
    $result_update_avatar = $this->UserModel->update_avatar($avatar,$old_login);
    // если обновление выполнено верно, то
    if ($result_update_avatar == 'true') {
      // если текущий аватар был не стандартный по умолчанию, то удаляем его
      if ($this->user['avatar'] != DAVATAR) {
        if (file_exists($this->user['avatar'])) { // если файл существует то удаляем его
          unlink($this->user['avatar']);
        }
      }
      $this->user['avatar'] = $avatar; // переопределяем аватар
      $_SESSION['user']['avatar'] = $avatar; // обновляем аватар в сессии
      // сообщаем пользователю, что его аватар изменён и отправляем пользователя назад на его страницу
      $_SESSION['update_avatar']['result'] = 'Ваш аватар успешно изменён! Ваш новый аватар:<br><div class="center avatarblockimage"><img alt="'.$old_login.'" class="avatarimage" src="'.D.S.$avatar.'" title="'.$old_login.'"></div><div class="clear"></div>';
      unset($_SESSION['update_avatar']['error']);
    }
    else {
      $_SESSION['update_avatar']['error'] = 'Произошла ошибка! Ваш аватар не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ ДАТЫ РОЖДЕНИЯ
// если существует дата рождения
if (isset($_POST['birthday'])) {
  // получаем дату рождения из массива $_POST
  $birthday = trim($_POST['birthday']);
  // если дата рождения пустая, то присваиваем значение по умолчанию
  if (empty($birthday)) {
    $birthday = '1970-01-01'; // $_SESSION['update_birthday']['error'] = 'Вы не ввели дату Вашего Рождения! Введите Вашу новую дату Вашего Рождения';
  }
  // удаляем всё лишнее, проверяем введённые данные и чистим от ссылок
  $birthday = validate($birthday, 'date');
  if ((empty($_SESSION['update_birthday']['error'])) and (isset($_SESSION['message']))) {
    $_SESSION['update_birthday']['error'] = $_SESSION['message']; unset($_SESSION['message']);
  }
  //debug($_SESSION);
  // если ошибок нет
  if (empty($_SESSION['update_birthday']['error'])) {
    // обновляем в базе дату рождения пользователя
    $result_update_birthday = $this->UserModel->update_birthday($birthday, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_birthday == true) {
      // сообщаем пользователю, что его дата рождения изменена и отправляем пользователя назад на его страницу
      if ($birthday == '1970-01-01') {
        $birthday_for_view = 'не указана';
      }
      else {
        $birthday_for_view = rusdate("j %MONTH% Y",strdatetosec($birthday.' 00:00:00'),1);
      }
      $_SESSION['update_birthday']['result'] = 'Ваша дата Рождения успешно изменена! Ваша новая дата Рождения: <strong>'.$birthday_for_view.'</strong>';
      unset($_SESSION['update_birthday']['error']);
    }
    else {
      $_SESSION['update_birthday']['error'] = 'Произошла ошибка! Ваша дата рождения не изменена';
    }
  }
}

// ИЗМЕНЕНИЕ ПОЛА
// если существует пол
if (isset($_POST['gender'])) {
  // получаем пол из массива $_POST
  $gender = clear_int($_POST['gender']);
  // если пол пустой, то выводим присваиваем значение по умолчанию
  if (empty($gender)) {
    $gender = 0;
    //$_SESSION['update_gender']['error'] = 'Ваш пол не указан';
  }
  // если ошибок нет
  if (empty($_SESSION['update_gender']['error'])) {
    // обновляем в базе пол пользователя
    $result_update_gender = $this->UserModel->update_gender($gender, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_gender == true) {
      // сообщаем пользователю, что его пол изменён и отправляем пользователя назад на его страницу
      if ($gender == 1) {
        $gender_for_view = 'женский';
      }
      elseif ($gender == 2) {
        $gender_for_view = 'мужской';
      }
      else {
        $gender_for_view = 'не указан';
      }
      // сообщаем пользователю, что его пол изменён и отправляем пользователя назад на его страницу
      $_SESSION['update_gender']['result'] = 'Ваш пол успешно изменён! Ваш новый пол: <strong>'.$gender_for_view.'</strong>';
      unset($_SESSION['update_gender']['error']);
    }
    else {
      $_SESSION['update_gender']['error'] = 'Произошла ошибка! Ваш пол не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ ТИПА ПИСЬМА
// если существует тип письма
if (isset($_POST['letter_type'])) {
  // получаем тип письма из массива $_POST
  $letter_type = clear_int($_POST['letter_type']);
  // если тип письма пустой, то выводим присваиваем значение по умолчанию
  if (empty($letter_type)) {
    $letter_type = 0;
    //$_SESSION['update_letter_type']['error'] = 'Тип письма не указан!';
  }
  // если ошибок нет
  if (empty($_SESSION['update_letter_type']['error'])) {
    // обновляем в базе тип письма пользователя
    $result_update_letter_type = $this->UserModel->update_letter_type($letter_type, $old_login);
    // если обновление выполнено верно, то
    if ($result_update_letter_type == true) {
      if ($letter_type == 1) {
        $letter_type_for_view = 'HTML';
      }
      else {
        $letter_type_for_view = 'текст';
      }
      // сообщаем пользователю, что тип письма изменён и отправляем пользователя назад на его страницу
      $_SESSION['update_letter_type']['result'] = 'Тип письма успешно изменён! Ваш новый тип письма: <strong>'.$letter_type_for_view.'</strong>';
      unset($_SESSION['update_letter_type']['error']);
    }
    else {
      $_SESSION['update_letter_type']['error'] = 'Произошла ошибка! Тип письма не изменён';
    }
  }
}

// ИЗМЕНЕНИЕ ПОДПИСКИ НА НОВОСТИ
// если существует подписка на новости
  if ($_POST['update_submit'] == 'Отменить подписку') {
  //debug($_POST);
    // получаем подписку на новости из массива $_POST
    if (isset($_POST['subscribe'])) {
      $status = 3;
      $subscribe_for_view = '';
    }
    else {
      $status = 3;
      $subscribe_for_view = 'не ';
    }
    // если ошибок нет
    if (empty($_SESSION['update_subscribe']['error'])) {
      // обновляем в базе статус пользователя
      $result_update_subscribe = $this->UserModel->update_subscribe($status, $old_login);
      // если обновление выполнено верно, то
      if ($result_update_subscribe == true) {
        // сообщаем пользователю, что тип письма изменён и отправляем пользователя назад на его страницу
        $_SESSION['update_subscribe']['result'] = 'Подписка на новости успешно изменена! Вы '.$subscribe_for_view.'подписаны на новости сайта '.DOMEN;
        unset($_SESSION['update_subscribe']['error']);
      }
      else {
        $_SESSION['update_subscribe']['error'] = 'Произошла ошибка! Подписка на новости не изменена';
      }
    }
  }

// УДАЛЕНИЕ АККАУНТА ПОЛЬЗОВАТЕЛЯ
// если существует удаление пользователя
if (isset($_POST['delete_user'])) {
  // получаем метку об удалении из массива $_POST
  $delete_user = clear_int($_POST['delete_user']);
  // если метка об удалении пользователя пустая, то выводим сообщение об ошибке
  if (empty($delete_user)) {
      $delete_user = 1;
  }
  // если ошибок нет
  if (empty($_SESSION['update_delete_user']['error'])) {
    // обновляем в базе статус пользователя
    $result_update_status_user = $this->UserModel->update_status_user($old_login);
    // если обновление выполнено верно, то
    if ($result_update_status_user == true) {
      // чистим куки id, логина и пароля и метки Запомнить меня
      setcookie('id', '', time() - 1, '/');
      setcookie('login', '', time() - 1, '/');
      setcookie('password', '', time() - 1, '/');
      setcookie('remember', '', time() - 1, '/');
      unset($_SESSION['authorization_data']);
      // уничтожаем переменные в сессиях, если они есть
      //unset($_SESSION['user'],$this->user);

      // сообщаем пользователю, что его аккаунт удалён и отправляем пользователя страницу выхода
      $_SESSION['update_delete_user']['result'] = 'Пользователь <strong>'.$old_login.'</strong> успешно удалён<br>
<div class="blocktext"><a href="'.D.S.'exit" target="_top">Выход</a>.</div>
<script language="javascript" type="text/javascript">setTimeout("document.location.href='.D.'exit", 60000);</script>';
      unset($_SESSION['update_user']['error']);
    }
    else {
      $_SESSION['update_user']['error'] = 'Произошла ошибка! Пользователь не удалён!';
    }
  }
}

redirect();
}
?>