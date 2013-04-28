<?php
/* @var $this ParameterInActivityController */
/* @var $model ParameterInActivity */

$this->breadcrumbs=array(
	'Parameter In Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ParameterInActivity', 'url'=>array('index')),
	array('label'=>'Create ParameterInActivity', 'url'=>array('create')),
	array('label'=>'Update ParameterInActivity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ParameterInActivity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParameterInActivity', 'url'=>array('admin')),
);
?>

<h1>View ParameterInActivity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parameter',
		'activityType',
	),
)); ?>
