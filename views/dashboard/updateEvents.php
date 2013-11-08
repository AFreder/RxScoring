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
				<li class="active">
  					<a href="manageEvents?id=<?php echo $registration->reg_id; ?>">Events</a>
  				</li>
  				<li>
  					<a href="manageCompetitors?id=<?php echo $registration->reg_id; ?>">Competitors</a>
  				</li>  				
  				<li>
  					<a href="manageScores?id=<?php echo $registration->reg_id; ?>">Scores</a>
  				</li>
				</ul>
			</ul>
		</div>
    </div>
    <div class="span9">      

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
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
    <legend><h2>Event <?php echo $model->evnt_order; ?></h2></legend>
    <div class="control-group">
      <label class="control-label" for="input01">Event Name:</label>      
      <div class="controls">    
      <?php echo $form->textField($model, 'evnt_name'); ?><br><br>
      <label class="control-label" for="input01">Event Type:</label>
      <td style="vertical-align:top;"><?php echo $form->dropDownList($model,'evnt_type',array(''=>'Select Event Type'    		
    		, 'Time Priority (For Repititions)' => 'Time Priority (For Repititions)' 
    	    , 'Task Priority (For Time)' => 'Task Priority (For Time)'
    	    , 'Distance' => 'Distance'
    	    , 'Weight' => 'Weight'
    	    , 'Points' => 'Points'),
    	    array(
				'ajax' => array(
					'type'=>'POST',
					'url'=>CController::createUrl('/dashboard/eventMeasure'), 
					'update'=>'#Event_evnt_measure',
    	    ))); 
   	    echo '<br />'.$form->dropDownList($model,'evnt_measure', array(''=>'Select Measurement'));?></td>
   	    <br><br>   	    
      <label class="control-label" for="input01">Event Description:</label>
      <?php echo $form->textArea($model, 'evnt_desc', array('rows'=>'8')); ?><br><br>
      <?php echo '<input type="Submit" value="Save" class="btn"> '; 
	  		echo '<a class="btn" href="manageEvents?id='.$model->reg_id.'">Cancel</a>';?>	     
	</div>
	</fieldset>	

<?php $this->endWidget(); ?>

<script type="text/javascript">
        $(function()
        {
                <?php
                        echo(CHtml::ajax(array
                        (
                        	'type'=>'POST',
                            'url'=>CController::createUrl('/dashboard/eventMeasure'),
							'data'=>array('Event[evnt_type]'=>$model->evnt_type, 'Event[evnt_measure]'=>$model->evnt_measure),                      
                            'update'=>'#Event_evnt_measure',
                        )));
                ?>
        });
</script>

<br>
<br>
<br>

</div>
</div>
</div>