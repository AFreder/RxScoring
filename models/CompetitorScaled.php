<?php

/**
 * This is the model class for table "CompetitorScaled".
 *
 * The followings are the available columns in table 'CompetitorScaled':
 * @property integer $comp_id
 * @property string $comp_name
 * @property integer $comp_event1
 * @property string $comp_event2
 * @property string $comp_event3
 * @property string $comp_event4
 */
class CompetitorScaled extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompetitorScaled the static model class
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
		return 'CompetitorScaled';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_name', 'required'),
			array('comp_event1', 'numerical', 'integerOnly'=>true),
			array('comp_name', 'length', 'max'=>250),
			array('comp_event2, comp_event3, comp_event4', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comp_id, comp_name, comp_event1, comp_event2, comp_event3, comp_event4', 'safe', 'on'=>'search'),
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
			'comp_id' => 'Competitor ID',
			'comp_name' => 'Competitor Name',
			'comp_event1' => 'Event1 Result',
			'comp_event2' => 'Event2 Result',
			'comp_event3' => 'Event3 Result',
			'comp_event4' => 'Event4 Result',
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

		$criteria->compare('comp_id',$this->comp_id);
		$criteria->compare('comp_name',$this->comp_name,true);
		$criteria->compare('comp_event1',$this->comp_event1);
		$criteria->compare('comp_event2',$this->comp_event2,true);
		$criteria->compare('comp_event3',$this->comp_event3,true);
		$criteria->compare('comp_event4',$this->comp_event4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}