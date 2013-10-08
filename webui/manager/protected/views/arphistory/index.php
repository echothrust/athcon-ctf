<?php
$this->breadcrumbs=array(
	'Arphistories',
);

$this->menu=array(
	array('label'=>'Create Arphistory', 'url'=>array('create')),
	array('label'=>'Manage Arphistory', 'url'=>array('admin')),
);
?>

<h1>Arphistories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
