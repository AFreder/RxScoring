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

  				<li class="active">
  					<a href="manageDivisions?id=<?php echo $registration->reg_id; ?>">Divisions</a>
  				</li>  				
				<li>
  					<a href="manageEvents?id=<?php echo $registration->reg_id; ?>">Events</a>
  				</li>
  				<li>
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
    
          <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'division-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,	
    ),
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
    <legend>Add Divisions</legend>
    <div class="control-group">
      <label class="control-label" for="input01">Select a Division:</label>
      <div class="controls">    
    	<?php echo $form->dropDownList($model,'div_name',array(''=>'Select a Division'
    		, 'RX - Team'=>'RX - Team'
    	    , 'RX - Men'=>'RX - Men'
    	    , 'RX - Women'=>'RX - Women'
    	    , 'RX - Masters'=>'RX - Masters'
    	    , 'Scaled - Team'=>'Scaled - Team'
    	    , 'Scaled - Men' =>'Scaled - Men'
    	    , 'Scaled - Women'=>'Scaled - Women'
    	    , 'Scaled - Masters'=>'Scaled - Masters'
    	    , 'Olympic - Men (Under 155)'=>'Olympic - Men (Under 155)'
    	    , 'Olympic - Men (156-179)'=>'Olympic - Men (156-179)'
    	    , 'Olympic - Men (180+)'=>'Olympic - Men (180+)'
    	    , 'Olympic - Women (Under 125)'=>'Olympic - Women (Under 125)'
    	    , 'Olympic - Women (126-140)'=>'Olympic - Women (126-140)'
    	    , 'Olympic - Women (141+)'=>'Olympic - Women (141+)')); ?>	  	  
	    <?php echo $form->hiddenField($model, 'reg_id', array('value'=>$registration->reg_id)); ?>
    	<?php echo CHtml::submitButton('Add Division'); ?>	  
	  </div> 	      
	</div>
	</fieldset>	
<?php $this->endWidget(); ?>
<br />
		   <legend>Division Management</legend>
<br>
<br>

<div class="offset1">
<?php 
	if(sizeof($division) > 0)
	{
		echo '<table class="table table-condensed" style="width:350px">';		        
		foreach($division as $row)
		{
			$count = Competitor::model()->count('div_id = :div_id', array('div_id'=>$row->div_id));
			echo '<tr><td><h5>'.$row->div_name.'</h5><br><table class="table table-condensed" style="width:200px"><tr>';
			echo '<td><h6>COMPETITORS: '.$count.'</h6></td></tr></table></td><td>';								
			if($count > 0)
				echo '<a style="float:right" onclick="return noDelete()" class="btn btn-small" href="">Delete</a></td>';
			else
				echo '<a style="float:right" onclick="return deleteConfirmation()" 
				class="btn btn-small" href="DeleteDivision?reg_id='
				.$registration->reg_id . '&div_id='.$row->div_id
				.'">Delete</a></td>';				
		}
		echo '</table>';
	}
	else 
		echo '<h1>No Divisions Found</h1>';
?>
<br>
<br>
<br>
<script type="text/javascript">

    function deleteConfirmation () 
    {
    	return confirm("Are you sure you wish to delete this division?\n\n");
    }
    function noDelete()
    {
    	return alert("Division contains competitors.\n\nPlease remove all competitors from Division before deleting!\n\n");
    }
</script>
</div>
</div>
</div>
</div>
</div>