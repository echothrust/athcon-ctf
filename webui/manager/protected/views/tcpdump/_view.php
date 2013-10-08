<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('srchw')); ?>:</b>
	<?php echo CHtml::encode($data->srchw); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proto')); ?>:</b>
	<?php echo CHtml::encode($data->proto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('srcip')); ?>:</b>
	<?php echo CHtml::encode($data->srcip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dstip')); ?>:</b>
	<?php echo CHtml::encode($data->dstip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dstport')); ?>:</b>
	<?php echo CHtml::encode($data->dstport); ?>
	<br />


</div>