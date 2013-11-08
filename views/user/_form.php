<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_id'); ?>
		<?php echo $form->textField($model,'reg_id'); ?>
		<?php echo $form->error($model,'reg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_password'); ?>
		<?php echo $form->textField($model,'user_password',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'user_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aud_load_ts'); ?>
		<?php echo $form->textField($model,'aud_load_ts'); ?>
		<?php echo $form->error($model,'aud_load_ts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dacl_actv_in'); ?>
		<?php echo $form->textField($model,'dacl_actv_in',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'dacl_actv_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_class'); ?>
		<?php echo $form->textField($model,'user_class',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'user_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_verify_password'); ?>
		<?php echo $form->textField($model,'user_verify_password',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'user_verify_password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->