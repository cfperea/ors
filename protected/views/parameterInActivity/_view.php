<?php
/* @var $this ParameterInActivityController */
/* @var $data ParameterInActivity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parameter')); ?>:</b>
	<?php echo CHtml::encode($data->parameter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activityType')); ?>:</b>
	<?php echo CHtml::encode($data->activityType); ?>
	<br />


</div>