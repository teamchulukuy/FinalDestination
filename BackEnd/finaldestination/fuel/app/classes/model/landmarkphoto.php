<?php
class Model_Landmarkphoto extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'filename',
		'size',
		'type',
		'fileurl',
		'landmarkid',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('filename', 'Filename', 'required|max_length[50]');
		$val->add_field('size', 'Size', 'required|valid_string[numeric]');
		$val->add_field('type', 'Type', 'required|max_length[10]');
		$val->add_field('fileurl', 'Fileurl', 'required');
		$val->add_field('landmarkid', 'Landmarkid', 'required|valid_string[numeric]');

		return $val;
	}

}
