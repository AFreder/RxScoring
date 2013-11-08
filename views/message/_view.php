<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->msg_id), array('view', 'id'=>$data->msg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />


</div>