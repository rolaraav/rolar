<?php
/***************************************************************************\
| Sypex Dumper Lite          version 1.0.8b                                 |
| (c)2003-2006 zapimir       zapimir@zapimir.net       http://sypex.net/    |
| (c)2005-2006 BINOVATOR     info@sypex.net                                 |
|---------------------------------------------------------------------------|
|     created: 2003.09.02 19:07              modified: 2006.10.27 03:30     |
|---------------------------------------------------------------------------|
|---------------------------------------------------------------------------|
\***************************************************************************/

// Кодировка соединения с MySQL
// auto - автоматический выбор (устанавливается кодировка таблицы), cp1251 - windows-1251, и т.п.
define('CHARSET', 'auto');

// Кодировка соединения с MySQL при восстановлении
// На случай переноса со старых версий MySQL (до 4.1), у которых не указана кодировка таблиц в дампе
// При добавлении 'forced->', к примеру 'forced->cp1251', кодировка таблиц при восстановлении будет принудительно заменена на cp1251
// Можно также указывать сравнение нужное к примеру 'cp1251_ukrainian_ci' или 'forced->cp1251_ukrainian_ci'
define('RESTORE_CHARSET', '');

// Типы таблиц у которых сохраняется только структура, разделенные запятой
define('ONLY_CREATE', 'MRG_MyISAM,MERGE,HEAP,MEMORY');

$timer = array_sum(explode(' ', microtime()));
ob_implicit_flush();

$auth = 0;
$error = '';

define('C_DEFAULT', 1);
define('C_RESULT', 2);
define('C_ERROR', 3);
define('C_WARNING', 4);

//if(!defined('AUTOMODE'))
//{
//	echo "<SCRIPT>document.getElementById('timer').innerHTML = '" . round(array_sum(explode(' ', microtime())) - $timer, 4) . " сек.'</SCRIPT>";
//}

class dumper {
        public $backupPath = './protected/_backup/';
        public $limit=1;
        public $dbnames;
        public $dbhost;
        public $dbuser;
        public $dbpass;
        public $dbprefix;
        private $SET;
        private $vars;

        public function __construct() { }
        
	protected function init()
        {
		$this->SET['last_action'] = 0;
		$this->SET['last_db_backup'] = '';
		$this->SET['tables'] = '';
		$this->SET['comp_method'] = 2;
		$this->SET['comp_level']  = 7;
		$this->SET['last_db_restore'] = '';
		$this->tabs = 0;
		$this->records = 0;
		$this->size = 0;
		$this->comp = 0;

                if (@mysql_connect($this->dbhost, $this->dbuser, $this->dbpass)){
                	$auth = 1;
                }
                else{
                	$error = '#' . mysql_errno() . ': ' . mysql_error();
                }

		// Версия MySQL вида 40101
		preg_match("/^(\d+)\.(\d+)\.(\d+)/", mysql_get_server_info(), $m);
		$this->mysql_version = sprintf("%d%02d%02d", $m[1], $m[2], $m[3]);

		$this->only_create = explode(',', ONLY_CREATE);
		$this->forced_charset  = false;
		$this->restore_charset = $this->restore_collate = '';
		if (preg_match("/^(forced->)?(([a-z0-9]+)(\_\w+)?)$/", RESTORE_CHARSET, $matches)) {
			$this->forced_charset  = $matches[1] == 'forced->';
			$this->restore_charset = $matches[3];
			$this->restore_collate = !empty($matches[4]) ? ' COLLATE ' . $matches[2] : '';
		}
	}

