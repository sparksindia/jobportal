<?php

class Application_Model_Permission
{

	public static function getRolePermission($roleId)
	{
		$permissionTbl = new Application_Model_DbTable_Permission();
		
		$permissionArr = $permissionTbl->fetchAll($permissionTbl->select()->where('role_id = '.$roleId))->toArray();
		
		return $permissionArr;
	}

}

