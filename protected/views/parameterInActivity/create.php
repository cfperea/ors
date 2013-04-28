<?php
/* @var $this ParameterInActivityController */
/* @var $model ParameterInActivity */

$this->breadcrumbs=array(
	'Parameter In Activities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParameterInActivity', 'url'=>array('index')),
	array('label'=>'Manage ParameterInActivity', 'url'=>array('admin')),
);
?>

<h1>Create ParameterInActivity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>