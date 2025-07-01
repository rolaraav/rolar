<?php

class Uah
{
    
    public static function conv ($rur, $val = 'rur') {
        
        $t = Valuta::conv ($rur,$val);
        
        return $t['uah'];
        
    }
    
    
}
