<br />
<div class="offset2">
  <div class="row-fluid">
    <div class="span8">
		<div class="well">
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<legend><h2>User Login</h2></legend>
<br>
<br>
<div style="padding-left: 25px">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
)); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<div class="alert-error"><?php echo $form->error($model,'username'); ?></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<div class="alert-error"><?php echo $form->error($model,'password'); ?></div>
	</div>
	<br />
	<div class="row buttons">
		<input class="btn btn-primary" type="submit" value="Login">
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div></div></div>
</div>