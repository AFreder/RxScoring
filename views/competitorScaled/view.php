<?php
$this->breadcrumbs=array(
	'Competitor'=>array('index'),
	$model->comp_id,
);

$this->menu=array(
	array('label'=>'List Competitor', 'url'=>array('index')),
	array('label'=>'Create Competitor', 'url'=>array('create')),
	array('label'=>'Update Competitor', 'url'=>array('update', 'id'=>$model->comp_id)),
	array('label'=>'Delete Competitor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->comp_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competitor', 'url'=>array('admin')),
);
?>

<h1>View CompetitorScaled #<?php echo $model->comp_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'comp_id',
		'comp_name',
		'comp_event1',
		'comp_event2',
		'comp_event3',
		'comp_event4',
	),
)); ?>
