<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'score-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<div style="padding-left:20px;">
    <?php echo $form->errorSummary($model); ?> 	
    <div class="row">
    	<?php 
    	 if($evnt_type == 1)
    	 {
         	echo $form->labelEx($model,'scre_time_prty'); 
         	echo $form->textField($model,'scre_time_prty');
         }
         else if($evnt_type == 2)
         {
         	echo $form->labelEx($model,'scre_task_prty'); 
         	echo $form->textField($model,'scre_task_prty');
         }
         else if($evnt_type == 3)
         {
         	echo $form->labelEx($model,'scre_other'); 
         	echo $form->textField($model,'scre_other');
         }
         ?>
         <br />
         <br />
         <?php 
         echo $form->labelEx($model,'scre_status');          
         echo $form->dropDownList($model,'scre_status',array('ACTIVE' => 'ACTIVE' 
    	   						, 'WD' => 'WD'
    	    					, 'DNF' => 'DNF'
    	    					, 'DNS' => 'DNS'),
    	    					array('style'=>'width:100px;'));
         ?>
    </div>
	<br />
	<br />
    <div class="row buttons">    
        <input type="submit" value="Save" class="btn btn-primary">
        <a href="" class="btn">Cancel</a>
        
    </div>
 
<?php $this->endWidget(); ?>
 
</div>