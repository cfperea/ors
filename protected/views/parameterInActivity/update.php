<?php
/* @var $this ParameterInActivityController */
/* @var $model ParameterInActivity */

$this->breadcrumbs=array(
	'Parameter In Activities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ParameterInActivity', 'url'=>array('index')),
	array('label'=>'Create ParameterInActivity', 'url'=>array('create')),
	array('label'=>'View ParameterInActivity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ParameterInActivity', 'url'=>array('admin')),
);
?>

<h1>Update ParameterInActivity <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>