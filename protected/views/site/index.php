<?php
/* @var $this SiteController 
   @var $recentActivities Activity[] : The most recent activities in the system
   @var $memberActivities Activity[] : The activities that this user is member of
*/

$this->pageTitle=Yii::app()->name." | Pontificia Universidad Javeriana, Cali";
?>

<div class="page-header">
	  <h1>SIMARS | <small>Pontificia Universidad Javeriana, Cali</small></h1>
</div>

<?php if (!Yii::app()->user->isGuest): ?>

<?php $this->widget('bootstrap.widgets.TbBox', array(
    'title' => 'Bienvenido',
    'headerIcon' => 'icon-home',
    'content' => 'Hola '. Yii::app()->user->name .', tu &uacute;ltima sesi&oacute;n fue en '.strftime("%d/%m/%Y a las %I:%M:%S %P", Yii::app()->user->lastLogin)
)); ?>

<p>
	<?php /* Check whether the user is an administrator */ ?>
	<?php if (Yii::app()->user->isAdmin() == 1): ?>
	
	<h3>Actividades más recientes</h3>
	<?php 
		$recentActivitiesDataProvider = new CArrayDataProvider($recentActivities);
		// $gridColumns
		$gridColumns = array(
			array('name'=>'name', 'header'=>'Nombre'),
			array('name'=>'leader', 'header'=>'Líder'),
			array('name'=>'creationDate', 'header'=>'Fecha de creación'),
			array(
				'htmlOptions' => array('nowrap'=>'nowrap'),
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'viewButtonUrl'=>'Yii::app()->createUrl("activity/view", array("id"=>$data->id))',
				'updateButtonUrl'=>'Yii::app()->createUrl("activity/update", array("id"=>$data->id))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("activity/delete", array("id"=>$data->id))',
			)
		);
		$this->widget('bootstrap.widgets.TbGridView', array(
			'type'=>'bordered',
			'dataProvider'=>$recentActivitiesDataProvider,
			'template'=>"{items}",
			'columns'=>$gridColumns,
		));

		$this->widget('bootstrap.widgets.TbButton',array(
			'label' => 'Ver todas las actividades',
			'size' => 'large',
			'url' => array('activity/'),
		));
	?>

	<h3>Administrar</h3>
	<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'type'=>'tabs',
		'stacked'=>true,
		'tabs'=>array(
			array('label'=>'Usuarios', 'url'=>array('user/')),
			array('label'=>'Actividades', 'url'=>array('activity/')),
			array('label'=>'Tipos de actividad', 'url'=>array('activityType/')),
			array('label'=>'Parametros', 'url'=>array('parameter/')),
			array('label'=>'Valores de parametros', 'url'=>array('parameterOption/')),
			array('label'=>'Asignar parametro a actividad', 'url'=>array('parameterInActivity/')),
			array('label'=>'Facultades', 'url'=>array('faculty/')),
		),
	));
	?>

	<?php else: ?>
		
		<h3>Mis actividades más recientes</h3>
		<?php 
			$memberDataProvider = new CArrayDataProvider($memberActivities);
			// $gridColumns
			$gridColumns = array(
				array('name'=>'name', 'header'=>'Nombre'),
				array('name'=>'creationDate', 'header'=>'Fecha de creación'),
				array(
					'htmlOptions' => array('nowrap'=>'nowrap'),
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'viewButtonUrl'=>'Yii::app()->createUrl("activity/view", array("id"=>$data->id))',
					'updateButtonUrl'=>'Yii::app()->createUrl("activity/update", array("id"=>$data->id))',
					'deleteButtonUrl'=>'Yii::app()->createUrl("activity/delete", array("id"=>$data->id))',
				)
			);
			$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'bordered',
				'dataProvider'=>$memberDataProvider,
				'template'=>"{items}",
				'columns'=>$gridColumns,
			));

			$this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Ver todas mis actividades',
				'size' => 'large',
				'url' => null,
			));
		?>

		<h3>Administrar</h3>
		<?php $this->widget('bootstrap.widgets.TbTabs', array(
			'type'=>'tabs',
			'stacked'=>true,
			'tabs'=>array(
				array('label'=>'Mis actividades', 'url'=>null),
				array('label'=>'Mi perfil', 'url'=>array('user/update/id/'.Yii::app()->user->getId())),
			),
		));
		?>

	<?php endif; ?>
</p>
<?php else: ?>

	<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
	'heading'=>'Administra tus actividades!',
	)); ?>
	 
		<p>SIMARS hace la tarea de administrar tus proyectos de responsabilidad social más fácil.</p>
		<p>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'size'=>'large',
			'label'=>'¿Quiénes somos?',
			'url'=>array('/site/page', 'view'=>'about')
			)); ?>
		</p>
	 
	<?php $this->endWidget(); ?>

	<?php $this->beginWidget('bootstrap.widgets.TbBox', array(
    	'title' => 'Conéctate',
    	'headerIcon' => 'icon-home',
	));
	$this->renderPartial('login', array('model'=>$loginForm));
	$this->endWidget();
	?>	

	
<?php endif; ?>
