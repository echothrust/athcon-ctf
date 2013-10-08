<?php
$this->breadcrumbs=array(
	'Hints'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Hint', 'url'=>array('index')),
	array('label'=>'Create Hint', 'url'=>array('create')),
	array('label'=>'Update Hint', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Hint', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Hint', 'url'=>array('admin')),
);
?>

<h1>View Hint #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
    'title',
    'usertype',
    'category',
		'message',
	),
)); ?>
