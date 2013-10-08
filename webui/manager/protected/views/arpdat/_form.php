<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arpdat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mac'); ?>
		<?php echo $form->textField($model,'mac',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'mac'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IP'); ?>
		<?php echo $form->textField($model,'IP',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'IP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ts'); ?>
		<?php echo $form->textField($model,'ts'); ?>
		<?php echo $form->error($model,'ts'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->