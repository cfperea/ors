<?php
/* @var $this ParameterOptionController */
/* @var $model ParameterOption */

$this->breadcrumbs=array(
	'Parameter Options'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ParameterOption', 'url'=>array('index')),
	array('label'=>'Create ParameterOption', 'url'=>array('create')),
	array('label'=>'Update ParameterOption', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ParameterOption', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParameterOption', 'url'=>array('admin')),
);
?>

<h1>View ParameterOption #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parameter',
		'value',
	),
)); ?>
