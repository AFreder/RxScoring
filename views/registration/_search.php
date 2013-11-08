<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'reg_id'); ?>
		<?php echo $form->textField($model,'reg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reg_evt_nm'); ?>
		<?php echo $form->textField($model,'reg_evt_nm',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reg_evt_bgn_dt'); ?>
		<?php echo $form->textField($model,'reg_evt_bgn_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reg_evt_end_dt'); ?>
		<?php echo $form->textField($model,'reg_evt_end_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reg_evt_loc_addr'); ?>
		<?php echo $form->textField($model,'reg_evt_loc_addr',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aud_load_ts'); ?>
		<?php echo $form->textField($model,'aud_load_ts'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dacl_actv_in'); ?>
		<?php echo $form->textField($model,'dacl_actv_in',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->