<?php
$this->breadcrumbs=array(
	'Vulns',
);

$this->menu=array(
	array('label'=>'Create Vuln', 'url'=>array('create')),
	array('label'=>'Manage Vuln', 'url'=>array('admin')),
);
?>

<h1>Vulns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
