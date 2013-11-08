<?php

class UserController extends Controller
{
	public function actions()
	{
 		return array(
   			//captcha action renders the CAPTCHA image displayed on the user registration page
   			'captcha'=>array(
     		'class'=>'CCaptchaAction',
 			//'buttonLabel'=>'refresh', 		 		
     		'backColor'=>0xFFFFFF,
   			),
 		);
	}
	
	public function actionRegister()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect('../dashboard/index');
		
        $model = new User;
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];

            $valid = $model->validate();
            if($valid)
            {
                $model->user_pass_hash = crypt($model->user_password, Randomness::blowfishSalt());
                $model->user_password = '';
                $model->user_verify_password = '';
                $model->user_conf_cd = crypt($model->user_email, Randomness::blowfishSalt());                

                if($model->save(false))
                {
                    $message = new YiiMailMessage;
                    $message->setBody('This is to confirm that your email is working correctly.  Please click the link below to activate your account:

http://www.rxscoring.com/index.php/user/confirmation?conf_cd=' . $model->user_conf_cd);
                    $message->subject = Yii::app()->name.' - Email Confirmation';
                    $message->addTo($model->user_email);
                    $message->from = "info@rxscoring.com";//Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);

                    $this->redirect(array('EmailSent'));
                }
            }
        }
		$this->redirect('/index.php?err=Y');
	}

    public function actionEmailSent()
    {
    	if(!Yii::app()->user->isGuest)
		  $this->redirect('../dashboard/index');
		  
        $this->render('userEmailSent');
    }

    public function actionConfirmation()
    {
    	if(!Yii::app()->user->isGuest)
		  $this->redirect('../dashboard/index');
		  
        $conf_cd = $_GET['conf_cd'];

        $model = new User;
        $user = $model->findByAttributes(array('user_conf_cd'=>$conf_cd));

        if(!empty($user) && $user->user_confirmed == 'N')
        {
            $user->user_confirmed = 'Y';            
            $message = "Email address " . $user->user_email . " has been confirmed. <br><br>Please login using your Email and Password.";
            $user->save(false);
        }
        else if(!empty($user) && $user->user_confirmed == 'Y')
        {
            $message = "Email address has already been confirmed.";
        }
        else
        {
            $message = "Email address confirmation code is invalid.";
        }
        $this->render('userRegistrationConfirmed',array('message'=>$message));
    }

    public function actionLogin()
    {
    	if(!Yii::app()->user->isGuest)
		  $this->redirect('../dashboard/index');
		  
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect('../dashboard/index');
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
    	$session=new CHttpSession;
  		$session->open();
  		$session->destroy();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}