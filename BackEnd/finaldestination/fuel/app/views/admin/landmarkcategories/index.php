<?php echo Html::img('assets/img/frame-top.png', array('class' => 'frame-top')) ?>

<h3 style="margin-left:15px;">Landmark Categories</h3>

<br>
<?php if ($landmarkcategories): ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover display" id="example" width="100%" >
	<thead>
		<tr>
			<th>Categories</th>
			<th>Category icon</th>
			<th>Pid</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($landmarkcategories as $landmarkcategory): ?>		<tr>

			<td><?php echo $landmarkcategory->categories; ?></td>
			<td><?php echo $landmarkcategory->category_icon; ?></td>
			<td><?php echo $landmarkcategory->pid; ?></td>
			<td>
				<?php echo Html::anchor('admin/landmarkcategories/view/'.$landmarkcategory->id, '<i class="icon-eye-open" title="View"></i>'); ?> |
				<?php echo Html::anchor('admin/landmarkcategories/edit/'.$landmarkcategory->id, '<i class="icon-wrench" title="Edit"></i>'); ?> |
				<?php echo Html::anchor('admin/landmarkcategories/delete/'.$landmarkcategory->id, '<i class="icon-trash" title="Delete"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>

<tfoot>
		<tr>
			<th>Categories</th>
			<th>Category icon</th>
			<th>Pid</th>
			<th>Action</th>
		</tr>
</tfoot>

</table>


<div id="paginate" style="float:right"></div><br><br>      
<div id="status" style="float:right; margin-right:50px"></div> 

<?php else: ?>
<p>No Landmarkcategories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('#inline_content', 'Add Category', array('class' => 'inline btn btn-success')); ?>

</p>



<!--ADD Landmark Categories using inline CSS!-->
<div style="display:none">
		<div id="inline_content">
			<h4>Add Landmark Category</h4>

			<?php echo Form::open(array('method' => 'post', 'action' => 'admin/landmarkcategories/create')); ?>

				<fieldset>
					<div class="clearfix">
						<?php echo Form::label('Categories', 'categories'); ?>

						<div class="input">
							<?php echo Form::input('categories', '', array('class' => 'span4')); ?>

						</div>
					</div>
					<div class="clearfix">
						<?php echo Form::label('Category icon', 'category_icon'); ?>

						<div class="input">
							<?php echo Form::textarea('category_icon', '', array('class' => 'span8', 'rows' => 8)); ?>

						</div>
					</div>
					<div class="clearfix">
						<?php echo Form::label('Pid', 'pid'); ?>

						<div class="input">
							<?php echo Form::input('pid', '', array('class' => 'span4')); ?>

						</div>
					</div>
					<div class="actions">
						<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

					</div>
				</fieldset>
			<?php echo Form::close(); ?>
		</div>
</div>
