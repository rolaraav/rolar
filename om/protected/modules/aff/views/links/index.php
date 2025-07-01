<?php $this->pageTitle='Партнёрские ссылки - Панель партнёра' ?>

<div class="wrap">

    <h3>Аккаунт партнёра</h3>


    <h1>Партнёрские ссылки</h1>
    
<p style="font-size:9px">Чтобы отслеживать субаккаунт (канал рекламы) для реф-ссылки любого товара - добавьте в конец ссылки <b>/субаккаунт</b> <br>(где /субаккаунт - нужное имя или макрос тизерной/другой сети, только английскими буквами, по умолчанию это <b>default</b>).
    
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'good-grid',
    'dataProvider'=>$model->search(),
       'selectableRows' => false,
       'enablePagination' => false,
       'enableSorting' => false,
       'summaryText' => '',
    'filter'=>NULL,    
    'htmlOptions' => array('style' => 'width:680px; font-size:11px'),
    'columns'=>array(

         array(
                'name'=>'title',
                'value'=>'CHtml::link($data->title,$data->affLink,array(\'target\' => \'_blank\'))',
                'type' => 'raw',
                'headerHtmlOptions'=>array('width'=>'240','style'=>'font-size:11px'),
                'htmlOptions' => array ('style'=>'font-size:11px'),
         ),

         array(
                'header' => 'Реф-ссылка',
                'value'=>'Y::bu().\'go/\'.Y::user()->id.\'/p/\'.$data->id',
                'headerHtmlOptions'=>array('width'=>'280','style'=>'font-size:11px'),
                'htmlOptions' => array ('style'=>'font-size:11px'),
         ),

         array(
                'name'=>'affKomis',
                'value'=>'((PartnerPersonal::sum(Y::user()->id, $data->id,"t",$data->affKomisType))==\'fixed\')?(PartnerPersonal::sum(Y::user()->id, $data->id,"s",$data->affKomis).H::valuta($data->currency)):PartnerPersonal::sum(Y::user()->id, $data->id,"s",$data->affKomis).\'%\'',
                'headerHtmlOptions'=>array('width'=>'80','style'=>'font-size:11px'),
                'htmlOptions' => array ('style'=>'font-size:11px;color:#CC0000'),
         ),
         
         array(
                'name'=>'affPkomis',
                'header' => '2ур.',
                'value'=>'($data->affPkomisType==\'fixed\')?(($data->affPkomis+0).H::valuta($data->currency)):$data->affPkomis.\'%\'',
                'headerHtmlOptions'=>array('width'=>'40','style'=>'font-size:11px'),
                'htmlOptions' => array ('style'=>'font-size:11px;color:#CC0000'),
         ),
         

         array(
                'header' => ' ',
                'value'=>'CHtml::link(\'материалы\',array(\'amd\',\'id\'=>$data->id))',
                'type' => 'raw',
                'headerHtmlOptions'=>array('width'=>'50','style'=>'font-size:11px'),
                'htmlOptions' => array ('style'=>'font-size:11px'),
         ),


    ),
)); ?>


<p><b>Ссылка для привлечения партнёров в партнёрскую программу:</b><br><br>
    <?=Y::bu().'go/'.Yii::app()->user->id?>/a

</div>