<?php

class Application_Model_RoleMenu
{

	/**
	 * get role menu name by role_id
	 *
	 * @param int $roleId
	 * @return array $roleMenuArr
	 **/
	public static function getRoleMenuByRole($roleId)
	{
		$roleMenuTbl = new Application_Model_DbTable_RoleMenu();
		
		
		
		$roleMenuArr = $roleMenuTbl->fetchAll($roleMenuTbl->select()->where('role_id = '.$roleId))->toArray();
		
		$menuArr[] = Application_Model_RoleMenu::getHomeMenu();
		
		foreach($roleMenuArr as $roleMenu) {
			$tMenuArr = array();
			$tMenuArr['menu_name'] = $roleMenu['menu_name'];
			$tMenuArr['url'] = Application_Model_Module::getModuleName($roleMenu['module_id']).'/'.Application_Model_Screen::getScreenName($roleMenu['screen_id']).'/'.Application_Model_Activity::getActivityName($roleMenu['activity_id']);
			$menuArr[] = $tMenuArr;
		}
		
		$menuArr[] = Application_Model_RoleMenu::getLoginMenu();
		
		$menuNameSpace = new Zend_Session_Namespace('menu');
			
		$menuNameSpace->menuArr = $menuArr;
		
		return $menuArr;
	}
	
	/**
	 * get home menu
	 *
	 * @return array
	 **/
	public static function getHomeMenu()
	{
		$homeArr = array('menu_name' => 'Home', 'url' => 'default/index/index');
		
		return $homeArr;
	}
	
	/**
	 * get login/logout menu
	 *
	 * @return array
	 **/
	public static function getLoginMenu()
	{
		if(Zend_Auth::getInstance()->hasIdentity())
			$loginArr = array('menu_name' => 'Logout', 'url' => 'default/auth/logout');
		else
			$loginArr = array('menu_name' => 'Login', 'url' => 'default/auth/login');
		
		return $loginArr;
	}

}

