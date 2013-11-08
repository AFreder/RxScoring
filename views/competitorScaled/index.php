<?php
$this->breadcrumbs=array(
	'Competitor',
);

$this->menu=array(
	array('label'=>'Create Competitor', 'url'=>array('create')),
	array('label'=>'Manage Competitor', 'url'=>array('admin')),
);
?>

<h1>Competitors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
