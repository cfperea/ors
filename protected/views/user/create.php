<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>'Listar usuarios', 'url'=>array('index')),
		array('label'=>Yii::t('app','Administrar usuarios'), 'url'=>array('admin')),
		))
	);
}
?>

<h1>Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
