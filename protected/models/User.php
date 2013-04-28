<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property integer $isAdmin
 * @property string $email
 * @property integer $faculty
 * @property string $createTime
 * @property string $lastLogin
 * @property string $updateTime
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Faculty $faculty0
 */
class User extends CActiveRecord
{

	public $password_repeat;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, password, isAdmin, email, createTime', 'required'),
			array('name, password, isAdmin, email', 'required'),
			array('isAdmin, faculty', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>128),
			array('name, email', 'unique'),
			array('password', 'length', 'max'=>32),
			array('password', 'compare'),
			//array('lastLogin, updateTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, password, isAdmin, email, faculty, createTime, lastLogin, updateTime', 'safe', 'on'=>'search'),
			array('password_repeat', 'safe'),
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
			'activities' => array(self::HAS_MANY, 'Activity', 'leader'),
			'faculty0' => array(self::BELONGS_TO, 'Faculty', 'faculty'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'isAdmin' => 'Is Admin',
			'email' => 'Email',
			'faculty' => 'Faculty',
			'createTime' => 'Create Time',
			'lastLogin' => 'Last Login',
			'updateTime' => 'Update Time',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('isAdmin',$this->isAdmin);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('faculty',$this->faculty);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('lastLogin',$this->lastLogin,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* Retrieves all the activity types in a format consumable by the drop down box in the view: _form.php
	* @return HTML data list containing all the activity types
	*/
	public function getFaculties()
	{
		$activityTypes = Faculty::model()->findAll();
		return Chtml::listData($activityTypes, 'id', 'name'); 
	}
	
	/**
	* Prepares the createTime and updateTime before validation
	*/
	protected function beforeValidate()
	{
		if ($this->isNewRecord)
		{
			$this->createTime = $this->updateTime = new CDbExpression('NOW()');
		}
		else
		{
			$this->updateTime = new CDbExpression('NOW()');
		}
		return parent::beforeValidate();
	}

	/**
	* Performs a one-way encryption on the password before storing it in the database
	*/
	protected function afterValidate()
	{
		parent::afterValidate();
		$this->password = $this->encrypt($this->password);
	}

	/**
	* Encrypt the given value and return it to the caller
	*/
	public function encrypt($value)
	{
		return md5($value);
	}

	/** 
	* Used by the messaging system
	*/
	public function getFullName() {
    	return $this->name;
	}
	
	/** 
	* Used by the messaging system
	*/
	public function getSuggest($q) {
		$c = new CDbCriteria();
		$c->addSearchCondition('name', $q, true, 'OR');
		$c->addSearchCondition('email', $q, true, 'OR');
		return $this->findAll($c);
	}

}
