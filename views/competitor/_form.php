<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comp_name'); ?>
		<?php echo $form->textField($model,'comp_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'comp_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comp_event1'); ?>
		<?php echo $form->textField($model,'comp_event1'); ?>
		<?php echo $form->error($model,'comp_event1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comp_event2'); ?>
		<?php echo $form->textField($model,'comp_event2'); ?>
		<?php echo $form->error($model,'comp_event2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comp_event3'); ?>
		<?php echo $form->textField($model,'comp_event3'); ?>
		<?php echo $form->error($model,'comp_event3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comp_event4'); ?>
		<?php echo $form->textField($model,'comp_event4'); ?>
		<?php echo $form->error($model,'comp_event4'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->