<?php
Yii::import('application.models.Activity');
class ActivityTest extends CDbTestCase
{
	public $fixtures = array(
		"activities" => "Activity"
	);

	public function testRead()
	{
		// Read back the newly created activity
		$retrievedActivity = $this->activities('activity1');
		$this->assertTrue($retrievedActivity instanceOf Activity);
		$this->assertEquals('Test activity 1', $retrievedActivity->name);
	}

	public function testCreate()
	{
		// Create a new activity
		$newActivity = new Activity;
		$newActivityName = 'Test activity creation';
		$newActivity->setAttributes(
			array(
				'name' => $newActivityName,
				'creationDate' => '2013-03-10 00:00:00',
				'startDate' => '2013-03-10 00:00:00',
				'endDate' => '2013-03-10 00:00:00',
				'budget' => '99999999',
			)
		);
		$this->assertTrue($newActivity->save(false));
		
		// Read back the record again to ensure the updated worked
		$retrievedActivity = Activity::model()->findByPk($newActivity->id);
		$this->assertTrue($retrievedActivity instanceOf Activity);
		$this->assertEquals($retrievedActivity->name, $newActivityName);

	}

	public function testUpdate()
	{
		$activity = $this->activities("activity2");
		$updatedActivityName = "Updated test activity 2";
		$activity->name = $updatedActivityName;
		$this->assertTrue($activity->save(false));
	
		// Read back the record again to ensure the updated worked
		$retrievedActivity = Activity::model()->findByPk($activity->id);
		$this->assertTrue($retrievedActivity instanceOf Activity);
		$this->assertEquals($retrievedActivity->name, $updatedActivityName);
	}

}
