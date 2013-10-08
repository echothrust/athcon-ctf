<?php
$this->breadcrumbs=array(
	'Treasures'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Treasures', 'url'=>array('index')),
	array('label'=>'Create Treasures', 'url'=>array('create')),
	array('label'=>'Update Treasures', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Treasures', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Treasures', 'url'=>array('admin')),
);
?>

<h1>View Treasures #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'name',
        'pubname',
		'description',
		'points',
		'category',
		'csum',
		'appears',
    'effects',
    'code',
	),
)); ?>
