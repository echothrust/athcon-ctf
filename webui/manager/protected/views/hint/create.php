<?php
$this->breadcrumbs=array(
	'Hints'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hint', 'url'=>array('index')),
	array('label'=>'Manage Hint', 'url'=>array('admin')),
);
?>

<h1>Create Hint</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>