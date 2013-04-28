<?php
/* @var $this ActivityController */
/* @var $model Activity */
/* @var $form CActiveForm */
?>

<?php /* Javascript code for getting the extra parameters if an activity type is selected */ ?>
<script type="text/javascript">

$(document).ready(function() {

	var id = <?php echo $model->id ?>;
	var selectedTypeList = document.getElementById("Activity_activityType");

	$.ajax({
        type: 'POST',
        data: {activityId: id, activityType: selectedTypeList.options[selectedTypeList.selectedIndex].value},
        url: '<?php echo CController::createUrl("updateparameters"); ?>',
        success: function(data){
                    $('#otherParameters').html(data);
					updateExtraParameterValues();
                }
    })

});

// Updates the extra parameters to the saved values for this activity
function updateExtraParameterValues()
{
	<?php
		if ($model->id)
		{
			// Get the saved parameter options for this activity
			$activityParameterOptions = ActivityParameterOption::model()->findAllBySql('select * from tbl_activityParameterOption where activity = '.strval($model->id));
			// For each activity parameter option show the saved value
			foreach ($activityParameterOptions as $activityParameterOption)
			{
				$parameterOption = ParameterOption::model()->findByPk($activityParameterOption->parameterOption);
				$parameter = Parameter::model()->findByPk($parameterOption->parameter);
				echo "updateSelectedValue('Activity_".$parameter->name."','".$parameterOption->id."');\n";
			}
		}
		else
			echo "\n";
	?>
}

// Updates a single parameter to the specified value
function updateSelectedValue(listName, value)
{
	var list = document.getElementById(listName);
	
	var opts = list.options.length;
	for (var i = 0; i < opts; i++)
	{ 
		if (list.options[i].value == value)
		{
			list.options[i].selected = true;
			break;
		}
	}
}

</script>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'activity-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<p class="note">Campos con <span class="required">*</span> con obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model, 'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->datepickerRow($model, 'creationDate', array('prepend'=>'<i class="icon-calendar"></i>')); ?>
		<?php echo $form->error($model,'creationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->datepickerRow($model, 'startDate', array('prepend'=>'<i class="icon-calendar"></i>')); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->datepickerRow($model, 'endDate', array('prepend'=>'<i class="icon-calendar"></i>')); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->dropDownListRow($model, 'activityType', $model->getActivityTypes(),
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
		<?php echo $form->textFieldRow($model, 'budget', array('append'=>'.00')); ?>
		<?php echo $form->error($model,'budget'); ?>
	</div>

	<div class="row">
		<?php echo $form->textAreaRow($model,'description', array('class'=>'span8', 'rows'=>5)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div id="otherParameters" class="row">
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
