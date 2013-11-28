<div class="container1">

	<div id="content1" style="z-index:300">
	<section>

<?php echo Form::open(array()); ?>

	<?php if (isset($_GET['destination'])): ?>
		<?php echo Form::hidden('destination',$_GET['destination']); ?>
	<?php endif; ?>

	

	<?php echo Html::anchor('public',Html::img('assets/img/fulllogo.png', array('class' => 'fulllogo'))) ?>
	<?php echo Html::img('assets/img/strip.png', array('class' => 'strip')) ?>



	<div style="margin-top:-50px">
		<?php if (isset($login_error)): ?>
			<div class="error"><?php echo $login_error; ?></div>
		<?php endif; ?>
	
		<div class="input"><?php echo Form::input('email', Input::post('email'), array('id' => 'username', 'placeholder' => 'Username or Email', )); ?></div>
		
		<?php if ($val->error('email')): ?>
			<div class="error"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></div>
		<?php endif; ?>
	</div>

	<div>
		<div class="input"><?php echo Form::password('password','',array('id' => 'password', 'placeholder' => 'Password', )); ?></div>
		
		<?php if ($val->error('password')): ?>
			<div class="error"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></div>
		<?php endif; ?>
	</div>

	<div class="actions" style="float:left;">
		<?php echo Form::submit(array('value'=>'Login', 'name'=>'submit')); ?>
	</div>

<?php echo Form::close(); ?>
	
	</section>
	</div>
</div>

<div id="two" style="float:right; margin-right:64px; margin-top:-250px;">
            <ol>
                <li>
                    <h2><div><?php echo Html::img('assets/img/tail.png',array('class' => 'tail')); ?></div></h2>
                    <div>
                        <h3><?php echo Html::anchor('auth/session/facebook', Asset::img('fb_body.png')); ?></h3>
                        
                    </div>
                </li>
                <li>
                    <h2><?php echo Html::img('assets/img/fb_head.png', array('class' => '')) ?></h2>
                    <div>
                        
                    </div>
                </li>
               
            </ol>
            
</div>

<div id="two1" style="float:right; margin-right:64px; margin-top:-200px;">
            <ol>
                <li>
                    <h2><div><?php echo Html::img('assets/img/tail.png',array('class' => 'tail')); ?></div></h2>
                    <div>
                        <h3><?php echo Html::anchor('auth/session/twitter', Asset::img('twitter_body.png')); ?></h3>
                        
                    </div>
                </li>
                <li>
                    <h2><?php echo Html::img('assets/img/twitter_head.png', array('class' => '')) ?></h2>
                    <div>
                        
                    </div>
                </li>
               
            </ol>
            
</div>
