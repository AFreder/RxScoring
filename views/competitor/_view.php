<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comp_id), array('view', 'id'=>$data->comp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_name')); ?>:</b>
	<?php echo CHtml::encode($data->comp_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_event1')); ?>:</b>
	<?php echo CHtml::encode($data->comp_event1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_event2')); ?>:</b>
	<?php echo CHtml::encode($data->comp_event2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_event3')); ?>:</b>
	<?php echo CHtml::encode($data->comp_event3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_event4')); ?>:</b>
	<?php echo CHtml::encode($data->comp_event4); ?>
	<br />


</div>