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
  				<li class="active">
					<a href="manageCompetitors?id=<?php echo $registration->reg_id; ?>">Competitors</a>
  				</li>
  				<li>
  					<a href="manageScores?id=<?php echo $registration->reg_id; ?>">Scores</a>
  				</li>
				</ul>
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
    <legend>Add a Competitor</legend>
    <div class="control-group">      
      <div class="controls"> 
      <div class="span6">   
      <table class="table">
      	<tr>
      		<th style="border-top:0px;">Competitor Name:</th>
      		<th style="border-top:0px;">Bib #</th>
      		<th style="border-top:0px;">Division:</th>
      		<th style="border-top:0px;"></th>
      	</tr>
      	<tr>
    	<?php echo '<td>'.$form->textField($model, 'comp_name').'</td>';?>
    	<?php echo '<td>'.$form->textField($model, 'comp_bib', array('style'=>'width:50px')).'</td>'; ?>
		<?php echo '<td>'.$form->dropDownList(
                    $model,
                    'div_id', 
                    CHtml::listData($division,'div_id','div_name'), 
					array('empty'=>'Select Division')).'</td>';  ?>	  	  
	    <?php echo '<td>'.$form->hiddenField($model, 'reg_id', array('value'=>$registration->reg_id)); ?>
    	<?php echo CHtml::submitButton('Add Competitor').'</td>'; ?>
      </table>
      </div>	  
	  </div> 	      
	</div>
	</fieldset>	
<?php $this->endWidget(); ?>

<?php 
	if(sizeof($competitor) > 0)
	{
		echo '<div class="tabbable"> 
  				<ul class="nav nav-tabs">';
		$i=0;
  		foreach($division as $div)
  		{
  			if(sizeof($model->div_id) > 0 && $model->div_id == $div->div_id)
  				echo '<li class="active"><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
  			else if(sizeof($model->div_id) == 0 && $i==0)	
  				echo '<li class="active"><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		else 
    			echo '<li><a href="#div'.$div->div_id.'" data-toggle="tab">'.$div->div_name.'</a></li>';
    		$i++;		
		}
				
		echo '</ul>';
		echo '<div class=offset1>';
		echo '<div class="tab-content">';
		$j=0;
		foreach($division as $div)
  		{
  			$flag='N';
  			if(sizeof($model->div_id) > 0 && $model->div_id == $div->div_id)
  				echo '<div class="tab-pane active" id="div'.$div->div_id.'">';
  			else if(sizeof($model->div_id)==0 && $j==0)
				echo '<div class="tab-pane active" id="div'.$div->div_id.'">';
			else
				echo '<div class="tab-pane" id="div'.$div->div_id.'">';
			//echo '<h2>Competitors</h2>';	
			echo '<br><table class="table table-condensed" style="width:400px">';										
			foreach($competitor as $row)
			{
				if($row->div_id == $div->div_id)
				{
					$flag='Y';
					echo '<tr><td><h4>'.$row->comp_name.'</h4><br><table class="table table-condensed" style="width:200px"><tr>';
					if($row->comp_status == 'ACTIVE')
						echo '<td><h6>STATUS: '.$row->comp_status.'</h6></td>';
					else
						echo '<td> <span class="label label-important">STATUS: '.$row->comp_status.'</span></td>';
					echo '<td><h6>Bib: '.$row->comp_bib.'</h6></td></tr></table>';
					echo '<td><a style="float:right" class="btn btn-primary btn-small" href="UpdateCompetitor?comp_id='
							.$row->comp_id.'&id='.$registration->reg_id.'&flg=Comp">Update</a></td>';
					echo '</td><td><a style="float:right" class="btn btn-small" onclick="return deleteCompetitor()" href="DeleteCompetitor?reg_id='
							.$registration->reg_id . '&comp_id='.$row->comp_id
							.'">Delete</a></td>';					
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
		echo '<h2>No Competitors Found</h2><br><br>';
?>
<br>
<br>
<br>
<script type="text/javascript">

    function deleteCompetitor () 
    {
    	return confirm("Are you sure you wish to delete this competitor?\n\n"+
						"You will lose all scores associated with this competitor.\n\n"+
    					"WARNING: This action cannot be undone.");
    }
</script>
</div>
</div>