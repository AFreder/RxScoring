<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	

	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect('index.php/dashboard/index');
		 $model = new User;
		 $err='N';
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

                    $this->redirect(array('/user/EmailSent'));
                }

            }
            else
            	$err='Y';
        }
		$this->render('index', array('model'=>$model, 'err'=>$err));
	}

	public function actionError()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
}