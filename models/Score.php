<?php

/**
 * This is the model class for table "Score".
 *
 * The followings are the available columns in table 'Score':
 * @property integer $scre_id
 * @property integer $reg_id
 * @property integer $evnt_id
 * @property integer $comp_id
 * @property string $scre_task_prty
 * @property string $scre_time_prty
 * @property string $scre_other
 */
class Score extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Score the static model class
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
		return 'score';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reg_id, evnt_id, comp_id', 'required'),
			array('reg_id, evnt_id, comp_id', 'numerical', 'integerOnly'=>true),
			array('scre_time_prty', 'length', 'max'=>20),
			array('scre_other, scre_status', 'length', 'max'=>12),
			array('scre_task_prty', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('scre_id, reg_id, evnt_id, comp_id, scre_task_prty, scre_time_prty, scre_other', 'safe', 'on'=>'search'),
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
			'scre_id' => 'Score ID',
			'reg_id' => 'Registration ID',
			'evnt_id' => 'Event ID',
			'comp_id' => 'Competitor ID',
			'scre_task_prty' => 'Task Priority Score',
			'scre_time_prty' => 'Time Priority Score',
			'scre_other' => 'Score',
			'scre_status' => 'Score Status',
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

		$criteria->compare('scre_id',$this->scre_id);
		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('evnt_id',$this->evnt_id);
		$criteria->compare('comp_id',$this->comp_id);
		$criteria->compare('scre_task_prty',$this->scre_task_prty,true);
		$criteria->compare('scre_time_prty',$this->scre_time_prty,true);
		$criteria->compare('scre_other',$this->scre_other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}