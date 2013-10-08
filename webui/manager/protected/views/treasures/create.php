<?php
$this->breadcrumbs=array(
	'Treasures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Treasures', 'url'=>array('index')),
	array('label'=>'Manage Treasures', 'url'=>array('admin')),
);
?>

<h1>Create Treasures</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>