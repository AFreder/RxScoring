<?php

/**
 * This is the model class for table "Competitor".
 *
 * The followings are the available columns in table 'Competitor':
 * @property integer $comp_id
 * @property integer $reg_id
 * @property integer $div_id
 * @property integer $comp_name
 */
class Competitor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Competitor the static model class
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
		return 'competitor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reg_id, div_id, comp_name', 'required'),
			array('reg_id, div_id, comp_bib', 'numerical', 'integerOnly'=>true),
			array('comp_name', 'length', 'max'=>250),
			array('comp_status', 'length', 'max'=>10),
			array('comp_bib', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comp_id, reg_id, div_id, comp_name', 'safe', 'on'=>'search'),
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
			'reg_id' => 'Registration ID',
			'div_id' => 'Division',
			'comp_name' => 'Competitor Name',
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
		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('div_id',$this->div_id);
		$criteria->compare('comp_name',$this->comp_name);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}