<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username' => array(
			'data_type' => 'varchar',
			'label' => 'ユーザー名',
			'validation' => array('trim', 'required', 'min_length' => array(4), 'max_length' => array(32), 'match_pattern' => array('/^[a-zA-Z0-9]+$/'), 'unique_username'),
			'form' => array('type' => 'text'),
		),
		'password' => array(
			'data_type' => 'varchar',
			'label' => 'パスワード',
			'validation' => array('trim', 'required', 'min_length' => array(4), 'max_length' => array(32), 'match_pattern' => array('/^[a-zA-Z0-9]+$/')),
			'form' => array('type' => 'password'),
		),
		'email' => array(
			'data_type' => 'varchar',
			'label' => 'メールアドレス',
			'validation' => array('trim', 'required', 'max_length' => array(255), 'valid_email'),
			'form' => array('type' => 'text'),
		),
		'last_login',
		'login_hash',
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
	);

	public static function _validation_unique_username($val)
	{
		if (self::count(array('where' => array('username' => $val)))) {
			Validation::active()->set_message('unique_username', ':value is not unique username.');
			return false;
		}
		return true;
	}

}
