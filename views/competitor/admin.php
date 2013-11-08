<?php
$this->breadcrumbs=array(
	'Competitors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Competitor', 'url'=>array('index')),
	array('label'=>'Create Competitor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('competitor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Competitors (RX)</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'competitor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'comp_id',
		'comp_name',
		'comp_event1',
		'comp_event2',
		'comp_event3',
		'comp_event4',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
