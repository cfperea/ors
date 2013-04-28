<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('Actividades'=>array('index'), 'Administrar actividades'),
));

$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>'Listar actividades', 'url'=>array('index')),
		array('label'=>'Crear actividad', 'url'=>array('create')),
		))
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#activity-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Activities</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activity-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'creationDate',
		'startDate',
		'endDate',
		'leader',
		/*
		'activityType',
		'budget',
		'description',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
