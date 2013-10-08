<?php
$this->breadcrumbs=array(
	'Arphistories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Arphistory', 'url'=>array('index')),
	array('label'=>'Manage Arphistory', 'url'=>array('admin')),
);
?>

<h1>Create Arphistory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>