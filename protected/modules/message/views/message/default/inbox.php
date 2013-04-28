<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:inbox"); ?>
<?php

	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    		'links'=>array('Mensajes', 'Bandeja de entrada'),
	));
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h2><?php echo MessageModule::t('Bandeja de entrada'); ?></h2>

<div id="inbox-box">

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid">
		<tr>
			<th  class="label-message">De</th>
			<th  class="label-message">Asunto</th>
			<th  class="label-message">Fecha</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>">
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getSenderName(); ?>
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

</div>
