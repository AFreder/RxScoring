<?php
$this->breadcrumbs=array(
	'Competitors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Competitor', 'url'=>array('index')),
	array('label'=>'Manage Competitor', 'url'=>array('admin')),
);
?>

<h1>Create Competitor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>