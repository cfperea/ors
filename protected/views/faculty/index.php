<?php
/* @var $this FacultyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Faculties',
);

if (Yii::app()->user->isAdmin())
{
	$this->menu=array(
		array('label'=>'Create Faculty', 'url'=>array('create')),
		array('label'=>'Manage Faculty', 'url'=>array('admin')),
	);
}
?>

<h1>Faculties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
