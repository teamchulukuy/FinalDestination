<?php echo Html::img('assets/img/frame-top.png', array('class' => 'frame-top')) ?>

<h3 style="margin-left:15px;">Landmarks</h3>

<br>
<?php if ($landmarks): ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="example" width="100%" >
	<thead>
		<tr>
			<th></th>
			<th>Reviews</th>
			<th>Ratings</th>
			<th>Category</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($landmarks as $landmark): ?>		<tr>

			<td style="padding-bottom:20px;">
				<div>
				<p style="font-size: 20px; border-bottom:1px solid #B3B3B3; padding-top:5px; width:500px;"><b><?php echo Html::anchor('users/landmarks/view/'.$landmark->slug, $landmark->placename) ; ?></b></p>
				<p style="margin-top:-20px; width:500px;"><i><?php echo $landmark->description; ?></i></p>
				</div>	
					<div class="span4">
						<div><?php echo Html::anchor('users/landmarks/view/'.$landmark->slug, Html::img('uploads/landmarks/thumb/'.$landmark->fileurl,array('class' => 'image')));?></div>
					</div>
			</td>
			
			<td><?php foreach ($landmark->voteitems as $voteitem): ?>
			 			<?php echo $voteitem->nrates; ?>
			   <?php endforeach; ?>
			</td>
			<td><?php foreach ($landmark->voteitems as $voteitem): ?>
			 			<?php echo $voteitem->votes/100 ."%"; ?>
			   <?php endforeach; ?>
			</td>

			<td><?php echo $landmark->landmarkcategory->categories; ?></td>
			<td>
				<?php echo Html::anchor('users/landmarks/view/'.$landmark->slug, '<i class="icon-eye-open" title="View"></i>'); ?>
				

			</td>
		</tr>
<?php endforeach; ?>	</tbody>


</table>

<div id="paginate" style="float:right"></div><br><br>      
<div id="status" style="float:right; margin-right:50px"></div> 

<?php else: ?>
<p>No Landmarks.</p>

<?php endif; ?>
<p><?php echo Html::anchor('#inline_content', 'Add Landmark', array('class' => 'inline btn btn-success')); ?>

</p>


<!--ADD landmarks using inline CSS!-->
<div style="display:none">
		<div id="inline_content">
				<h4>Add Landmark</h4>

					<?php echo Form::open(array('onreset' => 'resetForm()', 'enctype' => 'multipart/form-data', 'method' => 'post', 'action' => 'users/landmarks/create','id' => 'upload'));?>

					<fieldset>
						<div class="clearfix">
							<?php echo Form::label('Placename', 'placename'); ?>

							<div class="input">
								<?php echo Form::input('placename', '', array('class' => 'span4', 'required' => '')); ?>

							</div>
						</div>

						<div class="clearfix">
							<?php echo Form::label('Category', 'landmarkcategory_id'); ?>

							<div class="input">
								<?php echo Form::select('landmarkcategory_id', '',$landmarkcategory, array('class' => 'span4', 'required' => '')); ?>

							</div>
						</div>


						<div class="clearfix">
							<?php echo Form::label('Reviews', 'reviews'); ?>

							<div class="input">
								<?php echo Form::input('reviews', '', array('class' => 'span4', 'required' => '')); ?>

							</div>
						</div>
						<div class="clearfix">
							<?php echo Form::label('Latitude', 'latitude'); ?>

							<div class="input">
								<?php echo Form::input('latitude', '', array('class' => 'span4', 'required' => '')); ?>

							</div>
						</div>
						<div class="clearfix">
							<?php echo Form::label('Longhitude', 'longhitude'); ?>

							<div class="input">
								<?php echo Form::input('longhitude', '', array('class' => 'span4', 'required' => '')); ?>

							</div>
						</div>
						<div class="clearfix">
							<?php echo Form::label('Description', 'description'); ?>

							<div class="input">
								<?php echo Form::textarea('description', '', array('class' => 'span8', 'rows' => 8, 'required' => '')); ?>

							</div>
						</div>
						<div class="clearfix">
							<?php echo Form::label('History', 'history'); ?>

							<div class="input">
								<?php echo Form::textarea('history', '', array('class' => 'span8', 'rows' => 8, 'required' => '')); ?>

							</div>
						</div>

						<div class="clearfix">
							<?php //echo Form::label('Posted by', 'user_id'); ?>

							<div class="input">
								<?php echo Form::input('user_id', ' ',array('class' => 'span4', 'type' => 'hidden')); ?>

							</div>
						</div>
						
						
							<div>
								<div>     
					            <label for="fileselect">Photo to upload:</label>

								<span class="btn btn-success fileinput-button">
					                            <i class="icon-plus icon-white"></i>
					                            <span>Add photo...</span>
					                
								<?php       echo Form::input('fileselect[]', 'upload', array('type' => 'file', 'multiple' =>'false', 'id' => 'fileselect', 'required' => '')); ?> 
								</span>


								</div>

								<div id="progress"></div>

								<div id="messages">
								<p>Status Messages</p>
								</div>
							</div>
						

						<br>


						<div class="actions">
							<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

						</div>
					</fieldset>
				<?php echo Form::close(); ?>
		</div>
</div>