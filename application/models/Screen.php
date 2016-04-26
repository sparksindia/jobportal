<?php

class Application_Model_Screen
{

	/**
	 * get screen name by screen_id
	 *
	 * @param int $screenId
	 * @return string $screenName
	 **/
	public static function getScreenName($screenId)
	{
		$screenTbl = new Application_Model_DbTable_Screen();
		
		$screenName = $screenTbl->fetchRow($screenTbl->select()->where('screen_id = '.$screenId))->toArray()['screen_name'];
		
		return $screenName;
	}

}

