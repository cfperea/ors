<?php

/**
 * This is the model class for table "tbl_activity".
 *
 * The followings are the available columns in table 'tbl_activity':
 * @property integer $id
 * @property string $name
 * @property string $creationDate
 * @property string $startDate
 * @property string $endDate
 * @property integer $leader
 * @property integer $activityType
 * @property double $budget
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User $leader0
 * @property ActivityType $activityType0
 */
class Activity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, creationDate, startDate, endDate', 'required'),
			array('leader, activityType', 'numerical', 'integerOnly'=>true),
			array('budget', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, creationDate, startDate, endDate, leader, activityType, budget, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'leader0' => array(self::BELONGS_TO, 'User', 'leader'),
			'activityType0' => array(self::BELONGS_TO, 'ActivityType', 'activityType'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('app','model.activity.name'),
			'creationDate' => Yii::t('app','model.activity.creationDate'),
			'startDate' => Yii::t('app','model.activity.startDate'),
			'endDate' => Yii::t('app','model.activity.endDate'),
			'leader' => Yii::t('app','model.activity.leader'),
			'activityType' => Yii::t('app','model.activity.activityType'),
			'budget' => Yii::t('app','model.activity.budget'),
			'description' => Yii::t('app','model.activity.description'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('startDate',$this->startDate,true);
		$criteria->compare('endDate',$this->endDate,true);
		$criteria->compare('leader',$this->leader);
		$criteria->compare('activityType',$this->activityType);
		$criteria->compare('budget',$this->budget);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Retrieves all the activity types in a format consumable by the drop down box in the view: _form.php
	* @return HTML data list containing all the activity types
	*/
	public function getActivityTypes()
	{
		$activityTypes = ActivityType::model()->findAll();
		return Chtml::listData($activityTypes, 'id', 'name'); 
	}

	public function getActivityTypeText()
	{
		$activityType = ActivityType::model()->findByPk($this->activityType);
		return $activityType->name;
	}
	
	/**
	* Checks whether a user is within a specified role
	*/
	public function isUserInRole($role)
	{
		$sql = "SELECT role FROM tbl_activity_user_role WHERE activity_id = :activityId AND user_id = :userId AND role = :role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activityId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":userId", Yii::app()->user->getId(), PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute() == 1 ? true : false;
	}

	/**
	* Associates a user to a specific role within an activity
	*/
	public function associateUserToRole($role, $userId)
	{
		$sql = "INSERT INTO tbl_activity_user_role (activity_id, user_id, role) VALUES (:activityId, :userId, :role)";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activityId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":userId", $userId, PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute();
	}

	/**
	* Removes a user from a specific role within an activity
	*/
	public function removeUserToRole($role, $userId)
	{
		$sql = "DELETE FROM tbl_activity_user_role WHERE activity_id = :activityId AND user_id = :userId AND role = :role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activityId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":userId", $userId, PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute();
	}

	/**
	* Returns an array of available roles in which a user can be placed when being added to an activity
	*/
	public static function getUserRoleOptions()
	{
		return CHtml::listData(Yii::app()->authManager->getRoles(), "name", "name");
	}
	
	/**
	* Associate a user to an activity
	*/
	public function associateUserToActivity($userId)
	{
		$sql = "INSERT INTO tbl_activity_user (activity_id, user_id) VALUES (:activityId, :userId)";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activityId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":userId", $userId, PDO::PARAM_INT);
		return $command->execute();
	}

	/**
	* Checks whether a user is in an activity
	*/
	public function isUserInActivity($userId)
	{
		$sql = "SELECT user_id FROM tbl_activity_user WHERE activity_id = :activityId AND user_id = :userId";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":activityId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":userId", $userId, PDO::PARAM_INT);
		return $command->execute() == 1 ? true : false;
	}

}
