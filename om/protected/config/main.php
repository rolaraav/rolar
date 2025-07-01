<?php
// Файл настроек Ордер Master 2
return array(

  //Секретный ключ содержится здесь
  //Нужно придумать любой секретный ключ
  'params' => array(
    'secretKey' => md5('Dre72KvQ'),
  ),

  // application components
  'components' => array(

    //Данные для доступа к базе данных
    //Если у Вас другой хост - запишите вместо localhost
    'db' => array(
      'connectionString' => 'mysql:host=localhost;dbname=om',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      'tablePrefix' => 'om_',
    ),

    //Всё что ниже - менять нет необходимости
    'user' => array(
      // enable cookie-based authentication
      'allowAutoLogin' => true,
    ),

    // uncomment the following to enable URLs in path-format
    'urlManager' => array(
      'urlFormat' => 'path',
      'rules' => array(
        '<shorten:\d+>' => '/click/shorten/id/<shorten>',
        'ord/<good:\w+>' => '/order/index/id/<good>',
        'page/<page:\w+>' => '/mypage/index/id/<page>',
        'i/<page:\w+>' => '/info/good/id/<page>',
        'go/<refid:\w+>/a' => '/click/go/good_id/no/refid/<refid>',
        'go/<refid:\w+>/<page:\w+>/<goodid:\w+>' => '/click/go/refid/<refid>/good_id/<goodid>/page/<page>',
        'go/<refid:\w+>/<page:\w+>/<goodid:\w+>/<channel:\w+>' => '/click/go/refid/<refid>/good_id/<goodid>/page/<page>/channel/<channel>',
        'admin/login' => '/admin/default/login',
        'aff/login' => '/aff/default/login',
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '' => 'catalog/index',
      ),
      'showScriptName' => false,
    ),

    // uncomment the following to use a MySQL database
    'errorHandler' => array(
      // use 'site/error' action to display errors
      'errorAction' => 'main/error',
    ),

    'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
        array(
          'class' => 'CFileLogRoute',
          'levels' => 'error, warning',
        ),
        // uncomment the following to show log messages on web pages
        //array(
        //  'class'=>'CWebLogRoute',
        //),
      ),
    ),

    'request' => array(
      //'enableCsrfValidation'=>true,
      'enableCookieValidation' => true,
    ),

    'swiftMailer' => array(
      'class' => 'ext.swiftMailer.SwiftMailer',
    ),

    'session' => array(
      'class' => 'system.web.CDbHttpSession',
      'connectionID' => 'db',
      'sessionTableName' => 'om_session',
      'timeout' => 3600,
    ),
    'viewRenderer' => array(
      'class' => 'CPradoViewRenderer',
    ),

  ),

  'import' => array(
    'application.models.*',
    'application.components.*',
  ),

  'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name' => 'Order Master 2',
  'language' => 'ru',

  // preloading 'log' component
  'preload' => array('log'),

  // autoloading model and component classes
  'import' => array(
    'application.models.*',
    'application.components.*',
  ),

  'modules' => array(
    'admin',
    'aff',
    'author',
    'area',
  ),

);