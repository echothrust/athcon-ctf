<?php
$this->breadcrumbs=array(
	'Vulns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vuln', 'url'=>array('index')),
	array('label'=>'Create Vuln', 'url'=>array('create')),
	array('label'=>'View Vuln', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Vuln', 'url'=>array('admin')),
);
?>

<h1>Update Vuln <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>