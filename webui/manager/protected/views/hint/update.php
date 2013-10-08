<?php
$this->breadcrumbs=array(
	'Hints'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Hint', 'url'=>array('index')),
	array('label'=>'Create Hint', 'url'=>array('create')),
	array('label'=>'View Hint', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Hint', 'url'=>array('admin')),
);
?>

<h1>Update Hint <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>