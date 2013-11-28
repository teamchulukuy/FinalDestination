<h2>Viewing #<?php echo $landmarkphoto->id; ?></h2>

<p>
	<strong>Filename:</strong>
	<?php echo $landmarkphoto->filename; ?></p>
<p>
	<strong>Size:</strong>
	<?php echo $landmarkphoto->size; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $landmarkphoto->type; ?></p>
<p>
	<strong>Fileurl:</strong>
	<?php echo $landmarkphoto->fileurl; ?></p>
<p>
	<strong>Landmarkid:</strong>
	<?php echo $landmarkphoto->landmarkid; ?></p>

<?php echo Html::anchor('admin/landmarkphotos/edit/'.$landmarkphoto->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/landmarkphotos', 'Back'); ?>