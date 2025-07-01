<?php $this->pageTitle='Профиль - Панель партнёра' ?>

<div class="wrap">

<h3>Аккаунт партнёра <?= $model->id ?></h3>

<h1>Профиль партнёра &quot;<?= $model->id ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'firstName' => array ('label' => 'Имя','value' => $model->firstName),
        'email' => array ('label' => 'E-mail','value' => $model->email),
		'space' => array ('label' => '&nbsp;', 'value' => ' '),
        'wmz' => array ('label' => 'WMZ', 'value' => $model->wmz, 'visible' => Settings::item('affWmz')),
        'wmr' => array ('label' => 'WMR', 'value' => $model->wmr, 'visible' => Settings::item('affWmr')),
        'rbkmoney' => array ('label' => 'Счёт RBK Money', 'value' => $model->rbkmoney, 'visible' => Settings::item('affRbk')),
        'yandex' => array ('label' => 'ЮMoney','value' => $model->yandex, 'visible' => Settings::item('affYandex')),
        'zpayment' => array ('label' => 'Z-payment','value' => $model->zpayment, 'visible' => Settings::item('affZpayment')),
		'space2' => array ('label' => '&nbsp;', 'value' => ' ', 'visible' => Settings::item('affCountry')),		
        'country' => array ('label' => 'Страна', 'value' => $model->country, 'visible' => Settings::item('affCountry')),
        'maillist' => array ('label' => 'Рассылка','value' => $model->maillist, 'visible' => Settings::item('affMaillist')),
        'city' => array ('label' => 'Город', 'value' => $model->city, 'visible' => Settings::item('affCity')),
        'url' => array ('label' => 'URL сайта','value' => $model->url, 'visible' => Settings::item('affUrl')),
        'aboutProject' => array ('label' => 'Направление сайта','value' => $model->aboutProject, 'visible' => Settings::item('affAbout')), 		
		'space3' => array ('label' => '&nbsp;', 'value' => ' '),		
         array(
            'label'=>'Дата регистрации',
            'value'=>date ('j.m.Y H:i',$model->createTime),
        ),
         array(
            'label'=>'Дата изменения',
            'value'=>$model->updateTime>0?date ('j.m.Y H:i',$model->updateTime):"не было изменений",
        ),		
    ),
)); ?>

<fieldset class="submit">
	<a href="<?= Y::bu() ?>aff/profile/edit"><input type="button" value="Редактировать профиль"></a>
</fieldset>


</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>aff/">На главную</a></p>
</div>