<?php
$this->pageTitle = Yii::app()->name . ' - Agregar usuario a actividad';

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array($model->activity->name => array('view', 'id' => $model->activity->id), 'Agregar usuario'),
));

$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>Yii::t('app','Listar actividades'), 'url'=>array('index')),
		array('label'=>'Crear actividad', 'url'=>array('create')),
		array('label'=>Yii::t('app','Ver actividad'), 'url'=>array('view', 'id'=>$model->activity->id)),
		array('label'=>Yii::t('app','Actualizar actividad'), 'url'=>array('update', 'id'=>$model->activity->id)),
		array('label'=>Yii::t('app','Borrar actividad'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->activity->id),'confirm'=>'¿Estás seguro de borrar esta actividad?'))
		))
	);
?>
<h1>Agregar usuario a <?php echo $model->activity->name; ?></h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
	<div class="successMessage">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'name',
			'data'=>$usernames,
			'multiple'=>false,
			'htmlOptions'=>array('size'=>25),
			)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'role'); ?>
		<?php echo $form->dropDownList($model, 'role', Activity::getUserRoleOptions()); ?>
		<?php echo $form->error($model, 'role'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Agregar usuario'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
