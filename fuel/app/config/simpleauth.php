<?php
return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => false,

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
	'groups' => array(
	),

	/**
	 * Roles as name => array(location => rights)
	 */
	'roles' => array(
	),

	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'ed0d387a3b7f7f7da6802073a9d5a3ca',

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'username',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);
