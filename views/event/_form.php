<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_id'); ?>
		<?php echo $form->textField($model,'reg_id'); ?>
		<?php echo $form->error($model,'reg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evnt_name'); ?>
		<?php echo $form->textField($model,'evnt_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'evnt_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evnt_type'); ?>
		<?php echo $form->textField($model,'evnt_type',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'evnt_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->