<?php $this->pageTitle='Настройка прав доступа' ?><?php

$this->menu=array(
	array('label'=>'Список операторов', 'url'=>array('staff/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Просмотр оператора', 'url'=>array('staff/view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Операторы</h3>

<h1>Настройка прав доступа оператора &quot;<?php echo $model->staff->username; ?>&quot;</h1>




<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'staff-access-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Для разделов "Счета" и "Заказы"</legend>

<ol>    
   	<li>
    <br />
		<?= $form->labelEx($model,'country'); ?>
		<?= $form->textField($model,'country',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
		<?= $form->error($model,'country'); ?>
	</li>
</ol>

</fieldset>

<fieldset>

<legend>Страничка "Главная"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'main',
        	array(
            	'index' => 'Разрешить видеть статистику на главной',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>

<legend>Раздел "Счета"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'bill',
        	array(
            	'index' => 'Список счетов',
                'view'	=> 'Просмотр счёта',
                'rpo'   => 'Ввод номера посылки',
            	'delete' => 'Удаление счёта'
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Заказы"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'order',
        	array(
            	'index' => 'Список заказов',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Чёрный список"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'black',
        	array(
            	'index' => 'Список записей',
                'view'	=> 'Просмотр записи',            	
                'create'	=> 'Добавление записи',
            	'delete' 	=> 'Удаление записи',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Партнёры"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'partner',
        	array(
            	'index'         => 'Список партнёров',
                'view'          => 'Просмотр партнёра',            	
                'update'	=> 'Редактирование партнёра',
            	'delete' 	=> 'Удаление партнёра',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Клиенты"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'client',
        	array(
            	'index'         => 'Список клиентов',
                'view'          => 'Просмотр клиента',            	                
            	'delete' 	=> 'Удаление клиента',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Категории товаров"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'category',
        	array(
            	'index' 	=> 'Список категорий',
                'view'		=> 'Просмотр категории',
                'create'	=> 'Создание категории',
                'update'	=> 'Изменение категории',
            	'delete' 	=> 'Удаление категории',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Товары"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'good',
        	array(
            	'index' 	=> 'Список товаров',
                'view'		=> 'Просмотр товара',
                'create'	=> 'Создание товара',
                'update'	=> 'Изменение товара',
            	'delete' 	=> 'Удаление товара',
                'send'          => 'Выслать товар',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Статистика"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'stat',
        	array(
            	'index'         => 'Просмотр статистики',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Скидки"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'cupon',
        	array(
            	'index'         => 'Список скидок',
                'view'          => 'Просмотр скидки',            	
                'create'	=> 'Добавление скидки',
                'update'	=> 'Изменение скидки',
            	'delete' 	=> 'Удаление скидки',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Новости"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'affnew',
        	array(
            	'index'         => 'Список новостей',
                'view'          => 'Просмотр новости',            	
                'create'	=> 'Добавление новости',
                'update'	=> 'Изменение новости',
            	'delete' 	=> 'Удаление новости',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Рассылка"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'rass',
        	array(
            	'index'         => 'Страница выбора категории получателей',
                'msg'           => 'Страница списка подписчиков и ввода сообщения',
                'send'          => 'Разрешить отправление рассылки',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Выплаты"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'payout',
        	array(
            	'index'         => 'Список выплат',
                'view'          => 'Просмотр выплаты для партнёра',            	                
                'pok'           => 'Подтверждение выплаты для партнёра',
                'aview'         => 'Просмотр выплаты для автора',
            	'aok'           => 'Подтверждение выплаты для автора',
                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Промо-материалы"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'ad',
        	array(
            	'index'         => 'Список промо-материалов',
                'view'          => 'Просмотр промо-материала',            	
                'create'	=> 'Добавление промо-материала',
                'update'	=> 'Изменение промо-материала',
            	'delete' 	=> 'Удаление промо-материала',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Закрытые зоны"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'area',
        	array(
            	'index'         => 'Список закрытых зон',
                'view'          => 'Просмотр закрытой зоны',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Файлы закрытой зоны" (разрешите список и просмотр закрытых зон для этого)</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'area_files',
        	array(
            	'index'         => 'Список файлов',
                'view'          => 'Просмотр файла',            	
                'create'	=> 'Добавление файла',
                'update'	=> 'Изменение файла',
            	'delete' 	=> 'Удаление файла',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>




<?php if (Settings::item('staffOn')): ?>

<fieldset>
<legend>Раздел "База знаний"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'knowbase',
        	array(
            	'index'         => 'Список статей/категорий',
                'view'          => 'Просмотр статей/категорий',            	
                'create'	=> 'Добавление статей/категорий',
                'update'	=> 'Изменение статей/категорий',
            	'delete' 	=> 'Удаление статей/категорий',                
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Поддержка"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'support',
        	array(
            	'index' 	=> 'Список отделов поддержки',
                'tickets' 	=> 'Список тикетов',
                'view'		=> 'Просмотр тикета',
                'answer'	=> 'Выполнение ответа на тикет',
                'update'	=> 'Изменение статуса и владельца тикета',                
            	'delete' 	=> 'Удаление тикета',
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Конструктор форм"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'form',
        	array(
            	'index'         => 'Вызов формы',
                'generate'          => 'Генерирование формы',            	
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Журнал доступа"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'log',
        	array(
            	'index'         => 'Просмотр лога',
                'delete'          => 'Удаление записи',            	
                'clear'          => 'Очистка лога',            	
            ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Одностраничники"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'odno',
        	array(
                    'index'         => 'Просмотр списка',                
                    'create'          => 'Создание',            	
                    'update'          => 'Изменение',            	
                    'delete'          => 'Удаление',            	
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "Странички"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'pages',
        	array(
                    'index'         => 'Просмотр списка',                
                    'create'          => 'Создание',            	
                    'update'          => 'Изменение',            	
                    'view'          => 'Просмотр страницы',
                    'delete'          => 'Удаление',            	
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "История выплат"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'payhistory',
        	array(
                    'index'         => 'Просмотр списка',                
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "PIN-категории"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'pincat',
        	array(
                    'index'         => 'Просмотр списка',                
                    'create'          => 'Создание',            	
                    'update'          => 'Изменение',            	
                    'delete'          => 'Удаление',            	
                    'view'          => 'Просмотр',
                    'addcodes'          => 'Добавление кодов',
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>

<fieldset>
<legend>Раздел "PIN-коды"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'pin',
        	array(
                    'index'         => 'Просмотр списка',                
                    'delete'          => 'Удаление',            	
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Раздел "Скидки апселла"</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'special',
        	array(
                    'index'         => 'Просмотр списка',                
                    'create'          => 'Создание',            	
                    'update'          => 'Изменение',            	
                    'delete'          => 'Удаление',            	
                    'view'          => 'Просмотр',            
                ),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>


<fieldset>
<legend>Отделы поддержки</legend>

	<div class="checklist">
    	<p>
		<?= $form->checkBoxList($model,'departaments',TicketSection::items(),
            array('class' => 'checkbox','separator' => '</p><p>')); ?>
        </p>
	</div>      

</fieldset>
<?php endif; ?>

<fieldset class="submit">
		<?= CHtml::submitButton('Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->





</div>