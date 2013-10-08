<?php
$this->breadcrumbs=array(
	'Arpdats',
);

$this->menu=array(
	array('label'=>'Create Arpdat', 'url'=>array('create')),
	array('label'=>'Manage Arpdat', 'url'=>array('admin')),
);
?>

<h1>Arpdats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
