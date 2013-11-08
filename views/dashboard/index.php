<div  class="container">
<div class="row-fluid">
<div class="offset2">
<div class="span8">
<h2>Registered Events</h2>
<br>
<br>
<?php	
	if($session['user_id'] == 46)		 
		$model = Registration::model()->findAll();
	else 
		$model = Registration::model()->findAllByAttributes(array('user_id'=>$session['user_id']));
	if(sizeof($model) > 0)
	{							
		foreach($model as $event)
		{
			echo '<div class="well span11">';
			//<table style="width:450px;">';					
			//echo '<tr><td>
			echo '<legend><h4>'.$event->reg_evt_nm.'</h4></legend>';
			if($event->reg_scre_type == 'GAMES')
				$scre_type = 'GAMES-STYLE';
			else
				$scre_type = 'REGIONALS-STYLE';
		?>
			<table class="table table-condensed span6">
			<tr>
				<td style="border:0px">
					<h6>Scoring Type: </h6>
				</td>
				<td style="border:0px">
					<h6> <?php echo $scre_type;?></h6>
				</td>				
			</tr>
			<tr>
				<td style="border:0px">
					<h6>Start Date: </h6>
				</td>
				<td style="border:0px">
					<h6><?php echo Yii::app()->dateFormatter->format('MM/dd/yy', $event->reg_evt_bgn_dt);?> </h6>
				</td>							
			</tr>
			</table>
		<?php
			echo '</td><td><div style="text-align:right">
						<a class="btn" href="updateRegistration?id='.$event->reg_id.'">Edit Info</a>
						<a class="btn btn-primary" href="manageDivisions?id='.$event->reg_id.'">Manage</a> ';
			$checkEvent = Event::model()->findAllByAttributes(array('reg_id'=>$event->reg_id));
			if(sizeof($checkEvent) > 0)
			{								
				echo ' <a class="btn" href="../leaderboard/index/'.$event->reg_id.'">Leaderboard</a>';
				echo'</div></td></tr></table></div>';
			}
			else
				echo '</div></h2></td></tr></table></div>';
		}
		echo '</table>';
	}
	else
		echo '<div class="well span11"><br /><h3>You have no registered events at this time.</h3><br /></div>';
?>
</div>
<div class="span8">
<br />
<a class="btn btn-primary" href="registerEvent">Add a New Event</a>
</div>
<script type="text/javascript">
	function updateType ($id, $type) 
	{
		if($type == 'GAMES')
		{
			$scre_type = 'Regionals-Style';
			$type = 'REGIONALS';
		}
		else
		{
			$scre_type = 'Games-Style';
			$type = 'GAMES';	
		}
		document.getElementById("event_"+$id).innerText = $scre_type;	          	
		$.get("ScoringType", { id: $id, type: $type, rand: Math.random() } );
	}
</script>	          	
</div>
</div>
</div>
</div>