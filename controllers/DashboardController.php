<?php
class DashboardController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');
		$session=new CHttpSession;
		$session->open();
		$this->render('index', array('session'=>$session));
	}
	
	public function actionRegisterEvent()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');
		$session=new CHttpSession;
		$session->open();
		$model = new Registration;
		
		if(isset($_POST['Registration']))
		{
			$model->attributes=$_POST['Registration'];
			$valid = $model->validate();
			if($valid)
			{
				$model->user_id = $session['user_id'];
				$model->save(false);				
				$this->render('index', array('session'=>$session));
			}
			else 
				$this->render('registerEvent', array('model'=>$model));
							
		}
		else
			$this->render('registerEvent', array('model'=>$model));
	}
	public function actionUpdateRegistration()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');
		
		$model = Registration::model()->findByPk($_GET['id']);		
		
		if(isset($_POST['Registration']))
		{			
			$model->attributes=$_POST['Registration'];
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{
				$model->save(false);				
				$this->redirect('/index.php');				
			}
			
		}			
		$this->render('updateRegistration', array('model'=>$model));
	}
	
	public function actionScoringType()
	{
		if(isset($_GET['id']))
		{
			if($_GET['type'] == 'GAMES')
				$type = 'REGIONALS';
			else				
				$type = 'GAMES';				
			$registration = Registration::model()->findByPk($_GET['id']);
			$registration->reg_scre_type = $type;
			$registration->save(false);	
		}		
		$this->redirect('index');
	}
	public function actionManageDivisions()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');		 
		if(isset($_GET['id']))
			$reg_id = $_GET['id'];
		
		$model = new Division;				
		if(isset($_POST['Division']))
		{						
			$model->attributes=$_POST['Division'];
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{
				$event = Event::model()->findAllByAttributes(array('reg_id'=>$reg_id));
				$model->save(false);
				foreach($event as $evnt)
				{
					$ec = new EventComplete;
					$ec->evnt_id = $evnt->evnt_id;
					$ec->div_id = $model->div_id;
					$ec->save(false);
				}				
			}
		}					
		$division = Division::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'div_name'));
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$reg_id));
		$this->render('manageDivisions', array('division'=>$division, 'registration'=>$registration, 'model'=>$model));		
	}
	
	public function actionManageEvents()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('/index.php');		 
		if(isset($_GET['id']))
			$reg_id = $_GET['id'];
		
		$model = new Event;				
		if(isset($_POST['Event']))
		{				
			$model->attributes=$_POST['Event'];
			$count = Event::model()->count('reg_id = :reg_id', array('reg_id'=>$model->reg_id));
			if($model->evnt_type == 'Task Priority (For Time)')
				$model->evnt_typ_cd = 1;
			else if($model->evnt_type == 'Time Priority (For Repititions)')
				$model->evnt_typ_cd = 2;
			else
				$model->evnt_typ_cd = 3;
			$model->evnt_order = $count+1;
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{				
				$model->save(false);
				$division = Division::model()->findAllByAttributes(array('reg_id'=>$model->reg_id));
				foreach($division as $div)
				{
					$ec = new EventComplete;
					$ec->evnt_id = $model->evnt_id;
					$ec->div_id = $div->div_id;
					$ec->evnt_flag='N';
					$ec->save(false);
				}
				$competitor = Competitor::model()->findAllByAttributes(array('reg_id'=>$reg_id));
				foreach($competitor as $row)
				{
					$score = new Score;
					$score->reg_id = $reg_id;
					$score->evnt_id = $model->evnt_id;
					$score->comp_id = $row->comp_id;
					$score->div_id = $row->div_id;
					$score->save(false);
				}
			}
		}									
		$event = Event::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'evnt_order ASC'));
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$reg_id));
		$this->render('manageEvents', array('event'=>$event, 'registration'=>$registration, 'model'=>$model));		
	}
	public function actionEventMeasure()
	{
		$distanceName = array('Miles', 'Kilometers', 'Feet', 'Inches', 'Meters',  
		'Centimeters');		
		$distanceValue = array(' mi', ' km', ' ft', ' in', ' m', 
		' cm');
		$weightValue = array(' lbs', ' kg');
		$weightName = array('Pounds', 'Kilograms');
		$selected = '';
		if(isset($_POST['Event']['evnt_measure']))
			$selected = $_POST['Event']['evnt_measure'];
		
		if($_POST['Event']['evnt_type'] == 'Time Priority (For Repititions)')
			echo CHtml::tag('option',array('value'=>' reps'),CHtml::encode('Repititions'),true);
		else if($_POST['Event']['evnt_type'] == 'Task Priority (For Time)')
			echo CHtml::tag('option',array('value'=>''),CHtml::encode('Time'),true);
		else if($_POST['Event']['evnt_type'] == 'Distance')
		{
			$i=0;
			foreach($distanceName as $name)
			{
				if($selected == $distanceValue[$i])
					echo CHtml::tag('option selected',array('value'=>$distanceValue[$i]),CHtml::encode($name),true);
				else
					echo CHtml::tag('option',array('value'=>$distanceValue[$i]),CHtml::encode($name),true);
				$i++;	
			}			
		}
		else if($_POST['Event']['evnt_type'] == 'Weight')
		{
			$i=0;
			foreach($weightName as $name)
			{
				if($selected == $weightValue[$i])
					echo CHtml::tag('option selected',array('value'=>$weightValue[$i]),CHtml::encode($name),true);
				else 	
					echo CHtml::tag('option',array('value'=>$weightValue[$i]),CHtml::encode($name),true);
				$i++;	
			}				
		}
		else if($_POST['Event']['evnt_type'] == 'Points')
			echo CHtml::tag('option',array('value'=>' pts'),CHtml::encode('Points'),true);
		else 
			echo CHtml::tag('option',array('value'=>''),CHtml::encode('Select Measurement'),true);
		
											
	}	
	public function actionUpdateEvents()
	{
		$model = Event::model()->findByPk($_GET['evnt_id']);
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$_GET['reg_id']));
		
		if(isset($_POST['Event']))
		{			
			$model->attributes=$_POST['Event'];			
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{
				$model->save(false);				
				$this->redirect('manageEvents?id='.$reg_id);				
			}
			
		}			
		$this->render('updateEvents', array('model'=>$model, 'registration'=>$registration));
	}
	
	public function actionCreateEventOrder()
	{
		if(isset($_GET['id']))
		{
			$event = Event::model()->findByPk($_GET['id']);
			$event->evnt_order = $_GET['order'];
			$event->save(false);	
		}		
	}
	
	public function actionManageCompetitors()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');		 
		if(isset($_GET['id']))
			$reg_id = $_GET['id'];
		
		$model = new Competitor;				
		if(isset($_POST['Competitor']))
		{			
			$model->attributes=$_POST['Competitor'];
			$model->comp_bib=$_POST['Competitor']['comp_bib'];
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{
				$model->save(false);
				$event = Event::model()->findAllByAttributes(array('reg_id'=>$reg_id));
				foreach($event as $row)
				{
					$score = new Score;
					$score->reg_id = $reg_id;
					$score->evnt_id = $row->evnt_id;
					$score->comp_id = $model->comp_id;
					$score->div_id = $model->div_id;
					$score->save(false);
				}
			}
		}	
		else if(isset($_GET['div_id']))
		{
			$model = Competitor::model()->findByAttributes(array('div_id'=>$_GET['div_id']));
			if(!isset($model))
				$model = new Competitor;
		}				
		$competitor = Competitor::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'comp_id DESC'));
		$division = Division::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'div_name'));
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$reg_id));
		$this->render('manageCompetitors', array('competitor'=>$competitor, 'registration'=>$registration, 'model'=>$model, 'division'=>$division));
	}
	
	public function actionManageScores()
	{
		$model = new Score;
		if(Yii::app()->user->isGuest)
		  $this->redirect('../index.php');		 
		if(isset($_GET['id']))
			$reg_id = $_GET['id'];
									
		$competitor = Competitor::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'comp_name ASC'));
		$division = Division::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'div_name'));
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$reg_id));
		$score = Score::model()->findAllByAttributes(array('reg_id'=>$reg_id));
		$event = Event::model()->findAllByAttributes(array('reg_id'=>$reg_id), array('order'=>'evnt_order ASC'));
		
		$this->render('manageScores', array('competitor'=>$competitor, 'registration'=>$registration, 'event'=>$event, 'division'=>$division, 'score'=>$score, 'model'=>$model));
		
	}
	
	public function actionDeleteDivision()
	{
		$division = Division::model()->findByPk($_GET['div_id']);
		$competitor = Competitor::model()->findAllByAttributes(array('div_id'=>$_GET['div_id']));		
		$ec = EventComplete::model()->findAllByAttributes(array('div_id'=>$_GET['div_id']));	
		$score = Score::model()->findAllByAttributes(array('div_id'=>$_GET['div_id']));	
		
		foreach($competitor as $row)
			$row->delete();
		foreach($ec as $ecomp)
			$ecomp->delete();
		foreach($score as $scre)
			$scre->delete();
		$division->delete();		

		$this->redirect('manageDivisions?id='.$_GET['reg_id']);
	}
	
	public function actionDeleteEvent()
	{
		$event = Event::model()->findByPk($_GET['evnt_id']);
		$score = Score::model()->findAllByAttributes(array('evnt_id'=>$_GET['evnt_id']));
		$ec = EventComplete::model()->findAllByAttributes(array('evnt_id'=>$_GET['evnt_id']));
		
		foreach($score as $row)		
			$row->delete();
		foreach($ec as $ecomp)
			$ecomp->delete();
		$event->delete();
		
		$this->redirect('manageEvents?id='.$_GET['reg_id']);
	}
	
	public function actionDeleteCompetitor()
	{
		$delete = Competitor::model()->findByPk($_GET['comp_id']);
		$score = Score::model()->findAllByAttributes(array('comp_id'=>$_GET['comp_id']));
		$competitor = Competitor::model()->findByAttributes(array('reg_id'=>$_GET['reg_id'],'div_id'=>$delete->div_id));
		foreach($score as $row)
			$row->delete();	
		$delete->delete();		
				
		$this->redirect('manageCompetitors?id='.$_GET['reg_id'].'&div_id='.$competitor->div_id);
	}
	
	public function actionUpdateCompetitor()
	{
		$model = Competitor::model()->findByPk($_GET['comp_id']);
		$registration = Registration::model()->findByAttributes(array('reg_id'=>$_GET['id']));
		
		if(isset($_POST['Competitor']))
		{			
			$model->attributes=$_POST['Competitor'];
			$reg_id = $model->reg_id;
			$valid = $model->validate();
			if($valid)
			{
				$model->save(false);
				$score = Score::model()->findAllByAttributes(array('comp_id'=>$model->comp_id));
				foreach($score as $scre)
				{
					$oldScre = $scre->div_id;
					$scre->div_id = $model->div_id;
					$scre->save(false);
					$this->assignPoints($scre);
					$scre->div_id = $oldScre;
					$this->assignPoints($scre);
								
				}
				$this->redirect('manageCompetitors?id='.$reg_id.'&div_id='.$model->div_id);				
			}
			
		}			
		$this->render('updateCompetitors', array('model'=>$model, 'registration'=>$registration));
	}
	
	public function actionUpdateScore()
    {
        $model = new Score;
 
        if(isset($_GET['id']) && !isset($_POST['Score']))
        {           	
        	$model=Score::model()->findByPk($_GET['id']);
        	$evnt_type=$_GET['evnt_type'];         	    
        	$this->renderPartial('createDialog',array('model'=>$model,'evnt_type'=>$evnt_type),false,true);
        }
        if(isset($_POST['Score']))
        {
        	$model=Score::model()->findByPk($_GET['id']);
        	$model->attributes=$_POST['Score'];
			$reg_id = $model->reg_id;
			$div_id = $model->div_id;
			$valid = $model->validate();
			if($valid)
			{				
				$model->scre_entered = 'Y';
				$model->save(false);				
				if($model->scre_status !='ACTIVE')
					$this->updateScoreStatus($model);
				$this->assignPoints($model);				
				$this->redirect('manageScores?id='.$reg_id.'&div_id='.$div_id);
			}						
		}
    }
    
    public function actionUpdateEventScores()
    {
    	if(isset($_GET['evnt_id']) && $_GET['div_id'] && !isset($_POST['Score']))
        {           	
        	$score=Score::model()->findAllByAttributes(array('evnt_id'=>$_GET['evnt_id'], 'div_id'=>$_GET['div_id']));
        	$competitor=Competitor::model()->findAllByAttributes(array('div_id'=>$_GET['div_id']), array('order'=>'comp_name ASC'));
			$registration=Registration::model()->findByPk($score[0]->reg_id);						        	        	         	    
        	$this->render('updateEventScores',array('score'=>$score, 'registration'=>$registration, 'competitor'=>$competitor));
        }
        if(isset($_POST['Score']))
        {
        	$model=new Score;
        	$model->div_id=$_POST['Score'][0]['div_id'];
        	$model->evnt_id=$_POST['Score'][0]['evnt_id'];        	
        	$score=Score::model()->findAllbyAttributes(array('evnt_id'=>$model->evnt_id, 'div_id'=>$model->div_id));
        	$reg_id=$score[0]->reg_id;
        	$div_id=$score[0]->div_id;
       		foreach($score as $scre)
       		{              			     			
       			$i=0;     	                	
		        foreach($score as $model)
		        {		        			        	
		        	if($_POST['Score'][$i]['scre_id'] == $scre->scre_id && $_POST['Score'][$i]['scre_changed'] == 'Y' )
		        	{		        		
			        	$scre->attributes = $_POST['Score'][$i];
			        	$scre->scre_id = $_POST['Score'][$i]['scre_id'];
			        	$scre->evnt_id = $_POST['Score'][$i]['evnt_id'];
			        	$scre->scre_entered = $_POST['Score'][$i]['scre_changed'];			        				        			        		        		
						$scre->save();
						if( $_POST['Score'][$i]['scre_status'] != 'ACTIVE')
							$this->updateScoreStatus($scre);
		        		$reg_id = $scre->reg_id;
		        		$div_id = $scre->div_id;		        				        				        
		        	}
		        	$i++;
		        }   		                 	            
        	}
        	$this->assignPoints($scre);       		        	
        	$this->redirect('manageScores?id='.$reg_id.'&div_id='.$div_id);
        }        
    }
    
    protected function assignPoints($model)
    {
    	$event = Event::model()->findByPk($model->evnt_id);
		$condition = 'div_id = :div_id AND evnt_id = :evnt_id AND scre_entered = "Y" AND scre_status = "ACTIVE"';
		$orderTask = 'scre_task_prty ASC';
		$orderTime = 'scre_time_prty DESC';
		$orderOth = 'scre_other DESC';
		$params = array('div_id'=>$model->div_id, 'evnt_id'=>$event->evnt_id);
		
		if($event->evnt_type == 'Task Priority (For Time)')
		{
			$score = Score::model()->findAll(array('order'=>$orderTask, 'condition'=>$condition, 'params'=>$params));
			$this->calcTask($score);
		}	
		else if($event->evnt_type == 'Time Priority (For Repititions)')
		{
			$score = Score::model()->findAll(array('order'=>$orderTime, 'condition'=>$condition, 'params'=>$params));
			$this->calcTime($score);
		}
		else
		{	
			$score = Score::model()->findAll(array('order'=>$orderOth, 'condition'=>$condition, 'params'=>$params));
			$this->calcOther($score);
    	}
    	
    	$ec = EventComplete::model()->findByAttributes(array('evnt_id'=>$model->evnt_id,'div_id'=>$model->div_id));
    	if($ec->evnt_flag == 'Y')
    		$this->finalizeEvent($model->evnt_id, $model->div_id);																					
    }
    
    protected function calcTask($model)
    {
    	$i=1;
    	$points=$i;
    	$prev_result = '';
    	$scoreArr = array('', '100', '95', '90', '85', '80', '75', '73', '71', '69', '67',
    	'65', '63', '61', '59', '57', '55', '53', '51', '49', '47', '45', '43', '41', 
    	'39', '37', '35', '33', '31', '29', '27', '25', '24', '23', '22', '21', '20', 
    	'19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', 
    	'6', '5', '4', '3', '2', '1');
    	foreach($model as $scre)
		{
			if($i==1)
			{
				$scre->scre_points = $points;
				$prev_result = $scre->scre_task_prty;
			}	
			else 
			{
				if($scre->scre_task_prty == $prev_result)
				{
					$scre->scre_points = $points;
				}
				else
				{
					$points = $i;
					$scre->scre_points = $points;					
					$prev_result = $scre->scre_task_prty; 					
				}
			}
			$i++;
			if($scre->scre_points > 55)
				$scre->scre_games_points = 1;
			else
				$scre->scre_games_points = $scoreArr[$scre->scre_points];
			$scre->save(false);							
		}
    }
    
    protected function calcTime($model)
    {
    	$i=1;
    	$points=$i;
    	$prev_result = '';
    	$scoreArr = array('', '100', '95', '90', '85', '80', '75', '73', '71', '69', '67',
    	'65', '63', '61', '59', '57', '55', '53', '51', '49', '47', '45', '43', '41', 
    	'39', '37', '35', '33', '31', '29', '27', '25', '24', '23', '22', '21', '20', 
    	'19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', 
    	'6', '5', '4', '3', '2', '1');
    	foreach($model as $scre)
		{
			if($i==1)
			{
				$scre->scre_points = $points;
				$prev_result = $scre->scre_time_prty;
			}	
			else
			{
				if($scre->scre_time_prty == $prev_result)
				{
					$scre->scre_points = $points;
				}
				else
				{
					$points = $i;
					$scre->scre_points = $points;					
					$prev_result = $scre->scre_time_prty; 					
				}
			}						
			$i++;
			if($scre->scre_points > 55)
				$scre->scre_games_points = 1;
			else
				$scre->scre_games_points = $scoreArr[$scre->scre_points];
			$scre->save(false);
		}
    }
    
    protected function calcOther($model)
    {
    	$i=1;
    	$points=$i;
    	$prev_result = '';
    	$scoreArr = array('', '100', '95', '90', '85', '80', '75', '73', '71', '69', '67',
    	'65', '63', '61', '59', '57', '55', '53', '51', '49', '47', '45', '43', '41', 
    	'39', '37', '35', '33', '31', '29', '27', '25', '24', '23', '22', '21', '20', 
    	'19', '18', '17', '16', '15', '14', '13', '12', '11', '10', '9', '8', '7', 
    	'6', '5', '4', '3', '2', '1');
    	foreach($model as $scre)
		{
			if($i==1)
			{
				$scre->scre_points = $points;
				$prev_result = $scre->scre_other;
			}
			else
			{
				if($scre->scre_other == $prev_result)
				{
					$scre->scre_points = $points;
				}
				else
				{
					$points = $i;
					$scre->scre_points = $points;					
					$prev_result = $scre->scre_other; 					
				}
			}						
			$i++;
			if($scre->scre_points > 55)
				$scre->scre_games_points = 1;
			else
				$scre->scre_games_points = $scoreArr[$scre->scre_points];
			$scre->save(false);	
		}
    }
    
    public function actionFinalizeEvent()
    {    	
		$this->finalizeEvent($_GET['evnt_id'], $_GET['div_id']);
		$div = Division::model()->findByPk($_GET['div_id']);
		$reg_id = $div->reg_id;
		$div_id = $div->div_id;		
		$this->redirect('manageScores?id='.$reg_id.'&div_id='.$div_id);		
    }
    
    protected function finalizeEvent($evnt_id, $div_id)
    {
    	$eventComplete = EventComplete::model()->findByAttributes(array('evnt_id'=>$evnt_id, 'div_id'=>$div_id));	
		$eventComplete->evnt_flag = 'Y';	
		$competitor = Competitor::model()->findAllByAttributes(array('div_id'=>$div_id));		
		$eventComplete->save();
		
		$total_score = 0;
		$total_games_score = 0;
		
		foreach($competitor as $comp)
		{
			$reg_id = $comp->reg_id;
			$div_id = $comp->div_id;
			$event = EventComplete::model()->findAll('div_id = :div_id AND evnt_flag = "Y"',
											array('div_id'=>$comp->div_id));
			foreach($event as $row)
			{
				$score = Score::model()->findByAttributes(array('evnt_id'=>$row->evnt_id, 'comp_id'=>$comp->comp_id));
				if($score->scre_status == 'ACTIVE')
				{
					$total_score += $score->scre_points;
					$total_games_score += $score->scre_games_points;
				}								
			}						
			$comp->comp_score_total = $total_score;
			$comp->comp_games_score_total = $total_games_score;
			$comp->save(false);
			$total_score = 0;
			$total_games_score = 0;	
		}
		$this->calcOverallRank($div_id);
		$this->calcOverallGamesRank($div_id);
    }
    
    protected function calcOverallRank($div_id)
    {
    	$competitor = Competitor::model()->findAll('div_id = :div_id AND comp_status = "ACTIVE" order by comp_score_total ASC',
    									array('div_id'=>$div_id));
    	$i=1;
    	$prev_result = '';
    	$points = $i;
    	foreach($competitor as $comp)
    	{    		
    		if($i==1)
			{
				$comp->comp_rank = $points;
				$prev_result = $comp->comp_score_total;
			}
			else
			{
				if($comp->comp_score_total == $prev_result)
				{
					$comp->comp_rank = $points;
				}
				else
				{
					$points = $i;
					$comp->comp_rank = $points;					
					$prev_result = $comp->comp_score_total; 					
				}
			}    		
    		$comp->save(false);
    		$i++;
    	}    	
    }
    
	protected function calcOverallGamesRank($div_id)
    {
    	$competitor = Competitor::model()->findAll('div_id = :div_id AND comp_status = "ACTIVE" order by comp_games_score_total DESC',
    									array('div_id'=>$div_id));
    	$i=1;
    	$prev_result = '';
    	$points = $i;
    	
    	foreach($competitor as $comp)
    	{    		
    		if($i==1)
			{
				$comp->comp_games_rank = $points;
				$prev_result = $comp->comp_games_score_total;
			}
			else
			{
				if($comp->comp_games_score_total == $prev_result)
				{
					$comp->comp_games_rank = $points;
				}
				else
				{
					$points = $i;
					$comp->comp_games_rank = $points;					
					$prev_result = $comp->comp_games_score_total; 					
				}
			}    		
    		$comp->save(false);
    		$i++;
    	}    	
    }
    
    protected function updateScoreStatus($model)
    {
    	$evnt = Event::model()->findByPk($model->evnt_id);
    	$event = Event::model()->findAll('reg_id = :reg_id AND evnt_order >= :evnt_order',
											array('reg_id'=>$evnt->reg_id, 'evnt_order'=>$evnt->evnt_order));
		foreach($event as $evnt)
		{
			$score = Score::model()->findByAttributes(array('evnt_id'=>$evnt->evnt_id, 'comp_id'=>$model->comp_id));
			$score->scre_status = $model->scre_status;
			$score->scre_points = 0;			
			$score->save(false);
			$ec = EventComplete::model()->findByAttributes(array('evnt_id'=>$score->evnt_id, 'div_id'=>$score->div_id));
			if($ec->evnt_flag == 'Y')
				$this->assignPoints($score);
		}
		$comp = Competitor::model()->findByPk($model->comp_id);
		$comp->comp_status=$model->scre_status;
		$comp->save(false);
		
		
    }
}