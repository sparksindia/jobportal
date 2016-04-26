<?php

class Application_Model_Module
{

	/**
	 * Get Module array by module_id
	 *
	 * @param int $moduleId
	 * @return array
	 **/
	public static function getModuleByModuleId($moduleId)
	{
		$moduleTbl = new Application_Model_DbTable_Module();
		$moduleArr = $moduleTbl->fetchRow($moduleTbl->select()->where('module_id = '.$moduleId))->toArray();
		
		return $moduleArr;
	}
	
	/**
	 * Get Module name by module_id
	 *
	 * @param int $moduleId
	 * @return string $moduleName
	 **/
	public static function getModuleName($moduleId)
	{
		$moduleTbl = new Application_Model_DbTable_Module();
		$moduleName = $moduleTbl->fetchRow($moduleTbl->select()->where('module_id = '.$moduleId))->toArray()['module_name'];
		
		return $moduleName;
	}

}

