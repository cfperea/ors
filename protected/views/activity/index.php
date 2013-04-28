<?php
/* @var $this ActivityController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Actividades'),
));

$this->menu=array(
	array('label'=>'Crear actividad', 'url'=>array('create')),
	
);

if (Yii::app()->user->isAdmin())
{
	$this->menu[] = array('label'=>'Administrar actividades', 'url'=>array('admin'));
}

?>

<h1>Activities</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