	public function backup() {
	        $this->init();
		if (!isset($_POST)) {$this->main();}
		set_error_handler("SXD_errorHandler");
		$buttons = "<A ID=save HREF='' STYLE='display: none;'>Скачать файл</A> &nbsp; <INPUT ID=back TYPE=button VALUE='Назад' onClick=\"javascript:history.go(-1);\">";
		echo tpl_page(tpl_process("Создается резервная копия БД"), $buttons);

		$this->SET['last_action']     = 0;
		$this->SET['last_db_backup']  = $this->dbnames;
		$this->SET['tables_exclude']  = 0;
		$this->SET['tables']          = $this->dbprefix.'*';
		$this->SET['comp_method']     = isset($_POST['comp_method']) ? intval($_POST['comp_method']) : 0;
		$this->SET['comp_level']      = 5;

		$this->SET['tables']          = explode(",", $this->SET['tables']);

		    foreach($this->SET['tables'] AS $table){
    			$table = preg_replace("/[^\w*?^]/", "", $table);
				$pattern = array( "/\?/", "/\*/");
				$replace = array( ".", ".*?");
				$tbls[] = preg_replace($pattern, $replace, $table);
    		}

		if ($this->SET['comp_level'] == 0) {
		    $this->SET['comp_method'] = 0;
		}
		$db = $this->SET['last_db_backup'];

		if (!$db) {
			echo tpl_l("ОШИБКА! Не указана база данных!", C_ERROR);
			echo tpl_enableBack();
		    exit;
		}
		echo tpl_l("Подключение к БД `{$db}`.");
        	if (@mysql_connect($this->dbhost, $this->dbuser, $this->dbpass)){
        		$auth = 1;
        	}
        	else{
        		$error = '#' . mysql_errno() . ': ' . mysql_error();
        	}

		mysql_select_db($db) or trigger_error ("Не удается выбрать базу данных.<BR>" . mysql_error(), E_USER_ERROR);
		$tables = array();
                $result = mysql_query("SHOW TABLES");
		$all = 0;
                while($row = mysql_fetch_array($result))
                {
			$status = 0;
			if (!empty($tbls)) {
			    foreach($tbls AS $table){
    				$exclude = preg_match("/^\^/", $table) ? true : false;
    				if (!$exclude) {
    					if (preg_match("/^{$table}$/i", $row[0])) {
    					    $status = 1;
    					}
    					$all = 1;
    				}
    				if ($exclude && preg_match("/{$table}$/i", $row[0])) {
    				    $status = -1;
    				}
    			}
			}
			else {
				$status = 1;
			}
			if ($status >= $all) {
    			$tables[] = $row[0];
    		}
        }

		$tabs = count($tables);
		// Определение размеров таблиц
		$result = mysql_query("SHOW TABLE STATUS");
		$tabinfo = array();
		$tab_charset = array();
		$tab_type = array();
		$tabinfo[0] = 0;
		$info = '';
		while($item = mysql_fetch_assoc($result)){
			//print_r($item);
			if(in_array($item['Name'], $tables)) {
				$item['Rows'] = empty($item['Rows']) ? 0 : $item['Rows'];
				$tabinfo[0] += $item['Rows'];
				$tabinfo[$item['Name']] = $item['Rows'];
				$this->size += $item['Data_length'];
				$tabsize[$item['Name']] = 1 + round($this->limit * 1048576 / ($item['Avg_row_length'] + 1));
				if($item['Rows']) $info .= "|" . $item['Rows'];
				if (!empty($item['Collation']) && preg_match("/^([a-z0-9]+)_/i", $item['Collation'], $m)) {
					$tab_charset[$item['Name']] = $m[1];
				}
				$tab_type[$item['Name']] = isset($item['Engine']) ? $item['Engine'] : $item['Type'];
			}
		}
		$show = 10 + $tabinfo[0] / 50;
		$info = $tabinfo[0] . $info;

		if(!defined('AUTOMODE'))
		{

		  $name = $db . '_' . date("Y-m-d_H-i");

		} else {

			$salt = "abchefghjkmnpqrstuvwxyz0123456789";
			srand((double)microtime()*1000000);
			$rand = "";

			for($i=0;$i < 9; $i++) {
				$rand .= $salt{rand(0,33)};
			}

		   $name = date("Y-m-d_H-i") . '_' . $db . '_' . md5($rand);

		}


        $fp = $this->fn_open($name, "w");
		echo tpl_l("Создание файла с резервной копией БД:<BR>\\n  -  {$this->filename}");
		$this->fn_write($fp, "#SKD101|{$db}|{$tabs}|" . date("Y.m.d H:i:s") ."|{$info}\n\n");
		$t=0;
		echo tpl_l(str_repeat("-", 60));
		$result = mysql_query("SET SQL_QUOTE_SHOW_CREATE = 1");
		// Кодировка соединения по умолчанию
		if ($this->mysql_version > 40101 && CHARSET != 'auto') {
			mysql_query("SET NAMES '" . CHARSET . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>" . mysql_error(), E_USER_ERROR);
			$last_charset = CHARSET;
		}
		else{
			$last_charset = '';
		}
        foreach ($tables AS $table){
			// Выставляем кодировку соединения соответствующую кодировке таблицы
			if ($this->mysql_version > 40101 && $tab_charset[$table] != $last_charset) {
				if (CHARSET == 'auto') {
					mysql_query("SET NAMES '" . $tab_charset[$table] . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>" . mysql_error(), E_USER_ERROR);
					echo tpl_l("Установлена кодировка соединения `" . $tab_charset[$table] . "`.", C_WARNING);
					$last_charset = $tab_charset[$table];
				}
				else{
					echo tpl_l('Кодировка соединения и таблицы не совпадает:', C_ERROR);
					echo tpl_l('Таблица `'. $table .'` -> ' . $tab_charset[$table] . ' (соединение '  . CHARSET . ')', C_ERROR);
				}
			}
			echo tpl_l("Обработка таблицы `{$table}` [" . fn_int($tabinfo[$table]) . "].");
        	// Создание таблицы
			$result = mysql_query("SHOW CREATE TABLE `{$table}`");
        	$tab = mysql_fetch_array($result);
			$tab = preg_replace('/(default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP|DEFAULT CHARSET=\w+|COLLATE=\w+|character set \w+|collate \w+)/i', '/*!40101 \\1 */', $tab);
        	$this->fn_write($fp, "DROP TABLE IF EXISTS `{$table}`;\n{$tab[1]};\n\n");
        	// Проверяем нужно ли дампить данные
        	if (in_array($tab_type[$table], $this->only_create)) {
				continue;
			}
        	// Опредеделяем типы столбцов
            $NumericColumn = array();
            $result = mysql_query("SHOW COLUMNS FROM `{$table}`");
            $field = 0;
            while($col = mysql_fetch_row($result)) {
            	$NumericColumn[$field++] = preg_match("/^(\w*int|year)/", $col[1]) ? 1 : 0;
            }
			$fields = $field;
            $from = 0;
			$limit = $tabsize[$table];
			$limit2 = round($limit / 3);
			if ($tabinfo[$table] > 0) {
			if ($tabinfo[$table] > $limit2) {
			    echo tpl_s(0, $t / $tabinfo[0]);
			}
			$i = 0;
			$this->fn_write($fp, "INSERT INTO `{$table}` VALUES");
            while(($result = mysql_query("SELECT * FROM `{$table}` LIMIT {$from}, {$limit}")) && ($total = mysql_num_rows($result))){
            		while($row = mysql_fetch_row($result)) {
                    	$i++;
    					$t++;

						for($k = 0; $k < $fields; $k++){
                    		if ($NumericColumn[$k])
                    		    $row[$k] = isset($row[$k]) ? $row[$k] : "NULL";
                    		else
                    			$row[$k] = isset($row[$k]) ? "'" . mysql_real_escape_string($row[$k]) . "'" : "NULL";
                    	}

    					$this->fn_write($fp, ($i == 1 ? "" : ",") . "\n(" . implode(", ", $row) . ")");
    					if ($i % $limit2 == 0)
    						echo tpl_s($i / $tabinfo[$table], $t / $tabinfo[0]);
               		}
					mysql_free_result($result);
					if ($total < $limit) {
					    break;
					}
    				$from += $limit;
            }

			$this->fn_write($fp, ";\n\n");
    		echo tpl_s(1, $t / $tabinfo[0]);}
		}
		$this->tabs = $tabs;
		$this->records = $tabinfo[0];
		$this->comp = $this->SET['comp_method'] * 10 + $this->SET['comp_level'];
                echo tpl_s(1, 1);
                echo tpl_l(str_repeat("-", 60));
                $this->fn_close($fp);
		echo tpl_l("Резервная копия БД `{$db}` создана.", C_RESULT);
		echo tpl_l("Размер БД:       " . round($this->size / 1048576, 2) . " МБ", C_RESULT);
		$filesize = round(filesize($this->backupPath . $this->filename) / 1048576, 2) . " МБ";
		echo tpl_l("Размер файла: {$filesize}", C_RESULT);
		echo tpl_l("Таблиц обработано: {$tabs}", C_RESULT);
		echo tpl_l("Строк обработано:   " . fn_int($tabinfo[0]), C_RESULT);

		//if(!defined('AUTOMODE'))
		//{
		//	echo "<SCRIPT>with (document.getElementById('save')) {style.display = ''; innerHTML = 'Скачать файл ({$filesize})'; href = '" . URL . $this->filename . "'; }document.getElementById('back').disabled = 0;</SCRIPT>";
		//}

	}

	public function restore(){
		if (!isset($_POST)) {$this->main();}
		$this->init();
		set_error_handler("SXD_errorHandler");
		$buttons = "<INPUT ID=back TYPE=button VALUE='Назад' DISABLED onClick=\"javascript:history.go(-1);\">";
		echo tpl_page(tpl_process("Восстановление БД из резервной копии"), $buttons);

		$this->SET['last_action']     = 1;
		$this->SET['last_db_restore'] = $this->dbnames;
		$file  = isset($_POST['file']) ? $_POST['file'] : './protected/install.sql';

		$db = $this->SET['last_db_restore'];

		if (!$db) {
			echo tpl_l("ОШИБКА! Не указана база данных!", C_ERROR);
			echo tpl_enableBack();
		    exit;
		}
		echo tpl_l("Подключение к БД `{$db}`.");
		mysql_select_db($db) or trigger_error ("Не удается выбрать базу данных.<BR>" . mysql_error(), E_USER_ERROR);

		// Определение формата файла
		if(preg_match("/^(.+?)\.sql(\.(bz2|gz))?$/", $file, $matches)) {
			if (isset($matches[3]) && $matches[3] == 'bz2') {
			    $this->SET['comp_method'] = 2;
			}
			elseif (isset($matches[2]) &&$matches[3] == 'gz'){
				$this->SET['comp_method'] = 1;
			}
			else{
				$this->SET['comp_method'] = 0;
			}
			$this->SET['comp_level'] = '';

			if (!file_exists($this->backupPath . "/{$file}")) {
    		    echo tpl_l("ОШИБКА! Файл не найден!", C_ERROR);
				echo tpl_enableBack();
    		    exit;
    		}
			echo tpl_l("Чтение файла `{$file}`.");
			$file = $matches[1];
		}
		else{
			echo tpl_l("ОШИБКА! Не выбран файл!", C_ERROR);
			echo tpl_enableBack();
		    exit;
		}
		echo tpl_l(str_repeat("-", 60));
		$fp = $this->fn_open($file, "r");
		$this->file_cache = $sql = $table = $insert = '';
                $is_skd = $query_len = $execute = $q =$t = $i = $aff_rows = 0;
		$limit = 300;
                $index = 4;
		$tabs = 0;
		$cache = '';
		$info = array();

		// Установка кодировки соединения
		if ($this->mysql_version > 40101 && (CHARSET != 'auto' || $this->forced_charset)) { // Кодировка по умолчанию, если в дампе не указана кодировка
			mysql_query("SET NAMES '" . $this->restore_charset . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>" . mysql_error(), E_USER_ERROR);
			echo tpl_l("Установлена кодировка соединения `" . $this->restore_charset . "`.", C_WARNING);
			$last_charset = $this->restore_charset;
		}
		else {
			$last_charset = '';
		}
		$last_showed = '';
		while(($str = $this->fn_read_str($fp)) !== false){
			if (empty($str) || preg_match("/^(#|--)/", $str)) {
				if (!$is_skd && preg_match("/^#SKD101\|/", $str)) {
				    $info = explode("|", $str);
					echo tpl_s(0, $t / $info[4]);
					$is_skd = 1;
				}
        	    continue;
        	}
			$query_len += strlen($str);

			if (!$insert && preg_match("/^(INSERT INTO `?([^` ]+)`? .*?VALUES)(.*)$/i", $str, $m)) {
				if ($table != $m[2]) {
				    $table = $m[2];
					$tabs++;
					$cache .= tpl_l("Таблица `{$table}`.");
					$last_showed = $table;
					$i = 0;
					if ($is_skd)
					    echo tpl_s(100 , $t / $info[4]);
				}
        	    $insert = $m[1] . ' ';
				$sql .= $m[3];
				$index++;
				$info[$index] = isset($info[$index]) ? $info[$index] : 0;
				$limit = round($info[$index] / 20);
				$limit = $limit < 300 ? 300 : $limit;
				if ($info[$index] > $limit){
					echo $cache;
					$cache = '';
					echo tpl_s(0 / $info[$index], $t / $info[4]);
				}
        	}
			else{
        		$sql .= $str;
				if ($insert) {
				    $i++;
    				$t++;
    				if ($is_skd && $info[$index] > $limit && $t % $limit == 0){
    					echo tpl_s($i / $info[$index], $t / $info[4]);
    				}
				}
        	}

			if (!$insert && preg_match("/^CREATE TABLE (IF NOT EXISTS )?`?([^` ]+)`?/i", $str, $m) && $table != $m[2]){
				$table = $m[2];
				$insert = '';
				$tabs++;
				$is_create = true;
				$i = 0;
			}
			if ($sql) {
			    if (preg_match("/;$/", $str)) {
            		$sql = rtrim($insert . $sql, ";");
					if (empty($insert)) {
						if ($this->mysql_version < 40101) {
				    		$sql = preg_replace("/ENGINE\s?=/", "TYPE=", $sql);
						}
						elseif (preg_match("/CREATE TABLE/i", $sql)){
							// Выставляем кодировку соединения
							if (preg_match("/(CHARACTER SET|CHARSET)[=\s]+(\w+)/i", $sql, $charset)) {
								if (!$this->forced_charset && $charset[2] != $last_charset) {
									if (CHARSET == 'auto') {
										mysql_query("SET NAMES '" . $charset[2] . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>{$sql}<BR>" . mysql_error(), E_USER_ERROR);
										$cache .= tpl_l("Установлена кодировка соединения `" . $charset[2] . "`.", C_WARNING);
										$last_charset = $charset[2];
									}
									else{
										$cache .= tpl_l('Кодировка соединения и таблицы не совпадает:', C_ERROR);
										$cache .= tpl_l('Таблица `'. $table .'` -> ' . $charset[2] . ' (соединение '  . $this->restore_charset . ')', C_ERROR);
									}
								}
								// Меняем кодировку если указано форсировать кодировку
								if ($this->forced_charset) {
									$sql = preg_replace("/(\/\*!\d+\s)?((COLLATE)[=\s]+)\w+(\s+\*\/)?/i", '', $sql);
									$sql = preg_replace("/((CHARACTER SET|CHARSET)[=\s]+)\w+/i", "\\1" . $this->restore_charset . $this->restore_collate, $sql);
								}
							}
							elseif(CHARSET == 'auto'){ // Вставляем кодировку для таблиц, если она не указана и установлена auto кодировка
								$sql .= ' DEFAULT CHARSET=' . $this->restore_charset . $this->restore_collate;
								if ($this->restore_charset != $last_charset) {
									mysql_query("SET NAMES '" . $this->restore_charset . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>{$sql}<BR>" . mysql_error(), E_USER_ERROR);
									$cache .= tpl_l("Установлена кодировка соединения `" . $this->restore_charset . "`.", C_WARNING);
									$last_charset = $this->restore_charset;
								}
							}
						}
						if ($last_showed != $table) {$cache .= tpl_l("Таблица `{$table}`."); $last_showed = $table;}
					}
					elseif($this->mysql_version > 40101 && empty($last_charset)) { // Устанавливаем кодировку на случай если отсутствует CREATE TABLE
						mysql_query("SET $this->restore_charset '" . $this->restore_charset . "'") or trigger_error ("Неудается изменить кодировку соединения.<BR>{$sql}<BR>" . mysql_error(), E_USER_ERROR);
						echo tpl_l("Установлена кодировка соединения `" . $this->restore_charset . "`.", C_WARNING);
						$last_charset = $this->restore_charset;
					}
            		$insert = '';
            	    $execute = 1;
            	}
            	if ($query_len >= 65536 && preg_match("/,$/", $str)) {
            		$sql = rtrim($insert . $sql, ",");
            	    $execute = 1;
            	}
    			if ($execute) {
            		$q++;
            		mysql_query($sql) or trigger_error ("Неправильный запрос.<BR>" . mysql_error(), E_USER_ERROR);
					if (preg_match("/^insert/i", $sql)) {
            		    $aff_rows += mysql_affected_rows();
            		}
            		$sql = '';
            		$query_len = 0;
            		$execute = 0;
            	}
			}
		}
		echo $cache;
		echo tpl_s(1 , 1);
		echo tpl_l(str_repeat("-", 60));
		echo tpl_l("БД восстановлена из резервной копии.", C_RESULT);
		if (isset($info[3])) echo tpl_l("Дата создания копии: {$info[3]}", C_RESULT);
		echo tpl_l("Запросов к БД: {$q}", C_RESULT);
		echo tpl_l("Таблиц создано: {$tabs}", C_RESULT);
		echo tpl_l("Строк добавлено: {$aff_rows}", C_RESULT);

		$this->tabs = $tabs;
		$this->records = $aff_rows;
		$this->size = filesize($this->backupPath . $this->filename);
		$this->comp = $this->SET['comp_method'] * 10 + $this->SET['comp_level'];
		echo "<SCRIPT>document.getElementById('back').disabled = 0;</SCRIPT>";

		$this->fn_close($fp);
	}

	function main(){
		$this->comp_levels = array('9' => '9 (максимальная)', '8' => '8', '7' => '7', '6' => '6', '5' => '5 (средняя)', '4' => '4', '3' => '3', '2' => '2', '1' => '1 (минимальная)','0' => 'Без сжатия');

		if (function_exists("bzopen")) {
		    $this->comp_methods[2] = 'BZip2';
		}
		if (function_exists("gzopen")) {
		    $this->comp_methods[1] = 'GZip';
		}
		$this->comp_methods[0] = 'Без сжатия';
		if (count($this->comp_methods) == 1) {
		    $this->comp_levels = array('0' =>'Без сжатия');
		}

		$dbs = $this->db_select();
		$this->vars['comp_methods'] = $this->fn_select($this->comp_methods, $this->SET['comp_method']);
		$this->vars['files']        = $this->fn_select($this->file_select(), '');
		$buttons = "<INPUT TYPE='button' VALUE='Назад' onClick=\"javascript:history.go(-1);\">";
		echo tpl_page(tpl_main(), $buttons);
	}

	function db_select(){
		if ($this->dbnames != '') {
			$items = explode(',', trim($this->dbnames));
			foreach($items AS $item){
    			if (mysql_select_db($item)) {
    				$tables = mysql_query("SHOW TABLES");
    				if ($tables) {
    	  			    $tabs = mysql_num_rows($tables);
    	  				$dbs[$item] = "{$item} ({$tabs})";
    	  			}
    			}
			}
		}
		else {
    		$result = mysql_query("SHOW DATABASES");
    		$dbs = array();
    		while($item = mysql_fetch_array($result)){
    			if (mysql_select_db($item[0])) {
    				$tables = mysql_query("SHOW TABLES");
    				if ($tables) {
    	  			    $tabs = mysql_num_rows($tables);
    	  				$dbs[$item[0]] = "{$item[0]} ({$tabs})";
    	  			}
    			}
    		}
		}
	    return $dbs;
	}

	function file_select(){
		$files = array('' => ' ');
		if (is_dir($this->backupPath) && $handle = opendir($this->backupPath)) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match("/^.+?\.sql(\.(gz|bz2))?$/", $file)) {
                    $files[$file] = $file;
                }
            }
            closedir($handle);
        }
        ksort($files);
		return $files;
	}

	function fn_open($name, $mode){
		if ($this->SET['comp_method'] == 2) {
			$this->filename = "{$name}.sql.bz2";
		    return bzopen($this->backupPath . $this->filename, "{$mode}");
		}
		elseif ($this->SET['comp_method'] == 1) {
			$this->filename = "{$name}.sql.gz";
		    return gzopen($this->backupPath . $this->filename, "{$mode}b{$this->SET['comp_level']}");
		}
		else{
			$this->filename = "{$name}.sql";
			return fopen($this->backupPath . $this->filename, "{$mode}b");
		}
	}

	function fn_write($fp, $str){
		if ($this->SET['comp_method'] == 2) {
		    bzwrite($fp, $str);
		}
		elseif ($this->SET['comp_method'] == 1) {
		    gzwrite($fp, $str);
		}
		else{
			fwrite($fp, $str);
		}
	}

	function fn_read($fp){
		if ($this->SET['comp_method'] == 2) {
		    return bzread($fp, 4096);
		}
		elseif ($this->SET['comp_method'] == 1) {
		    return gzread($fp, 4096);
		}
		else{
			return fread($fp, 4096);
		}
	}

	function fn_read_str($fp){
		$string = '';
		$this->file_cache = ltrim($this->file_cache);
		$pos = strpos($this->file_cache, "\n", 0);
		if ($pos < 1) {
			while (!$string && ($str = $this->fn_read($fp))){
    			$pos = strpos($str, "\n", 0);
    			if ($pos === false) {
    			    $this->file_cache .= $str;
    			}
    			else{
    				$string = $this->file_cache . substr($str, 0, $pos);
    				$this->file_cache = substr($str, $pos + 1);
    			}
    		}
			if (!$str) {
			    if ($this->file_cache) {
					$string = $this->file_cache;
					$this->file_cache = '';
				    return trim($string);
				}
			    return false;
			}
		}
		else {
  			$string = substr($this->file_cache, 0, $pos);
  			$this->file_cache = substr($this->file_cache, $pos + 1);
		}
		return trim($string);
	}

	function fn_close($fp){
		if ($this->SET['comp_method'] == 2) {
		    bzclose($fp);
		}
		elseif ($this->SET['comp_method'] == 1) {
		    gzclose($fp);
		}
		else{
			fclose($fp);
		}
		@chmod($this->backupPath . $this->filename, 0666);
		$this->fn_index();
	}

	function fn_select($items, $selected){
		$select = '';
		foreach($items AS $key => $value){
			$select .= $key == $selected ? "<OPTION VALUE='{$key}' SELECTED>{$value}" : "<OPTION VALUE='{$key}'>{$value}";
		}
		return $select;
	}

	function fn_save(){
		return;
	}

	function fn_index(){
		if (!file_exists($this->backupPath . 'index.html')) {
		    $fh = fopen($this->backupPath . 'index.html', 'wb');
			fwrite($fh, tpl_backup_index());
			fclose($fh);
			@chmod($this->backupPath . 'index.html', 0666);
		}
	}
}

function fn_int($num){
	return number_format($num, 0, ',', ' ');
}

function fn_arr2str($array) {
	$str = "array(\n";
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$str .= "'$key' => " . fn_arr2str($value) . ",\n\n";
		}
		else {
			$str .= "'$key' => '" . str_replace("'", "\'", $value) . "',\n";
		}
	}
	return $str . ")";
}

