<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:sent"); ?>
<?php
	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    		'links'=>array('Mensajes', 'Enviados'),
	));
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h2><?php echo MessageModule::t('Enviados'); ?></h2>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid">
		<tr>
			<th  class="label-message">Receptor</th>
			<th  class="label-message">Titulo</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr>
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getReceiverName() ?>
				</td>
				<td><a href="<?php echo $this->createUrl('/message/view?'.'message_id='.$message->id); ?>"><?php echo $message->subject ?></a></td>
				<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>

	<?php echo CHtml::submitButton(MessageModule::t("Borrar seleccionados")); ?>

	<?php $this->endWidget(); ?>

	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
