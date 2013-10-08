<?php
$this->breadcrumbs=array(
	'Tcpdumps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tcpdump', 'url'=>array('index')),
	array('label'=>'Create Tcpdump', 'url'=>array('create')),
	array('label'=>'Update Tcpdump', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tcpdump', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tcpdump', 'url'=>array('admin')),
);
?>

<h1>View Tcpdump #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'srchw',
		'size',
		'proto',
		'srcip',
		'dstip',
		'dstport',
	),
)); ?>
