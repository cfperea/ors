<?php

/**
 * This is the model class for table "tbl_parameterOption".
 *
 * The followings are the available columns in table 'tbl_parameterOption':
 * @property integer $id
 * @property integer $parameter
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Parameter $parameter0
 */
class ParameterOption extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParameterOption the static model class
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
		return 'tbl_parameterOption';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value', 'required'),
			array('parameter', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parameter, value', 'safe', 'on'=>'search'),
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
			'value' => 'Value',
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
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
