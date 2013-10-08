<?php
$this->breadcrumbs=array(
	'Tcpdumps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tcpdump', 'url'=>array('index')),
	array('label'=>'Manage Tcpdump', 'url'=>array('admin')),
);
?>

<h1>Create Tcpdump</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>