// Шаблоны

function tpl_page($content = '', $buttons = ''){
if(defined('AUTOMODE'))
{

  return;

}

return <<<HTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Резервное копирование / восстановление</TITLE>
<META HTTP-EQUIV=Content-Type CONTENT="text/html; charset=utf-8">
<STYLE TYPE="TEXT/CSS">
<!--
body{
	overflow: auto;
}
form {
margin:0px;
padding: 0px;
}

table{
border:0px;
border-collapse:collapse;
}

table td{
padding:0px;
font-size: 11px;
font-family: tahoma;
}

input, select, div {
	font: 11px tahoma, verdana, arial;
}
input.text, select {
	width: 100%;
}
fieldset {
	margin-bottom: 10px;
}
.unterline {
	width: 100%;
	height: 9px;
	font-size: 3px;
	font-family: tahoma;
	margin-bottom: 4px;
}
.hr_line {
	width: 100%;
	height: 7px;
	font-size: 3px;
	font-family: tahoma;
	margin-top: 4px;
	margin-bottom: 4px;
}
-->
</STYLE>
</HEAD>

<BODY BGCOLOR="#F4F3EE" TEXT="#000000">
<TABLE WIDTH=100% HEIGHT=100% BORDER=0 CELLSPACING=0 CELLPADDING=0 ALIGN=CENTER>
<TR>
<TD HEIGHT=60% ALIGN=CENTER VALIGN=MIDDLE>

<table align="center" width="500">
    <tr>
        <td width="4" height="16"></td>
		<td></td>
		<td width="4"></td>
    </tr>
	<tr>
        <td width="4"></td>
		<td valign="top" style="padding:8px;" bgcolor="#FFFFFF">


<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;" ID=Header><div class="navigation">Резервное копирование / восстановление</div></td>
    </tr>
</table>
<div class="unterline"></div>
<table width="100%">
    <tr>
        <td><FORM NAME=skb METHOD=POST ACTION=dumper.php>
<TD VALIGN=TOP STYLE="padding: 8px 8px;">
{$content}
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<TD STYLE='color: #CECECE' ID=timer></TD>
<TD ALIGN=RIGHT>{$buttons}</TD>
</TR>
</TABLE></TD>
</FORM></td>
    </tr>
</table>




		</td>
		<td width="4"></td>
    </tr>
	<tr>
        <td height="16"></td>
		<td></td>
		<td></td>
    </tr>
</table>


</TD>
</TR>
</TABLE>
</BODY>
</HTML>
HTML;
}

