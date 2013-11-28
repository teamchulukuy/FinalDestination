<?php echo Html::img('assets/img/frame-top.png', array('class' => 'frame-top')) ?>

<h3 style="margin-left:15px;">Jeepney Routes</h3>

<br>
<?php if ($jeepneyroutes): ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover display" id="example" width="100%" >
	<thead>
		<tr>
			<th>Route Name</th>
			<th>Size</th>
			<th>Type</th>
			<th>Route Description</th>
			<th>Uploaded at</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($jeepneyroutes as $jeepneyroute): ?>		<tr>

			<td><?php echo Html::anchor('users/jeepneyroute/view/'.$jeepneyroute->id,$jeepneyroute->routename); ?></td>
			<td><?php echo $jeepneyroute->size." "."KB"; ?></td>
			<td><?php echo $jeepneyroute->type; ?></td>
			<td><?php echo $jeepneyroute->routedesc; ?></td>
			<td><?php echo $jeepneyroute->created_at; ?></td>
			<td>
				<?php echo Html::anchor('users/jeepneyroute/view/'.$jeepneyroute->id, '<i class="icon-eye-open" title="View"></i>'); ?> |
				<?php echo Html::anchor('users/jeepneyroute/download/'.$jeepneyroute->id, '<i class="icon-download" title="Download"></i>'); ?>
				
			</td>
		</tr>
<?php endforeach; ?>	</tbody>

<tfoot>
		<tr>
			<th>Route Name</th>
			<th>Size</th>
			<th>Type</th>
			<th>Route Description</th>
			<th>Uploaded at</th>
			<th>Action</th>
		</tr>
	</tfoot>

	
</table>

<div id="paginate" style="float:right"></div><br><br>      
<div id="status" style="float:right; margin-right:50px"></div> 


<?php else: ?>
<p>No Jeepneyroutes.</p>

<?php endif; ?>

