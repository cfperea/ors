<?php
/* @var $this ParameterOptionController */
/* @var $model ParameterOption */

$this->breadcrumbs=array(
	'Parameter Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParameterOption', 'url'=>array('index')),
	array('label'=>'Manage ParameterOption', 'url'=>array('admin')),
);
?>

<h1>Create ParameterOption</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>