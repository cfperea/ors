<?php
/* @var $this ParameterOptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Parameter Options',
);

if (Yii::app()->user->isAdmin())
{
	$this->menu=array(
		array('label'=>'Create ParameterOption', 'url'=>array('create')),
		array('label'=>'Manage ParameterOption', 'url'=>array('admin')),
	);
}
?>

<h1>Parameter Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
