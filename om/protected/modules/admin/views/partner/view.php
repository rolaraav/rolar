<?php $this->pageTitle='Просмотр партнёра' ?><?

$this->menu=array(
	array('label'=>'Список партнёров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
  array('label'=>'Добавить партнёра', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить партнёра', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить партнёра', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Партнёры</h3>

<h1>Просмотр партнёра #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'id',
        'password' => array ('label' => 'Пароль','value' => $model->password),
        'firstName' => array ('label' => 'Имя','value' => $model->firstName),
        'email' => array ('label' => 'E-mail','value' => $model->email),
                'enter' => array ('label'=>' ','type' => 'raw', 
                    'value'
                        => '<form action="'.Y::bu().'aff/login" target=_blank method="post">
<input type="hidden" name="LoginForm[username]" value="'.$model->id.'" />
<input type="hidden" name="LoginForm[password]" value="'.$model->password.'" />
<input type="submit" value="Войти в аккаунт партнёра" /><br>
 <span style="font-size:8px">(нажатие кнопки "Выход" в аккаунте партнёра - приведёт и к выходу из админ-панели)</span>

</form>'
                    ),
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
                'parent_id' => array (
                    'label' => 'Родительский RefID',
                    'type' => 'raw',
                    'value' => CHtml::link ($model->parent_id,array("partner/view","id" => $model->parent_id),array ("target" => "_blank")),
                ),
		'trusted' => array ('label' => 'Доверенный', 'value' => Lookup::item ('Visible',$model->trusted)),
                array ('label' => 'Кликов всего', 'value' => $model->clickCount),
		'total' => array ('label' => 'Заработано всего', 'value' => H::mysum($model->total).' р.'),
		'paid' => array ('label' => 'Выплачено всего', 'value' => H::mysum($model->paid).' р.'),
		
		'space4' => array ('label' => '&nbsp;', 'value' => ' '),
                
            'ip' =>  array(
                
                    'label' =>'IP', 
                    'type'  => 'raw',
                    'value' => (empty($model->ip))?"":"<a target='_blank' href='http://www.geoiptool.com/en/?IP=".$model->ip."'>".$model->ip."</a>"
        ), 

         array(
            'label'=>'Дата регистрации',
            'value'=>date ('j.m.Y H:i',$model->createTime),
        ),
         array(
            'label'=>'Дата изменения',
            'value'=>date ('j.m.Y H:i',$model->updateTime),
        ),		

	),
)); ?>

</div>
