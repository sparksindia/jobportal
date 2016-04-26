<?php

class Application_Model_User
{
	
	const NOT_FOUND = 1;
	const WRNG_PASS = 2;

	public static function authenticate($username, $password)
	{
		$userTbl = new Application_Model_DbTable_User();
		
		$roleTbl = new Application_Model_DbTable_Role();
		
		$userRes = $userTbl->fetchRow($userTbl->select()->where('user_name = "'.$username.'"'));

		//username matched
		if(count($userRes) == 1) {
			$userArr = $userRes->toArray();

			$roleArr = $roleTbl->fetchRow($roleTbl->select()->where('role_id = '.$userArr['role']))->toArray();

			$userArr['role_id'] = $userArr['role'];
			$userArr['role'] = $roleArr['role_name'];
			
			//password matched
			if($password === $userArr['password']) {
				return $userArr;
			}
			throw new Exception(self::WRNG_PASS);
		}
		throw new Exception(self::NOT_FOUND);
	}

}

