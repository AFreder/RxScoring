<?php
class LeaderboardController extends Controller
{
	public function filters()
	{
	    return array(
        	array(
	            'COutputCache',
            	'duration'=>100,            	
        	),
    	);
	}

	public function actionIndex($id)
	{
		$registration = Registration::model()->findByPk($id);		
		$event = Event::model()->findAllByAttributes(array('reg_id'=>$id), array('order'=>'evnt_order ASC'));
		$division = Division::model()->findAllByAttributes(array('reg_id'=>$id));
		
		$this->render('index', array('event'=>$event
										, 'division'=>$division
										, 'registration'=>$registration
									));
		
		
	}
}	