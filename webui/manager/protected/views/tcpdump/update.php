<?php
$this->breadcrumbs=array(
	'Tcpdumps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tcpdump', 'url'=>array('index')),
	array('label'=>'Create Tcpdump', 'url'=>array('create')),
	array('label'=>'View Tcpdump', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tcpdump', 'url'=>array('admin')),
);
?>

<h1>Update Tcpdump <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>