<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reports-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'reporter'); ?>
		<?php echo $form->textField($model,'reporter'); ?>
		<?php echo $form->error($model,'reporter'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'datentime'); ?>
        <?php echo $form->textField($model,'datentime',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'datentime'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attacker'); ?>
		<?php echo $form->textField($model,'attacker',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'attacker'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'server'); ?>
		<?php echo $form->textField($model,'server',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'server'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'abuse'); ?>
		<?php echo $form->textField($model,'abuse',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'abuse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logs'); ?>
		<?php echo $form->textArea($model,'logs',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'logs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resolved'); ?>
		<?php echo $form->textField($model,'resolved'); ?>
		<?php echo $form->error($model,'resolved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thru'); ?>
		<?php echo $form->textField($model,'thru',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'thru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

    <div class="row">
    <?php echo $form->labelEx($model,'treasure_id'); ?>
    <?php echo CHtml::activeDropDownList( $model,'treasure_id',$model->treasureItem(),array('empty' => '(Select an Achievement)') ); ?>
    <?php echo $form->error($model,'treasure_id'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'mac'); ?>
    <?php echo CHtml::activeDropDownList($model , 'mac', CHtml::listData($model->macItem(), 'mac', 'timestamp','IP'),array('empty' => '(Select an Entry)')); ?>
		<?php echo $form->error($model,'mac'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->