function tpl_main(){

if(defined('AUTOMODE'))
{

  return;

}

global $SK;
return <<<HTML
<FIELDSET onClick="document.skb.action[0].checked = 1;">
<LEGEND>
<INPUT TYPE=radio NAME=action VALUE=backup>
Backup / Создание резервной копии БД&nbsp;</LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR WIDTH=35%>
<TD>Метод сжатия:</TD>
<TD WIDTH=65%><SELECT NAME=comp_method>
{$SK->vars['comp_methods']}
</SELECT></TD>
</TR>
</TABLE>
</FIELDSET>
<FIELDSET onClick="document.skb.action[1].checked = 1;">
<LEGEND>
<INPUT TYPE=radio NAME=action VALUE=restore>
Restore / Восстановление БД из резервной копии&nbsp;</LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<TD WIDTH=35%>Файл:</TD>
<TD WIDTH=65%><SELECT NAME=file>
{$SK->vars['files']}
</SELECT></TD>
</TR>
</TABLE>
</FIELDSET>
</SPAN>
<SCRIPT>
document.skb.action[{$SK->SET['last_action']}].checked = 1;
</SCRIPT>

HTML;
}

function tpl_process($title){

if(defined('AUTOMODE'))
{

  return;

}

return <<<HTML
<FIELDSET>
<LEGEND>{$title}&nbsp;</LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR><TD COLSPAN=2 style="padding:2px;"><DIV ID=logarea STYLE="width: 100%; height: 140px; border: 1px solid #7F9DB9; padding: 3px; overflow: auto;"></DIV></TD></TR>
<TR><TD WIDTH=31% style="padding:2px;">Статус таблицы:</TD><TD WIDTH=69%><TABLE WIDTH=100% style="border: 1px solid #7F9DB9;" CELLPADDING=0 CELLSPACING=0>
<TR><TD BGCOLOR=#FFFFFF><TABLE WIDTH=1 BORDER=0 CELLPADDING=0 CELLSPACING=0 BGCOLOR=#5555CC ID=st_tab
STYLE="FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#CCCCFF,endColorStr=#5555CC);
border-right: 1px solid #AAAAAA"><TR><TD HEIGHT=12></TD></TR></TABLE></TD></TR></TABLE></TD></TR>
<TR><TD style="padding:2px;">Общий статус:</TD><TD><TABLE WIDTH=100% style="border: 1px solid #7F9DB9;" CELLSPACING=0 CELLPADDING=0>
<TR><TD BGCOLOR=#FFFFFF><TABLE WIDTH=1 BORDER=0 CELLPADDING=0 CELLSPACING=0 BGCOLOR=#00AA00 ID=so_tab
STYLE="FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#CCFFCC,endColorStr=#00AA00);
border-right: 1px solid #AAAAAA"><TR><TD HEIGHT=12></TD></TR></TABLE></TD>
</TR></TABLE></TD></TR></TABLE>
</FIELDSET>
<SCRIPT>
var WidthLocked = false;
function s(st, so){
	document.getElementById('st_tab').width = st ? st + '%' : '1';
	document.getElementById('so_tab').width = so ? so + '%' : '1';
}
function l(str, color){
	switch(color){
		case 2: color = 'navy'; break;
		case 3: color = 'red'; break;
		case 4: color = 'maroon'; break;
		default: color = 'black';
	}
	with(document.getElementById('logarea')){
		if (!WidthLocked){
			style.width = clientWidth;
			WidthLocked = true;
		}
		str = '<FONT COLOR=' + color + '>' + str + '</FONT>';
		innerHTML += innerHTML ? "<BR>\\n" + str : str;
		scrollTop += 14;
	}
}
</SCRIPT>
HTML;
}

