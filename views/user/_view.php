<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_id')); ?>:</b>
	<?php echo CHtml::encode($data->reg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_password')); ?>:</b>
	<?php echo CHtml::encode($data->user_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aud_load_ts')); ?>:</b>
	<?php echo CHtml::encode($data->aud_load_ts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dacl_actv_in')); ?>:</b>
	<?php echo CHtml::encode($data->dacl_actv_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_class')); ?>:</b>
	<?php echo CHtml::encode($data->user_class); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_verify_password')); ?>:</b>
	<?php echo CHtml::encode($data->user_verify_password); ?>
	<br />

	*/ ?>

</div>