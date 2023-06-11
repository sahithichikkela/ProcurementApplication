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
		$model= new User1;
		$users= $model->findByAttributes(['email'=>$this->email]);
		$this->password = crypt($this->password, Yii::app()->params['password_salt']);
	
		
		if( ($users!= null and $this->password==$users->password)){
			if( $users->status=='active' ){

			$this->errorCode=self::ERROR_NONE;
			return !$this->errorCode;
			}
		
		}
		
	}

	public function authenticateadmin()
	{
		$model= new User2;
		$users= $model->findByAttributes(['email'=>$this->email]);

		
		if($users!= null and $this->password==$users->password ){

			$this->errorCode=self::ERROR_NONE;
			return !$this->errorCode;
		
		}

	}
}