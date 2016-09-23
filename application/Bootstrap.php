<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$layout = Zend_Layout::getMvcInstance();

		$view = $layout->getView();
	}

	protected function _initAutoload()
	{
		$loader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '',
			'basePath'  => APPLICATION_PATH));

		return $loader;
	}

	protected function _initSession()
	{
		/*$session = new Zend_Session_Namespace('project', true);

		return $session;*/
	}

	protected function _initDB()
	{
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		$db_params = $config->resources->db->params;
		
		$params = array(
    'host'           => $db_params->host,
    'username'       => $db_params->username,
    'password'       => $db_params->password,
    'dbname'         => $db_params->dbname,
    
);

$db = Zend_Db::factory($config->resources->db->adapter, $params);
		Zend_Db_Table::setDefaultAdapter($db);
	}


	protected function _initRegisterPlugins()
	{
		$front = Zend_Controller_Front::getInstance();
        //$front->registerPlugin(new application_plugins_session());
	}
}