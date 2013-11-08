<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'evnt_id'); ?>
		<?php echo $form->textField($model,'evnt_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reg_id'); ?>
		<?php echo $form->textField($model,'reg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evnt_name'); ?>
		<?php echo $form->textField($model,'evnt_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evnt_type'); ?>
		<?php echo $form->textField($model,'evnt_type',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->