<?php
$this->breadcrumbs=array(
	'Arpdats'=>array('index'),
	$model->mac=>array('view','id'=>$model->mac),
	'Update',
);

$this->menu=array(
	array('label'=>'List Arpdat', 'url'=>array('index')),
	array('label'=>'Create Arpdat', 'url'=>array('create')),
	array('label'=>'View Arpdat', 'url'=>array('view', 'id'=>$model->mac)),
	array('label'=>'Manage Arpdat', 'url'=>array('admin')),
);
?>

<h1>Update Arpdat <?php echo $model->mac; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>