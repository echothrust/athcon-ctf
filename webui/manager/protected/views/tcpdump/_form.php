<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tcpdump-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'srchw'); ?>
		<?php echo $form->textField($model,'srchw',array('size'=>17,'maxlength'=>17)); ?>
		<?php echo $form->error($model,'srchw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proto'); ?>
		<?php echo $form->textField($model,'proto',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'proto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'srcip'); ?>
		<?php echo $form->textField($model,'srcip',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'srcip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dstip'); ?>
		<?php echo $form->textField($model,'dstip',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dstip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dstport'); ?>
		<?php echo $form->textField($model,'dstport'); ?>
		<?php echo $form->error($model,'dstport'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->