<?php
/**
 * Система Order Master 2
 * Автор: Александр Долгу
 * https://ordermaster.ru/
 *
 * Описание файла: Хелпер для работы с XML   
 */
class Mxml {
    
        public static function GetXMLTree ($xmldata)
        {
        	// we want to know if an error occurs
        	//ini_set ('track_errors', '1');
        
        	$xmlreaderror = false;
        
        	$parser = xml_parser_create ('UTF-8');
        	xml_parser_set_option ($parser, XML_OPTION_SKIP_WHITE, 1);
        	xml_parser_set_option ($parser, XML_OPTION_CASE_FOLDING, 0);
        	if (!xml_parse_into_struct ($parser, $xmldata, $vals, $index)) {
        		$xmlreaderror = true;
        		echo "error";
        	}
        	xml_parser_free ($parser);
        
        	if (!$xmlreaderror) {
        		$result = array ();
        		$i = 0;
        		if (isset ($vals [$i]['attributes']))
        			foreach (array_keys ($vals [$i]['attributes']) as $attkey)
        			$attributes [$attkey] = $vals [$i]['attributes'][$attkey];
        
        		$result [$vals [$i]['tag']] = array_merge ($attributes, self::GetChildren ($vals, $i, 'open'));
        	}
        
        //	ini_set ('track_errors', '0');
        	return $result;
        }
        
        public static function GetChildren ($vals, &$i, $type)
        {
        	if ($type == 'complete') {
        		if (isset ($vals [$i]['value']))
        			return ($vals [$i]['value']);
        		else
        			return '';
        	}
        
        	$children = array (); // Contains node data
        
        	/* Loop through children */
        	while ($vals [++$i]['type'] != 'close') {
        		$type = $vals [$i]['type'];
        		// first check if we already have one and need to create an array
        		if (isset ($children [$vals [$i]['tag']])) {
        			if (is_array ($children [$vals [$i]['tag']])) {
        				$temp = array_keys ($children [$vals [$i]['tag']]);
        				// there is one of these things already and it is itself an array
        				if (is_string ($temp [0])) {
        					$a = $children [$vals [$i]['tag']];
        					unset ($children [$vals [$i]['tag']]);
        					$children [$vals [$i]['tag']][0] = $a;
        				}
        			} else {
        				$a = $children [$vals [$i]['tag']];
        				unset ($children [$vals [$i]['tag']]);
        				$children [$vals [$i]['tag']][0] = $a;
        			}
        
        			$children [$vals [$i]['tag']][] = self::GetChildren ($vals, $i, $type);
        		} else
        			$children [$vals [$i]['tag']] = self::GetChildren ($vals, $i, $type);
        		// I don't think I need attributes but this is how I would do them:
        		if (isset ($vals [$i]['attributes'])) {
        			$attributes = array ();
        			foreach (array_keys ($vals [$i]['attributes']) as $attkey)
        			$attributes [$attkey] = $vals [$i]['attributes'][$attkey];
        			// now check: do we already have an array or a value?
        			if (isset ($children [$vals [$i]['tag']])) {
        				// case where there is an attribute but no value, a complete with an attribute in other words
        				if ($children [$vals [$i]['tag']] == '') {
        					unset ($children [$vals [$i]['tag']]);
        					$children [$vals [$i]['tag']] = $attributes;
        				}
        				// case where there is an array of identical items with attributes
        				elseif (is_array ($children [$vals [$i]['tag']])) {
        					$index = count ($children [$vals [$i]['tag']]) - 1;
        					// probably also have to check here whether the individual item is also an array or not or what... all a bit messy
        					if ($children [$vals [$i]['tag']][$index] == '') {
        						unset ($children [$vals [$i]['tag']][$index]);
        						$children [$vals [$i]['tag']][$index] = $attributes;
        					}
        					$children [$vals [$i]['tag']][$index] = array_merge ($children [$vals [$i]['tag']][$index], $attributes);
        				} else {
        					$value = $children [$vals [$i]['tag']];
        					unset ($children [$vals [$i]['tag']]);
        					$children [$vals [$i]['tag']]['value'] = $value;
        					$children [$vals [$i]['tag']] = array_merge ($children [$vals [$i]['tag']], $attributes);
        				}
        			} else
        				$children [$vals [$i]['tag']] = $attributes;
        		}
        	}
        
        	return $children;
        }
}
