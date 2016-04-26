<?php

class Application_Model_Activity
{

	/**
	 * get activity name by activity_id
	 *
	 * @param int $activityId
	 * @return string $activityName
	 **/
	public static function getActivityName($activityId)
	{
		$activityTbl = new Application_Model_DbTable_Activity();
		
		$activityName = $activityTbl->fetchRow($activityTbl->select()->where('activity_id = '.$activityId))->toArray()['activity_name'];
		
		return $activityName;
	}

}

