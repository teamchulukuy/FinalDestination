<?php
class Model_Tricycleroute extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'routename',
		'routedesc',
		'filename',
		'size',
		'type',
		'fileurl',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('routename', 'Routename', 'none|max_length[50]');
		$val->add_field('routedesc', 'Routedesc', 'none|max_length[255]');
		$val->add_field('filename', 'Filename', 'none|max_length[50]');
		$val->add_field('size', 'Size', 'none|valid_string[numeric]');
		$val->add_field('type', 'Type', 'none|max_length[10]');
		$val->add_field('fileurl', 'Fileurl', 'none');

		return $val;
	}

}
