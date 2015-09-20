<?php
/**
 * Smarty view renderer
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @author Carsten Brandt <mail@cebe.cc>
 * @link http://code.google.com/p/yiiext/
 * @link http://www.smarty.net/
 *
 * @version 1.0.0
 */
class CSmartyViewRenderer extends CApplicationComponent implements IViewRenderer
{
	/**
	 * @var string the file-extension for viewFiles this renderer should handle
	 * for smarty templates this usually is .tpl
	 */
	public $fileExtension='.tpl';

	/**
	 * @var int dir permissions for smarty compiled templates directory
	 */
	public $directoryPermission=0771;

	/**
	 * @var int file permissions for smarty compiled template files
	 * NOTE: BEHAVIOR CHANGED AFTER VERSION 0.9.8
	 */
	public $filePermission=0644;

	/**
	 * @var null|string yii alias of the directory where your smarty plugins are located
	 * application.extensions.Smarty.plugins is always added
	 */
	public $pluginsDir = null;

	/**
	 * @var null|string yii alias of the directory where your smarty template-configs are located
	 */
	public $configDir = null;

	/**
	 * @var array smarty configuration values
	 * this array is used to configure smarty at initialization you can set all
	 * public properties of the Smarty class e.g. error_reporting
	 *
	 * please note:
	 * compile_dir will be created if it does not exist, default is <app-runtime-path>/smarty/compiled/
	 *
	 * @since 0.9.9
	 */
	public $config = array();

	/**
	 * @var Smarty smarty instance for rendering
	 */
	private $smarty = null;

	/**
	 * Component initialization
	 */
	public function init(){

		parent::init();

		// need this to avoid Smarty rely on spl autoload function,
		// this has to be done since we need the Yii autoload handler
		if (!defined('SMARTY_SPL_AUTOLOAD')) {
		    define('SMARTY_SPL_AUTOLOAD', 0);
		} elseif (SMARTY_SPL_AUTOLOAD !== 0) {
			throw new CException('CSmartyViewRenderer cannot work with SMARTY_SPL_AUTOLOAD enabled. Set SMARTY_SPL_AUTOLOAD to 0.');
		}

		// including Smarty class and registering autoload handler
		require_once('sysplugins/smarty_internal_data.php');
		require_once('SmartyBC.class.php');

		// need this since Yii autoload handler raises an error if class is not found
		// Yii autoloader needs to be the last in the autoload chain
		spl_autoload_unregister('smartyAutoload');
		Yii::registerAutoloader('smartyAutoload');

		$this->smarty = new SmartyBC();

		// configure smarty
		if (is_array($this->config)) {
			foreach ($this->config as $key => $value) {
				if ($key{0} != '_') { // not setting semi-private properties
					$this->smarty->$key = $value;
				}
			}
		}
		$this->smarty->_file_perms = $this->filePermission;
		$this->smarty->_dir_perms = $this->directoryPermission;
		
        $this->smarty->template_dir = isset($this->config['template_dir']) ?
                                      $this->config['template_dir'] : Yii::app()->getViewPath();
		
        $compileDir = isset($this->config['compile_dir']) ?
					  $this->config['compile_dir'] : Config :: $smartyCompiledPath;

		// create compiled directory if not exists
		if(!file_exists($compileDir)){
			mkdir($compileDir, $this->directoryPermission, true);
		}
		$this->smarty->compile_dir = $compileDir; // no check for trailing /, smarty does this for us

		$this->smarty->plugins_dir = Yii::getPathOfAlias('ext.smarty.plugins');
		if(!empty($this->pluginsDir)){
			$this->smarty->plugins_dir = Yii::getPathOfAlias($this->pluginsDir);
		}

		if(!empty($this->configDir)){
			$this->smarty->config_dir = Yii::getPathOfAlias($this->configDir);
		}
        $this->smarty->addConfigDir(Config::$basePath."/static/rongui/config");
	}

	/**
	 * Renders a view file.
	 * This method is required by {@link IViewRenderer}.
	 * @param CBaseController the controller or widget who is rendering the view file.
	 * @param string the view file path
	 * @param mixed the data to be passed to the view
	 * @param boolean whether the rendering result should be returned
	 * @return mixed the rendering result, or null if the rendering result is not needed.
	 */
	public function renderFile($context,$sourceFile,$data,$return) {
		// current controller properties will be accessible as {$this.property}
		$data['this'] = $context;
		// Yii::app()->... is available as {Yii->...} (deprecated, use {Yii::app()->...} instead, Smarty3 supports this.)
		$data['Yii'] = Yii::app();
		// time and memory information
		$data['TIME'] = sprintf('%0.5f',Yii::getLogger()->getExecutionTime());
		$data['MEMORY'] = round(Yii::getLogger()->getMemoryUsage()/(1024*1024),2).' MB';

        if (class_exists('Config'))
        {
            $arrConfig = array();
            foreach (get_class_vars('Config') as $configKey => $configValue)
            {
                $arrConfig[$configKey] = $configValue;
            }
            $data['Config'] = $arrConfig;
        }

		$tplFile = '';
        if (class_exists('Config') && Config :: $partner)
        {
            $tplFile = $this->smarty->getTemplateDir(0) . Config :: $partner . '/' . $sourceFile;
        }
        if (!is_file($tplFile) || ($file=realpath($tplFile))===false)
        {
            $tplFile = $this->smarty->getTemplateDir(0) . $sourceFile;
        }
		
        // check if view file exists
		if(!is_file($tplFile) || ($file=realpath($tplFile))===false)
			throw new CException(Yii::t('yiiext','View file "{file}" does not exist.', array('{file}'=>$tplFile)));

        $data['ra_tpl'] = substr($tplFile, strpos($tplFile, 'main/view/')+10);
        
        list($usec, $sec) = explode(" ", microtime());
        if (!Yii :: app()->request->getQuery('uf') || Yii :: app()->controller->id == 'search' || (Yii :: app()->controller->id == 'site' && Yii :: app()->controller->action->id == 'index') || (Yii :: app()->controller == "fangdai" && Yii :: app()->controller->action->id == 'search'))
        {
            if (Yii :: app()->controller->id == 'search' || (Yii :: app()->controller->id == 'fangdai' && Yii :: app()->controller->action->id == 'search'))
            {
                $uf = 's_' . md5($_COOKIE['RONGID'] . ((float)$usec + (float)$sec));
            }
            elseif (Yii :: app()->controller->id == 'site' && Yii :: app()->controller->action->id == 'index')
            {
                $uf = 'i_' . md5($_COOKIE['RONGID'] . ((float)$usec + (float)$sec));
            }
            else
            {
                $uf = 'o_' . md5($_COOKIE['RONGID'] . ((float)$usec + (float)$sec));
            }
        }
        else
        {
            $uf = Yii :: app()->request->getQuery('uf');
        }

        $data['ra_rid'] = $_COOKIE['RONGID'];
        $data['ra_pid'] = md5('pid' . $_COOKIE['RONGID'] . ((float)$usec + (float)$sec));
        $data['ra_uf'] = urlencode($uf);
        $data['pass_url'] = 'fpid=' . $data['ra_pid'] . '&uf=' . $uf;
        $data['ra_access_id'] = session_id();

		$template = $this->smarty->createTemplate($tplFile, null, null, $data, false);

		//render or return
		if($return)
			return $template->fetch($tplFile);
		else
			$template->display($tplFile);
	}
}
