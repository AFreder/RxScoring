<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.mouse.js"></script>	
<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.sortable.js"></script>
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
				<li  class="active">
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
    'id'=>'event-form',
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
    <legend>Add Events</legend>
    <div class="control-group">
    <div class="controls">
    <table>
      <tr><td>Event Name:</td><td></td><td>Event Description:</td><td></td></tr>
      <tr>
      	<td style="vertical-align:top;"><?php echo $form->textField($model,'evnt_name');?></td>     
    	<td style="vertical-align:top;"><?php echo $form->dropDownList($model,'evnt_type',array(''=>'Select Event Type'    		
    		, 'Time Priority (For Repititions)' => 'Time Priority (For Repititions)' 
    	    , 'Task Priority (For Time)' => 'Task Priority (For Time)'
    	    , 'Distance' => 'Distance'
    	    , 'Weight' => 'Weight'
    	    , 'Points' => 'Points'),
    	    array(
				'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('/dashboard/eventMeasure'), //url to call.
					'update'=>'#Event_evnt_measure',
    	    ))); 
   	    echo '<br />'.$form->dropDownList($model,'evnt_measure', array(''=>'Select Measurement'));?></td>
   	    <td style="vertical-align:top;"><?php echo $form->textArea($model,'evnt_desc', array('rows'=>'4'));?></td>
	    <td style="vertical-align:top;"><?php echo $form->hiddenField($model, 'reg_id', array('value'=>$registration->reg_id)); ?>
    	<?php echo CHtml::submitButton('Add Event'); ?></td>
      </tr>
    </table>	  
	  </div> 	      
	</div>
	</fieldset>	
<?php $this->endWidget(); ?>
		<ul class="nav nav-tabs">
  			<li class="active">
    			<a href="">Event Management</a>
  			</li>  			
		</ul>
<div class="offset1">
<?php
	$i=0; 
	if(sizeof($event) > 0)
	{
		echo '<p><i class="icon-resize-vertical"></i>* = Drag row to sort.</p>';
		echo '<table id="sortable" style="width:550px" class="table">
				<thead>
					<tr><th>Event Order:</th><th>Event Name</th><th colspan="2">Event Type</th></tr>
				</thead>';
		echo '<tbody class="content">';
		foreach($event as $row)
		{
			$i++;
			 echo '<tr style="cursor:pointer" id="sort_'.$row->evnt_id.'"><td><i class="icon-resize-vertical"></i>
		           	  <span id="order'.$row->evnt_id.'">Event '.$i.'</span></td>'.
		 			  '<td>'.$row->evnt_name.'</td><td>'.$row->evnt_type.'</td><td>'.
		 			  '<a style="float:right" class="btn btn-primary btn-small" href="UpdateEvents?reg_id='
							.$registration->reg_id . '&evnt_id='.$row->evnt_id.'">Update</a></td><td>'.
					  ' <a style="float:right" class="btn btn-small" onclick="return deleteConfirmation()" href="DeleteEvent?reg_id='
							.$registration->reg_id . '&evnt_id='.$row->evnt_id.'">Delete</a></td>'.
		 			  '</tr>';					
		}
		echo '</tbody>';
		$i=0;	
		
	}
	else 
		echo '<h1>No Events Found</h1>';
?>
<script>
$(function() {
	// Return a helper with preserved width of cells
	var fixHelper = function(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	};	
	 $( "#sortable tbody.content" ).sortable({	
		 helper: fixHelper
	 }).disableSelection(); 	
	 $( "#sortable tbody.content" ).sortable({		 
		 update: function(event,ui)
	        {
	          //create an array with the new order
	          var order = $(this).sortable('toArray');	           	          			  	  
			  var i=0;
	          for(var key in order) 
		      {	        	  
		          var part = order[key].split("_");
	          //	alert(key);
	          	i++;     	         
		          //update each hidden field used to store the list item position	          
	          	document.getElementById("order"+part[1]).innerText = "Event "+i;	          	
	          	$.get("createEventOrder", { id: part[1], order: i , rand: Math.random() } );
	           }
	      }	  
	  });
	});
</script>
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
<script type="text/javascript">

    function deleteConfirmation () 
    {
    	return confirm("Are you sure you wish to delete this event?\n\n"+						
    					"ALL scores associated with this event will be deleted.\n\n"+
    					"WARNING: This action cannot be undone.");
    }
</script>
</div>
  </div>
</div>
<br />