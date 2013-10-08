<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hint-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'usertype'); ?>
    <?php echo CHtml::activeDropDownList( $model,'usertype',$model->enumItem($model, 'usertype') ); ?>
        <?php echo $form->error($model,'usertype'); ?>
    </div>

    <div class="row">
    <?php echo $form->labelEx($model,'category'); ?>
    <?php echo CHtml::activeDropDownList( $model,'category',$model->enumItem($model, 'category') ); ?>
    <?php echo $form->error($model,'category'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->