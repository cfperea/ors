<?php

/**
 * This is the model class for table "tbl_parameterInActivity".
 *
 * The followings are the available columns in table 'tbl_parameterInActivity':
 * @property integer $id
 * @property integer $parameter
 * @property integer $activityType
 *
 * The followings are the available model relations:
 * @property Parameter $parameter0
 * @property ActivityType $activityType0
 */
class ParameterInActivity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParameterInActivity the static model class
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
		return 'tbl_parameterInActivity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parameter, activityType', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parameter, activityType', 'safe', 'on'=>'search'),
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
			'parameter0' => array(self::BELONGS_TO, 'Parameter', 'parameter'),
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
			'parameter' => 'Parameter',
			'activityType' => 'Activity Type',
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
		$criteria->compare('parameter',$this->parameter);
		$criteria->compare('activityType',$this->activityType);

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

	/**
	* Retrieves all the parameters in a format consumable by the drop down box in the view: _form.php
	* @return HTML data list containing all the parameters
	*/
	public function getParameters()
	{
		$parameters = Parameter::model()->findAll();
		return Chtml::listData($parameters, 'id', 'name'); 
	}

}
