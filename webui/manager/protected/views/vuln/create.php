<?php
$this->breadcrumbs=array(
	'Vulns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Vuln', 'url'=>array('index')),
	array('label'=>'Manage Vuln', 'url'=>array('admin')),
);
?>

<h1>Create Vuln</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>