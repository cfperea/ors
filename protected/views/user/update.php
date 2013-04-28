<?php
/* @var $this UserController */
/* @var $model User */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Usuarios'=>array('index'), $model->name=>array('view','id'=>$model->id), 'Actualizar'),
));

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
		'type' => 'tabs',
		'tabs' => array(
			array('label'=>'Listar usuarios', 'url'=>array('index')),
			array('label'=>Yii::t('app','Crear usuario'), 'url'=>array('create')),
			array('label'=>Yii::t('app','Ver usuario'),'url'=>array('view', 'id'=>$model->id)),
			array('label'=>Yii::t('app','Borrar Usuario'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
			array('label'=>Yii::t('app','Administrar usuarios'), 'url'=>array('admin')),
			))
		);
}
?>

<h1>Update User <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
