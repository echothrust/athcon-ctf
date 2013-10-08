<?php
$this->breadcrumbs=array(
	'Treasures',
);

$this->menu=array(
	array('label'=>'Create Treasures', 'url'=>array('create')),
	array('label'=>'Manage Treasures', 'url'=>array('admin')),
);
?>

<h1>Treasures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
