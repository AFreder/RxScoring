<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_evt_nm'); ?>
		<?php echo $form->textField($model,'reg_evt_nm',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'reg_evt_nm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_evt_bgn_dt'); ?>
		<?php echo $form->textField($model,'reg_evt_bgn_dt'); ?>
		<?php echo $form->error($model,'reg_evt_bgn_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_evt_end_dt'); ?>
		<?php echo $form->textField($model,'reg_evt_end_dt'); ?>
		<?php echo $form->error($model,'reg_evt_end_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reg_evt_loc_addr'); ?>
		<?php echo $form->textField($model,'reg_evt_loc_addr',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'reg_evt_loc_addr'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->