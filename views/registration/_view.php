<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->reg_id), array('view', 'id'=>$data->reg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_evt_nm')); ?>:</b>
	<?php echo CHtml::encode($data->reg_evt_nm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_evt_bgn_dt')); ?>:</b>
	<?php echo CHtml::encode($data->reg_evt_bgn_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_evt_end_dt')); ?>:</b>
	<?php echo CHtml::encode($data->reg_evt_end_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_evt_loc_addr')); ?>:</b>
	<?php echo CHtml::encode($data->reg_evt_loc_addr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aud_load_ts')); ?>:</b>
	<?php echo CHtml::encode($data->aud_load_ts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dacl_actv_in')); ?>:</b>
	<?php echo CHtml::encode($data->dacl_actv_in); ?>
	<br />


</div>