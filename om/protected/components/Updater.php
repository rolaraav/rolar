<?php


class Updater
{
    
    //Проверяет нужен ли код обновления
    public static function checkUpdate ()
    {
        return true; //Пока нет обновлений
    }
    
    //Вспомогательные функции
    
    //Вставка письма
    public static function addLetter ($id, $subject, $descr)
    {
        $f = file_get_contents ('./protected/data/updates/mails/'.$id.'.txt');        
        if (empty ($f)) return FALSE;
        
        //Формируем письмо и вставляем
        $m = new Letter ();
        $m->isNewRecord = TRUE;
        $m->id = $id;
        $m->description = $descr;
        $m->subject = $subject;
        $m->message = $f;
        $m->type = 'plain';
        $m->lon = 1;
        $m->save (FALSE);
        
        return TRUE;
        
    }
    
    //Добавление колонки
    private static function addColumn ($table, $colname, $type, $default = FALSE)
    {
        $command = Yii::app ()->db->createCommand ();
        $tt = $type;
        if ($default !== FALSE) {
            $tt .= ' default ';
            if (is_numeric ($defaut)) {
                $tt .= $default;                
            } else {
                $tt .= '"'. addslashes ($default) . '"';
            }
            
            $tt .= ' not null';
        }
        $command->addColumn ('{{'.$table.'}}',$colname, $tt);
    }
    
    //Добавление значения в конфигурацию
    private static function addConfig ($name, $value)
    {
        $s = new Settings ();
        $s->isNewRecord = TRUE;
        $s->id = $name;
        $s->value = $value;
        $s->save ();
        
        return TRUE;
                
    }    
    
}