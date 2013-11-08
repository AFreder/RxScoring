<script type="text/javascript" src="/js/bootstrap-tab.js"></script>
  <div class="row-fluid">
    <div class="span2">
		<div class="well">
			<ul class="nav nav-list">
  				<li class="nav-header">
    				<?php echo $registration->reg_evt_nm; ?>
  				</li>
  				<legend></legend>
  				<li>
    				<a href="index">Home</a>
  				</li>
  				<li>
  					<a href="manageDivisions?id=<?php echo $registration->reg_id; ?>">Divisions</a>
  				</li>  				
				<li>
  					<a href="manageEvents?id=<?php echo $registration->reg_id; ?>">Events</a>
  				</li>
  				<li>
					<a href="manageCompetitors?id=<?php echo $registration->reg_id; ?>">Competitors</a>
  				</li>
  				<li class="active">
  					<a href="manageScores?id=<?php echo $registration->reg_id; ?>">Scores</a>
  				</li>
			</ul>
			<br />
			<br />
		</div>
    </div>
    <div class="span10">      
 

<?php 
	if(sizeof($competitor) > 0)
	{
		echo '<div class="tabbable"> 
  				<ul class="nav nav-tabs">';
		$i=0;
		if(isset($_GET['div_id']))
			$div_id = $_GET['div_id'];
		else 
			$div_id = $division[0]->div_id;			
  		foreach($division as $div)
  		{
  			if($i==0 && $div_id==0)	
  				echo '<li class="active"><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		else if($div_id != 0 && $div->div_id == $div_id)
    			echo '<li class="active"><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		else
    			echo '<li><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		$i++;		
		}
				
		echo '</ul>';
		echo '<div class="tab-content">';
		$j=0;
		foreach($division as $div)
  		{  			
  			if($j==0 && $div_id==0)
				echo '<div class="tab-pane active" style="'.$j.' '.$div_id.'"id="div'.$div->div_id.'">';
			else if($div_id != 0 && $div->div_id == $div_id)
				echo '<div class="tab-pane active" id="div'.$div->div_id.'">';
			else
				echo '<div class="tab-pane" id="div'.$div->div_id.'">';	
			echo '<p><span class="label">*</span> = Score Not Entered ';
			echo '<span class="label label-info">*</span> = Score Entered ';
			echo '<span class="label label-important">*</span> = Status Not Active</p>';			
			echo '<br><table class="table table-condensed table-striped">';			
			echo '<tr><td style="border-top:0px;" colspan="2"></td>';
			foreach($event as $row)
			{
				$scoresEntered = Score::model()->find(array('condition'=>'evnt_id = :evnt_id AND div_id = :div_id AND scre_entered = "N"', 
				                                   'params'=>array('div_id'=>$div->div_id, 'evnt_id'=>$row->evnt_id)));				
				
				$ec = EventComplete::model()->findByAttributes(array('div_id'=>$div->div_id, 'evnt_id'=>$row->evnt_id));
				echo '<td style="border-top:0px;">';
				if($ec->evnt_flag == 'Y')
					echo '<span class="label label-info">Finalized</span>';
				else if($ec->evnt_flag == 'N' && isset($scoresEntered))
					echo '<span class="label">Not Finalized</span>';
				else				
					echo '<a class="btn btn-mini" onclick="return finalizeEvent()" href="FinalizeEvent?evnt_id='.$row->evnt_id.'&div_id='.$div->div_id.'">Finalize Event</a>';	
				echo '</td>';	
			}
			echo '</tr>';
			echo '<tr><th>Competitor Name</th><th>BIB #</th>';
            foreach($event as $row)
					echo '<th>'.$row->evnt_name.' <a title="Edit All Scores for Event" style="color:black;" href="UpdateEventScores?evnt_id='.$row->evnt_id.'&div_id='.$div->div_id.'"><i class="icon-edit"></i></a></th>';
			echo '</tr>';			
			
			$flag = 'N';
											
			foreach($competitor as $row)
			{
				if($row->div_id == $div->div_id)
				{
					$flag='Y';
					echo '<tr><td><a href="UpdateCompetitor?comp_id='.$row->comp_id.'&id='.$row->reg_id.'&flg=Score">'.$row->comp_name. '</td><td>'.$row->comp_bib.'</a></td>';
					
					foreach($event as $evnt)					
					{	
						$scre = Score::model()->findByAttributes(array('evnt_id'=>$evnt->evnt_id, 'comp_id'=>$row->comp_id));
														
						echo '<td title="Click to edit score">';
						if($scre->scre_status != 'ACTIVE')
							echo '<span class="label label-important">';
						else if($scre->scre_entered == 'Y')
							echo '<span class="label label-info">';
						else
							echo '<span class="label">';
							
						if($evnt->evnt_type == 'Time Priority (For Repititions)')								
							echo CHtml::ajaxLink($scre->scre_time_prty, 'UpdateScore?id='.$scre->scre_id.'&evnt_type=1', array('update'=>'#scoreDisplay'), array('style'=>'color: white;'));
						else if($evnt->evnt_type == 'Task Priority (For Time)')
							echo CHtml::ajaxLink($scre->scre_task_prty, 'UpdateScore?id='.$scre->scre_id.'&evnt_type=2', array('update'=>'#scoreDisplay'), array('style'=>'color: white;'));
						else
							echo CHtml::ajaxLink($scre->scre_other, 'UpdateScore?id='.$scre->scre_id.'&evnt_type=3', array('update'=>'#scoreDisplay'), array('style'=>'color: white;'));
						
						echo '</span>';
					}
					
					echo '</tr>';
				}
			}			
			if($flag == 'N')
				echo '<tr><td>No Competitors Found</td></tr></table></div>';
			else
				echo '</table></div>';
			$j++;
		}
		echo '</div></div>';
	}
	else 
		echo '<h2>No Scores Found</h2><br><br><h3>Competitors must be added before scores can be entered.</h3>';
?>
<br>
<br>
<br>


<div style="display:none" id="scoreDisplay"></div>
<script type="text/javascript">
    function finalizeEvent () 
    {
    	return confirm("Are you sure you wish to finalize this event?\n\n"+
						"Only finalize an event if you are ready to re-calculate "+
						"the overall standings on the Leaderboard.\n\n"+
    					"NOTE: You may still make changes to scores after an event has been finalized.");
    }
</script>
</div>
</div>
