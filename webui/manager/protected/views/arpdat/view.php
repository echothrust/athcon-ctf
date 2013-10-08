<?php
$this->breadcrumbs=array(
	'Arpdats'=>array('index'),
	$model->mac,
);

$this->menu=array(
	array('label'=>'List Arpdat', 'url'=>array('index')),
	array('label'=>'Create Arpdat', 'url'=>array('create')),
	array('label'=>'Update Arpdat', 'url'=>array('update', 'id'=>$model->mac)),
	array('label'=>'Delete Arpdat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mac),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Arpdat', 'url'=>array('admin')),
);
?>

<h1>View Arpdat #<?php echo $model->mac; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mac',
    'IP',
		'ts',
	),
)); ?>
