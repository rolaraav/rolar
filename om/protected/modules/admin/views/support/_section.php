<p style="padding-bottom: 18px;"><span style="font-size:16px; font-weight: bold;"><?= CHtml::link(CHtml::encode($data->title).' ('.$data->openedCount.'/'.$data->totalCount.')', array('tickets', 'id'=>$data->id,
        
            'Ticket[status_id]' => 1,            

            )); ?></span>
<br /><br /></p>