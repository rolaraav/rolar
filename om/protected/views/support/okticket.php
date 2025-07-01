<?php $this->pageTitle='Запрос отправлен' ?>

<div class="wrap">

<h3>Служба поддержки</h3>

<h1>Ваш запрос отправлен</h1>

<p align="center"><img style="margin:25px;" src="<?= Y::bu() ?>images/front/support/logo.jpg" /></p>

<p align="center"><b>Спасибо, Ваш запрос отправлен.</b><br /><br />

Вы получите уведомление на e-mail после того,<br /> как Ваш запрос будет рассмотрен.</p>

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

<p align="center"><span style="font-size:18px"><b>ID Вашего тикета:</b></span></p><br />

<p align="center"><span style="font-size:14px; color:#AA0000;"><b><?= $ticketId ?></b></span></p>

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

<p align="center"><a href="<?= Y::bu() ?>support/viewticket?ticket_id=<?= $ticketId ?>&hash=<?= $ticketHash ?>" style="font-size:14px">Просмотреть тикет</span></a></p>

<p align="center">&nbsp;</p>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>