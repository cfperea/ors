<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Actividades'=>array('index'), 'Crear actividad'),
));

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Listar actividades'), 'url'=>array('index')),
		array('label'=>'Administrar actividades', 'url'=>array('admin')),
		))
	);
}
else
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Listar actividades'), 'url'=>array('index')),
		))
	);
}
?>

<h1>Crear actividad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
