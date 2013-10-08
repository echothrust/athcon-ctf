<?php
$this->breadcrumbs=array(
	'Arphistories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Arphistory', 'url'=>array('index')),
	array('label'=>'Create Arphistory', 'url'=>array('create')),
	array('label'=>'View Arphistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Arphistory', 'url'=>array('admin')),
);
?>

<h1>Update Arphistory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>