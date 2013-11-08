
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-registration-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<br />
<br />

<?php echo $form->errorSummary($model);?>
<div class="row">
    <?php echo $form->labelEx($model,'user_email')?>
    <?php $form->error($model,'user_email')?>
    <?php echo $form->textField($model,'user_email'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'user_email')?>
    <?php $form->error($model,'user_email')?>
    <?php echo $form->textField($model,'user_email'); ?>
</div>
<div class="row">
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
    ?> 
</div>
<div class="row">
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
    ?>
    <script>
        $('#Registration_reg_evt_end_dt').attr('readonly', true);
        $("#Registration_reg_evt_end_dt").css({"background-color": "white"});
        $('#Registration_reg_evt_bgn_dt').attr('readonly', true);
        $("#Registration_reg_evt_bgn_dt").css({"background-color": "white"});

    </script>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'reg_evt_loc_addr'); ?>
    <?php echo $form->textField($model,'reg_evt_loc_addr'); ?>
    <?php $form->error($model,'reg_evt_loc_addr'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'reg_evt_loc_addr2'); ?>
    <?php echo $form->textField($model,'reg_evt_loc_addr2'); ?>
    <?php echo $form->error($model,'reg_evt_loc_addr2'); ?>
</div>
 
<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>
<?php $this->endWidget(); ?>

</div>