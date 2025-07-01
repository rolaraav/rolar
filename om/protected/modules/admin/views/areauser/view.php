<?php $this->pageTitle='Просмотр участника Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Список участников', 'url'=>array('index','a'=>$model->area_id), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Изменить участника', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить участника', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Участники Закрытой Зоны</h3>

<h1>Просмотр участника Закрытой Зоны - <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
		'username',
		'password',
		'lastLogin' => array (
                    'label' => 'Последний вход',
                    'value' => date ('j.m.Y H:i:s',$model->lastLogin),
                ),
		'createDate' => array (
                    'label' => 'Дата создания',
                    'value' => date ('j.m.Y H:i:s',$model->createDate),
                ),
		'order_id',
		'payTill' => array (
                    'label' => 'Оплачено до',
                    'value' => date ('j.m.Y H:i:s',$model->payTill),
                ),
		'totalDays',
		'email',
            
                'enter' => array ('label'=>' ','type' => 'raw', 
                    'value'
                        => '<form action="'.Y::bu().'area/default/login" target=_blank method="post">
<input type="hidden" name="LoginForm[username]" value="'.$model->username.'" />
<input type="hidden" name="LoginForm[password]" value="'.$model->password.'" />
<input type="submit" value="Войти в аккаунт пользователя Закрытой Зоны" /><br>
 <span style="font-size:8px">(нажатие кнопки "Выход" в аккаунте пользователя - приведёт и к выходу из админ-панели)</span>

</form>'),
                    
	),
)); ?>

<br>&nbsp;<br>
<form method="POST">
            <input type="text" class="numeric" name="days" value="30">
            <input type="submit" value="Продлить на указанное число дней" class="submit"><br>&nbsp;
            </form>

</div>
