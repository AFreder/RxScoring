<?php

/**
 * This is the model class for table "registration".
 *
 * The followings are the available columns in table 'registration':
 * @property integer $reg_id
 * @property string $reg_evt_nm
 * @property string $reg_evt_bgn_dt
 * @property string $reg_evt_end_dt
 * @property string $reg_evt_loc_addr
 * @property string $reg_evt_loc_addr2
 * @property string $aud_load_ts
 * @property string $dacl_actv_in
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Registration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registration the static model class
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
		return 'registration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reg_evt_nm, reg_evt_bgn_dt, reg_evt_end_dt, reg_scre_type', 'required'),
			array('reg_evt_nm, reg_evt_loc_addr, reg_evt_loc_addr2', 'length', 'max'=>250),
			array('dacl_actv_in', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reg_id, reg_evt_nm, reg_evt_bgn_dt, reg_evt_end_dt, reg_evt_loc_addr, reg_evt_loc_addr2, aud_load_ts, dacl_actv_in', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'reg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'reg_id' => 'Registration ID',
            'reg_evt_nm' => 'Event Name',
		 	'reg_scre_type' => 'Leaderboard Scoring Style',
            'reg_evt_bgn_dt' => 'Begin Date of Event',
            'reg_evt_end_dt' => 'End Date of Event',
            'reg_evt_loc_addr' => 'Address',
            'reg_evt_loc_addr2' => 'Address 2',
            'aud_load_ts' => 'aud_load_ts',
            'dacl_actv_in' => 'dacl_actv_in',
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

		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('reg_evt_nm',$this->reg_evt_nm,true);
		$criteria->compare('reg_evt_bgn_dt',$this->reg_evt_bgn_dt,true);
		$criteria->compare('reg_evt_end_dt',$this->reg_evt_end_dt,true);
		$criteria->compare('reg_evt_loc_addr',$this->reg_evt_loc_addr,true);
		$criteria->compare('reg_evt_loc_addr2',$this->reg_evt_loc_addr2,true);
		$criteria->compare('aud_load_ts',$this->aud_load_ts,true);
		$criteria->compare('dacl_actv_in',$this->dacl_actv_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}