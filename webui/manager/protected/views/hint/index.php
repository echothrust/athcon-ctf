<?php
$this->breadcrumbs=array(
	'Hints',
);

$this->menu=array(
	array('label'=>'Create Hint', 'url'=>array('create')),
	array('label'=>'Manage Hint', 'url'=>array('admin')),
);
?>

<h1>Hints</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
