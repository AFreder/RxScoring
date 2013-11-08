<?php

/**
 * This is the model class for table "Event".
 *
 * The followings are the available columns in table 'Event':
 * @property integer $evnt_id
 * @property integer $reg_id
 * @property string $evnt_name
 * @property string $evnt_type
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
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
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reg_id, evnt_name, evnt_type', 'required'),
			array('reg_id, evnt_order', 'numerical', 'integerOnly'=>true),
			array('evnt_type', 'length', 'max'=>250),
			array('evnt_desc', 'length', 'max'=>1500),
			array('evnt_name', 'length', 'max'=>15),
			array('evnt_measure', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evnt_id, reg_id, evnt_name, evnt_type', 'safe', 'on'=>'search'),
			array('reg_id+evnt_name', 'application.extensions.uniqueMultiColumnValidator'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evnt_id' => 'Event ID',
			'reg_id' => 'Registration ID',
			'evnt_name' => 'Event Name',
			'evnt_type' => 'Event Type',
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

		$criteria->compare('evnt_id',$this->evnt_id);
		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('evnt_name',$this->evnt_name,true);
		$criteria->compare('evnt_type',$this->evnt_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}