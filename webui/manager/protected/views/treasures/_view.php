<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('pubname')); ?>:</b>
    <?php echo CHtml::encode($data->pubname); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
    <?php echo CHtml::encode($data->code); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
	<?php echo CHtml::encode($data->points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('csum')); ?>:</b>
	<?php echo CHtml::encode($data->csum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appears')); ?>:</b>
	<?php echo CHtml::encode($data->appears); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('effects')); ?>:</b>
	<?php echo CHtml::encode($data->effects); ?>
	<br />

</div>