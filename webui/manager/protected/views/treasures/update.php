<?php
$this->breadcrumbs=array(
	'Treasures'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Treasures', 'url'=>array('index')),
	array('label'=>'Create Treasures', 'url'=>array('create')),
	array('label'=>'View Treasures', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Treasures', 'url'=>array('admin')),
);
?>

<h1>Update Treasures <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>