<?php

use Doctrine\Common\ClassLoader;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	//init HTML Doctype
	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}
	
	//init Application Autoload
	protected function _initAppAutoload()
	{
		$moduleLoad = new Zend_Application_Module_Autoloader(
			array(
				'namespace' => '',
				'basePath' => APPLICATION_PATH
			)
		);
		
		$front = Zend_Controller_Front::getInstance();
		
		$front->addModuleDirectory(APPLICATION_PATH."/modules");
	}
	
	protected function _initACL()
	{
		try{
		$front = Zend_Controller_Front::getInstance();
		$auth = Zend_Auth::getInstance();
		
		$sparksAcl = new Sparks_ACL();
		
		$acl = $sparksAcl->getAcl($auth);
		//echo "<pre>";print_r($acl);die;
		$front->registerPlugin(new Sparks_Controller_Plugin_ACL($auth, $acl));
		
		}catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	protected function _initLayout()
	{
		Zend_Layout::startMvc(array('layoutPath' => APPLICATION_PATH.'/layouts/scripts', 'layout' => 'layout'));
		
		$layoutModulePlugin = new Sparks_Controller_Plugin_LayoutPlugin();
		$layoutModulePlugin->registerModuleLayout('default', APPLICATION_PATH.'/modules/default/layouts/scripts', 'default');
		$layoutModulePlugin->registerModuleLayout('admin', APPLICATION_PATH.'/modules/admin/layouts/scripts', 'admin');
		$layoutModulePlugin->registerModuleLayout('employeer', APPLICATION_PATH.'/modules/employeer/layouts/scripts', 'employeer');
		$layoutModulePlugin->registerModuleLayout('specialist', APPLICATION_PATH.'/modules/specialist/layouts/scripts', 'specialist');
		
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin($layoutModulePlugin);
	}

	protected function _initDB()
	{
		$resources = $this->getOption('resources');
		
		$db = Zend_Db::factory($resources['db']['adapter'], $resources['db']['params']);
		
		Zend_Db_Table::setDefaultAdapter($db);
	}
	
	protected function _initPlugins()
	{
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->registerPlugin(new Sparks_Plugins_TrackPage());
	}

	protected function _initExceptions()
	{
		try {
			//throw new Sparks_Exception_PageNotFound();
		}catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	protected function _initDoctrine()
	{
		/*require '../library/Doctrine/Common/ClassLoader.php';

		$classLoader = new ClassLoader('Doctrine\DBAL', realpath(APPLICATION_PATH . '/../library/Doctrine/DBAL'));
		$classLoader->register();
		
		//doctrine configuration
		$config = new Doctrine\DBAL\Configuration();
		
		//connection parameters
		$connectionParams = array(
			'dbname' => 'sparks_jobportal',
			'user' => 'root',
			'password' => '',
			'host' => 'localhost',
			'driver' => 'pdo_mysql'
		);
		
		//driver manager
		$conn = Doctrine\DBAL\DriverManager::getConnection($connectionParams);
		
		//fetch records
		$users = $conn->fetchAll('SELECT * FROM users');
		
		//schema manager
		$sm = $conn->getSchemaManager();
		
		//list databases
		$dbList = $sm->listDatabases();
		
		$tableList = $sm->listTables();
		
		foreach($tableList as $table) {
			//$columns = $sm->listTableColumns($table);
			$columns = $table->getColumns();
			
			foreach($columns as $column) {
				//echo "<pre>";print_r($column);
			}
		}
		
		//DDL Statements
		$columns = array(
			new Doctrine\DBAL\Schema\Column('id', Doctrine\DBAL\Types\Type::getType('integer'), array(
					'autoincrement' => true,
					'primary' => true,
					'notnull' => true
				)
			),
			new Doctrine\DBAL\Schema\Column('test', Doctrine\DBAL\Types\Type::getType('string'), array(
					'length' => 255
				)
			)
		);
		
		$options = array();
		
		$scemaTable = new Doctrine\DBAL\Schema\Table('new_table', $columns);
		$scemaTable->setPrimaryKey(array('id'), true);

		//$sm->createTable($scemaTable, $columns, $options);*/
		
		
		
		
	}

}

