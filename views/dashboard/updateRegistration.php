<br>
<div class="offset2">
  <div class="row-fluid">
    <div class="span8">
		<div class="well">
		<div class="form">
  			<fieldset>
    			<legend><h2>Update Event Info</h2></legend>
    		</fieldset>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>false,
)); ?>
  <div class="control-group">
    <?php echo $form->labelEx($model, 'reg_evt_nm'); ?>
	<?php echo $form->textField($model, 'reg_evt_nm'); ?><br><br>
      		
    <?php echo $form->labelEx($model,'reg_evt_bgn_dt'); ?>    
    <?php $form->error($model,'reg_evt_bgn_dt'); ?>
    <?php
    Yii::import('application.extensions.CJuiDatePicker.CJuiDatePicker');
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,   // model object
        'attribute'=>'reg_evt_bgn_dt',
        'value'=>$model->reg_evt_bgn_dt,
        'options'=>array('autoSize'=>true,
            'dateFormat'=>'yy-mm-dd',
            'defaultDate'=>$model->reg_evt_bgn_dt,
            'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
            'buttonImageOnly'=>true,
            'buttonText'=>'Select',
            'showAnim'=>'fold',
            'showOn'=>'button',
            'showButtonPanel'=>true,
            'yearRange'=>'2012',
         	'htmlOptions'=>array(
                'readOnly'=>true
            ),
        ),
        'language'=>'en-AU',
    ));
    ?><br><br>
    <?php echo $form->labelEx($model,'reg_evt_end_dt'); ?>
    <?php $form->error($model,'reg_evt_end_dt'); ?>
    <?php
    Yii::import('application.extensions.CJuiDatePicker.CJuiDatePicker');
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,   // model object
        'attribute'=>'reg_evt_end_dt',
        'value'=>$model->reg_evt_end_dt,
        'options'=>array('autoSize'=>true,
            'dateFormat'=>'yy-mm-dd',
            'defaultDate'=>$model->reg_evt_end_dt,
            'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
            'buttonImageOnly'=>true,
            'buttonText'=>'Select',
            'showAnim'=>'fold',
            'showOn'=>'button',
            'showButtonPanel'=>true,
            'yearRange'=>'2012',
            'htmlOptions'=>array('readonly'=>"readonly"),
        ),
        'language'=>'en-AU',
    ));
    ?>  <br><br>     		
	<?php echo $form->labelEx($model,'reg_scre_type'); ?>
  	<table style="margin-left:20px">
  		<tr>  			
  			<td><input type="radio" name="Registration[reg_scre_type]" id="optionsRadios2" value="REGIONALS" <?php if($model->reg_scre_type == 'REGIONALS') echo 'checked';?>> Regionals-Style</td>

  			<td><input style="margin-left:25px" type="radio" name="Registration[reg_scre_type]" id="optionsRadios1" value="GAMES" <?php if($model->reg_scre_type == 'GAMES') echo 'checked';?>> Games-Style</td>
		</tr>
	</table>
	<br><br>
    <?php echo '<input type="Submit" value="Save" class="btn btn-primary">';?>
    <?php echo '<a class="btn" href="/index.php">Cancel</a>';?>

	<script>
        $('#Registration_reg_evt_end_dt').attr('readonly', true);
        $("#Registration_reg_evt_end_dt").css({"background-color": "white"});
        $('#Registration_reg_evt_bgn_dt').attr('readonly', true);
        $("#Registration_reg_evt_bgn_dt").css({"background-color": "white"});

    </script>	
		
		
		</div>		
		</div>
    </div>
    <div class="span9">      

<?php $this->endWidget(); ?>


<br>
<br>
<br>
</div>
</div>
</div>
</div>