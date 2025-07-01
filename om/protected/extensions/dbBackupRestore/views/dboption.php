<?
echo CHtml::beginForm('?act=dboption','post',array('enctype'=>'multipart/form-data'));
echo <<<HTML
<div style="padding-top:5px;padding-bottom:2px;">
<table width="980">
        <tr>
                <td style="padding:5px;" bgcolor="#FFFFFF">
                        <table width="100%">
                                <tr>
                                        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;">
                                                <div class="navigation">Настройка и оптимизация базы данных</div>
                                        </td>
                                </tr>
                        </table>
                        <div class="unterline"></div>
                        <table width="100%">
                                <tr>
                                        <td width="220" style="padding:2px;">
                                                <select style="width:240px;font-size:11px;" size="7" name="tables[]" multiple="multiple">{$tables}</select>
                                        </td>
                                        <td valign="top">
                                                <input style="border:0px" type="radio" name="whattodo" checked="checked" value="optimize" />&nbsp;Optimize Tables<br />
                                                <input style="border:0px" type="radio" name="whattodo" value="repair" />&nbsp;Repair Tables
                                                <br /><br />
                                                <input type="submit" id="rest" class="bbcodes" value="Выполнить" />
                                        </td>
                                </tr>
                        </table>
                </td>
        </tr>
</table>
</div>
HTML;
echo CHtml::endForm();

if( function_exists( "bzopen" ) ) {
	$comp_methods[2] = 'BZip2';
}
if( function_exists( "gzopen" ) ) {
	$comp_methods[1] = 'GZip';
}
$comp_methods[0] = "Без сжатия";

function fn_select($items, $selected) {
	$select = '';
	foreach ( $items as $key => $value ) {
		$select .= $key == $selected ? "<OPTION VALUE='{$key}' SELECTED>{$value}" : "<OPTION VALUE='{$key}'>{$value}";
	}
	return $select;
}
$comp_methods = fn_select( $comp_methods, '' );

echo CHtml::beginForm('?act=backup','post',array('enctype'=>'multipart/form-data'));
echo <<<HTML
        <div style="padding-top:5px;padding-bottom:2px;">
                <table width="100%">
                        <tr>
                                <td style="padding:5px;" bgcolor="#FFFFFF">
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

function file_select($bPath) {
	$files = array ('' );
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

$files = fn_select( file_select($backupPath), '' );


echo CHtml::beginForm('?act=restore','post',array('enctype'=>'multipart/form-data'));
echo <<<HTML
        <div style="padding-top:5px;padding-bottom:2px;">
                <table width="100%">
                        <tr>
                                <td style="padding:5px;" bgcolor="#FFFFFF">
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
                                                                Выберите резервную копию базы данных: <SELECT NAME="file" style="font-size:11px;">{$files}</SELECT>&nbsp;&nbsp;<input type="submit" class="edit" value="Восстановить" />
                                                        </td>
                                                </tr>
                                        </table>
                                </td>
                        </tr>
                </table>
        </div>
HTML;
echo CHtml::endForm();


?>