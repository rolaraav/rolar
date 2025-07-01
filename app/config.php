<?php
defined('A') or die('Access denied');
//echo 'Конфиг сайта!<br>';
// Файл конфигурации приложения
// components - компоненты/классы, загружаемые при старте приложения
// settings - базовые настройки приложения
return [
  'components' => [
    'Album' => 'core\libs\Album',
    'Cache' => 'core\libs\Cache',
    'CheckMail' => 'core\libs\CheckMail',
    'FileUpload' => 'core\libs\FileUpload',
    'Gallery' => 'core\libs\Gallery',
    'ImageResize' => 'core\libs\ImageResize',
    'Mail' => 'core\libs\Mail',
    'Menu' => 'core\libs\Menu',
    'Search' => 'core\libs\Search',
    'Validator' => 'core\libs\Validator',
    'Breadcrumbs' => 'core\libs\Breadcrumbs',
    'Pagination' => 'core\libs\Pagination',
  ],
  'settings' => [
    'admin_email' => 'admin@email.com',
    'site_name' => 'Персональный сайт Артура Абзалова',
    'quantity_posts' => 7, // количество постов (записей), выводимых на одной странице для постраничной навигации
    'smtp_login' => '',
    'smtp_password' => '',
    'route_prefixes' => array('','admin','aav','cisco'), // допустимые префиксы
    'route_postfixes' => array('Controller','Action'), // допустимые постфиксы
    'views' => array( // допустимые алиасы, у которых есть свой собственный контроллер
      //'base', BaseController
      'post',
      //'cat',
      'category',
      'about',
      //'courses','partner_products','downloads',
      //'goods',
      //'galleries','audio','video',
      'bill',
      'oferta',
      'secret',
      'posts',
      'courses',
      'date',
      'search',
      'user',
      'link',
      //'links', // LinkController
      'sitemap',
      'script',
      'test',
    ),
    'inadmissible_aliases' => array( // недопустимые алиасы
      'index','about',
      'cat','post','posts',
      //'courses',
      //'partner_products',
      //'downloads',
      'secret','bill','oferta',
      //'goods'
      'cisco','admin','aav','login','logout','signup','test','default','error',
      'date','search',
      //'music','films','galleries',
      'registration','authorization','subscription','activation','deactivation',
      'vkauth','fbauth','twauth','okauth','mrauth','goauth','yaauth',
      'user',
      'user_page','all_users','all_links','links',
      'sitemap','exit',
      'delete_message','send_password','send_login',
      'link','short_link','partner_link','download_link','internet_link',
      'buy_link','banner_link','download_file',
      'page','view','category','courses',
      'download','yadisk','fail','getfile' // для курса по cisco
    ),
    'ddns_domains' => array( // внешние динамические домены для скачивания файлов
      'rolar.ddns.net',
      'rolar.myftp.org',
      'rolar.myftp.biz',
      '94.41.86.18.dynamic.ufanet.ru',
      //'rolar.mykeenetic.ru',
      //'rolaraav.no-ip.org',
      //'rolaraav.noip.me',
      //'349941.dyn.ufanet.ru',
    ),
    'ftp_logins' => array( // ftp-логины
      'anonymous' => '', // 'anonymous:',
      'rolar' => 'rolar.ru:Kr6vX3yu',
      'cisco' => 'cisco:3dPc6F5m', // путь к секретному файлу
      'ciscofree' => 'ciscofree:Ak6vx9Ic',
      'courses' => 'courses:nTf4k9p5'
    )
  ]
];