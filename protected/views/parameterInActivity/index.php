<?php
/* @var $this ParameterInActivityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Parameter In Activities',
);

if (Yii::app()->user->isAdmin())
{
	$this->menu=array(
		array('label'=>'Create ParameterInActivity', 'url'=>array('create')),
		array('label'=>'Manage ParameterInActivity', 'url'=>array('admin')),
	);
}
?>

<h1>Parameter In Activities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
