<?php

class Ars
{
    
    public static function datePicker ($name,$startDate)
    {
        return array(
            'name'=>$name,
            'value' => $startDate,

            'options'=>array(
                'showAnim'=>'fold',

            ),
            'language' => 'ru',
            'htmlOptions'=>array(
                'style'=>'height:20px;',
                'class' => 'text',
       ));
        
    }
    
    
    
}