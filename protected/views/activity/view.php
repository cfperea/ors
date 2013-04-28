<?php
/* @var $this ActivityController */
/* @var $model Activity */
/* @var $extraParameters Array of extra parameters (key, value) */

$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Activity', 'url'=>array('index')),
	array('label'=>'Create Activity', 'url'=>array('create')),
);

if (Yii::app()->user->checkAccess('member', array('activity'=>$model)))
{
	$this->menu[] = array('label'=>'Update Activity', 'url'=>array('update', 'id'=>$model->id));
}

if (Yii::app()->user->checkAccess('owner', array('activity'=>$model)))
{
	$this->menu[] = array('label'=>'Delete Activity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
	$this->menu[] = array('label'=>'Agregar Usuario', 'url'=>array('adduser', 'id'=>$model->id));
}

if (Yii::app()->user->isAdmin())
{
	$this->menu[] = array('label'=>'Manage Activities', 'url'=>array('admin'));
}

?>

<h1>View Activity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'creationDate',
		'startDate',
		'endDate',
		array(
                    'label' => 'Líder',
                    'value' => User::model()->findByPk($model->leader)->name
                ),
		'activityType',
		'budget',
		'description',
		),
)); 

if (count($extraParameters) > 0)
{
	// Creates a new table for the extra parameters
	echo '<table class="detail-view" id="yw1">';
	$parity = 'even';
	for ($i = 0; $i < count($extraParameters); $i++)
	{
		$keys = array_keys($extraParameters[$i]);
		echo '<tr class="'.$parity.'">';
		echo '<th>'.$keys[0].'</h>';
		echo '<td>'.$extraParameters[$i][$keys[0]].'</h>';
		echo '</tr>';
		($parity == 'odd' ? $parity = 'even' : $parity = 'odd');
	}
	echo '</table>';
}

?>
