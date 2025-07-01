<?php $this->pageTitle='Главная - Панель партнёра' ?>

<div class="wrap">

<h1>Панель партнёра &quot;<?= Y::user()->id ?>&quot;</h1>

<h3>Аккаунт партнёра <?= Y::user()->id ?></h3>

<p>Здравствуйте, <?= Y::user()->title?></p>

<fieldset>
    
    <legend>Информация</legend>
    
    <ol>
        <li>
            <label>Всего заработано:</label> <?=H::mysum($aff->total) ?> рублей
        </li>
        
        <li>
            <label>Выплачено:</label> <?=H::mysum($aff->paid) ?> рублей
        </li>
        
        <li>
            <label>Ожидает выплаты:</label> <?=H::mysum($aff->total-$aff->paid) ?> рублей
        </li>
        
        <li>&nbsp;</li>
        
        <?php $cc = $aff->clickCount; $oc = $aff->orderCount; $kc = 0; ?>
        <?php if ($oc>0) $kc = ceil ($cc/$oc); ?>
        
        <li>
            <label>Кликов за всё время:</label> <?=$cc ?>
        </li>
        <li>
            <label>Продаж за всё время:</label> <span class="date"><b><?=$oc ?></b></span> <?php if ($kc>0) echo '(коэффициент продаж = 1:'.$kc.')'; ?>
        </li>
        
        <li>&nbsp;</li>
        
        <li>
            <label>Привлечено партнёров:</label> <?=$aff->partnerCount ?> <?=CHtml::link('смотреть список >>',array ('partners/index')); ?>
        </li>
        
        
        
    </ol>
    
</fieldset>


<br><br>

<?php if (Settings::item('affNewsOn')): ?>

<h1>Новости партнёрской программы</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>

<?php endif; ?>


</div>