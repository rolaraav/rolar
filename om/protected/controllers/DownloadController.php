<?php

class DownloadController extends Controller
{
    
    public function actionFile ($id = FALSE) {
        
        if (!preg_match ('/^[a-z0-9\.]+$/',$id)) die ('Bad link');
        
        $f = Good::decodeLink($id);
        
        $f = './files/goods/'.$f;
        
        if (file_exists($f)) {
            
            Yii::import('ext.helpers.EDownloadHelper');
            
            EDownloadHelper::download ($f);
            
        } else {
            die ('File not exists');
        }
        
    }
    
    
}