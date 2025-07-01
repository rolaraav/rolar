<?php

/** 
 * Order Master 2
 * 
 */

class NHtml extends CHtml
{

	public static function ajaxSButton ($text,$url,$ajaxOptions=array(),$htmlOptions=array())
	{
		$ajaxOptions['url']=$url;
		$htmlOptions['ajax']=$ajaxOptions;
		self::clientChange('click',$htmlOptions);
		return self::tag('button',$htmlOptions,$text);
	}

}

?>