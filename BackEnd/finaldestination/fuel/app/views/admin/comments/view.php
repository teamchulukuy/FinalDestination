<h2>Viewing #<?php echo $comment->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $comment->name; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $comment->email; ?></p>

<p>
	<strong>Message:</strong>
	<?php echo $comment->message; ?></p>
<p>
	<strong>Landmark id:</strong>
	<?php echo $comment->landmark->placename; ?></p>

<?php echo Html::anchor('admin/comments/edit/'.$comment->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/comments', 'Back'); ?>