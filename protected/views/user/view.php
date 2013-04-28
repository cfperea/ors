<?php
/* @var $this UserController */
/* @var $model User */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Usuarios'=>array('index'), $model->name),
));

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
		'type' => 'tabs',
		'tabs' => array(
			array('label'=>'Listar usuarios', 'url'=>array('index')),
			array('label'=>Yii::t('app','Crear usuario'), 'url'=>array('create')),
			array('label'=>Yii::t('app','Actualizar usuario'), 'url'=>array('update', 'id'=>$model->id)),
			array('label'=>Yii::t('app','Borrar Usuario'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
			array('label'=>Yii::t('app','Administrar usuarios'), 'url'=>array('admin')),
			))
		);
}
?>

<h1><?php echo Yii::t('app','View User #') . $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		//'password',
		'isAdmin',
		'email',
		'faculty',
		'createTime',
		'lastLogin',
		'updateTime',
	),
)); ?>
