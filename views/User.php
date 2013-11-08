<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-User-form',
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
		<?php echo $form->labelEx($model,'user_first_name'); ?>
		<?php echo $form->textField($model,'user_first_name'); ?>
		<?php echo $form->error($model,'user_first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_last_name'); ?>
		<?php echo $form->textField($model,'user_last_name'); ?>
		<?php echo $form->error($model,'user_last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_actv_in'); ?>
		<?php echo $form->textField($model,'user_actv_in'); ?>
		<?php echo $form->error($model,'user_actv_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_load_ts'); ?>
		<?php echo $form->textField($model,'user_load_ts'); ?>
		<?php echo $form->error($model,'user_load_ts'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->