<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name." | Pontificia Universidad Javeriana, Cali";
?>

<div id="promo-box">
<h3>Desde cualquier lugar puedes:</h3>
<ul>
<li><b>Administrar</b> tus actividades.</li>
<li><b>Compartir</b> tus actividades y proyectos.</li>
<li><b>Descubrir</b> actividades de tu interes.</li>
<li><b>Colaborar</b> con tus pares.</li>
</ul>
</div><!-- promo box -->


<div id="login-box">

<h1>Conéctate</h1>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'action' => $this->createUrl( 'site/login' ),
	),
)); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
	</div>

	<div class="row">
		<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Conectarse')); ?>
	</div>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

<?php $this->endWidget(); ?>
</div><!-- form -->

</div><!-- login-box>
