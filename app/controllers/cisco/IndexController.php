<?php

namespace app\controllers\cisco;

class IndexController extends CiscoController {

  public function indexAction() {
    //echo 'IndexController (CISCO) - метод indexAction()<br>';
    //echo 'Курс по Cisco';

    //if (isset($_POST['order'])) {
    //setcookie('download_access', true, time()+31536000); // установка и проверка куков для скачивания
    //}

    $this->description = 'Обучающий курс Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке, а также дополнительные бонусы - полный перевод курса CCNA Exploration v4.0 на русском языке, CCNA Discovery v4.0, перевод заданий лабораторных работ и их реализация на Packet Tracer, верные ответы на экзаменационные вопросы, презентации для инструкторов, дополнительные приложения по работе в локальной сети и витруальные эмуляторы оборудования Cisco (Packet Tracer, GNS3, Dynamips, Ethereal, Hyper Terminal, Net View, Real VNC), прошивки маршрутизаторов Cisco IOS и пр.';

    $this->keywords = 'Cisco, CCNA, Exploration, v4.0, на русском, Network Academy, Final Exam, answers, questions, ответы, вопросы, сетевая академия, обучающий курс, связь, телекоммуникации, передача информации, перевод, русский язык, по-русски, сиськи, дполнительные материалы, бонусы, книги, презентации, лабораторные работы, ответы, правильные, экзамен, финальный, главы, модель OSI, маршрутизация, коммутация, сетевые технологии, Ethernet, switching, routing, Packet Tracer, GNS3, Dynamips, Ethereal, Hyper Terminal, Cisco IOS, прошивки, операционная система, локальные сети, TCP/IP, сетевые протоколы, LAN, WAN, MAN, OSPF, RIP, EIGRP, BGP, PPP, IPv6, IPv4, TCP, UDP, DHCP, DynDNS, DNS, Telnet, ping, SMTP, FTP, SNTP, TFTP, STP, tracert, SSH, HTTP, NTP';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      //'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'zakaz' => $this->zakaz,
      'webmoney' => $this->webmoney,
      //'yandex' => $this->yandex,
      'subscription' => $this->subscription,
      //'user' => $this->user,
    ]);

  }

  // метод для получения HTML-кода и вывода страницы на экран
  public function output() {
    // echo 'IndexController - метод output()<br>';

    parent::output();
  }

  public function downloadAction() {
    //echo 'IndexController (CISCO) - метод downloadAction()<br>';
    $secret_link = '';
    $download_access = false;

    if ((isset($_COOKIE['download_access'])) and ($_COOKIE['download_access'] == true)) { // проверка куков для скачивания
      $secret_link = get_secret_link(1);
      //debug($secret_link);
      $download_access = true;
    }

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      //'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      //'zakaz' => $this->zakaz,
      //'webmoney' => $this->webmoney,
      //'yandex' => $this->yandex,
      //'subscription' => $this->subscription,
      'download_access' => $download_access,
      'secret_link' => $secret_link,
    ]);

  }

  public function failAction() {
    //echo 'IndexController (CISCO) - метод failAction()<br>';


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      //'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      //'zakaz' => $this->zakaz,
      'webmoney' => $this->webmoney,
      'yandex' => $this->yandex,
      //'subscription' => $this->subscription,
      //'user' => $this->user,
    ]);

  }

  // получение файла для скачивания
  public function getfileAction() {
    //echo 'IndexController (CISCO) - метод getfileAction()<br>';

    //debug($_GET['hash']);

    if (empty($_GET['hash'])) {
      echo 'Не передан хеш';
      exit();
    }

    if ((isset($_COOKIE['download_access'])) and ($_COOKIE['download_access'] == true)) { // проверка куков для скачивания
      // $download_access = true;
      setcookie('download_access', '', time() + 31536000, '/cisco/'); // удаление куков при успешной закачке
      check_download_file($_GET['hash']); // $_GET['id'] - передавать не обязательно
      echo '<html><head><script type="text/javascript">window.close();</script></head></html>';
      //redirect('http://'.$_SERVER['HTTP_HOST'].'/cisco/index.php');
    }
    else {
      if (DEBUG) {
        echo 'Кука download_access не найдена';
      }
    }
    exit();
  }

  // получение файла для скачивания из Яндекс Диска
  public function yadiskAction() {
    $yadisk_link = 'https://yadi.sk/d/4DomHHrksbxjf';
    redirect($yadisk_link);
    exit();
  }

}