<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $user_id
 * @property integer $reg_id
 * @property string $user_email
 * @property string $user_password
 * @property string $aud_load_ts
 * @property string $dacl_actv_in
 * @property string $user_class
 * @property string $user_verify_password
 *
 * The followings are the available model relations:
 * @property Registration $reg
 */
class User extends CActiveRecord
{	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public $verifyCode;
	
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'caseSensitive'=>false),
			array('user_email, verifyCode, user_password, user_verify_password', 'required'),
			array('user_id, reg_id', 'numerical', 'integerOnly'=>true),
			array('user_email, user_password, user_verify_password', 'length', 'max'=>250),
			array('dacl_actv_in', 'length', 'max'=>1),
			array('user_class', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, reg_id, user_email, user_password, aud_load_ts, dacl_actv_in, user_class, user_verify_password', 'safe', 'on'=>'search'),

            array('user_email', 'unique', 'message' => "This email address has already been registered."),
            array('user_password','compare', 'compareAttribute'=>'user_verify_password', 'message'=>'Passwords do not match.'),
            array('user_email','email'),
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
			'reg' => array(self::BELONGS_TO, 'Registration', 'reg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'user_id',
			'reg_id' => 'reg_id',
			'user_email' => 'Email Address',
			'user_password' => 'Password',
			'aud_load_ts' => 'aud_load_ts',
			'dacl_actv_in' => 'dacl_actv_in',
			'user_class' => 'user_class',
			'user_verify_password' => 'Confirm Password',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('reg_id',$this->reg_id);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('aud_load_ts',$this->aud_load_ts,true);
		$criteria->compare('dacl_actv_in',$this->dacl_actv_in,true);
		$criteria->compare('user_class',$this->user_class,true);
		$criteria->compare('user_verify_password',$this->user_verify_password,true);
        $criteria->compare('user_pass_hash',$this->user_pass_hash,true);
        $criteria->compare('user_pass_hash',$this->user_conf_cd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}