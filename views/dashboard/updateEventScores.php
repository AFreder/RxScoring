<br>
  <div class="row-fluid">
    <div class="span3">
		<div class="well">
			<ul class="nav nav-list">
  				<li class="nav-header">
    				<?php echo $registration->reg_evt_nm; ?>
  				</li>
  				<li>
    				<a href="index">Home</a>
  				</li>
  				<ul class="nav nav-list">
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
			</ul>
		</div>
    </div>
    <div class="span9">   

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'score-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?php 
	$event=Event::model()->findByPk($score[0]->evnt_id);
	echo '<h2>'.$event->evnt_name.' Score Editor</h2>';
?>
<div style="padding-left:20px;">
<br>
    <?php echo $form->errorSummary($score); ?>
<div class="form">
<table class="table">

<?php 
	$event=Event::model()->findByPk($score[0]->evnt_id);
	$i=0;
	foreach($competitor as $comp){
	foreach($score as $scre) 
	{
		if($scre->comp_id == $comp->comp_id){
		
		echo '<tr>';	
		$competitor=Competitor::model()->findByPk($scre->comp_id);		
		echo '<td>'.$competitor->comp_name.' #'.$competitor->comp_bib.'</td>';
		echo '<td>'.$form->dropDownList($scre,"[$i]scre_status",array('ACTIVE' => 'ACTIVE' 
    	   						, 'WD' => 'WD'
    	    					, 'DNF' => 'DNF'
    	    					, 'DNS' => 'DNS'),
    	    					array('style'=>'width:100px;', 'disabled'=>'true')).'</td>'; 		
		if($event->evnt_typ_cd == 1)
		{			
			echo '<td style="width:100px">'.CHtml::activeTextField($scre,"[$i]scre_task_prty", array('disabled'=>'disabled')).'</td>';
			if($scre->scre_entered == 'Y')
				echo '<td><span class="label label-info">';
			else
				echo '<td><span class="label">';
			echo '<a style="color:white" onmouseover="this.style.cursor=\'pointer\'" onclick="enableField(\'Score_'.$i.'_scre_task_prty\',\''.$i.'\');">Click to Edit</a></span></td>';				
			echo CHtml::activeHiddenField($scre,"[$i]scre_time_prty");
			echo CHtml::activeHiddenField($scre,"[$i]scre_other");				
		}
		else if($event->evnt_typ_cd == 2)
		{			
			echo '<td style="width:100px">'.CHtml::activeTextField($scre,"[$i]scre_time_prty", array('disabled'=>'disabled')).'</td>';
			if($scre->scre_entered == 'Y')
				echo '<td><span class="label label-info">';
			else
				echo '<td><span class="label">';
			echo '<a style="color:white" onmouseover="this.style.cursor=\'pointer\'" onclick="enableField(\'Score_'.$i.'_scre_time_prty\',\''.$i.'\');">Click to Edit</a></span></td>';
			echo CHtml::activeHiddenField($scre,"[$i]scre_task_prty");
			echo CHtml::activeHiddenField($scre,"[$i]scre_other");							
		}
		else if($event->evnt_typ_cd == 3)
		{		
			echo '<td style="width:100px">'.CHtml::activeTextField($scre,"[$i]scre_other", array('disabled'=>'disabled')).'</td>';			
			if($scre->scre_entered == 'Y')
				echo '<td><span class="label label-info">';
			else
				echo '<td><span class="label">';
			echo '<a style="color:white" onmouseover="this.style.cursor=\'pointer\'" onclick="enableField(\'Score_'.$i.'_scre_other\',\''.$i.'\');">Click to Edit</a></span></td>';
				echo CHtml::activeHiddenField($scre,"[$i]scre_time_prty");
			echo CHtml::activeHiddenField($scre,"[$i]scre_task_prty");					
		}		
		echo '<input name="Score['.$i.'][scre_changed]" id="Score_'.$i.'_scre_changed" type="hidden" value="N" />';
		echo CHtml::activeHiddenField($scre,"[$i]scre_entered");
		echo CHtml::activeHiddenField($scre,"[$i]scre_entered");
		echo CHtml::activeHiddenField($scre,"[$i]evnt_id");
		echo CHtml::activeHiddenField($scre,"[$i]div_id");
		echo CHtml::activeHiddenField($scre,"[$i]reg_id");
		echo CHtml::activeHiddenField($scre,"[$i]scre_id");
		echo CHtml::activeHiddenField($scre,"[$i]comp_id");
		echo '</tr>';
		$i++;
		}
		}
	}
?>	

</table>
 
<?php 
	echo '<input type="Submit" value="Save" class="btn btn-primary"> ';
	echo '<a class="btn" href="manageScores?id='.$registration->reg_id.'&div_id='.$_GET['div_id'].'">Cancel</a>';
?>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<?php $this->endWidget(); ?>
<script type="text/javascript"> 
function enableField($id, $i)
{
	document.getElementById($id).disabled='';
	document.getElementById('Score_'+$i+'_scre_status').disabled='';
	document.getElementById($id).focus();
	document.getElementById('Score_'+$i+'_scre_changed').value='Y';
}
</script>
 