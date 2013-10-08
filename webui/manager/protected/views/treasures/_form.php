<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'treasures-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pubname'); ?>
        <?php echo $form->textField($model,'pubname',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'pubname'); ?>
    </div>

    <div class="row">
        <b><?php echo $model->randHASH();?></b>
        <?php echo $form->labelEx($model,'code'); ?>
        <?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'points'); ?>
		<?php echo $form->textField($model,'points',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'points'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
    <?php echo CHtml::activeDropDownList( $model,'category',$model->enumItem($model, 'category') ); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'csum'); ?>
		<?php echo $form->textField($model,'csum',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'csum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'appears'); ?>
		<?php echo $form->textField($model,'appears'); ?>
		<?php echo $form->error($model,'appears'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'effects'); ?>
    <?php echo CHtml::activeDropDownList( $model,'effects',$model->enumItem($model, 'effects') ); ?>
		<?php echo $form->error($model,'effects'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->