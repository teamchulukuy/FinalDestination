<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Filename', 'filename'); ?>

			<div class="input">
				<?php echo Form::input('filename', Input::post('filename', isset($jeepneyroute) ? $jeepneyroute->filename : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Size', 'size'); ?>

			<div class="input">
				<?php echo Form::input('size', Input::post('size', isset($jeepneyroute) ? $jeepneyroute->size : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Type', 'type'); ?>

			<div class="input">
				<?php echo Form::input('type', Input::post('type', isset($jeepneyroute) ? $jeepneyroute->type : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Fileurl', 'fileurl'); ?>

			<div class="input">
				<?php echo Form::textarea('fileurl', Input::post('fileurl', isset($jeepneyroute) ? $jeepneyroute->fileurl : ''), array('class' => 'span8', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Datetime', 'datetime'); ?>

			<div class="input">
				<?php echo Form::input('datetime', Input::post('datetime', isset($jeepneyroute) ? $jeepneyroute->datetime : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>