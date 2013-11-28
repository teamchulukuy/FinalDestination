
<?php if ($landmarkphotos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Filename</th>
			<th>Size</th>
			<th>Type</th>
			<th>Fileurl</th>
			<th>Landmarkid</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($landmarkphotos as $landmarkphoto): ?>		<tr>

			<td><?php echo $landmarkphoto->filename; ?></td>
			<td><?php echo $landmarkphoto->size; ?></td>
			<td><?php echo $landmarkphoto->type; ?></td>
			<td><?php echo $landmarkphoto->fileurl; ?></td>
			<td><?php echo $landmarkphoto->landmarkid; ?></td>
			<td>
				<?php echo Html::anchor('admin/landmarkphotos/view/'.$landmarkphoto->id, 'View'); ?> |
				<?php echo Html::anchor('admin/landmarkphotos/edit/'.$landmarkphoto->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/landmarkphotos/delete/'.$landmarkphoto->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<div id="paginate" style="float:right"></div><br><br>      
<div id="status" style="float:right; margin-right:-150px"></div> 

<?php else: ?>
<p>No Landmarkphotos.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/landmarkphotos/create', 'Add new Landmarkphoto', array('class' => 'btn btn-success')); ?>

</p>
