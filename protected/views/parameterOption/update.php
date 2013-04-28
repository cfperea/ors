<?php
/* @var $this ParameterOptionController */
/* @var $model ParameterOption */

$this->breadcrumbs=array(
	'Parameter Options'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ParameterOption', 'url'=>array('index')),
	array('label'=>'Create ParameterOption', 'url'=>array('create')),
	array('label'=>'View ParameterOption', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ParameterOption', 'url'=>array('admin')),
);
?>

<h1>Update ParameterOption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>