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
  				<li class="active">
					<a href="manageCompetitors?id=<?php echo $registration->reg_id; ?>">Competitors</a>
  				</li>
  				<li>
  					<a href="manageScores?id=<?php echo $registration->reg_id; ?>">Scores</a>
  				</li>
			</ul>
			<br />
			<br />
		</div>
    </div>
    <div class="span10">      

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competitor-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php 
	if($model->hasErrors())
	{
		echo '<div class="alert-error">
  			  <button class="close" data-dismiss="alert">x</button>'
  				.$form->errorSummary($model) .   
			  '</div><br>';
	}
?>
  <fieldset>
    <legend><h2><?php echo $model->comp_name; ?></h2></legend>
    <div class="control-group">
      <label class="control-label" for="input01">Competitor Name:</label>      
      <div class="controls">    
    	<?php echo $form->textField($model, 'comp_name'); ?><br><br>
    	<label class="control-label" for="input01">BIB #:</label>
    	<?php echo $form->textField($model, 'comp_bib'); ?><br><br>
    	<label class="control-label" for="input01">Division:</label>
    	<?php $division=Division::model()->findAllByAttributes(array('reg_id'=>$model->reg_id));
    	      echo $form->dropDownList(
                    $model,
                    'div_id', 
                    CHtml::listData($division,'div_id','div_name'), 
					array('empty'=>'Select Division'));?><br><br>
		<label class="control-label" for="input01">Overall Status:</label>
		<?php echo $form->dropDownList($model,'comp_status',array('ACTIVE' => 'ACTIVE' 
    	    , 'WD' => 'WD'
    	    , 'DNF' => 'DNF'
    	    , 'DNS' => 'DNS'    	    
    	    )); ?><br><br>
		</div>
		<br>
		<br>		
		<?php
			$event = Event::model()->findAllByAttributes(array('reg_id'=>$model->reg_id), array('order'=>'evnt_order ASC'));			 
			echo '<table class="table table-condensed">';		
			echo '<tr><th>Rank</th><th>Competitor Name</th><th>BIB #</th>';
            foreach($event as $row)
					echo '<th>'.$row->evnt_name.'</th>';
			echo '</tr>';	 
		
			echo '<tr><td>'.$model->comp_rank.'</td><td>'.$model->comp_name. '<br><br></td><td>'.$model->comp_bib.'</td>';							
					foreach($event as $evnt)
					{	
						$scre = Score::model()->findByAttributes(array('comp_id'=>$model->comp_id, 'evnt_id'=>$evnt->evnt_id));											
						echo '<td>'.$scre->scre_points;													
						if($evnt->evnt_type == 'Time Priority (For Repititions)')								
							echo ' ('.$scre->scre_time_prty.')';
						else if($evnt->evnt_type == 'Task Priority (For Time)')
							echo ' ('.$scre->scre_task_prty.')';
						else
							echo ' ('.$scre->scre_other.')';
						echo '<br /><br />';
						
						if($scre->scre_status != 'ACTIVE')
							echo '<span class="label label-important">'.$scre->scre_status.'</span>';
						else
							echo $scre->scre_status;
						
						echo '</td>';											
					}					
					echo '</tr>';					
				echo '</table>';		
		?>
		<br>
		<br>
	<?php echo '<input type="Submit" value="Save" class="btn btn-primary"> '; 
	      if($_GET['flg'] == 'Comp')  
	      	echo '<a class="btn" href="manageCompetitors?id='.$model->reg_id.'&div_id='.$model->div_id.'">Cancel</a>';
	      else
	      	echo '<a class="btn" href="manageScores?id='.$model->reg_id.'">Cancel</a>';?>
	     
	</div>
	</fieldset>	

<?php $this->endWidget(); ?>


<br>
<br>
<br>

</div>
</div>
</div>