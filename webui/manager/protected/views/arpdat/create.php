<?php
$this->breadcrumbs=array(
	'Arpdats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Arpdat', 'url'=>array('index')),
	array('label'=>'Manage Arpdat', 'url'=>array('admin')),
);
?>

<h1>Create Arpdat</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>