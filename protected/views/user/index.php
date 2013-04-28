<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Usuarios'),
));

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Crear usuario'), 'url'=>array('create')),
		array('label'=>Yii::t('app','Administrar usuarios'), 'url'=>array('admin')),
		))
	);
}
?>

<h1>Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
