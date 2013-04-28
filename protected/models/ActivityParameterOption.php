<?php

/**
 * This is the model class for table "tbl_activityParameterOption".
 *
 * The followings are the available columns in table 'tbl_activityParameterOption':
 * @property integer $id
 * @property integer $activity
 * @property integer $parameterOption
 *
 * The followings are the available model relations:
 * @property Activity $activity0
 * @property ParameterOption $parameterOption0
 */
class ActivityParameterOption extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActivityParameterOption the static model class
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
		return 'tbl_activityParameterOption';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activity, parameterOption', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, activity, parameterOption', 'safe', 'on'=>'search'),
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
			'activity0' => array(self::BELONGS_TO, 'Activity', 'activity'),
			'parameterOption0' => array(self::BELONGS_TO, 'ParameterOption', 'parameterOption'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'activity' => 'Activity',
			'parameterOption' => 'Parameter Option',
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
		$criteria->compare('activity',$this->activity);
		$criteria->compare('parameterOption',$this->parameterOption);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}