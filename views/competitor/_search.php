<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'comp_id'); ?>
		<?php echo $form->textField($model,'comp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_name'); ?>
		<?php echo $form->textField($model,'comp_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_event1'); ?>
		<?php echo $form->textField($model,'comp_event1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_event2'); ?>
		<?php echo $form->textField($model,'comp_event2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_event3'); ?>
		<?php echo $form->textField($model,'comp_event3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comp_event4'); ?>
		<?php echo $form->textField($model,'comp_event4'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->