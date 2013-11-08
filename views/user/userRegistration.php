<div class="hero-unit">
	 <h1>User Registration</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableAjaxValidation'=>false,
    //'enableClientValidation'=>true,
)); ?>

<br />
<br />
<?php 
	if($model->hasErrors())
	{
		echo '<div class="alert-error">
  			  <button class="close" data-dismiss="alert">x</button>' 
				. $form->errorSummary($model) .   
			  '</div><br>';
	}
?>
<div style="padding-left: 50px">
<div class="row">
    <?php echo $form->labelEx($model,'user_email')?>
    <?php $form->error($model,'user_email')?>
    <?php echo $form->textField($model,'user_email'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'user_password')?>
    <?php $form->error($model,'user_password')?>
    <?php echo $form->passwordField($model,'user_password'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'user_verify_password')?>
    <?php $form->error($model,'user_verify_password')?>
    <?php echo $form->passwordField($model,'user_verify_password'); ?>
</div>
<div class="row">    
    <?php echo $form->labelEx($model,'verifyCode'); ?>
  <div>
   <?php echo $form->textField($model,'verifyCode'); ?>
   <?php $this->widget('CCaptcha', array('buttonLabel'=>' refresh')); ?>   
   
  </div>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>
</div>
    <?php $this->endWidget(); ?>

