<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	$model->reg_id=>array('view','id'=>$model->reg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Registration', 'url'=>array('index')),
	array('label'=>'Create Registration', 'url'=>array('create')),
	array('label'=>'View Registration', 'url'=>array('view', 'id'=>$model->reg_id)),
	array('label'=>'Manage Registration', 'url'=>array('admin')),
);
?>

<h1>Update Registration <?php echo $model->reg_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>