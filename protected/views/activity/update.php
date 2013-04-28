<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Actividades'=>array('index'), $model->name=>array('view','id'=>$model->id),'Actualizar'),
));

if (Yii::app()->user->checkAccess('owner', array('activity'=>$model)) || Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Listar actividades'), 'url'=>array('index')),
		array('label'=>'Crear actividad', 'url'=>array('create')),
		array('label'=>Yii::t('app','Ver actividad'), 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>Yii::t('app','Borrar actividad'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Estás seguro de borrar esta actividad?')),
		array('label'=>'Agregar usuario', 'url'=>array('adduser', 'id'=>$model->id))
		))
	);
}
elseif (Yii::app()->user->checkAccess('member', array('activity'=>$model)))
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Listar actividades'), 'url'=>array('index')),
		array('label'=>'Crear actividad', 'url'=>array('create')),
		array('label'=>Yii::t('app','Ver actividad'), 'url'=>array('view', 'id'=>$model->id))
		))
	);
}
?>

<h1>Update Activity <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