function tpl_l($str, $color = C_DEFAULT){

if(defined('AUTOMODE'))
{

  return;

}

$str = preg_replace("/\s{2}/", " &nbsp;", $str);
return <<<HTML
<SCRIPT>l('{$str}', $color);</SCRIPT>

HTML;
}

function tpl_enableBack(){

if(defined('AUTOMODE'))
{

  return;

}

return <<<HTML
<SCRIPT>document.getElementById('back').disabled = 0;</SCRIPT>

HTML;
}

function tpl_s($st, $so){

if(defined('AUTOMODE'))
{

  return;

}

$st = round($st * 100);
$st = $st > 100 ? 100 : $st;
$so = round($so * 100);
$so = $so > 100 ? 100 : $so;
return <<<HTML
<SCRIPT>s({$st},{$so});</SCRIPT>

HTML;
}

function tpl_backup_index(){

if(defined('AUTOMODE'))
{

  return;

}

return <<<HTML
<CENTER>
<H1>access denied</H1>
</CENTER>

HTML;
}

function tpl_error($error){

if(defined('AUTOMODE'))
{

  return;

}

return <<<HTML
<FIELDSET>
<LEGEND>Ошибка при подключении к БД</LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<TD ALIGN=center>{$error}</TD>
</TR>
</TABLE>
</FIELDSET>

HTML;
}

function SXD_errorHandler($errno, $errmsg, $filename, $linenum, $vars) {
	if ($errno == 2048) return true;
	if (preg_match("/chmod\(\).*?: Operation not permitted/", $errmsg)) return true;
    $dt = date("Y.m.d H:i:s");
    $errmsg = addslashes($errmsg);

	echo tpl_l("{$dt}<BR><B>Возникла ошибка!</B>", C_ERROR);
	echo tpl_l("{$errmsg} ({$errno})", C_ERROR);
	echo tpl_enableBack();
	die();
}
?>