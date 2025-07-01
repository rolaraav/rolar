<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views/layouts/main.php */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<title><?= CHtml::encode($this->pageTitle); ?> - Панель Администратора - Order Master 2</title>
<link href="<?= Y::baseUrl() ?>css/cpstyles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?= Y::baseUrl() ?>favicon.ico">
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="<?= Y::baseUrl() ?>css/ie.css">
<![endif]-->

</head>

<body>

<a name="show"></a>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript" language="javascript" src="<?= Y::baseUrl() ?>js/jquery.dropdownPlain.js"></script>

<div align="center" style="padding-top:15px;">

<table id="mainOblast" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2"><div id="mainMenu">
        
<ul id="navlist" class="dropdown">
    <li><a href="<?=Y::bua()?>"><?=H::menuimg('home')?>Главная</a></li>  
    
    <li><a href="<?=Y::bua()?>bill"><?=H::menuimg('bills')?>Заказы</a></li>
    
    <li><a href="<?=Y::bua()?>stat"><?=H::menuimg('stat')?>Отчёт</a></li>    

    <li><a onClick="return false;" href="#"><?=H::menuimg('allusers')?>Пользователи</a>
    
   		<ul class="sub_menu">
                    <li><a href="<?=Y::bua()?>client"><?=H::menuimg('clients')?>Клиенты</a></li>                    
		    <li><a href="<?=Y::bua()?>partner"><?=H::menuimg('partners')?>Партнёры</a></li>
            <li><a href="<?=Y::bua()?>author"><?=H::menuimg('authors')?>Авторы</a></li>
            <li><a href="<?=Y::bua()?>staff"><?=H::menuimg('staff')?>Операторы</a></li>            
            <li><a href="<?=Y::bua()?>black"><?=H::menuimg('black')?>Чёрный список</a></li>            
	    </ul>
    
    </li>
    
    
    <li><a onClick="return false;" href="#"><?=H::menuimg('goods')?>Товары</a>
    
   		<ul class="sub_menu">
                    <li><a href="<?=Y::bua()?>good"><?=H::menuimg('goods2')?>Все товары</a></li>                                        
		                <li><a href="<?=Y::bua()?>category"><?=H::menuimg('category')?>Категории</a></li>
                    <li><a href="<?=Y::bua()?>pincat"><?=H::menuimg('pin')?>PIN-коды</a></li>                    
                    <li><a href="<?=Y::bua()?>area"><?=H::menuimg('closed')?>Закрытые зоны</a></li>
                    <li><a href="<?=Y::bua()?>pages"><?=H::menuimg('page')?>Редактор страниц</a></li>                                        
            <li><a href="<?=Y::bua()?>maillist"><?=H::menuimg('maillist')?>Серии писем</a></li>
	    </ul>    
        
    </li>

    <li><a onClick="return false;" href="#"><?=H::menuimg('advanced')?>Прочее</a>
    
    	<ul class="sub_menu">
		    <li><a href="<?=Y::bua()?>support"><?=H::menuimg('support')?>Поддержка</a></li>
            <li><a href="<?=Y::bua()?>cupon"><?=H::menuimg('cupons')?>Скидки</a></li>            
            <li><a href="<?=Y::bua()?>rass"><?=H::menuimg('rass')?>Рассылка</a></li>
            <li><a href="<?=Y::bua()?>form"><?=H::menuimg('form')?>Конструктор форм</a></li>
            <li><a href="<?=Y::bua()?>odno"><?=H::menuimg('odno')?>Одностраничники</a></li>            
            <li><a href="<?=Y::bua()?>log"><?=H::menuimg('log')?>Журнал операций</a></li>                        

                <li><a onClick="return false;" href="#"><?=H::menuimg('other')?>Для партнёров</a>
                  	<ul class="sub_menu">
                            <li><a href="<?=Y::bua()?>anew"><?=H::menuimg('news')?>Новости</a></li>
					    <li><a href="<?=Y::bua()?>partnerpersonal"><?=H::menuimg('personal')?>Специальные комиссии</a></li>
                                            <li><a href="<?=Y::bua()?>partnerauto"><?=H::menuimg('autopersonal')?>Авто спецкомиссии</a></li>
                                            <li><a href="<?=Y::bua()?>plink"><?=H::menuimg('special')?>Особые ссылки</a></li>
                                            <li><a href="<?=Y::bua()?>goodgroup"><?=H::menuimg('groups')?>Группы товаров</a></li>
	    			</ul>
               	</li>
            
                <li><a onClick="return false;" href="#"><?=H::menuimg('moretmpl')?>Шаблоны</a>
                  	<ul class="sub_menu">
					    <li><a href="<?=Y::bua()?>templates"><?=H::menuimg('templates')?>HTML-шаблоны</a></li>
                 		<li><a href="<?=Y::bua()?>letter"><?=H::menuimg('mails')?>Системные письма</a></li>
			            <li><a href="<?=Y::bua()?>way"><?=H::menuimg('payforms')?>Способы оплаты</a></li>
			            <li><a href="<?=Y::bua()?>waylist"><?=H::menuimg('payways')?>Выбор оплаты</a></li>
		            	<li><a href="<?=Y::bua()?>ad"><?=H::menuimg('promo')?>Промо-материалы</a></li>
	    			</ul>    
               	</li>


        
    </li>

            
	    </ul>
    
    </li>
    
    <li><a href="<?=Y::bua()?>payouts"><?=H::menuimg('payouts')?>Выплаты</a></li>    
    
    <li><a onClick="return false;" href="#"><?=H::menuimg('settings')?>Настройки</a>
    
       	<ul class="sub_menu">
		    <li><a href="<?=Y::bua()?>settings/general"><?=H::menuimg('general')?>Общие</a></li>
            <li><a href="<?=Y::bua()?>settings/my"><?=H::menuimg('author')?>Мои данные</a></li>
       	    <li><a href="<?=Y::bua()?>settings/paysystems"><?=H::menuimg('paysystems')?>Платёжные системы</a></li>
           	<li><a href="<?=Y::bua()?>settings/partner"><?=H::menuimg('partner')?>Партнёрская программа</a></li>
	        <li><a href="<?=Y::bua()?>settings/interface"><?=H::menuimg('interface')?>Интерфейс</a></li>
       	    <li><a href="<?=Y::bua()?>staff/update/id/1"><?=H::menuimg('lock')?>Сменить пароль</a></li>
          <li><a href="<?=Y::bua()?>settings/update"><?=H::menuimg('globe')?>Обновления</a></li>
	        <li><a href="<?=Y::bua()?>settings/rezerv"><?=H::menuimg('database')?>Резервное копирование</a></li>
        </ul>
        
    </li>                                        
    <li><a href="<?=Y::bua()?>default/logout"><?=H::menuimg('logout')?>Выход</a></li>    
    <li><a style='margin-left: 12px;' href="<?php echo 'http://ordermaster.ru/help2/'.str_replace ('/','_',Yii::app()->controller->id.'_'.$this->action->id).'.html'; ?>" target='_blank'><?=H::menuimg('help'); ?></a>
