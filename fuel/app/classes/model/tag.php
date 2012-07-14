<?php

class Model_Tag extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'tag',
		'user_id',
		'memo_id',
		'created_at',
		'updated_at'
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
		'Observer_SetUserId' => array(
			'events' => array('before_save'),
		),
	);
}
