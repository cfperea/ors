
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creationDate'); ?>
		<?php echo $form->textField($model,'creationDate'); ?>
		<?php echo $form->error($model,'creationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate'); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate'); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'leader'); ?>
		<?php echo $form->textField($model,'leader'); ?>
		<?php echo $form->error($model,'leader'); ?>
	</div>
	-->

	<div class="row">
		<?php echo $form->labelEx($model,'activityType'); ?>
		<?php echo $form->dropDownList($model,'activityType', $model->getActivityTypes(),
										array(
                                			'empty'=>'Selecciona un tipo de actividad',
                                			'ajax'=>array(                            
                                        		'type' => 'POST',
                                        		'url' => CController::createUrl('updateparameters'),
                                        		'data'=> array('activityType'=>'js:this.value'),   
												'update'=>'#otherParameters',                           
                                        		)   	
										)					
						); ?>
		<?php echo $form->error($model,'activityType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'budget'); ?>
		<?php echo $form->textField($model,'budget'); ?>
		<?php echo $form->error($model,'budget'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div id="otherParameters" class="row">
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
