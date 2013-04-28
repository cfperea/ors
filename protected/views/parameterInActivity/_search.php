<?php
/* @var $this ParameterInActivityController */
/* @var $model ParameterInActivity */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parameter'); ?>
		<?php echo $form->textField($model,'parameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activityType'); ?>
		<?php echo $form->textField($model,'activityType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->