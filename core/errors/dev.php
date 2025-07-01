<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Произошла ошибка <?=$errno; ?></title>
</head>
<body>
<h1>Обработчик ошибок: произошла ошибка</h1>
<p><b>Код ошибки:</b> <?=$errno; ?></p>
<p><b>Текст ошибки:</b> <?=$errstr; ?></p>
<p>Файл, в котором произошла ошибка: <b><?=$errfile; ?></b></p>
<p>Строка, в которой произошла ошибка: <b><?=$errline; ?></b></p>
</body>
</html>