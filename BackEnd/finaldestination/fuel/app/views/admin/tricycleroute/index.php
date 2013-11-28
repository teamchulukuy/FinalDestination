<?php echo Html::img('assets/img/frame-top.png', array('class' => 'frame-top')) ?>

<h3 style="margin-left:15px;">Tricycle Routes</h3>

<br>
<?php if ($tricycleroutes): ?>
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
<?php foreach ($tricycleroutes as $tricycleroute): ?>		<tr>

			<td><?php echo Html::anchor('admin/tricycleroute/view/'.$tricycleroute->id,$tricycleroute->routename); ?></td>
			<td><?php echo $tricycleroute->size." KB"; ?></td>
			<td><?php echo $tricycleroute->type; ?></td>
			<td><?php echo $tricycleroute->routedesc; ?></td>
			<td><?php echo $tricycleroute->created_at; ?></td>
			<td>
				<?php echo Html::anchor('admin/tricycleroute/view/'.$tricycleroute->id, '<i class="icon-eye-open" title="View"></i>'); ?> |
				<?php echo Html::anchor('admin/tricycleroute/edit/'.$tricycleroute->id, '<i class="icon-wrench" title="Edit"></i>'); ?> |
				<?php echo Html::anchor('admin/tricycleroute/delete/'.$tricycleroute->id, '<i class="icon-trash" title="Delete"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>

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
<p>No Tricycleroutes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('#inline_content', 'Add Tricycle Route', array('class' => 'inline btn btn-success')); ?>

</p>



<!--ADD TricycleRoute using inline CSS!-->
<div style="display:none;">
		<div id="inline_content">
			<h4>Upload Tricycle Route</h4>

						<?php echo Form::open(array('onreset' => 'resetForm()','enctype' => 'multipart/form-data', 'method' => 'post', 'action' => 'admin/tricycleroute/create','id' => 'upload' ));?>

			<fieldset>

			 <div>

			 <div class="clearfix">
			<?php echo Form::label('Route Name', 'routename'); ?>

			<div class="input">
				<?php echo Form::input('routename','',array('class' => 'span4', 'required' => '')); ?>

			</div>
		 </div>

		 <div class="clearfix">
			<?php echo Form::label('Route Description', 'routedesc'); ?>

			<div class="input">
				<?php echo Form::textarea('routedesc','',array('class' => 'span6', 'required' => '')); ?>

			</div>
		 </div>     

			            <label for="fileselect">Files to upload:</label>

			<span class="btn btn-success fileinput-button">
			                            <i class="icon-plus icon-white"></i>
			                            <span>Add files...</span>
			                
			<?php       echo Form::input('fileselect[]', 'upload', array('type' => 'file', 'multiple' =>'true', 'id' => 'fileselect')); ?> 
			</span>
			    


			            <button type="submit" class="btn btn-primary start">
			                    <i class="icon-upload icon-white"></i>
			                    <span>Start upload</span>
			            </button>

			            <!-- <button type="reset" class="btn btn-warning cancel">
			                    <i class="icon-ban-circle icon-white"></i>
			                    <span>Cancel upload</span>
			            </button> -->


			                    
			</div>
			</fieldset>
			<?php  echo Form::close(); ?>

			<div id="progress"></div>

			<div id="messages">
			<p>Status Messages</p>
			</div>

		<br>	

		<?php echo Html::anchor('admin/tricycleroute/draw', 'Or Draw it on the Map', array('class' => 'btn btn-success')); ?>
		</div>
</div>