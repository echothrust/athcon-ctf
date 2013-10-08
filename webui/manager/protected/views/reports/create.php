<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reports', 'url'=>array('index')),
	array('label'=>'Manage Reports', 'url'=>array('admin')),
);
?>

<h1>Create Reports</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>