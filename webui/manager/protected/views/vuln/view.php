<?php
$this->breadcrumbs=array(
	'Vulns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Vuln', 'url'=>array('index')),
	array('label'=>'Create Vuln', 'url'=>array('create')),
	array('label'=>'Update Vuln', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Vuln', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vuln', 'url'=>array('admin')),
);
?>

<h1>View Vuln #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'users_id',
		'subject',
		'server',
		'message',
		'ts',
	),
)); ?>
