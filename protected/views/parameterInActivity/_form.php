<?php
/* @var $this ParameterInActivityController */
/* @var $model ParameterInActivity */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parameter-in-activity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parameter'); ?>
		<?php echo $form->dropDownList($model,'parameter', $model->getParameters()); ?>
		<?php echo $form->error($model,'parameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activityType'); ?>
		<?php echo $form->dropDownList($model,'activityType', $model->getActivityTypes()); ?>
		<?php echo $form->error($model,'activityType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
