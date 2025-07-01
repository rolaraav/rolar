<?

/*
 * DataBase Backup and Restore
 *
 * Using:
 * 1. First Step.
 * Extract dbBackupRestore folder to [webroot]/protected/extensions/dbBackupRestore
 * --Test:
 * -- You must have an "[webroot]/protected/extensions/dbBackupRestore/EdbBackupRestore.php" file
 * -- if you all right way.
 *
 * 2. Last Step.
 * Create "action" like this:
 *
 *       public function actionDbBackupRestore()
 *       {
 *               $dbBackup=Yii::createComponent('application.extensions.dbBackupRestore.EdbBackupRestore');
 *               if($_POST)
 *               {
 *                       switch($_GET['act'])
 *                       {
 *                               case "dboption": { $dbBackup->dboption($_POST['whattodo'],$_POST['tables']); $this->redirect(Yii::app()->request->getUrlReferrer()); break; }
 *                               case "backup"  : { $dbBackup->backup(); break; }
 *                               case "restore" : { $dbBackup->restore(); break; }
 *                               default        : { $this->redirect(Yii::app()->request->getUrlReferrer()); break; }
 *                       }
 *               }
 *               else
 *               {
 *                       $r=$dbBackup->run();
 *                       $this->render('index',array('content'=>$r));
 *               }
 *       }
 *
 */

 //TODO: Need more comments (rus: Нужно больше комментариев к коду и перевести на английский)

class EdbBackupRestore
{
        public $backupPath="";
        public $dbnames;
        public $dbhost;
        public $dbuser;
        public $dbpass;
        public $dbprefix;
        private $time_limit=600;

        protected function init()
        {
                if(empty($this->backupPath))
                {
                        $this->backupPath=Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'_backup'.DIRECTORY_SEPARATOR;
                }

                if(!file_exists($this->backupPath))
                {
                        @mkdir($this->backupPath);
                        if(!file_exists($this->backupPath))
                                throw new CException("\nCan't create folder: ".$this->backupPath."\n");
                }
                if (!is_writable($this->backupPath))
                        throw new CException("\nFolder is not writable: ".$this->backupPath."\n");

                $is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
                if (!$is_safe_mode && function_exists('set_time_limit')) set_time_limit($this->time_limit);

                $parsed=$this->parseDSN(Yii::app()->db->connectionString);

                if(empty($this->dbnames))
                {
                        $this->dbnames=$parsed['dbname'];
                }
                if(empty($this->dbhost))
                {
                        $this->dbhost=$parsed['dbhost'];
                }
                if(empty($this->dbuser))
                {
                        $this->dbuser=Yii::app()->db->username;
                }
                if(empty($this->dbpass))
                {
                        $this->dbpass=Yii::app()->db->password;
                }
        }

        public function run()
        {
                $this->init();
                $results=Yii::app()->db->createCommand("SHOW TABLES")->queryColumn();
                $tables="";
                foreach($results as $result)
                {
		       $tables.= "<option value=\"$result\" selected>$result</option>\n";
                }

                $viewFile=dirname(__FILE__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'dboption.php';
                $viewFile=Yii::app()->findLocalizedFile($viewFile,Yii::app()->language);
                return Yii::app()->controller->renderInternal($viewFile,array('tables'=>$tables,'backupPath'=>$this->backupPath),true);
        }

        public function dboption($whattodo,$tables)
        {
                $query = "";

                switch($whattodo)
                {
                        case "optimize": { $query = "OPTIMIZE TABLE  "; break; }
                        case "repair"  : { $query = "REPAIR TABLE "; break; }
                }
                if(!empty($query) and !empty($tables))
                {
                        $query.=implode(", ", $tables);
                }

                if(!empty($query))
                {
                        $results=Yii::app()->db->createCommand($query)->execute();
                }
        }
        public function backup()
        {
                $this->dumper('backup');
        }

        public function restore()
        {
                $this->dumper('restore');
        }

        /**
        * array parseDSN(mixed $dsn)
        * Parse a data source name.
        * See parse_url() for details.
        */
        protected function parseDSN($dsn)
        {
                if (is_array($dsn)) return $dsn;
                $parsed = @parse_url($dsn);
                if (!$parsed) return null;
                $params = null;
                if (!empty($parsed['query']))
                {
                        parse_str($parsed['query'], $params);
                        $parsed += $params;
                }
                $parsed['dsn'] = $dsn;

                $path=explode(";",$parsed['path']);
                $host=explode("=",$path[0]);
                $dbname=explode("=",$path[1]);
                $parsed['dbhost']=$host[1];
                $parsed['dbname']=$dbname[1];

                return $parsed;
        }

        protected function dumper($mode='backup')
        {
                $this->init();
                require dirname(__FILE__).DIRECTORY_SEPARATOR."dumper.php";
                $sk=new dumper();
                $sk->backupPath=$this->backupPath;
                $sk->dbprefix=$this->dbprefix;
                $sk->dbnames=$this->dbnames;
                $sk->dbhost=$this->dbhost;
                $sk->dbuser=$this->dbuser;
                $sk->dbpass=$this->dbpass;
                switch($mode)
                {
                        case 'backup' : { $sk->backup(); break; }
                        case 'restore': { $sk->restore(); break; }
                }
        }
        
}