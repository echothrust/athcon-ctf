<?php
$this->breadcrumbs=array(
	'Tcpdumps',
);

$this->menu=array(
	array('label'=>'Create Tcpdump', 'url'=>array('create')),
	array('label'=>'Manage Tcpdump', 'url'=>array('admin')),
);
?>

<h1>Tcpdumps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
