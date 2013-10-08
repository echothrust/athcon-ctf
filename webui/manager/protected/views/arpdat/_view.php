<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mac')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mac), array('view', 'id'=>$data->mac)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IP')); ?>:</b>
	<?php echo CHtml::encode($data->IP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ts')); ?>:</b>
	<?php echo CHtml::encode($data->ts); ?>
	<br />


</div>