<?php
/* @var $this UserController */
/* @var $model User */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Usuarios'=>array('index'), 'Administrar'),
));

if (Yii::app()->user->isAdmin())
{
	$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>'Listar usuarios', 'url'=>array('index')),
		array('label'=>Yii::t('app','Crear usuario'), 'url'=>array('create'))
		))
	);
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar usuarios</h1>

<p>
Puedes opcionalmente utilizar los comparadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al comienzo de cada busqueda para especificar cómo se debe realizar la comparación.
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'password',
		'isAdmin',
		'email',
		'faculty',
		/*
		'createTime',
		'lastLogin',
		'updateTime',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
