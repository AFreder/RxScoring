<?php

/**
 * This is the model class for table "Division".
 *
 * The followings are the available columns in table 'Division':
 * @property integer $div_id
 * @property integer $reg_id
 * @property string $div_name
 */
class Division extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Division the static model class
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
		return 'division';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reg_id, div_name', 'required'),
			array('reg_id', 'numerical', 'integerOnly'=>true),
			array('div_name', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('div_id, reg_id, div_name', 'safe', 'on'=>'search'),
			array('reg_id+div_name', 'application.extensions.uniqueMultiColumnValidator'),
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
			'div_id' => 'Division ID',
			'reg_id' => 'Registration ID',
			'div_name' => 'Division Name',
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

		$criteria->compare('div_id',$this->div_id);
		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('div_name',$this->div_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 	public function getDivisions($id)
	{ 
             //this function returns the list of divisions to use in a dropdown        
              return CHtml::listData(Division::model()->findAllByAttributes(array('reg_id'=>$id), 'div_id', 'div_name'));
    }
}