</ul>        

        </div></td>
    </tr>
    <tr>
    <td width="750" valign="top">
    <div id="mainContent">    
        
                <?=Hint::scr () ?>
    
    		<?= $content ?>
            
            

				<?php $flashmsg = Y::user()->getFlash ('admin') ?>
				<?php if (!empty($flashmsg)): ?>

					<div class="wrap">
						<h3>Результат последнего действия</h3>
						<p align="center" id="resultMessage"><?= $flashmsg ?></p>
					</div>

				<?php endif; ?>

    </div>       
    
    </td>    

        <?php $sitems = $this->menu;             ?>
        
        <?php if (!empty ($sitems)): ?>
    
    
    <td width="215" valign="top">
        
        <div class="wrap2" style="margin-left:0px;">
            <h3>Действия</h3>

      <?php $sitems = $this->menu;
      $sitems = array_merge (array(
        array(
        'label'=>'Помощь по разделу',
        'url'=>'http://ordermaster.ru/help/'.str_replace ('/','_',Yii::app()->controller->id.'_'.$this->action->id).'.html',
        'itemOptions' => array ('class' => 'rmenu_help'),
        'linkOptions' => array ('target' => '_blank'))
      ),
      $sitems); ?>
                        
			<?php $this->widget('zii.widgets.CMenu', array(
				'items'=>$sitems,
				'htmlOptions'=>array('class'=>'operations'),
			)); ?>
           
        </div>    
        

    
    </td>

        <?php endif; ?>
    
    </tr>

</table>

</div>

<div id="copyright">
Программное обеспечение: Order Master 2. &copy; 2003-<?=date('Y');?>
</div>

</body>
</html>