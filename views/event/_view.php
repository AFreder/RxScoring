<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('evnt_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->evnt_id), array('view', 'id'=>$data->evnt_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_id')); ?>:</b>
	<?php echo CHtml::encode($data->reg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evnt_name')); ?>:</b>
	<?php echo CHtml::encode($data->evnt_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evnt_type')); ?>:</b>
	<?php echo CHtml::encode($data->evnt_type); ?>
	<br />


</div>