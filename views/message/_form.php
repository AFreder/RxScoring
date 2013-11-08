<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,	
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<br>
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>250)); ?>		
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row buttons">
		<table style="width:25px">
			<tr>				
				<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
					<?php $this->endWidget(); ?>
					<?php $blankForm=$this->beginWidget('CActiveForm', array(
						'id'=>'message-form',
						'enableAjaxValidation'=>false,
						)); ?>
	    			<?php echo $form->hiddenField($model,'message'); ?>			
				<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Delete' : 'Save'); ?></td>
				<?php $this->endWidget(); ?>
			</tr>
		</table>
	</div>
	



</div><!-- form -->