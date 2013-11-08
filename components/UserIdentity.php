<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users = User::model()->findByAttributes(array('user_email'=>$this->username, 'user_confirmed'=>'Y'));
        if(isset($users->user_pass_hash))
            $user_password = crypt($this->password, $users->user_pass_hash);
		if(!isset($users->user_email))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user_password !== $users->user_pass_hash)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->errorCode=self::ERROR_NONE;
			$session=new CHttpSession;
			$session->open();
			$session['user_id'] = $users->user_id;
		}
		return !$this->errorCode;
	}
}