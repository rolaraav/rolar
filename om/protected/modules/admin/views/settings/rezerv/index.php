<?php $this->pageTitle='Резервное копирование' ?>

<div class="wrap"><?

if( function_exists( "bzopen" ) ) {
	$comp_methods[2] = 'BZip2';
}
if( function_exists( "gzopen" ) ) {
	$comp_methods[1] = 'GZip';
}
$comp_methods[0] = "Без сжатия";

if( !function_exists( "fn_select" ) ) {
function fn_select($items, $selected) {
	$select = '';
	foreach ( $items as $key => $value ) {
		$select .= $key == $selected ? "<OPTION VALUE='{$key}' SELECTED>{$value}" : "<OPTION VALUE='{$key}'>{$value}";
	}
	return $select;
}
}
$comp_methods = fn_select( $comp_methods, '' );

echo CHtml::beginForm('?act=backup','post',array('enctype'=>'multipart/form-data'));
echo <<<HTML
        <div style="padding-top:5px;padding-bottom:2px;">
                
                <table width="100%">
                        <tr>
                                <td style="padding:5px;" bgcolor="#FFFFFF">
                                <p>Все резервные копии сохраняются в папку <b>/protected/_backup</b> (должна быть доступна для записи)</p><br>
                                        <table width="100%">
                                                <tr>
                                                        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;">
                                                                <div class="navigation">Сохранение резервной копии</div>
                                                        </td>
                                                </tr>
                                        </table>
                                        <div class="unterline"></div>
                                        <table width="100%">
                                                <tr>
                                                        <td style="padding:2px;">
                                                                Выберете метод сжатия базы данных: <SELECT NAME="comp_method">{$comp_methods}</SELECT>&nbsp;&nbsp;<input type="submit" class="edit" value="Сохранить" />
                                                        </td>
                                                </tr>
                                        </table>
                                </td>
                                <td></td>
                        </tr>
                </table>
        </div>
HTML;
echo CHtml::endForm();

if( !function_exists( "file_select" ) ) {
function file_select($bPath) {        
	$files = array ('');        
	if( is_dir($bPath) && $handle = opendir($bPath) ) {
		while ( false !== ($file = readdir( $handle )) ) {
			if( preg_match( "/^.+?\.sql(\.(gz|bz2))?$/", $file ) ) {
				$files[$file] = $file;
			}
		}
		closedir( $handle );
	}
	return $files;
}
}

$files = fn_select( file_select($backupPath), '' );


echo CHtml::beginForm('?act=restore','post',array('enctype'=>'multipart/form-data'));
echo <<<HTML
        <br><hr width="95%" align="center" style="border-bottom: 1px solid #003366; border-top:0"><br>
        <div style="padding-top:5px;padding-bottom:2px;">
                <table width="100%">
                        <tr>
                                <td style="padding:5px;" bgcolor="#FFFFFF">
                                       <p align="center" style="color:#CC0000; font-size:14px;"><b>ОСТОРОЖНО!<br><br> При восстановлении из резервной копии - абсолютно все предыдущие данные будут уничтожены и заменены резервной копией!</b><br><br></p>
                                        <table width="100%">
                                                <tr>
                                                        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;">
                                                                <div class="navigation">Загрузка резервной копии с диска</div>
                                                        </td>
                                                </tr>
                                        </table>
                                        <div class="unterline"></div>
                                        <table width="100%">
                                                <tr>
                                                        <td style="padding:2px;">
                                                                Выберите резервную копию базы данных: <SELECT NAME="file" style="font-size:11px;">{$files}</SELECT>&nbsp;&nbsp;<input type="submit" class="edit" value="Восстановить (!!!)" />
                                                        </td>
                                                </tr>
                                        </table>
                                </td>
                        </tr>
                </table>
        </div>
HTML;
echo CHtml::endForm();


?></div>