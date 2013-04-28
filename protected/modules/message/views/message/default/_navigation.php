<?php $this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'tabs' => array(
		array('label'=>'Bandeja de entrada', 'url'=>$this->createUrl('inbox/')),
		array('label'=>'Enviados', 'url'=>$this->createUrl('sent/sent')),
		array('label'=>'Escribir', 'url'=>$this->createUrl('compose/')),
		))
); ?>
<!--<ul class="actions">
	<li><a href="<?php echo $this->createUrl('inbox/') ?>">inbox
		<?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?>
	</a></li>
	<li><a href="<?php echo $this->createUrl('sent/sent') ?>">sent</a></li>
	<li><a href="<?php echo $this->createUrl('compose/') ?>">compose</a></li>
</ul>-->

<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
